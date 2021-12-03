<div id="inline-1">
    <a href="#" class="switch-presc">Change Prescription Method</a>
    <div class="sp-prescription-loader">
        <img src="/wp-content/themes/bb-theme-child/assets/images/loader.gif" />
    </div>
    <div class="login-form-wrapper">
        <div class="tab-content2">
            <div id="login-popup">
                <div class="inner-login-text">
                    <div class="login-form">
                        <div id="login-form">
                            <label>Email*<input type="text" id="username" name="username" value="" /></label>
                            <label>Password*<input type="password" id="password" name="password" value="" /></label>
                            <input type="hidden" name="is_reserved_login" id="is_reserved_login" value="" />
                            <a href="javascript:void(0);" class="submit-btn" onclick="return ajaxSubmit();">Login</a>
                            <a href="https://directvisioneyewear.ca/my-account/lost-password/" class="forgot-pass">Forgot your password?</a>
                            <input type="hidden" id="security" name="security" value="10b2822210" /><input type="hidden" name="_wp_http_referer" value="/product/prescription-lenses/?product_id=21464&amp;variation_id=21465" />
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<style type="text/css">
    .user-prescription_list-div,
    .sp-prescription-textfields-div {
        display: none;
    }
</style>
<script src="https://static.fittingbox.com/api/v1/fitmix.js" type="text/javascript"></script>
<div class="woopack-modal" style="display: none;">
    <div class="woopack-modal-overlay" style="background-image: url(https://directvisioneyewear.ca/wp-content/plugins/woopack/assets/images/loader.gif);"></div>
    <div class="woopack-modal-inner">
        <div class="woopack-modal-close">×</div>
        <div class="woopack-modal-content"></div>
    </div>
</div>
<a href="#" id="fl-to-top"><span class="sr-only">Scroll To Top</span><i class="fas fa-chevron-up" aria-hidden="true"></i></a>
<script type="application/ld+json">
    {
        "@context": "https:\/\/schema.org\/",
        "@type": "Product",
        "@id": "https:\/\/directvisioneyewear.ca\/product\/prescription-lenses\/#product",
        "name": "Prescription Lenses",
        "url": "https:\/\/directvisioneyewear.ca\/product\/prescription-lenses\/",
        "description": "",
        "image": "https:\/\/directvisioneyewear.ca\/wp-content\/uploads\/2020\/05\/KIOSK-prescription-page-CHECKOUT_031.jpg",
        "sku": 394,
        "offers": [
            {
                "@type": "Offer",
                "price": "",
                "priceValidUntil": "2022-12-31",
                "priceSpecification": { "price": "0.00", "priceCurrency": "CAD", "valueAddedTaxIncluded": "false" },
                "priceCurrency": "CAD",
                "availability": "http:\/\/schema.org\/InStock",
                "url": "https:\/\/directvisioneyewear.ca\/product\/prescription-lenses\/",
                "seller": { "@type": "Organization", "name": "Direct Vision", "url": "https:\/\/directvisioneyewear.ca" }
            }
        ]
    }
</script>
<div class="pswp" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="pswp__bg"></div>
    <div class="pswp__scroll-wrap">
        <div class="pswp__container">
            <div class="pswp__item"></div>
            <div class="pswp__item"></div>
            <div class="pswp__item"></div>
        </div>
        <div class="pswp__ui pswp__ui--hidden">
            <div class="pswp__top-bar">
                <div class="pswp__counter"></div>
                <button class="pswp__button pswp__button--close" aria-label="Close (Esc)"></button>
                <button class="pswp__button pswp__button--share" aria-label="Share"></button>
                <button class="pswp__button pswp__button--fs" aria-label="Toggle fullscreen"></button>
                <button class="pswp__button pswp__button--zoom" aria-label="Zoom in/out"></button>
                <div class="pswp__preloader">
                    <div class="pswp__preloader__icn">
                        <div class="pswp__preloader__cut">
                            <div class="pswp__preloader__donut"></div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="pswp__share-modal pswp__share-modal--hidden pswp__single-tap">
                <div class="pswp__share-tooltip"></div>
            </div>
            <button class="pswp__button pswp__button--arrow--left" aria-label="Previous (arrow left)"></button>
            <button class="pswp__button pswp__button--arrow--right" aria-label="Next (arrow right)"></button>
            <div class="pswp__caption">
                <div class="pswp__caption__center"></div>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript">
    var c = document.body.className;
    c = c.replace(/woocommerce-no-js/, "woocommerce-js");
    document.body.className = c;
</script>
<script type="text/template" id="tmpl-variation-template">
    <div class="woocommerce-variation-description">{{{ data.variation.variation_description }}}</div>
    <div class="woocommerce-variation-price">{{{ data.variation.price_html }}}</div>
    <div class="woocommerce-variation-availability">{{{ data.variation.availability_html }}}</div>
</script>
<script type="text/template" id="tmpl-unavailable-variation-template">
    <p>Sorry, this product is unavailable. Please choose a different combination.</p>
</script>
<script type="text/template" id="tmpl-wc_cp_component_selection_title">

    <# if ( data.show_title ) { #>
        <# if ( data.show_selection_ui ) { #>
            <p class="component_section_title selected_option_label_wrapper">
                <label class="selected_option_label">Your selection:</label>
            </p>
        <# } #>
        <{{ data.tag }} class="composited_product_title component_section_title product_title">{{{ data.selection_title }}}</{{ data.tag }}>
    <# } #>

    <# if ( data.show_selection_ui && data.show_reset_ui ) { #>
        <p class="component_section_title clear_component_options_wrapper">
            <a class="clear_component_options" href="#">Clear selection</a>
        </p>
    <# } #>
</script>
<script type="text/template" id="tmpl-wc_cp_composite_navigation">
    <div class="composite_navigation_inner">
        <a class="page_button prev {{ data.prev_btn.btn_classes }}" href="{{ data.prev_btn.btn_link }}" rel="nofollow" aria-label="{{ data.prev_btn.btn_label }}">Back</a>
        <!-- <a class="page_button next {{ data.next_btn.btn_classes }}" href="{{ data.next_btn.btn_link }}" rel="nofollow" aria-label="{{ data.next_btn.btn_label }}">{{ data.next_btn.btn_text }}</a> -->
    </div>
