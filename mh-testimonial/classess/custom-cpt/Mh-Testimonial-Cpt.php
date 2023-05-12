<?php 

if(!class_exists('Mh_Testimonial_Cpt')){
   
    /**
     * Summary of mh_slider_cpt
     */
    class Mh_Testimonial_Cpt{

        /**
         * Summary of __construct
         */
        function __construct()
        {
            add_action('init', array($this, 'mh_Testimonial_Cpt'));
            // column works 
            // add_filter('manage_mh-slider_posts_columns',array($this,'mh_slider_cpt_columns'));
            // add_action('manage_mh-slider_posts_custom_column', array($this, 'mh_slider_custom_columns'),10,2);
            // add_filter('manage_edit-mh-slider_sortable_columns',array($this,'mh_slider_sortable_columns'));
            //add_filter( 'post_row_actions', array($this,'modify_list_row_actions'), 10, 2 );

        }


         /**
          * Summary of create_post_type
          * @return void
          */
         public function mh_Testimonial_Cpt():void
        {
            register_post_type('mh-testimonials', array(

                'labels'  => array(
                'name'    => esc_html('MH Testimonial', 'mh-Testimonial'),
                'singular_name' => __('MH Testimonial', 'mh-Testimonial'),
                ),
                'public'      => true,
				'has_archive' => true,
               'rewrite'     => array( 'slug' => 'testimonials' ), // my custom slug
               'supports'           => array( 'title', 'editor', 'author', 'thumbnail', 'excerpt', 'comments' ),
               'hierarchical'       => false,
               'capability_type'    => 'post',
               'query_var'          => true,
               'show_in_menu'       => true,
               'show_ui'            => true,
               'publicly_queryable' => true,
               'menu_position'      => 10,
               'show_in_admin_bar'  => true,
               'show_in_nav_menus'  =>true,
               'show_in_rest'       => true,
               'can_export'         =>true,
                'has_archive'       => true,
                'menu_icon'          =>'dashicons-format-status'
            )); 
        }
    }
}