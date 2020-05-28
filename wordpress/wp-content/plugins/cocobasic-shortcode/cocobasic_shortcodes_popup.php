<?php

$absolute_path = __FILE__;
$path_to_file = explode('wp-content', $absolute_path);

if (count($path_to_file) > 1) {
    /* got wp-content dir */
    $path_to_wp = $path_to_file[0];
} else {
    /* dev environement */
    $path_to_file = explode('content', $absolute_path);
    $path_to_wp = $path_to_file[0] . '/wp';
}
// Access WordPress
require_once( $path_to_wp . '/wp-load.php' );
?>
<html>
    <head>
        <style>
            #cocobasic_shortcodes_popup_holder
            {
                position:absolute;
            }
            #cocobasic_shortcodes_popup
            {
                background-color: #efefef;
                padding: 5px;
                border: 1px solid #ccc;
                border-radius: 5px;
            }
            #cocobasic_shortcodes_popup ul 
            {
                margin: 0px;
                padding: 0px;
                list-style-type: none;
            }
            #cocobasic_shortcodes_popup ul li
            {
                margin: 0;
            }
            #cocobasic_shortcodes_popup ul li:hover 
            {
                background-color: #ccc;
            }
            #cocobasic_shortcodes_popup a
            {
                color: #333333;
                text-decoration: none;
                padding: 5px 20px;
                display: block;
                line-height: 20px;
            }
            #cocobasic_shortcodes_popup ul li.shortcode_divider_line 
            {			
                border-top: #ccc solid 2px;
                margin-bottom: 2px;
                margin-top: 2px;
            }		
            small
            {
                display:block;
                float:left;
                margin-left: 25px;
            }
            #TB_ajaxContent 
            {
                padding-left: 30px !important;
                height: auto !important;
            }
            .wp_themeSkin div
            {
                z-index:9999;
            }
            #TB_window 
            { 
                z-index: 100100; 
                height: auto !important;
                border-radius: 5px !important;
            }

            #TB_ajaxContent select, #TB_ajaxContent input, #TB_ajaxContent textarea
            {
                margin-top: 17px;
                margin-left: 25px;
            }
            #TB_title
            {
                border-top-left-radius: 5px;
                border-top-right-radius: 5px;
                background-color: #EFEFEF !important;
                font-size: 18px;
                padding: 15px;
            }

            #TB_ajaxContent input#submit_shortcode
            {
                margin-left: 0;
            }

            #TB_ajaxContent input[type=checkbox]
            {
                margin-top: 0;
            }

            .tb-close-icon
            {
                top: 0 !important;
            }

            #cocobasic_shortcode_columns select 
            {
                text-align: center;
                width: 150px;
            }
        </style>
    </head>
    <body>
        <div id="cocobasic_shortcodes_popup">
            <ul>  
                <li><a id="cocobasic_columns" href="#"><?php echo esc_html__('Columns', 'cocobasic-shortcode'); ?></a></li>			  
                <li><a id="cocobasic_service" href="#"><?php echo esc_html__('Service', 'cocobasic-shortcode'); ?></a></li>                                                                
                <li><a id="cocobasic_skills" href="#"><?php echo esc_html__('Skills', 'cocobasic-shortcode'); ?></a></li>                                
                <li><a id="cocobasic_video_up" href="#"><?php echo esc_html__('Video PopUp', 'cocobasic-shortcode'); ?></a></li>                                                              
                <li class="shortcode_divider_line">     </li>	
                <li><a id="cocobasic_image_slider" href="#"><?php echo esc_html__('Image Slider Holder', 'cocobasic-shortcode'); ?></a></li>
                <li><a id="cocobasic_image_slide" href="#"><?php echo esc_html__('Image Slide', 'cocobasic-shortcode'); ?></a></li>                                              
                <li class="shortcode_divider_line">     </li>	                
                <li><a id="cocobasic_big_text" href="#"><?php echo esc_html__('Big Text', 'cocobasic-shortcode'); ?></a></li>
                <li><a id="cocobasic_med_text" href="#"><?php echo esc_html__('Medium Text', 'cocobasic-shortcode'); ?></a></li>                                
                <li><a id="cocobasic_info_text" href="#"><?php echo esc_html__('Info Text', 'cocobasic-shortcode'); ?></a></li>                                
                <li class="shortcode_divider_line">     </li>	                                	  	  	
                <li><a id="cocobasic_latest_posts" href="#"><?php echo esc_html__('Latest Posts (News)', 'cocobasic-shortcode'); ?></a></li>                                
                <li><a id="cocobasic_pulse" href="#"><?php echo esc_html__('Pulse (Animation)', 'cocobasic-shortcode'); ?></a></li>                                
                <li><a id="cocobasic_button" href="#"><?php echo esc_html__('Button', 'cocobasic-shortcode'); ?></a></li>                                                   
            </ul>
        </div>
    </body>
</html>