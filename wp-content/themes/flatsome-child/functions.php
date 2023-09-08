<?php
/*
 * Ví dụ về thêm shortcode cho UX Builder
 * Hiển thị 1 số tùy chỉnh
 * Author hoangcuong
 */
function devvn_ux_builder_element(){
    add_ux_builder_shortcode('devvn_viewnumber', array(
        'name'      => __('Tin tức 1'),
        'category'  => __('Shop'),
        'priority'  => 1,
        'options' => array(

		    //  'ids' => array(
		    //     'type' => 'select',
		    //     'heading' => 'Custom Posts',
		    //     'param_name' => 'ids',
		    //     'config' => array(
		    //         'multiple' => true,
		    //         'placeholder' => 'Select..',
		    //         'postSelect' => array(
		    //             'post_type' => array('post')
		    //         ),
		    //     )
		    // ),
		    'cat' => array(
		        'type' => 'select',
		        'heading' => 'Category',
		        'param_name' => 'cat',
		        // 'conditions' => 'ids === ""',
		        'default' => '',
		        'config' => array(
		            // 'multiple' => true,
		            'placeholder' => 'Select...',
		            'termSelect' => array(
		                'post_type' => 'post',
		                'taxonomies' => 'category'
		            ),
		        )
		    ),

		    'number'    =>  array(
                'type' => 'scrubfield',
                'heading' => 'Numbers',
                'default' => '1',
                'step' => '1',
                'unit' => '',
                'min'   =>  1,
                //'max'   => 2
            ),
		  ),
    ));
}
add_action('ux_builder_setup', 'devvn_ux_builder_element');

 
function devvn_viewnumber_func($atts){
	global $post;
    extract(shortcode_atts(array(
    	'cat' =>'1',
      'number'    => '1',
    ), $atts));
    ob_start();

    // var_dump($atts);
    ?>
		<h2 class="hd-home">
		<a href="<?php echo get_category_link($cat); ?>">
       		<?php echo get_cat_name($cat); ?>
       	</a>
    </h2>
     <div class="news-widget-sidebar-widget">
    <?php
     $x = 1;
	  	$arg = array(
		  	'post_type' => 'post',
		  	'posts_per_page' => $number,
		  	'tax_query' => array(
		      	array(
			    'taxonomy' => 'category',
		      	'field' => 'id',
		      	'terms' => $cat
		      	)
		  	),
	  	);
	  	$news_post = new WP_Query($arg);
	  	while($news_post -> have_posts()) :
	  	$news_post -> the_post();
            ?>
                  <div class="news-item-sidebar-clear">
                    <div class="boxx__innner">
                       <div class="news-thumb">
                            <a href="<?php the_permalink(); ?>">
                                <?php the_post_thumbnail("large",array("title" => get_the_title())) ?>               
                            </a>               
                          </div>
                          <div class="box__slider">
                             <a class="news-title" href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                             <div class="dsc">
                                <?php echo the_excerpt(); ?>
                             </div>
                            
                          </div>
                    </div>
                         
                  </div>
              <?php 

           $x++;
	  	endwhile;
		wp_reset_postdata();
?>
	</div>
<?php
    return ob_get_clean();
}
add_shortcode('devvn_viewnumber', 'devvn_viewnumber_func');




function devvn_ux_builder_element2(){
    add_ux_builder_shortcode('devvn_viewnumber_2', array(
        'name'      => __('Tin tức tab (2)'),
        'category'  => __('Shop'),
        'priority'  => 1,
        'options' => array(

        //  'ids' => array(
        //     'type' => 'select',
        //     'heading' => 'Custom Posts',
        //     'param_name' => 'ids',
        //     'config' => array(
        //         'multiple' => true,
        //         'placeholder' => 'Select..',
        //         'postSelect' => array(
        //             'post_type' => array('post')
        //         ),
        //     )
        // ),

        'cat' => array(
            'type' => 'select',
            'heading' => 'Category',
            'param_name' => 'cat',
            // 'conditions' => 'ids === ""',
            'default' => '',
            'config' => array(
                // 'multiple' => true,
                'placeholder' => 'Select...',
                'termSelect' => array(
                    'post_type' => 'post',
                    'taxonomies' => 'category'
                ),
            )
        ),

        'number'    =>  array(
                'type' => 'scrubfield',
                'heading' => 'Numbers',
                'default' => '1',
                'step' => '1',
                'unit' => '',
                'min'   =>  1,
                //'max'   => 2
            ),
      ),
    ));
}
add_action('ux_builder_setup', 'devvn_ux_builder_element2');

 
function devvn_viewnumber_func_2($atts){
  global $post;
    extract(shortcode_atts(array(
      'cat' =>'1',
      'number'    => '1',
    ), $atts));
    ob_start();

    // var_dump($atts);
    ?>
    <div class="news-widget-sidebar-widget2">
    <?php
     $x = 1;
      $arg = array(
        'post_type' => 'post',
        'posts_per_page' => $number,
        'tax_query' => array(
            array(
          'taxonomy' => 'category',
            'field' => 'id',
            'terms' => $cat
            )
        ),
      );
      $news_post = new WP_Query($arg);
      while($news_post -> have_posts()) :
      $news_post -> the_post();
                    
                 if ($x == 1) {
                ?>
                  <div class="news-item-sidebar">
                    <div class="boxx__innner">
                          <div class="news-thumb">
                            <a href="<?php the_permalink(); ?>">
                              <?php the_post_thumbnail("large",array("title" => get_the_title())) ?>
                            </a> 
                             <a class="news-title" href="<?php the_permalink(); ?>"><?php the_title(); ?></a>              
                          </div>
                    </div>
                         
                  </div>
                  <div class="box2">
              <?php 
            }else {
            ?>
                  <div class="news-item-sidebar-clear">
                    <div class="boxx__innner">
                       <div class="news-thumb">
                          <a href="<?php the_permalink(); ?>">
                              <?php the_post_thumbnail("large",array("title" => get_the_title())) ?>               
                          </a>               
                        </div>
                        <div class="box__slider">
                            <a class="news-title" href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                            <div class="box__description">
                              <?php echo the_excerpt(); ?>
                            </div>
                        </div>
                    </div>
                         
                  </div>
              <?php 
            }   
                   

           $x++;
      endwhile;
    wp_reset_postdata();
?>
  </div>
  </div>
<?php
    return ob_get_clean();
}
add_shortcode('devvn_viewnumber_2', 'devvn_viewnumber_func_2');




// block 3
function devvn_ux_builder_element_3(){
    add_ux_builder_shortcode('devvn_viewnumber_3', array(
        'name'      => __('Tin tức 3'),
        'category'  => __('Shop'),
        'priority'  => 1,
        'options' => array(

        //  'ids' => array(
        //     'type' => 'select',
        //     'heading' => 'Custom Posts',
        //     'param_name' => 'ids',
        //     'config' => array(
        //         'multiple' => true,
        //         'placeholder' => 'Select..',
        //         'postSelect' => array(
        //             'post_type' => array('post')
        //         ),
        //     )
        // ),

        'cat' => array(
            'type' => 'select',
            'heading' => 'Category',
            'param_name' => 'cat',
            // 'conditions' => 'ids === ""',
            'default' => '',
            'config' => array(
                // 'multiple' => true,
                'placeholder' => 'Select...',
                'termSelect' => array(
                    'post_type' => 'post',
                    'taxonomies' => 'category'
                ),
            )
        ),

        'number'    =>  array(
                'type' => 'scrubfield',
                'heading' => 'Numbers',
                'default' => '1',
                'step' => '1',
                'unit' => '',
                'min'   =>  1,
                //'max'   => 2
            ),
      ),
    ));
}
add_action('ux_builder_setup', 'devvn_ux_builder_element_3');

