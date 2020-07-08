<html>
<head> 
      <title>Temp Conversion</title>
      <meta charset="utf-8">
</head>
<body>
      <form name="tempConvert" method="POST" action="<?php echo $_SERVER["PHP_SELF"]; ?>">

<table>
<tr>
    <td>Enter value to convert</td>
    <td><input type="text" name="valueConvert" id="valueConvert" size="15"></td>
</tr>

<tr>
    <td>Convert to:</td>
    <td><select name="convertType" id="convertType" size="1">
               <option disabled> Select a measurement type</option>
               <option value="celsius">Celsius</option>
               <option value="fahrenheit">Fahrenheit</option>
        </select>
    </td>
</tr>

<tr>
    <td><input type="submit" name="btnConvert" id="btnConvert" value="Convert"></td>
    <td><input type="reset" name="btnReset" id="btnReset" value="Reset"></td>
</tr>



</form>

<?php
 function tempConvert($value, $type){
    if($type== "fahrenheit"){
       return (((9/5)*$value) +(32));
   }
    elseif ($type== "celsius"){
       return (($valueConvert - 32) * (9/5));
   }
}

if (isset($_POST['btnConvert'])) { 
$valueConvert = $_POST['valueConvert'];
$convertType = $_POST['convertType'];

echo "The initial temperature was $valueConvert. The new temperature is tempConvert($valueConvert, $convertType).";
}
?>

    </body>
</html>