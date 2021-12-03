(function($) {
	if ( 'undefined' === typeof wc_add_to_cart_params ) {
		return false;
	}
	var quickView = {
		css: '',
		js: '',
		html: {},
		height: {},
	};
	var scriptsEnqueued = {
		css: false,
		js: false,
	};

    // Product quick view.
    $('body').delegate('.woopack-product-quick-view', 'click', function(e) {
        e.preventDefault();
        e.stopPropagation();

		var nodeId      = $(this).parents('.fl-module').attr('data-node'),
			products	= $('.fl-node-' + nodeId).find('.woopack-products');
        var product     = $(this).parents('.product'),
			productId   = product.data('product-id'),
			template	= $(this).data('template') || false,
			processAjax = true;

		if ( 'undefined' !== typeof quickView.html[productId] ) {
			processAjax = false;
		}

		// Stop carousel autoplay.
		if ( products.hasClass('owl-carousel') ) {
			products.trigger('stop.owl.autoplay');
		}

		new WooPackModal({
            source: 'ajax',
            ajaxUrl: woopack_config.ajaxurl,
            ajaxData: {
                action: 'woopack_product_quick_view',
                node_id: nodeId,
				product_id: productId,
				template: template,
				templateJS: '' === quickView.js,
				templateCSS: '' === quickView.css,
			},
			processAjax: processAjax,
			breakpoint: 767,
			animationSpeed: 0,
			cssClass: 'woopack-modal-' + nodeId,
			responseHandler: function( response, object ) {
				var contentWrap = object.contentWrap;
				// set height.
				if ( 'undefined' !== typeof quickView.height[productId] ) {
					//contentWrap.css( 'max-height', quickView.height[productId] + 'px' );
				}

				if ( '' === quickView.css && 'undefined' !== typeof response.css ) {
					quickView.css = response.css;
				}
				if ( '' === quickView.js && 'undefined' !== typeof response.js ) {
					quickView.js = response.js;
				}
				if ( ! scriptsEnqueued.css ) {
					$('head').append( quickView.css );
					scriptsEnqueued.css = true;
				}

				if ( 'undefined' !== typeof quickView.html[productId] ) {
					contentWrap.html( quickView.html[productId] );
				} else {
					contentWrap.html( response.html );
					quickView.html[productId] = response.html;
				}
				
				if ( template ) {
					//$('body').append( contentWrap.find('.pswp').addClass('woopack-pswp') );
					contentWrap.imagesLoaded(function() {
						if ( ! scriptsEnqueued.js ) {
							$('body').append( quickView.js );
							scriptsEnqueued.js = true;
						} else {
							// Initialize all galleries, tabs, and ratings.
							contentWrap.find( '.woocommerce-product-gallery' ).each( function() {
								$( this ).trigger( 'wc-product-gallery-before-init', [ this, wc_single_product_params ] );
								$( this ).wc_product_gallery( wc_single_product_params );
								$( this ).trigger( 'wc-product-gallery-after-init', [ this, wc_single_product_params ] );
							} );
							contentWrap.find('.wc-tabs-wrapper, .woocommerce-tabs, #rating').trigger('init');
						}

						// Cache HTML after load.
						$(quickView.html[productId]).find('.woopack-product').html( contentWrap.find('.woopack-product').html() );

						object._resetHeight();

						setTimeout(function() {
							object.wrapper.addClass( 'woopack-ajax-loaded' );
						}, 100);
					});
				} else {
					setTimeout(function() {
						object.wrapper.addClass( 'woopack-ajax-loaded' );
					}, 100);
				}
			},
            onAjaxLoad: function(object) {
				var wrapper = object.wrapper;
				// Cache height of the wrapper in case if default template is used.
				if ( 'undefined' === typeof quickView.height[productId] ) {
					quickView.height[productId] = wrapper.find('.woopack-modal-inner').outerHeight();
				}

				//object._resetHeight();

				wrapper.find('.woocommerce-product-gallery .woocommerce-product-gallery__image a').on('click', function(e) {
					e.preventDefault();
					e.stopPropagation();
	
					var imageEl = $(this).parents('.woocommerce-product-gallery__image');
					var firstEl = imageEl.parents('.woocommerce-product-gallery').find('.woocommerce-product-gallery__image:first');
					imageEl.insertBefore(firstEl);
				});
	
				// Trigger variation form
				if ( typeof $.fn.wc_variation_form !== 'undefined' ) {
					if ( wrapper.find('form.variations_form').length > 0 ) {
						wrapper.find('form.variations_form').wc_variation_form();
					}
				}
	
				// Add target="_blank" to external product
				wrapper.find('.product-type-external form.cart').attr( 'target', '_blank' );

				// Fix for WooVariationGallery.
				if ( wrapper.find('.woo-variation-gallery-wrapper').length > 0 && 'undefined' !== typeof jQuery.fn.WooVariationGallery ) {
					wrapper.find('.woo-variation-gallery-wrapper').WooVariationGallery();
				}
				// Fix for WooVariationSwatches.
				if ( wrapper.find('.form.variations_form').length > 0 && 'undefined' !== typeof jQuery.fn.WooVariationSwatches ) {
					if ( wrapper.find('.woo-variation-items-wrapper').length > 0 ) {
						wrapper.find('.form.variations_form').WooVariationSwatches();
					}
				}

				$('body').trigger( 'woopack.quickview.ajaxload', [wrapper] );
			},
            onClose: function(wrapper) {
				wrapper.removeClass('woopack-modal-' + nodeId);
				wrapper.removeClass('woopack-ajax-loaded');
				wrapper.removeClass( 'woopack-images-loaded' );
				$('body').remove( 'woopack-pswp' );
				//wrapper.find('.woopack-modal-content').prop('style').removeProperty('height');
				//wrapper.find('.woopack-modal-content').prop('style').removeProperty('max-height');
				//wrapper.find('.woopack-modal-inner').prop('style').removeProperty('max-height');
				
				// Start carousel autoplay.
				setTimeout(function() {
					if ( products.hasClass('owl-carousel') ) {
						products.trigger('refresh.owl.carousel');
					}
				}, 500);
			},
		});
	});

    $(window).on('resize', function() {
        if ( window.innerWidth > 767 ) {
            $('.woopack-modal .woopack-modal-inner').css({
                height: 'auto'
            });
        }
    });

    // Quantity input.
    $('body').delegate('.woopack-products .quantity input.qty', 'change keyup blur', function() {
        var qty = parseInt($(this).val());
        
        // it should be above 0
        qty = ( 0 === qty || '' === qty ) ? 1 : qty;
        
        $(this).val(qty);
        $(this).parents('.woopack-product-action').find('a.button').attr('data-quantity', qty);
	});

	// Quick View add-to-cart AJAX
	$('body').delegate('.woopack-modal form.cart, .woopack-single-product form.cart', 'submit', function(e) {

		if ( $(this).hasClass('variations_form') && typeof $.fn.wc_variation_form === 'undefined' ) {
			return;
		}

		if ( $(this).parents('.product-type-external').length > 0 ) {
			return;
		}

		e.preventDefault();
		e.stopPropagation();

		var form = $(this);
		var grouped = $(this).hasClass('grouped_form');
		var $thisbutton = $(this).find('button[type="submit"]');

		if ( grouped ) {
			$(this).find('.woocommerce-grouped-product-list tr').each(function() {
				var qty = $(this).find('input.qty').val();
				var productId = $(this).attr('id').split('-')[1];

				if ( qty > 0 ) {
					var data = {
						'quantity': qty,
						'product_id': productId,
					};

					$thisbutton.removeClass( 'added' );
					$thisbutton.addClass( 'loading' );

					// Trigger event.
					$( document.body ).trigger( 'adding_to_cart', [ $thisbutton, data ] );

					// Ajax action.
					addToCart( $thisbutton, data );
				}
			});
		} else {
			if ( $(this).find('input[name="variation_id"]').length > 0 ) {
				handleVariationForm( $(this) );
			} else {
				var data = {
					'action': 'woopack_add_to_cart',
					'quantity': $(this).find('.qty').val(),
					'product_id': $(this).find('.single_add_to_cart_button').val(),
				};

				// WooCommerce Bookings support.
				if ( form.find( '.wc-bookings-booking-form' ).length > 0 ) {
					data.product_id = form.find('.wc-booking-product-id').val();
					data["wc_bookings_field_start_date_month"] = form.find('input[name="wc_bookings_field_start_date_month"]').val();
					data["wc_bookings_field_start_date_day"] = form.find('input[name="wc_bookings_field_start_date_day"]').val();
					data["wc_bookings_field_start_date_year"] = form.find('input[name="wc_bookings_field_start_date_year"]').val();
					data["wc_bookings_field_start_date_time"] = form.find('input[name="wc_bookings_field_start_date_time"]').val();
					data["wc_bookings_field_start_date_local_timezone"] = form.find('input[name="wc_bookings_field_start_date_local_timezone"]').val();
					data["wc_bookings_field_duration"] = form.find('input[name="wc_bookings_field_duration"]').val();
					data["start_time"] = form.find('[name="start_time"]').val();
					data["end_time"] = form.find('[name="end_time"]').val();
				}

				// WooCommerce Name Your Price support.
				if ( form.find( 'input[name="nyp"]' ).length > 0 ) {
					data['nyp'] = form.find( 'input[name="nyp"]' ).val();
					data['add-to-cart'] = data.product_id;
				}

				$thisbutton.removeClass( 'added' );
				$thisbutton.addClass( 'loading' );

				// Trigger event.
				$( document.body ).trigger( 'adding_to_cart', [ $thisbutton, data ] );

				addToCart( $thisbutton, data );
			}
		}
	});

	
	// Variation Add to Cart AJAX - Loop
	$('body').delegate('.woopack-products .product .variations_form, .woopack-product-add-to-cart .variations_form', 'submit', function(e) {
		if ( typeof wc_add_to_cart_params === 'undefined' ) {
			return;
		}
		
		e.preventDefault();
		e.stopPropagation();

		handleVariationForm( $(this) );
	});

	// Grouped product - add to cart
	$('body').delegate('.woopack-products .product .grouped_form', 'submit', function(e) {
		e.preventDefault();
		e.stopPropagation();

		var $thisbutton = $(this).find('button[type="submit"]');

		$(this).find('.woocommerce-grouped-product-list tr').each(function() {
			var qty = $(this).find('input.qty').val();
			var productId = $(this).attr('id').split('-')[1];

			if ( qty > 0 ) {
				var data = {
					'quantity': qty,
					'product_id': productId,
				};

				$thisbutton.removeClass( 'added' );
				$thisbutton.addClass( 'loading' );

				// Trigger event.
				$( document.body ).trigger( 'adding_to_cart', [ $thisbutton, data ] );

				// Ajax action.
				addToCart( $thisbutton, data );
			}
		});
	});

	var handleVariationForm = function( $form ) {
		var data = {
			'action': 'woopack_add_to_cart',
			'quantity': $form.find('.qty').val(),
			'product_id': $form.find('input[name="product_id"]').val(),
			'variation_id': $form.find('input[name="variation_id"]').val(),
		};

		var variations = $form.data('product_variations')[0];
		var attributes = [];

		if ( 'undefined' !== typeof variations.attributes ) {
			Object.keys( variations.attributes ).map( function( attr ) {
				if ( $form.find( '[name="' + attr + '"]' ).length > 0 ) {
					var attr_string = attr + '|' + $form.find( '[name="' + attr + '"]' ).val();
					attributes.push( attr_string );
				}
			} );

			data['variation'] = attributes;
		}

		var $thisbutton = $form.find('button[type="submit"]');

		$thisbutton.removeClass( 'added' );
		$thisbutton.addClass( 'loading' );

		// Trigger event.
		$( document.body ).trigger( 'adding_to_cart', [ $thisbutton, data ] );

		addToCart( $thisbutton, data );
	};

	var addToCart = function( $thisbutton, data ) {
		
		var url = wc_add_to_cart_params.wc_ajax_url.toString().replace( '%%endpoint%%', 'add_to_cart' );

		if ( typeof data.action !== 'undefined' ) {
			url = woopack_config.ajaxurl;
		}

		// Ajax action.
		$.post( url, data, function( response ) {
			if ( ! response ) {
				return;
			}

			if ( response.error && response.product_url ) {
				window.location = response.product_url;
				return;
			}

			// Redirect to cart option
			if ( wc_add_to_cart_params.cart_redirect_after_add === 'yes' ) {
				window.location = wc_add_to_cart_params.cart_url;
				return;
			}

			// Trigger event so themes can refresh other areas.
			$( document.body ).trigger( 'added_to_cart', [ response.fragments, response.cart_hash, $thisbutton ] );
		});
	};

	// Update product image on variation dropdown change
	$('body').delegate('.woopack-products .product .variations_form select, .woopack-single-product .variations_form select', 'change', function() {
		var $this = $(this), attr = $this.attr('name'), val = $this.val(),
			form = $this.parents('.variations_form');
		if ( $this.parents('.woopack-product-grid.product').length > 0 ) {
			var img = $this.parents('.woopack-product-grid.product').find('.woopack-product-image img');
		} else {
			var img = $this.parents('.woopack-single-product').find('.single-product-image img');
		}
		var variations = form.data('product_variations');

		if ( ! variations ) {
			return;
		}

		variations.forEach(function (item) {
			if ( 'undefined' !== typeof item.attributes[ attr ] && val === item.attributes[ attr ] ) {
				if ( 'undefined' !== typeof item.image ) {
					img.attr('src', item.image.thumb_src);
					img.attr('srcset', item.image.srcset);
				}
				// Update varition id
				if ( 'undefined' !== typeof item.variation_id ) {
					form.find('input[name="variation_id"]').val( item.variation_id );
				}
			}
		});
	});

	// Fix View Cart button appearance
	$(document).on('wc_cart_button_updated', function(e, button) {
		button.parent().find('a.added_to_cart').addClass('button alt');
	});

	var w = $('.woopack-product-image').find('.woopack-product-featured-image').attr('width');
	$('.woopack-product-image').find('.woocommerce-placeholder.wp-post-image').width(w);

	// Custom Quantity input.
	var setCustomQty = function() {
		if ( $('.woopack-products .woopack-qty-custom').length > 0 ) {
			var minus = '<span class="qty-minus"></span>';
			var plus = '<span class="qty-plus"></span>';
			$('.woopack-products .woopack-qty-custom input.qty').each(function() {
				if ( ! $(this).parent().hasClass('woopack-qty-input') ) {
					$(this).parent().addClass('woopack-qty-input');
				}
	
				$(minus).insertBefore( $(this) );
				$(plus).insertAfter( $(this) );
	
				var qty = $(this);
				$(this).parent().find( '.qty-minus' ).on('click', function() {
					qty[0].stepDown();
					qty.trigger('change');
				});
				$(this).parent().find( '.qty-plus' ).on('click', function() {
					qty[0].stepUp();
					qty.trigger('change');
				});
			});
		}
	};
	setCustomQty();

	$(document).on('woopack.grid.rendered', function() {
		setCustomQty();
	});

})(jQuery);