function devvn_viewnumber_func_3($atts){
  global $post;
    extract(shortcode_atts(array(
      'cat' =>'1',
      'number'    => '1',
    ), $atts));
    ob_start();

    // var_dump($atts);
    ?>
    <h2 class="camnhan">
    <a href="<?php echo get_category_link($cat); ?>">
          <?php echo get_cat_name($cat); ?>
        </a>
    </h2>
     <div class="news-style-3">
    <?php
     $x = 1;
      $arg = array(
        'post_type' => 'post',
        'posts_per_page' => $number,
        'tax_query' => array(
            array(
          'taxonomy' => 'category',
            'field' => 'id',
            'terms' => $cat
            )
        ),
      );
      $news_post = new WP_Query($arg);
      while($news_post -> have_posts()) :
      $news_post -> the_post();
                        ?>
                          
                          <div class="news-item-top news-item-bottom">
                            <div class="boxx__innner">
                               <div class="news-thumb">
                                    <a href="<?php the_permalink(); ?>">
                                        <?php the_post_thumbnail("large",array("title" => get_the_title())) ?>               
                                    </a>
                                    <a class="news-title" href="<?php the_permalink(); ?>"><?php the_title(); ?></a> 
                               </div>
                            </div>
                                 
                          </div>
                      <?php 
           $x++;
      endwhile;
    wp_reset_postdata();
?>
  </div>
<?php
    return ob_get_clean();
}
add_shortcode('devvn_viewnumber_3', 'devvn_viewnumber_func_3');


// block 4

function devvn_ux_builder_element_4(){
    add_ux_builder_shortcode('devvn_viewnumber_4', array(
        'name'      => __('Block 4'),
        'category'  => __('Shop'),
        'priority'  => 1,
        'options' => array(

        //  'ids' => array(
        //     'type' => 'select',
        //     'heading' => 'Custom Posts',
        //     'param_name' => 'ids',
        //     'config' => array(
        //         'multiple' => true,
        //         'placeholder' => 'Select..',
        //         'postSelect' => array(
        //             'post_type' => array('post')
        //         ),
        //     )
        // ),

        'cat' => array(
            'type' => 'select',
            'heading' => 'Category',
            'param_name' => 'cat',
            // 'conditions' => 'ids === ""',
            'default' => '',
            'config' => array(
                // 'multiple' => true,
                'placeholder' => 'Select...',
                'termSelect' => array(
                    'post_type' => 'post',
                    'taxonomies' => 'category'
                ),
            )
        ),

        'number'    =>  array(
                'type' => 'scrubfield',
                'heading' => 'Numbers',
                'default' => '1',
                'step' => '1',
                'unit' => '',
                'min'   =>  1,
                //'max'   => 2
            ),
      ),
    ));
}
add_action('ux_builder_setup', 'devvn_ux_builder_element_4');

function devvn_viewnumber_func_4($atts){
  global $post;
    extract(shortcode_atts(array(
      'cat' =>'1',
      'number'    => '1',
    ), $atts));
    ob_start();

    // var_dump($atts);
    ?>
    <p class="hds">
        <a href="<?php echo get_category_link($cat); ?>">
          <?php echo get_cat_name($cat); ?>
        </a>
    </p>
    <div class="news-block-widget-style-4">
    <?php
     $x = 1;
      $arg = array(
        'post_type' => 'post',
        'posts_per_page' => $number,
        'tax_query' => array(
            array(
          'taxonomy' => 'category',
            'field' => 'id',
            'terms' => $cat
            )
        ),
      );
      $news_post = new WP_Query($arg);
      while($news_post -> have_posts()) :
      $news_post -> the_post();
                    if ($x == 1) {
                      echo "<div class='box__colum__left'>";
                        ?>
                          <div class="news-item">
                            <div class="boxx__innner">
                               <div class="news-thumb">
                                            <a href="<?php the_permalink(); ?>">
                                                <?php the_post_thumbnail("large",array("title" => get_the_title())) ?>               
                                            </a>               
                                  </div>
                                  <div class="box__slider">
                                     <h4><a class="news-title" href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h4>
                                  </div>
                            </div>
                                 
                          </div>
                      <?php 
                    }elseif ($x == 2) {
                      echo "</div><div class='box__colum__right'>";
                      ?>
                          <div class="news-item-clear">
                            <div class="boxx__innner">
                               <div class="news-thumb">
                                    <a href="<?php the_permalink(); ?>">
                                        <?php the_post_thumbnail("large",array("title" => get_the_title())) ?>               
                                    </a> 
                                    <a class="news-title" href="<?php the_permalink(); ?>"><?php the_title(); ?></a>              
                                </div>
                            </div>
                          </div>
                      <?php
                    }
                    else {
                    ?>
                          <div class="news-item-clear">
                            <div class="boxx__innner">
                               <div class="news-thumb">
                                    <a href="<?php the_permalink(); ?>">
                                        <?php the_post_thumbnail("large",array("title" => get_the_title())) ?>               
                                    </a> 
                                    <a class="news-title" href="<?php the_permalink(); ?>"><?php the_title(); ?></a>              
                                </div>
                            </div>
                                 
                          </div>
                      <?php 
                    }
                    if ($x == $number) {
                      echo "</div>";
                    }

           $x++;
      endwhile;
    wp_reset_postdata();
?>
  </div>
<?php
    return ob_get_clean();
}
add_shortcode('devvn_viewnumber_4', 'devvn_viewnumber_func_4');


// block 5

function devvn_ux_builder_element_5(){
    add_ux_builder_shortcode('devvn_viewnumber_5', array(
        'name'      => __('Block 5'),
        'category'  => __('Shop'),
        'priority'  => 1,
        'options' => array(

        //  'ids' => array(
        //     'type' => 'select',
        //     'heading' => 'Custom Posts',
        //     'param_name' => 'ids',
        //     'config' => array(
        //         'multiple' => true,
        //         'placeholder' => 'Select..',
        //         'postSelect' => array(
        //             'post_type' => array('post')
        //         ),
        //     )
        // ),

        'cat' => array(
            'type' => 'select',
            'heading' => 'Category',
            'param_name' => 'cat',
            // 'conditions' => 'ids === ""',
            'default' => '',
            'config' => array(
                // 'multiple' => true,
                'placeholder' => 'Select...',
                'termSelect' => array(
                    'post_type' => 'post',
                    'taxonomies' => 'category'
                ),
            )
        ),

        'number'    =>  array(
                'type' => 'scrubfield',
                'heading' => 'Numbers',
                'default' => '1',
                'step' => '1',
                'unit' => '',
                'min'   =>  1,
                //'max'   => 2
            ),
      ),
    ));
}
add_action('ux_builder_setup', 'devvn_ux_builder_element_5');

function devvn_viewnumber_func_5($atts){
  global $post;
    extract(shortcode_atts(array(
      'cat' =>'1',
      'number'    => '1',
    ), $atts));
    ob_start();

    // var_dump($atts);
    ?>
    <h2 class="heading">
    <a href="<?php echo get_category_link($cat); ?>">
          <?php echo get_cat_name($cat); ?>
        </a>
    </h2>
    <div class="news-widget-style-5">
    <?php
      $arg = array(
        'post_type' => 'post',
        'posts_per_page' => $number,
        'tax_query' => array(
            array(
          'taxonomy' => 'category',
            'field' => 'id',
            'terms' => $cat
            )
        ),
      );
      $news_post = new WP_Query($arg);
      while($news_post -> have_posts()) :
      $news_post -> the_post();
        ?>
           <div class="news-item-clear">
              <div class="boxx__innner">
                 <div class="news-thumb">
                              <a href="<?php the_permalink(); ?>">
                                  <?php the_post_thumbnail("large",array("title" => get_the_title())) ?>               
                              </a>               
                  </div>
                  <div class="box__slider">
                     <h4><a class="news-title" href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h4>
                     <div class="box__description">
                            <?php echo the_excerpt(); ?>
                      </div>
                      <!-- <div class="views__all">
                       <a href="<?php the_permalink(); ?>">Xem thêm</a>
                     </div> -->
                  </div>
              </div>     
          </div>
        <?php
      endwhile;
    wp_reset_postdata();
?>
  </div>
<?php
    return ob_get_clean();
}
add_shortcode('devvn_viewnumber_5', 'devvn_viewnumber_func_5');



