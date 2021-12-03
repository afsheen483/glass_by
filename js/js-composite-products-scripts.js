var _composite;
var _step_id;
var _current_step;
var _next_step;
var _step_start = true;
var selected_pro = [];
var cross_url = "";
var sv_step_id = 1584107434;
var sv_prod_id = 21539;
var pr_prod_id = 390;
var presc_step_id = 1584107435;
var add_presc_prod_id = 387;
var no_presc_step_id = 1584107434;
var no_presc_prod_id = 389;
var light_adaptive_step_id = 1584107436;
var light_adaptive_prod_id = 392;
var material_step_id = 1584107438;
var saved_presc_prod_id = 397;
var saved_presc_list;
var sphere_opp_check = false;
var sphere_diff_check = false;
var cyl_opp_check = false;
var hidden_comp = [];

function add_class_to_parent(step_id){
	jQuery("body #component_" + step_id).find(".component_option_thumbnail").parent().removeClass('disabled');
	jQuery("body #component_" + step_id).find(".component_option_thumbnail.disabled").parent().addClass('disabled');
}


function my_active_step_changed_handler(comp) {	

	console.log("======== step start ========");

	var _comp = comp;
	var step_id = _comp.step_id;
	_step_id = step_id;
	//console.log(_comp); 
	//console.log("Step ID -> " + _step_id);
	var auto_transition = _comp._autotransition;
	var price_value = "";	
	
	_next_step = _composite.get_next_step();	
	//console.log("Review tab -> " + _comp._is_review);
	
	jQuery(".single_add_to_cart_button").unbind( "click" );
	
	//console.log("Required -> " + _comp.$required_addons);
	
	jQuery("body #component_" + _step_id).find(".component_option_thumbnail").parent().css("margin-bottom", 20);	

	/*========= Reset Hidden components	===========*/
	hidden_comp = _composite.scenarios.get_hidden_components();	
	for (i = 0; i < hidden_comp.length; i++) {
		console.log("hidden -> " + hidden_comp[i]);
		jQuery("body #component_" + hidden_comp[i]).find('#component_options_' + hidden_comp[i] + ' option[value=""]').prop("selected", true);
		jQuery("body #component_" + hidden_comp[i]).find('#component_options_' + hidden_comp[i]).change();
		jQuery("body #component_" + hidden_comp[i]).find(".reset_variations").click();
	}
	/*=============================================*/
	
	/*====== Recommend 1.67 index lens for -4 > sph > +4 ======*/
	if(_step_id == material_step_id) {
		jQuery(".wc-pao-addon-sph").each(function(){
			if(jQuery(this).find("select option:selected").text().trim() > 4 || jQuery(this).find("select option:selected").text().trim() < -4) {
				jQuery("#component_option_thumbnail_764").append('<p class="recommended-prod">Recommended</p>');
			}
		}); 
	}
	else {
		jQuery("#component_option_thumbnail_764 .recommended-prod").remove();
	}
	/*=========================================================*/
	
	/*======= Previous/Back Step Button =======*/
	if(jQuery(".composite_form .composite_navigation.bottom.paged .prev").length) {
		console.log("found");
	}
	else {
		console.log("not found");
	}
	jQuery(".composite_form .composite_navigation.bottom.paged .prev").unbind( "click" );
	jQuery(".composite_form .composite_navigation.bottom.paged .prev").on("click", function(e){
		e.preventDefault();
		console.log("prev");
	});
	/*=========================================================*/
	
	
	if(_comp._is_review){	 	
		setTimeout( function(){
			if(!jQuery(".composite_price").find(".price-label").length) {
				jQuery(".composite_price").prepend('<p class="price-label">PRESCRIPTION LENSES SUBTOTAL</p>');
			}	
			if(jQuery( window ).width() < 768) {
				jQuery('html, body').animate({ scrollTop: jQuery("#review-sidebar").offset().top - 20}, 500);
			}
		}, 800);			
	}

	/*----- Light Adaptive colour value append to review section -----*/
	if(jQuery("#component_" + light_adaptive_step_id).length) {		
		var check_light_adaptive = _composite.get_step(light_adaptive_step_id).component_selection_model.attributes.selected_product;
		if(check_light_adaptive == light_adaptive_prod_id) {
			setTimeout( function(){
				var cl_value = jQuery("#component_" + light_adaptive_step_id + " .component_wrap .wc-pao-addon-container .wc-pao-addon-image-swatch.selected span").text();
				if(jQuery(".summary_element_" + light_adaptive_step_id + " .summary_element_selection .content_product_title .content_product_meta").length) {
					jQuery(".summary_element_" + light_adaptive_step_id + " .summary_element_selection .content_product_title .content_product_meta .meta_value").html(cl_value);
				}
				else {
					var summary_data = '<ul class="content_product_meta"><li class="meta_element"><span class="meta_key">Light Adaptive Color:</span><span class="meta_value">' + cl_value + '</span><span class="meta_element_sep">, </span></li></ul>'
					jQuery(".summary_element_" + light_adaptive_step_id + " .summary_element_selection .content_product_title").append(summary_data);	
				}	
			}, 800);	
		}
	}	
	/*--------------------*/

	setTimeout( function(){
		price_value = jQuery(".widget_composite_summary_price .composite_price p.price").html();
		jQuery("#pres-totals-wrapper .price").html(price_value);
	}, 1000);	
	
	//var price_value1 = jQuery("#review-sidebar .product-price-frame .woocommerce-Price-amount.amount").clone().children().remove().end().text().split(".")[0];
	//var price_value2 = jQuery(".widget_composite_summary_price .composite_price p.price .woocommerce-Price-amount.amount").clone().children().remove().end().text().split(".")[0];
	
	setTimeout( function(){
		
		jQuery("body #component_" + _step_id + " .reset_variations").click();
		
		jQuery("body").scrollTop( 0 ); 	
		jQuery("body #component_" + _step_id).find(".component_content").hide();
		jQuery("body #component_" + _step_id).find(".component_options").show();
		
		jQuery("body #component_" + _step_id).find(".component_content table.variations tr.attribute_options:nth-child(2)").hide();
		//jQuery("body #component_" + _step_id).find(".component_content table.variations tr.attribute_options:nth-child(1)").show();
		jQuery("body #component_" + _step_id).find(".component_content table.variations tr.attribute_options:nth-child(1) ul.custom-ul li").removeClass("low-opacity");
		jQuery(".component_content table.variations tr.attribute_options:nth-child(1) ul.custom-ul li").css("margin-bottom", "20px");
		 
		add_class_to_parent(_step_id);
				
		jQuery("body .component_option_thumbnail.selected button").unbind( "click" );		 
		selected_pro.push(jQuery("body .component_option_thumbnail.selected button"));
		jQuery.each(selected_pro, function(){
			jQuery(this).unbind( "click" );
		});		
		
		/*---- Add disabled to varioations based on dropdown attr ------*/
		jQuery('#component_' + _step_id + ' .component_content table.variations tr[data-attribute_label="RX Color"] select option').each(function(){
			_this_option = this;
			_this_val = jQuery(_this_option).val();
			console.log("Option val -> " + _this_val);
			if(jQuery(_this_option).is(':disabled')) {
				console.log("Option val -> " + _this_val + "Option disabled -> ");
				if(!jQuery("#component_" + _step_id + " ul.custom-ul").find('li[data-value="' + _this_val + '"]').hasClass("disabled1")) {
					jQuery("#component_" + _step_id + " ul.custom-ul").find('li[data-value="' + _this_val + '"]').addClass("disabled1");
				}
			}
			else {
				jQuery("#component_" + _step_id + " ul.custom-ul").find('li[data-value="' + _this_val + '"]').removeClass("disabled1");
			}
		});
		
		jQuery("body .component_option_thumbnail.selected button").on("click", function(){ 	
			_current_step = _composite.get_current_step();
			console.log("1. " + _step_id);
					
			if(jQuery("body #component_" + _step_id).find("table.variations").length || auto_transition == false) {
				console.log("1.34 " + _step_id);				
				jQuery("body #component_" + _step_id + " .reset_variations").click();
				setTimeout(function() {
					jQuery("body #component_" + step_id).find(".component_content").show();
				}, 200);
				jQuery("body #component_" + step_id).find(".component_options").hide();
			}
			else if (jQuery("body #component_" + _step_id).find("ul.products").length) {
				var check_saved_presc = _composite.get_step(presc_step_id).component_selection_model.attributes.selected_product;
				
				try {
					var check_sv = _composite.get_step(sv_step_id).component_selection_model.attributes.selected_product;
					if(check_sv == sv_prod_id || check_sv == pr_prod_id) {
						var sv_add_text = '<li class="sv-add-text pro-' + check_saved_presc + '"><span>If reading or progressive prescription, enter "Add" values</span></li>';
						if(jQuery(".sv-add-text").length) {
						}
						else {	
							jQuery("body #component_" + step_id1).find(".component_content .component_data ul.products").append(sv_add_text);
						}
					}
					else {
						jQuery(".sv-add-text").remove();
					}
				} catch(err) {}
				
				setTimeout(function() {
					jQuery("body #component_" + step_id).find(".component_content").show();
				}, 200);
				jQuery("body #component_" + step_id).find(".component_options").hide();
			}
			else if(jQuery("body #component_" + _step_id).find(".component_wrap .wc-pao-addon-container").length) {
				
				var curr_clicked = jQuery("body #component_" + _step_id).find(".component_option_thumbnail.selected").parent();
				showAddons(curr_clicked, _step_id);
				
				setTimeout(function() {
					jQuery("body #component_" + _step_id).find(".component_content").show();
					jQuery("body #component_" + _step_id).find(".component_wrap").css("cssText","display: block !important");
				}, 200);
			}
			else if(_current_step.step_validation_model.attributes.passes_validation) {
				//console.log("go to next step");
				_composite.show_next_step(); 
			}	
		});
		
		prescription_checks();
		
	}, 300);
	
	console.log("======== step changed ========");
	
}
function my_component_selection_changed_handler(comp1) {	

	console.log("======== selection start ========");
	
	var _comp1 = comp1;
	var step_id1 = _comp1.step_id; 	
	var auto_transition = _comp1._autotransition;
	
	setTimeout( function(){			
		jQuery("body #component_" + step_id1).find(".component_option_thumbnail").parent().css("margin-bottom", 20);
		add_class_to_parent(step_id1);	
		if(jQuery("body #component_" + step_id1).find("table.variations").length) {	
			if(_comp1.step_validation_model.attributes.passes_validation) {
				//console.log("go to next step");
				_composite.show_next_step(); 
			}
		}	
		if(jQuery("body #component_" + step_id1).find("ul.products").length) {
			/*---- Disable input in date field -----*/
			jQuery(".wc-pao-addon-container.wc-pao-addon.wc-pao-addon-date-of-prescription input").attr('readonly','readonly');
			/*--------------------------------------*/
			
			var check_saved_presc = _composite.get_step(presc_step_id).component_selection_model.attributes.selected_product;
			if(check_saved_presc == saved_presc_prod_id) {
				//jQuery('#inline-1').appendTo(jQuery("body #component_" + step_id1).find(".component_content .component_data"));
				jQuery("body #component_" + step_id1).find(".component_content .component_data").prepend(saved_presc_list);
				jQuery('.component_data #inline-1').show();
				jQuery("body #component_" + step_id1).find("ul.products").hide();
				jQuery("body #component_" + step_id1).find(".bundle_data").hide();
			}
			try {
				var check_sv = _composite.get_step(sv_step_id).component_selection_model.attributes.selected_product;
				if(check_sv == sv_prod_id || check_sv == pr_prod_id) {
									 
					var sv_add_text = '<li class="sv-add-text pro-' + check_saved_presc + '"><span>If reading or progressive prescription, enter "Add" values</span></li>';
					if(jQuery(".sv-add-text").length) {
					}
					else {	
						jQuery("body #component_" + step_id1).find(".component_content .component_data ul.products").append(sv_add_text);
					}	
				}
				else {
					jQuery(".sv-add-text").remove();
				}
			} 
			catch(err) {}
			
			setTimeout(function() {
				jQuery("body #component_" + step_id1).find(".component_content").show();
			}, 200);
			jQuery("body #component_" + step_id1).find(".component_options").hide();
		}	
		if(jQuery("body #component_" + step_id1).find(".component_wrap .wc-pao-addon-container").length) {
			
			var curr_clicked = jQuery("body #component_" + step_id1).find(".component_option_thumbnail.selected").parent();			
			showAddons(curr_clicked, step_id1);
			
			setTimeout(function() {
				jQuery("body #component_" + step_id1).find(".component_content").show();
				jQuery("body #component_" + step_id1).find(".component_wrap").css("cssText","display: block !important");
			}, 200);
		}
		
		jQuery(".switch-presc").on("click", function(e) {
			e.preventDefault();
			//console.log("switch");
			setTimeout(function() {
				jQuery("body #component_" + step_id1).find(".component_options").show();
			}, 200);
			jQuery("body #component_" + step_id1).find(".component_content").hide();
		});
		
		jQuery(".wc-pao-addon-container.wc-pao-addon.wc-pao-addon-send-your-prescription-later .wc-pao-addon-description a").on("click", function(e) {
			e.preventDefault();
			jQuery("#component_" + presc_step_id + " #component_option_thumbnail_" + add_presc_prod_id + " button").click();
		});	
		
	}, 200);
	
	jQuery("body .component_option_thumbnail.selected button").on("click", function(){ 	
			_current_step = _composite.get_current_step();
					
			if(jQuery("body #component_" + step_id1).find("table.variations").length || auto_transition == false) {
				jQuery("body #component_" + step_id1 + " .reset_variations").click();
				setTimeout(function() {
					jQuery("body #component_" + step_id1).find(".component_content").show();
				}, 200);
				jQuery("body #component_" + step_id1).find(".component_options").hide();
			}
			else if (jQuery("body #component_" + step_id1).find("ul.products").length) {
				var check_saved_presc = _composite.get_step(presc_step_id).component_selection_model.attributes.selected_product;
				
			try {	
				var check_sv = _composite.get_step(sv_step_id).component_selection_model.attributes.selected_product;
				if(check_sv == sv_prod_id || check_sv == pr_prod_id) {
									 
					var sv_add_text = '<li class="sv-add-text pro-' + check_saved_presc + '"><span>If reading or progressive prescription, enter "Add" values</span></li>';
					if(jQuery(".sv-add-text").length) {
					}
					else {	
						jQuery("body #component_" + step_id1).find(".component_content .component_data ul.products").append(sv_add_text);
					}	
				}
				else {
					jQuery(".sv-add-text").remove();
				}
			} 
			catch(err) {}	
			
				console.log("prescription selected clicked");
				setTimeout(function() {
					jQuery("body #component_" + step_id1).find(".component_content").show();
				}, 200);
				jQuery("body #component_" + step_id1).find(".component_options").hide();
			}
			else if(jQuery("body #component_" + step_id1).find(".component_wrap .wc-pao-addon-container").length) {
				
				var curr_clicked = jQuery("body #component_" + step_id1).find(".component_option_thumbnail.selected").parent();
				showAddons(curr_clicked, step_id1);
				
				setTimeout(function() {
					jQuery("body #component_" + step_id1).find(".component_content").show();
					jQuery("body #component_" + step_id1).find(".component_wrap").css("cssText","display: block !important");
				}, 200);
			}
			else if(_current_step.step_validation_model.attributes.passes_validation) {
				//console.log("go to next step");
				_composite.show_next_step(); 
			}	
	});
	
	console.log("======== selection changed ========"); 
	
}
function my_component_scripts_initialized_handler(comp) { 
	
	console.log("======== Scripts initialise start ========");
	
	var _comp1 = comp;
	var step_id1 = _comp1.step_id; 
	
	setTimeout( function(){			
		
		add_class_to_parent(step_id1);
		
		if(jQuery("body #component_" + step_id1).find("table.variations").length) {	
			setTimeout(function() {
				jQuery("body #component_" + step_id1).find(".component_content").show();
			}, 200);
			jQuery("body #component_" + step_id1).find(".component_options").hide();
		}
		
	}, 200);
	
	
	/*----- Camera Capture show for PD -----*/
	jQuery('.wc-pao-addon-container.wc-pao-addon.wc-pao-addon-measure-my-pd').on("click", function(){
	   jQuery('#wrapper').fadeIn(200); 
	   checkCamera();
	});
	/*--------------------*/
	
	/*----- Add disabled to varioations based on dropdown attr -----*/
	jQuery('#component_' + step_id1 + ' .component_content table.variations tr[data-attribute_label="RX Color"] select option').each(function(){
		_this_option = this;
		_this_val = jQuery(_this_option).val();
		console.log("Option val -> " + _this_val);
		if(jQuery(_this_option).is(':disabled')) {
			console.log("Option val -> " + _this_val + "Option disabled -> ");
			if(!jQuery("#component_" + step_id1 + " ul.custom-ul").find('li[data-value="' + _this_val + '"]').hasClass("disabled1")) {
				jQuery("#component_" + step_id1 + " ul.custom-ul").find('li[data-value="' + _this_val + '"]').addClass("disabled1");
			}	
		}
		else {
			jQuery("#component_" + step_id1 + " ul.custom-ul").find('li[data-value="' + _this_val + '"]').removeClass("disabled1");
		}
	});
	
	jQuery(".switch-presc").on("click", function(e) {
		e.preventDefault();
		//console.log("switch");
		setTimeout(function() {
			jQuery("body #component_" + step_id1).find(".component_options").show();
		}, 200);
		jQuery("body #component_" + step_id1).find(".component_content").hide();
	});
	
	jQuery(".wc-pao-addon-container.wc-pao-addon.wc-pao-addon-send-your-prescription-later .wc-pao-addon-description a").on("click", function(e) {
		e.preventDefault();
		jQuery("#component_" + presc_step_id + " #component_option_thumbnail_" + add_presc_prod_id + " button").click();
	});	
	
	/*---- Disable input in date field -----*/
	jQuery(".wc-pao-addon-container.wc-pao-addon.wc-pao-addon-date-of-prescription input").attr('readonly','readonly');
	/*--------------------------------------*/
	
	jQuery(".component_content table.variations tr.attribute_options:nth-child(1) ul.custom-ul li").on("click", function(){
		var _this = this;
		var li_height = 0;
		var cl_height = 0;
		var position = 0;
		var margins = parseInt( jQuery(_this).css("marginLeft") );
		var li_full_height = jQuery(_this).find(".variation-outer").height();
		var li_pre_height = jQuery(_this).find(".variation-outer").prev().height();
		var	li_next_height = jQuery(_this).find(".variation-outer").next().height(); 
		
		jQuery("body #component_" + _step_id).find(".component_content table.variations tr.attribute_options:nth-child(2)").hide();
		jQuery("body #component_" + _step_id).find(".component_content table.variations tr.attribute_options:nth-child(1) ul.custom-ul li").not(_this).addClass("low-opacity");
		jQuery(_this).removeClass("low-opacity");
		setTimeout(function() {
			jQuery(".component_content table.variations tr.attribute_options:nth-child(1) ul.custom-ul li").not(_this).css("margin-bottom", "20px");
		}, 100);		
		setTimeout(function() {
			cl_height = jQuery("body #component_" + _step_id).find(".component_content table.variations tr.attribute_options:nth-child(2)").innerHeight();
			console.log(cl_height + "-> ");
			position = jQuery(_this).position(); 
			li_height = jQuery(_this).innerHeight() + position.top;
			jQuery(_this).css("margin-bottom", cl_height + 16);
			jQuery("body #component_" + _step_id).find(".component_content table.variations tr.attribute_options:nth-child(2)").css({"top":li_height, "left":position.left + margins, "visibility": "visible", "opacity": "1"});
			//console.log(jQuery(_this).index() + 1);		
			var index_this = jQuery(_this).index() + 1
			var winWidth = jQuery(window).width();
			//console.log(winWidth);
			if (winWidth > 768) {
				if(index_this%2 == 0) {
					//console.log("even");
					var result = Math.max(li_full_height,li_pre_height);
					jQuery(_this).find(".variation-outer").height(result);
					jQuery(_this).prev().find(".variation-outer").height(result);
				}
				else {
					//console.log("odd");
					var result = Math.max(li_full_height,li_next_height);
					jQuery(_this).find(".variation-outer").height(result);
					jQuery(_this).next().find(".variation-outer").height(result);
				}	
			}	
		}, 300);		
		setTimeout(function() {
			jQuery("body #component_" + _step_id).find(".component_content table.variations tr.attribute_options:nth-child(2)").show(); 
		}, 400);	
	});
	
	prescription_checks();
	
	console.log("======== Scripts initialise end ========");	
}

