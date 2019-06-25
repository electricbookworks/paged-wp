<?php
/**
 * Plugin Name: Paged WP
 * Plugin URI:  https://github.com/electricbookworks/paged-wp
 * Description: A WordPress plugin for using paged.js
 * Version:     1.0.1
 * Author:      Electric Book Works
 * Author URI:  https://electricbookworks.com/
 * License:     GPL2
 * License URI: https://www.gnu.org/licenses/gpl-2.0.html
 * Text Domain: paged-wp
 * Domain Path: /languages
 */

if ( ! defined( 'ABSPATH' ) ) {
	return;
}

define( 'PAGED_PLUGIN_DIR', plugin_dir_path( __FILE__ ) );
define( 'PAGED_PLUGIN_URL', plugin_dir_url( __FILE__ ) );
define( 'PAGED_VERSION', '1.0.1' );

/**
 * Register Paged Preview meta box.
 */
function wppaged_register_meta_boxes() {
    add_meta_box( 'meta-box-paged', __( 'Paged Preview', 'textdomain' ), 'wppaged_my_display_callback', 'post', 'side', 'high',
    array(
        '__back_compat_meta_box' => false, 
)
			);
}
add_action( 'add_meta_boxes', 'wppaged_register_meta_boxes' );
 
/**
 * Meta box display callback.
 *
 * @param WP_Post $post Current post object.
 */
function wppaged_my_display_callback( $post ) {
    // Display code/markup goes here. Don't forget to include nonces!
	$preview_link        = esc_url( get_preview_post_link( $post, array( 'paged' => 'true' ) ) );
	$preview_button_text = __( 'Paged Preview' );
	$preview_button      = sprintf(
		'%1$s<span class="screen-reader-text"> %2$s</span>',
		$preview_button_text,
		/* translators: accessibility text */
		__( '(opens in a new window)' )
	);
	?>
	<div class="clear"></div>
	<div style="padding-top:10px;">
		<a class="button" href="<?php echo $preview_link; ?>" target="wp-preview-<?php echo (int) $post->ID; ?>"
		   id="paged-preview"><?php echo $preview_button; ?></a>
	</div>
	<?php
}
 
/**
 * Save meta box content.
 *
 * @param int $post_id Post ID
 */
function wppaged_save_meta_box( $post_id ) {
    // Save logic goes here. Don't forget to include nonce checks!
}
add_action( 'save_post', 'wppaged_save_meta_box' );

/**
 * Frontend actions
 */
/**
 * Check if the paged variable is set and set to true
 */
function paged_is_paged_preview() {
	if ( isset( $_GET['paged'] ) ) {
		$paged = filter_var( $_GET['paged'], FILTER_SANITIZE_STRING );
		if ( 'true' !== $paged ) {
			return false;
		}

		return true;
	}

	return false;
}

/**
 * Add paged CSS from source
 */
add_action( 'paged_head', 'paged_render_paged_css' );
function paged_render_paged_css() {
	if ( paged_is_paged_preview() ) {
		?>
      <link rel="stylesheet" id="paged-css" href="<?php echo plugin_dir_url( __FILE__ ) . 'themes/template/main.css'; ?>" type="text/css" />
		<?php
	}
}

/**
 * Add paged JS from source
 */
add_action( 'paged_foot', 'paged_render_paged_js' );
function paged_render_paged_js() {
	if ( paged_is_paged_preview() ) {
		?>
        <script type='text/javascript' src='https://unpkg.com/pagedjs/dist/paged.polyfill.js?ver=<?php echo PAGED_VERSION ?>'></script>
		<?php
	}
}

/**
 * Override default template when using the paged preview.
 */
add_filter( 'template_include', 'paged_template_include', 99 );
function paged_template_include( $template ) {

	if ( paged_is_paged_preview() ) {
		$template = trailingslashit( PAGED_PLUGIN_DIR ) . 'templates/index.php';
	}

	return $template;
}
