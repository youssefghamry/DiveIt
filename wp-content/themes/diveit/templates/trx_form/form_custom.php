<?php

// Disable direct call
if ( ! defined( 'ABSPATH' ) ) { exit; }


/* Theme setup section
-------------------------------------------------------------------- */

if ( !function_exists( 'diveit_template_form_custom_theme_setup' ) ) {
	add_action( 'diveit_action_before_init_theme', 'diveit_template_form_custom_theme_setup', 1 );
	function diveit_template_form_custom_theme_setup() {
		diveit_add_template(array(
			'layout' => 'form_custom',
			'mode'   => 'forms',
			'title'  => esc_html__('Custom Form', 'diveit')
			));
	}
}

// Template output
if ( !function_exists( 'diveit_template_form_custom_output' ) ) {
	function diveit_template_form_custom_output($post_options, $post_data) {
		$form_style = diveit_get_theme_option('input_hover');
		?>
		<form <?php echo !empty($post_options['id']) ? ' id="'.esc_attr($post_options['id']).'_form"' : ''; ?>
			class="sc_input_hover_<?php echo esc_attr($form_style); ?>"
			data-formtype="<?php echo esc_attr($post_options['layout']); ?>" 
			method="post" 
			action="<?php echo esc_url($post_options['action'] ? $post_options['action'] : admin_url('admin-ajax.php')); ?>">
			<?php
			diveit_sc_form_show_fields($post_options['fields']);
			diveit_show_layout($post_options['content']);
			?>
			<div class="result sc_infobox"></div>
		</form>
		<?php
	}
}
?>