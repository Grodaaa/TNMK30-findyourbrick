//Det g�r inte att s�ka med tv� tomma formul�r.
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


