<?php
/* Woocommerce support functions
------------------------------------------------------------------------------- */

// Theme init
if (!function_exists('diveit_woocommerce_theme_setup')) {
	add_action( 'diveit_action_before_init_theme', 'diveit_woocommerce_theme_setup', 1 );
	function diveit_woocommerce_theme_setup() {

		if (diveit_exists_woocommerce()) {
			add_action('diveit_action_add_styles', 				'diveit_woocommerce_frontend_scripts' );

			// Detect current page type, taxonomy and title (for custom post_types use priority < 10 to fire it handles early, than for standard post types)
			add_filter('diveit_filter_get_blog_type',				'diveit_woocommerce_get_blog_type', 9, 2);
			add_filter('diveit_filter_get_blog_title',			'diveit_woocommerce_get_blog_title', 9, 2);
			add_filter('diveit_filter_get_current_taxonomy',		'diveit_woocommerce_get_current_taxonomy', 9, 2);
			add_filter('diveit_filter_is_taxonomy',				'diveit_woocommerce_is_taxonomy', 9, 2);
			add_filter('diveit_filter_get_stream_page_title',		'diveit_woocommerce_get_stream_page_title', 9, 2);
			add_filter('diveit_filter_get_stream_page_link',		'diveit_woocommerce_get_stream_page_link', 9, 2);
			add_filter('diveit_filter_get_stream_page_id',		'diveit_woocommerce_get_stream_page_id', 9, 2);
			add_filter('diveit_filter_detect_inheritance_key',	'diveit_woocommerce_detect_inheritance_key', 9, 1);
			add_filter('diveit_filter_detect_template_page_id',	'diveit_woocommerce_detect_template_page_id', 9, 2);
			add_filter('diveit_filter_orderby_need',				'diveit_woocommerce_orderby_need', 9, 2);

			add_filter('diveit_filter_show_post_navi', 			'diveit_woocommerce_show_post_navi');
			add_filter('diveit_filter_list_post_types', 			'diveit_woocommerce_list_post_types');


		}

		if (is_admin()) {

			add_filter( 'diveit_filter_required_plugins',					'diveit_woocommerce_required_plugins' );
		}
	}
}

if (!function_exists('diveit_woocommerce_theme_setup1')) {
    add_action('after_setup_theme', 'diveit_woocommerce_theme_setup1', 1);
    function diveit_woocommerce_theme_setup1()
    {

        add_theme_support('woocommerce');

        // Next setting from the WooCommerce 3.0+ enable built-in image zoom on the single product page
        add_theme_support('wc-product-gallery-zoom');

        // Next setting from the WooCommerce 3.0+ enable built-in image slider on the single product page
        add_theme_support('wc-product-gallery-slider');

        // Next setting from the WooCommerce 3.0+ enable built-in image lightbox on the single product page
        add_theme_support('wc-product-gallery-lightbox');
    }
}

if ( !function_exists( 'diveit_woocommerce_settings_theme_setup2' ) ) {
	add_action( 'diveit_action_before_init_theme', 'diveit_woocommerce_settings_theme_setup2', 3 );
	function diveit_woocommerce_settings_theme_setup2() {
		if (diveit_exists_woocommerce()) {
			// Add WooCommerce pages in the Theme inheritance system
			diveit_add_theme_inheritance( array( 'woocommerce' => array(
				'stream_template' => 'blog-woocommerce',		// This params must be empty
				'single_template' => 'single-woocommerce',		// They are specified to enable separate settings for blog and single wooc
				'taxonomy' => array('product_cat'),
				'taxonomy_tags' => array('product_tag'),
				'post_type' => array('product'),
				'override' => 'page'
				) )
			);

			// Add WooCommerce specific options in the Theme Options

			diveit_storage_set_array_before('options', 'partition_service', array(
				
				"partition_woocommerce" => array(
					"title" => esc_html__('WooCommerce', 'diveit'),
					"icon" => "iconadmin-basket",
					"type" => "partition"),

				"info_wooc_1" => array(
					"title" => esc_html__('WooCommerce products list parameters', 'diveit'),
					"desc" => esc_html__("Select WooCommerce products list's style and crop parameters", 'diveit'),
					"type" => "info"),
		
				"shop_mode" => array(
					"title" => esc_html__('Shop list style',  'diveit'),
					"desc" => esc_html__("WooCommerce products list's style: thumbs or list with description", 'diveit'),
					"std" => "thumbs",
					"divider" => false,
					"options" => array(
						'thumbs' => esc_html__('Thumbs', 'diveit'),
						'list' => esc_html__('List', 'diveit')
					),
					"type" => "checklist"),
		
				"show_mode_buttons" => array(
					"title" => esc_html__('Show style buttons',  'diveit'),
					"desc" => esc_html__("Show buttons to allow visitors change list style", 'diveit'),
					"std" => "yes",
					"options" => diveit_get_options_param('list_yes_no'),
					"type" => "switch"),

				"show_currency" => array(
					"title" => esc_html__('Show currency selector', 'diveit'),
					"desc" => esc_html__('Show currency selector in the user menu', 'diveit'),
					"std" => "yes",
					"options" => diveit_get_options_param('list_yes_no'),
					"type" => "switch"),
		
				"show_cart" => array(
					"title" => esc_html__('Show cart button', 'diveit'),
					"desc" => esc_html__('Show cart button in the user menu', 'diveit'),
					"std" => "hide",
					"options" => array(
						'hide'   => esc_html__('Hide', 'diveit'),
						'always' => esc_html__('Always', 'diveit'),
						'shop'   => esc_html__('Only on shop pages', 'diveit')
					),
					"type" => "checklist"),

				"crop_product_thumb" => array(
					"title" => esc_html__("Crop product's thumbnail",  'diveit'),
					"desc" => esc_html__("Crop product's thumbnails on search results page or scale it", 'diveit'),
					"std" => "no",
					"options" => diveit_get_options_param('list_yes_no'),
					"type" => "switch")
				
				)
			);

		}
	}
}

