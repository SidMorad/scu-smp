
function ChangeClassName(strMenuId, strClassName){
	document.getElementById(strMenuId).className = strClassName;
}

function confirmSubmit() {
	var ok = confirm("Are you sure you wish to continue ?");
	if (ok) {
		return true;
	} else {
		return false;
	}
}

function toggleMe(elemId) {
	var element = document.getElementById(elemId);
	if (! element) {
		return true;
	}
	if (element.style.display == "none") {
		element.style.display = "block";		
	} else {
		element.style.display = "none";		
	}
	return true;
}
