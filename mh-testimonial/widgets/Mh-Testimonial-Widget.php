<?php 
class Mh_Testimonial_Widgets extends WP_Widget{
    public function __construct() {
        $widget_options = array('description'=>__('MH Testimonial', 'mh-testimonial'));

		parent::__construct(
			'mh-testimonial',  // Base ID
			__('MH Testimonial', 'mh-testimonial') // Name
		);

		add_action( 'widgets_init', function() {
			register_widget( 'Mh_Testimonial_Widgets' );
		});

        if( is_active_widget( false, false, $this->id_base ) ){
            add_action( 'wp_enqueue_scripts', array( $this, 'enqueue' ) );
        }


	}

    public function enqueue(){
        wp_enqueue_style(
            'mh-testimonials-style-css',
            MH_TESTIMONIAL_URL . 'public/css/frontend.css',
            array(),
            MH_TESTIMONIAL_VERSION,
            'all'
        );
    }


    public $args = array(
		'before_title'  => '<h4 class="widgettitle">',
		'after_title'   => '</h4>',
		'before_widget' => '<div class="widget-wrap">',
		'after_widget'  => '</div></div>',
	);


    public function widget($args, $instance)
    {
        $default_title = 'MH Testimonials';
        $title = ! empty( $instance['title'] ) ? $instance['title'] : $default_title;
        $number = ! empty( $instance['number'] ) ? $instance['number'] : 5;
        $image = isset( $instance['image'] ) ? $instance['image'] : false;
        $occupation = isset( $instance['occupation'] ) ? $instance['occupation'] : false;
        $company = isset( $instance['company'] ) ? $instance['company'] : false;

        echo $args['before_widget'];
        echo $args['before_title'] . $title . $args['after_title'];

        require( MH_TESTIMONIAL_PATH . 'views/mh-testimonials_widget.php' );
        
        echo $args['after_widget'];

    }
    public function form($instance)
    {
        $title = isset($instance['title']) ? $instance['title'] : '';
        $number = isset( $instance['number'] ) ? (int) $instance['number'] : 5;
        $image = isset( $instance['image'] ) ? (bool) $instance['image'] : false;
        $occupation = isset( $instance['occupation'] ) ? (bool) $instance['occupation'] : false;
        $company = isset( $instance['company'] ) ? (bool) $instance['company'] : false;
        ?>
            <p>
                <label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php esc_html_e( 'Title', 'mh-testimonials' ); ?>:</label>
                <input type="text" class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" value="<?php echo esc_attr( $title ); ?>">
            </p>

            <p>
                <label for="<?php echo $this->get_field_id( 'number' ); ?>"><?php esc_html_e( 'Number of testimonials to show', 'mh-testimonials' ); ?>:</label>
                <input type="number" class="tiny-text" id="<?php echo $this->get_field_id( 'number' ); ?>" name="<?php echo $this->get_field_name( 'number' ); ?>" step="1" min="1" size="3" value="<?php echo esc_attr( $number ); ?>">
            </p>

            <p>
                <input type="checkbox" class="checkbox" id="<?php echo $this->get_field_id( 'image' ); ?>" name="<?php echo $this->get_field_name( 'image' ); ?>" <?php checked( $image ); ?>>
                <label for="<?php echo $this->get_field_id( 'image' ); ?>"><?php esc_html_e( 'Display user image?', 'mh-testimonials' ); ?></label>
            </p>

            <p>
                <input type="checkbox" class="checkbox" id="<?php echo $this->get_field_id( 'occupation' ); ?>" name="<?php echo $this->get_field_name( 'occupation' ); ?>" <?php checked( $occupation ); ?>>
                <label for="<?php echo $this->get_field_id( 'occupation' ); ?>"><?php esc_html_e( 'Display occupation?', 'mh-testimonials' ); ?></label>
            </p>

            <p>
                <input type="checkbox" class="checkbox" id="<?php echo $this->get_field_id( 'company' ); ?>" name="<?php echo $this->get_field_name( 'company' ); ?>" <?php checked( $company ); ?>>
                <label for="<?php echo $this->get_field_id( 'company' ); ?>"><?php esc_html_e( 'Display company?', 'mh-testimonials' ); ?></label>
            </p>

        <?php
    }
    public function update( $new_instance, $old_instance ) 
    {
        $instance = $old_instance;
        $instance['title'] = sanitize_text_field( $new_instance['title'] );
        $instance['number'] = (int) $new_instance['number'];
        $instance['image'] = ! empty ( $new_instance['image'] ) ? 1 : 0;
        $instance['occupation'] = ! empty ( $new_instance['occupation'] ) ? 1 : 0;
        $instance['company'] = ! empty ( $new_instance['company'] ) ? 1 : 0;
        return $instance;

    }
}