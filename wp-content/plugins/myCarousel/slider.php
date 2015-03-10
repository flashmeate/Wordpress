<?php
 
/*
Plugin Name: Content Carousel
Plugin URI:http://github.com/flashmeate
Description: Carousel on base owlCarousel
Author: Solomaha A
Author URI: http://github.com/flashmeate
Version: 1.0
*/


define('PLUG_PATH', WP_PLUGIN_URL . '/' . plugin_basename( dirname(__FILE__) ) . '/' );
define('PLUG_NAME', "WP-Post Carousel");
define ("PLUG_VERSION", "0.1");

require_once('slider-img-type.php');

wp_enqueue_script('carousel', PLUG_PATH.'assets/owl.carousel.js', array('jquery'));
wp_enqueue_style('carousel_css', PLUG_PATH.'assets/owl.carousel.css');
//wp_enqueue_style('carouselTh_css', PLUG_PATH.'assets/owl.theme.css');
wp_enqueue_style('carouselTr_css', PLUG_PATH.'assets/owl.transitions.css');
wp_enqueue_style('custom_css', PLUG_PATH.'assets/custom.css');/***Стили под свой сайт***/

function owl_script(){
 
print "<script type='text/javascript' charset='utf-8'>
  jQuery(document).ready(function() {
jQuery('#news-carousel').owlCarousel({
      autoPlay: 3000, //Set AutoPlay to 3 seconds
      items : 2,
      itemsDesktop : [1199,3],
      itemsDesktopSmall : [979,3],
      pagination:false,
      navigation : true,
      navigationText : false
  });
  });
</script>";
}
add_action('wp_head', 'owl_script');


function pst_get_carousel(){	
$slider= '<div id="news-carousel">';
 
    $efs_query= "post_type=slider-image";
        query_posts($efs_query);
 
    if (have_posts()) : while (have_posts()) : the_post();
        $img= get_the_post_thumbnail( $post->ID, 'large' );
        $date = '<span class="d">'.get_the_date(('d')).'</span><span class="m">'.get_the_date(('M')).'</span>
        <span class="y">'.get_the_date(('Y'));
        $slider.='<div class="item"><div class="news-date">'.$date.'</div><a href="/" class="allNews">все новости</a>'.$img.'<div class="slideDesc"><h3><a href="'.get_permalink().'">'.get_the_title().'</a></h3>'.get_the_excerpt().'</div></div>';
 
    endwhile; endif; wp_reset_query();
 
    $slider.= '</div>';
    return $slider;
 
}
 
/**add the shortcode for the slider- for use in editor**/
 
function pst_insert_carousel($atts, $content=null){
 
$slider= pst_get_carousel();
 
return $slider;
 
}
 
add_shortcode('pst_carousel', 'pst_insert_carousel');
 
/**add template tag- for use in themes**/
 
function pst_carousel(){
    print pst_get_carousel();
}