</script>
<script type="text/template" id="tmpl-wc_cp_composite_pagination">
    <nav class="pagination_elements_wrapper">
        <ul class="pagination_elements" style="list-style:none">
            <# for ( var index = 0; index <= data.length - 1; index++ ) { #>
                <li class="pagination_element pagination_element_{{ data[ index ].element_id }} {{ data[ index ].element_class }}" data-item_id="{{ data[ index ].element_id }}">
                    <span class="element_inner">
                        <span class="element_index">{{ index + 1 }}</span>
                        <span class="element_title">
                            <a class="element_link {{ data[ index ].element_state_class }}" href="{{ data[ index ].element_link }}" rel="nofollow">{{ data[ index ].element_title }}</a>
                        </span>
                    </span>
                </li>
            <# } #>
        </ul>
    </nav>
</script>
<script type="text/template" id="tmpl-wc_cp_composite_status">
    <ul class="messages" style="list-style:none">
        <# for ( var index = 0; index < data.length; index++ ) { #>
            <li class="message <# if ( false === data[ index ].is_old ) { #>current<# } #>">
                <span class="content">{{{ data[ index ].message_content }}}</span>
            </li>
        <# } #>
    </ul>
</script>
<script type="text/template" id="tmpl-wc_cp_validation_message">
    <div class="validation_message woocommerce-info">
        <ul style="list-style:none">
            <# for ( var index = 0; index <= data.length - 1; index++ ) { #>
                <li>{{{ data[ index ] }}}</li>
            <# } #>
        </ul>
    </div>
</script>
<script type="text/template" id="tmpl-wc_cp_summary_element_content">
    <div class="summary_element_title summary_element_data">
        <h3 class="title summary_element_content"><span class="step_index">{{ data.element_index }}</span> <span class="step_title">{{ data.element_title }}</span></h3>
    </div>
    <# if ( data.element_is_in_widget ) { #>
        <div class="summary_element_tap summary_element_data">
            <span class="summary_element_select_wrapper">
                <a href="{{ data.element_button_link }}" rel="nofollow" class="summary_element_select" aria-label="{{ data.element_label }}">{{{ data.element_action }}}</a>
            </span>
        </div>
    <# } #>
    <# if ( data.element_image_src ) { #>
        <div class="summary_element_image summary_element_data">
            <img class="summary_element_content" alt="{{ data.element_image_title }}" src="{{ data.element_image_src }}" srcset="{{ data.element_image_srcset }}" sizes="{{ data.element_image_sizes }}" />
        </div>
    <# } #>
    <# if ( data.element_selection_title ) { #>
        <div class="summary_element_selection summary_element_data">
            <# if ( data.element_selection_title ) { #>
                <span class="summary_element_content">{{{ data.element_selection_title }}}</span>
            <# } #>
        </div>
    <# } #>
    <# if ( data.element_price ) { #>
        <div class="summary_element_price summary_element_data">{{{ data.element_price }}}</div>
    <# } #>
    <# if ( ! data.element_is_in_widget ) { #>
        <div class="summary_element_button summary_element_data">
            <a href="{{ data.element_button_link }}" rel="nofollow" class="button summary_element_select" aria-label="{{ data.element_label }}">{{{ data.element_action }}}</a>
        </div>
    <# } #>
</script>
<script type="text/template" id="tmpl-wc_cp_options_dropdown">
    <# for ( var index = 0; index <= data.length - 1; index++ ) { #>
        <# if ( false === data[ index ].is_hidden ) { #>
            <option value="{{ data[ index ].option_id }}" <# if ( data[ index ].is_disabled ) { #>disabled="disabled"<# } #> <# if ( data[ index ].is_selected ) { #>selected="selected"<# } #>>{{{ data[ index ].option_display_title }}}</option>
        <# } #>
    <# } #>
</script>
<script type="text/template" id="tmpl-wc_cp_options_thumbnails">
    <# if ( data.length > 0 ) { #>
        <ul class="component_option_thumbnails_container cp_clearfix" style="list-style:none">
            <# for ( var index = 0; index <= data.length - 1; index++ ) { #>
                <li id="component_option_thumbnail_container_{{ data[ index ].option_id }}" class="component_option_thumbnail_container {{ data[ index ].outer_classes }}">
                    <div id="component_option_thumbnail_{{ data[ index ].option_id }}" class="cp_clearfix component_option_thumbnail {{ data[ index ].inner_classes }}" data-val="{{ data[ index ].option_id }}">
                        <div class="thumnail_title">
                                                       <h5 class="thumbnail_title title">{{{ data[ index ].option_display_title }}}</h5>
                                                   </div>
                                                   <div class="image thumbnail_image">
                            {{{ data[ index ].option_thumbnail_html }}}
                        </div>
                        <div class="thumbnail_description">
                                                       <p>{{{ data[ index ].option_description }}}</p>
                            <# if ( data[ index ].option_price_html ) { #>
                                <span class="thumbnail_price price">{{{ data[ index ].option_price_html }}}</span>
                            <# } #>
                        </div>
                        <div class="thumbnail_buttons">
                            <button class="button component_option_thumbnail_select" aria-label="{{ data[ index ].option_button_label }}">{{ data[ index ].option_button_text }}</button>
                        </div>
                    </div>
                </li>
            <# } #>
        </ul>
    <# } #>
    <# if ( data.length === 0 ) { #>
        <p class="results_message no_query_results">
            No results found.       </p>
    <# } else if ( _.where( data, { is_hidden: false } ).length === 0 ) { #>
        <p class="results_message no_compat_results">
            No compatible options to display.       </p>
    <# } #>