// block 5

function devvn_ux_builder_element_6(){
    add_ux_builder_shortcode('devvn_viewnumber_6', array(
        'name'      => __('Review'),
        'category'  => __('Shop'),
        'priority'  => 1,
        'options' => array(

        'cat' => array(
            'type' => 'select',
            'heading' => 'Category',
            'param_name' => 'cat',
            // 'conditions' => 'ids === ""',
            'default' => '',
            'config' => array(
                // 'multiple' => true,
                'placeholder' => 'Select...',
                'termSelect' => array(
                    'post_type' => 'review-post',
                    'taxonomies' => 'review'
                ),
            )
        ),

        'number'    =>  array(
                'type' => 'scrubfield',
                'heading' => 'Numbers',
                'default' => '1',
                'step' => '1',
                'unit' => '',
                'min'   =>  1,
                //'max'   => 2
            ),
      ),
    ));
}
add_action('ux_builder_setup', 'devvn_ux_builder_element_6');

function devvn_viewnumber_func_6($atts){
  global $post;
    extract(shortcode_atts(array(
      'cat' =>'1',
      'number'    => '1',
    ), $atts));
    ob_start();

    ?>
  <div class="news-block-widget-style-6">
    <?php
      $arg = array(
        'post_type' => 'review-post',
        'posts_per_page' => $number,
        'tax_query' => array(
            array(
          'taxonomy' => 'review',
            'field' => 'id',
            'terms' => $cat
            )
        ),
      );
      $news_post = new WP_Query($arg);
      while($news_post -> have_posts()) :
      $news_post -> the_post();
           ?>
            <div class="news-item-clear">
              <div class="boxx__innner">
                 <div class="news-thumb">
                      <a href="<?php the_permalink(); ?>">
                          <?php the_post_thumbnail("large",array("title" => get_the_title())) ?>               
                      </a>                
                 </div>
                 <p class="star"><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i></p>
                 <div class="box__slider">
                        <div class="box__description">
                              <?php echo the_excerpt(); ?>
                        </div>
                        <h4><a class="news-title" href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h4>
                        <div class="clear__views"><a class="views_all" href="<?php the_permalink(); ?>">Xem chi tiết</a></div>
                 </div>
              </div>
                   
            </div>
           <?php

      $x++;
      endwhile;
    wp_reset_postdata();
?>
  </div>
<?php
    return ob_get_clean();
}
add_shortcode('devvn_viewnumber_6', 'devvn_viewnumber_func_6');



/*
 * Ví dụ về thêm shortcode cho UX Builder
 * Hiển thị 1 số tùy chỉnh
 * Author levantoan.com
 */

add_filter( 'add_to_cart_text', 'woo_custom_product_add_to_cart_text' );            // < 2.1
add_filter( 'woocommerce_product_add_to_cart_text', 'woo_custom_product_add_to_cart_text' );  // 2.1 +

  
function woo_custom_product_add_to_cart_text() {
  
    return __( 'Đặt phòng', 'woocommerce' );
  
}

function flatsome_woocommerce_shop_loop_button() {
    if ( flatsome_option( 'add_to_cart_icon' ) !== "button" ) {
      return;
    }
    global $product;

    echo apply_filters( 'woocommerce_loop_add_to_cart_link',
      sprintf( '<a href="%s" rel="nofollow" data-product_id="%s" class="%s %s product_type_%s button %s is-%s mb-0 is-%s">%s</a>',
        esc_url( $product->add_to_cart_url() ),
        esc_attr( $product->get_id() ),
        esc_attr( $product->is_type( 'variable' ) || $product->is_type( 'grouped' ) ? '' : 'ajax_add_to_cart' ),
        $product->is_purchasable() && $product->is_in_stock() ? 'add_to_cart_button' : '',
        esc_attr( $product->get_type() ),
        esc_attr( 'primary' ), // Button color
        esc_attr( get_theme_mod( 'add_to_cart_style', 'outline' ) ), // Button style
        esc_attr( 'small' ), // Button size
        esc_html( $product->add_to_cart_text() ) ),
      $product );
  }
add_action( 'rt_add_to_cart', 'flatsome_woocommerce_shop_loop_button', 10 );


// Shortcode to display a single product
function devvn_ux_builder_element_product(){
    add_ux_builder_shortcode('devvn_viewnumber_product', array(
        'name'      => __('Sản phẩm dạng 1'),
        'category'  => __('Shop'),
        'priority'  => 1,
        'options' => array(

        

        'cat' => array(
            'type' => 'select',
            'heading' => 'Category',
            'param_name' => 'cat',
            'default' => '',
            'config' => array(
                'placeholder' => 'Select...',
                'termSelect' => array(
                    'post_type' => 'product',
                    'taxonomies' => 'product_cat'
                ),
            )
        ),

        'number'    =>  array(
                'type' => 'scrubfield',
                'heading' => 'Numbers',
                'default' => '1',
                'step' => '1',
                'unit' => '',
                'min'   =>  1,
                //'max'   => 2
            ),
      ),
    ));
}
add_action('ux_builder_setup', 'devvn_ux_builder_element_product');

 
function devvn_viewnumber_func_product($atts){
  global $post;
    extract(shortcode_atts(array(
      'cat' =>'1',
      'number'    => '1',
    ), $atts));
    ob_start();
  $getcat = get_term_by( 'id', $cat , 'product_cat' );
    // var_dump($atts);
    ?>
    <h2 class="hds">
        <a href="<?php echo get_term_link( (int) $cat, 'product_cat'); ?>">
          <?php echo $getcat->name; ?>
        </a>
    </h2>
     <div class="block-product-1">
    <?php
      $arg = array(
        'post_type' => 'product',
        'posts_per_page' => $number,
        'tax_query' => array(
            array(
          'taxonomy' => 'product_cat',
            'field' => 'id',
            'terms' => $cat
            )
        ),
      );
      $news_post = new WP_Query($arg);
      $i=0;
      while($news_post -> have_posts()) :
      $news_post -> the_post();
      $i++;
    global $product;
          // Check stock status.
    $out_of_stock = get_post_meta( $post->ID, '_stock_status', true ) == 'outofstock';

    // Extra post classes.
    $classes   = array();
    $classes[] = 'product-small';
    $classes[] = 'col col-3';
    $classes[] = 'has-hover';

    if ( $out_of_stock ) $classes[] = 'out-of-stock';
    ?>
      <div class="spd1_box_left <?php echo $i; ?>">
            <div class="product-small">
              <div class="box-image" <?php echo get_shortcode_inline_css($css_args_img); ?>>
                <div class="<?php echo implode(' ', $classes_image); ?>" <?php echo get_shortcode_inline_css($css_image_height); ?>>
                  <a href="<?php echo get_the_permalink(); ?>">
                    <?php
                      if($back_image) echo flatsome_woocommerce_get_alt_product_thumbnail($image_size);
                      echo woocommerce_get_product_thumbnail($image_size);
                    ?>
                  </a>
                  <?php if($image_overlay){ ?><div class="overlay fill" style="background-color: <?php echo $image_overlay;?>"></div><?php } ?>
                   <?php if($style == 'shade'){ ?><div class="shade"></div><?php } ?>
                </div>
                <div class="sale">
                  <?php 
                    global $product;
                      if ($product->is_on_sale()){
                        $per = round((( $product->regular_price - $product->sale_price ) / $product->regular_price ) * 100 );
                        echo "<span class='percent'>-$per%</span>";
                      }
                  ?>
                </div>
                <?php 
                  $san_pham_hot = get_field('san_pham_hot');
                    if(!empty($san_pham_hot)){
                      ?>
                      <div class="hot_p">Hot</div>
                      <?php
                    }
                ?>
              </div><!-- box-image -->

              <div class="box-text <?php echo implode(' ', $classes_text); ?>" <?php echo get_shortcode_inline_css($css_args); ?>>
                <div class="time">
                  <div class="left"><p>Thời gian còn</p></div>
                  <div class="right">
                    <?php the_field('thoi_gian_con2'); ?>
                    </div>
                </div>


                <div class="content_t">
                    <?php
                      do_action( 'woocommerce_before_shop_loop_item_title' );

                      echo '<div class="title-wrapper">';
                      do_action( 'woocommerce_shop_loop_item_title' );
                      echo '</div>';
                    ?>
                    <div class="view">
                      <i class="fa fa-eye"></i> <?php echo cswp_post_views (get_the_ID()); ?> View
                    </div>
                    <div class="cnt">
                        <p><span><i class="fa fa-map-marker-alt"></i> Hành trình:</span> <?php the_field('hanh_trinh'); ?></p>
                        <p><span><i class="fa fa-clock"></i> Thời gian:</span> <?php the_field('thoi_gian'); ?></p>
                        <p><span><i class="fa fa-calendar-alt"></i> Ngày khởi hành:</span> <?php the_field('ngay_khoi_hanh'); ?></p>
                    </div>
                    <div class="price">
                      <div class="left">
                        <p><?php the_field('gia_price'); ?></p>
                        <a href="<?php echo get_the_permalink(); ?>">Xem chi tiết</a>
                      </div>
                    </div>

                </div>

              </div><!-- box-text -->
            </div><!-- box -->
      </div>
      
              <?php 
      endwhile;
    wp_reset_postdata();
?>
    </div>
    <a href="<?php echo get_term_link( (int) $cat, 'product_cat'); ?>" class="view_all">Xem thêm <i class="fa fa-angle-double-right"></i></a>
<?php
    return ob_get_clean();
}
add_shortcode('devvn_viewnumber_product', 'devvn_viewnumber_func_product');


