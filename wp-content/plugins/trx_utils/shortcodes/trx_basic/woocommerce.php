<?php


if (function_exists('diveit_exists_visual_composer') && diveit_exists_visual_composer())
    add_action('diveit_action_shortcodes_list', 			'diveit_woocommerce_reg_shortcodes', 20);
    add_action('diveit_action_shortcodes_list_vc',	'diveit_woocommerce_reg_shortcodes_vc', 20);



// Register shortcodes to the internal builder
//------------------------------------------------------------------------
if ( !function_exists( 'diveit_woocommerce_reg_shortcodes' ) ) {
    function diveit_woocommerce_reg_shortcodes() {

        // WooCommerce - Cart
        diveit_sc_map("woocommerce_cart", array(
                "title" => esc_html__("Woocommerce: Cart", 'trx_utils'),
                "desc" => wp_kses_data( __("WooCommerce shortcode: show Cart page", 'trx_utils') ),
                "decorate" => false,
                "container" => false,
                "params" => array()
            )
        );

        // WooCommerce - Checkout
        diveit_sc_map("woocommerce_checkout", array(
                "title" => esc_html__("Woocommerce: Checkout", 'trx_utils'),
                "desc" => wp_kses_data( __("WooCommerce shortcode: show Checkout page", 'trx_utils') ),
                "decorate" => false,
                "container" => false,
                "params" => array()
            )
        );

        // WooCommerce - My Account
        diveit_sc_map("woocommerce_my_account", array(
                "title" => esc_html__("Woocommerce: My Account", 'trx_utils'),
                "desc" => wp_kses_data( __("WooCommerce shortcode: show My Account page", 'trx_utils') ),
                "decorate" => false,
                "container" => false,
                "params" => array()
            )
        );

        // WooCommerce - Order Tracking
        diveit_sc_map("woocommerce_order_tracking", array(
                "title" => esc_html__("Woocommerce: Order Tracking", 'trx_utils'),
                "desc" => wp_kses_data( __("WooCommerce shortcode: show Order Tracking page", 'trx_utils') ),
                "decorate" => false,
                "container" => false,
                "params" => array()
            )
        );

        // WooCommerce - Shop Messages
        diveit_sc_map("shop_messages", array(
                "title" => esc_html__("Woocommerce: Shop Messages", 'trx_utils'),
                "desc" => wp_kses_data( __("WooCommerce shortcode: show shop messages", 'trx_utils') ),
                "decorate" => false,
                "container" => false,
                "params" => array()
            )
        );

        // WooCommerce - Product Page
        diveit_sc_map("product_page", array(
                "title" => esc_html__("Woocommerce: Product Page", 'trx_utils'),
                "desc" => wp_kses_data( __("WooCommerce shortcode: display single product page", 'trx_utils') ),
                "decorate" => false,
                "container" => false,
                "params" => array(
                    "sku" => array(
                        "title" => esc_html__("SKU", 'trx_utils'),
                        "desc" => wp_kses_data( __("SKU code of displayed product", 'trx_utils') ),
                        "value" => "",
                        "type" => "text"
                    ),
                    "id" => array(
                        "title" => esc_html__("ID", 'trx_utils'),
                        "desc" => wp_kses_data( __("ID of displayed product", 'trx_utils') ),
                        "value" => "",
                        "type" => "text"
                    ),
                    "posts_per_page" => array(
                        "title" => esc_html__("Number", 'trx_utils'),
                        "desc" => wp_kses_data( __("How many products showed", 'trx_utils') ),
                        "value" => "1",
                        "min" => 1,
                        "type" => "spinner"
                    ),
                    "post_type" => array(
                        "title" => esc_html__("Post type", 'trx_utils'),
                        "desc" => wp_kses_data( __("Post type for the WP query (leave 'product')", 'trx_utils') ),
                        "value" => "product",
                        "type" => "text"
                    ),
                    "post_status" => array(
                        "title" => esc_html__("Post status", 'trx_utils'),
                        "desc" => wp_kses_data( __("Display posts only with this status", 'trx_utils') ),
                        "value" => "publish",
                        "type" => "select",
                        "options" => array(
                            "publish" => esc_html__('Publish', 'trx_utils'),
                            "protected" => esc_html__('Protected', 'trx_utils'),
                            "private" => esc_html__('Private', 'trx_utils'),
                            "pending" => esc_html__('Pending', 'trx_utils'),
                            "draft" => esc_html__('Draft', 'trx_utils')
                        )
                    )
                )
            )
        );

        // WooCommerce - Product
        diveit_sc_map("product", array(
                "title" => esc_html__("Woocommerce: Product", 'trx_utils'),
                "desc" => wp_kses_data( __("WooCommerce shortcode: display one product", 'trx_utils') ),
                "decorate" => false,
                "container" => false,
                "params" => array(
                    "sku" => array(
                        "title" => esc_html__("SKU", 'trx_utils'),
                        "desc" => wp_kses_data( __("SKU code of displayed product", 'trx_utils') ),
                        "value" => "",
                        "type" => "text"
                    ),
                    "id" => array(
                        "title" => esc_html__("ID", 'trx_utils'),
                        "desc" => wp_kses_data( __("ID of displayed product", 'trx_utils') ),
                        "value" => "",
                        "type" => "text"
                    )
                )
            )
        );

        // WooCommerce - Best Selling Products
        diveit_sc_map("best_selling_products", array(
                "title" => esc_html__("Woocommerce: Best Selling Products", 'trx_utils'),
                "desc" => wp_kses_data( __("WooCommerce shortcode: show best selling products", 'trx_utils') ),
                "decorate" => false,
                "container" => false,
                "params" => array(
                    "per_page" => array(
                        "title" => esc_html__("Number", 'trx_utils'),
                        "desc" => wp_kses_data( __("How many products showed", 'trx_utils') ),
                        "value" => 4,
                        "min" => 1,
                        "type" => "spinner"
                    ),
                    "columns" => array(
                        "title" => esc_html__("Columns", 'trx_utils'),
                        "desc" => wp_kses_data( __("How many columns per row use for products output", 'trx_utils') ),
                        "value" => 4,
                        "min" => 2,
                        "max" => 4,
                        "type" => "spinner"
                    )
                )
            )
        );

        // WooCommerce - Recent Products
        diveit_sc_map("recent_products", array(
                "title" => esc_html__("Woocommerce: Recent Products", 'trx_utils'),
                "desc" => wp_kses_data( __("WooCommerce shortcode: show recent products", 'trx_utils') ),
                "decorate" => false,
                "container" => false,
                "params" => array(
                    "per_page" => array(
                        "title" => esc_html__("Number", 'trx_utils'),
                        "desc" => wp_kses_data( __("How many products showed", 'trx_utils') ),
                        "value" => 4,
                        "min" => 1,
                        "type" => "spinner"
                    ),
                    "columns" => array(
                        "title" => esc_html__("Columns", 'trx_utils'),
                        "desc" => wp_kses_data( __("How many columns per row use for products output", 'trx_utils') ),
                        "value" => 4,
                        "min" => 2,
                        "max" => 4,
                        "type" => "spinner"
                    ),
                    "orderby" => array(
                        "title" => esc_html__("Order by", 'trx_utils'),
                        "desc" => wp_kses_data( __("Sorting order for products output", 'trx_utils') ),
                        "value" => "date",
                        "type" => "select",
                        "options" => array(
                            "date" => esc_html__('Date', 'trx_utils'),
                            "title" => esc_html__('Title', 'trx_utils')
                        )
                    ),
                    "order" => array(
                        "title" => esc_html__("Order", 'trx_utils'),
                        "desc" => wp_kses_data( __("Sorting order for products output", 'trx_utils') ),
                        "value" => "desc",
                        "type" => "switch",
                        "size" => "big",
                        "options" => diveit_get_sc_param('ordering')
                    )
                )
            )
        );

        // WooCommerce - Related Products
        diveit_sc_map("related_products", array(
                "title" => esc_html__("Woocommerce: Related Products", 'trx_utils'),
                "desc" => wp_kses_data( __("WooCommerce shortcode: show related products", 'trx_utils') ),
                "decorate" => false,
                "container" => false,
                "params" => array(
                    "posts_per_page" => array(
                        "title" => esc_html__("Number", 'trx_utils'),
                        "desc" => wp_kses_data( __("How many products showed", 'trx_utils') ),
                        "value" => 4,
                        "min" => 1,
                        "type" => "spinner"
                    ),
                    "columns" => array(
                        "title" => esc_html__("Columns", 'trx_utils'),
                        "desc" => wp_kses_data( __("How many columns per row use for products output", 'trx_utils') ),
                        "value" => 4,
                        "min" => 2,
                        "max" => 4,
                        "type" => "spinner"
                    ),
                    "orderby" => array(
                        "title" => esc_html__("Order by", 'trx_utils'),
                        "desc" => wp_kses_data( __("Sorting order for products output", 'trx_utils') ),
                        "value" => "date",
                        "type" => "select",
                        "options" => array(
                            "date" => esc_html__('Date', 'trx_utils'),
                            "title" => esc_html__('Title', 'trx_utils')
                        )
                    )
                )
            )
        );

        // WooCommerce - Featured Products
        diveit_sc_map("featured_products", array(
                "title" => esc_html__("Woocommerce: Featured Products", 'trx_utils'),
                "desc" => wp_kses_data( __("WooCommerce shortcode: show featured products", 'trx_utils') ),
                "decorate" => false,
                "container" => false,
                "params" => array(
                    "per_page" => array(
                        "title" => esc_html__("Number", 'trx_utils'),
                        "desc" => wp_kses_data( __("How many products showed", 'trx_utils') ),
                        "value" => 4,
                        "min" => 1,
                        "type" => "spinner"
                    ),
                    "columns" => array(
                        "title" => esc_html__("Columns", 'trx_utils'),
                        "desc" => wp_kses_data( __("How many columns per row use for products output", 'trx_utils') ),
                        "value" => 4,
                        "min" => 2,
                        "max" => 4,
                        "type" => "spinner"
                    ),
                    "orderby" => array(
                        "title" => esc_html__("Order by", 'trx_utils'),
                        "desc" => wp_kses_data( __("Sorting order for products output", 'trx_utils') ),
                        "value" => "date",
                        "type" => "select",
                        "options" => array(
                            "date" => esc_html__('Date', 'trx_utils'),
                            "title" => esc_html__('Title', 'trx_utils')
                        )
                    ),
                    "order" => array(
                        "title" => esc_html__("Order", 'trx_utils'),
                        "desc" => wp_kses_data( __("Sorting order for products output", 'trx_utils') ),
                        "value" => "desc",
                        "type" => "switch",
                        "size" => "big",
                        "options" => diveit_get_sc_param('ordering')
                    )
                )
            )
        );

        // WooCommerce - Top Rated Products
        diveit_sc_map("featured_products", array(
                "title" => esc_html__("Woocommerce: Top Rated Products", 'trx_utils'),
                "desc" => wp_kses_data( __("WooCommerce shortcode: show top rated products", 'trx_utils') ),
                "decorate" => false,
                "container" => false,
                "params" => array(
                    "per_page" => array(
                        "title" => esc_html__("Number", 'trx_utils'),
                        "desc" => wp_kses_data( __("How many products showed", 'trx_utils') ),
                        "value" => 4,
                        "min" => 1,
                        "type" => "spinner"
                    ),
                    "columns" => array(
                        "title" => esc_html__("Columns", 'trx_utils'),
                        "desc" => wp_kses_data( __("How many columns per row use for products output", 'trx_utils') ),
                        "value" => 4,
                        "min" => 2,
                        "max" => 4,
                        "type" => "spinner"
                    ),
                    "orderby" => array(
                        "title" => esc_html__("Order by", 'trx_utils'),
                        "desc" => wp_kses_data( __("Sorting order for products output", 'trx_utils') ),
                        "value" => "date",
                        "type" => "select",
                        "options" => array(
                            "date" => esc_html__('Date', 'trx_utils'),
                            "title" => esc_html__('Title', 'trx_utils')
                        )
                    ),
                    "order" => array(
                        "title" => esc_html__("Order", 'trx_utils'),
                        "desc" => wp_kses_data( __("Sorting order for products output", 'trx_utils') ),
                        "value" => "desc",
                        "type" => "switch",
                        "size" => "big",
                        "options" => diveit_get_sc_param('ordering')
                    )
                )
            )
        );

        // WooCommerce - Sale Products
        diveit_sc_map("featured_products", array(
                "title" => esc_html__("Woocommerce: Sale Products", 'trx_utils'),
                "desc" => wp_kses_data( __("WooCommerce shortcode: list products on sale", 'trx_utils') ),
                "decorate" => false,
                "container" => false,
                "params" => array(
                    "per_page" => array(
                        "title" => esc_html__("Number", 'trx_utils'),
                        "desc" => wp_kses_data( __("How many products showed", 'trx_utils') ),
                        "value" => 4,
                        "min" => 1,
                        "type" => "spinner"
                    ),
                    "columns" => array(
                        "title" => esc_html__("Columns", 'trx_utils'),
                        "desc" => wp_kses_data( __("How many columns per row use for products output", 'trx_utils') ),
                        "value" => 4,
                        "min" => 2,
                        "max" => 4,
                        "type" => "spinner"
                    ),
                    "orderby" => array(
                        "title" => esc_html__("Order by", 'trx_utils'),
                        "desc" => wp_kses_data( __("Sorting order for products output", 'trx_utils') ),
                        "value" => "date",
                        "type" => "select",
                        "options" => array(
                            "date" => esc_html__('Date', 'trx_utils'),
                            "title" => esc_html__('Title', 'trx_utils')
                        )
                    ),
                    "order" => array(
                        "title" => esc_html__("Order", 'trx_utils'),
                        "desc" => wp_kses_data( __("Sorting order for products output", 'trx_utils') ),
                        "value" => "desc",
                        "type" => "switch",
                        "size" => "big",
                        "options" => diveit_get_sc_param('ordering')
                    )
                )
            )
        );

        // WooCommerce - Product Category
        diveit_sc_map("product_category", array(
                "title" => esc_html__("Woocommerce: Products from category", 'trx_utils'),
                "desc" => wp_kses_data( __("WooCommerce shortcode: list products in specified category(-ies)", 'trx_utils') ),
                "decorate" => false,
                "container" => false,
                "params" => array(
                    "per_page" => array(
                        "title" => esc_html__("Number", 'trx_utils'),
                        "desc" => wp_kses_data( __("How many products showed", 'trx_utils') ),
                        "value" => 4,
                        "min" => 1,
                        "type" => "spinner"
                    ),
                    "columns" => array(
                        "title" => esc_html__("Columns", 'trx_utils'),
                        "desc" => wp_kses_data( __("How many columns per row use for products output", 'trx_utils') ),
                        "value" => 4,
                        "min" => 2,
                        "max" => 4,
                        "type" => "spinner"
                    ),
                    "orderby" => array(
                        "title" => esc_html__("Order by", 'trx_utils'),
                        "desc" => wp_kses_data( __("Sorting order for products output", 'trx_utils') ),
                        "value" => "date",
                        "type" => "select",
                        "options" => array(
                            "date" => esc_html__('Date', 'trx_utils'),
                            "title" => esc_html__('Title', 'trx_utils')
                        )
                    ),
                    "order" => array(
                        "title" => esc_html__("Order", 'trx_utils'),
                        "desc" => wp_kses_data( __("Sorting order for products output", 'trx_utils') ),
                        "value" => "desc",
                        "type" => "switch",
                        "size" => "big",
                        "options" => diveit_get_sc_param('ordering')
                    ),
                    "category" => array(
                        "title" => esc_html__("Categories", 'trx_utils'),
                        "desc" => wp_kses_data( __("Comma separated category slugs", 'trx_utils') ),
                        "value" => '',
                        "type" => "text"
                    ),
                    "operator" => array(
                        "title" => esc_html__("Operator", 'trx_utils'),
                        "desc" => wp_kses_data( __("Categories operator", 'trx_utils') ),
                        "value" => "IN",
                        "type" => "checklist",
                        "size" => "medium",
                        "options" => array(
                            "IN" => esc_html__('IN', 'trx_utils'),
                            "NOT IN" => esc_html__('NOT IN', 'trx_utils'),
                            "AND" => esc_html__('AND', 'trx_utils')
                        )
                    )
                )
            )
        );

        // WooCommerce - Products
        diveit_sc_map("products", array(
                "title" => esc_html__("Woocommerce: Products", 'trx_utils'),
                "desc" => wp_kses_data( __("WooCommerce shortcode: list all products", 'trx_utils') ),
                "decorate" => false,
                "container" => false,
                "params" => array(
                    "skus" => array(
                        "title" => esc_html__("SKUs", 'trx_utils'),
                        "desc" => wp_kses_data( __("Comma separated SKU codes of products", 'trx_utils') ),
                        "value" => "",
                        "type" => "text"
                    ),
                    "ids" => array(
                        "title" => esc_html__("IDs", 'trx_utils'),
                        "desc" => wp_kses_data( __("Comma separated ID of products", 'trx_utils') ),
                        "value" => "",
                        "type" => "text"
                    ),
                    "columns" => array(
                        "title" => esc_html__("Columns", 'trx_utils'),
                        "desc" => wp_kses_data( __("How many columns per row use for products output", 'trx_utils') ),
                        "value" => 4,
                        "min" => 2,
                        "max" => 4,
                        "type" => "spinner"
                    ),
                    "orderby" => array(
                        "title" => esc_html__("Order by", 'trx_utils'),
                        "desc" => wp_kses_data( __("Sorting order for products output", 'trx_utils') ),
                        "value" => "date",
                        "type" => "select",
                        "options" => array(
                            "date" => esc_html__('Date', 'trx_utils'),
                            "title" => esc_html__('Title', 'trx_utils')
                        )
                    ),
                    "order" => array(
                        "title" => esc_html__("Order", 'trx_utils'),
                        "desc" => wp_kses_data( __("Sorting order for products output", 'trx_utils') ),
                        "value" => "desc",
                        "type" => "switch",
                        "size" => "big",
                        "options" => diveit_get_sc_param('ordering')
                    )
                )
            )
        );

        // WooCommerce - Product attribute
        diveit_sc_map("product_attribute", array(
                "title" => esc_html__("Woocommerce: Products by Attribute", 'trx_utils'),
                "desc" => wp_kses_data( __("WooCommerce shortcode: show products with specified attribute", 'trx_utils') ),
                "decorate" => false,
                "container" => false,
                "params" => array(
                    "per_page" => array(
                        "title" => esc_html__("Number", 'trx_utils'),
                        "desc" => wp_kses_data( __("How many products showed", 'trx_utils') ),
                        "value" => 4,
                        "min" => 1,
                        "type" => "spinner"
                    ),
                    "columns" => array(
                        "title" => esc_html__("Columns", 'trx_utils'),
                        "desc" => wp_kses_data( __("How many columns per row use for products output", 'trx_utils') ),
                        "value" => 4,
                        "min" => 2,
                        "max" => 4,
                        "type" => "spinner"
                    ),
                    "orderby" => array(
                        "title" => esc_html__("Order by", 'trx_utils'),
                        "desc" => wp_kses_data( __("Sorting order for products output", 'trx_utils') ),
                        "value" => "date",
                        "type" => "select",
                        "options" => array(
                            "date" => esc_html__('Date', 'trx_utils'),
                            "title" => esc_html__('Title', 'trx_utils')
                        )
                    ),
                    "order" => array(
                        "title" => esc_html__("Order", 'trx_utils'),
                        "desc" => wp_kses_data( __("Sorting order for products output", 'trx_utils') ),
                        "value" => "desc",
                        "type" => "switch",
                        "size" => "big",
                        "options" => diveit_get_sc_param('ordering')
                    ),
                    "attribute" => array(
                        "title" => esc_html__("Attribute", 'trx_utils'),
                        "desc" => wp_kses_data( __("Attribute name", 'trx_utils') ),
                        "value" => "",
                        "type" => "text"
                    ),
                    "filter" => array(
                        "title" => esc_html__("Filter", 'trx_utils'),
                        "desc" => wp_kses_data( __("Attribute value", 'trx_utils') ),
                        "value" => "",
                        "type" => "text"
                    )
                )
            )
        );

        // WooCommerce - Products Categories
        diveit_sc_map("product_categories", array(
                "title" => esc_html__("Woocommerce: Product Categories", 'trx_utils'),
                "desc" => wp_kses_data( __("WooCommerce shortcode: show categories with products", 'trx_utils') ),
                "decorate" => false,
                "container" => false,
                "params" => array(
                    "number" => array(
                        "title" => esc_html__("Number", 'trx_utils'),
                        "desc" => wp_kses_data( __("How many categories showed", 'trx_utils') ),
                        "value" => 4,
                        "min" => 1,
                        "type" => "spinner"
                    ),
                    "columns" => array(
                        "title" => esc_html__("Columns", 'trx_utils'),
                        "desc" => wp_kses_data( __("How many columns per row use for categories output", 'trx_utils') ),
                        "value" => 4,
                        "min" => 2,
                        "max" => 4,
                        "type" => "spinner"
                    ),
                    "orderby" => array(
                        "title" => esc_html__("Order by", 'trx_utils'),
                        "desc" => wp_kses_data( __("Sorting order for products output", 'trx_utils') ),
                        "value" => "date",
                        "type" => "select",
                        "options" => array(
                            "date" => esc_html__('Date', 'trx_utils'),
                            "title" => esc_html__('Title', 'trx_utils')
                        )
                    ),
                    "order" => array(
                        "title" => esc_html__("Order", 'trx_utils'),
                        "desc" => wp_kses_data( __("Sorting order for products output", 'trx_utils') ),
                        "value" => "desc",
                        "type" => "switch",
                        "size" => "big",
                        "options" => diveit_get_sc_param('ordering')
                    ),
                    "parent" => array(
                        "title" => esc_html__("Parent", 'trx_utils'),
                        "desc" => wp_kses_data( __("Parent category slug", 'trx_utils') ),
                        "value" => "",
                        "type" => "text"
                    ),
                    "ids" => array(
                        "title" => esc_html__("IDs", 'trx_utils'),
                        "desc" => wp_kses_data( __("Comma separated ID of products", 'trx_utils') ),
                        "value" => "",
                        "type" => "text"
                    ),
                    "hide_empty" => array(
                        "title" => esc_html__("Hide empty", 'trx_utils'),
                        "desc" => wp_kses_data( __("Hide empty categories", 'trx_utils') ),
                        "value" => "yes",
                        "type" => "switch",
                        "options" => diveit_get_sc_param('yes_no')
                    )
                )
            )
        );
    }
}



