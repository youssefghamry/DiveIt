<div class="to_demo_wrap">
	<a href="" class="to_demo_pin iconadmin-pin" title="<?php esc_attr_e('Pin/Unpin demo-block by the right side of the window', 'diveit'); ?>"></a>
	<div class="to_demo_body_wrap">
		<div class="to_demo_body">
			<h1 class="to_demo_header"><?php echo esc_html__('Header with','diveit');?> <span class="to_demo_header_link"><?php echo esc_html__('inner link','diveit');?></span> <?php echo esc_html__('and it','diveit');?> <span class="to_demo_header_hover"><?php echo esc_html__('hovered state','diveit');?></span></h1>
			<p class="to_demo_info"><?php echo esc_html__('Posted','diveit');?> <span class="to_demo_info_link"><?php echo esc_html__('12 May, 2015','diveit');?></span> <?php echo esc_html__('by','diveit');?> <span class="to_demo_info_hover"><?php echo esc_html__('Author name hovered','diveit');?></span>.</p>
			<p class="to_demo_text"><?php echo esc_html__('This is default post content. Colors of each text element are set based on the color you choose below.','diveit');?></p>
			<p class="to_demo_text"><span class="to_demo_text_link"><?php echo esc_html__('link example','diveit');?></span> <?php echo esc_html__('and','diveit');?> <span class="to_demo_text_hover"><?php echo esc_html__('hovered link','diveit');?></span></p>

			<?php 
			$colors = diveit_storage_get('custom_colors');
			if (is_array($colors) && count($colors) > 0) {
				foreach ($colors as $slug=>$scheme) { 
					?>
					<h3 class="to_demo_header"><?php echo esc_html__('Accent colors','diveit');?></h3>
					<?php if (isset($scheme['text_link'])) { ?>
						<div class="to_demo_columns3"><p class="to_demo_text"><span class="to_demo_text_link"><?php echo esc_html__('text_link example','diveit');?></span> <?php echo esc_html__('and','diveit');?> <span class="to_demo_text_hover"><?php echo esc_html__('hovered text_link','diveit');?></span></p></div>
					<?php } ?>
					<?php if (isset($scheme['accent2'])) { ?>
						<div class="to_demo_columns3"><p class="to_demo_text"><span class="to_demo_accent2"><?php echo esc_html__('accent2 example','diveit');?></span> <?php echo esc_html__('and','diveit');?> <span class="to_demo_accent2_hover"><?php echo esc_html__('hovered accent2','diveit');?></span></p></div>
					<?php } ?>
					<?php if (isset($scheme['accent3'])) { ?>
						<div class="to_demo_columns3"><p class="to_demo_text"><span class="to_demo_accent3"><?php echo esc_html__('accent3 example','diveit');?></span> <?php echo esc_html__('and','diveit');?> <span class="to_demo_accent3_hover"><?php echo esc_html__('hovered accent3','diveit');?></span></p></div>
					<?php } ?>
		
					<h3 class="to_demo_header"><?php echo esc_html__('Inverse colors (on accented backgrounds)','diveit');?></h3>
					<?php if (isset($scheme['text_link'])) { ?>
						<div class="to_demo_columns3 to_demo_text_link_bg to_demo_inverse_block">
							<h4 class="to_demo_text_hover_bg to_demo_inverse_dark"><?php echo esc_html__('Accented block header','diveit');?></h4>
							<div>
								<p class="to_demo_inverse_light"><?php echo esc_html__('Posted','diveit');?> <span class="to_demo_inverse_link"><?php echo esc_html__('12 May, 2015','diveit');?></span> <?php echo esc_html__('by','diveit');?> <span class="to_demo_inverse_hover"><?php echo esc_html__('Author name hovered','diveit');?></span>.</p>
								<p class="to_demo_inverse_text"><?php echo esc_html__('This is a inversed colors example for the normal text','diveit');?></p>
								<p class="to_demo_inverse_text"><span class="to_demo_inverse_link"><?php echo esc_html__('link example','diveit');?></span> <?php echo esc_html__('and','diveit');?> <span class="to_demo_inverse_hover"><?php echo esc_html__('hovered link','diveit');?></span></p>
							</div>
						</div>
					<?php } ?>
					<?php if (isset($scheme['accent2'])) { ?>
						<div class="to_demo_columns3 to_demo_accent2_bg to_demo_inverse_block">
							<h4 class="to_demo_accent2_hover_bg to_demo_inverse_dark"><?php echo esc_html__('Accented block header','diveit');?></h4>
							<div>
								<p class="to_demo_inverse_light"><?php echo esc_html__('Posted','diveit');?> <span class="to_demo_inverse_link"><?php echo esc_html__('12 May, 2015','diveit');?></span> <?php echo esc_html__('by','diveit');?> <span class="to_demo_inverse_hover"><?php echo esc_html__('Author name hovered','diveit');?></span>.</p>
								<p class="to_demo_inverse_text"><?php echo esc_html__('This is a inversed colors example for the normal text','diveit');?></p>
								<p class="to_demo_inverse_text"><span class="to_demo_inverse_link"><?php echo esc_html__('link example','diveit');?></span> <?php echo esc_html__('and','diveit');?> <span class="to_demo_inverse_hover"><?php echo esc_html__('hovered link','diveit');?></span></p>
							</div>
						</div>
					<?php } ?>
					<?php if (isset($scheme['accent3'])) { ?>
						<div class="to_demo_columns3 to_demo_accent3_bg to_demo_inverse_block">
							<h4 class="to_demo_accent3_hover_bg to_demo_inverse_dark"><?php echo esc_html__('Accented block header','diveit');?></h4>
							<div>
								<p class="to_demo_inverse_light"><?php echo esc_html__('Posted','diveit');?> <span class="to_demo_inverse_link"><?php echo esc_html__('12 May, 2015','diveit');?></span> by <span class="to_demo_inverse_hover"><?php echo esc_html__('Author name hovered','diveit');?></span>.</p>
								<p class="to_demo_inverse_text"><?php echo esc_html__('This is a inversed colors example for the normal text','diveit');?></p>
								<p class="to_demo_inverse_text"><span class="to_demo_inverse_link"><?php echo esc_html__('link example','diveit');?></span> <?php echo esc_html__('and','diveit');?> <span class="to_demo_inverse_hover"><?php echo esc_html__('hovered link','diveit');?></span></p>
							</div>
						</div>
					<?php } ?>
					<?php 
					break;
				}
			}
			?>
	
			<h3 class="to_demo_header"><?php echo esc_html__('Alternative colors used to decorate highlight blocks and form fields','diveit');?></h3>
			<div class="to_demo_columns2">
				<div class="to_demo_alter_block">
					<h4 class="to_demo_alter_header"><?php echo esc_html__('Highlight block header','diveit');?></h4>
					<p class="to_demo_alter_text"><?php echo esc_html__('This is a plain text in the highlight block. This is a plain text in the highlight block.','diveit');?></p>
					<p class="to_demo_alter_text"><span class="to_demo_alter_link"><?php echo esc_html__('link example','diveit');?></span> <?php echo esc_html__('and','diveit');?> <span class="to_demo_alter_hover"><?php echo esc_html__('hovered link','diveit');?></span></p>
				</div>
			</div>
			<div class="to_demo_columns2">
				<div class="to_demo_form_fields">
					<h4 class="to_demo_header"><?php echo esc_html__('Form field','diveit');?></h4>
					<input type="text" class="to_demo_field" value="<?php echo esc_attr__('Input field example','diveit');?>">
					<h4 class="to_demo_header"><?php echo esc_html__('Form field focused','diveit');?></h4>
					<input type="text" class="to_demo_field_focused" value="<?php echo esc_attr__('Focused field example','diveit');?>">
				</div>
			</div>
		</div>
	</div>
</div>
