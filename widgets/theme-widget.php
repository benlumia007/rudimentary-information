<?php
/*
================================================================================================
Rudimentary Information - theme-widget.php
================================================================================================
This holds the main class that can be used to get information about a theme that comes from the
wordpress.org themes API. It caches calls on a theme by bases.

@package        Rudimentary Information Plugin
@copyright      Copyright (C) 2017. Benjamin Lu
@license        GNU General Public License v2 or later (http://www.gnu.org/licenses/gpl-2.0.html)
@author         Benjamin Lu (https://www.benjlu.com/)
================================================================================================
*/

/*
================================================================================================
Table of Content
================================================================================================
 1.0 - Forbidden Access
 2.0 - Rudimentary Information Themes Widget Class Setup
================================================================================================
*/

/*
================================================================================================
 1.0 - Forbidden Access
================================================================================================
*/
if (!defined('ABSPATH')) { 
    exit;
}

/*
================================================================================================
 2.0 - Rudimentary Information Themes Widget Class Setup
================================================================================================
*/
class Rudimentary_Information_Themes_Widget extends WP_Widget {
    /*
    ============================================================================================
     Constructor function that is used to add its widget form. This widget is sued to ouput theme
     information obtained from the WordPress.org Themes API and format nicely in presented table.
    ============================================================================================
    */
    public function __construct() {
        $widget_options = array(
            'classname' => 'riti_widget',
            'description' => __('A widget to ouput information if a slug is set', 'rudimentary-information'),
        );
        parent::__construct('riti_widget', 'Theme Info', $widget_options);
    }
    
    /*
    ============================================================================================
    A method to output a form for a widget in the widget admin area.
    ============================================================================================
    */
	public function form( $instance ) {
		$title = !empty($instance['title']) ? $instance['title'] : '';
		?>
		<p>
            <label for="<?php echo esc_attr($this->get_field_id('title')); ?>"><?php esc_attr_e('Title: ', 'rudimentary-information'); ?></label> 
            <input id="<?php echo esc_attr($this->get_field_id('title')); ?>" name="<?php echo esc_attr($this->get_field_name('title')); ?>" type="text" value="<?php echo esc_attr($title); ?>">
		</p>
		<?php 
	}
    
    /*
    ============================================================================================
    This is the main render function for the widget. It handles outputs for the markups and getting
    any data for use in that markup. Echos the $html once it is generated. Returns false if it fails.
    ============================================================================================
    */
	public function widget( $args, $instance ) {
        global $post;
        $slug = get_post_meta($post->ID, '_riti_theme_slug', true);
        
        if (!$slug) {
            return false;
        }
        
        $theme_info = Rudimentary_Information_Themes::get_theme_info($slug);
        
        if (is_object($theme_info)) {
            $fields = array(
				'last_updated'  => __( 'Last Updated:', 'rudimentary-information'),
				'version'       => __( 'Version:', 'rudimentary-information'),
				'downloaded'    => __( 'Downloaded:', 'rudimentary-information'),
            );
        }
        
        // allow these fields to be filtered to add/remove items or reorder.
        $fields = apply_filters( 'riti_slug_field', $fields );
        
        ob_start();
        echo $args['before_widget'] . $args['before_title'] . apply_filters( 'widget_title', $instance['title'] ) . $args['after_title'];
        ?>
        <table class="rudimentary-information">
            <tbody>
                <?php foreach ($fields as $key => $field) { ?>
                    <tr>
                        <th><?php echo esc_html($field); ?></th>
                        
                        <?php if ('preview_url' === $key || 'homepage' === $key || 'download_link' === $key) { ?>
                            <?php
                                switch ($key) {
									case 'preview_url':
										$text = $theme_info->name;
										break;
									case 'homepage':
										$text = $theme_info->name;
										break;
									case 'download_link':
										$text = $theme_info->name;
										break;
									default:
										$text = $theme_info->name;
                                } ?>
                                <td><a href="<?php echo esc_url($theme_info->$key ); ?>"><?php echo esc_html(apply_filters('filter_theme_link_text', $text, $theme_info, $key)); ?></a></td>
                        <?php } else if ('downloaded' === $key) {
                                $downloaded = absint($theme_info->downloaded);
                                $downloaded_format = number_format($downloaded); ?>
                                <td><?php echo esc_html($downloaded_format); ?></td> 
                        <?php } else if ('last_updated' === $key) {
                                $time = strtotime($theme_info->last_updated);
                                $format_date = date(get_option('date_format'), $time); ?>
                                <td><?php echo esc_html($format_date); ?></td> 
                        <?php } else { ?>
                            <td><?php echo esc_html( $theme_info->$key ); ?></td>
                        <?php } ?>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
        <?php
        echo $args['after_widget'];
        // get all of the buffered content that we injected/echoed.
        $html = ob_get_clean();
        // echo the full $html.
        echo $html;
	}
    
	public function update($new_instance, $old_instance) {
		$instance = array();
		$instance['title'] = (!empty($new_instance['title'])) ? strip_tags($new_instance['title']) : '';
		return $instance;
	}
}