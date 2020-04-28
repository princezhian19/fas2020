<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<title>jQuery Check/Uncheck Checkbox</title>
<script src="https://code.jquery.com/jquery-1.12.4.min.js"></script>
<script>
$(document).ready(function(){
    $(".check").click(function(){
        $("#myCheck").prop("checked", true);
    });
    $(".uncheck").click(function(){
        $("#myCheck").prop("checked", false);
    });
});
</script>
</head>
<body>
    <p><input type="checkbox" id="myCheck"> Are you sure?</p>
    <button type="button" class="check">Yes</button>
    <button type="button" class="uncheck">No</button>  
</body>
</html>