// WooCommerce hooks
if (!function_exists('diveit_woocommerce_theme_setup3')) {
	add_action( 'diveit_action_after_init_theme', 'diveit_woocommerce_theme_setup3' );
	function diveit_woocommerce_theme_setup3() {

		if (diveit_exists_woocommerce()) {

			add_action(    'woocommerce_before_subcategory_title',		'diveit_woocommerce_open_thumb_wrapper', 9 );
			add_action(    'woocommerce_before_shop_loop_item_title',	'diveit_woocommerce_open_thumb_wrapper', 9 );

			add_action(    'woocommerce_before_subcategory_title',		'diveit_woocommerce_open_item_wrapper', 20 );
			add_action(    'woocommerce_before_shop_loop_item_title',	'diveit_woocommerce_open_item_wrapper', 20 );

			add_action(    'woocommerce_after_subcategory',				'diveit_woocommerce_close_item_wrapper', 20 );
			add_action(    'woocommerce_after_shop_loop_item',			'diveit_woocommerce_close_item_wrapper', 20 );

			add_action(    'woocommerce_after_shop_loop_item_title',	'diveit_woocommerce_after_shop_loop_item_title', 7);

			add_action(    'woocommerce_after_subcategory_title',		'diveit_woocommerce_after_subcategory_title', 10 );

			// Remove link around product item
			remove_action('woocommerce_before_shop_loop_item',			'woocommerce_template_loop_product_link_open', 10);
			remove_action('woocommerce_after_shop_loop_item',			'woocommerce_template_loop_product_link_close', 5);
			// Remove link around product category
			remove_action('woocommerce_before_subcategory',				'woocommerce_template_loop_category_link_open', 10);
			remove_action('woocommerce_after_subcategory',				'woocommerce_template_loop_category_link_close', 10);

		}

		if (diveit_is_woocommerce_page()) {
			
			remove_action( 'woocommerce_sidebar', 						'woocommerce_get_sidebar', 10 );					// Remove WOOC sidebar
			
			remove_action( 'woocommerce_before_main_content',			'woocommerce_output_content_wrapper', 10);
			add_action(    'woocommerce_before_main_content',			'diveit_woocommerce_wrapper_start', 10);
			
			remove_action( 'woocommerce_after_main_content',			'woocommerce_output_content_wrapper_end', 10);		
			add_action(    'woocommerce_after_main_content',			'diveit_woocommerce_wrapper_end', 10);

			add_action(    'woocommerce_show_page_title',				'diveit_woocommerce_show_page_title', 10);

			remove_action( 'woocommerce_single_product_summary',		'woocommerce_template_single_title', 5);		
			add_action(    'woocommerce_single_product_summary',		'diveit_woocommerce_show_product_title', 5 );

			add_action(    'woocommerce_before_shop_loop', 				'diveit_woocommerce_before_shop_loop', 10 );

			remove_action( 'woocommerce_after_shop_loop',				'woocommerce_pagination', 10 );
			add_action(    'woocommerce_after_shop_loop',				'diveit_woocommerce_pagination', 10 );

			add_action(    'woocommerce_product_meta_end',				'diveit_woocommerce_show_product_id', 10);

			add_filter(    'woocommerce_output_related_products_args',	'diveit_woocommerce_output_related_products_args' );
			
			add_filter(    'woocommerce_product_thumbnails_columns',	'diveit_woocommerce_product_thumbnails_columns' );



			add_filter(    'get_product_search_form',					'diveit_woocommerce_get_product_search_form' );

			add_filter(    'post_class',								'diveit_woocommerce_loop_shop_columns_class' );
			add_action(    'the_title',									'diveit_woocommerce_the_title');
			
			diveit_enqueue_popup();
		}
	}
}



