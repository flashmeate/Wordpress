<?php
 
/*
Plugin Name: Slider
Plugin URI:http://github.com/flashmeate
Description: Slider on base bxSlider
Author: Solomaha A
Author URI: http://github.com/flashmeate
Version: 1.0
*/


define('EFS_PATH', WP_PLUGIN_URL . '/' . plugin_basename( dirname(__FILE__) ) . '/' );
define('EFS_NAME', "Slider");
define ("EFS_VERSION", "0.1");

require_once('slider-img-type.php');

wp_enqueue_script('bxslider', EFS_PATH.'assets/jquery.bxslider.min.js', array('jquery'));
wp_enqueue_style('bxslider_css', EFS_PATH.'assets/jquery.bxslider.css');
wp_enqueue_style('custom_css', EFS_PATH.'assets/custom.css');/***Стили под свой сайт***/

function efs_script(){
 
print "<script type='text/javascript' charset='utf-8'>
  jQuery(document).ready(function() {
   jQuery('.bxslider').bxSlider({
   mode: 'fade',
   captions: true,
	adaptiveheight:true,
	auto:true,
    pager:false,
	});
  });
</script>";
}
add_action('wp_head', 'efs_script');


function efs_get_slider(){	
$slider= '<ul class="bxslider">';
 
    $efs_query= "post_type=slider-image&posts_per_page=10&order=ASC";
        query_posts($efs_query);
    if (have_posts()) : while (have_posts()) : the_post();
        $img= get_the_post_thumbnail( $post->ID, 'large' );
        $slider.='<li>'.$img.'<div class="slideDesc2">'.get_the_content().'</div></li>';
 
    endwhile; endif; wp_reset_query();
 
    $slider.= '</ul>';
	//$page.= count(query_posts($efs_query));
	/*$slider.='<div id="bx-pager"><ul class="slide_pagination">';
		for($i=1;$i<=$page;$i++){
			if($i < 6){
			$slider .= '<li><a data-slide-index="'.$i.'" href="" class="slide_number">'.$i.'</a></li>';
			}
		}
	$slider.= '</ul></div>'*/;
    return $slider;
 
}
 
/**add the shortcode for the slider- for use in editor**/
 
function efs_insert_slider($atts, $content=null){
 
$slider= efs_get_slider();
 
return $slider;
 
}
 
add_shortcode('ef_slider', 'efs_insert_slider');
 
/**add template tag- for use in themes**/
 
function efs_slider(){
    print efs_get_slider();
}





