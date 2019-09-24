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
	function is_paged_preview() {
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
	function render_paged_css() {
		if ( $this->is_paged_preview() ) {
			?>
			<link rel='stylesheet' id='paged-css' href='<?php echo PAGED_PLUGIN_URL ?>/assets/css/paged.css?ver=<?php echo PAGED_VERSION ?>' type='text/css'/>
			<?php
		}
		$paged_custom_css = get_option( 'paged_custom_css', '' );
		if ( ! empty( $paged_custom_css ) ) {
			?>
			<style>
				<?php echo $paged_custom_css ?>
			</style>
			<?php
		}
	}

	/**
	 * Add paged JS from source
	 */
	function render_paged_js() {
		if ( $this->paged_is_paged_preview() ) {
			?>
			<script type='text/javascript'
			        src='https://unpkg.com/pagedjs/dist/paged.polyfill.js?ver=<?php echo PAGED_VERSION ?>'></script>
			<?php
		}
	}
	/**
	 * Override default template when using the paged preview.
	 */
	function template_include( $template ) {
		if ( $this->paged_is_paged_preview() ) {
			$template = trailingslashit( PAGED_PLUGIN_DIR ) . 'templates/index.php';
		}

		return $template;
	}

}
