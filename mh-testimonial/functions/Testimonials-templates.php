<?php 
if(!class_exists('Testimonials_Templates_Files'))
{
    class Testimonials_Templates_Files{
        public  function __construct()
        {
            add_filter('archive_template', array($this,'load_custom_archive_template'));
            add_filter('single_template', array($this,'load_custom_single_template'));
        }

        public function load_custom_archive_template($archive_template)
        {
            if(current_theme_supports('mh-testimonials'))
            {
                if(is_post_type_archive('mh-testimonials'))
                {
                    //$archive_template = MH_TESTIMONIAL_PATH . '/views/templates/archive-mh-testimonials.php';
                    $archive_template = $this->get_template_part_location('archive-mh-testimonials.php');
                }

            }
            return $archive_template;
            
        }

        public function load_custom_single_template($single_template)
        {
            if(current_theme_supports('mh-testimonials'))
            {
                if(is_singular('mh-testimonials'))
                {
                    //$single_template = MH_TESTIMONIAL_PATH . '/views/templates/single-mh-testimonials.php';
                    $single_template = $this->get_template_part_location('single-mh-testimonials.php');

                }

            }
            return $single_template;

        }

        public function get_template_part_location( $file )
        {
            if( file_exists( MH_TESTIMONIAL_OVERRIDE_PATH_DIR . $file ) )
            {
                $file = MH_TESTIMONIAL_OVERRIDE_PATH_DIR . $file;
            }
            else
            {
                $file = MH_TESTIMONIAL_PATH . 'views/templates/' . $file;
            }
            return $file;
        }
    }

}