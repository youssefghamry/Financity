<?php
/**
 * Related Products
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/single-product/related.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see         https://docs.woocommerce.com/document/template-structure/
 * @package     WooCommerce/Templates
 * @version     3.9.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( $related_products ) : ?>

	<section class="related products">
		<?php
			$heading = apply_filters( 'woocommerce_product_related_products_heading', __( 'Related products', 'financity' ) );
			if ( $heading ) :
		?>
			<h2><?php echo esc_html( $heading ); ?></h2>
		<?php 
			endif;
		?>

		<?php
			if( class_exists('gdlr_core_pb_element_product') ){
				$column_size = financity_get_option('general', 'woocommerce-related-product-column-size', '15');

				$product_ids = array();
				foreach ( $related_products as $related_product ){
					$product_ids[] = $related_product->get_id();
				}
				$products = new WP_Query(array(
				    'post_type' => 'product',
				    'post__in' => $product_ids
				));

				$settings = array(
					'query' => $products,
					'pagination' => 'none',
					'thumbnail-size' => financity_get_option('general', 'woocommerce-related-product-thumbnail', 'full'),
					'column-size' => $column_size,
				);

				echo '<div class="financity-woocommerce-related-product financity-item-rvpdlr" >';
				echo gdlr_core_pb_element_product::get_content($settings);
				echo '</div>';

			}else{
				woocommerce_product_loop_start(); ?>

				<?php foreach ( $related_products as $related_product ) : ?>

					<?php
					$post_object = get_post( $related_product->get_id() );

					setup_postdata( $GLOBALS['post'] =& $post_object ); // phpcs:ignore WordPress.WP.GlobalVariablesOverride.Prohibited, Squiz.PHP.DisallowMultipleAssignments.Found

					wc_get_template_part( 'content', 'product' );
					?>

				<?php endforeach; ?>

				<?php 
				woocommerce_product_loop_end();
			} 
		?>

	</section>

<?php endif;

wp_reset_postdata();