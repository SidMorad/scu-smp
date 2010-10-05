
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

function clearForm(oForm) {
	var elements = oForm.elements; 
	oForm.reset();

	for(i=0; i<elements.length; i++) {
		field_type = elements[i].type.toLowerCase();

		switch(field_type) {
			case "text": 
			case "password": 
			case "textarea":
		        case "hidden":	
				elements[i].value = ""; 
				break;
	        
			case "radio":
			case "checkbox":
	  			if (elements[i].checked) {
	   				elements[i].checked = false; 
				}
				break;

			case "select-one":
			case "select-multi":
	            		elements[i].selectedIndex = -1;
				break;

			default: 
				break;
		}
	}
}
