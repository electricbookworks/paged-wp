<?php
namespace PagedWP;

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

class Metabox {

	public function __construct() {
		$this->bootstrap();
	}

	public function bootstrap() {
		add_action( 'add_meta_boxes', array( $this, 'register_meta_box' ) );
	}

	/**
	 * Register Paged Preview meta box.
	 */
	function register_meta_box() {
		add_meta_box( 'meta-box-paged', __( 'Paged Preview', 'textdomain' ), array( $this, 'meta_display' ), array('post', 'page'), 'side', 'high',
			array(
				'__back_compat_meta_box' => false,
			)
		);
	}

	/**
	 * Meta box display callback.
	 *
	 * @param WP_Post $post Current post object.
	 */
	function meta_display( $post ) {
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
			<a class="button" href="<?php echo $preview_link; ?>" target="wp-preview-<?php echo (int) $post->ID; ?>" id="paged-preview"><?php echo $preview_button; ?></a>
		</div>
		<?php
	}

}