</script>
<script type="text/template" id="tmpl-wc_cp_options_radio_buttons">
    <# if ( data.length > 0 ) { #>
        <ul class="component_option_radio_buttons_container cp_clearfix" style="list-style:none">
            <# for ( var index = 0; index <= data.length - 1; index++ ) { #>
                <li id="component_option_radio_button_container_{{ data[ index ].option_suffix }}" class="component_option_radio_button_container {{ data[ index ].outer_classes }}">
                    <div id="component_option_radio_button_{{ data[ index ].option_suffix }}" class="cp_clearfix component_option_radio_button {{ data[ index ].inner_classes }}" data-val="{{ data[ index ].option_id }}">
                        <div class="radio_button_input">
                            <input type="radio" id="wccp_component_radio_{{ data[ index ].option_group_id }}_{{ index }}" class="radio_button" name="wccp_component_radio[{{ data[ index ].option_group_id }}]" value="{{ data[ index ].option_id }}" <# if ( data[ index ].is_disabled ) { #>disabled="disabled"<# } #> <# if ( data[ index ].is_selected ) { #>checked="checked"<# } #> />
                            <label for="wccp_component_radio_{{ data[ index ].option_group_id }}_{{ index }}" class="component_option_radio_button_select">
                            </label>
                        </div>
                        <div class="radio_button_description">
                            <h5 class="radio_button_title title">{{{ data[ index ].option_display_title }}}</h5>
                            <# if ( data[ index ].option_price_html ) { #>
                                <span class="radio_button_price price">{{{ data[ index ].option_price_html }}}</span>
                            <# } #>
                        </div>
                    </div>
                </li>
            <# } #>
        </ul>
    <# } #>
    <# if ( data.length === 0 ) { #>
        <p class="results_message no_query_results">
            No results found.       </p>
    <# } else if ( _.where( data, { is_hidden: false } ).length === 0 ) { #>
        <p class="results_message no_compat_results">
            No compatible options to display.       </p>
    <# } #>
</script>
<script type="text/template" id="tmpl-wc_cp_options_pagination">
    <p class="index woocommerce-result-count" tabindex="-1">{{ data.i18n_page_of_pages }}</p>
    <nav class="woocommerce-pagination">
        <ul class="page-numbers">

            <# if ( data.page > 1 ) { #>
                <li><a class="page-numbers component_pagination_element prev" data-page_num="{{ data.page - 1 }}" href="#" rel="nofollow" aria-label="Previous page">&larr;</a></li>
            <# } #>

            <# for ( var i = 1; i <= data.pages; i++ ) { #>
                <# if ( ( i >= data.page - data.range_mid && i <= data.page + data.range_mid ) || data.pages <= data.pages_in_range || i <= data.range_end || i > data.pages - data.range_end ) { #>
                    <li>
                        <# if ( data.page === i ) { #>
                            <span aria-current="page" class="page-numbers component_pagination_element number current" data-page_num="{{ i }}">{{ i }}</span>
                        <# } else { #>
                            <a class="page-numbers component_pagination_element number" data-page_num="{{ i }}" href="#" rel="nofollow" aria-label="Page {{ i }}">{{ i }}</a>
                        <# } #>
                    </li>
                <# } else if ( ( i === data.page - data.range_mid - 1 ) || ( i === data.page + data.range_mid + 1 ) || ( i === data.range_end + 1 && data.page < data.range_end ) || ( i === data.pages - data.range_end - 1 && data.page > data.pages - data.range_end + data.range_mid + 1 ) ) { #>
                    <li><span class="page-numbers component_pagination_element dots">&hellip;</span></li>
                <# } #>
            <# } #>

            <# if ( data.page < data.pages ) { #>
                <li><a class="page-numbers component_pagination_element next" data-page_num="{{ data.page + 1 }}" href="#" rel="nofollow" aria-label="Next page">&rarr;</a></li>
            <# } #>

        </ul>
    </nav>
</script>

<script type="text/javascript">
    jQuery(function ($) {
        jQuery(document.body).on("wc-composite-initializing", function (event, composite) {
            if (typeof jQuery.fn.tawcvs_variation_swatches_form === "function") {
                composite.actions.add_action(
                    "component_scripts_initialized",
                    function (step) {
                        if ("variable" === step.get_selected_product_type()) {
                            step.$component_summary_content.tawcvs_variation_swatches_form();
                        }
                    },
                    10,
                    this
                );
            }
        });
    });
</script>
<link rel="stylesheet" id="wc-composite-single-css-css" href="https://directvisioneyewear.ca/wp-content/plugins/woocommerce-composite-products/assets/css/frontend/single-product.css?ver=6.2.2" media="all" />
<link rel="stylesheet" id="wc-bundle-css-css" href="https://directvisioneyewear.ca/wp-content/plugins/woocommerce-product-bundles/assets/css/frontend/single-product.css?ver=6.2.3" media="all" />
<script id="ajax-login-script-js-extra">
    var ajax_login_object = { ajaxurl: "https:\/\/directvisioneyewear.ca\/wp-admin\/admin-ajax.php", redirecturl: "https:\/\/directvisioneyewear.ca", loadingmessage: "Sending user info, please wait..." };
</script>
<script src="https://directvisioneyewear.ca/wp-content/themes/bb-theme-child/assets/js/ajax-login-script.js?ver=1601906525" id="ajax-login-script-js"></script>
<script src="https://directvisioneyewear.ca/wp-content/plugins/woocommerce/assets/js/jquery-blockui/jquery.blockUI.min.js?ver=2.70" id="jquery-blockui-js"></script>
<script id="wc-add-to-cart-js-extra">
    var wc_add_to_cart_params = {
        ajax_url: "\/wp-admin\/admin-ajax.php",
        wc_ajax_url: "\/?wc-ajax=%%endpoint%%",
        i18n_view_cart: "View cart",
        cart_url: "https:\/\/directvisioneyewear.ca\/cart\/",
        is_cart: "",
        cart_redirect_after_add: "yes",
    };
</script>
<script src="https://directvisioneyewear.ca/wp-content/plugins/woocommerce/assets/js/frontend/add-to-cart.min.js?ver=4.5.2" id="wc-add-to-cart-js"></script>
<script src="https://directvisioneyewear.ca/wp-content/plugins/woocommerce/assets/js/flexslider/jquery.flexslider.min.js?ver=2.7.2" id="flexslider-js"></script>
<script src="https://directvisioneyewear.ca/wp-content/plugins/woocommerce/assets/js/photoswipe/photoswipe.min.js?ver=4.1.1" id="photoswipe-js"></script>
<script src="https://directvisioneyewear.ca/wp-content/plugins/woocommerce/assets/js/photoswipe/photoswipe-ui-default.min.js?ver=4.1.1" id="photoswipe-ui-default-js"></script>
<script id="wc-single-product-js-extra">
    var wc_single_product_params = {
        i18n_required_rating_text: "Please select a rating",
        review_rating_required: "yes",
        flexslider: { rtl: false, animation: "slide", smoothHeight: true, directionNav: false, controlNav: "thumbnails", slideshow: false, animationSpeed: 500, animationLoop: false, allowOneSlide: false },
        zoom_enabled: "",
        zoom_options: [],
        photoswipe_enabled: "1",
        photoswipe_options: { shareEl: false, closeOnScroll: false, history: false, hideAnimationDuration: 0, showAnimationDuration: 0 },
        flexslider_enabled: "1",
    };
