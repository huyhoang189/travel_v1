<?php
/**
 * The template for displaying the footer.
 *
 * @package flatsome
 */

global $flatsome_opt;
?>

</main><!-- #main -->

<footer id="footer" class="footer-wrapper">

	<?php do_action('flatsome_footer'); ?>

</footer><!-- .footer-wrapper -->

<script type="text/javascript">
	jQuery("document").ready(function($){

		$('.news-block-widget-style-6').slick({
		  infinite: true,
		  speed: 800,
		  slidesToShow: 2,
		  slidesToScroll: 1,
		  arrows:true,
		  autoplay: true,
		  autoplaySpeed: 2000,
		  prevArrow:
		              '<div class="slick-prev"><i class="fas fa-chevron-left"></i></div>',
		  nextArrow:
		              '<div class="slick-next"><i class="fas fa-chevron-right"></i></div>',
		  responsive: [
		    {
		      breakpoint: 1024,
		      settings: {
		        slidesToShow: 2,
		        slidesToScroll: 1,
		        infinite: true,
		        dots: false
		      }
		    },
		    {
		      breakpoint: 600,
		      settings: {
		        slidesToShow: 1,
		        slidesToScroll: 1
		      }
		    },
		    {
		      breakpoint: 480,
		      settings: {
		        slidesToShow: 1,
		        slidesToScroll: 1
		      }
		    }
		  ]
		});

		$('.right .block-product-col').slick({
		  infinite: true,
		  speed: 800,
		  slidesToShow: 3,
		  slidesToScroll: 1,
		  arrows:true,
		  autoplay: false,
		  autoplaySpeed: 2000,
		  prevArrow:
		              '<div class="slick-prev"><i class="fas fa-chevron-left"></i></div>',
		  nextArrow:
		              '<div class="slick-next"><i class="fas fa-chevron-right"></i></div>',
		  responsive: [
		    {
		      breakpoint: 1024,
		      settings: {
		        slidesToShow: 1,
		        slidesToScroll: 1,
		        infinite: true,
		        dots: false
		      }
		    },
		    {
		      breakpoint: 600,
		      settings: {
		        slidesToShow: 1,
		        slidesToScroll: 1
		      }
		    },
		    {
		      breakpoint: 480,
		      settings: {
		        slidesToShow: 1,
		        slidesToScroll: 1
		      }
		    }
		  ]
		});

		 $('.slider-for').slick({
			  slidesToShow: 1,
			  slidesToScroll: 1,
			  arrows: false,
			  fade: true,
			  asNavFor: '.slider-nav'
			});
			$('.slider-nav').slick({
			  slidesToShow: 5,
			  slidesToScroll: 1,
			  asNavFor: '.slider-for',
			  dots: false,
			  arrows: true,
			  prevArrow:
		              '<div class="slick-prev"><i class="fas fa-chevron-left"></i></div>',
		  	  nextArrow:
		              '<div class="slick-next"><i class="fas fa-chevron-right"></i></div>',
			  centerMode: false,
			  focusOnSelect: true
			});

			
	});
</script>
<link rel="stylesheet" type="text/css" href="/wp-content/themes/flatsome-child/js/slick.css"/>
<script type="text/javascript" src="/wp-content/themes/flatsome-child/js/slick.min.js"></script>


</div><!-- #wrapper -->

<?php wp_footer(); ?>
</body>
</html>
