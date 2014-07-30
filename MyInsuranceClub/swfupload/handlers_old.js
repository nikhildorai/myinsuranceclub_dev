function fileQueueError(file, errorCode, message) {
	try {
		var imageName = "/error.gif";
		var errorName = "";
		if (errorCode === SWFUpload.errorCode_QUEUE_LIMIT_EXCEEDED) {
			errorName = "You can not upload more than " + SWFUpload.errorCode_QUEUE_LIMIT_EXCEEDED-1 + " files.";
		}

		if (errorName !== "") {
			alert(errorName);
			return;
		}

		switch (errorCode) {
		case SWFUpload.QUEUE_ERROR.ZERO_BYTE_FILE:
			imageName = "/zerobyte.gif";
			break;
		case SWFUpload.QUEUE_ERROR.FILE_EXCEEDS_SIZE_LIMIT:
			imageName = "/toobig.gif";
			break;
		case SWFUpload.QUEUE_ERROR.ZERO_BYTE_FILE:
		case SWFUpload.QUEUE_ERROR.INVALID_FILETYPE:
		default:
			alert(message);
			break;
		}

		addImage(swfuPath + imageName);

	} catch (ex) {
		this.debug(ex);
	}

}

function fileDialogComplete(numFilesSelected, numFilesQueued) {
	try {
		if (numFilesQueued > 0) {
			this.startUpload();
		}
	} catch (ex) {
		this.debug(ex);
	}
}

function uploadProgress(file, bytesLoaded) {
	try {
		var percent = Math.ceil((bytesLoaded / file.size) * 100);

		var progress = new FileProgress(file,  this.customSettings.progressTarget);
		progress.setProgress(percent);
		if (percent === 100) {
			progress.setStatus("Upload completed...");
			progress.toggleCancel(false, this);
		} else {
			progress.setStatus("Uploading...");
			progress.toggleCancel(true, this);
		}
	} catch (ex) {
		this.debug(ex);
	}

}

function uploadSuccess(file, serverData) {
	
	//alert(serverData);
	try {
		var progress = new FileProgress(file,  this.customSettings.progressTarget);
		var return_array = JSON.parse(serverData);
		
		
		if(return_array.file_preview_url){
			processOutput(return_array);
			progress.setStatus("Uploaded successfully.");
			progress.toggleCancel(false);
		} else {
			addImage(swfuPath + "/error.gif");
			progress.setStatus("Error.");
			progress.toggleCancel(false);
		}


	} catch (ex) {
		this.debug(ex);
	}
}

function uploadComplete(file) {
	try {
		/*  I want the next upload to continue automatically so I'll call startUpload here */
		if (this.getStats().files_queued > 0) {
			this.startUpload();
		} else {
			var progress = new FileProgress(file,  this.customSettings.progressTarget);
			progress.setComplete();
			document.getElementById('photo_upload_button').style.display = '';
			document.getElementById('swfupload').innerHTML = 'Add More';
			progress.toggleCancel(false);
		}
	} catch (ex) {
		this.debug(ex);
	}
}

function uploadError(file, errorCode, message) {
	var imageName =  "/error.gif";
	var progress;
	try {
		switch (errorCode) {
		case SWFUpload.UPLOAD_ERROR.FILE_CANCELLED:
			try {
				progress = new FileProgress(file,  this.customSettings.progressTarget);
				progress.setCancelled();
				progress.setStatus("Cancelado");
				progress.toggleCancel(false);
			}
			catch (ex1) {
				this.debug(ex1);
			}
			break;
		case SWFUpload.UPLOAD_ERROR.UPLOAD_STOPPED:
			try {
				progress = new FileProgress(file,  this.customSettings.progressTarget);
				progress.setCancelled();
				progress.setStatus("Parado");
				progress.toggleCancel(true);
			}
			catch (ex2) {
				this.debug(ex2);
			}
		case SWFUpload.UPLOAD_ERROR.UPLOAD_LIMIT_EXCEEDED:
			imageName = "/uploadlimit.gif";
			break;
		default:
			alert(message);
			break;
		}

		addImage(swfuPath + imageName);

	} catch (ex3) {
		this.debug(ex3);
	}

}