</script>
<script src="https://directvisioneyewear.ca/wp-content/plugins/woocommerce/assets/js/frontend/single-product.min.js?ver=4.5.2" id="wc-single-product-js"></script>
<script src="https://directvisioneyewear.ca/wp-content/plugins/woocommerce/assets/js/js-cookie/js.cookie.min.js?ver=2.1.4" id="js-cookie-js"></script>
<script id="woocommerce-js-extra">
    var woocommerce_params = { ajax_url: "\/wp-admin\/admin-ajax.php", wc_ajax_url: "\/?wc-ajax=%%endpoint%%" };
</script>
<script src="https://directvisioneyewear.ca/wp-content/plugins/woocommerce/assets/js/frontend/woocommerce.min.js?ver=4.5.2" id="woocommerce-js"></script>
<script id="wc-cart-fragments-js-extra">
    var wc_cart_fragments_params = {
        ajax_url: "\/wp-admin\/admin-ajax.php",
        wc_ajax_url: "\/?wc-ajax=%%endpoint%%",
        cart_hash_key: "wc_cart_hash_633822a51e2a6d5acea01e864322a9d0",
        fragment_name: "wc_fragments_633822a51e2a6d5acea01e864322a9d0",
        request_timeout: "5000",
    };
</script>
<script src="https://directvisioneyewear.ca/wp-content/plugins/woocommerce/assets/js/frontend/cart-fragments.min.js?ver=4.5.2" id="wc-cart-fragments-js"></script>
<script src="https://directvisioneyewear.ca/wp-content/plugins/woopack/assets/js/frontend.js?ver=1.3.9.5" id="woopack-frontend-js"></script>
<script src="https://directvisioneyewear.ca/wp-content/plugins/woocommerce/assets/js/jquery-tiptip/jquery.tipTip.min.js?ver=4.5.2" id="jquery-tiptip-js"></script>
<script src="https://directvisioneyewear.ca/wp-content/plugins/bb-plugin/js/jquery.ba-throttle-debounce.min.js?ver=2.4.0.5" id="jquery-throttle-js"></script>
<script src="https://directvisioneyewear.ca/wp-content/uploads/bb-plugin/cache/316aa7932dc523038da973638f45f54e-layout-bundle.js?ver=2.4.0.5-1.3.2.3" id="fl-builder-layout-bundle-316aa7932dc523038da973638f45f54e-js"></script>
<script src="https://directvisioneyewear.ca/wp-content/plugins/woocommerce/assets/js/jquery-payment/jquery.payment.min.js?ver=3.0.0" id="jquery-payment-js"></script>
<script id="sv-wc-payment-gateway-payment-form-js-extra">
    var sv_wc_payment_gateway_payment_form_params = {
        card_number_missing: "Card number is missing",
        card_number_invalid: "Card number is invalid",
        card_number_digits_invalid: "Card number is invalid (only digits allowed)",
        card_number_length_invalid: "Card number is invalid (wrong length)",
        cvv_missing: "Card security code is missing",
        cvv_digits_invalid: "Card security code is invalid (only digits are allowed)",
        cvv_length_invalid: "Card security code is invalid (must be 3 or 4 digits)",
        card_exp_date_invalid: "Card expiration date is invalid",
        check_number_digits_invalid: "Check Number is invalid (only digits are allowed)",
        check_number_missing: "Check Number is missing",
        drivers_license_state_missing: "Drivers license state is missing",
        drivers_license_number_missing: "Drivers license number is missing",
        drivers_license_number_invalid: "Drivers license number is invalid",
        account_number_missing: "Account Number is missing",
        account_number_invalid: "Account Number is invalid (only digits are allowed)",
        account_number_length_invalid: "Account number is invalid (must be between 5 and 17 digits)",
        routing_number_missing: "Routing Number is missing",
        routing_number_digits_invalid: "Routing Number is invalid (only digits are allowed)",
        routing_number_length_invalid: "Routing number is invalid (must be 9 digits)",
    };
</script>
<script
    src="https://directvisioneyewear.ca/wp-content/plugins/woocommerce-gateway-moneris/vendor/skyverge/wc-plugin-framework/woocommerce/payment-gateway/assets/js/frontend/sv-wc-payment-gateway-payment-form.min.js?ver=5.5.1"
    id="sv-wc-payment-gateway-payment-form-js"
></script>
<script src="https://directvisioneyewear.ca/wp-includes/js/underscore.min.js?ver=1.8.3" id="underscore-js"></script>
<script id="wp-util-js-extra">
    var _wpUtilSettings = { ajax: { url: "\/wp-admin\/admin-ajax.php" } };
</script>
<script src="https://directvisioneyewear.ca/wp-includes/js/wp-util.min.js?ver=5.5.5" id="wp-util-js"></script>
<script id="woo-variation-swatches-js-extra">
    var woo_variation_swatches_options = { is_product_page: "1" };
</script>
<script src="https://directvisioneyewear.ca/wp-content/plugins/woo-variation-swatches/assets/js/frontend.min.js?ver=1.0.85" id="woo-variation-swatches-js"></script>
<script src="https://directvisioneyewear.ca/wp-content/plugins/bb-plugin/js/jquery.magnificpopup.min.js?ver=2.4.0.5" id="jquery-magnificpopup-js"></script>
<script src="https://directvisioneyewear.ca/wp-content/plugins/bb-plugin/js/jquery.fitvids.min.js?ver=1.2" id="jquery-fitvids-js"></script>
<script id="fl-automator-js-extra">
    var themeopts = { medium_breakpoint: "1024", mobile_breakpoint: "768" };