//**************************************************************//
function devvn_ux_builder_element_product_2(){
    add_ux_builder_shortcode('devvn_viewnumber_product_2', array(
        'name'      => __('Chuyên mục combo / tour'),
        'category'  => __('Shop'),
        'priority'  => 1,
        'options' => array(

        

        'cat' => array(
            'type' => 'select',
            'heading' => 'Category',
            'param_name' => 'cat',
            'default' => '',
            'config' => array(
                'placeholder' => 'Select...',
                'termSelect' => array(
                    'post_type' => 'product',
                    'taxonomies' => 'product_cat'
                ),
            )
        ),

      ),
    ));
}
add_action('ux_builder_setup', 'devvn_ux_builder_element_product_2');

function devvn_viewnumber_func_product_2($atts2){
  global $post;
    extract(shortcode_atts(array(
      'cat' =>'1',
      'number'    => '1',
    ), $atts2));
    ob_start();
  $getcat = get_term_by( 'id', $cat , 'product_cat' );
    // var_dump($atts);
    $id_cate = $getcat->term_id;
    $postsInCat = get_term_by('id',$id_cate,'product_cat');//Thay ID_CAT bằng ID mà bạn muốn đếm số bài viết
    $postsInCat = $postsInCat->count; // Số bài viết
    $thumbnail_id = get_woocommerce_term_meta( $id_cate, 'thumbnail_id', true );
    $image = wp_get_attachment_url( $thumbnail_id );
    ?>
    <div class="box_cate_home">
      <div class="img">
        <a href="<?php echo get_term_link( (int) $cat, 'product_cat'); ?>">
            <img src="<?php echo $image; ?>">
        </a>
      </div>
      <div class="cnt">
        <h4>
          <a href="<?php echo get_term_link( (int) $cat, 'product_cat'); ?>">
            <?php echo $getcat->name; ?> 
          </a>
        </h4>
        <p><?php echo $postsInCat; ?> Gói <i class="fa fa-long-arrow-alt-right"></i></p>
      </div>
        

    </div>

<?php
    return ob_get_clean();
}
add_shortcode('devvn_viewnumber_product_2', 'devvn_viewnumber_func_product_2');

//**************************************************************//
function devvn_ux_builder_element_product_3(){
    add_ux_builder_shortcode('devvn_viewnumber_product_3', array(
        'name'      => __('Sản phẩm dạng 3'),
        'category'  => __('Shop'),
        'priority'  => 1,
        'options' => array(

        

        'cat' => array(
            'type' => 'select',
            'heading' => 'Category',
            'param_name' => 'cat',
            'default' => '',
            'config' => array(
                'placeholder' => 'Select...',
                'termSelect' => array(
                    'post_type' => 'product',
                    'taxonomies' => 'product_cat'
                ),
            )
        ),

        'number'    =>  array(
                'type' => 'scrubfield',
                'heading' => 'Numbers',
                'default' => '1',
                'step' => '1',
                'unit' => '',
                'min'   =>  1,
                //'max'   => 2
            ),
      ),
    ));
}
add_action('ux_builder_setup', 'devvn_ux_builder_element_product_3');

function devvn_viewnumber_func_product_3($atts3){
  global $post;
    extract(shortcode_atts(array(
      'cat' =>'1',
      'number'    => '1',
    ), $atts3));
    ob_start();
  $getcat = get_term_by( 'id', $cat , 'product_cat' );
    // var_dump($atts);
    ?>
     <div class="block-product-2 block-product-col block-product-col-4">
    <?php
      $arg = array(
        'post_type' => 'product',
        'posts_per_page' => $number,
        'tax_query' => array(
            array(
          'taxonomy' => 'product_cat',
            'field' => 'id',
            'terms' => $cat
            )
        ),
      );
      $news_post = new WP_Query($arg);
      while($news_post -> have_posts()) :
      $news_post -> the_post();
      global $product;
          // Check stock status.
    $out_of_stock = get_post_meta( $post->ID, '_stock_status', true ) == 'outofstock';

    // Extra post classes.
    $classes   = array();
    $classes[] = 'product-small';
    $classes[] = 'col col-4';
    $classes[] = 'has-hover';

    if ( $out_of_stock ) $classes[] = 'out-of-stock';
    ?>
                <div <?php fl_woocommerce_version_check( '3.4.0' ) ? wc_product_class( $classes ) : post_class( $classes ); ?>>
            <div class="col-inner">
            <?php echo woocommerce_show_product_loop_sale_flash(); ?>
            <div class="product-small <?php echo implode(' ', $classes_box); ?>">
              <div class="box-image" <?php echo get_shortcode_inline_css($css_args_img); ?>>
                <div class="<?php echo implode(' ', $classes_image); ?>" <?php echo get_shortcode_inline_css($css_image_height); ?>>
                  <a href="<?php echo get_the_permalink(); ?>">
                    <?php
                      if($back_image) echo flatsome_woocommerce_get_alt_product_thumbnail($image_size);
                      echo woocommerce_get_product_thumbnail($image_size);
                    ?>
                  </a>
                  <?php if($image_overlay){ ?><div class="overlay fill" style="background-color: <?php echo $image_overlay;?>"></div><?php } ?>
                   <?php if($style == 'shade'){ ?><div class="shade"></div><?php } ?>
                </div>
              </div><!-- box-image -->

              <div class="box-text <?php echo implode(' ', $classes_text); ?>" <?php echo get_shortcode_inline_css($css_args); ?>>
                <?php
                  do_action( 'woocommerce_before_shop_loop_item_title' );

                  echo '<div class="title-wrapper">';
                  do_action( 'woocommerce_shop_loop_item_title' );
                  echo '</div>';

                ?>
                <div class="view">
                  <i class="fa fa-eye"></i> <?php echo getPostViews(get_the_ID()); ?> View
                </div>
                <div class="cnt">
                  <?php 
                    $hanh_trinh = get_field('hanh_trinh');
                    $thoi_gian = get_field('thoi_gian');
                    $ngay_khoi_hanh = get_field('ngay_khoi_hanh');
                    $thoi_gian_con2 = get_field('thoi_gian_con2');
                  ?>
                  <?php if(!empty($hanh_trinh)){
                    ?>
                      <p><span><i class="fa fa-map-marker-alt"></i> Hành trình:</span> <?php echo $hanh_trinh; ?></p>
                    <?php
                  } ?>

                  <?php if(!empty($thoi_gian)){
                    ?>
                    <p><span><i class="fa fa-clock"></i> Thời gian:</span> <?php echo $thoi_gian; ?></p>
                    <?php
                  } ?>

                  <?php if(!empty($ngay_khoi_hanh)){
                    ?>
                    <p><span><i class="fa fa-calendar-alt"></i> Ngày khởi hành:</span> <?php echo $ngay_khoi_hanh; ?></p>
                    <?php
                  } ?>

                  <?php if(!empty($thoi_gian_con2)){
                    ?>
                    <div class="ttt">
                      <?php echo $thoi_gian_con2; ?>
                    </div>
                    <?php
                  } ?>
                    
                    
                    
                </div>
                <div class="price">
                  <div class="left">
                    <p><?php the_field('gia_price'); ?></p>
                  </div>
                  <div class="right">
                    <a href="<?php echo get_the_permalink(); ?>">Xem chi tiết</a>
                  </div>
                </div>
                  
              </div><!-- box-text -->
            </div><!-- box -->
          </div><!-- .col-inner -->
        </div><!-- col -->
              <?php 
      endwhile;
    wp_reset_postdata();
?>
  </div>
<?php
    return ob_get_clean();
}
add_shortcode('devvn_viewnumber_product_3', 'devvn_viewnumber_func_product_3');