// Check if WooCommerce installed and activated
if ( !function_exists( 'diveit_exists_woocommerce' ) ) {
	function diveit_exists_woocommerce() {
		return class_exists('Woocommerce');
	}
}

// Return true, if current page is any woocommerce page
if ( !function_exists( 'diveit_is_woocommerce_page' ) ) {
	function diveit_is_woocommerce_page() {
		$rez = false;
		if (diveit_exists_woocommerce()) {
			if (!diveit_storage_empty('pre_query')) {
				$id = diveit_storage_get_obj_property('pre_query', 'queried_object_id', 0);
				$rez = diveit_storage_call_obj_method('pre_query', 'get', 'post_type')=='product' 
						|| $id==wc_get_page_id('shop')
						|| $id==wc_get_page_id('cart')
						|| $id==wc_get_page_id('checkout')
						|| $id==wc_get_page_id('myaccount')
						|| diveit_storage_call_obj_method('pre_query', 'is_tax', 'product_cat')
						|| diveit_storage_call_obj_method('pre_query', 'is_tax', 'product_tag')
						|| diveit_storage_call_obj_method('pre_query', 'is_tax', get_object_taxonomies('product'));
						
			} else
				$rez = is_shop() || is_product() || is_product_category() || is_product_tag() || is_product_taxonomy() || is_cart() || is_checkout() || is_account_page();
		}
		return $rez;
	}
}

// Filter to detect current page inheritance key
if ( !function_exists( 'diveit_woocommerce_detect_inheritance_key' ) ) {
		function diveit_woocommerce_detect_inheritance_key($key) {
		if (!empty($key)) return $key;
		return diveit_is_woocommerce_page() ? 'woocommerce' : '';
	}
}

// Filter to detect current template page id
if ( !function_exists( 'diveit_woocommerce_detect_template_page_id' ) ) {
		function diveit_woocommerce_detect_template_page_id($id, $key) {
		if (!empty($id)) return $id;
		if ($key == 'woocommerce_cart')				$id = get_option('woocommerce_cart_page_id');
		else if ($key == 'woocommerce_checkout')	$id = get_option('woocommerce_checkout_page_id');
		else if ($key == 'woocommerce_account')		$id = get_option('woocommerce_account_page_id');
		else if ($key == 'woocommerce')				$id = get_option('woocommerce_shop_page_id');
		return $id;
	}
}

// Filter to detect current page type (slug)
if ( !function_exists( 'diveit_woocommerce_get_blog_type' ) ) {
		function diveit_woocommerce_get_blog_type($page, $query=null) {
		if (!empty($page)) return $page;
		
		if (is_shop()) 					$page = 'woocommerce_shop';
		else if ($query && $query->get('post_type')=='product' || is_product())		$page = 'woocommerce_product';
		else if ($query && $query->get('product_tag')!='' || is_product_tag())		$page = 'woocommerce_tag';
		else if ($query && $query->get('product_cat')!='' || is_product_category())	$page = 'woocommerce_category';
		else if (is_cart())				$page = 'woocommerce_cart';
		else if (is_checkout())			$page = 'woocommerce_checkout';
		else if (is_account_page())		$page = 'woocommerce_account';
		else if (is_woocommerce())		$page = 'woocommerce';
		return $page;
	}
}

