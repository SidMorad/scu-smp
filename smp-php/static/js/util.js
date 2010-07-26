
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