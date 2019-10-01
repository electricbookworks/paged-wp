<?php

namespace PagedWP;

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

class Plugin_Base {

	public $metabox;
	public $assets;
	public $code_editor;
	public $settings;
	public $admin;
	public $ajax;

	public $file;
	public $version;
	public $token;
	public $dir;
	public $assets_dir;
	public $assets_url;
	public $script_suffix;

	public function __construct( $file, $version ) {
		$this->file    = $file;
		$this->version = $version;
		$this->token   = 'paged_';

		$this->file       = $file;
		$this->dir        = dirname( $this->file );
		$this->assets_dir = trailingslashit( $this->dir ) . 'assets';
		$this->assets_url = esc_url( trailingslashit( plugins_url( '/assets/', $this->file ) ) );

		$this->script_suffix = defined( 'SCRIPT_DEBUG' ) && SCRIPT_DEBUG ? '' : '.min';

		$this->assets      = new Plugin_Assets( $this );
		$this->metabox     = new Metabox();
		$this->code_editor = new Code_Editor( $this );
		$this->settings    = new Plugin_Settings( $this );
		$this->admin       = new Plugin_Admin_API();
		$this->ajax        = new Ajax( $this );
	}

	/**
	 * Retrieve the list of custom CSS files from the uploads/paged directory
	 */
	public function get_custom_css_files() {
		$paged_upload_dir = $this->get_paged_upload_directory();
		$custom_css_files = array_diff( scandir( $paged_upload_dir ), array( '..', '.' ) );
		if ( ! empty( $custom_css_files ) ) {
			$custom_css_files = array_combine( $custom_css_files, $custom_css_files );
		}
		return $custom_css_files;
	}

	/**
	 * Get the upload directory to store all the custom css
	 *
	 * @return string
	 */
	public function get_paged_upload_directory() {
		$upload_dir       = wp_upload_dir();
		$base_dir         = $upload_dir['basedir'];
		$paged_upload_dir = "$base_dir/paged";
		if ( ! is_dir( $paged_upload_dir ) ) {
			wp_mkdir_p( $paged_upload_dir );
		}

		return $paged_upload_dir;
	}

}