function processOutput(file_details) {
	
	src = file_details.file_preview_url;
	file_stored_name = file_details.file_stored_name;
	file_display_name = file_details.file_display_name;
	
	// set a div which will contain image and check box
	var image_checkbox_container = document.createElement('div');
	image_checkbox_container.style.width = 220;
	image_checkbox_container.style.cssFloat = 'left';
	
	var checkbox_container = document.createElement('div');
	
	var checkbox_div_id = "chk_" + file_stored_name;
	checkbox_container.id = checkbox_div_id;
	checkbox_container.style.display = 'none';
	checkbox_container.style.float = 'left';
	
	var checkbox = document.createElement('input');
	checkbox.type = "checkbox";
	checkbox.name = "photos["+file_display_name+"][file_name]";
	checkbox.value = file_stored_name;
	checkbox.checked = true;
	checkbox.id = file_stored_name;

	var ele_photo_name = document.createElement('input');
	var element_name = "photos["+file_display_name+"][name]";
	ele_photo_name.setAttribute("type", "text");
	var image_name = file_display_name.substr(0, file_display_name.lastIndexOf('.')) || file_display_name;
	ele_photo_name.setAttribute("value", image_name);
	ele_photo_name.setAttribute("name", element_name);

	var ele_photo_default = document.createElement('input');
	ele_photo_default.setAttribute("type", "radio");
	ele_photo_default.setAttribute("name", "photos_default");
	ele_photo_default.setAttribute("value", file_stored_name);	
	
	var break_div = document.createElement('div');
	break_div.style.clear = "both";

	var span_default_image = document.createElement('span');
	span_default_image.innerHTML  = " Set Default";
	
	checkbox_container.appendChild(checkbox);
	checkbox_container.appendChild(ele_photo_name);
	checkbox_container.appendChild(break_div);	

	checkbox_container.appendChild(ele_photo_default);
	checkbox_container.appendChild(span_default_image);
	
	var newImg = document.createElement("img");
	newImg.style.margin = "5px";
	
	
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



/* ******************************************
 *	FileProgress Object
 *	Control object for displaying file info
 * ****************************************** */

function FileProgress(file, targetID) {
	this.fileProgressID = "divFileProgress";

	this.fileProgressWrapper = document.getElementById(this.fileProgressID);
	if (!this.fileProgressWrapper) {
		this.fileProgressWrapper = document.createElement("div");
		this.fileProgressWrapper.className = "progressWrapper";
		this.fileProgressWrapper.id = this.fileProgressID;

		this.fileProgressElement = document.createElement("div");
		this.fileProgressElement.className = "progressContainer";

		var progressCancel = document.createElement("a");
		progressCancel.className = "progressCancel";
		progressCancel.href = "#";
		progressCancel.style.visibility = "hidden";
		progressCancel.appendChild(document.createTextNode(" "));

		var progressText = document.createElement("div");
		progressText.className = "progressName";
		progressText.appendChild(document.createTextNode(file.name));

		var progressBar = document.createElement("div");
		progressBar.className = "progressBarInProgress";

		var progressStatus = document.createElement("div");
		progressStatus.className = "progressBarStatus";
		progressStatus.innerHTML = "&nbsp;";

		this.fileProgressElement.appendChild(progressCancel);
		this.fileProgressElement.appendChild(progressText);
		this.fileProgressElement.appendChild(progressStatus);
		this.fileProgressElement.appendChild(progressBar);

		this.fileProgressWrapper.appendChild(this.fileProgressElement);

		document.getElementById(targetID).appendChild(this.fileProgressWrapper);
		fadeIn(this.fileProgressWrapper, 0);

	} else {
		this.fileProgressElement = this.fileProgressWrapper.firstChild;
		this.fileProgressElement.childNodes[1].firstChild.nodeValue = file.name;
	}

	this.height = this.fileProgressWrapper.offsetHeight;

}
FileProgress.prototype.setProgress = function (percentage) {
	this.fileProgressElement.className = "progressContainer green";
	this.fileProgressElement.childNodes[3].className = "progressBarInProgress";
	this.fileProgressElement.childNodes[3].style.width = percentage + "%";
};
FileProgress.prototype.setComplete = function () {
	this.fileProgressElement.className = "progressContainer blue";
	this.fileProgressElement.childNodes[3].className = "progressBarComplete";
	this.fileProgressElement.childNodes[3].style.width = "";

};
FileProgress.prototype.setError = function () {
	this.fileProgressElement.className = "progressContainer red";
	this.fileProgressElement.childNodes[3].className = "progressBarError";
	this.fileProgressElement.childNodes[3].style.width = "";

};
FileProgress.prototype.setCancelled = function () {
	this.fileProgressElement.className = "progressContainer";
	this.fileProgressElement.childNodes[3].className = "progressBarError";
	this.fileProgressElement.childNodes[3].style.width = "";

};
FileProgress.prototype.setStatus = function (status) {
	this.fileProgressElement.childNodes[2].innerHTML = status;
};

FileProgress.prototype.toggleCancel = function (show, swfuploadInstance) {
	this.fileProgressElement.childNodes[0].style.visibility = show ? "visible" : "hidden";
	if (swfuploadInstance) {
		var fileID = this.fileProgressID;
		this.fileProgressElement.childNodes[0].onclick = function () {
			swfuploadInstance.cancelUpload(fileID);
			return false;
		};
	}
};
