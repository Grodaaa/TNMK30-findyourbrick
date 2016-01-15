//Det går inte att söka med två tomma formulär.
function validate(){
	var form = document.getElementById("form");
	
	var setnr = form.setnr.value;
	var search = form.search.value;
	
	if(setnr == "" && search == "")
	{
		window.alert("Skriv in artikelnr!");
		return false;
	}
	
	return true;
}


