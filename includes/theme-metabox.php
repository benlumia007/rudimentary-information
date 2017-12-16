<?php
/*
================================================================================================
Rudimentary Information - theme-metabox.php
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
 2.0 - Theme Info Metabox
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
 2.0 - Theme Info Metabox
================================================================================================
*/
class Rudimentary_Information_Themes_Metabox {
    public static $instance = null;
    
    public static function init() {
        if (null === self::$instance) {
            self::$instance = new Rudimentary_Information_Themes_Metabox;
        }
        return self::$instance;
    }
    
    private function __construct() {
        add_action('add_meta_boxes', array($this, 'add_theme_slug_metabox'));
        add_action('save_post', array($this, 'save_theme_slug_metabox'));
    }
    
    public function add_theme_slug_metabox($post_type) {
        $post_types = array('jetpack-portfolio');
        $post_types = apply_filters('filter_riti_metabox_post_type', $post_types);
        
        if (in_array($post_type, $post_types, true)) {
            add_meta_box(
                'riti_theme_slug_metabox', __('Theme Slug', 'riti_theme_slug_metabox_nonce'), array($this, 'render_theme_slug_metabox_content'), $post_type, 'side', 'high'
            );
        }
    }
    
    public function save_theme_slug_metabox($post_id) {
		if ( ! isset( $_POST['riti_theme_slug_metabox_nonce'] ) ) {
			return $post_id;
		}
        
        $nonce = $_POST['riti_theme_slug_metabox_nonce'];
		// Verify that the nonce is valid.
		if ( ! wp_verify_nonce( $nonce, 'riti_theme_slug_metabox_inner_nonce' ) ) {
			return $post_id;
		}
        
		if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
			return $post_id;
		}
        
		if ( 'page' == $_POST['post_type'] ) {
			if ( ! current_user_can( 'edit_page', $post_id ) ) {
				return $post_id;
			}
		} else {
			if ( ! current_user_can( 'edit_post', $post_id ) ) {
				return $post_id;
			}
		}
        
		$data_slug = sanitize_text_field( $_POST['riti_slug_field'] );
		// Update the meta field.
		update_post_meta( $post_id, '_riti_theme_slug', $data_slug );
    }
    
	public function render_theme_slug_metabox_content( $post ) {
		// Add an nonce field so we can check for it later.
		wp_nonce_field( 'riti_theme_slug_metabox_inner_nonce', 'riti_theme_slug_metabox_nonce' );
		// Use get_post_meta to retrieve an existing value from the database.
		$value = get_post_meta( $post->ID, '_riti_theme_slug', true );
		// Display the form, using the current value.
		?>
		<label for="riti_slug_field">
			<?php echo esc_html( 'Please enter a theme slug to be attached to the Jetpack Portfolio CPT.', 'rudimentary-information' ); ?>
		</label>
        <p>
		<input type="text" id="riti_slug_field" name="riti_slug_field" value="<?php echo esc_attr( $value ); ?>" size="25" />
        </p>
		<?php
	}
    
}