function readURL(input, target) {
	if (input.files && input.files[0]) {
		var reader = new FileReader();
		
		reader.onload = function(e) {
			var mimeType=input.files[0]['type'];
			const fsize=input.files[0].size;
			const fileSize= Math.round((fsize / 1024));
			var ext = jQuery(input).val().split('.').pop().toLowerCase();
			var targetimg = jQuery(".wc-pao-addon-container.wc-pao-addon.wc-pao-addon-file-preview");
			if(mimeType.split('/')[0] === 'image'){
				if (fileSize > 10240) {
					console.log('File too big!');
					jQuery('.wc-pao-addon-container.wc-pao-addon.wc-pao-addon-upload-your-prescription input[type="file"]').val('');
					jQuery('.wc-pao-addon-container.wc-pao-addon.wc-pao-addon-upload-your-prescription label.wc-pao-addon-name').css({"border-color":"#e31937", "background-color": "#e319370d"});          
					if(jQuery('.wc-pao-addon-upload-your-prescription').find('span.error').length == 0) {
						jQuery('.wc-pao-addon-upload-your-prescription').append('<span class="error">File too large. Please upload a file less than 10mb.</span>');		
					}
					else {		
						jQuery('.wc-pao-addon-upload-your-prescription').find('span.error').html("File too large. Please upload a file less than 10mb.");
						jQuery('.wc-pao-addon-upload-your-prescription').find('span.error').fadeIn("fast");
					}	
					return false;
				}
				else {
				    jQuery('.' + target).attr('src', e.target.result);
				    jQuery('.wc-pao-addon-container.wc-pao-addon.wc-pao-addon-upload-your-prescription').fadeOut(100);
					setTimeout(function() {
						console.log("19");
						jQuery(targetimg).slideDown("fast");  
					}, 100);
					jQuery('.wc-pao-addon-container.wc-pao-addon.wc-pao-addon-upload-your-prescription label.wc-pao-addon-name').css({"border-color": "#c0c0c0", "background-color": "#ffffff"}); 
					jQuery('.wc-pao-addon-upload-your-prescription span.error').fadeOut("fast");
					return true;			   
				}	
			}
			else if (jQuery.inArray(ext, ['pdf','doc','docx','txt']) == -1) {
				console.log('invalid File Type!');
				jQuery('.wc-pao-addon-container.wc-pao-addon.wc-pao-addon-upload-your-prescription input[type="file"]').val('');
				jQuery('.wc-pao-addon-container.wc-pao-addon.wc-pao-addon-upload-your-prescription label.wc-pao-addon-name').css({"border-color":"#e31937", "background-color": "#e319370d"});          
				if(jQuery('.wc-pao-addon-upload-your-prescription').find('span.error').length == 0) {
					jQuery('.wc-pao-addon-upload-your-prescription').append('<span class="error">Please upload a valid file type.</span>');		
				}
				else {		
					jQuery('.wc-pao-addon-upload-your-prescription').find('span.error').html("Please upload a valid file type.");
					jQuery('.wc-pao-addon-upload-your-prescription').find('span.error').fadeIn("fast");
				}	
				return false;
			}	
			else if (fileSize > 10240) {
				console.log('File too big!');
				jQuery('.wc-pao-addon-container.wc-pao-addon.wc-pao-addon-upload-your-prescription input[type="file"]').val('');
				jQuery('.wc-pao-addon-container.wc-pao-addon.wc-pao-addon-upload-your-prescription label.wc-pao-addon-name').css({"border-color":"#e31937", "background-color": "#e319370d"});          
				if(jQuery('.wc-pao-addon-upload-your-prescription').find('span.error').length == 0) {
					jQuery('.wc-pao-addon-upload-your-prescription').append('<span class="error">File too large. Please upload a file less than 10mb.</span>');		
				}
				else {		
					jQuery('.wc-pao-addon-upload-your-prescription').find('span.error').html("File too large. Please upload a file less than 10mb.");
					jQuery('.wc-pao-addon-upload-your-prescription').find('span.error').fadeIn("fast");
				}	
				return false;
			}
			else {
				jQuery('.' + target).attr('src', "/wp-content/themes/bb-theme-child/assets/images/doc-placeholder.jpg");
				jQuery('.wc-pao-addon-container.wc-pao-addon.wc-pao-addon-upload-your-prescription').fadeOut(100);
				setTimeout(function() {
					console.log("20");
					jQuery(targetimg).slideDown("fast"); 
				}, 100);
				jQuery(".wc-pao-addon-container.wc-pao-addon.wc-pao-addon-file-preview").append('<span class="file-name">' + jQuery(input).val().split('\\').pop() + '</span>');
				jQuery('.wc-pao-addon-container.wc-pao-addon.wc-pao-addon-upload-your-prescription label.wc-pao-addon-name').css({"border-color": "#c0c0c0", "background-color": "#ffffff"}); 
				jQuery('.wc-pao-addon-upload-your-prescription span.error').fadeOut("fast");
				return true;
			}			
		}
		reader.readAsDataURL(input.files[0]);
	}
}