</script>
<script src="https://directvisioneyewear.ca/wp-content/themes/bb-theme/js/theme.min.js?ver=1.7.7" id="fl-automator-js"></script>
<script src="https://directvisioneyewear.ca/wp-includes/js/jquery/ui/core.min.js?ver=1.11.4" id="jquery-ui-core-js"></script>
<script src="https://directvisioneyewear.ca/wp-includes/js/jquery/ui/datepicker.min.js?ver=1.11.4" id="jquery-ui-datepicker-js"></script>
<script id="script-prescription-js-extra">
    var login_check = { is_logged_in: "", is_wrap_sunglasses: "" };
</script>
<script src="https://directvisioneyewear.ca/wp-content/themes/bb-theme-child/assets/js/prescription-validation-script.js?ver=1603277315" id="script-prescription-js"></script>
<script src="https://directvisioneyewear.ca/wp-content/themes/bb-theme-child/assets/js/composite-products-scripts.js?ver=1602168014" id="scripts-js"></script>
<script src="https://directvisioneyewear.ca/wp-content/themes/bb-theme-child/assets/js/scripts.js?ver=1608805321" id="pd-script-js"></script>
<script src="https://directvisioneyewear.ca/wp-includes/js/wp-embed.min.js?ver=5.5.5" id="wp-embed-js"></script>
<script src="https://directvisioneyewear.ca/wp-includes/js/backbone.min.js?ver=1.4.0" id="backbone-js"></script>
<script id="wc-add-to-cart-variation-js-extra">
    var wc_add_to_cart_variation_params = {
        wc_ajax_url: "\/?wc-ajax=%%endpoint%%",
        i18n_no_matching_variations_text: "Sorry, no products matched your selection. Please choose a different combination.",
        i18n_make_a_selection_text: "Please select some product options before adding this product to your cart.",
        i18n_unavailable_text: "Sorry, this product is unavailable. Please choose a different combination.",
    };
</script>
<script src="https://directvisioneyewear.ca/wp-content/plugins/woocommerce/assets/js/frontend/add-to-cart-variation.min.js?ver=4.5.2" id="wc-add-to-cart-variation-js"></script>
<script id="wc-add-to-cart-bundle-js-extra">
    var wc_bundle_params = {
        i18n_free: "Free!",
        i18n_total: "Total: ",
        i18n_subtotal: "Subtotal: ",
        i18n_price_format: "%t%p%s",
        i18n_strikeout_price_string: "<del>%f<\/del> <ins>%t<\/ins>",
        i18n_partially_out_of_stock: "Insufficient stock",
        i18n_partially_on_backorder: "Available on backorder",
        i18n_select_options: "To continue, please choose product options\u2026",
        i18n_select_options_for: "To continue, please choose %s options\u2026",
        i18n_string_list_item: '"%s"',
        i18n_string_list_sep: "%s, %v",
        i18n_string_list_last_sep: "%s and %v",
        i18n_qty_string: " \u00d7 %s",
        i18n_optional_string: " \u2014 %s",
        i18n_optional: "optional",
        i18n_contents: "Includes",
        i18n_title_meta_string: "%t \u2013 %m",
        i18n_title_string: '<span class="item_title">%t<\/span><span class="item_qty">%q<\/span><span class="item_suffix">%o<\/span>',
        i18n_unavailable_text: "This product is currently unavailable.",
        i18n_validation_alert: "Please resolve all pending configuration issues before adding this product to your cart.",
        i18n_zero_qty_error: "Please choose at least 1 item.",
        currency_symbol: "$",
        currency_position: "left",
        currency_format_num_decimals: "2",
        currency_format_decimal_sep: ".",
        currency_format_thousand_sep: ",",
        currency_format_trim_zeros: "no",
        price_display_suffix: "",
        prices_include_tax: "no",
        tax_display_shop: "excl",
        calc_taxes: "yes",
        photoswipe_enabled: "yes",
        force_min_max_qty_input: "yes",
    };
