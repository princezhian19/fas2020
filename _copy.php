<?php
         $id= $_REQUEST['main_id'];
    require_once('sql.php');
       if ($_REQUEST['name']!='')
       { 
        $name = $_REQUEST['name'];
        $age = $_REQUEST['age'];
        $fload=($_FILES['FileUpLoad']['name']); 
                $folder = "upload/";
  // "FileUploaded" IS THE NAME OF THE INPUT WHERE I UPLOAD A FILE 
            $File = $_FILES["FileUpLoad"]['name'];      
        $folder = $folder . $File;  
        echo $folder . "<br>";
        $ok=1; 
            //This is our size condition 
        if ($FileUpLoad_size > 990000000){
            echo "Your file is too large.<br>";  
            $ok=0;  
        }  
        //This is our limit file type condition     
        if ($FileUpLoad_type =="text/php")  {
            echo "No PHP files<br>";  
            $ok=0;  
        } 
    $File = $_FILES["FileUpLoad"]['name'];
            echo("Die file = " . $File . "<br>");            
            if ($_FILES["FileUpLoad"]["name"]!="") {
                $fload =  $_FILES["FileUpLoad"]["name"] ;   
                while (file_exists("upload/" . $fload)) {
                  echo $File . " already exists. ";
                  $puntPos = strpos($fload,'.');
                  $len = strlen($fload);
                  $fload=substr($fload,0,$puntPos). "_" . rand(100,1000) . substr($puntPos,$fload) ;
                  $fload = rand(100,1000). "_".$_FILES["FileUpLoad"]["name"];   
                } 
                  $tmpName = $_FILES["FileUpLoad"]["tmp_name"];
                  echo "Die tydelike naam = " . $tmpName;   
                  move_FileUpLoad_file($_FILES["FileUpLoad"]["tmp_name"] ,
                  "upload/" . $fload);
            }
            $sql = "insert into tbl_gb (Name,Age,File,) values ('$name','$age','$fload')";
        mysqli_query($conn,$sql);
    }   
?>
<form name="form1" id="form1" method="POST"  enctype='multipart/form-data'>
<input type="text" name="name" id="name" /><br>
              <input type="age" name="age" id="age" ><br>
<label>upload:</label><input type="file" name="FileUpLoad" id="FileUpLoad" value="$fload"><br>
                <input type="button" value="save" />
this is my edit page
            edit.php
<?php
// update part************
if (isset($_REQUEST['update'])) 
        {    
            $name = $_REQUEST['name']; 
            $age = $_REQUEST['age']; 
            $fload = $_REQUEST['FileUpLoad']; 
            // here what i want to do is.. if no file is uploaded in the edit page then it should update without updating the file , which means file name and actuall file wont be affected
            if ($fload==""){
                 $query = "update tbl_gd set    Name='$name',Age='$age' where tbl_gd.r_id=$id";
             mysqli_query($conn,$query);
                }
                ///// here what i want to do is .. if a new file is uploaded at edit page then it should update file 
                 else
                                 $folder = "upload/";
  // "FileUploaded" IS THE NAME OF THE INPUT WHERE I UPLOAD A FILE 
            $File = $_FILES["FileUpLoad"]['name'];      
        $folder = $folder . $File;  
        echo $folder . "<br>";
        $ok=1; 
            //This is our size condition 
        if ($FileUpLoad_size > 990000000){
            echo "Your file is too large.<br>";  
            $ok=0;  
        }  
        //This is our limit file type condition     
        if ($FileUpLoad_type =="text/php")  {
            echo "No PHP files<br>";  
            $ok=0;  
        } 
    $File = $_FILES["FileUpLoad"]['name'];
            echo("Die file = " . $File . "<br>");            
            if ($_FILES["FileUpLoad"]["name"]!="") {
                $fload =  $_FILES["FileUpLoad"]["name"] ;   
                while (file_exists("upload/" . $fload)) {
                  echo $File . " already exists. ";
                  $puntPos = strpos($fload,'.');
                  $len = strlen($fload);
                  $fload=substr($fload,0,$puntPos). "_" . rand(100,1000) . substr($puntPos,$fload) ;
                  $fload = rand(100,1000). "_".$_FILES["FileUpLoad"]["name"];   
                } 
                  $tmpName = $_FILES["FileUpLoad"]["tmp_name"];
                  echo "Die tydelike naam = " . $tmpName;   
                  move_FileUpLoad_file($_FILES["FileUpLoad"]["tmp_name"] ,
                  "upload/" . $fload);
            }
                 $query = "update tbl_gd set    Name='$name',Age='$age',File='$fload' where tbl_gd.r_id=$id";
             mysqli_query($conn,$query);
                 {
                //}
//showing saved values*******
include('sql.php');
$id = $_REQUEST['main_id'];
$sql = "select * from tbl_gb where r_id=$id";
$rs = mysqli_query($conn,$sql);
$row = mysqli_fetch_assoc($rs);
$name = $row['Name'];
$age = $row['Age'];
$fload = $row['File'];
?>
<form>
<label>Name:</label><input type="text" name="name" id="name" value="<?php echo $name; ?>"/ >           <br>
        <label>age:</label><input type="text"  name="age" id="age" value="<?php echo $age;  ?>"/ ><br>
 <label>upload</label><input  type="file" name="FileUpLoad" id="FileUpLoad" ><br><br>
    <!--the input below is to display current uploaded file name>-->
 <input type="text" name="FileUpLoadCurrent"   value="<?php echo $fload ?>"/>
               <input type="submit" value="Edit" name="update"/>
</form>