// Filter to detect current page title
if ( !function_exists( 'diveit_woocommerce_get_blog_title' ) ) {
		function diveit_woocommerce_get_blog_title($title, $page) {
		if (!empty($title)) return $title;
		
		if ( diveit_strpos($page, 'woocommerce')!==false ) {
			if ( $page == 'woocommerce_category' ) {
				$term = get_term_by( 'slug', get_query_var( 'product_cat' ), 'product_cat', OBJECT);
				$title = $term->name;
			} else if ( $page == 'woocommerce_tag' ) {
				$term = get_term_by( 'slug', get_query_var( 'product_tag' ), 'product_tag', OBJECT);
				$title = esc_html__('Tag:', 'diveit') . ' ' . esc_html($term->name);
			} else if ( $page == 'woocommerce_cart' ) {
				$title = esc_html__( 'Your cart', 'diveit' );
			} else if ( $page == 'woocommerce_checkout' ) {
				$title = esc_html__( 'Checkout', 'diveit' );
			} else if ( $page == 'woocommerce_account' ) {
				$title = esc_html__( 'Account', 'diveit' );
			} else if ( $page == 'woocommerce_product' ) {
				$title = diveit_get_post_title();
			} else if (($page_id=get_option('woocommerce_shop_page_id')) > 0) {
				$title = diveit_get_post_title($page_id);
			} else {
				$title = esc_html__( 'Shop', 'diveit' );
			}
		}
		
		return $title;
	}
}

// Filter to detect stream page title
if ( !function_exists( 'diveit_woocommerce_get_stream_page_title' ) ) {
		function diveit_woocommerce_get_stream_page_title($title, $page) {
		if (!empty($title)) return $title;
		if (diveit_strpos($page, 'woocommerce')!==false) {
			if (($page_id = diveit_woocommerce_get_stream_page_id(0, $page)) > 0)
				$title = diveit_get_post_title($page_id);
			else
				$title = esc_html__('Shop', 'diveit');				
		}
		return $title;
	}
}

// Filter to detect stream page ID
if ( !function_exists( 'diveit_woocommerce_get_stream_page_id' ) ) {
		function diveit_woocommerce_get_stream_page_id($id, $page) {
		if (!empty($id)) return $id;
		if (diveit_strpos($page, 'woocommerce')!==false) {
			$id = get_option('woocommerce_shop_page_id');
		}
		return $id;
	}
}

// Filter to detect stream page link
if ( !function_exists( 'diveit_woocommerce_get_stream_page_link' ) ) {
		function diveit_woocommerce_get_stream_page_link($url, $page) {
		if (!empty($url)) return $url;
		if (diveit_strpos($page, 'woocommerce')!==false) {
			$id = diveit_woocommerce_get_stream_page_id(0, $page);
			if ($id) $url = get_permalink($id);
		}
		return $url;
	}
}

// Filter to detect current taxonomy
if ( !function_exists( 'diveit_woocommerce_get_current_taxonomy' ) ) {
		function diveit_woocommerce_get_current_taxonomy($tax, $page) {
		if (!empty($tax)) return $tax;
		if ( diveit_strpos($page, 'woocommerce')!==false ) {
			$tax = 'product_cat';
		}
		return $tax;
	}
}

// Return taxonomy name (slug) if current page is this taxonomy page
if ( !function_exists( 'diveit_woocommerce_is_taxonomy' ) ) {
		function diveit_woocommerce_is_taxonomy($tax, $query=null) {
		if (!empty($tax))
			return $tax;
		else 
			return $query!==null && $query->get('product_cat')!='' || is_product_category() ? 'product_cat' : '';
	}
}

// Return false if current plugin not need theme orderby setting
if ( !function_exists( 'diveit_woocommerce_orderby_need' ) ) {
		function diveit_woocommerce_orderby_need($need) {
		if ($need == false || diveit_storage_empty('pre_query'))
			return $need;
		else {
			return diveit_storage_call_obj_method('pre_query', 'get', 'post_type')!='product' 
					&& diveit_storage_call_obj_method('pre_query', 'get', 'product_cat')==''
					&& diveit_storage_call_obj_method('pre_query', 'get', 'product_tag')=='';
		}
	}
}

// Add custom post type into list
if ( !function_exists( 'diveit_woocommerce_list_post_types' ) ) {
		function diveit_woocommerce_list_post_types($list) {
		$list['product'] = esc_html__('Products', 'diveit');
		return $list;
	}
}


	
// Enqueue WooCommerce custom styles
if ( !function_exists( 'diveit_woocommerce_frontend_scripts' ) ) {
		function diveit_woocommerce_frontend_scripts() {
		if (diveit_is_woocommerce_page() || diveit_get_custom_option('show_cart')=='always')
			if (file_exists(diveit_get_file_dir('css/plugin.woocommerce.css')))
				wp_enqueue_style( 'diveit-plugin-woocommerce-style',  diveit_get_file_url('css/plugin.woocommerce.css'), array(), null );
	}
}

