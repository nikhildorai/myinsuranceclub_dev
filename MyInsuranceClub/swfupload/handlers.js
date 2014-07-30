/* Demo Note:  This demo uses a FileProgress class that handles the UI for displaying the file name and percent complete.
The FileProgress class is not part of SWFUpload.
*/


/* **********************
   Event Handlers
   These are my custom event handlers to make my
   web application behave the way I went when SWFUpload
   completes different tasks.  These aren't part of the SWFUpload
   package.  They are part of my application.  Without these none
   of the actions SWFUpload makes will show up in my application.
   ********************** */
function fileQueued(file) {
	try {
		var progress = new FileProgress(file, this.customSettings.progressTarget);
		progress.setStatus("Pending...");
		progress.toggleCancel(true, this);

	} catch (ex) {
		this.debug(ex);
	}

}

function fileQueueError(file, errorCode, message) {
	try {
		if (errorCode === SWFUpload.QUEUE_ERROR.QUEUE_LIMIT_EXCEEDED) {
			alert("You have attempted to queue too many files.\n" + (message === 0 ? "You have reached the upload limit." : "You may select " + (message > 1 ? "up to " + message + " files." : "one file.")));
			return;
		}

		var progress = new FileProgress(file, this.customSettings.progressTarget);
		progress.setError();
		progress.toggleCancel(false);

		switch (errorCode) {
		case SWFUpload.QUEUE_ERROR.FILE_EXCEEDS_SIZE_LIMIT:
			progress.setStatus("File is too big.");
			this.debug("Error Code: File too big, File name: " + file.name + ", File size: " + file.size + ", Message: " + message);
			break;
		case SWFUpload.QUEUE_ERROR.ZERO_BYTE_FILE:
			progress.setStatus("Cannot upload Zero Byte files.");
			this.debug("Error Code: Zero byte file, File name: " + file.name + ", File size: " + file.size + ", Message: " + message);
			break;
		case SWFUpload.QUEUE_ERROR.INVALID_FILETYPE:
			progress.setStatus("Invalid File Type.");
			this.debug("Error Code: Invalid File Type, File name: " + file.name + ", File size: " + file.size + ", Message: " + message);
			break;
		default:
			if (file !== null) {
				progress.setStatus("Unhandled Error");
			}
			this.debug("Error Code: " + errorCode + ", File name: " + file.name + ", File size: " + file.size + ", Message: " + message);
			break;
		}
	} catch (ex) {
        this.debug(ex);
    }
}

function fileDialogComplete(numFilesSelected, numFilesQueued) {
	try {
		if (numFilesSelected > 0) {
			document.getElementById(this.customSettings.cancelButtonId).disabled = false;
		}
		
		/* I want auto start the upload and I can do that here */
		this.startUpload();
	} catch (ex)  {
        this.debug(ex);
	}
}

function uploadStart(file) {
	try {
		/* I don't want to do any file validation or anything,  I'll just update the UI and
		return true to indicate that the upload should start.
		It's important to update the UI here because in Linux no uploadProgress events are called. The best
		we can do is say we are uploading.
		 */
		var progress = new FileProgress(file, this.customSettings.progressTarget);
		progress.setStatus("Uploading...");
		progress.toggleCancel(true, this);
	}
	catch (ex) {}
	
	return true;
}

function uploadProgress(file, bytesLoaded, bytesTotal) {
	try {
		var percent = Math.ceil((bytesLoaded / bytesTotal) * 100);

		var progress = new FileProgress(file, this.customSettings.progressTarget);
		progress.setProgress(percent);
		progress.setStatus("Uploading...");
	} catch (ex) {
		this.debug(ex);
	}
}

function uploadSuccess(file, serverData) {
	try {
		var progress = new FileProgress(file, this.customSettings.progressTarget);
		progress.setComplete();
		progress.setStatus("Upload Completed.");
		var return_array = JSON.parse(serverData);
		if(return_array.file_preview_url){
			processOutput(return_array);
			progress.setStatus("Generating Preview..");
		}	
		progress.toggleCancel(false);

	} catch (ex) {
		this.debug(ex);
	}
}