//**************************************************************//
function devvn_ux_builder_element_product_4(){
    add_ux_builder_shortcode('devvn_viewnumber_product_4', array(
        'name'      => __('Sản phẩm dạng 4'),
        'category'  => __('Shop'),
        'priority'  => 1,
        'options' => array(

        

        'cat' => array(
            'type' => 'select',
            'heading' => 'Category',
            'param_name' => 'cat',
            'default' => '',
            'config' => array(
                'placeholder' => 'Select...',
                'termSelect' => array(
                    'post_type' => 'product',
                    'taxonomies' => 'product_cat'
                ),
            )
        ),

        'number'    =>  array(
                'type' => 'scrubfield',
                'heading' => 'Numbers',
                'default' => '1',
                'step' => '1',
                'unit' => '',
                'min'   =>  1,
                //'max'   => 2
            ),
      ),
    ));
}
add_action('ux_builder_setup', 'devvn_ux_builder_element_product_4');

function devvn_viewnumber_func_product_4($atts4){
  global $post;
    extract(shortcode_atts(array(
      'cat' =>'1',
      'number'    => '1',
    ), $atts4));
    ob_start();
  $getcat = get_term_by( 'id', $cat , 'product_cat' );
    // var_dump($atts);
    ?>
  <h2 class="heading clear">
        <a href="<?php echo get_term_link( (int) $cat, 'product_cat'); ?>">
          <?php echo $getcat->name; ?>
        </a>
    </h2>
     <div class="block-product-3 block-product-col block-product-col-4">
    <?php
      $arg = array(
        'post_type' => 'product',
        'posts_per_page' => $number,
        'tax_query' => array(
            array(
          'taxonomy' => 'product_cat',
            'field' => 'id',
            'terms' => $cat
            )
        ),
      );
      $news_post = new WP_Query($arg);
      while($news_post -> have_posts()) :
      $news_post -> the_post();
      global $product;
          // Check stock status.
    $out_of_stock = get_post_meta( $post->ID, '_stock_status', true ) == 'outofstock';

    // Extra post classes.
    $classes   = array();
    $classes[] = 'product-small';
    $classes[] = 'col col-4';
    $classes[] = 'has-hover';

    if ( $out_of_stock ) $classes[] = 'out-of-stock';
    ?>
                <div <?php fl_woocommerce_version_check( '3.4.0' ) ? wc_product_class( $classes ) : post_class( $classes ); ?>>
            <div class="col-inner">
            <?php echo woocommerce_show_product_loop_sale_flash(); ?>
            <div class="product-small <?php echo implode(' ', $classes_box); ?>">
              <div class="box-image" <?php echo get_shortcode_inline_css($css_args_img); ?>>
                <div class="<?php echo implode(' ', $classes_image); ?>" <?php echo get_shortcode_inline_css($css_image_height); ?>>
                  <a href="<?php echo get_the_permalink(); ?>">
                    <?php
                      if($back_image) echo flatsome_woocommerce_get_alt_product_thumbnail($image_size);
                      echo woocommerce_get_product_thumbnail($image_size);
                    ?>
                  </a>
                  <?php if($image_overlay){ ?><div class="overlay fill" style="background-color: <?php echo $image_overlay;?>"></div><?php } ?>
                   <?php if($style == 'shade'){ ?><div class="shade"></div><?php } ?>
                </div>
                <div class="image-tools top right show-on-hover">
                  <?php do_action('flatsome_product_box_tools_top'); ?>
                </div>
                <?php if($style !== 'shade' && $style !== 'overlay') { ?>
                  <div class="image-tools <?php echo flatsome_product_box_actions_class(); ?>">
                    <?php  do_action('flatsome_product_box_actions'); ?>
                  </div>
                <?php } ?>
                <?php if($out_of_stock) { ?><div class="out-of-stock-label"><?php _e( 'Out of stock', 'woocommerce' ); ?></div><?php }?>
              </div><!-- box-image -->

              <div class="box-text <?php echo implode(' ', $classes_text); ?>" <?php echo get_shortcode_inline_css($css_args); ?>>
                <?php
                  do_action( 'woocommerce_before_shop_loop_item_title' );

                  echo '<div class="title-wrapper">';
                  do_action( 'woocommerce_shop_loop_item_title' );
                  echo '</div>';

                  echo '<div class="price-wrapper">';
                  do_action( 'woocommerce_after_shop_loop_item_title' );
                  echo '</div>';

                  if($style == 'shade' || $style == 'overlay') {
                  echo '<div class="overlay-tools">';
                    do_action('flatsome_product_box_actions');
                  echo '</div>';
                  }

                ?>
                  <div class="rt-description">
                    <div class="rt-des">
                      <?php echo woocommerce_template_single_excerpt(); ?>
                    </div>
                  </div>
              </div><!-- box-text -->
            </div><!-- box -->
          </div><!-- .col-inner -->
        </div><!-- col -->
              <?php 
      endwhile;
    wp_reset_postdata();
?>
  </div>
<?php
    return ob_get_clean();
}
add_shortcode('devvn_viewnumber_product_4', 'devvn_viewnumber_func_product_4');

function my_custom_translations( $strings ) {
$text = array(
'Quick View' => 'Xem nhanh'
);
$strings = str_ireplace( array_keys( $text ), $text, $strings );
return $strings;
}
add_filter( 'gettext', 'my_custom_translations', 20 );

// thêm chi tiết mua hàng vào product
function readmore() {
  ?>
  <div class="rt_add_to_cart clearfix">
    <a href="<?php the_permalink(); ?>" class="view_product"><?php echo esc_html__( 'Chi tiết', 'rt' ); ?></a><br>
    <?php do_action( 'rt_add_to_cart' ); ?>
  </div>
  <?php
}
//add_action('woocommerce_before_shop_loop_item_title','readmore',1);