</script>
<script src="https://directvisioneyewear.ca/wp-content/plugins/woocommerce-product-bundles/assets/js/frontend/add-to-cart-bundle.min.js?ver=6.2.3" id="wc-add-to-cart-bundle-js"></script>
<script id="wc-add-to-cart-composite-js-extra">
    var wc_composite_params = {
        small_width_threshold: "480",
        full_width_threshold: "480",
        legacy_width_threshold: "0",
        scroll_viewport_top_offset: "50",
        i18n_strikeout_price_string: "<del>%f<\/del> <ins>%t<\/ins>",
        i18n_price_format: "%p%s",
        i18n_price_signed: "%s%p",
        i18n_price_string: "%p %q %d",
        i18n_price_range_string_plain: "%f to %t",
        i18n_price_range_string_absolute: "%f \u2013 %t",
        i18n_price_range_string: "%f to %t",
        i18n_price_from_string_plain: "from %p;",
        i18n_price_from_string: "From: %p",
        i18n_qty_string: " \u00d7 %s",
        i18n_per_unit_string: '<span class="component_option_each">each<\/span>',
        i18n_discount_string: "(%s% off)",
        i18n_title_string: "%t%q%p",
        i18n_selected_product_string: "%t%m",
        i18n_free: "Free!",
        i18n_total: "Total: ",
        i18n_subtotal: "Subtotal: ",
        i18n_no_options: "No options available\u2026",
        i18n_no_selection: "No selection",
        i18n_no_option: "No %s",
        i18n_dropdown_title_price: "%t \u00a0\u2013\u00a0 %p",
        i18n_dropdown_title_relative_price: "%t: \u00a0%p",
        i18n_configure_option_button: "Select options",
        i18n_select_option_button: "Select",
        i18n_select_option_button_label: "Select %s",
        i18n_configure_option_button_label: "Select %s options",
        i18n_select_option: "Choose an option",
        i18n_previous_step: "%s",
        i18n_next_step: "%s",
        i18n_previous_step_label: "Go to %s",
        i18n_next_step_label: "Go to %s",
        i18n_final_step: "Review Selections",
        i18n_reset_selection: "Reset selection",
        i18n_clear_selection: "Clear selection",
        i18n_validation_issues_for: '<span class="msg-source">%c<\/span> \u2192 <span class="msg-content">%e<\/span>',
        i18n_validation_issues: "Please resolve all pending configuration issues before adding this product to your cart.",
        i18n_item_unavailable_text: "The selected item cannot be purchased at the moment.",
        i18n_unavailable_text: "This product cannot be purchased at the moment.",
        i18n_select_component_option: "Please choose an option to continue\u2026",
        i18n_select_component_option_for: "Please choose an option.",
        i18n_selected_product_invalid: "The chosen option is incompatible with your previous selections.",
        i18n_selected_product_options_invalid: "The chosen product options are incompatible with your previous selections.",
        i18n_selected_product_stock_insufficient: "The selected option does not have enough stock. Please choose another option to continue\u2026",
        i18n_select_product_options: "Please choose product options to continue\u2026",
        i18n_select_product_options_for: "Please choose product options.",
        i18n_select_product_addons: "Please configure all required product fields to continue\u2026",
        i18n_select_product_addons_for: "Please configure all required product fields.",
        i18n_summary_empty_component: "Select option",
        i18n_summary_pending_component: "Select options",
        i18n_summary_configured_component: "Edit",
        i18n_summary_static_component: "View",
        i18n_summary_action_label: "%a %c",
        i18n_insufficient_stock: '<p class="stock out-of-stock insufficient-stock">Insufficient stock \u2192 %s<\/p>',
        i18n_comma_sep: "%s, %v",
        i18n_reload_threshold_exceeded: 'Loading "%s" options is taking a bit longer than usual. Would you like to keep trying?',
        i18n_step_not_accessible: 'The configuration step you have requested to view ("%s") is currently not accessible.',
        i18n_page_of_pages: "Page %p of %t",
        i18n_loading_options: '<span class="source">%s<\/span> \u2192 updating options\u2026',
        i18n_selection_request_timeout: "Your selection could not be updated. If the issue persists, please refresh the page and try again.",
        currency_symbol: "$",
        currency_position: "left",
        currency_format_num_decimals: "2",
        currency_format_decimal_sep: ".",
        currency_format_thousand_sep: ",",
        currency_format_trim_zeros: "no",
        script_debug_level: [],
        show_quantity_buttons: "no",
        is_pao_installed: "yes",
        relocated_content_reset_on_return: "yes",
        is_wc_version_gte_2_3: "yes",
        is_wc_version_gte_2_4: "yes",
        is_wc_version_gte_2_7: "yes",
        use_wc_ajax: "yes",
        price_display_suffix: "",
        prices_include_tax: "no",
        tax_display_shop: "excl",
        calc_taxes: "yes",
        photoswipe_enabled: "yes",
        empty_product_data: { price: 0, regular_price: 0, product_type: "none", product_html: '<div class="component_data" style="display:none;"><\/div>\n' },
        force_min_max_qty_input: "yes",
        accessible_focus_enabled: "yes",
    };
