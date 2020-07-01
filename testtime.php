<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<title>Placing Text Over an Image in CSS</title>
<style>
    .box{
        position: relative;
        display: inline-block; /* Make the width of box same as image */
    }
    .box .text{
        position: absolute;
        z-index: 999;
        margin: 0 auto;
        left: 0;
        right: 0;
        top: 40%; /* Adjust this value to move the positioned div up and down */
        text-align: center;
        width: 60%; /* Set the width of the positioned div */
    }
</style>
</head> 
<body>
    <div class="box">
        <img src="images/50km.png" alt="Flying Kites" style = "width:10%;height:auto;">
        <div class="text">
            <h1>Flying Kites</h1>
        </div>
    </div>
</body>