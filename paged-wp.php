<?php
/**
 * Plugin Name: Paged WP
 * Plugin URI:  https://github.com/electricbookworks/paged-wp
 * Description: A WordPress plugin for using paged.js
 * Version:     1.0.0
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
define( 'PAGED_VERSION', '1.0.0' );

/**
 * Admin actions
 */
/**
 * Adds Paged Preview Button to Page Public Post Box
 */
add_action( 'post_submitbox_minor_actions', 'paged_add_paged_preview_button', 10, 1 );
function paged_add_paged_preview_button( $post ) {
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
		<a class="preview button" href="<?php echo $preview_link; ?>" target="wp-preview-<?php echo (int) $post->ID; ?>"
		   id="post-preview"><?php echo $preview_button; ?></a>
	</div>
	<?php
}

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
        <link rel='stylesheet' id='paged-css' href='https://paged.design/themes/template/main.css?ver=<?php echo PAGED_VERSION ?>' type='text/css'/>
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
