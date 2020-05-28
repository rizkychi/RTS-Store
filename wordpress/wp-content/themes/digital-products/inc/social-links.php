    <?php 
// Creating the widget 
class Social_Links extends WP_Widget {
    function __construct() {
        parent::__construct(
            // Base ID of your widget
            'Social_Links', 
            // Widget name will appear in UI
            __('Social Widget', 'digital-products'),
            // Widget description
            array( 'description' => __( 'Set your social icon and social links here.', 'digital-products' ), ) 
        );
    }
    // Creating widget front-end
    // This is where the action happens
    public function widget( $args, $instance ) {
        $id_base = 'sociallink_digital_products';
        $title = apply_filters( 'widget_title', $instance['title'],$instance , $id_base);
        $social_link1   = ! empty( $instance['social_link1'] ) ? $instance['social_link1'] : false;
        $social_class1  = ! empty( $instance['social_class1'] ) ?  $instance['social_class1']  : false;
        $social_link2   = ! empty( $instance['social_link2'] ) ?  $instance['social_link2']  : false;
        $social_class2  = ! empty( $instance['social_class2'] ) ?  $instance['social_class2']  : false;
        $social_link3   = ! empty( $instance['social_link3'] ) ?  $instance['social_link3']  : false;
        $social_class3  = ! empty( $instance['social_class3'] ) ?  $instance['social_class3']  : false;
        $social_link4   = ! empty( $instance['social_link4'] ) ?  $instance['social_link4']  : false;
        $social_class4  = ! empty( $instance['social_class4'] ) ?  $instance['social_class4']  : false;
        $social_link5   = ! empty( $instance['social_link5'] ) ?  $instance['social_link5']  : false;
        $social_class5  = ! empty( $instance['social_class5'] ) ?  $instance['social_class5']  : false;
        // before and after widget arguments are defined by themes
        echo $args['before_widget'];
        if ( ! empty( $title ) )
        echo $args['before_title'] . $title . $args['after_title'];
        // This is where you run the code and display the output ?>
        <div>
            <?php if($social_link1 != false && $social_class1 != false) : ?>
                <a href="<?php echo esc_url($social_link1); ?>" class="social_icons"><i class="fa <?php echo esc_attr($social_class1); ?>"></i></a>
            <?php endif; ?>
            <?php if($social_link2 != '' && $social_class2 != '') : ?>
                <a href="<?php echo esc_url($social_link2); ?>" class="social_icons"><i class="fa <?php echo esc_attr($social_class2); ?>"></i></a>
            <?php endif; ?>
            <?php if($social_link3 != '' && $social_class3 != '') : ?>
                <a href="<?php echo esc_url($social_link3); ?>" class="social_icons"><i class="fa <?php echo esc_attr($social_class3); ?>"></i></a>
            <?php endif; ?>
            <?php if($social_link4 != '' && $social_class4 != '') : ?>
                <a href="<?php echo esc_url($social_link4); ?>" class="social_icons"><i class="fa <?php echo esc_attr($social_class4); ?>"></i></a>
            <?php endif; ?>
            <?php if($social_link5 != '' && $social_class5 != '') : ?>
                <a href="<?php echo esc_url($social_link5); ?>" class="social_icons"><i class="fa <?php echo esc_attr($social_class5); ?>"></i></a>
            <?php endif; ?>
        </div>
        <?php echo $args['after_widget'];
    }
    // Widget Backend 
    public function form( $instance ) {
        $menus = wp_get_nav_menus();
        if ( isset( $instance[ 'title' ] ) ) {
            $title = $instance[ 'title' ];
        }
        else {
            $title = __( 'New title', 'digital-products' );
        }
        $social_link1   = isset( $instance['social_link1'] )  ? $instance['social_link1']    : '';
        $social_class1  = isset( $instance['social_class1'] ) ? $instance['social_class1']  : '';
        $social_link2   = isset( $instance['social_link2'] )  ? $instance['social_link2']    : '';
        $social_class2  = isset( $instance['social_class2'] ) ? $instance['social_class2']  : '';
        $social_link3   = isset( $instance['social_link3'] )  ? $instance['social_link3']    : '';
        $social_class3  = isset( $instance['social_class3'] ) ? $instance['social_class3']  : '';
        $social_link4   = isset( $instance['social_link4'] )  ? $instance['social_link4']    : '';
        $social_class4  = isset( $instance['social_class4'] ) ? $instance['social_class4']  : '';
        $social_link5   = isset( $instance['social_link5'] )  ? $instance['social_link5']    : '';
        $social_class5  = isset( $instance['social_class5'] ) ? $instance['social_class5']  : '';
        // Widget admin form ?>
        <p>
            <label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php esc_html_e( 'Title:' ,'digital-products' ); ?></label>
            <input class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" type="text" value="<?php echo esc_attr( $title ); ?>" />
        </p>
        <p>
            <label><?php esc_html_e( 'Social 1:' ,'digital-products' ); ?></label>
            <input class="widefat" id="<?php echo $this->get_field_id( 'social_class1' ); ?>" name="<?php echo $this->get_field_name( 'social_class1' ); ?>" type="text" value="<?php echo esc_attr( $social_class1 ); ?>" placeholder="fa-facebook" />
            <input class="widefat" id="<?php echo $this->get_field_id( 'social_link1' ); ?>" name="<?php echo $this->get_field_name( 'social_link1' ); ?>" type="text" value="<?php echo esc_url( $social_link1 ); ?>" placeholder="<?php echo esc_url('http://facebook.com'); ?>" />
        </p>
        <p>
            <label><?php esc_html_e( 'Social 2:' ,'digital-products' ); ?></label>
            <input class="widefat" id="<?php echo $this->get_field_id( 'social_class2' ); ?>" name="<?php echo $this->get_field_name( 'social_class2' ); ?>" type="text" value="<?php echo esc_attr( $social_class2 ); ?>" placeholder="fa-google" />
            <input class="widefat" id="<?php echo $this->get_field_id( 'social_link2' ); ?>" name="<?php echo $this->get_field_name( 'social_link2' ); ?>" type="text" value="<?php echo esc_url( $social_link2 ); ?>" placeholder="<?php echo esc_url('http://plus.google.com/'); ?>" />
        </p>
        <p>
            <label><?php esc_html_e( 'Social 3:' ,'digital-products' ); ?></label>
            <input class="widefat" id="<?php echo $this->get_field_id( 'social_class3' ); ?>" name="<?php echo $this->get_field_name( 'social_class3' ); ?>" type="text" value="<?php echo esc_attr( $social_class3 ); ?>" placeholder="fa-twitter" />
            <input class="widefat" id="<?php echo $this->get_field_id( 'social_link3' ); ?>" name="<?php echo $this->get_field_name( 'social_link3' ); ?>" type="text" value="<?php echo esc_url( $social_link3 ); ?>" placeholder="<?php echo esc_url('http://twitter.com'); ?>" />
        </p>
        <p>
            <label><?php esc_html_e( 'Social 4:' ,'digital-products' ); ?></label>
            <input class="widefat" id="<?php echo $this->get_field_id( 'social_class4' ); ?>" name="<?php echo $this->get_field_name( 'social_class4' ); ?>" type="text" value="<?php echo esc_attr( $social_class4 ); ?>" placeholder="fa-linkedin" />
            <input class="widefat" id="<?php echo $this->get_field_id( 'social_link4' ); ?>" name="<?php echo $this->get_field_name( 'social_link4' ); ?>" type="text" value="<?php echo esc_url( $social_link4 ); ?>" placeholder="<?php echo esc_url('https://www.linkedin.com/'); ?>" />
        </p>
        <p>
            <label><?php esc_html_e( 'Social 5:' ,'digital-products' ); ?></label>
            <input class="widefat" id="<?php echo $this->get_field_id( 'social_class5' ); ?>" name="<?php echo $this->get_field_name( 'social_class5' ); ?>" type="text" value="<?php echo esc_attr( $social_class5 ); ?>" placeholder="fa-pinterest" />
            <input class="widefat" id="<?php echo $this->get_field_id( 'social_link5' ); ?>" name="<?php echo $this->get_field_name( 'social_link5' ); ?>" type="text" value="<?php echo esc_url( $social_link5 ); ?>" placeholder="<?php echo esc_url('https://www.pinterest.com/'); ?>" />
        </p>
    <?php }
    
