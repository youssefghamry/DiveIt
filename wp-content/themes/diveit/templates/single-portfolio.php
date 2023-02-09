<?php

// Disable direct call
if ( ! defined( 'ABSPATH' ) ) { exit; }


/* Theme setup section
-------------------------------------------------------------------- */

if ( !function_exists( 'diveit_template_single_portfolio_theme_setup' ) ) {
    add_action( 'diveit_action_before_init_theme', 'diveit_template_single_portfolio_theme_setup', 1 );
    function diveit_template_single_portfolio_theme_setup() {
        diveit_add_template(array(
            'layout' => 'single-portfolio',
            'mode'   => 'single',
            'need_content' => true,
            'need_terms' => true,
            'title'  => esc_html__('Portfolio item', 'diveit'),
            'thumb_title'  => esc_html__('Fullwidth image', 'diveit'),
            'w'		 => 1170,
            'h'		 => null,
            'h_crop' => 659
        ));
    }
}

// Template output
if ( !function_exists( 'diveit_template_single_portfolio_output' ) ) {
    function diveit_template_single_portfolio_output($post_options, $post_data) {
        $post_data['post_views']++;
        $avg_author = 0;
        $avg_users  = 0;
        if (!$post_data['post_protected'] && $post_options['reviews'] && diveit_get_custom_option('show_reviews')=='yes' && function_exists('diveit_reviews_theme_setup')) {
            $avg_author = $post_data['post_reviews_author'];
            $avg_users  = $post_data['post_reviews_users'];
        }
        $show_title = diveit_get_custom_option('show_post_title')=='yes' && (diveit_get_custom_option('show_post_title_on_quotes')=='yes' || !in_array($post_data['post_format'], array('aside', 'chat', 'status', 'link', 'quote')));

        diveit_open_wrapper('<article class="'
            . join(' ', get_post_class('itemscope'
                . ' post_item post_item_single_portfolio'
                . ' post_featured_' . esc_attr($post_options['post_class'])
                . ' post_format_' . esc_attr($post_data['post_format'])))
            . '"'
            . ' itemscope itemtype="//schema.org/'.($avg_author > 0 || $avg_users > 0 ? 'Review' : 'Article')
            . '">');

        diveit_template_set_args('prev-next-block', array(
            'post_options' => $post_options,
            'post_data' => $post_data
        ));
        get_template_part(diveit_get_file_slug('templates/_parts/prev-next-block.php'));

        diveit_open_wrapper('<section class="post_content'.(!$post_data['post_protected'] && $post_data['post_edit_enable'] ? ' '.esc_attr('post_content_editor_present') : '').'" itemprop="'.($avg_author > 0 || $avg_users > 0 ? 'reviewBody' : 'articleBody').'">');

        if ($show_title) {
            ?>
            <h1 itemprop="<?php echo (float) $avg_author > 0 || (float) $avg_users > 0 ? 'itemReviewed' : 'headline'; ?>" class="post_title entry-title"><?php diveit_show_layout($post_data['post_title']); ?></h1>
            <?php
        }

        if (!$post_data['post_protected'] && diveit_get_custom_option('show_post_info')=='yes') {
            diveit_template_set_args('post-info', array(
                'post_options' => $post_options,
                'post_data' => $post_data
            ));
            get_template_part(diveit_get_file_slug('templates/_parts/post-info.php'));
        }

        diveit_template_set_args('reviews-block', array(
            'post_options' => $post_options,
            'post_data' => $post_data,
            'avg_author' => $avg_author,
            'avg_users' => $avg_users
        ));
        if (function_exists('diveit_reviews_theme_setup')) {
            get_template_part(diveit_get_file_slug('templates/_parts/reviews-block.php'));
        }

        // Post content
        if ($post_data['post_protected']) {
            diveit_show_layout($post_data['post_excerpt']);
            echo get_the_password_form();
        } else {
            if ((function_exists('diveit_sc_reviews')) && !diveit_storage_empty('reviews_markup') && diveit_strpos($post_data['post_content'], diveit_get_reviews_placeholder())===false)
                $post_data['post_content'] = diveit_sc_reviews(array()) . ($post_data['post_content']);
            diveit_show_layout(diveit_gap_wrapper(diveit_reviews_wrapper($post_data['post_content'])));
            wp_link_pages( array(
                    'before' => '<nav class="pagination_single"><span class="pager_pages">' . esc_html__( 'Pages:', 'diveit' ) . '</span>',
                    'after' => '</nav>',
                    'link_before' => '<span class="pager_numbers">',
                    'link_after' => '</span>'
                )
            );
            if (diveit_get_custom_option('show_post_tags')=='yes' && !empty($post_data['post_terms'][$post_data['post_taxonomy_tags']]->terms_links)) {
                ?>
                <div class="post_info">
                    <span class="post_info_item post_info_tags"><?php esc_html_e('in', 'diveit'); ?> <?php echo join(', ', $post_data['post_terms'][$post_data['post_taxonomy_tags']]->terms_links); ?></span>
                </div>
                <?php
            }
        }

        // Prepare args for all rest template parts
        // This parts not pop args from storage!
        diveit_template_set_args('single-footer', array(
            'post_options' => $post_options,
            'post_data' => $post_data
        ));

        if (!$post_data['post_protected'] && $post_data['post_edit_enable']) {
            get_template_part(diveit_get_file_slug('templates/_parts/editor-area.php'));
        }

        diveit_close_wrapper();
        if (!$post_data['post_protected']) {
            // Author info
            get_template_part(diveit_get_file_slug('templates/_parts/author-info.php'));
            // Share buttons
            get_template_part(diveit_get_file_slug('templates/_parts/share.php'));
            // Show related posts
            get_template_part(diveit_get_file_slug('templates/_parts/related-posts.php'));
            // Show comments
            if ( comments_open() || get_comments_number() != 0 ) {
                comments_template();
            }
        }

        // Manually pop args from storage
        // after all single footer templates
        diveit_template_get_args('single-footer');

        diveit_close_wrapper();		}
}
?>