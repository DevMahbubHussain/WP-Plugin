<?php

 if(!class_exists('Mh_Testimonial_cpt_metaboxex')){
    /**
     * Summary of mh_Testimonial_cpt_metaboxex
     */
    class Mh_Testimonial_cpt_metaboxex{
        function __construct()
        {
            add_action('add_meta_boxes', array($this, 'mh_Testimonial_metaboxes'));
            add_action( 'save_post', array($this,'save_meta_post'),10,2);
        }

        /**
         * Summary of mh_Testimonial_metaboxes
         * @return void
         */
        public function mh_Testimonial_metaboxes():void
        {
            //add_meta_box($id, $title, $callback, $screen, $context, $priority, $callback_args)

            add_meta_box(
              'mh_testimonials_meta_box',
               esc_html__( 'Testimonials Options', 'mh-testimonial' ),
               array($this,'add_inner_meta_boxes'),
                'mh-testimonials',
                'normal',
                'high',

            );
        }
      
        /**
         * Add html input filed
         * @param mixed $post
         * @return void
         */
        public function add_inner_meta_boxes($post):void
        {
            //require_once(MH_Testimonial_PATH . '../../views/mh_Testimonial_metabox_field.php');
            require_once(MH_TESTIMONIAL_PATH . 'views/mh_testimonial_metabox_field.php');
        }

        public function save_meta_post( $post_id ){
            if( isset( $_POST['mh_testimonials_nonce'] ) ){
                if( ! wp_verify_nonce( $_POST['mh_testimonials_nonce'], 'mh_testimonials_nonce' ) ){
                    return;
                }
            }

            if( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ){
                return;
            }

            if( isset( $_POST['post_type'] ) && $_POST['post_type'] === 'mh-testimonials' ){
                if( ! current_user_can( 'edit_page', $post_id ) ){
                    return;
                }elseif( ! current_user_can( 'edit_post', $post_id ) ){
                    return;
                }
            }

            if (isset($_POST['action']) && $_POST['action'] == 'editpost') {

                $old_occupation = get_post_meta( $post_id, 'mh_testimonials_occupation', true ); 
                $new_occupation = $_POST['mh_testimonials_occupation'];
                $old_company    = get_post_meta( $post_id, 'mh_testimonials_company', true ); 
                $new_company    = $_POST['mh_testimonials_company'];
                $old_user_url   = get_post_meta( $post_id, 'mh_testimonials_user_url', true ); 
                $new_user_url   = $_POST['mh_testimonials_user_url']; 
            
                update_post_meta( $post_id, 'mh_testimonials_occupation', sanitize_text_field( $new_occupation ), $old_occupation );
                update_post_meta( $post_id, 'mh_testimonials_company', sanitize_text_field( $new_company ), $old_company );
                update_post_meta( $post_id, 'mh_testimonials_user_url', esc_url_raw( $new_user_url ), $old_user_url );
            }            
        }
          
    }
 }