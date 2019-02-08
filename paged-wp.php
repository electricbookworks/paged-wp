<?php
/**
 * Plugin Name: Paged WP
 * Plugin URI:  https://example.com/plugins/the-basics/
 * Description: Work in progress, a WordPress plugin for using paged.js
 * Version:     0.0.1
 * Author:      Jonathan Bossenger
 * Author URI:  https://jonathanbossenger
 * License:     GPL2
 * License URI: https://www.gnu.org/licenses/gpl-2.0.html
 * Text Domain: paged-wp
 * Domain Path: /languages
 */

if ( ! defined( 'ABSPATH' ) ) {
	return;
}

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
		<a class="preview button" href="<?php echo $preview_link; ?>" target="wp-preview-<?php echo (int) $post->ID; ?>" id="post-preview"><?php echo $preview_button; ?></a>
	</div>
	<?php
}