function uploadError(file, errorCode, message) {
	try {
		var progress = new FileProgress(file, this.customSettings.progressTarget);
		progress.setError();
		progress.toggleCancel(false);

		switch (errorCode) {
		case SWFUpload.UPLOAD_ERROR.HTTP_ERROR:
			progress.setStatus("Upload Error: " + message);
			this.debug("Error Code: HTTP Error, File name: " + file.name + ", Message: " + message);
			break;
		case SWFUpload.UPLOAD_ERROR.UPLOAD_FAILED:
			progress.setStatus("Upload Failed.");
			this.debug("Error Code: Upload Failed, File name: " + file.name + ", File size: " + file.size + ", Message: " + message);
			break;
		case SWFUpload.UPLOAD_ERROR.IO_ERROR:
			progress.setStatus("Server (IO) Error");
			this.debug("Error Code: IO Error, File name: " + file.name + ", Message: " + message);
			break;
		case SWFUpload.UPLOAD_ERROR.SECURITY_ERROR:
			progress.setStatus("Security Error");
			this.debug("Error Code: Security Error, File name: " + file.name + ", Message: " + message);
			break;
		case SWFUpload.UPLOAD_ERROR.UPLOAD_LIMIT_EXCEEDED:
			progress.setStatus("Upload limit exceeded.");
			this.debug("Error Code: Upload Limit Exceeded, File name: " + file.name + ", File size: " + file.size + ", Message: " + message);
			break;
		case SWFUpload.UPLOAD_ERROR.FILE_VALIDATION_FAILED:
			progress.setStatus("Failed Validation.  Upload skipped.");
			this.debug("Error Code: File Validation Failed, File name: " + file.name + ", File size: " + file.size + ", Message: " + message);
			break;
		case SWFUpload.UPLOAD_ERROR.FILE_CANCELLED:
			// If there aren't any files left (they were all cancelled) disable the cancel button
			if (this.getStats().files_queued === 0) {
				document.getElementById(this.customSettings.cancelButtonId).disabled = true;
			}
			progress.setStatus("Cancelled");
			progress.setCancelled();
			break;
		case SWFUpload.UPLOAD_ERROR.UPLOAD_STOPPED:
			progress.setStatus("Stopped");
			break;
		default:
			progress.setStatus("Unhandled Error: " + errorCode);
			this.debug("Error Code: " + errorCode + ", File name: " + file.name + ", File size: " + file.size + ", Message: " + message);
			break;
		}
	} catch (ex) {
        this.debug(ex);
    }
}

function uploadComplete(file) {
	if (this.getStats().files_queued === 0) {
		document.getElementById(this.customSettings.cancelButtonId).disabled = true;
		document.getElementById('photo_upload_button').style.display = '';
	}
}

// This event comes from the Queue Plugin
function queueComplete(numFilesUploaded) {
	var status = document.getElementById("divStatus");
	status.innerHTML = numFilesUploaded + " file" + (numFilesUploaded === 1 ? "" : "s") + " uploaded.";
}