// Register shortcodes to the VC builder
//------------------------------------------------------------------------
if ( !function_exists( 'diveit_woocommerce_reg_shortcodes_vc' ) ) {
    function diveit_woocommerce_reg_shortcodes_vc() {

        if (false && function_exists('diveit_exists_woocommerce') && diveit_exists_woocommerce()) {

            // WooCommerce - Cart
            //-------------------------------------------------------------------------------------

            vc_map( array(
                "base" => "woocommerce_cart",
                "name" => esc_html__("Cart", 'trx_utils'),
                "description" => wp_kses_data( __("WooCommerce shortcode: show cart page", 'trx_utils') ),
                "category" => esc_html__('WooCommerce', 'trx_utils'),
                'icon' => 'icon_trx_wooc_cart',
                "class" => "trx_sc_alone trx_sc_woocommerce_cart",
                "content_element" => true,
                "is_container" => false,
                "show_settings_on_create" => false,
                "params" => array(
                    array(
                        "param_name" => "dummy",
                        "heading" => esc_html__("Dummy data", 'trx_utils'),
                        "description" => wp_kses_data( __("Dummy data - not used in shortcodes", 'trx_utils') ),
                        "class" => "",
                        "value" => "",
                        "type" => "textfield"
                    )
                )
            ) );

            class WPBakeryShortCode_Woocommerce_Cart extends Diveit_VC_ShortCodeAlone {}


            // WooCommerce - Checkout
            //-------------------------------------------------------------------------------------

            vc_map( array(
                "base" => "woocommerce_checkout",
                "name" => esc_html__("Checkout", 'trx_utils'),
                "description" => wp_kses_data( __("WooCommerce shortcode: show checkout page", 'trx_utils') ),
                "category" => esc_html__('WooCommerce', 'trx_utils'),
                'icon' => 'icon_trx_wooc_checkout',
                "class" => "trx_sc_alone trx_sc_woocommerce_checkout",
                "content_element" => true,
                "is_container" => false,
                "show_settings_on_create" => false,
                "params" => array(
                    array(
                        "param_name" => "dummy",
                        "heading" => esc_html__("Dummy data", 'trx_utils'),
                        "description" => wp_kses_data( __("Dummy data - not used in shortcodes", 'trx_utils') ),
                        "class" => "",
                        "value" => "",
                        "type" => "textfield"
                    )
                )
            ) );

            class WPBakeryShortCode_Woocommerce_Checkout extends Diveit_VC_ShortCodeAlone {}


            // WooCommerce - My Account
            //-------------------------------------------------------------------------------------

            vc_map( array(
                "base" => "woocommerce_my_account",
                "name" => esc_html__("My Account", 'trx_utils'),
                "description" => wp_kses_data( __("WooCommerce shortcode: show my account page", 'trx_utils') ),
                "category" => esc_html__('WooCommerce', 'trx_utils'),
                'icon' => 'icon_trx_wooc_my_account',
                "class" => "trx_sc_alone trx_sc_woocommerce_my_account",
                "content_element" => true,
                "is_container" => false,
                "show_settings_on_create" => false,
                "params" => array(
                    array(
                        "param_name" => "dummy",
                        "heading" => esc_html__("Dummy data", 'trx_utils'),
                        "description" => wp_kses_data( __("Dummy data - not used in shortcodes", 'trx_utils') ),
                        "class" => "",
                        "value" => "",
                        "type" => "textfield"
                    )
                )
            ) );

            class WPBakeryShortCode_Woocommerce_My_Account extends Diveit_VC_ShortCodeAlone {}


            // WooCommerce - Order Tracking
            //-------------------------------------------------------------------------------------

            vc_map( array(
                "base" => "woocommerce_order_tracking",
                "name" => esc_html__("Order Tracking", 'trx_utils'),
                "description" => wp_kses_data( __("WooCommerce shortcode: show order tracking page", 'trx_utils') ),
                "category" => esc_html__('WooCommerce', 'trx_utils'),
                'icon' => 'icon_trx_wooc_order_tracking',
                "class" => "trx_sc_alone trx_sc_woocommerce_order_tracking",
                "content_element" => true,
                "is_container" => false,
                "show_settings_on_create" => false,
                "params" => array(
                    array(
                        "param_name" => "dummy",
                        "heading" => esc_html__("Dummy data", 'trx_utils'),
                        "description" => wp_kses_data( __("Dummy data - not used in shortcodes", 'trx_utils') ),
                        "class" => "",
                        "value" => "",
                        "type" => "textfield"
                    )
                )
            ) );

            class WPBakeryShortCode_Woocommerce_Order_Tracking extends Diveit_VC_ShortCodeAlone {}


            // WooCommerce - Shop Messages
            //-------------------------------------------------------------------------------------

            vc_map( array(
                "base" => "shop_messages",
                "name" => esc_html__("Shop Messages", 'trx_utils'),
                "description" => wp_kses_data( __("WooCommerce shortcode: show shop messages", 'trx_utils') ),
                "category" => esc_html__('WooCommerce', 'trx_utils'),
                'icon' => 'icon_trx_wooc_shop_messages',
                "class" => "trx_sc_alone trx_sc_shop_messages",
                "content_element" => true,
                "is_container" => false,
                "show_settings_on_create" => false,
                "params" => array(
                    array(
                        "param_name" => "dummy",
                        "heading" => esc_html__("Dummy data", 'trx_utils'),
                        "description" => wp_kses_data( __("Dummy data - not used in shortcodes", 'trx_utils') ),
                        "class" => "",
                        "value" => "",
                        "type" => "textfield"
                    )
                )
            ) );

            class WPBakeryShortCode_Shop_Messages extends Diveit_VC_ShortCodeAlone {}


            // WooCommerce - Product Page
            //-------------------------------------------------------------------------------------

            vc_map( array(
                "base" => "product_page",
                "name" => esc_html__("Product Page", 'trx_utils'),
                "description" => wp_kses_data( __("WooCommerce shortcode: display single product page", 'trx_utils') ),
                "category" => esc_html__('WooCommerce', 'trx_utils'),
                'icon' => 'icon_trx_product_page',
                "class" => "trx_sc_single trx_sc_product_page",
                "content_element" => true,
                "is_container" => false,
                "show_settings_on_create" => true,
                "params" => array(
                    array(
                        "param_name" => "sku",
                        "heading" => esc_html__("SKU", 'trx_utils'),
                        "description" => wp_kses_data( __("SKU code of displayed product", 'trx_utils') ),
                        "admin_label" => true,
                        "class" => "",
                        "value" => "",
                        "type" => "textfield"
                    ),
                    array(
                        "param_name" => "id",
                        "heading" => esc_html__("ID", 'trx_utils'),
                        "description" => wp_kses_data( __("ID of displayed product", 'trx_utils') ),
                        "admin_label" => true,
                        "class" => "",
                        "value" => "",
                        "type" => "textfield"
                    ),
                    array(
                        "param_name" => "posts_per_page",
                        "heading" => esc_html__("Number", 'trx_utils'),
                        "description" => wp_kses_data( __("How many products showed", 'trx_utils') ),
                        "admin_label" => true,
                        "class" => "",
                        "value" => "1",
                        "type" => "textfield"
                    ),
                    array(
                        "param_name" => "post_type",
                        "heading" => esc_html__("Post type", 'trx_utils'),
                        "description" => wp_kses_data( __("Post type for the WP query (leave 'product')", 'trx_utils') ),
                        "class" => "",
                        "value" => "product",
                        "type" => "textfield"
                    ),
                    array(
                        "param_name" => "post_status",
                        "heading" => esc_html__("Post status", 'trx_utils'),
                        "description" => wp_kses_data( __("Display posts only with this status", 'trx_utils') ),
                        "class" => "",
                        "value" => array(
                            esc_html__('Publish', 'trx_utils') => 'publish',
                            esc_html__('Protected', 'trx_utils') => 'protected',
                            esc_html__('Private', 'trx_utils') => 'private',
                            esc_html__('Pending', 'trx_utils') => 'pending',
                            esc_html__('Draft', 'trx_utils') => 'draft'
                        ),
                        "type" => "dropdown"
                    )
                )
            ) );

            class WPBakeryShortCode_Product_Page extends Diveit_VC_ShortCodeSingle {}



            // WooCommerce - Product
            //-------------------------------------------------------------------------------------

            vc_map( array(
                "base" => "product",
                "name" => esc_html__("Product", 'trx_utils'),
                "description" => wp_kses_data( __("WooCommerce shortcode: display one product", 'trx_utils') ),
                "category" => esc_html__('WooCommerce', 'trx_utils'),
                'icon' => 'icon_trx_product',
                "class" => "trx_sc_single trx_sc_product",
                "content_element" => true,
                "is_container" => false,
                "show_settings_on_create" => true,
                "params" => array(
                    array(
                        "param_name" => "sku",
                        "heading" => esc_html__("SKU", 'trx_utils'),
                        "description" => wp_kses_data( __("Product's SKU code", 'trx_utils') ),
                        "admin_label" => true,
                        "class" => "",
                        "value" => "",
                        "type" => "textfield"
                    ),
                    array(
                        "param_name" => "id",
                        "heading" => esc_html__("ID", 'trx_utils'),
                        "description" => wp_kses_data( __("Product's ID", 'trx_utils') ),
                        "admin_label" => true,
                        "class" => "",
                        "value" => "",
                        "type" => "textfield"
                    )
                )
            ) );

            class WPBakeryShortCode_Product extends Diveit_VC_ShortCodeSingle {}


            // WooCommerce - Best Selling Products
            //-------------------------------------------------------------------------------------

            vc_map( array(
                "base" => "best_selling_products",
                "name" => esc_html__("Best Selling Products", 'trx_utils'),
                "description" => wp_kses_data( __("WooCommerce shortcode: show best selling products", 'trx_utils') ),
                "category" => esc_html__('WooCommerce', 'trx_utils'),
                'icon' => 'icon_trx_best_selling_products',
                "class" => "trx_sc_single trx_sc_best_selling_products",
                "content_element" => true,
                "is_container" => false,
                "show_settings_on_create" => true,
                "params" => array(
                    array(
                        "param_name" => "per_page",
                        "heading" => esc_html__("Number", 'trx_utils'),
                        "description" => wp_kses_data( __("How many products showed", 'trx_utils') ),
                        "admin_label" => true,
                        "class" => "",
                        "value" => "4",
                        "type" => "textfield"
                    ),
                    array(
                        "param_name" => "columns",
                        "heading" => esc_html__("Columns", 'trx_utils'),
                        "description" => wp_kses_data( __("How many columns per row use for products output", 'trx_utils') ),
                        "admin_label" => true,
                        "class" => "",
                        "value" => "1",
                        "type" => "textfield"
                    )
                )
            ) );

            class WPBakeryShortCode_Best_Selling_Products extends Diveit_VC_ShortCodeSingle {}



            // WooCommerce - Recent Products
            //-------------------------------------------------------------------------------------

            vc_map( array(
                "base" => "recent_products",
                "name" => esc_html__("Recent Products", 'trx_utils'),
                "description" => wp_kses_data( __("WooCommerce shortcode: show recent products", 'trx_utils') ),
                "category" => esc_html__('WooCommerce', 'trx_utils'),
                'icon' => 'icon_trx_recent_products',
                "class" => "trx_sc_single trx_sc_recent_products",
                "content_element" => true,
                "is_container" => false,
                "show_settings_on_create" => true,
                "params" => array(
                    array(
                        "param_name" => "per_page",
                        "heading" => esc_html__("Number", 'trx_utils'),
                        "description" => wp_kses_data( __("How many products showed", 'trx_utils') ),
                        "admin_label" => true,
                        "class" => "",
                        "value" => "4",
                        "type" => "textfield"

                    ),
                    array(
                        "param_name" => "columns",
                        "heading" => esc_html__("Columns", 'trx_utils'),
                        "description" => wp_kses_data( __("How many columns per row use for products output", 'trx_utils') ),
                        "admin_label" => true,
                        "class" => "",
                        "value" => "1",
                        "type" => "textfield"
                    ),
                    array(
                        "param_name" => "orderby",
                        "heading" => esc_html__("Order by", 'trx_utils'),
                        "description" => wp_kses_data( __("Sorting order for products output", 'trx_utils') ),
                        "admin_label" => true,
                        "class" => "",
                        "value" => array(
                            esc_html__('Date', 'trx_utils') => 'date',
                            esc_html__('Title', 'trx_utils') => 'title'
                        ),
                        "type" => "dropdown"
                    ),
                    array(
                        "param_name" => "order",
                        "heading" => esc_html__("Order", 'trx_utils'),
                        "description" => wp_kses_data( __("Sorting order for products output", 'trx_utils') ),
                        "admin_label" => true,
                        "class" => "",
                        "value" => array_flip(diveit_get_sc_param('ordering')),
                        "type" => "dropdown"
                    )
                )
            ) );

            class WPBakeryShortCode_Recent_Products extends Diveit_VC_ShortCodeSingle {}



            // WooCommerce - Related Products
            //-------------------------------------------------------------------------------------

            vc_map( array(
                "base" => "related_products",
                "name" => esc_html__("Related Products", 'trx_utils'),
                "description" => wp_kses_data( __("WooCommerce shortcode: show related products", 'trx_utils') ),
                "category" => esc_html__('WooCommerce', 'trx_utils'),
                'icon' => 'icon_trx_related_products',
                "class" => "trx_sc_single trx_sc_related_products",
                "content_element" => true,
                "is_container" => false,
                "show_settings_on_create" => true,
                "params" => array(
                    array(
                        "param_name" => "posts_per_page",
                        "heading" => esc_html__("Number", 'trx_utils'),
                        "description" => wp_kses_data( __("How many products showed", 'trx_utils') ),
                        "admin_label" => true,
                        "class" => "",
                        "value" => "4",
                        "type" => "textfield"
                    ),
                    array(
                        "param_name" => "columns",
                        "heading" => esc_html__("Columns", 'trx_utils'),
                        "description" => wp_kses_data( __("How many columns per row use for products output", 'trx_utils') ),
                        "admin_label" => true,
                        "class" => "",
                        "value" => "1",
                        "type" => "textfield"
                    ),
                    array(
                        "param_name" => "orderby",
                        "heading" => esc_html__("Order by", 'trx_utils'),
                        "description" => wp_kses_data( __("Sorting order for products output", 'trx_utils') ),
                        "admin_label" => true,
                        "class" => "",
                        "value" => array(
                            esc_html__('Date', 'trx_utils') => 'date',
                            esc_html__('Title', 'trx_utils') => 'title'
                        ),
                        "type" => "dropdown"
                    )
                )
            ) );

            class WPBakeryShortCode_Related_Products extends Diveit_VC_ShortCodeSingle {}



            // WooCommerce - Featured Products
            //-------------------------------------------------------------------------------------

            vc_map( array(
                "base" => "featured_products",
                "name" => esc_html__("Featured Products", 'trx_utils'),
                "description" => wp_kses_data( __("WooCommerce shortcode: show featured products", 'trx_utils') ),
                "category" => esc_html__('WooCommerce', 'trx_utils'),
                'icon' => 'icon_trx_featured_products',
                "class" => "trx_sc_single trx_sc_featured_products",
                "content_element" => true,
                "is_container" => false,
                "show_settings_on_create" => true,
                "params" => array(
                    array(
                        "param_name" => "per_page",
                        "heading" => esc_html__("Number", 'trx_utils'),
                        "description" => wp_kses_data( __("How many products showed", 'trx_utils') ),
                        "admin_label" => true,
                        "class" => "",
                        "value" => "4",
                        "type" => "textfield"
                    ),
                    array(
                        "param_name" => "columns",
                        "heading" => esc_html__("Columns", 'trx_utils'),
                        "description" => wp_kses_data( __("How many columns per row use for products output", 'trx_utils') ),
                        "admin_label" => true,
                        "class" => "",
                        "value" => "1",
                        "type" => "textfield"
                    ),
                    array(
                        "param_name" => "orderby",
                        "heading" => esc_html__("Order by", 'trx_utils'),
                        "description" => wp_kses_data( __("Sorting order for products output", 'trx_utils') ),
                        "admin_label" => true,
                        "class" => "",
                        "value" => array(
                            esc_html__('Date', 'trx_utils') => 'date',
                            esc_html__('Title', 'trx_utils') => 'title'
                        ),
                        "type" => "dropdown"
                    ),
                    array(
                        "param_name" => "order",
                        "heading" => esc_html__("Order", 'trx_utils'),
                        "description" => wp_kses_data( __("Sorting order for products output", 'trx_utils') ),
                        "admin_label" => true,
                        "class" => "",
                        "value" => array_flip(diveit_get_sc_param('ordering')),
                        "type" => "dropdown"
                    )
                )
            ) );

            class WPBakeryShortCode_Featured_Products extends Diveit_VC_ShortCodeSingle {}



            // WooCommerce - Top Rated Products
            //-------------------------------------------------------------------------------------

            vc_map( array(
                "base" => "top_rated_products",
                "name" => esc_html__("Top Rated Products", 'trx_utils'),
                "description" => wp_kses_data( __("WooCommerce shortcode: show top rated products", 'trx_utils') ),
                "category" => esc_html__('WooCommerce', 'trx_utils'),
                'icon' => 'icon_trx_top_rated_products',
                "class" => "trx_sc_single trx_sc_top_rated_products",
                "content_element" => true,
                "is_container" => false,
                "show_settings_on_create" => true,
                "params" => array(
                    array(
                        "param_name" => "per_page",
                        "heading" => esc_html__("Number", 'trx_utils'),
                        "description" => wp_kses_data( __("How many products showed", 'trx_utils') ),
                        "admin_label" => true,
                        "class" => "",
                        "value" => "4",
                        "type" => "textfield"
                    ),
                    array(
                        "param_name" => "columns",
                        "heading" => esc_html__("Columns", 'trx_utils'),
                        "description" => wp_kses_data( __("How many columns per row use for products output", 'trx_utils') ),
                        "admin_label" => true,
                        "class" => "",
                        "value" => "1",
                        "type" => "textfield"
                    ),
                    array(
                        "param_name" => "orderby",
                        "heading" => esc_html__("Order by", 'trx_utils'),
                        "description" => wp_kses_data( __("Sorting order for products output", 'trx_utils') ),
                        "admin_label" => true,
                        "class" => "",
                        "value" => array(
                            esc_html__('Date', 'trx_utils') => 'date',
                            esc_html__('Title', 'trx_utils') => 'title'
                        ),
                        "type" => "dropdown"
                    ),
                    array(
                        "param_name" => "order",
                        "heading" => esc_html__("Order", 'trx_utils'),
                        "description" => wp_kses_data( __("Sorting order for products output", 'trx_utils') ),
                        "admin_label" => true,
                        "class" => "",
                        "value" => array_flip(diveit_get_sc_param('ordering')),
                        "type" => "dropdown"
                    )
                )
            ) );

            class WPBakeryShortCode_Top_Rated_Products extends Diveit_VC_ShortCodeSingle {}



            // WooCommerce - Sale Products
            //-------------------------------------------------------------------------------------

            vc_map( array(
                "base" => "sale_products",
                "name" => esc_html__("Sale Products", 'trx_utils'),
                "description" => wp_kses_data( __("WooCommerce shortcode: list products on sale", 'trx_utils') ),
                "category" => esc_html__('WooCommerce', 'trx_utils'),
                'icon' => 'icon_trx_sale_products',
                "class" => "trx_sc_single trx_sc_sale_products",
                "content_element" => true,
                "is_container" => false,
                "show_settings_on_create" => true,
                "params" => array(
                    array(
                        "param_name" => "per_page",
                        "heading" => esc_html__("Number", 'trx_utils'),
                        "description" => wp_kses_data( __("How many products showed", 'trx_utils') ),
                        "admin_label" => true,
                        "class" => "",
                        "value" => "4",
                        "type" => "textfield"
                    ),
                    array(
                        "param_name" => "columns",
                        "heading" => esc_html__("Columns", 'trx_utils'),
                        "description" => wp_kses_data( __("How many columns per row use for products output", 'trx_utils') ),
                        "admin_label" => true,
                        "class" => "",
                        "value" => "1",
                        "type" => "textfield"
                    ),
                    array(
                        "param_name" => "orderby",
                        "heading" => esc_html__("Order by", 'trx_utils'),
                        "description" => wp_kses_data( __("Sorting order for products output", 'trx_utils') ),
                        "admin_label" => true,
                        "class" => "",
                        "value" => array(
                            esc_html__('Date', 'trx_utils') => 'date',
                            esc_html__('Title', 'trx_utils') => 'title'
                        ),
                        "type" => "dropdown"
                    ),
                    array(
                        "param_name" => "order",
                        "heading" => esc_html__("Order", 'trx_utils'),
                        "description" => wp_kses_data( __("Sorting order for products output", 'trx_utils') ),
                        "admin_label" => true,
                        "class" => "",
                        "value" => array_flip(diveit_get_sc_param('ordering')),
                        "type" => "dropdown"
                    )
                )
            ) );

            class WPBakeryShortCode_Sale_Products extends Diveit_VC_ShortCodeSingle {}



            // WooCommerce - Product Category
            //-------------------------------------------------------------------------------------

            vc_map( array(
                "base" => "product_category",
                "name" => esc_html__("Products from category", 'trx_utils'),
                "description" => wp_kses_data( __("WooCommerce shortcode: list products in specified category(-ies)", 'trx_utils') ),
                "category" => esc_html__('WooCommerce', 'trx_utils'),
                'icon' => 'icon_trx_product_category',
                "class" => "trx_sc_single trx_sc_product_category",
                "content_element" => true,
                "is_container" => false,
                "show_settings_on_create" => true,
                "params" => array(
                    array(
                        "param_name" => "per_page",
                        "heading" => esc_html__("Number", 'trx_utils'),
                        "description" => wp_kses_data( __("How many products showed", 'trx_utils') ),
                        "admin_label" => true,
                        "class" => "",
                        "value" => "4",
                        "type" => "textfield"
                    ),
                    array(
                        "param_name" => "columns",
                        "heading" => esc_html__("Columns", 'trx_utils'),
                        "description" => wp_kses_data( __("How many columns per row use for products output", 'trx_utils') ),
                        "admin_label" => true,
                        "class" => "",
                        "value" => "1",
                        "type" => "textfield"
                    ),
                    array(
                        "param_name" => "orderby",
                        "heading" => esc_html__("Order by", 'trx_utils'),
                        "description" => wp_kses_data( __("Sorting order for products output", 'trx_utils') ),
                        "admin_label" => true,
                        "class" => "",
                        "value" => array(
                            esc_html__('Date', 'trx_utils') => 'date',
                            esc_html__('Title', 'trx_utils') => 'title'
                        ),
                        "type" => "dropdown"
                    ),
                    array(
                        "param_name" => "order",
                        "heading" => esc_html__("Order", 'trx_utils'),
                        "description" => wp_kses_data( __("Sorting order for products output", 'trx_utils') ),
                        "admin_label" => true,
                        "class" => "",
                        "value" => array_flip(diveit_get_sc_param('ordering')),
                        "type" => "dropdown"
                    ),
                    array(
                        "param_name" => "category",
                        "heading" => esc_html__("Categories", 'trx_utils'),
                        "description" => wp_kses_data( __("Comma separated category slugs", 'trx_utils') ),
                        "admin_label" => true,
                        "class" => "",
                        "value" => "",
                        "type" => "textfield"
                    ),
                    array(
                        "param_name" => "operator",
                        "heading" => esc_html__("Operator", 'trx_utils'),
                        "description" => wp_kses_data( __("Categories operator", 'trx_utils') ),
                        "admin_label" => true,
                        "class" => "",
                        "value" => array(
                            esc_html__('IN', 'trx_utils') => 'IN',
                            esc_html__('NOT IN', 'trx_utils') => 'NOT IN',
                            esc_html__('AND', 'trx_utils') => 'AND'
                        ),
                        "type" => "dropdown"
                    )
                )
            ) );

            class WPBakeryShortCode_Product_Category extends Diveit_VC_ShortCodeSingle {}



            // WooCommerce - Products
            //-------------------------------------------------------------------------------------

            vc_map( array(
                "base" => "products",
                "name" => esc_html__("Products", 'trx_utils'),
                "description" => wp_kses_data( __("WooCommerce shortcode: list all products", 'trx_utils') ),
                "category" => esc_html__('WooCommerce', 'trx_utils'),
                'icon' => 'icon_trx_products',
                "class" => "trx_sc_single trx_sc_products",
                "content_element" => true,
                "is_container" => false,
                "show_settings_on_create" => true,
                "params" => array(
                    array(
                        "param_name" => "skus",
                        "heading" => esc_html__("SKUs", 'trx_utils'),
                        "description" => wp_kses_data( __("Comma separated SKU codes of products", 'trx_utils') ),
                        "admin_label" => true,
                        "class" => "",
                        "value" => "",
                        "type" => "textfield"
                    ),
                    array(
                        "param_name" => "ids",
                        "heading" => esc_html__("IDs", 'trx_utils'),
                        "description" => wp_kses_data( __("Comma separated ID of products", 'trx_utils') ),
                        "admin_label" => true,
                        "class" => "",
                        "value" => "",
                        "type" => "textfield"
                    ),
                    array(
                        "param_name" => "columns",
                        "heading" => esc_html__("Columns", 'trx_utils'),
                        "description" => wp_kses_data( __("How many columns per row use for products output", 'trx_utils') ),
                        "admin_label" => true,
                        "class" => "",
                        "value" => "1",
                        "type" => "textfield"
                    ),
                    array(
                        "param_name" => "orderby",
                        "heading" => esc_html__("Order by", 'trx_utils'),
                        "description" => wp_kses_data( __("Sorting order for products output", 'trx_utils') ),
                        "admin_label" => true,
                        "class" => "",
                        "value" => array(
                            esc_html__('Date', 'trx_utils') => 'date',
                            esc_html__('Title', 'trx_utils') => 'title'
                        ),
                        "type" => "dropdown"
                    ),
                    array(
                        "param_name" => "order",
                        "heading" => esc_html__("Order", 'trx_utils'),
                        "description" => wp_kses_data( __("Sorting order for products output", 'trx_utils') ),
                        "admin_label" => true,
                        "class" => "",
                        "value" => array_flip(diveit_get_sc_param('ordering')),
                        "type" => "dropdown"
                    )
                )
            ) );

            class WPBakeryShortCode_Products extends Diveit_VC_ShortCodeSingle {}




            // WooCommerce - Product Attribute
            //-------------------------------------------------------------------------------------

            vc_map( array(
                "base" => "product_attribute",
                "name" => esc_html__("Products by Attribute", 'trx_utils'),
                "description" => wp_kses_data( __("WooCommerce shortcode: show products with specified attribute", 'trx_utils') ),
                "category" => esc_html__('WooCommerce', 'trx_utils'),
                'icon' => 'icon_trx_product_attribute',
                "class" => "trx_sc_single trx_sc_product_attribute",
                "content_element" => true,
                "is_container" => false,
                "show_settings_on_create" => true,
                "params" => array(
                    array(
                        "param_name" => "per_page",
                        "heading" => esc_html__("Number", 'trx_utils'),
                        "description" => wp_kses_data( __("How many products showed", 'trx_utils') ),
                        "admin_label" => true,
                        "class" => "",
                        "value" => "4",
                        "type" => "textfield"
                    ),
                    array(
                        "param_name" => "columns",
                        "heading" => esc_html__("Columns", 'trx_utils'),
                        "description" => wp_kses_data( __("How many columns per row use for products output", 'trx_utils') ),
                        "admin_label" => true,
                        "class" => "",
                        "value" => "1",
                        "type" => "textfield"
                    ),
                    array(
                        "param_name" => "orderby",
                        "heading" => esc_html__("Order by", 'trx_utils'),
                        "description" => wp_kses_data( __("Sorting order for products output", 'trx_utils') ),
                        "admin_label" => true,
                        "class" => "",
                        "value" => array(
                            esc_html__('Date', 'trx_utils') => 'date',
                            esc_html__('Title', 'trx_utils') => 'title'
                        ),
                        "type" => "dropdown"
                    ),
                    array(
                        "param_name" => "order",
                        "heading" => esc_html__("Order", 'trx_utils'),
                        "description" => wp_kses_data( __("Sorting order for products output", 'trx_utils') ),
                        "admin_label" => true,
                        "class" => "",
                        "value" => array_flip(diveit_get_sc_param('ordering')),
                        "type" => "dropdown"
                    ),
                    array(
                        "param_name" => "attribute",
                        "heading" => esc_html__("Attribute", 'trx_utils'),
                        "description" => wp_kses_data( __("Attribute name", 'trx_utils') ),
                        "admin_label" => true,
                        "class" => "",
                        "value" => "",
                        "type" => "textfield"
                    ),
                    array(
                        "param_name" => "filter",
                        "heading" => esc_html__("Filter", 'trx_utils'),
                        "description" => wp_kses_data( __("Attribute value", 'trx_utils') ),
                        "admin_label" => true,
                        "class" => "",
                        "value" => "",
                        "type" => "textfield"
                    )
                )
            ) );

            class WPBakeryShortCode_Product_Attribute extends Diveit_VC_ShortCodeSingle {}



            // WooCommerce - Products Categories
            //-------------------------------------------------------------------------------------

            vc_map( array(
                "base" => "product_categories",
                "name" => esc_html__("Product Categories", 'trx_utils'),
                "description" => wp_kses_data( __("WooCommerce shortcode: show categories with products", 'trx_utils') ),
                "category" => esc_html__('WooCommerce', 'trx_utils'),
                'icon' => 'icon_trx_product_categories',
                "class" => "trx_sc_single trx_sc_product_categories",
                "content_element" => true,
                "is_container" => false,
                "show_settings_on_create" => true,
                "params" => array(
                    array(
                        "param_name" => "number",
                        "heading" => esc_html__("Number", 'trx_utils'),
                        "description" => wp_kses_data( __("How many categories showed", 'trx_utils') ),
                        "admin_label" => true,
                        "class" => "",
                        "value" => "4",
                        "type" => "textfield"
                    ),
                    array(
                        "param_name" => "columns",
                        "heading" => esc_html__("Columns", 'trx_utils'),
                        "description" => wp_kses_data( __("How many columns per row use for categories output", 'trx_utils') ),
                        "admin_label" => true,
                        "class" => "",
                        "value" => "1",
                        "type" => "textfield"
                    ),
                    array(
                        "param_name" => "orderby",
                        "heading" => esc_html__("Order by", 'trx_utils'),
                        "description" => wp_kses_data( __("Sorting order for products output", 'trx_utils') ),
                        "admin_label" => true,
                        "class" => "",
                        "value" => array(
                            esc_html__('Date', 'trx_utils') => 'date',
                            esc_html__('Title', 'trx_utils') => 'title'
                        ),
                        "type" => "dropdown"
                    ),
                    array(
                        "param_name" => "order",
                        "heading" => esc_html__("Order", 'trx_utils'),
                        "description" => wp_kses_data( __("Sorting order for products output", 'trx_utils') ),
                        "admin_label" => true,
                        "class" => "",
                        "value" => array_flip(diveit_get_sc_param('ordering')),
                        "type" => "dropdown"
                    ),
                    array(
                        "param_name" => "parent",
                        "heading" => esc_html__("Parent", 'trx_utils'),
                        "description" => wp_kses_data( __("Parent category slug", 'trx_utils') ),
                        "admin_label" => true,
                        "class" => "",
                        "value" => "date",
                        "type" => "textfield"
                    ),
                    array(
                        "param_name" => "ids",
                        "heading" => esc_html__("IDs", 'trx_utils'),
                        "description" => wp_kses_data( __("Comma separated ID of products", 'trx_utils') ),
                        "admin_label" => true,
                        "class" => "",
                        "value" => "",
                        "type" => "textfield"
                    ),
                    array(
                        "param_name" => "hide_empty",
                        "heading" => esc_html__("Hide empty", 'trx_utils'),
                        "description" => wp_kses_data( __("Hide empty categories", 'trx_utils') ),
                        "class" => "",
                        "value" => array("Hide empty" => "1" ),
                        "type" => "checkbox"
                    )
                )
            ) );

            class WPBakeryShortCode_Products_Categories extends Diveit_VC_ShortCodeSingle {}

        }
    }
}