</script>
<script src="https://directvisioneyewear.ca/wp-content/plugins/woocommerce-composite-products/assets/js/frontend/add-to-cart-composite.min.js?ver=6.2.2" id="wc-add-to-cart-composite-js"></script>
<script src="https://directvisioneyewear.ca/wp-content/plugins/woocommerce/assets/js/accounting/accounting.min.js?ver=0.4.2" id="accounting-js"></script>
<script id="woocommerce-addons-js-extra">
    var woocommerce_addons_params = {
        price_display_suffix: "",
        tax_enabled: "1",
        price_include_tax: "",
        display_include_tax: "",
        ajax_url: "\/wp-admin\/admin-ajax.php",
        i18n_sub_total: "Subtotal",
        i18n_remaining: "characters remaining",
        currency_format_num_decimals: "2",
        currency_format_symbol: "$",
        currency_format_decimal_sep: ".",
        currency_format_thousand_sep: ",",
        trim_trailing_zeros: "",
        is_bookings: "",
        trim_user_input_characters: "1000",
        quantity_symbol: "x ",
        currency_format: "%s%v",
    };
    var woocommerce_addons_params = {
        price_display_suffix: "",
        tax_enabled: "1",
        price_include_tax: "",
        display_include_tax: "",
        ajax_url: "\/wp-admin\/admin-ajax.php",
        i18n_sub_total: "Subtotal",
        i18n_remaining: "characters remaining",
        currency_format_num_decimals: "2",
        currency_format_symbol: "$",
        currency_format_decimal_sep: ".",
        currency_format_thousand_sep: ",",
        trim_trailing_zeros: "",
        is_bookings: "",
        trim_user_input_characters: "1000",
        quantity_symbol: "x ",
        currency_format: "%s%v",
    };
    var woocommerce_addons_params = {
        price_display_suffix: "",
        tax_enabled: "1",
        price_include_tax: "",
        display_include_tax: "",
        ajax_url: "\/wp-admin\/admin-ajax.php",
        i18n_sub_total: "Subtotal",
        i18n_remaining: "characters remaining",
        currency_format_num_decimals: "2",
        currency_format_symbol: "$",
        currency_format_decimal_sep: ".",
        currency_format_thousand_sep: ",",
        trim_trailing_zeros: "",
        is_bookings: "",
        trim_user_input_characters: "1000",
        quantity_symbol: "x ",
        currency_format: "%s%v",
    };
    var woocommerce_addons_params = {
        price_display_suffix: "",
        tax_enabled: "1",
        price_include_tax: "",
        display_include_tax: "",
        ajax_url: "\/wp-admin\/admin-ajax.php",
        i18n_sub_total: "Subtotal",
        i18n_remaining: "characters remaining",
        currency_format_num_decimals: "2",
        currency_format_symbol: "$",
        currency_format_decimal_sep: ".",
        currency_format_thousand_sep: ",",
        trim_trailing_zeros: "",
        is_bookings: "",
        trim_user_input_characters: "1000",
        quantity_symbol: "x ",
        currency_format: "%s%v",
    };
    var woocommerce_addons_params = {
        price_display_suffix: "",
        tax_enabled: "1",
        price_include_tax: "",
        display_include_tax: "",
        ajax_url: "\/wp-admin\/admin-ajax.php",
        i18n_sub_total: "Subtotal",
        i18n_remaining: "characters remaining",
        currency_format_num_decimals: "2",
        currency_format_symbol: "$",
        currency_format_decimal_sep: ".",
        currency_format_thousand_sep: ",",
        trim_trailing_zeros: "",
        is_bookings: "",
        trim_user_input_characters: "1000",
        quantity_symbol: "x ",
        currency_format: "%s%v",
    };
    var woocommerce_addons_params = {
        price_display_suffix: "",
        tax_enabled: "1",
        price_include_tax: "",
        display_include_tax: "",
        ajax_url: "\/wp-admin\/admin-ajax.php",
        i18n_sub_total: "Subtotal",
        i18n_remaining: "characters remaining",
        currency_format_num_decimals: "2",
        currency_format_symbol: "$",
        currency_format_decimal_sep: ".",
        currency_format_thousand_sep: ",",
        trim_trailing_zeros: "",
        is_bookings: "",
        trim_user_input_characters: "1000",
        quantity_symbol: "x ",
        currency_format: "%s%v",
    };
    var woocommerce_addons_params = {
        price_display_suffix: "",
        tax_enabled: "1",
        price_include_tax: "",
        display_include_tax: "",
        ajax_url: "\/wp-admin\/admin-ajax.php",
        i18n_sub_total: "Subtotal",
        i18n_remaining: "characters remaining",
        currency_format_num_decimals: "2",
        currency_format_symbol: "$",
        currency_format_decimal_sep: ".",
        currency_format_thousand_sep: ",",
        trim_trailing_zeros: "",
        is_bookings: "",
        trim_user_input_characters: "1000",
        quantity_symbol: "x ",
        currency_format: "%s%v",
    };
    var woocommerce_addons_params = {
        price_display_suffix: "",
        tax_enabled: "1",
        price_include_tax: "",
        display_include_tax: "",
        ajax_url: "\/wp-admin\/admin-ajax.php",
        i18n_sub_total: "Subtotal",
        i18n_remaining: "characters remaining",
        currency_format_num_decimals: "2",
        currency_format_symbol: "$",
        currency_format_decimal_sep: ".",
        currency_format_thousand_sep: ",",
        trim_trailing_zeros: "",
        is_bookings: "",
        trim_user_input_characters: "1000",
        quantity_symbol: "x ",
        currency_format: "%s%v",
    };
    var woocommerce_addons_params = {
        price_display_suffix: "",
        tax_enabled: "1",
        price_include_tax: "",
        display_include_tax: "",
        ajax_url: "\/wp-admin\/admin-ajax.php",
        i18n_sub_total: "Subtotal",
        i18n_remaining: "characters remaining",
        currency_format_num_decimals: "2",
        currency_format_symbol: "$",
        currency_format_decimal_sep: ".",
        currency_format_thousand_sep: ",",
        trim_trailing_zeros: "",
        is_bookings: "",
        trim_user_input_characters: "1000",
        quantity_symbol: "x ",
        currency_format: "%s%v",
    };
    var woocommerce_addons_params = {
        price_display_suffix: "",
        tax_enabled: "1",
        price_include_tax: "",
        display_include_tax: "",
        ajax_url: "\/wp-admin\/admin-ajax.php",
        i18n_sub_total: "Subtotal",
        i18n_remaining: "characters remaining",
        currency_format_num_decimals: "2",
        currency_format_symbol: "$",
        currency_format_decimal_sep: ".",
        currency_format_thousand_sep: ",",
        trim_trailing_zeros: "",
        is_bookings: "",
        trim_user_input_characters: "1000",
        quantity_symbol: "x ",
        currency_format: "%s%v",
    };
    var woocommerce_addons_params = {
        price_display_suffix: "",
        tax_enabled: "1",
        price_include_tax: "",
        display_include_tax: "",
        ajax_url: "\/wp-admin\/admin-ajax.php",
        i18n_sub_total: "Subtotal",
        i18n_remaining: "characters remaining",
        currency_format_num_decimals: "2",
        currency_format_symbol: "$",
        currency_format_decimal_sep: ".",
        currency_format_thousand_sep: ",",
        trim_trailing_zeros: "",
        is_bookings: "",
        trim_user_input_characters: "1000",
        quantity_symbol: "x ",
        currency_format: "%s%v",
    };
    var woocommerce_addons_params = {
        price_display_suffix: "",
        tax_enabled: "1",
        price_include_tax: "",
        display_include_tax: "",
        ajax_url: "\/wp-admin\/admin-ajax.php",
        i18n_sub_total: "Subtotal",
        i18n_remaining: "characters remaining",
        currency_format_num_decimals: "2",
        currency_format_symbol: "$",
        currency_format_decimal_sep: ".",
        currency_format_thousand_sep: ",",
        trim_trailing_zeros: "",
        is_bookings: "",
        trim_user_input_characters: "1000",
        quantity_symbol: "x ",
        currency_format: "%s%v",
    };
    var woocommerce_addons_params = {
        price_display_suffix: "",
        tax_enabled: "1",
        price_include_tax: "",
        display_include_tax: "",
        ajax_url: "\/wp-admin\/admin-ajax.php",
        i18n_sub_total: "Subtotal",
        i18n_remaining: "characters remaining",
        currency_format_num_decimals: "2",
        currency_format_symbol: "$",
        currency_format_decimal_sep: ".",
        currency_format_thousand_sep: ",",
        trim_trailing_zeros: "",
        is_bookings: "",
        trim_user_input_characters: "1000",
        quantity_symbol: "x ",
        currency_format: "%s%v",
    };
    var woocommerce_addons_params = {
        price_display_suffix: "",
        tax_enabled: "1",
        price_include_tax: "",
        display_include_tax: "",
        ajax_url: "\/wp-admin\/admin-ajax.php",
        i18n_sub_total: "Subtotal",
        i18n_remaining: "characters remaining",
        currency_format_num_decimals: "2",
        currency_format_symbol: "$",
        currency_format_decimal_sep: ".",
        currency_format_thousand_sep: ",",
        trim_trailing_zeros: "",
        is_bookings: "",
        trim_user_input_characters: "1000",
        quantity_symbol: "x ",
        currency_format: "%s%v",
    };
    var woocommerce_addons_params = {
        price_display_suffix: "",
        tax_enabled: "1",
        price_include_tax: "",
        display_include_tax: "",
        ajax_url: "\/wp-admin\/admin-ajax.php",
        i18n_sub_total: "Subtotal",
        i18n_remaining: "characters remaining",
        currency_format_num_decimals: "2",
        currency_format_symbol: "$",
        currency_format_decimal_sep: ".",
        currency_format_thousand_sep: ",",
        trim_trailing_zeros: "",
        is_bookings: "",
        trim_user_input_characters: "1000",
        quantity_symbol: "x ",
        currency_format: "%s%v",
    };
    var woocommerce_addons_params = {
        price_display_suffix: "",
        tax_enabled: "1",
        price_include_tax: "",
        display_include_tax: "",
        ajax_url: "\/wp-admin\/admin-ajax.php",
        i18n_sub_total: "Subtotal",
        i18n_remaining: "characters remaining",
        currency_format_num_decimals: "2",
        currency_format_symbol: "$",
        currency_format_decimal_sep: ".",
        currency_format_thousand_sep: ",",
        trim_trailing_zeros: "",
        is_bookings: "",
        trim_user_input_characters: "1000",
        quantity_symbol: "x ",
        currency_format: "%s%v",
    };
    var woocommerce_addons_params = {
        price_display_suffix: "",
        tax_enabled: "1",
        price_include_tax: "",
        display_include_tax: "",
        ajax_url: "\/wp-admin\/admin-ajax.php",
        i18n_sub_total: "Subtotal",
        i18n_remaining: "characters remaining",
        currency_format_num_decimals: "2",
        currency_format_symbol: "$",
        currency_format_decimal_sep: ".",
        currency_format_thousand_sep: ",",
        trim_trailing_zeros: "",
        is_bookings: "",
        trim_user_input_characters: "1000",
        quantity_symbol: "x ",
        currency_format: "%s%v",
    };
    var woocommerce_addons_params = {
        price_display_suffix: "",
        tax_enabled: "1",
        price_include_tax: "",
        display_include_tax: "",
        ajax_url: "\/wp-admin\/admin-ajax.php",
        i18n_sub_total: "Subtotal",
        i18n_remaining: "characters remaining",
        currency_format_num_decimals: "2",
        currency_format_symbol: "$",
        currency_format_decimal_sep: ".",
        currency_format_thousand_sep: ",",
        trim_trailing_zeros: "",
        is_bookings: "",
        trim_user_input_characters: "1000",
        quantity_symbol: "x ",
        currency_format: "%s%v",
    };
    var woocommerce_addons_params = {
        price_display_suffix: "",
        tax_enabled: "1",
        price_include_tax: "",
        display_include_tax: "",
        ajax_url: "\/wp-admin\/admin-ajax.php",
        i18n_sub_total: "Subtotal",
        i18n_remaining: "characters remaining",
        currency_format_num_decimals: "2",
        currency_format_symbol: "$",
        currency_format_decimal_sep: ".",
        currency_format_thousand_sep: ",",
        trim_trailing_zeros: "",
        is_bookings: "",
        trim_user_input_characters: "1000",
        quantity_symbol: "x ",
        currency_format: "%s%v",
    };
    var woocommerce_addons_params = {
        price_display_suffix: "",
        tax_enabled: "1",
        price_include_tax: "",
        display_include_tax: "",
        ajax_url: "\/wp-admin\/admin-ajax.php",
        i18n_sub_total: "Subtotal",
        i18n_remaining: "characters remaining",
        currency_format_num_decimals: "2",
        currency_format_symbol: "$",
        currency_format_decimal_sep: ".",
        currency_format_thousand_sep: ",",
        trim_trailing_zeros: "",
        is_bookings: "",
        trim_user_input_characters: "1000",
        quantity_symbol: "x ",
        currency_format: "%s%v",
    };
    var woocommerce_addons_params = {
        price_display_suffix: "",
        tax_enabled: "1",
        price_include_tax: "",
        display_include_tax: "",
        ajax_url: "\/wp-admin\/admin-ajax.php",
        i18n_sub_total: "Subtotal",
        i18n_remaining: "characters remaining",
        currency_format_num_decimals: "2",
        currency_format_symbol: "$",
        currency_format_decimal_sep: ".",
        currency_format_thousand_sep: ",",
        trim_trailing_zeros: "",
        is_bookings: "",
        trim_user_input_characters: "1000",
        quantity_symbol: "x ",
        currency_format: "%s%v",
    };