// Before main content
if ( !function_exists( 'diveit_woocommerce_wrapper_start' ) ) {
			function diveit_woocommerce_wrapper_start() {
		if (is_product() || is_cart() || is_checkout() || is_account_page()) {
			?>
			<article class="post_item post_item_single post_item_product">
			<?php
		} else {
			?>
			<div class="list_products shop_mode_<?php echo !diveit_storage_empty('shop_mode') ? diveit_storage_get('shop_mode') : 'thumbs'; ?>">
			<?php
		}
	}
}

// After main content
if ( !function_exists( 'diveit_woocommerce_wrapper_end' ) ) {
			function diveit_woocommerce_wrapper_end() {
		if (is_product() || is_cart() || is_checkout() || is_account_page()) {
			?>
			</article>	<!-- .post_item -->
			<?php
		} else {
			?>
			</div>	<!-- .list_products -->
			<?php
		}
	}
}

// Check to show page title
if ( !function_exists( 'diveit_woocommerce_show_page_title' ) ) {
		function diveit_woocommerce_show_page_title($defa=true) {
		return diveit_get_custom_option('show_page_title')=='no';
	}
}

// Check to show product title
if ( !function_exists( 'diveit_woocommerce_show_product_title' ) ) {
			function diveit_woocommerce_show_product_title() {
		if (diveit_get_custom_option('show_post_title')=='yes' || diveit_get_custom_option('show_page_title')=='no') {
			wc_get_template( 'single-product/title.php' );
		}
	}
}

// Add list mode buttons
if ( !function_exists( 'diveit_woocommerce_before_shop_loop' ) ) {
		function diveit_woocommerce_before_shop_loop() {
		if (diveit_get_custom_option('show_mode_buttons')=='yes') {
            echo '<div class="mode_buttons"><form action="' . esc_url(diveit_get_current_url()) . '" method="post">'
				. '<input type="hidden" name="diveit_shop_mode" value="'.esc_attr(diveit_storage_get('shop_mode')).'" />'
				. '<a href="#" class="woocommerce_thumbs icon-th" title="'.esc_attr__('Show products as thumbs', 'diveit').'"></a>'
				. '<a href="#" class="woocommerce_list icon-th-list" title="'.esc_attr__('Show products as list', 'diveit').'"></a>'
				. '</form></div>';
		}
	}
}


// Open thumbs wrapper for categories and products
if ( !function_exists( 'diveit_woocommerce_open_thumb_wrapper' ) ) {
			function diveit_woocommerce_open_thumb_wrapper($cat='') {
		diveit_storage_set('in_product_item', true);
		?>
		<div class="post_item_wrap">
			<div class="post_featured">
				<div class="post_thumb">
					<a class="hover_icon hover_icon_link" href="<?php echo esc_url(is_object($cat) ? get_term_link($cat->slug, 'product_cat') : esc_url(get_permalink())); ?>">
		<?php
	}
}

// Open item wrapper for categories and products
if ( !function_exists( 'diveit_woocommerce_open_item_wrapper' ) ) {
			function diveit_woocommerce_open_item_wrapper($cat='') {
		?>
				</a>
			</div>
		</div>
		<div class="post_content">
		<?php
	}
}

// Close item wrapper for categories and products
if ( !function_exists( 'diveit_woocommerce_close_item_wrapper' ) ) {
			function diveit_woocommerce_close_item_wrapper($cat='') {
		?>
			</div>
		</div>
		<?php
		diveit_storage_set('in_product_item', false);
	}
}

// Add excerpt in output for the product in the list mode
if ( !function_exists( 'diveit_woocommerce_after_shop_loop_item_title' ) ) {
		function diveit_woocommerce_after_shop_loop_item_title() {
		if (diveit_storage_get('shop_mode') == 'list') {
		    $excerpt = apply_filters('the_excerpt', get_the_excerpt());
			echo '<div class="description">'.trim($excerpt).'</div>';
		}
	}
}

// Add excerpt in output for the product in the list mode
if ( !function_exists( 'diveit_woocommerce_after_subcategory_title' ) ) {
		function diveit_woocommerce_after_subcategory_title($category) {
		if (diveit_storage_get('shop_mode') == 'list')
			echo '<div class="description">' . trim($category->description) . '</div>';
	}
}