function my_active_step_transition_start_handler(comp) {
	
	console.log("======== Step transition start ========");
	
	var _comp1 = comp;
	var step_id1 = _comp1.step_id; 
	
	/*======= Previous/Back Step Button =======*/
	if(jQuery(".composite_form .composite_navigation.bottom.paged .prev").length) {
		console.log("found");
	}
	else {
		console.log("not found");
	}
	jQuery(".composite_form .composite_navigation.bottom.paged .prev").unbind( "click" );
	jQuery(".composite_form .composite_navigation.bottom.paged .prev").on("click", function(e){
		e.preventDefault();
		console.log("prev");
	});
	/*=========================================================*/
	
	console.log("======== Step transition end ========");
}

function prescription_checks() {
/*----- Prescription -----*/
		
	if(jQuery("#component_" + _step_id + " .bundle_data").length ) {
		
		sphere_opp_check = false;
		sphere_diff_check = false;
		cyl_opp_check = false;
        
        // remove sph options for ray-ban and Rioray
                //If Rioray, Limit SPH to -/+ 4. If Rayban Sun limit SPH to -/+6
                if(brand_slug) {
                    //jQuery('ul.products li:first-child .wc-pao-addon-sph select option[value="10-00-1"]').remove(); 
                    jQuery("ul.products li:first-child .wc-pao-addon-sph select option, ul.products li:nth-child(2)  .wc-pao-addon-sph select option").each(function() {
                        if((brand_slug == 'rio-ray' && (parseFloat(this.text) > 4 || parseFloat(this.text) < -4 )) || 
                            (brand_slug == 'ray-ban' && (parseFloat(this.text) > 6 || parseFloat(this.text) < -6 ))    ) {
                            jQuery(this).remove();
                        }
                    });
                }
                // end remove sph script
  /*================ Setting Defaults to 0 =============*/
		
		if(jQuery('ul.products li:first-child  .wc-pao-addon-sph select').val() == "") { 
			jQuery('ul.products li:first-child  .wc-pao-addon-sph select option[data-label="0.00"]').attr('selected', 'selected');
		}
		if(jQuery('ul.products li:first-child  .wc-pao-addon-cyl select').val() == "") { 
			jQuery('ul.products li:first-child  .wc-pao-addon-cyl select option[data-label="0.00"]').attr('selected', 'selected'); 
		}
		/* if(jQuery('ul.products li:first-child  .wc-pao-addon-axis select').val() == "") {      
			jQuery('ul.products li:first-child  .wc-pao-addon-axis select option[value="0-0-1"]').prop('selected', true);
		} */
		if(jQuery('ul.products li:first-child  .wc-pao-addon-add select').val() == "") { 
			jQuery('ul.products li:first-child  .wc-pao-addon-add select option[data-label="n/a"]').prop('selected', true);
		}
		if(jQuery('ul.products li:nth-child(2) .wc-pao-addon-sph select').val() == "") { 
			jQuery('ul.products li:nth-child(2)  .wc-pao-addon-sph select option[data-label="0.00"]').prop('selected', true);
		}
		if(jQuery('ul.products li:nth-child(2) .wc-pao-addon-cyl select').val() == "") { 
			jQuery('ul.products li:nth-child(2)  .wc-pao-addon-cyl select option[data-label="0.00"]').prop('selected', true);
		}
		/* if(jQuery('ul.products li:nth-child(2) .wc-pao-addon-axis select').val() == "") { 
			jQuery('ul.products li:nth-child(2)  .wc-pao-addon-axis select option[value="0-0-1"]').prop('selected', true);
		} */
		if(jQuery('ul.products li:nth-child(2) .wc-pao-addon-add select').val() == "") { 
			jQuery('ul.products li:nth-child(2)  .wc-pao-addon-add select option[data-label="n/a"]').prop('selected', true);
		}
		if(jQuery('.wc-pao-addon-pd select').val() == "") { 
			jQuery('.wc-pao-addon-pd select option[value="0-1"]').prop('selected', true);
		}
		/*======================================================*/
		
		//jQuery('ul.products li:first-child .wc-pao-addon-sph select').on("change")
		
		jQuery('ul.products li:first-child .wc-pao-addon-axis input').css({"opacity": "0.4", "pointer-events": "none"});
		jQuery('ul.products li:nth-child(2)  .wc-pao-addon-axis input').css({"opacity": "0.4", "pointer-events": "none"});
		
		var cylinder_right_text = jQuery('ul.products li:first-child .wc-pao-addon-cyl select option:selected').text().trim();
		var axis_right_text = jQuery('ul.products li:first-child .wc-pao-addon-axis input').val();
		if((cylinder_right_text != 'Select' && cylinder_right_text != 'None' && cylinder_right_text != '0.00' && cylinder_right_text != 'Plano' && cylinder_right_text != '∞') || axis_right_text !== "") {
			jQuery('ul.products li:first-child .wc-pao-addon-axis input').css({"opacity": "1", "pointer-events": "all"});
		}
		else {
			jQuery('ul.products li:first-child .wc-pao-addon-axis input').css({"opacity": "0.4", "pointer-events": "none"});
			jQuery('ul.products li:first-child .wc-pao-addon-axis input').val("");
		}
		var cylinder_left_text = jQuery('ul.products li:nth-child(2)  .wc-pao-addon-cyl select option:selected').text().trim();  
		var axis_left_text = jQuery('ul.products li:nth-child(2) .wc-pao-addon-axis input').val();
		if((cylinder_left_text != 'Select'&& cylinder_left_text != 'None' && cylinder_left_text != '0.00' && cylinder_left_text != 'Plano' && cylinder_left_text != '∞') || axis_left_text !== "") {
			jQuery('ul.products li:nth-child(2)  .wc-pao-addon-axis input').css({"opacity": "1", "pointer-events": "all"});
		}
		else {
			jQuery('ul.products li:nth-child(2)  .wc-pao-addon-axis input').css({"opacity": "0.4", "pointer-events": "none"});
			jQuery('ul.products li:nth-child(2)  .wc-pao-addon-axis input').val("");
		}
		
		jQuery(".wc-pao-addon-container.wc-pao-required-addon.wc-pao-addon.wc-pao-addon-date-of-prescription input").datepicker({
		  dateFormat: "mm/dd/yy",
		  maxDate : 0
		});
		jQuery(".wc-pao-addon-container.wc-pao-addon.wc-pao-addon-pd-checkbox input.wc-pao-addon-checkbox").unbind( "change" );
		jQuery(".wc-pao-addon-container.wc-pao-addon.wc-pao-addon-pd-checkbox input.wc-pao-addon-checkbox").change(function() {
			//console.log("checkbox");
			jQuery(".wc-pao-addon-container.wc-pao-addon.wc-pao-addon-pd-checkbox p.form-row label").toggleClass("active");
			jQuery(".wc-pao-addon-container.wc-pao-addon.wc-pao-addon-pd").slideToggle(100);
			setTimeout(function() {
				jQuery(".wc-pao-addon-container.wc-pao-addon.wc-pao-addon-right-pd, .wc-pao-addon-container.wc-pao-addon.wc-pao-addon-left-pd").slideToggle(100);
			}, 100);	
			if(jQuery(".wc-pao-addon-container.wc-pao-addon.wc-pao-addon-pd-checkbox input.wc-pao-addon-checkbox").is(":checked")) {
				var pd_right = jQuery(".wc-pao-addon-container.wc-pao-addon.wc-pao-addon-right-pd select").val();
				var pd_left = jQuery(".wc-pao-addon-container.wc-pao-addon.wc-pao-addon-left-pd select").val();
				jQuery("#component_" + presc_step_id + " .bundle_form ul.products li:first-child .wc-pao-addon.wc-pao-addon-pd select").val(pd_right);
				jQuery("#component_" + presc_step_id + " .bundle_form ul.products li:nth-child(2) .wc-pao-addon.wc-pao-addon-pd select").val(pd_left);
			}
		});
		jQuery(".wc-pao-addon-container.wc-pao-addon.wc-pao-addon-my-pupillary-distance-pd-is-listed-on-my-prescription input.wc-pao-addon-checkbox").unbind( "change" );
		jQuery(".wc-pao-addon-container.wc-pao-addon.wc-pao-addon-my-pupillary-distance-pd-is-listed-on-my-prescription input.wc-pao-addon-checkbox").change(function() {
			if(jQuery(".wc-pao-addon-container.wc-pao-addon.wc-pao-addon-my-pupillary-distance-pd-is-listed-on-my-prescription input.wc-pao-addon-checkbox").is(":checked")) {
				//console.log("checkbox checked");
				jQuery(".wc-pao-addon-container.wc-pao-addon.wc-pao-addon-my-pupillary-distance-pd-is-listed-on-my-prescription p.form-row label").addClass("active");
				jQuery(".wc-pao-addon-container.wc-pao-addon.wc-pao-addon-pupillary-distance-pd").slideUp("fast");
				jQuery(".wc-pao-addon-container.wc-pao-addon.wc-pao-addon-pd").slideUp("fast");
				jQuery(".wc-pao-addon-container.wc-pao-addon.wc-pao-addon-measure-my-pd").slideUp("fast");
				if(jQuery(".wc-pao-addon-container.wc-pao-addon.wc-pao-addon-pd-checkbox input.wc-pao-addon-checkbox").is(":checked")) {
					jQuery(".wc-pao-addon-container.wc-pao-addon.wc-pao-addon-right-pd").slideUp("fast");
					jQuery(".wc-pao-addon-container.wc-pao-addon.wc-pao-addon-left-pd").slideUp("fast");
				}
				jQuery(".wc-pao-addon-container.wc-pao-addon.wc-pao-addon-pd-checkbox").slideUp("fast");
			}
			else {
				//console.log("checkbox unchecked");
				jQuery(".wc-pao-addon-container.wc-pao-addon.wc-pao-addon-my-pupillary-distance-pd-is-listed-on-my-prescription p.form-row label").removeClass("active");
				jQuery(".wc-pao-addon-container.wc-pao-addon.wc-pao-addon-pupillary-distance-pd").slideDown("fast");
				jQuery(".wc-pao-addon-container.wc-pao-addon.wc-pao-addon-measure-my-pd").slideDown("fast");
				if(jQuery(".wc-pao-addon-container.wc-pao-addon.wc-pao-addon-pd-checkbox input.wc-pao-addon-checkbox").is(":checked")) {
					jQuery(".wc-pao-addon-container.wc-pao-addon.wc-pao-addon-right-pd").slideDown("fast");
					jQuery(".wc-pao-addon-container.wc-pao-addon.wc-pao-addon-left-pd").slideDown("fast");
				}	
				else {
					jQuery(".wc-pao-addon-container.wc-pao-addon.wc-pao-addon-pd").slideDown("fast");
				}	
					jQuery(".wc-pao-addon-container.wc-pao-addon.wc-pao-addon-pd-checkbox").slideDown("fast");
			}	
		});
		
		/*----------------- Prisms -------------------*/		
		jQuery(".wc-pao-addon-container.wc-pao-addon.wc-pao-addon-my-prescription-has-prisms input.wc-pao-addon-checkbox").unbind( "change" );
		jQuery(".wc-pao-addon-container.wc-pao-addon.wc-pao-addon-my-prescription-has-prisms input.wc-pao-addon-checkbox").change(function() {
			//console.log("checkbox");
			jQuery(".wc-pao-addon-container.wc-pao-addon.wc-pao-addon-my-prescription-has-prisms p.form-row label").toggleClass("active");
			jQuery(".wc-pao-addon-container.wc-pao-addon.wc-pao-addon-right-eye-prism, .wc-pao-addon-container.wc-pao-addon.wc-pao-addon-left-eye-prism, .wc-pao-addon-container.wc-pao-addon.wc-pao-addon-power, .wc-pao-addon-container.wc-pao-addon.wc-pao-addon-direction, .wc-pao-addon-container.wc-pao-addon.wc-pao-addon-left-power, .wc-pao-addon-container.wc-pao-addon.wc-pao-addon-left-direction").slideToggle(100);
			
			if(!jQuery(".wc-pao-addon-container.wc-pao-addon.wc-pao-addon-my-prescription-has-prisms input.wc-pao-addon-checkbox").is(":checked")) {
				jQuery(".wc-pao-addon-container.wc-pao-addon.wc-pao-addon-power p.wc-pao-addon-wrap select option:first").attr('selected','selected');
				jQuery(".wc-pao-addon-container.wc-pao-addon.wc-pao-addon-direction p.wc-pao-addon-wrap select option:first").attr('selected','selected');
				jQuery(".wc-pao-addon-container.wc-pao-addon.wc-pao-addon-left-power p.wc-pao-addon-wrap select option:first").attr('selected','selected');
				jQuery(".wc-pao-addon-container.wc-pao-addon.wc-pao-addon-left-direction p.wc-pao-addon-wrap select option:first").attr('selected','selected');
			}
		});
		/*---------------------------------------------*/
		
		
		jQuery(".wc-pao-addon-container.wc-pao-addon.wc-pao-addon-save-your-prescription-for-future-use p.form-row input").unbind( "focus" );
		jQuery(".wc-pao-addon-container.wc-pao-addon.wc-pao-addon-save-your-prescription-for-future-use p.form-row input").unbind( "blur" );
		jQuery(".wc-pao-addon-container.wc-pao-addon.wc-pao-addon-save-your-prescription-for-future-use p.form-row input").focus(function() {
			jQuery(".wc-pao-addon-container.wc-pao-addon.wc-pao-addon-save-your-prescription-for-future-use .wc-pao-addon-description").fadeOut("fast");
		});
		jQuery(".wc-pao-addon-container.wc-pao-addon.wc-pao-addon-save-your-prescription-for-future-use p.form-row input").blur(function() {
			if(jQuery(this).filter(function() { return jQuery(this).val(); }).length <= 0) {
				jQuery(".wc-pao-addon-container.wc-pao-addon.wc-pao-addon-save-your-prescription-for-future-use .wc-pao-addon-description").fadeIn("fast");
			}	
		});
		jQuery('.wc-pao-addon-container.wc-pao-addon.wc-pao-addon-upload-your-prescription input[type="file"]').unbind( "change" );
		jQuery('.wc-pao-addon-container.wc-pao-addon.wc-pao-addon-upload-your-prescription input[type="file"]').change(function() {		
			var _this_ = this;
			var target = jQuery(".wc-pao-addon-container.wc-pao-addon.wc-pao-addon-file-preview");
			jQuery(target).find("img").remove();
			var img = jQuery('<img class="dynamic">'); 
			img.appendTo('.wc-pao-addon-container.wc-pao-addon.wc-pao-addon-file-preview');
			var img_id = "dynamic";
			if (readURL(_this_, img_id)) {
				jQuery('.wc-pao-addon-container.wc-pao-addon.wc-pao-addon-upload-your-prescription').fadeOut(100);
				setTimeout(function() {
					console.log("22");
					jQuery(target).slideDown("fast"); 
				}, 100);
			}
		});
		jQuery(".wc-pao-addon-container.wc-pao-addon.wc-pao-addon-file-preview h3.wc-pao-addon-heading").unbind( "click" );
		jQuery(".wc-pao-addon-container.wc-pao-addon.wc-pao-addon-file-preview h3.wc-pao-addon-heading").on("click", function(){
			jQuery(".wc-pao-addon-container.wc-pao-addon.wc-pao-addon-file-preview").fadeOut(100);
			jQuery(".wc-pao-addon-container.wc-pao-addon.wc-pao-addon-file-preview .file-name").remove();
			jQuery(".wc-pao-addon-container.wc-pao-addon.wc-pao-addon-file-preview img.dynamic").remove();																				 
			setTimeout(function() {
				jQuery('.wc-pao-addon-container.wc-pao-required-addon.wc-pao-addon.wc-pao-addon-upload-your-prescription input[type="file"]').val('');
				jQuery('.wc-pao-addon-container.wc-pao-required-addon.wc-pao-addon.wc-pao-addon-upload-your-prescription').slideDown("fast");
			}, 100);	
		});
		jQuery(".wc-pao-addon-container.wc-pao-addon.wc-pao-addon-confirm").unbind( "click" );
		jQuery(".wc-pao-addon-container.wc-pao-addon.wc-pao-addon-confirm").on("click", function(){
			var valid = validation_check();
			//console.log(valid);
			if(!valid) {
				jQuery('html, body').animate({
					scrollTop: jQuery(".composite_pagination").offset().top          
				}, 1200);
			}
			else {
				_composite.show_next_step();
			}	
		});
		
		/*------------- Axis based on cyl --------------*/
		jQuery('ul.products li:first-child .wc-pao-addon-cyl select').unbind( "change" );
		jQuery('ul.products li:nth-child(2)  .wc-pao-addon-cyl select').unbind( "change" );
		jQuery('ul.products li:first-child .wc-pao-addon-cyl select').on("change", function(){
			var cylinder_right_text = jQuery('ul.products li:first-child .wc-pao-addon-cyl select option:selected').text().trim();  
			if(cylinder_right_text != 'Select' && cylinder_right_text != '0.00' && cylinder_right_text != 'None' && cylinder_right_text != 'Plano' && cylinder_right_text != '∞') {
				jQuery('ul.products li:first-child .wc-pao-addon-axis input').css({"opacity": "1", "pointer-events": "all"});
			}
			else {
				jQuery('ul.products li:first-child .wc-pao-addon-axis input').css({"opacity": "0.4", "pointer-events": "none"});
				jQuery('ul.products li:first-child .wc-pao-addon-axis input').val("");
			}
		});
		jQuery('ul.products li:nth-child(2)  .wc-pao-addon-cyl select').on("change", function(){
			var cylinder_left_text = jQuery('ul.products li:nth-child(2)  .wc-pao-addon-cyl select option:selected').text().trim();  
			if(cylinder_left_text != 'Select' && cylinder_left_text != '0.00' && cylinder_left_text != 'None' && cylinder_left_text != 'Plano' && cylinder_left_text != '∞') {
				jQuery('ul.products li:nth-child(2)  .wc-pao-addon-axis input').css({"opacity": "1", "pointer-events": "all"});
			}
			else {
				jQuery('ul.products li:nth-child(2)  .wc-pao-addon-axis input').css({"opacity": "0.4", "pointer-events": "none"});
				jQuery('ul.products li:nth-child(2)  .wc-pao-addon-axis input').val("");
			}
		});
	
	}
	 /*============= Unselect/Clear data if no-prescription selected ==============*/ 
	try {
		var check_no_presc = _composite.get_step(no_presc_step_id).component_selection_model.attributes.selected_product;

		if(check_no_presc == no_presc_prod_id) {
			/*================ Unselect/Empty fields =============*/		
			jQuery('ul.products li:first-child .wc-pao-addon-sph select option[value=""]').attr('selected', 'selected');
			jQuery('ul.products li:first-child .wc-pao-addon-cyl select option[value=""]').attr('selected', 'selected'); 
			jQuery('ul.products li:first-child .wc-pao-addon-axis input').val("");
			jQuery('ul.products li:first-child .wc-pao-addon-add select option[value=""]').prop('selected', true);
			jQuery('ul.products li:nth-child(2) .wc-pao-addon-sph select option[value=""]').prop('selected', true);
			jQuery('ul.products li:nth-child(2) .wc-pao-addon-cyl select option[value=""]').prop('selected', true);
			jQuery('ul.products li:nth-child(2) .wc-pao-addon-axis input').val("");
			jQuery('ul.products li:nth-child(2) .wc-pao-addon-add select option[value=""]').prop('selected', true);
			jQuery('.wc-pao-addon-pd select option[value=""]').prop('selected', true);
			
			jQuery('ul.products li:first-child .wc-pao-addon.wc-pao-addon-pd select option[value=""]').prop('selected', true);
			jQuery('ul.products li:nth-child(2) .wc-pao-addon.wc-pao-addon-pd select option[value=""]').prop('selected', true);
			/*======================================================*/
		}
	} catch(err) {}		
}	
	
	/*-------------------------*/

