jQuery(document).ready(function ($) {

	/**
	 * Checks if a file type is valid css
	 * @param file
	 * @returns {boolean}
	 */
	function isFileAllowed(file) {
		var isValid = false;
		if ('text/css' === file.type) {
			isValid = true;
		}
		return isValid;
	}

	/**
	 * Create new instance of pluploader
	 * @type {module:plupload.Uploader|{upload}|*|wp.Uploader}
	 */
	var uploader = new plupload.Uploader({
		browse_button: 'paged_fileupload', // this can be an id of a DOM element or the DOM element itself
		multi_selection: false,
		url: paged_ajax.ajax_url,
		multipart_params: {
			action: 'paged_upload_css',
			_ajax_nonce: paged_ajax.nonce
		}
	});

	/**
	 * Initialize uploader
	 */
	uploader.init();

	/**
	 * Trigger alerts on any errors
	 */
	uploader.bind( 'Error', function ( up, err ) {
		alert( 'Error #' + err.code + ': ' + err.message );
	} );

	/**
	 * Once files are added, check file type and upload
	 */
	uploader.bind( 'FilesAdded', function ( up, files ) {
		var file = files[ 0 ];
		if ( isFileAllowed( file ) ) {
			uploader.start();
		} else {
			alert( 'Error: please upload a valid CSS file' );
		}
	} );

	/**
	 * Once files are successfully uploaded, refresh the page
	 */
	uploader.bind( 'UploadComplete', function ( up, files ) {
		document.location.reload();
	} );

});