    // Updating widget replacing old instances with new
    public function update( $new_instance, $old_instance ) {
        $instance = array();
        $instance['title']          = ( ! empty( $new_instance['title'] ) ) ? sanitize_text_field( $new_instance['title'] ) : '';
        $instance['social_class5']  = ( ! empty( $new_instance['social_class5'] ) ) ? sanitize_text_field( $new_instance['social_class5'] ) : '';
        $instance['social_link5']   = ( ! empty( $new_instance['social_link5'] ) ) ? esc_url_raw( $new_instance['social_link5'] ) : '';
        $instance['social_class4']  = ( ! empty( $new_instance['social_class4'] ) ) ? sanitize_text_field( $new_instance['social_class4'] ) : '';
        $instance['social_link4']   = ( ! empty( $new_instance['social_link4'] ) ) ? esc_url_raw( $new_instance['social_link4'] ) : '';
        $instance['social_class3']  = ( ! empty( $new_instance['social_class3'] ) ) ? sanitize_text_field( $new_instance['social_class3'] ) : '';
        $instance['social_link3']   = ( ! empty( $new_instance['social_link3'] ) ) ? esc_url_raw( $new_instance['social_link3'] ) : '';
        $instance['social_class2']  = ( ! empty( $new_instance['social_class2'] ) ) ? sanitize_text_field( $new_instance['social_class2'] ) : '';
        $instance['social_link2']   = ( ! empty( $new_instance['social_link2'] ) ) ? esc_url_raw( $new_instance['social_link2'] ) : '';
        $instance['social_class1']  = ( ! empty( $new_instance['social_class1'] ) ) ? sanitize_text_field( $new_instance['social_class1'] ) : '';
        $instance['social_link1']   = ( ! empty( $new_instance['social_link1'] ) ) ? esc_url_raw( $new_instance['social_link1'] ) : '';
        return $instance;
    }
} // Class wpb_widget ends here
// Register and load the widget
function social_links_active() {
    register_widget( 'Social_Links' );
}
add_action( 'widgets_init', 'social_links_active' );