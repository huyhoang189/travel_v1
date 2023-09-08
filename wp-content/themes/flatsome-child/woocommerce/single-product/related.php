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
 * @see       https://docs.woocommerce.com/document/template-structure/
 * @author    WooThemes
 * @package   WooCommerce/Templates
 * @version     3.0.0
 */

if ( ! defined( 'ABSPATH' ) ) {
  exit;
}

// Fallback to old
if(!fl_woocommerce_version_check('3.0.0')){
  return wc_get_template_part( 'single-product/related-old');
}

// Get Type
$type = get_theme_mod('related_products', 'slider');
if($type == 'hidden') return;
if($type == 'grid') $type = 'row';

// Disable slider if less than selected products pr row.
if ( sizeof( $related_products ) < (get_theme_mod('related_products_pr_row', 4)+1) ) {
  $type = 'row';
}

$repater['type'] = $type;
$repater['columns'] = get_theme_mod('related_products_pr_row', 4);
$repater['slider_style'] = 'reveal';
$repater['row_spacing'] = 'small';

?>
<div class="tab-detail">
  <a href="#tongquan">Tổng quan</a>
  <a href="#lichtrinh">Lịch trình</a>
  <a href="#banggia">Bảng giá</a>
  <a href="#luuy">Lưu ý</a>
  <a href="#dattour">Đặt tour</a>
</div>
<div class="tab_cnt" id="tongquan">
  <div class="title__sp">Tổng quan</div>
  <?php the_field('tong_quan'); ?>
</div>
<div class="tab_cnt" id="lichtrinh">
   <div class="title__sp">Lịch trình</div>
  <?php the_field('lich_trinh'); ?>
</div>
<div class="tab_cnt" id="banggia">
  <div class="title__sp"> Bảng giá</div>
  <?php the_field('bang_gia'); ?>
</div>
<div class="tab_cnt" id="luuy">
   <div class="title__sp"> Lưu ý</div>
  <?php the_field('luu_y'); ?>
  <?php dynamic_sidebar( 'Share' ); ?>
</div>
<div class="tab_cnt" id="dattour">
  <div class="title__sp">Đặt tour</div>
  <p style="margin: 20px 0;color: #696969;">Bạn vui lòng điền vào from dưới đây để đặt tour.</p>
  <?php echo do_shortcode( '[contact-form-7 id="1636" title="Sản phẩm"]' ); ?>
  <div id="fb-root"></div>
      <script>(function(d, s, id) {
        var js, fjs = d.getElementsByTagName(s)[0];
        if (d.getElementById(id)) return;
        js = d.createElement(s); js.id = id;
        js.src = "//connect.facebook.net/vi_VN/sdk.js#xfbml=1&version=v2.0";
        fjs.parentNode.insertBefore(js, fjs);
      }(document, 'script', 'facebook-jssdk'));</script>
  <div class="fb-comments" data-href="<?php the_permalink() ;?>" data-width="100%" data-numposts="5" data-colorscheme="light"></div>
</div>
<script>
  document.querySelectorAll('a[href^="#"]').forEach(anchor => {
      anchor.addEventListener('click', function (e) {
          e.preventDefault();
   
          document.querySelector(this.getAttribute('href')).scrollIntoView({
              behavior: 'smooth'
          });
      });
  });

</script>
<?php
if ( $related_products ) : ?>

  <h3 class="product-section-title">
    <span>Tour cùng chủ đề</span>
  </h3>
  <div class="related_product">

      <?php foreach ( $related_products as $related_product ) : ?>

        <?php
          $post_object = get_post( $related_product->get_id() );

          setup_postdata( $GLOBALS['post'] =& $post_object );

          $ma_tour = get_field('ma_tour');
          $thoi_gian = get_field('thoi_gian');
          $ngay_khoi_hanh = get_field('ngay_khoi_hanh');
          $hanh_trinh = get_field('hanh_trinh');
          $khach_san = get_field('khach_san');
          $thoi_gian_con2 = get_field('thoi_gian_con2');

          ?>
          <div class="box_product">
            <div>
              <div class="left">
                  <div class="box-image">
                    <div class="<?php echo flatsome_product_box_image_class(); ?>">
                      <a href="<?php echo get_the_permalink(); ?>">
                        <?php
                          /**
                           *
                           * @hooked woocommerce_get_alt_product_thumbnail - 11
                           * @hooked woocommerce_template_loop_product_thumbnail - 10
                           */
                          do_action( 'flatsome_woocommerce_shop_loop_images' );
                        ?>
                      </a>
                    </div>
                  </div>
              </div>
              <div class="right">
                <?php
                    echo '<div class="title-wrapper">';
                    do_action( 'woocommerce_shop_loop_item_title' );
                    echo '</div>';
                ?>
                <div class="view">
                  <i class="fa fa-eye"></i> <?php echo getPostViews(get_the_ID()); ?> View
                </div>
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

                <?php if(!empty($thoi_gian_con2)){
                  ?>
                  <div class="ttt">
                    <?php echo $thoi_gian_con2; ?>
                  </div>
                  <?php
                } ?>
                <div class="price">
                  <p>Giá: <span><?php the_field('gia_price'); ?></span></p>
                </div>
                <div class="lien_he">
                  <a href="<?php the_permalink(); ?>">Xem chi tiết</a>
                  <a href="<?php the_permalink(); ?>">Đặt tour</a>
                </div>
              </div>
            </div>
            </div><!-- box-text -->
          <?php

          endforeach; ?>
  </div>

<?php endif;


wp_reset_postdata();
