<?php

namespace PagedWP;

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

class Code_Editor {

	public $parent;

	public function __construct( $parent ) {
		$this->parent = $parent;
		$this->bootstrap();
	}

	public function bootstrap() {
		add_action( 'admin_enqueue_scripts', array( $this, 'add_page_scripts_enqueue_script' ) );
	}

	/**
	 * Enqueue the CodeEditor assets only when needed
	 *
	 * @param $hook
	 */
	public function add_page_scripts_enqueue_script( $hook ) {
		if ( 'settings_page_paged__settings' !== $hook ) {
			return;
		}
		wp_enqueue_code_editor( array( 'type' => 'text/html' ) );
		wp_enqueue_script( 'js-code-editor', $this->parent->assets_url . '/js/code-editor.js', array( 'jquery' ), $this->parent->version, true );
	}
}