function custom_override_checkout_fields( $fields ) {
  
$fields['billing']['quanhuyen'] = array(
 'label' => __('Quận / Huyện', 'woocommerce'),
 'placeholder' => _x('Quận / Huyện', 'placeholder', 'woocommerce'),
 'required' => false,
 'class' => array('form-row-wide'),
 'clear' => true
 );
 //unset($fields['billing']['billing_country']);
 //unset($fields['billing']['billing_state']);
 //unset($fields['billing']['billing_address_1']);
 //unset($fields['billing']['billing_address_2']);
 //unset($fields['billing']['billing_city']);
 //unset($fields['billing']['billing_postcode']);
 //unset($fields['billing']['billing_company']);
unset($fields['billing']['quanhuyen']);
 
 //unset($fields['shipping']['shipping_country']);
 //unset($fields['shipping']['shipping_state']);
 //unset($fields['shipping']['shipping_postcode']);
 //unset($fields['shipping']['shipping_address_1']);
 //unset($fields['shipping']['shipping_address_2']);
 //unset($fields['shipping']['shipping_city']);
 
 return $fields;
}


//remove tabs woocommerce
function woo_remove_product_tabs( $tabs ) {

    //unset( $tabs['description'] );        // Remove the description tab
    unset( $tabs['reviews'] );      // Remove the reviews tab
    unset( $tabs['additional_information'] );   // Remove the additional information tab

    return $tabs;

}
add_filter( 'woocommerce_product_tabs', 'woo_remove_product_tabs', 98 );

function rt_woocommerce_product_tabs( $tabs = array() ) {
  global $product, $post;

  // Description tab - shows product content
  if ( $post->post_content ) {
    $tabs['description'] = array(
      'title'    => esc_html__( 'MÔ TẢ CHI TIẾT', 'rt' ),
      'priority' => 10,
      'callback' => 'woocommerce_product_description_tab',
    );
  }

  //unset($tabs['reviews']);

  return $tabs;
}
add_filter( 'woocommerce_product_tabs', 'rt_woocommerce_product_tabs' );

function woocommerce_product_description_tab2(){
  the_field('thuong_hieu');
}

// like share
function rt_social_sharing_buttons($content) {
    global $post;
    if(is_single()){
    
      // Get current page URL 
      $rtURL = urlencode(get_permalink());
   
      // Get current page title
      $rtTitle = str_replace( ' ', '%20', get_the_title());
      
      // Get Post Thumbnail for pinterest
      $rtThumbnail = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'full' );
   
      // Construct sharing URL without using any script
      $twitterURL = 'https://twitter.com/intent/tweet?text='.$rtTitle.'&amp;url='.$rtURL.'&amp;via=rt';
      $facebookURL = 'https://www.facebook.com/sharer/sharer.php?u='.$rtURL;
      $googleURL = 'https://plus.google.com/share?url='.$rtURL;
      $pinterestURL = 'https://pinterest.com/pin/create/button/?url='.$rtURL.'&amp;media='.$rtThumbnail[0].'&amp;description='.$rtTitle;
   
      // Add sharing button at the end of page/page content
      $content .= '<div class="rt-social">';
      $content .= '<a class="rt-link rt-facebook" href="'.$facebookURL.'" target="_blank">Facebook</a>';
      $content .= '<a class="rt-link rt-twitter" href="'. $twitterURL .'" target="_blank">Twitter</a>';
      $content .= '<a class="rt-link rt-googleplus" href="'.$googleURL.'" target="_blank">Google+</a>';
      $content .= '<a class="rt-link rt-pinterest" href="'.$pinterestURL.'" data-pin-custom="true" target="_blank">Pin It</a>';
      $content .= '</div>';

      $content .= '<div class="rt-cmfb">';
      $content .= '</div>';
      
      return $content;
    }else{
      
      return $content;
    }

  };
  //add_filter( 'the_content', 'rt_social_sharing_buttons');

// cmfb
function woo_new_product_tab_content() {
    ?>
    <div id="fb-root"></div>
      <script>(function(d, s, id) {
        var js, fjs = d.getElementsByTagName(s)[0];
        if (d.getElementById(id)) return;
        js = d.createElement(s); js.id = id;
        js.src = "//connect.facebook.net/vi_VN/sdk.js#xfbml=1&version=v2.0";
        fjs.parentNode.insertBefore(js, fjs);
      }(document, 'script', 'facebook-jssdk'));</script>
      <div class="fb-comments" data-href="<?php the_permalink() ;?>" data-width="100%" data-numposts="5" data-colorscheme="light"></div>
    <?php
    }
//add_action('woocommerce_after_single_product_summary','woo_new_product_tab_content',11);

// single
function rt_woocommerce_single_product_summary() { 
  global $rt_option;
  ?>
  <div class="rt_woocommerce_single_product_summary clearfix">
      <?php 
          //woocommerce_template_single_price();
          //msp();
          $ma_tour = get_field('ma_tour');
          $thoi_gian = get_field('thoi_gian');
          $ngay_khoi_hanh = get_field('ngay_khoi_hanh');
          $noi_khoi_hanh = get_field('noi_khoi_hanh');
          $hanh_trinh = get_field('hanh_trinh');
          $khach_san = get_field('khach_san');
          $phuong_tien = get_field('phuong_tien');
          $thoi_gian_con2 = get_field('thoi_gian_con2');
          ?>
            <h1 class="title"><?php the_title(); ?></h1>
            <div class="view">
              <i class="fa fa-eye"></i> <?php echo getPostViews(get_the_ID()); ?> View
            </div>
            <div class="div1 div">
              <?php if(!empty($ma_tour)){
                ?>
                  <p><span><i class="fa fa-globe"></i> Mã:</span> <?php echo $ma_tour; ?></p>
                <?php
              } ?>

              <?php if(!empty($thoi_gian)){
                ?>
                <p><span><i class="fa fa-clock"></i> Thời gian:</span> <?php echo $thoi_gian; ?></p>
                <?php
              } ?>

              <?php if(!empty($ngay_khoi_hanh)){
                ?>
                <p><span><i class="fa fa-calendar-alt"></i> Ngày khởi hành:</span> <?php echo $ngay_khoi_hanh; ?></p>
                <?php
              } ?>

              <?php if(!empty($noi_khoi_hanh)){
                ?>
                <p><span><i class="fa fa-map-marker-alt"></i> Nơi khởi hành:</span> <?php echo $noi_khoi_hanh; ?></p>
                <?php
              } ?>

              <?php if(!empty($hanh_trinh)){
                ?>
                <p><span><i class="fa fa-map-marker-alt"></i> Hành trình:</span> <?php echo $hanh_trinh; ?></p>
                <?php
              } ?>

              <?php if(!empty($khach_san)){
                ?>
                <p><span><i class="fa fa-hotel"></i> Khách sạn:</span> <?php echo $khach_san; ?></p>
                <?php
              } ?>

              <?php if(!empty($phuong_tien)){
                ?>
                <p><span><i class="fa fa-car"></i> Phương tiện di chuyển:</span> <?php echo $phuong_tien; ?></p>
                <?php
              } ?>

              <?php if(!empty($thoi_gian_con2)){
                ?>
                <div class="ttt">
                  <?php echo $thoi_gian_con2; ?>
                </div>
                <?php
              } ?>
            </div>

            <div class="div4 div">
              <div class="left">
                  <p>Giá: <span><?php the_field('gia_price'); ?></span></p>
              </div>
              <div class="right">
                  <a href="#dattour">ĐẶT TOUR NGAY</a>
              </div>
            </div>
          <?php
          
          //rt_qv_woocommerce_template_single_price();
          //woocommerce_template_single_add_to_cart();
          //woocommerce_template_single_excerpt();
          
      ?>

  </div>
<?php
}
add_action( 'woocommerce_single_product_summary', 'rt_woocommerce_single_product_summary', 20 );

