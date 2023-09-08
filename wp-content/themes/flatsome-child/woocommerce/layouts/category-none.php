<div class="row category-page-row">

		<div class="col large-12">
		<?php
		do_action('flatsome_products_before');

		/**
		* Hook: woocommerce_before_main_content.
		*
		* @hooked woocommerce_output_content_wrapper - 10 (outputs opening divs for the content)
		* @hooked woocommerce_breadcrumb - 20 (FL removed)
		* @hooked WC_Structured_Data::generate_website_data() - 30
		*/
		do_action( 'woocommerce_before_main_content' );

		?>

		<?php
		/**
		 * Hook: woocommerce_archive_description.
		 *
		 * @hooked woocommerce_taxonomy_archive_description - 10
		 * @hooked woocommerce_product_archive_description - 10
		 */
		do_action( 'woocommerce_archive_description' );
		?>

		<?php
		$queried_object = get_queried_object();
		$idwoo = $queried_object->term_id;

		$args = array(
	         'type'                     => 'product',
	         'taxonomy'                 => 'product_cat',
	         'parent'                 	=> $idwoo,
	         'hide_empty'               => false,
	         'hierarchical'             => true,
	         'exclude'                  => '1',
	         'number'                   => 30
		 );
		$category = get_categories($args);
		if(count($category) != 0){
		echo "<div class='load_chuyen_muc'>";
			foreach($category as $list){
		   		$id_pro = $list->term_id;
                $argscat = new WP_Query(array(
                    'post_type' => 'product',
                    'tax_query' => array(
                      	array(
                          	'taxonomy' => 'product_cat',
                          	'field' => 'id',
                          	'terms' => $id_pro
                      	)
                  	),
                  	'posts_per_page' => 100
                  ));
                ?>
                <div class="box_product_ph box_product_ph_1">
                	<div class="left">
                		<div class="box_img">
                			<?php 
                				$thumbnail_id = get_woocommerce_term_meta( $id_pro, 'thumbnail_id', true );
								$image = wp_get_attachment_url( $thumbnail_id );
                			?>
                			<a href="<?php echo get_term_link( (int) $id_pro, 'product_cat'); ?>"><img src="<?php echo $image; ?>"></a>
                			<a class="view" href="<?php echo get_term_link( (int) $id_pro, 'product_cat'); ?>"><?php echo $list->name; ?></a>
                		</div>
                		
                	</div>
                	<div class="right">
                		<ul class="block-product-col product-small">
		                     <?php
		                         while($argscat -> have_posts()):
		                             $argscat -> the_post();
		                     ?>
		                    <?php get_template_part( 'woocommerce/content', 'product' ); ?>
		                    <?php  endwhile; wp_reset_postdata(); ?>
		                </ul>
                	</div>
	                
                </div>
	  	 <?php 
	  	 	}
	  	echo "</div>";

		}else{
			?>
				<div class="box_product_ph">
                	<div class="left">
                		<div class="box_img">
                			<?php
                				$thumbnail_id = get_woocommerce_term_meta( $idwoo, 'thumbnail_id', true );
								$image = wp_get_attachment_url( $thumbnail_id );
                			?>
                			<a href="<?php echo get_term_link( (int) $idwoo, 'product_cat'); ?>"><img src="<?php echo $image; ?>"></a>
                			<a class="view" href="<?php echo get_term_link( (int) $idwoo, 'product_cat'); ?>"><?php woocommerce_page_title(); ?></a>
                		</div>
                		
                	</div>
                	<div class="right">
                		<?php 
                			if ( fl_woocommerce_version_check( '3.4.0' ) ? woocommerce_product_loop() : have_posts() ) {

								/**
								 * Hook: woocommerce_before_shop_loop.
								 *
								 * @hooked wc_print_notices - 10
								 * @hooked woocommerce_result_count - 20 (FL removed)
								 * @hooked woocommerce_catalog_ordering - 30 (FL removed)
								 */
								do_action( 'woocommerce_before_shop_loop' );

								woocommerce_product_loop_start();

								if ( wc_get_loop_prop( 'total' ) ) {
									while ( have_posts() ) {
										the_post();

										/**
										 * Hook: woocommerce_shop_loop.
										 *
										 * @hooked WC_Structured_Data::generate_product_data() - 10
										 */
										do_action( 'woocommerce_shop_loop' );

										wc_get_template_part( 'content', 'product' );
									}
								}

								woocommerce_product_loop_end();

								/**
								 * Hook: woocommerce_after_shop_loop.
								 *
								 * @hooked woocommerce_pagination - 10
								 */
								do_action( 'woocommerce_after_shop_loop' );
							} else {
								/**
								 * Hook: woocommerce_no_products_found.
								 *
								 * @hooked wc_no_products_found - 10
								 */
								do_action( 'woocommerce_no_products_found' );
							}
                		?>
                	</div>
	                
                </div>
			<?php
					
				}


		?>

		<?php
		/**
		 * Hook: flatsome_products_after.
		 *
		 * @hooked flatsome_products_footer_content - 10
		 */
		do_action( 'flatsome_products_after' );
		/**
		 * Hook: woocommerce_after_main_content.
		 *
		 * @hooked woocommerce_output_content_wrapper_end - 10 (outputs closing divs for the content)
		 */
		do_action( 'woocommerce_after_main_content' );
		?>

		</div><!-- .large-12  -->
</div><!-- .row -->
