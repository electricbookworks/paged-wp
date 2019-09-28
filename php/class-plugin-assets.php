<?php

namespace PagedWP;

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

class Plugin_Assets {

	public function __construct() {
		$this->bootstrap();
	}

	public function bootstrap() {
		add_action( 'paged_head', array( $this, 'render_paged_css' ) );
		add_action( 'paged_foot', array( $this, 'render_paged_js' ) );

		add_filter( 'template_include', array( $this, 'template_include' ), 99 );
	}
	/**
	 * Check if the paged variable is set and set to true
	 */
	public function is_paged_preview() {
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
	 * Add paged CSS
	 */
	public function render_paged_css() {
		if ( ! $this->is_paged_preview() ) {
			return;
		}
		$paged_css        = file_get_contents( PAGED_PLUGIN_DIR . '/assets/css/paged.css' );
		$paged_custom_css = get_option( 'paged_custom_css', '' );
		if ( ! empty( $paged_custom_css ) ) {
			$paged_css .= PHP_EOL . $paged_custom_css . PHP_EOL;
		}
		?>
		<style type="text/css" id="paged-css">
			<?php echo $paged_css ?>
		</style>
		<?php
	}
	/**
	 * Add paged JS from source
	 */
	public function render_paged_js() {
		if ( ! $this->is_paged_preview() ) {
			return;
		}
		?>
		<script type='text/javascript' src='https://unpkg.com/pagedjs/dist/paged.polyfill.js?ver=<?php echo PAGED_VERSION ?>'></script>
		<?php
	}

	/**
	 * Override default template when using the paged preview.
	 *
	 * @param $template
	 *
	 * @return string
	 */
	public function template_include( $template ) {
		if ( ! $this->is_paged_preview() ) {
			return $template;
		}

		return trailingslashit( PAGED_PLUGIN_DIR ) . 'templates/index.php';
	}

}
