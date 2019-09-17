<?php

namespace PagedWP;

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

class Plugin_Base {
	public $code_editor;
	public $settings;
	public $admin;

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

		$this->code_editor = new Code_Editor( $this );
		$this->settings    = new Plugin_Settings( $this );
		$this->admin       = new Plugin_Admin_API();
	}
}
