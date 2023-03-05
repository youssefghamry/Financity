<?php
/**
 * The template part for displaying single posts
 */
?>
<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<div class="financity-single-article" >
		<?php
			// print post title
			$post_type = get_post_type();
			if( $post_type == 'post' ){

				$post_option = financity_get_post_option(get_the_ID());
				
				// feature image 
				if( empty($post_option['blog-feature-image']) || $post_option['blog-feature-image'] == 'default' ){
					$feature_image_pos = financity_get_option('general', 'default-blog-feature-image', 'content');
				}else{
					$feature_image_pos = $post_option['blog-feature-image'];
				}

				$post_format = get_post_format();
				if( empty($post_format) ){
					if( $feature_image_pos == 'content' ){
						$feature_image = get_post_thumbnail_id();
						if( !empty($feature_image) ){
							$thumbnail_size = financity_get_option('general', 'blog-thumbnail-size', 'full');

							echo '<div class="financity-single-article-thumbnail financity-media-image" >';
							echo gdlr_core_get_image($feature_image, $thumbnail_size);
							echo '</div>';
						}
					}
				}else{
					get_template_part('content/content-thumbnail', $post_format);
				}

				// post title
				if( empty($post_option['blog-title-style']) || $post_option['blog-title-style'] == 'default' ){
					$title_style = financity_get_option('general', 'default-blog-title-style', 'small');
				}else{	
					$title_style = $post_option['blog-title-style'];
				}
				if( $title_style == 'inside-content' ){
					get_template_part('content/content-single', 'title');
				}
			}

			echo '<div class="financity-single-article-content">';
			the_content();

			wp_link_pages( array(
				'before'      => '<div class="page-links"><span class="page-links-title">' . esc_html__( 'Pages:', 'financity' ) . '</span>',
				'after'       => '</div>',
				'link_before' => '<span>',
				'link_after'  => '</span>',
				'pagelink'    => '<span class="screen-reader-text">' . esc_html__( 'Page', 'financity' ) . ' </span>%',
				'separator'   => '<span class="screen-reader-text">, </span>',
			) );
			echo '</div>';
		?>
	</div><!-- financity-single-article -->
</article><!-- post-id -->