</script>
<script src="https://directvisioneyewear.ca/wp-content/plugins/woocommerce-product-addons/assets/js/addons.min.js?ver=3.0.31" id="woocommerce-addons-js"></script>
<!-- WooCommerce JavaScript -->
<script type="text/javascript">
    jQuery(function ($) {
        $(".single_add_to_cart_button").on("click", function () {
            gtag("event", "add_to_cart", { event_category: "ecommerce", event_label: "#394", items: [{ id: "#394", name: "Prescription Lenses", quantity: $("input.qty").val() ? $("input.qty").val() : "1" }] });
        });

        gtag("event", "view_item", {
            items: [
                {
                    id: "#394",
                    name: "Prescription Lenses",
                    category: "Prescription",
                    price: "0",
                },
            ],
        });

        $(".add_to_cart_button:not(.product_type_variable, .product_type_grouped)").on("click", function () {
            gtag("event", "add_to_cart", {
                event_category: "ecommerce",
                event_label: $(this).data("product_sku") ? $(this).data("product_sku") : "#" + $(this).data("product_id"),
                items: [{ id: $(this).data("product_sku") ? $(this).data("product_sku") : "#" + $(this).data("product_id"), quantity: $(this).data("quantity") }],
            });
        });
    });
</script>

<script type="text/javascript">
    function tryOn(a) {
        jQuery("#my-fitmix-container").remove();
        jQuery("#my-fitmix-wrapper").append('<div id="my-fitmix-container"></div>');
        var myFitmixWidget = FitMix.createWidget("my-fitmix-container", { apiKey: "3p0n1cO5EoNQ0yQdqcBPHkZdgiojZgQTXoDjFDH6", sku: a, liveAutostart: false }, function () {
            console.log("myFitmixWidget creation complete !");
        });
    }
</script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.nicescroll/3.7.6/jquery.nicescroll.min.js" integrity="sha256-LJkWYMcB83+zN8VO3EnSoNYHiBo93miOF47ZfsPSNDQ=" crossorigin="anonymous"></script>

