<?php

namespace PagedWP;

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

class Ajax {

	public $parent;

	public function __construct( $parent ) {
		$this->parent = $parent;
		$this->bootstrap();
	}

	public function bootstrap() {
		add_action( 'wp_ajax_paged_upload_css', array( $this, 'upload_css' ) );
	}

	/**
	 * Upload CSS file via ajax from File uploader
	 */
	public function upload_css() {
		check_ajax_referer( 'paged_nonce' );

		if ( empty( $_FILES ) || $_FILES['file']['error'] ) {
			wp_send_json( array( 'status' => 'error' ) );
		}

		$file_name        = $_FILES['file']['name'];
		$final_upload_dir = $this->parent->get_paged_upload_directory();
		try {
			move_uploaded_file( $_FILES['file']['tmp_name'], "$final_upload_dir/$file_name" );
		} catch ( \Exception $e ) {
			wp_send_json(
				array(
					'status'  => 'success',
					'message' => $e->getMessage(),
				)
			);
		}
		wp_send_json( array( 'status' => 'success' ) );
	}
}
