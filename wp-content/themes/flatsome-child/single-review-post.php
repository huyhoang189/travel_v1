<?php
  $url = get_stylesheet_directory_uri();
  get_header(); 
?>
  <div id="primary" class="content-area">
    <main id="main" class="site-main" role="main">
      <div class="page-wrapper page-right-sidebar">
        <div class="container">
          <div class="section__width">
            <div class="box__left__layout">
              <h2 class="review_title"><?php the_field('noi_du_lich'); ?></h2>
            	<div class="box_img_dj">
            		<?php 
      						$anh_review = get_field('anh_review');
      						if( $anh_review ): ?>
      						    <div class="slider-for">
      						        <?php foreach( $anh_review as $image ): ?>
      						            <div>
      						                <img src="<?php echo esc_url($image['sizes']['large']); ?>" />
      						            </div>
      						        <?php endforeach; ?>
      						    </div>

                      <div class="slider-nav">
                          <?php foreach( $anh_review as $image ): ?>
                              <div>
                                  <img src="<?php echo esc_url($image['sizes']['large']); ?>" />
                              </div>
                          <?php endforeach; ?>
                      </div>

      						<?php endif; ?>
              </div>
        		  <?php the_content(); ?>

              <div id="fb-root"></div>
              <script>(function(d, s, id) {
                var js, fjs = d.getElementsByTagName(s)[0];
                if (d.getElementById(id)) return;
                js = d.createElement(s); js.id = id;
                js.src = "//connect.facebook.net/vi_VN/sdk.js#xfbml=1&version=v2.0";
                fjs.parentNode.insertBefore(js, fjs);
              }(document, 'script', 'facebook-jssdk'));</script>
              <div class="fb-comments" data-href="<?php the_permalink() ;?>" data-width="100%" data-numposts="5" data-colorscheme="light"></div>
            </div> <!-- .large-9 -->

            <div class="box__right__layout">
                <div class="author_img">
                  <?php the_post_thumbnail(); ?>
                </div>

                <div class="related-review">
                  <?php
                      $taxonomy = 'review';  // or whatever you want
                      $category = wp_get_object_terms( $post->ID, $taxonomy,array('orderby' => 'term_group', 'order' => 'DESC'));
                      // echo "<pre>";
                      // print_r($category);
                      // echo "</pre>";

                      $args = array(
                      'post_type' => 'review-post',
                      'tax_query' => array(
                      array(
                      'taxonomy'  => $taxonomy,
                      'field'     => 'id',
                      'terms'     => $category[0]->term_id
                      )
                      ),
                      'post__not_in' => array($post->ID),
                      'showposts' => 3 // Number of related posts that will be shown.
                      );
                      // var_dump($category);
                      $query = new WP_Query($args);
                       if($query->have_posts()){
                      echo '<h4 class="hd_review"><span class="title-heading">Review khác</span></h4>';
                      ?>
                      <div class="box_review">
                      <?php
                          while($query->have_posts()):
                          $query->the_post();
                          $chuc_vu = get_field('chuc_vu');
                      ?>
                            <div class="box_review_list">
                              <div class="img">
                                <a href="<?php the_permalink(); ?>">
                                  <?php the_post_thumbnail(); ?>
                                </a>
                              </div>
                              <div class="cnt">
                                  <a href="<?php the_permalink(); ?>" class="title"><?php the_title(); ?></a>
                                  <div class="exp">
                                    <?php 
                                      if(!empty($chuc_vu)){
                                        echo $chuc_vu;
                                      }else{
                                        the_excerpt();
                                      }
                                    ?>
                                  </div>
                              </div>
                                 
                            </div>
                      <?php
                          endwhile;
                          }
                      ?>
                      </div>
              </div>

                <div class="box_ttsp box_cus_menu">
                    <?php dynamic_sidebar( 'Ảnh Qc' ); ?>
                </div>
            </div><!-- .post-sidebar -->
      </div>
        </div>

      </div>


    </main><!-- #main -->
  </div><!-- #primary -->

<?php

get_footer();