// Add Product ID for single product
if ( !function_exists( 'diveit_woocommerce_show_product_id' ) ) {
		function diveit_woocommerce_show_product_id() {
		global $post, $product;
		echo '<span class="product_id">'.esc_html__('Product ID: ', 'diveit') . '<span>' . ($post->ID) . '</span></span>';
	}
}

// Redefine number of related products
if ( !function_exists( 'diveit_woocommerce_output_related_products_args' ) ) {
		function diveit_woocommerce_output_related_products_args($args) {
		$ppp = $ccc = 0;
		if (diveit_param_is_on(diveit_get_custom_option('show_post_related'))) {
			$ccc_add = in_array(diveit_get_custom_option('body_style'), array('fullwide', 'fullscreen')) ? 1 : 0;
			$ccc =  diveit_get_custom_option('post_related_columns');
			$ccc = $ccc > 0 ? $ccc : (diveit_param_is_off(diveit_get_custom_option('show_sidebar_main')) ? 3+$ccc_add : 2+$ccc_add);
			$ppp = diveit_get_custom_option('post_related_count');
			$ppp = $ppp > 0 ? $ppp : $ccc;
		}
		$args['posts_per_page'] = $ppp;
		$args['columns'] = $ccc;
		return $args;
	}
}

// Number columns for product thumbnails
if ( !function_exists( 'diveit_woocommerce_product_thumbnails_columns' ) ) {
		function diveit_woocommerce_product_thumbnails_columns($cols) {
		return 4;
	}
}

// Add column class into product item in shop streampage
if ( !function_exists( 'diveit_woocommerce_loop_shop_columns_class' ) ) {
	    function diveit_woocommerce_loop_shop_columns_class($class, $class2='', $cat='') {
        if (!is_product() && !is_cart() && !is_checkout() && !is_account_page()) {
            $cols = function_exists('wc_get_default_products_per_row') ? wc_get_default_products_per_row() : 2;
            $class[] = ' column-1_' . $cols;
        }
        return $class;
    }
}



// Search form
if ( !function_exists( 'diveit_woocommerce_get_product_search_form' ) ) {
		function diveit_woocommerce_get_product_search_form($form) {
		return '
		<form role="search" method="get" class="search_form" action="' . esc_url(home_url('/')) . '">
			<input type="text" class="search_field" placeholder="' . esc_attr__('Search for products &hellip;', 'diveit') . '" value="' . esc_attr(get_search_query()) . '" name="s" title="' . esc_attr__('Search for products:', 'diveit') . '" /><button class="search_button icon-search" type="submit"></button>
			<input type="hidden" name="post_type" value="product" />
		</form>
		';
	}
}

// Wrap product title into link
if ( !function_exists( 'diveit_woocommerce_the_title' ) ) {
		function diveit_woocommerce_the_title($title) {
		if (diveit_storage_get('in_product_item') && get_post_type()=='product') {
			$title = '<a href="'.esc_url(get_permalink()).'">'.($title).'</a>';
		}
		return $title;
	}
}

// Show pagination links
if ( !function_exists( 'diveit_woocommerce_pagination' ) ) {
		function diveit_woocommerce_pagination() {
		$style = diveit_get_custom_option('blog_pagination');
		diveit_show_pagination(array(
			'class' => 'pagination_wrap pagination_' . esc_attr($style),
			'style' => $style,
			'button_class' => '',
			'first_text'=> '',
			'last_text' => '',
			'prev_text' => '',
			'next_text' => '',
			'pages_in_group' => $style=='pages' ? 10 : 20
			)
		);
	}
}

// Filter to add in the required plugins list
if ( !function_exists( 'diveit_woocommerce_required_plugins' ) ) {
		function diveit_woocommerce_required_plugins($list=array()) {
		if (in_array('woocommerce', diveit_storage_get('required_plugins')))
			$list[] = array(
					'name' 		=> 'WooCommerce',
					'slug' 		=> 'woocommerce',
					'required' 	=> false
				);

		return $list;
	}
}

// Show products navigation
if ( !function_exists( 'diveit_woocommerce_show_post_navi' ) ) {
		function diveit_woocommerce_show_post_navi($show=false) {
		return $show || (diveit_get_custom_option('show_page_title')=='yes' && is_single() && diveit_is_woocommerce_page());
	}
}


if ( ! function_exists( 'diveit_woocommerce_price_filter_widget_step' ) ) {
    add_filter('woocommerce_price_filter_widget_step', 'diveit_woocommerce_price_filter_widget_step');
    function diveit_woocommerce_price_filter_widget_step( $step = '' ) {
        $step = 1;
        return $step;
    }
}

?>