function processOutput(file_details) {
	src = file_details.file_preview_url;
	file_stored_name = file_details.file_stored_name;
	file_display_name = file_details.file_display_name;
	
	// set a div which will contain image and check box
	var image_checkbox_container = document.createElement('div');
	image_checkbox_container.className = 'thumb';
	var display_id = file_stored_name.substr(0, file_stored_name.lastIndexOf('.')) || file_stored_name;
	var checkbox_container = document.createElement('div');
	
	var checkbox_div_id = "chk_" + file_stored_name;
	checkbox_container.id = checkbox_div_id;
	checkbox_container.style.display = 'none';
	checkbox_container.style.float = 'left';
	
	var checkbox = document.createElement('input');
	checkbox.type = "checkbox";
	checkbox.name = "photos["+file_display_name+"][file_name]";
	checkbox.value = file_stored_name;
	checkbox.setAttribute("class", "checkbox_chk");
	checkbox.setAttribute("id", display_id);
	checkbox.checked = true;


	var break_div = document.createElement('div');
	break_div.style.clear = "both";
	
	var break_div1 = document.createElement('br');
	break_div.style.clear = "both";

	var span_default_image = document.createElement('span');
	span_default_image.innerHTML  = "Display order";	
	
	var ele_display_order = document.createElement('input');
	var display_name = "display["+file_display_name+"][display]";
	ele_display_order.setAttribute("type", "text");
	ele_display_order.setAttribute("name", display_name);
	ele_display_order.setAttribute("id", display_id+'t');
	ele_display_order.setAttribute("class", "display_order");
	ele_display_order.setAttribute("style", "width: 75px;");
	ele_display_order.setAttribute("maxlength", "3");
	
	
	

	var span_default_image1 = document.createElement('span');
	span_default_image1.innerHTML  = "Name";	
	var ele_photo_name = document.createElement('input');
	var element_name = "photos["+file_display_name+"][name]";
	ele_photo_name.setAttribute("type", "text");
	var image_name = file_display_name.substr(0, file_display_name.lastIndexOf('.')) || file_display_name;
	ele_photo_name.setAttribute("value", image_name);
	ele_photo_name.setAttribute("name", element_name);
	ele_photo_name.setAttribute("style", "width: 128px;");


	var span_default_image2 = document.createElement('span');
	span_default_image2.innerHTML  = "Save Image";	
	span_default_image2.setAttribute("style", "width: 178px;");
	
//	checkbox_container.appendChild(ele_photo_default);
	checkbox_container.appendChild(span_default_image);
	checkbox_container.appendChild(ele_display_order);
	checkbox_container.appendChild(span_default_image1);
	checkbox_container.appendChild(ele_photo_name);
	checkbox_container.appendChild(break_div1);	
	checkbox_container.appendChild(checkbox);  
	checkbox_container.appendChild(span_default_image2);  
	
	var newImg = document.createElement("img");
	newImg.setAttribute("width", "154");
	newImg.style.margin = "5px";
	newImg.style.height = "132px";
	newImg.style.opacity = "1";
	
	
	image_checkbox_container.appendChild(newImg);
	image_checkbox_container.appendChild(checkbox_container);
	//append both to thumbnail container
	
	var thumbnails_container = document.getElementById("thumbnails");
	thumbnails_container.appendChild(image_checkbox_container);
	
	if (newImg.filters) {
		try {
			newImg.filters.item("DXImageTransform.Microsoft.Alpha").opacity = 0;
		} catch (e) {
			// If it is not set initially, the browser will throw an error.  This will set it if it is not set yet.
			newImg.style.filter = 'progid:DXImageTransform.Microsoft.Alpha(opacity=' + 0 + ')';
		}
	} else {
		newImg.style.opacity = 0;
	}

	newImg.onload = function () {
		fadeIn(newImg, 0, checkbox_div_id);
	};
	newImg.src = src;
	newImg.width = 190;
}

function fadeIn(element, opacity, checkbox_id) {
	var reduceOpacityBy = 5;
	var rate = 30;	// 15 fps


	if (opacity < 100) {
		opacity += reduceOpacityBy;
		if (opacity > 100) {
			opacity = 100;
		}

		if (element.filters) {
			try {
				element.filters.item("DXImageTransform.Microsoft.Alpha").opacity = opacity;
			} catch (e) {
				// If it is not set initially, the browser will throw an error.  This will set it if it is not set yet.
				element.style.filter = 'progid:DXImageTransform.Microsoft.Alpha(opacity=' + opacity + ')';
			}
		} else {
			element.style.opacity = opacity / 100;
		}
	}

	if (opacity < 100) {
		setTimeout(function () {
			fadeIn(element, opacity, checkbox_id);
		}, rate);
	}else{
		document.getElementById(checkbox_id).style.display = '';
	}
}
