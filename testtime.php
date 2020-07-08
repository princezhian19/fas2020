<!DOCTYPE HTML> 
<html> 
  
<head> 
    <title> 
        How to restrict input box to allow 
      only numbers and decimal point JavaScript? 
    </title> 
</head> 
  
<body style="text-align:center;"
      id="body"> 
    <h1 id="h1"
        style="color:green;">   
            GeeksForGeeks   
        </h1> 
    <p id="GFG_UP" 
       style="font-size: 15px;  
              font-weight: bold;"> 
    </p> 
    <form> 
        Type Here: 
        <input id="input"
               onkeypress="return GFG_Fun(this, event)" 
               type="text"> 
    </form> 
    <br> 
    <p id="GFG_DOWN" 
       style="font-size: 23px;  
              font-weight: bold;  
              color: green; "> 
    </p> 
    <script> 
        var el_up = document.getElementById("GFG_UP"); 
        var el_down = document.getElementById("GFG_DOWN"); 
        el_up.innerHTML =  
          "Type in the box to see whether the input is valid or not."; 
  
        function isValid(el, evnt) { 
            var charC = (evnt.which) ? evnt.which : evnt.keyCode; 
            if (charC == 46) { 
                if (el.value.indexOf('.') === -1) { 
                    return true; 
                } else { 
                    return false; 
                } 
            } else { 
                if (charC > 31 && (charC < 48 || charC > 57)) 
                    return false; 
            } 
            return true; 
        } 
  
        function GFG_Fun(t, evnt) { 
            var a = isValid(t, evnt); 
            if (a) { 
                el_down.innerHTML = "Typed Valid Character."; 
            } else { 
                el_down.innerHTML = "Typed Invalid Character."; 
            } 
            return a; 
        } 
    </script> 
</body> 
  
</html> 