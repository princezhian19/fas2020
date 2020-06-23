
<div class="row">
        <div class="col-md-12">
          <div class="box">
            <div class="box-body">
              <div class="row">
                <div class="col-md-4">
                <h1>Trip Schedule</h1>
                <br>
                <li class="btn btn-warning"><a href="VehicleRequest.php" style="color:white;text-decoration: none;">Back</a></li>
                <div class = "col-lg-12">
               
                    <div class = "col-xs-2 col-sm-2 col-md-2 col-lg-12">
                    <!-- <input type = "text" class = "form-control filter"  id="type_filter" placeholder=  "Search Activities"/> -->
                    
                    </div><br><br>
                    <div class="col-md-12">
                        <!-- <button class="pull-right btn btn-success" id = "modal"  style = "margin-left:5%;"><i class = "fa fa-plus"></i><a style = "color:#fff;" > Add Activity</a></button>                         -->
                        <?php 
  if ($division == 14 || $division == 10 || $division == 11 || $division == 12 || $division == 13) {
      ?>
                       <!-- <button class="pull-right btn btn-success"><i class = "fa fa-edit"></i><a href ="ManageCalendar.php?division=<?php echo $_GET['division'];?>" style ="color:#fff;decoration:none;">Manage All</a></button> -->

      <?php
    }else{
   ?>
                       <!-- <button class="pull-right btn btn-success"><i class = "fa fa-eye"></i><a href ="ManageCalendar.php?division=<?php echo $_GET['division'];?>" style ="color:#fff;decoration:none;">View All</a></button> -->

   <?php
    }
 ?>
                    </div>
                    <br>
                    <br>
                    <div class="col-md-12">

                        <!-- FORM -->

                        <div class="box box-widget widget-user-12" style = "background-color:#ECEFF1;" >
                        
                            <div style = "background-color:#AED581;color:#fff;padding:5px;">
                                <h5 style = "margin-left:20px;" class="widget-user-username">Filter</h5>
                            </div>
                            <div  style = "background-color:#ECEFF1;" >
                                <div class="col-xs-2 col-sm-2 col-md-2 col-lg-6" id = "selectMonth"  style = "margin-top:5px;">  
                                </div>
                                <div class="col-xs-2 col-sm-2 col-md-2 col-lg-6" style = "margin-top:5px;">
                                    <select class="form-control " id="selectYear" style="width: 100%;">
                                        <?php 
                                        for($i= 2020; $i < 2031; $i++)
                                        {
                                        echo '<option value='.$i.'>'.$i.'</option>';
                                        }
                                        ?>
                                    </select>
                                    <select class="form-control division_dropdown " id="selectDivision" style="width: 100%;">
                                        <?php 
                                        require_once 'connection.php';
                                        $sql = mysqli_query($conn, "SELECT DIVISION_N,DIVISION_M FROM `tblpersonneldivision` ORDER BY DIVISION_N ASC");
                                        if (mysqli_num_rows($sql)>0) {
                                        while($row = mysqli_fetch_assoc($sql) )
                                        {
                                        $selectedOpt = ($row['DIVISION_N'] == 0)?'selected':''; 
                                        echo '<option  value="'.$row["DIVISION_N"].'" '.$selectedOpt.' >'.$row["DIVISION_M"].'</option>';
                                        }
                                        }
                                        ?>
                                    </select>
                                </div>
                                <div class = "col-xs-2 col-sm-2 col-md-2 col-lg-12">
                                    <table class="table table-bordered" style="border-width: 3px;max-width:100%;">
                                            <tr>
                                                <td colspan = "2"><b><input  class='calFilter' type="checkbox" name = "offices[]" value="0"  id = "all" ></label>
                                                All Drivers</b></td>
                                            </tr>
                                        
                                            <tr>
                                            <td style="background-color: #D5D911; color:white;WIDTH:50%;">
                                                    <input class='calFilter' type="checkbox" name = "offices[]" value="Reynaldo Parale" id = "ReynaldoParale" ><label style = "margin-left:15%;">Reynaldo Parale</label>
                                                </td>
                                                <td style="background-color: #607D8B; color:#fff;padding:9px;WIDTH:50%;">
                                                    <input class='calFilter' type="checkbox" name = "offices[]" value="Louie Blanco" id = "LouieBlanco"><label style = "margin-left:15%;">Louie Blanco</label>
                                                </td>
                                            </tr>
                                            <tr>
                                            <td style="background-color: #E60785; color:white;">
                                                    <input class='calFilter' type="checkbox" name = "offices[]" value="Joachim Lacdang" id = "JoachimLacdang"><label style = "margin-left:15%;">Joachim Lacdang</label>
                                                </td>
                                                <td style="background-color:#FF9800 ; color:white;;padding:9px;">
                                                    <input class='calFilter' type="checkbox" name = "offices[]" value="Medel Saturno" id = "MedelSaturno"><label style = "margin-left:15%;">Medel Saturno</label>
                                                </td>
                                            </tr>
                                            <tr>
                                            <td style="background-color: #48BD0D; color:white;">
                                                    <input class='calFilter' type="checkbox" name = "offices[]" value="Daniel Narciso" id = "DanielNarciso"><label style = "margin-left:15%;">Daniel Narciso</label>
                                                </td>
                                               
                                            
                                            </tr>
                                            <tr>
                                           
                                            </tr>
                                    </table>
                                <button class="btn btn-success pull-right"><a style = "color:#fff;"  id = "export"  >Export</a></button>

                                </div>
                              
                                
                            </div>
                           &nbsp;
                        </div>
                    </div>

                      

                    </div>
                    
                    
      
                   
               


                    
                
                </div>
                <div class="col-md-8">
                    
                    
                    

                    
                   
                    <br>
                    <br>    
                    
                    <div class = "response"></div>   

                    <div id='calendar'></div>

                </div>
<br>
