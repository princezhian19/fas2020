<div class="row">
        <div class="col-md-12">
          <div class="box">
            <div class="box-body">
              <div class="row">
                <div class="col-md-4">
                <h1>Calendar of Events</h1>
                <div class = "col-lg-12">
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
                            </div> 
                            <div class="col-md-12">
                            <?php 
                            require_once 'connection.php';
                            echo '<select class="form-control division_dropdown " id="selectDivision" style="width: 100%;">';
                            $sql = mysqli_query($conn, "SELECT DIVISION_N,DIVISION_M FROM `tblpersonneldivision` ORDER BY DIVISION_N ASC");
                            if (mysqli_num_rows($sql)>0) {
                            while($row = mysqli_fetch_assoc($sql) )
                            {
                            $selectedOpt = ($row['DIVISION_N'] == 0)?'selected':''; 

                            echo '<option  value="'.$row["DIVISION_N"].'" '.$selectedOpt.' >'.$row["DIVISION_M"].'</option>';
                            }
                            }
                            echo '</select>';


                        ?>
                        
                    </div>
</div>
                    
                    
                    
                    <br><br><br>
                    <div class="col-xs-2 col-sm-2 col-md-2 col-lg-12">
                    <button class="col-lg-12 pull-right btn btn-success"  ><i class = "fa fa-plus"></i><a style = "color:#fff;" href = "calAddEvents.php"> Add Events</a></button>
                    </div>
                    <br>
                    <br>
                    <div class="col-xs-2 col-sm-2 col-md-2 col-lg-12">
                    <button class="col-lg-12 pull-right btn btn-success" style = "margin-left:10px;"><i class = "fa fa-edit"></i><a href ="ManageCalendar.php" style ="color:#fff;decoration:none;">Manage All Events</a></button>

                    </div>
                    <br>
                    <br>
                    <div class="col-xs-2 col-sm-2 col-md-2 col-lg-12">
                    <button class="col-lg-12 pull-right btn btn-success" style = "margin-left:10px;"><a style = "color:#fff;"  href="export_calendar.php?date=<?php echo date("Y-m-d");?>&division=<?php echo $_SESSION['division'];?>" >Export</a></button>
  
                    
                    </div>
                    <br>
                    <br>
                        <div class = "col-lg-6">
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
                            <input class='calFilter' type="checkbox" value="1" >ORD</label>
                        </td>
					</tr>
					<tr>
                    <td style="background-color: #E60785; color:white;">
                    <input class='calFilter' type="checkbox" value="16">FAD</label>
                        
                    </td>
                       
					</tr>
					<tr>
                        <td style="background-color: #48BD0D; color:white;">
                        <input class='calFilter' type="checkbox" value="17" >LGCDD</label>

                        </td>
					</tr>
					<tr>
                    <td style="background-color: #E6680E; color:white;">
                        <input class='calFilter' type="checkbox" value="7">MBRTG</label>
                    </td>
                       
					</tr>
					<tr>
                    <td style="background-color: #0071c5; color:white;">
                    <input class='calFilter' type="checkbox" value="18">LGMED</label>

                        </td>
                    
					</tr>
					<tr>
                    <td style="background-color: #8F0CC7; color:white;">
                    <input class='calFilter' type="checkbox" value="9">PDMU</label>

                        </td>
					</tr>
					
					
                </table>
                        </div>
                        <div class = "col-lg-6">
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
						<td style="background-color: #D5D911; color:black;padding:9px;">Batangas</td>
					</tr>
					<tr>
						<td style="background-color: #0071c5; color:white;;padding:9px;">Cavite</td>
					</tr>
					<tr>
						<td style="background-color: #48BD0D; color:white;;padding:9px;">Laguna</td>
					</tr>
					<tr>
						<td style="background-color: #8F0CC7; color:white;;padding:9px;">Rizal</td>
					</tr>
					<tr>
						<td style="background-color: #E6680E; color:white;;padding:9px;">Quezon</td>
					</tr>
					<tr>
						<td style="background-color: #E60785; color:white;;padding:9px;">Lucena</td>
					</tr>
				
                </table>
                     
                    </div>

                    
                
                </div>
                <div class="col-md-8">
                    
                    
                    

                    
                   
                    <br>
                    <br>    
                    <div id='calendar'></div>

                </div>
<br>
