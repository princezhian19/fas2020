<div class="row">
        <div class="col-md-12">
          <div class="box">
            <div class="box-body">
              <div class="row">
                <div class="col-md-4">
                <h1>Calendar of Events</h1>
                <div class = "col-lg-12">
                    <div class = "col-xs-2 col-sm-2 col-md-2 col-lg-12">
                    <input type = "text" class = "form-control" placeholder=  "Search Events"/>
                    </div><br><br><br>

                        <div class="col-xs-2 col-sm-2 col-md-2 col-lg-6" id = "selectMonth" >  
                        </div>
                        <div class="col-xs-2 col-sm-2 col-md-2 col-lg-6">
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
                            </select><br>
                        </div>

                    </div>
                    
                    
                    
                    <br><br><br>
                   
                        <div class = "col-lg-6" style = "padding:5%;">
                            <table class="table table-bordered" style="border-width: 3px;max-width:100%;">
                                <tr>
                                    <td style=""><b><center>REGION</center></b></td>
                                </tr>
                                <tr>
                                    <td>
                                    <input  class='calFilter' type="checkbox" value="0" checked id = "all"></label>
                                        Show all
                                    </td>
                                </tr>
                                <tr>
                                    <td style="background-color: #D5D911; color:white;">
                                        <input class='calFilter' type="checkbox" value="1" ><label style = "margin-left:15%;">ORD</label>
                                    </td>
                                </tr>
                                <tr>
                                <td style="background-color: #E60785; color:white;">
                                <input class='calFilter' type="checkbox" value="16"><label style = "margin-left:15%;">FAD</label>
                                    
                                </td>
                                
                                </tr>
                                <tr>
                                    <td style="background-color: #48BD0D; color:white;">
                                    <input class='calFilter' type="checkbox" value="17" ><label style = "margin-left:15%;">LGCDD</label>

                                    </td>
                                </tr>
                                <tr>
                                <td style="background-color: #E6680E; color:white;">
                                    <input class='calFilter' type="checkbox" value="7"><label style = "margin-left:15%;">MBRTG</label>
                                </td>
                                
                                </tr>
                                <tr>
                                <td style="background-color: #0071c5; color:white;">
                                <input class='calFilter' type="checkbox" value="18"><label style = "margin-left:15%;">LGMED</label>

                                    </td>
                                
                                </tr>
                                <tr>
                                <td style="background-color: #8F0CC7; color:white;">
                                <input class='calFilter' type="checkbox" value="9"><label style = "margin-left:15%;">PDMU</label>

                                    </td>
                                </tr>
                        
                        
                            </table>
                        </div>
                        <div class = "col-lg-6" style = "padding:5%;">
                            <table class="table table-bordered" style="border-width: 3px;max-width:100%;">
                                <tr>
                                    <td style=""><b><center>PROVINCE/HUC</center></b></td>
                                </tr>
                                <tr>
                                <td>
                                    <input  class='calFilter' type="checkbox" value="0"  id = "addll"></label>
                                        Show all
                                    </td>
                                </tr>
                                <tr>
                                    <td style="background-color: #D5D911; color:#fff;padding:9px;">
                                        <input class='calFilter' type="checkbox" value="19" ><label style = "margin-left:15%;">Batangas</label>
                                </td>
                                </tr>
                                <tr>
                                    <td style="background-color: #0071c5; color:white;;padding:9px;">
                                    <input class='calFilter' type="checkbox" value="20" ><label style = "margin-left:15%;">Cavite</label>
                               </td>
                                </tr>
                                <tr>
                                    <td style="background-color: #48BD0D; color:white;;padding:9px;">                                   
                                     <input class='calFilter' type="checkbox" value="21" ><label style = "margin-left:15%;">Laguna</label>
                                    </td>
                                </tr>
                                <tr>
                                    <td style="background-color: #8F0CC7; color:white;;padding:9px;">
                                    <input class='calFilter' type="checkbox" value="23" ><label style = "margin-left:15%;">Rizal</label>
                                </td>
                                </tr>
                                <tr>
                                    <td style="background-color: #E6680E; color:white;;padding:9px;">
                                    <input class='calFilter' type="checkbox" value="22" ><label style = "margin-left:15%;">Quezon</label>
                                </td>
                                </tr>
                                <tr>
                                    <td style="background-color: #E60785; color:white;;padding:9px;">
                                    <input class='calFilter' type="checkbox" value="24" ><label style = "margin-left:15%;">Lucena</label>
                                
                                    </td>
                                </tr>
                            </table>
                        </div>
                            
                    <div class="col-xs-2 col-sm-2 col-md-2 col-lg-12">
                    <button class="col-lg-12 pull-right btn btn-success" id = "modal" ><i class = "fa fa-plus"></i><a style = "color:#fff;" > Add Activity</a></button>
                    <br><br>
                    </div>
                    <br>
                    <br>
                    
                    <div class="col-xs-2 col-sm-2 col-md-2 col-lg-12">
                    <button class="col-lg-12 pull-right btn btn-success" style = "margin-left:10px;"><i class = "fa fa-edit"></i><a href ="ManageCalendar.php" style ="color:#fff;decoration:none;">Manage All Activities</a></button>
                    <br><br>        
                    </div>
                    <br>
                    <br>
                    <div class="col-xs-2 col-sm-2 col-md-2 col-lg-12">
                    <button class="col-lg-12 pull-right btn btn-success" style = "margin-left:10px;"><a style = "color:#fff;"  href="export_calendar.php?date=<?php echo date("Y-m-d");?>&division=<?php echo $_SESSION['division'];?>" >Export</a></button>
                    <br><br>
                    
                    </div>

                    
                
                </div>
                <div class="col-md-8">
                    
                    
                    

                    
                   
                    <br>
                    <br>    
                    <div id='calendar'></div>

                </div>
<br>