function validation_check() {

	var sphere_opp_text = '<p class="prompt-text sph-txt">The SPH parameters entered include a positive value for one eye and a negative value for the other. Please verify that this is correct.</p>';
	var sphere_diff_text = '<p class="prompt-text sph-txt">You have entered a prescription that is much higher in one eye than the other. Double check that this is correct.</p>';
	var cyl_opp_text = '<p class="prompt-text cyl-txt">You have entered + and - values for your CYL (Cylinder). Please check your prescription and ensure that both CYL values are either positive or negative.</p>';

	var check_no_presc = _composite.get_step(no_presc_step_id).component_selection_model.attributes.selected_product;

	if(check_no_presc == no_presc_prod_id) {
		return true;
	}

	try {
		var check_no_presc = _composite.get_step(no_presc_step_id).component_selection_model.attributes.selected_product;
  

		if(check_no_presc == no_presc_prod_id) {
			return true;
		}
	} catch(err) {}
	
	/* start prescription validation */ 
	var is_prescription_valid = true;       
	var sphere_right_text = jQuery('ul.products li:first-child .wc-pao-addon-sph select option:selected').text().trim(); 
	var cylinder_right_text = jQuery('ul.products li:first-child .wc-pao-addon-cyl select option:selected').text().trim();          
	if(jQuery('ul.products li:first-child  .wc-pao-addon-axis').length) {
		var axis_right_text = jQuery('ul.products li:first-child .wc-pao-addon-axis input').val(); 
	}	
	var add_right_text = jQuery('ul.products li:first-child .wc-pao-addon-add select option:selected').text().trim();
	var power_right_text = jQuery(".wc-pao-addon-container.wc-pao-addon.wc-pao-addon-power p.wc-pao-addon-wrap select option:selected").text().trim(); 
	var direction_right_text = jQuery(".wc-pao-addon-container.wc-pao-addon.wc-pao-addon-direction p.wc-pao-addon-wrap select option:selected").text().trim(); 
		 
	var sphere_left_text = jQuery('ul.products li:nth-child(2)  .wc-pao-addon-sph select option:selected').text().trim(); 
	var cylinder_left_text = jQuery('ul.products li:nth-child(2)  .wc-pao-addon-cyl select option:selected').text().trim();      
	if(jQuery('ul.products li:nth-child(2)  .wc-pao-addon-axis').length) {
		var axis_left_text = jQuery('ul.products li:nth-child(2)  .wc-pao-addon-axis input').val();  
	}	
	var add_left_text = jQuery('ul.products li:nth-child(2)  .wc-pao-addon-add select option:selected').text().trim(); 
	var power_left_text = jQuery(".wc-pao-addon-container.wc-pao-addon.wc-pao-addon-left-power p.wc-pao-addon-wrap select option:selected").text().trim(); 
	var direction_left_text = jQuery(".wc-pao-addon-container.wc-pao-addon.wc-pao-addon-left-direction p.wc-pao-addon-wrap select option:selected").text().trim(); 
	
	var fname_text = jQuery('.wc-pao-addon-first-name input').val();  
	var lname_text = jQuery('.wc-pao-addon-last-name input').val();
	var email_text = jQuery('.wc-pao-addon-email input').val();
	
	/*---- Prisms Validation ----*/
	if(jQuery(".wc-pao-addon-container.wc-pao-addon.wc-pao-addon-my-prescription-has-prisms input.wc-pao-addon-checkbox").is(":checked")) {
		/* Right power */
		if (power_right_text == 'Select' || power_right_text == 'None') {
			jQuery(".wc-pao-addon-container.wc-pao-addon.wc-pao-addon-power p.wc-pao-addon-wrap select").css("border-color", "#e31937");  
			if(jQuery(".wc-pao-addon-container.wc-pao-addon.wc-pao-addon-power").find('span.error').length == 0) {
				jQuery(".wc-pao-addon-container.wc-pao-addon.wc-pao-addon-power").append('<span class="error">Power required</span>');
			}
			else {		
				jQuery(".wc-pao-addon-container.wc-pao-addon.wc-pao-addon-power").find('span.error').fadeIn("fast");
			}        
			is_prescription_valid = false;          
		} 
		else {
			jQuery(".wc-pao-addon-container.wc-pao-addon.wc-pao-addon-power p.wc-pao-addon-wrap select").css("border-color", "#c0c0c0");          
			jQuery(".wc-pao-addon-container.wc-pao-addon.wc-pao-addon-power").find('span.error').fadeOut("fast");
		}
		/*----*/
		/* Right direction */
		if (direction_right_text == 'Select' || direction_right_text == 'None') {
			jQuery(".wc-pao-addon-container.wc-pao-addon.wc-pao-addon-direction p.wc-pao-addon-wrap select").css("border-color", "#e31937");  
			if(jQuery(".wc-pao-addon-container.wc-pao-addon.wc-pao-addon-direction").find('span.error').length == 0) {
				jQuery(".wc-pao-addon-container.wc-pao-addon.wc-pao-addon-direction").append('<span class="error">Direction required</span>');
			}
			else {		
				jQuery(".wc-pao-addon-container.wc-pao-addon.wc-pao-addon-direction").find('span.error').fadeIn("fast");
			}        
			is_prescription_valid = false;          
		} 
		else {
			jQuery(".wc-pao-addon-container.wc-pao-addon.wc-pao-addon-direction p.wc-pao-addon-wrap select").css("border-color", "#c0c0c0");          
			jQuery(".wc-pao-addon-container.wc-pao-addon.wc-pao-addon-direction").find('span.error').fadeOut("fast");
		}
		/*----*/
		/* Left power */
		if (power_left_text == 'Select' || power_left_text == 'None') {
			jQuery(".wc-pao-addon-container.wc-pao-addon.wc-pao-addon-left-power p.wc-pao-addon-wrap select").css("border-color", "#e31937");  
			if(jQuery(".wc-pao-addon-container.wc-pao-addon.wc-pao-addon-left-power").find('span.error').length == 0) {
				jQuery(".wc-pao-addon-container.wc-pao-addon.wc-pao-addon-left-power").append('<span class="error">Power required</span>');
			}
			else {		
				jQuery(".wc-pao-addon-container.wc-pao-addon.wc-pao-addon-left-power").find('span.error').fadeIn("fast");
			}        
			is_prescription_valid = false;          
		} 
		else {
			jQuery(".wc-pao-addon-container.wc-pao-addon.wc-pao-addon-left-power p.wc-pao-addon-wrap select").css("border-color", "#c0c0c0");          
			jQuery(".wc-pao-addon-container.wc-pao-addon.wc-pao-addon-left-power").find('span.error').fadeOut("fast");
		}
		/*----*/
		/* Left direction */
		if (direction_left_text == 'Select' || direction_left_text == 'None') {
			jQuery(".wc-pao-addon-container.wc-pao-addon.wc-pao-addon-left-direction p.wc-pao-addon-wrap select").css("border-color", "#e31937");  
			if(jQuery(".wc-pao-addon-container.wc-pao-addon.wc-pao-addon-left-direction").find('span.error').length == 0) {
				jQuery(".wc-pao-addon-container.wc-pao-addon.wc-pao-addon-left-direction").append('<span class="error">Direction required</span>');
			}
			else {		
				jQuery(".wc-pao-addon-container.wc-pao-addon.wc-pao-addon-left-direction").find('span.error').fadeIn("fast");
			}        
			is_prescription_valid = false;          
		} 
		else {
			jQuery(".wc-pao-addon-container.wc-pao-addon.wc-pao-addon-left-direction p.wc-pao-addon-wrap select").css("border-color", "#c0c0c0");          
			jQuery(".wc-pao-addon-container.wc-pao-addon.wc-pao-addon-left-direction").find('span.error').fadeOut("fast");
		}
	}	
	/*---------------------------*/
	
	if(jQuery(".wc-pao-addon-container.wc-pao-addon.wc-pao-addon-pd-checkbox input.wc-pao-addon-checkbox").is(":checked")) {
		jQuery(".wc-pao-addon-container.wc-pao-addon.wc-pao-addon-pd select option:selected").prop("selected", false);
		jQuery('.wc-pao-addon-container.wc-pao-addon.wc-pao-addon-pd select option[value="0-1"]').prop('selected', true);
		var pd_right = jQuery(".wc-pao-addon-container.wc-pao-addon.wc-pao-addon-right-pd select").val();
		var pd_left = jQuery(".wc-pao-addon-container.wc-pao-addon.wc-pao-addon-left-pd select").val();
		jQuery("#component_" + presc_step_id + " .bundle_form ul.products li:first-child  .wc-pao-addon.wc-pao-addon-pd select").val(pd_right);
		jQuery("#component_" + presc_step_id + " .bundle_form ul.products li:nth-child(2)  .wc-pao-addon.wc-pao-addon-pd select").val(pd_left);
	}
	else if (jQuery('.bundle_data .wc-pao-addon-container.wc-pao-addon.wc-pao-addon-pd').length) {
		var pd_single = jQuery('.bundle_data .wc-pao-addon-container.wc-pao-addon.wc-pao-addon-pd select option:selected').text().trim();
		var pd_single_int = parseInt(pd_single);
		if(pd_single_int == 0) {
			var pd_single_int_half = "0.00";
		} else {
			var pd_single_int_half = (pd_single_int/2).toFixed(1);
		}	
		jQuery("#component_" + presc_step_id + " .bundle_form ul.products li:first-child  .wc-pao-addon.wc-pao-addon-pd select option:selected").prop("selected", false);	
		jQuery("#component_" + presc_step_id + " .bundle_form ul.products li:nth-child(2)  .wc-pao-addon.wc-pao-addon-pd select option:selected").prop("selected", false);	
		jQuery('#component_' + presc_step_id + ' .bundle_form ul.products li:first-child  .wc-pao-addon.wc-pao-addon-pd select option[data-label="' + pd_single_int_half + '"]').prop('selected', true);
		jQuery('#component_' + presc_step_id + ' .bundle_form ul.products li:nth-child(2)  .wc-pao-addon.wc-pao-addon-pd select option[data-label="' + pd_single_int_half + '"]').prop('selected', true);
	}
	else {}
		
	if (!fname_text) {         
		jQuery('.wc-pao-addon-first-name input').css({"border-color":"#e31937", "background-color": "#e319370d"});          
		is_prescription_valid = false; 
		if(jQuery('.wc-pao-addon-first-name').find('span.error').length == 0) {
			jQuery('.wc-pao-addon-first-name').append('<span class="error">Please enter your first name</span>');
			//console.log("eror name 1");
		}
		else {	
			//console.log("eror name");	
			jQuery('.wc-pao-addon-first-name').find('span.error').fadeIn("fast");
		}	
	}
	else {
		jQuery('.wc-pao-addon-first-name input').css({"border-color": "#c0c0c0", "background-color": "#ffffff"}); 
		//console.log("no eror name");	
		jQuery('.wc-pao-addon-first-name span.error').fadeOut("fast");
	}
	if (!lname_text) {         
		jQuery('.wc-pao-addon-last-name input').css({"border-color":"#e31937", "background-color": "#e319370d"});          
		is_prescription_valid = false;          
		if(jQuery('.wc-pao-addon-last-name').find('span.error').length == 0) {
			jQuery('.wc-pao-addon-last-name').append('<span class="error">Please enter your last name</span>');
		}
		else {		
			jQuery('.wc-pao-addon-last-name').find('span.error').fadeIn("fast");
		}
	} 
	else {
		jQuery('.wc-pao-addon-last-name input').css({"border-color": "#c0c0c0", "background-color": "#ffffff"}); 
		jQuery('.wc-pao-addon-last-name span.error').fadeOut("fast");		
	}
	/* if (!email_text && jQuery('.wc-pao-addon-email input').length) {         
		jQuery('.wc-pao-addon-email input').css({"border-color":"#e31937", "background-color": "#e319370d"});          
		is_prescription_valid = false;          
		if(jQuery('.wc-pao-addon-email').find('span.error').length == 0) {
			jQuery('.wc-pao-addon-email').append('<span class="error">Please enter your email</span>');
		}
		else {		
			jQuery('.wc-pao-addon-email').find('span.error').fadeIn("fast");
		}
	} 
	else {
		jQuery('.wc-pao-addon-email input').css({"border-color": "#c0c0c0", "background-color": "#ffffff"}); 
		jQuery('.wc-pao-addon-email span.error').fadeOut("fast");		
	}*/
	
	if(jQuery('.wc-pao-addon-save-your-prescription-for-future-use').length) {
		var pres_name = jQuery('.wc-pao-addon-save-your-prescription-for-future-use input').val();
		if (!pres_name) {         
			jQuery('.wc-pao-addon-save-your-prescription-for-future-use input').css({"border-color":"#e31937", "background-color": "#e319370d"});          
			is_prescription_valid = false;   
			if(jQuery('.wc-pao-addon-save-your-prescription-for-future-use').find('span.error').length == 0) {
				jQuery('.wc-pao-addon-save-your-prescription-for-future-use').append('<span class="error">Please enter a prescription name</span>');
			}
			else {		
				jQuery('.wc-pao-addon-save-your-prescription-for-future-use').find('span.error').fadeIn("fast");
			}			
		} 
		else {
			jQuery('.wc-pao-addon-save-your-prescription-for-future-use input').css({"border-color": "#c0c0c0", "background-color": "#ffffff"});
			jQuery('.wc-pao-addon-save-your-prescription-for-future-use span.error').fadeOut("fast");	
		}
	}
	if(jQuery('.wc-pao-addon-date-of-prescription').length) {
		var pres_date = jQuery('.wc-pao-addon-date-of-prescription input').val();
		if (!pres_date) {         
			jQuery('.wc-pao-addon-date-of-prescription input').css({"border-color":"#e31937", "background-color": "#e319370d"});          
			is_prescription_valid = false;   
			if(jQuery('.wc-pao-addon-date-of-prescription').find('span.error').length == 0) {
				jQuery('.wc-pao-addon-date-of-prescription').append('<span class="error">Please enter prescription date</span>');			
			}
			else {		
				jQuery('.wc-pao-addon-date-of-prescription').find('span.error').fadeIn("fast");
			}		
		} 
		else {
			jQuery('.wc-pao-addon-date-of-prescription input').css({"border-color": "#c0c0c0", "background-color": "#ffffff"});   
			jQuery('.wc-pao-addon-date-of-prescription span.error').fadeOut("fast");
		}
	}
	if(jQuery('.wc-pao-addon-upload-your-prescription input').length) {
		if(jQuery('.wc-pao-addon-upload-your-prescription input').get(0).files.length == 0) {
			jQuery('.wc-pao-addon-container.wc-pao-required-addon.wc-pao-addon.wc-pao-addon-upload-your-prescription label.wc-pao-addon-name').css({"border-color":"#e31937", "background-color": "#e319370d"});          
			is_prescription_valid = false; 
			if(jQuery('.wc-pao-addon-upload-your-prescription').find('span.error').length == 0) {
				jQuery('.wc-pao-addon-upload-your-prescription').append('<span class="error">Please upload a copy of prescription</span>');		
			}
			else {		
				jQuery('.wc-pao-addon-upload-your-prescription').find('span.error').text("Please upload a copy of prescription");
				jQuery('.wc-pao-addon-upload-your-prescription').find('span.error').fadeIn("fast");
			}	
		} 
		else {
			jQuery('.wc-pao-addon-container.wc-pao-required-addon.wc-pao-addon.wc-pao-addon-upload-your-prescription label.wc-pao-addon-name').css({"border-color": "#c0c0c0", "background-color": "#ffffff"}); 
			jQuery('.wc-pao-addon-upload-your-prescription span.error').fadeOut("fast");	
		}
	}
	
	if (sphere_right_text == 'Select' || sphere_right_text == 'None') {
		jQuery('ul.products li:first-child .wc-pao-addon-sph select').css("border-color", "#e31937");  
		if(jQuery('ul.products li:first-child .wc-pao-addon-sph').find('span.error').length == 0) {
			jQuery('ul.products li:first-child .wc-pao-addon-sph').append('<span class="error">Sphere required</span>');
		}
		else {		
			jQuery('ul.products li:first-child .wc-pao-addon-sph').find('span.error').fadeIn("fast");
		}        
		is_prescription_valid = false;          
	} 
	else {
		jQuery('ul.products li:first-child .wc-pao-addon-sph select').css("border-color", "#c0c0c0");          
		jQuery('ul.products li:first-child .wc-pao-addon-sph').find('span.error').fadeOut("fast");
	}
	/* check for right axis  */ 
	if ((axis_right_text === '') && (cylinder_right_text != 'Select' && cylinder_right_text != '0.00' && cylinder_right_text != 'None' && cylinder_right_text != 'Plano' && cylinder_right_text != '∞')) {     
		jQuery('ul.products li:first-child .wc-pao-addon-axis input').css("border-color", "#e31937"); 
		if(jQuery('ul.products li:first-child .wc-pao-addon-axis').find('span.error').length == 0) {
			jQuery('ul.products li:first-child .wc-pao-addon-axis').append('<span class="error">Axis required</span>');
		}
		else {		
			jQuery('ul.products li:first-child .wc-pao-addon-axis').find('span.error').fadeIn("fast");
		}		
		is_prescription_valid = false;          
	} 
	else {          
		jQuery('ul.products li:first-child .wc-pao-addon-axis input').css("border-color", "#c0c0c0"); 
		jQuery('ul.products li:first-child .wc-pao-addon-axis').find('span.error').fadeOut("fast");		
	}       
			 
	if (sphere_left_text == 'Select' || sphere_left_text == 'None') {          
		jQuery('ul.products li:nth-child(2)  .wc-pao-addon-sph select').css("border-color", "#e31937"); 
		if(jQuery('ul.products li:nth-child(2)  .wc-pao-addon-sph').find('span.error').length == 0) {
			jQuery('ul.products li:nth-child(2)  .wc-pao-addon-sph').append('<span class="error">Sphere required</span>');
		}
		else {		
			jQuery('ul.products li:nth-child(2)  .wc-pao-addon-sph').find('span.error').fadeIn("fast");
		}		
		is_prescription_valid = false;           
	} 
	else {          
		jQuery('ul.products li:nth-child(2)  .wc-pao-addon-sph select').css("border-color", "#c0c0c0"); 
		jQuery('ul.products li:nth-child(2)  .wc-pao-addon-sph').find('span.error').fadeOut("fast");		
	}         
	/* check for left axis     */     
	if ((axis_left_text === '') && (cylinder_left_text != 'Select' && cylinder_left_text != '0.00' && cylinder_left_text != 'None' && cylinder_left_text != 'Plano' && cylinder_left_text != '∞')) {     
		jQuery('ul.products li:nth-child(2)  .wc-pao-addon-axis select').css("border-color", "#e31937");
		if(jQuery('ul.products li:nth-child(2)  .wc-pao-addon-axis').find('span.error').length == 0) {
			jQuery('ul.products li:nth-child(2)  .wc-pao-addon-axis').append('<span class="error">Axis required</span>');
		}
		else {		
			jQuery('ul.products li:nth-child(2)  .wc-pao-addon-axis').find('span.error').fadeIn("fast");
		}		
		is_prescription_valid = false;          
	} 
	else {          
		jQuery('ul.products li:nth-child(2)  .wc-pao-addon-axis input').css("border-color", "#c0c0c0");  
		jQuery('ul.products li:nth-child(2)  .wc-pao-addon-axis').find('span.error').fadeOut("fast");		
	} 
	
	/*======================================================*/
	/*====== Validation Based on values differences ========*/
	/*======================================================*/
	
	if((sphere_right_text < 0 && sphere_left_text > 0) || (sphere_right_text > 0 && sphere_left_text < 0)) {
		if(!sphere_opp_check) {
			jQuery(".sph-txt").remove();
			sphere_opp_check = true;
			is_prescription_valid = false; 
			jQuery('ul.products li:first-child .wc-pao-addon-sph select').css("border-color", "#e31937");
			jQuery('ul.products li:nth-child(2) .wc-pao-addon-sph select').css("border-color", "#e31937");
			jQuery("body #component_" + _step_id).find(".component_data").prepend(sphere_opp_text); 
		}
		else {
			jQuery(".sph-txt").remove();
			jQuery('ul.products li:first-child .wc-pao-addon-sph select').css("border-color", "#c0c0c0");
			jQuery('ul.products li:nth-child(2) .wc-pao-addon-sph select').css("border-color", "#c0c0c0");			
		}
	}
	else if(sphere_right_text.replace("+", "").replace("-", "") - sphere_left_text.replace("+", "").replace("-", "") >= 3 || sphere_right_text.replace("+", "").replace("-", "") - sphere_left_text.replace("+", "").replace("-", "") <= -3) {
		if(!sphere_diff_check) {
			jQuery(".sph-txt").remove();
			sphere_diff_check = true;
			is_prescription_valid = false; 
			jQuery('ul.products li:first-child .wc-pao-addon-sph select').css("border-color", "#e31937");
			jQuery('ul.products li:nth-child(2) .wc-pao-addon-sph select').css("border-color", "#e31937");
			jQuery("body #component_" + _step_id).find(".component_data").prepend(sphere_diff_text); 
		}
		else {
			jQuery(".sph-txt").remove();
			jQuery('ul.products li:first-child .wc-pao-addon-sph select').css("border-color", "#c0c0c0");
			jQuery('ul.products li:nth-child(2) .wc-pao-addon-sph select').css("border-color", "#c0c0c0");
		}	
	}
	else {
		jQuery(".sph-txt").remove();
		jQuery('ul.products li:first-child .wc-pao-addon-sph select').css("border-color", "#c0c0c0");
		jQuery('ul.products li:nth-child(2) .wc-pao-addon-sph select').css("border-color", "#c0c0c0");
	}
	
	if((cylinder_right_text < 0 && cylinder_left_text > 0) || (cylinder_right_text > 0 && cylinder_left_text < 0)) {
		jQuery(".cyl-txt").remove();
		cyl_opp_check = true;
		is_prescription_valid = false; 
		jQuery('ul.products li:first-child .wc-pao-addon-cyl select').css("border-color", "#e31937");
		jQuery('ul.products li:nth-child(2) .wc-pao-addon-cyl select').css("border-color", "#e31937");
		jQuery("body #component_" + _step_id).find(".component_data").prepend(cyl_opp_text); 
	}
	else {
		jQuery(".cyl-txt").remove();
		jQuery('ul.products li:first-child .wc-pao-addon-cyl select').css("border-color", "#c0c0c0");
		jQuery('ul.products li:nth-child(2) .wc-pao-addon-cyl select').css("border-color", "#c0c0c0");			
	}
	
	if (typeof axis_left_text !== 'undefined' && axis_left_text != "" && (axis_left_text > 180 || axis_left_text < 0 || isNaN(axis_left_text))) {
		jQuery(".axis-txt").remove();
		is_prescription_valid = false; 
		jQuery('ul.products li:nth-child(2) .wc-pao-addon-axis input').css("border-color", "#e31937");
		jQuery("body #component_" + _step_id).find(".component_data").prepend('<p class="prompt-text axis-txt axis-txt-left">Please select axis value between 0 - 180.</p>'); 
	}
	else {		
		jQuery('ul.products li:nth-child(2) .wc-pao-addon-axis input').css("border-color", "#c0c0c0");
		jQuery(".axis-txt-left").remove();
	}
	if (typeof axis_right_text !== 'undefined' && axis_right_text != "" && (axis_right_text > 180 || axis_right_text < 0 || isNaN(axis_right_text))) {
		jQuery(".axis-txt").remove();
		is_prescription_valid = false; 
		jQuery('ul.products li:first-child .wc-pao-addon-axis input').css("border-color", "#e31937");
		jQuery("body #component_" + _step_id).find(".component_data").prepend('<p class="prompt-text axis-txt axis-txt-right">Please select axis value between 0 - 180.</p>');
	}
	else {
		jQuery('ul.products li:first-child .wc-pao-addon-axis input').css("border-color", "#c0c0c0");
		jQuery(".axis-txt-right").remove();
	}
	
	/*======================================================*/
	/*======================================================*/
	/*======================================================*/
	
	if (!is_prescription_valid) { 
		return false;            
	}
	else {
		return true;
	}
	/* validating frame and getting its form values */
}