function rt_qv_woocommerce_template_single_price() {
  global $product;
  $gia  = $product->regular_price;
  $giakm  = $product->sale_price;
  echo '<p class="price2">';
    if( ! empty( $giakm ) && ! empty( $gia ) ) {
      echo "<del><span>" . number_format($gia,0,'','.') . " đ</span></del> - <ins><span>" . number_format($giakm,0,'','.')." đ </span></ins>";
      ?>
      <?php
    } else {
      echo "<span>";
      if(!empty($gia)) echo "" . number_format($gia,0,'','.')." đ"; else echo "Giá : Liên Hệ";
      echo "</span>"; 
    }
  echo "</p>";

}
function add_percent_sale(){
  global $product;
  if ($product->is_on_sale()){
    $per = round(( $product->regular_price - $product->sale_price ));
    echo "<span class='percent'>$per đ</span>";
  }
}
function msp(){
  global $product;
  ?>
    <p class="rt_msp"><span>Mã: </span><?php echo ( $sku = $product->get_sku() ) ? $sku : __( 'N/A', 'woocommerce' ); ?></p>
  <?php
}
add_action('woocommerce_after_shop_loop_item','add_percent_sale');

remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_price', 10 );
remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_excerpt', 20 );
remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_add_to_cart', 30 );
remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_meta', 40 );

function rt_woocommerce_product_single_add_to_cart_text() {
  return apply_filters( 'rt_woocommerce_product_single_add_to_cart_text', esc_html( 'Đặt phòng', 'rt' ) );
}
add_filter( 'woocommerce_product_single_add_to_cart_text', 'rt_woocommerce_product_single_add_to_cart_text' );




function shortcode_chuyenmuc2(){

    $queried_object = get_queried_object();
    $idwoo = $queried_object->term_id;

      $clas = $idwoo;
      // var_dump($idwoo);
    $cate = get_term($idwoo);
    // var_dump($cate);
    $parent_cat_2 = $cate->parent;

  
    $cate_sub = get_term($parent_cat_2);
    $parent_cat_3 = $cate_sub->parent;

    $cate_sub2 = get_term($parent_cat_3);
    $parent_cat_4 = $cate_sub2->parent;
  
    if($parent_cat_3 != '' && $parent_cat_2 != '') {
      $idwoo = $parent_cat_3;
      // var_dump($idwoo);
      $cl = 'current';
    }
    else if($parent_cat_2 != '' && $parent_cat_3 == '') {
      $idwoo = $parent_cat_2;
    }


    if($parent_cat_4 != '' && $parent_cat_3 != '') {
      $idwoo = $parent_cat_4;
      // var_dump($idwoo);
     $cl = 'current';
    }
    else if($parent_cat_3 != '' && $parent_cat_4 == '') {
      $idwoo = $parent_cat_3;
    }



       $args3 = array(
               'type'                     => 'product',
               'taxonomy'                 => 'product_cat',
               'child_of'                 => $idwoo,
               'hide_empty'               => false,
               'hierarchical'             => true,
               'exclude'                  => '1',
               'number'                   => 100

       );
      $category3 = get_categories($args3);
        if(count($category3) != 0){
          echo "<div class='widget  menu-item-cate list_cate_phanloai list__thuonghieu'>";
            echo "<h4 class='widget-title'>". $queried_object->name ."</h4>";
            echo "<ul class='list_menu_item'>";
            foreach($category3 as $list3){
            $child = get_term_children($list3->cat_ID, 'product_cat');

            // var_dump($child);
            if( $list3->parent == $idwoo ):
              if ( $clas == $list3->cat_ID   ) {
                $class = 'active';
              }else {
                $class ='';
              }
            ?>

               <li class="submenu-2 <?php echo $class ?> "data-parent="<?php echo $list3->cat_ID; ?>">
                   <a class="a2 title-tab" href="<?php echo get_category_link($list3->cat_ID); ?>"><?php echo $list3->name; ?> <i class="fa fa-angle-right"></i></a>

                      <?php 
                         $args4 = array(
                                     'type'                     => 'product',
                                     'taxonomy'                 => 'product_cat',
                                     'child_of'                 => $list3->cat_ID,
                                     'hide_empty'               => false,
                                     'hierarchical'             => true,
                                     'exclude'                  => '1',
                                     'number'                   => 100

                             );
                            $category4 = get_categories($args4);
                              if(count($category4) != 0){

                                   foreach($category4 as $list4) {
                                    $id_4 = $list4->cat_ID;
                                    if ($id_4 == $idwoo  ) {
                                      $cl = 'current';
                                    }else {
                                      
                                    }
                                   }

                                  echo "<ul class='list_menu_item ". $cl ."'>";
                                  foreach($category4 as $list4){
                                  $child = get_term_children($list4->cat_ID, 'product_cat');
                                  if(!empty($child) || $list4->parent == $list3->cat_ID ):
                                  ?>

                                <li class="submenu-2"data-parent="<?php echo $list3->cat_ID ?>">
                                    <a class="a2 title-tab" href="<?php echo get_category_link($list4->cat_ID); ?>">+ <?php echo $list4->name; ?></a>
                                      <?php 
                                       $args5 = array(
                                                   'type'                     => 'product',
                                                   'taxonomy'                 => 'product_cat',
                                                   'child_of'                 => $list4->cat_ID,
                                                   'hide_empty'               => false,
                                                   'hierarchical'             => true,
                                                   'exclude'                  => '1',
                                                   'number'                   => 100

                                           );
                                          $category5 = get_categories($args5);
                                            if(count($category5) != 0){
                                                echo "<ul class='list_menu_item'>";
                                                foreach($category5 as $list5){
                                                $child = get_term_children($list5->cat_ID, 'product_cat');
                                                if(!empty($child) || $list5->parent == $list4->cat_ID ):
                                                ?>
                                              <li class="submenu-2 <?php echo $cl ?>"data-parent="<?php echo $list3->cat_ID ?>">
                                                  <a class="a2 title-tab" href="<?php echo get_category_link($list5->cat_ID); ?>">+ <?php echo $list5->name; ?></a>
                                              </li>
                                                <?php
                                                    endif; ?>

                                      <?php } 
                                        echo "</ul>";
                                       } ?>

                                </li>
                                  <?php
                                      endif; ?>

                        <?php } 
                          echo "</ul>";
                         } ?>

               </li>
            <?php
            endif;
            }
            echo "</ul>";
            echo "</div>";
       }
}
// add_action('shop_cate','shortcode_chuyenmuc2',2);
add_shortcode( 'thuonghieu', 'shortcode_chuyenmuc2' );





/*
* Remove product-category in URL
* Thay product-category bằng slug hiện tại của bạn. Mặc định là product-category
*/
add_filter( 'term_link', 'devvn_product_cat_permalink', 10, 3 );
function devvn_product_cat_permalink( $url, $term, $taxonomy ){
    switch ($taxonomy):
        case 'product_cat':
            $taxonomy_slug = 'danh-muc'; //Thay bằng slug hiện tại của bạn. Mặc định là product-category
            if(strpos($url, $taxonomy_slug) === FALSE) break;
            $url = str_replace('/' . $taxonomy_slug, '', $url);
            break;
    endswitch;
    return $url;
}
// Add our custom product cat rewrite rules
function devvn_product_category_rewrite_rules($flash = false) {
    $terms = get_terms( array(
        'taxonomy' => 'product_cat',
        'post_type' => 'product',
        'hide_empty' => false,
    ));
    if($terms && !is_wp_error($terms)){
        $siteurl = esc_url(home_url('/'));
        foreach ($terms as $term){
            $term_slug = $term->slug;
            $baseterm = str_replace($siteurl,'',get_term_link($term->term_id,'product_cat'));
            add_rewrite_rule($baseterm.'?$','index.php?product_cat='.$term_slug,'top');
            add_rewrite_rule($baseterm.'page/([0-9]{1,})/?$', 'index.php?product_cat='.$term_slug.'&paged=$matches[1]','top');
            add_rewrite_rule($baseterm.'(?:feed/)?(feed|rdf|rss|rss2|atom)/?$', 'index.php?product_cat='.$term_slug.'&feed=$matches[1]','top');
        }
    }
    if ($flash == true)
        flush_rewrite_rules(false);
}
add_action('init', 'devvn_product_category_rewrite_rules');
/*Sửa lỗi khi tạo mới taxomony bị 404*/
add_action( 'create_term', 'devvn_new_product_cat_edit_success', 10, 2 );
function devvn_new_product_cat_edit_success( $term_id, $taxonomy ) {
    devvn_product_category_rewrite_rules(true);
}


