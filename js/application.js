var swfu_s3;
$(function () {
	var settings = {
		// Backend settings
		upload_url: "upload.php",
		file_post_name: "s3_file",

		// Flash file settings
		file_size_limit : "50 MB",
		file_types : "*.*",			// or you could use something like: "*.doc;*.wpd;*.pdf",
		file_types_description : "All Files",
		file_upload_limit : "0",
		file_queue_limit : "1",

		// Event handler settings
		swfupload_loaded_handler : swfUploadLoaded,
		
		file_dialog_start_handler: fileDialogStart,
		file_queued_handler : fileQueued,
		file_queue_error_handler : fileQueueError,
		file_dialog_complete_handler : fileDialogComplete,
		
		//upload_start_handler : uploadStart,
		upload_progress_handler : uploadProgress,
		upload_error_handler : uploadError,
		upload_success_handler : uploadSuccess,
		upload_complete_handler : uploadComplete,

		// Button Settings
		button_image_url : "images/browse_button.png",
		button_placeholder_id : "spanButtonPlaceholder",
		button_width: 73,
		button_height: 29,
		
		// Flash Settings
		flash_url : "swfupload/swfupload.swf",

		custom_settings : {
			progress_target : "fsUploadProgress",
			upload_successful : false
		},
		
		// Debug settings
		debug: false
	}
	swfu_s3 = new SWFUpload(settings);
});