
<!DOCTYPE html>
<head>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
    <script src="js/PageTitleNotification.min.js" type="text/javascript"></script>
    <meta name="theme-color" content="#FFA000">

</head>
<body>
  
</body>
</html>
<script>
   
  $(function () {
var dt = new Date();
var time = dt.getHours() + ":" + dt.getMinutes() + ":" + dt.getSeconds();
if(time >= '12:00:00' && time <= '12:59:00')
{
  pageTitleNotification.on("ATTENTION:It's lunch time, please check your DTR after the break. Thanks!", 1000);
}
if(time >= '17:00:00' && time <= '19:59:00')
{
  pageTitleNotification.on("ATTENTION:It's past 5pm, please check your DTR. Thanks!", 1000);
}
});
</script>
  
