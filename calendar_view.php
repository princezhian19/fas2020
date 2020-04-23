<div class="row">
        <div class="col-md-12">
          <div class="box">
            <div class="box-body">
              <div class="row">
                <div class="col-md-3">
                <h1>Calendar of Events</h1>
                
                    <div class="col-xs-2 col-sm-2 col-md-2 col-lg-12" id = "selectMonth" >  
                    </div>
                    <br>
                    <br>
                    <br>
                    <div class="col-xs-2 col-sm-2 col-md-2 col-lg-12">
                        <select class="form-control " id="selectYear" style="width: 100%;">
                            <?php 
                            for($i= 2020; $i < 2031; $i++)
                            {
                            echo '<option value='.$i.'>'.$i.'</option>';
                            }
                            ?>
                            </select>
                            </div>  <br><br><br>
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
                    <table class="table table-bordered" style="border-width: 3px;">
					<tr>
						<td style=""><b><center>DIVISION LEGENDS</center></b></td>
					</tr>
					<tr>
						<td style="background-color: #D5D911; color:black;">ORD</td>
					</tr>
					<tr>
						<td style="background-color: #0071c5; color:white;">LGMED</td>
					</tr>
					<tr>
						<td style="background-color: #48BD0D; color:white;">LGCDD</td>
					</tr>
					<tr>
						<td style="background-color: #8F0CC7; color:white;">PDMU</td>
					</tr>
					<tr>
						<td style="background-color: #E6680E; color:white;">MBRTG</td>
					</tr>
					<tr>
						<td style="background-color: #E60785; color:white;">FAD</td>
					</tr>
					<tr>
						<td style="background-color: #000; color:white;">PROVINCE</td>
					</tr>
					
				</table>
                </div>
                <div class="col-md-9">
                    
                    
                    

                    
                   
                    <br>
                    <br>    
                    <div id='calendar'></div>

                </div>
<br>
