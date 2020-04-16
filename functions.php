
<script type="text/javascript">
	function num(evt) 
	{ 
		var charCode = (evt.which) ? evt.which : window.event.keyCode; 
	 
		if (charCode <= 13) 
		{ 
			return true; 
		} 
		else 
		{ 
			var keyChar = String.fromCharCode(charCode); 
			var re = /([0-9])*([0-9])/;
			return re.test(keyChar); 
		} 
	}

	function dec(evt) 
	{ 
		var charCode = (evt.which) ? evt.which : window.event.keyCode; 
	 
		if (charCode <= 13) 
		{ 
			return true; 
		} 
		else 
		{ 
			var keyChar = String.fromCharCode(charCode); 
			var re = /[0-9.]/;
			return re.test(keyChar); 
		} 
	}

	function time(evt) 
	{ 
		var charCode = (evt.which) ? evt.which : window.event.keyCode; 
	 
		if (charCode <= 13) 
		{ 
			return true; 
		} 
		else 
		{ 
			var keyChar = String.fromCharCode(charCode); 
			var re = /[0-9:]/;
			return re.test(keyChar); 
		} 
	}

	function alpha(evt) 
	{ 
		var charCode = (evt.which) ? evt.which : window.event.keyCode; 
	 
		if (charCode <= 13) 
		{ 
			return true; 
		} 
		else 
		{ 
			var keyChar = String.fromCharCode(charCode); 
			var re = /[a-zA-Z- ]/;
			return re.test(keyChar); 
		} 
	}

	function alphanum(evt) 
	{ 
		var charCode = (evt.which) ? evt.which : window.event.keyCode; 
	 
		if (charCode <= 13) 
		{ 
			return true; 
		} 
		else 
		{ 
			var keyChar = String.fromCharCode(charCode); 
			var re = /[a-zA-Z-.,-_ 0-9]/;
			return re.test(keyChar); 
		} 
	}


	
	//NO SPECIAL CHARACTERS ALLOWED ! - jao
function noSpecialCharacters(e, t) {
    try {

        if (window.event) {
            var charCode = window.event.keyCode;

        }
        else if (e) {
            var charCode = e.which;
        }
        else {return true; }
        if(charCode == 8 || charCode == 32){
        	return true;
        }
        if (charCode < 48 || (charCode > 57 && charCode < 65) || (charCode > 90 && charCode < 97) || charCode > 122)
            return false;
        else
            return true;
    }

    catch (err) {
        alert(err.Description);
    }
}
	
</script>