/*
* Code Bỏ /product/ hoặc /san-pham/ hoặc /shop/ ... có hỗ trợ dạng %product_cat%
* Thay /san-pham/ bằng slug hiện tại của bạn
*/
function devvn_remove_slug( $post_link, $post ) {
    if ( !in_array( get_post_type($post), array( 'product' ) ) || 'publish' != $post->post_status ) {
        return $post_link;
    }
    if('product' == $post->post_type){
        $post_link = str_replace( '/san-pham/', '/', $post_link ); //Thay san-pham bằng slug hiện tại của bạn
    }else{
        $post_link = str_replace( '/' . $post->post_type . '/', '/', $post_link );
    }
    return $post_link;
}
add_filter( 'post_type_link', 'devvn_remove_slug', 10, 2 );
/*Sửa lỗi 404 sau khi đã remove slug product hoặc san-pham*/
function devvn_woo_product_rewrite_rules($flash = false) {
    global $wp_post_types, $wpdb;
    $siteLink = esc_url(home_url('/'));
    foreach ($wp_post_types as $type=>$custom_post) {
        if($type == 'product'){
            if ($custom_post->_builtin == false) {
                $querystr = "SELECT {$wpdb->posts}.post_name, {$wpdb->posts}.ID
                            FROM {$wpdb->posts} 
                            WHERE {$wpdb->posts}.post_status = 'publish' 
                            AND {$wpdb->posts}.post_type = '{$type}'";
                $posts = $wpdb->get_results($querystr, OBJECT);
                foreach ($posts as $post) {
                    $current_slug = get_permalink($post->ID);
                    $base_product = str_replace($siteLink,'',$current_slug);
                    add_rewrite_rule($base_product.'?$', "index.php?{$custom_post->query_var}={$post->post_name}", 'top');
                }
            }
        }
    }
    if ($flash == true)
        flush_rewrite_rules(false);
}
add_action('init', 'devvn_woo_product_rewrite_rules');
/*Fix lỗi khi tạo sản phẩm mới bị 404*/
function devvn_woo_new_product_post_save($post_id){
    global $wp_post_types;
    $post_type = get_post_type($post_id);
    foreach ($wp_post_types as $type=>$custom_post) {
        if ($custom_post->_builtin == false && $type == $post_type) {
            devvn_woo_product_rewrite_rules(true);
        }
    }
}
add_action('wp_insert_post', 'devvn_woo_new_product_post_save');


function add_title(){
   $terms = get_terms( array(
          'taxonomy' => 'category',
          'hide_empty' => false,
      ) );
      $terms_lv = get_terms( array(
          'taxonomy' => 'project',
          'hide_empty' => false,
      ) );
      if (is_tax($taxonomy='project')) {
        // echo "<pre>";
        // print_r($terms_lv);
        // echo "</pre>";

      $queried_object = get_queried_object();
      $idwoo = $queried_object->term_id;
      $getcat = get_term_by( 'id', $idwoo , 'project' );
      ?>
            <h2 class="headings">
              <span><?php echo $getcat->name; ?></span>
            </h2>
  <?php
      }

    $terms_lv1 = get_terms( array(
          'taxonomy' => 'product_cat',
          'hide_empty' => false,
      ) );
      if (is_tax($taxonomy='product_cat')) {
        // echo "<pre>";
        // print_r($terms_lv);
        // echo "</pre>";

      $queried_object1 = get_queried_object();
      $idwoo1 = $queried_object1->term_id;
      $getcat1 = get_term_by( 'id', $idwoo1 , 'product_cat' );
      ?>
            <h2 class="headings">
              <span><?php echo $getcat1->name; ?></span>
            </h2>
  <?php
      }

    if (is_category()) {
    echo "<h2 class='headings'><span>";
    //news
    echo single_cat_title(); 
    echo "</span></h2>";
    }

    if(is_page()){
      echo "<h2 class='headings'><span>";
      echo the_title();
      echo "</span></h2>";
    }

    if (is_single()) {
      echo "<h2 class='headings'><span>";
      echo the_title();
      echo "</span></h2>";
    }
}
 add_action( 'rt_before_add_title', 'add_title', 1 );


 function rt_banner(){
    ?>
      <div class="rt_banner">
        <div class="cnt_position">
              <div class="container">
                <div class="row">
                    <?php 
                      do_action( 'rt_before_add_title' );
                       if ( function_exists('yoast_breadcrumb') ) {
                        yoast_breadcrumb('<p class="rt-breadcrumbs">','</p>');
                        }
                    ?>
                </div>
              </div>
        </div>
      </div>
    <?php
 }
  add_action( 'rt_add_banner', 'rt_banner', 1 );

//CODE LAY LUOT XEM
function getPostViews($postID){
    $count_key = 'post_views_count';
    $count = get_post_meta($postID, $count_key, true);
    if($count==''){
        delete_post_meta($postID, $count_key);
        add_post_meta($postID, $count_key, '0');
        return "01";
    }
    return $count.'';
}

// CODE DEM LUOT XEM
function setPostViews($postID) {
    $count_key = 'post_views_count';
    $count = get_post_meta($postID, $count_key, true);
    if($count==''){
        $count = 0;
        delete_post_meta($postID, $count_key);
        add_post_meta($postID, $count_key, '0');
    }else{
        $count++;
        update_post_meta($postID, $count_key, $count);
    }
}

////// custom taxonomy project

add_action('init', 'cptui_register_my_cpt_duan2');
function cptui_register_my_cpt_duan2() {
register_post_type('review-post', array(
  'label' => 'review',
  'description' => '',
  'public' => true,
  'show_ui' => true,
  'show_in_menu' => true,
  'capability_type' => 'post',
  'map_meta_cap' => true,
  'hierarchical' => false,
  'rewrite' => array('slug' => 'review-post', 'with_front' => true),
  'query_var' => true,
  'supports' => array('title','editor','excerpt','custom-fields','thumbnail','author'),
  'labels' => array (
    'name' => 'review',
    'singular_name' => 'review',
    'menu_name' => 'review',
    'add_new' => 'Đăng review',
    'add_new_item' => 'Đăng review',
    'edit' => 'Sửa',
    'edit_item' => 'Sửa',
    'new_item' => 'Đăng review',
    'view' => 'Xem bài',
    'view_item' => 'Xem bài',
    'search_items' => 'Tìm',
    'not_found' => 'Không thấy',
    'not_found_in_trash' => 'Không thấy',
    'parent' => 'Cha',
  )
) ); }

// Add danh muc tin

add_action('init', 'cptui_register_my_taxes_project');
function cptui_register_my_taxes_project() {
register_taxonomy( 'review',array (
  0 => 'review-post',
),
array( 'hierarchical' => true,
  'label' => 'project category',
  'show_ui' => true,
  'query_var' => true,
  'show_admin_column' => true,
  'labels' => array (
  'search_items' => 'review',
  'popular_items' => 'Nổi bật',
  'all_items' => 'Tất cả',
  'parent_item' => 'Cha',
  'parent_item_colon' => 'Cha',
  'edit_item' => 'Sửa',
  'update_item' => 'Cập nhật',
  'add_new_item' => 'Thêm',
  'new_item_name' => 'Thêm',
  'separate_items_with_commas' => 'Cách nhau bằng dấu phẩy',
  'add_or_remove_items' => 'Thêm hoặc xóa',
  'choose_from_most_used' => 'Chọn nổi bật nhất',
)
) );
}