function showAddons(curr_clicked, cr_step_id) {		
		
		var _this = curr_clicked;
		var li_height = 0;
		var cl_height = 0;
		var position = 0;
		var margins = parseInt( jQuery(_this).css("marginLeft") );
		var li_full_width = jQuery(_this).width();
		var li_full_height = jQuery(_this).height();
		var li_pre_height = jQuery(_this).prev().height();
		var	li_next_height = jQuery(_this).next().height(); 
		
		jQuery("body #component_" + cr_step_id + " .component_wrap .wc-pao-addon-image-swatch").each(function(){
			if(!jQuery(this).find("span").length) {
				jQuery(this).append("<span>" + jQuery(this).data("value").split("-")[0] + "</span>");
			}	
		});
		
		setTimeout(function() {
			jQuery("body #component_" + cr_step_id).find(".component_wrap").css({"width":li_full_width}); 
			cl_height = jQuery("body #component_" + cr_step_id).find(".component_wrap").innerHeight();
			position = jQuery(_this).position(); 
			li_height = jQuery(_this).innerHeight() + position.top;
			jQuery(_this).css("margin-bottom", cl_height + 16);
			jQuery("body #component_" + cr_step_id).find(".component_wrap").css({"visibility":"visible","opacity": "1", "position":"absolute","top":li_height, "left":position.left + 9 + margins});
			//console.log(jQuery(_this).index() + 1);		
			var index_this = jQuery(_this).index() + 1;
			var winWidth = jQuery(window).width();
			//console.log(winWidth);
			if (winWidth > 768) {
				if(index_this%2 == 0) {
					//console.log("even");
					var result = Math.max(li_full_height,li_pre_height);
					jQuery(_this).height(result);
					jQuery(_this).prevAll().each(function(){
						if(jQuery(this).hasClass('disabled')) {							
						}
						else {
							jQuery(this).height(result);
							return false;
						}
					});
				}
				else {
					//console.log("odd");
					var result = Math.max(li_full_height,li_next_height);
					jQuery(_this).height(result);
					jQuery(_this).nextAll().each(function(){
						if(jQuery(this).hasClass('disabled')) {							
						}
						else {
							jQuery(this).height(result);
							return false;
						}
					});
				}	
			}	
		}, 300);
		
		jQuery(".component_wrap .wc-pao-addon-container .wc-pao-addon-image-swatch").on("touchstart  click", function(){
			_composite.show_next_step();
			//alert("clicked"); 
		});
		
}

jQuery( document ).ready(function($){
	
	$( '.composite_data' ).on( 'wc-composite-initializing', function( event, composite ) {
			
		_composite = composite;	
		//console.log("initialised");
		//console.log(_composite);
		composite.actions.add_action( 'active_step_changed', my_active_step_changed_handler, 100, composite ); 
		composite.actions.add_action( 'component_selection_changed', my_component_selection_changed_handler, 100, composite ); 
		composite.actions.add_action( 'component_scripts_initialized', my_component_scripts_initialized_handler, 100, composite );
		composite.actions.add_action( 'active_step_transition_start', my_active_step_transition_start_handler, 100, composite );
				
		jQuery("#review-sidebar .toggler").on("click", function(){
			jQuery(".widget_composite_summary .composite_summary ul.summary_elements").slideToggle("medium");
			jQuery(this).toggleClass('closed');
		});
	
	});	

	saved_presc_list = $("#inline-1");
	
	cross_url = jQuery("#frame_product_url").val();
	jQuery("#cross-rx").on("click", function(){
		window.location.href = cross_url;
	});

} );

