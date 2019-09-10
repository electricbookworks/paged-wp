<?php

namespace PagedWP;

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

class CodeEditor {

	protected $file;
	protected $version;

	public function __construct( $file, $version ) {
		$this->file    = $file;
		$this->version = $version;
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
		global $post;
		if ( ! $post ) {
			return;
		}
		if ( ! 'page' === $post->post_type ) {
			return;
		}
		if ( 'post.php' === $hook || 'post-new.php' === $hook ) {
			wp_enqueue_code_editor( array( 'type' => 'text/html' ) );
			wp_enqueue_script( 'js-code-editor', $this->file . '/code-editor.js', array( 'jquery' ), $this->version, true );
		}
	}
}
