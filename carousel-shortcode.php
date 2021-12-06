<?php
function jbm_carousel_shortcode($atts){
	
	$atts = shortcode_atts( array(
		'id' => '',
		'text-align' => "",
		'margin' => "",
		'image-height' => "",
		'image-width' => "100%",
		'item-height' => "",
		'container-class' => '',
		'cols' => 3,
		'gap' => '10'
	), $atts, 'jbm_carousel_shortcode' );
	
	jbm_carousel_control($atts['id'], $atts['cols'], $atts['gap']);
	
    $text_align = !empty($atts['text-align']) && isset($atts['text-align']) ? 'text-align:'. $atts['text-align'] : '';
    $margin = !empty($atts['margin']) && isset($atts['margin']) ? 'margin:'. $atts['margin'] : '';
    
	//$entries = get_post_meta( $atts['id'], 'jbm_group_carousel', true );
	$entries = wp_get_recent_posts();
	$carousel_html = '<div id="owl-carousel-'.$atts["id"].'" class="owl-carousel owl-theme '.$atts["container-class"].'">';
	foreach ( (array) $entries as $key => $entry ) {

	$songtitle = '';
	$recent_post_url = get_permalink($entry["ID"]);
	$featured_img_url = get_the_post_thumbnail_url($entry["ID"],'full');
	
	
//print_r($entry);
		/***if(isset( $entry['jbm_carousel_title'] ) ){
			//$title = esc_html( $entry['jbm_carousel_title'] );
			$link_to_page = esc_html( $entry['jbm_carousel_link_to_page'] );
		}
		if(isset( $entry['jbm_carousel_title'] ) ){
			$desc = esc_html( $entry['jbm_carousel_description'] );
		}
		if(isset( $entry['jbm_carousel_title'] ) ){
			$img = esc_html( $entry['jbm_carousel_image'] );
		}***/
		
		$carousel_html .= '<div class="item" style="height:'.$atts['item-height'].';">
		<div class="img-title">
			<div class="pic">
				<figure>   
					<a href="'.$recent_post_url.'"><img src="'.$featured_img_url.'" style="width:'.$atts['image-width'].'; height:'.$atts['image-height'].';"/></a>
				</figure>
			</div>
			<div class="nopadding">
				<h2 style="'.$text_align.';'.$margin.'"><a href="'.$recent_post_url.'">'.$entry["post_title"].'</a></h2>
			</div>
		</div>
		<div class="content">
		   <p style="'.$text_align.';'.$margin.'">'.$entry["post_content"].'</p>
        </div>
		<div class="link">
			<a href="'.$recent_post_url.'"> more &gt; </a>
		</div>
		</div>';

		}
	$carousel_html .= '</div>';

	return $carousel_html;
}

function jbm_carousel_control($id, $cols, $gap){
    
    echo "<script>
            jQuery(document).ready(function() {
        	var owl = jQuery('#owl-carousel-$id');
        	owl.owlCarousel({
        	margin: $gap,
        	nav: true,
			/*dots: true,*/
            autoplay:true,
            autoplayTimeout:5000,
            autoplayHoverPause:true,
            smartSpeed:1000,
        	loop: false,
        		responsive: {
        		  0: {
        			items: 1
        		  },
        		  768: {
        			items: 2
        		  },
        		  1024: {
        			items: $cols,
					slideBy: 3
        		  }
        		}
        	});
        });
    </script>";
    
}
?>
