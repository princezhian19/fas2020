
<div class="row">
        <div class="col-md-12">
          <div class="box">
            <div class="box-body">
              <div class="row">
                <div class="col-md-4">
                <h1>Calendar of Activities</h1>
                <div class = "col-lg-12">
                
                    <div class = "col-xs-2 col-sm-2 col-md-2 col-lg-12">
                    <!-- <input type = "text" class = "form-control filter"  id="type_filter" placeholder=  "Search Activities"/> -->
                    
                    </div><br><br><br><br><br>
                    <div class="col-md-12">
                        <button class="pull-right btn btn-success" id = "modal"  style = "margin-left:5%;"><i class = "fa fa-plus"></i><a style = "color:#fff;" > Add Activity</a></button>                        
                       <button class="pull-right btn btn-success"><i class = "fa fa-edit"></i><a href ="ManageCalendar.php?division=<?php echo $_GET['division'];?>" style ="color:#fff;decoration:none;">Manage All</a></button>
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
                                                All Offices</b></td>
                                            </tr>
                                        
                                            <tr>
                                            <td style="background-color: #D5D911; color:white;WIDTH:50%;">
                                                    <input class='calFilter' type="checkbox" name = "offices[]" value="1" id = "ord" ><label style = "margin-left:15%;">ORD</label>
                                                </td>
                                                <td style="background-color: #607D8B; color:#fff;padding:9px;WIDTH:50%;">
                                                    <input class='calFilter' type="checkbox" name = "offices[]" value="19" id = "batangas"><label style = "margin-left:15%;">Batangas</label>
                                                </td>
                                            </tr>
                                            <tr>
                                            <td style="background-color: #E60785; color:white;">
                                                    <input class='calFilter' type="checkbox" name = "offices[]" value="10" id = "fad"><label style = "margin-left:15%;">FAD</label>
                                                </td>
                                                <td style="background-color:#FF9800 ; color:white;;padding:9px;">
                                                    <input class='calFilter' type="checkbox" name = "offices[]" value="20" id = "cavite"><label style = "margin-left:15%;">Cavite</label>
                                                </td>
                                            </tr>
                                            <tr>
                                            <td style="background-color: #48BD0D; color:white;">
                                                    <input class='calFilter' type="checkbox" name = "offices[]" value="17" id = "lgcdd"><label style = "margin-left:15%;">LGCDD</label>
                                                </td>
                                                <td style="background-color:#009688; color:white;;padding:9px;">                                   
                                                    <input class='calFilter' type="checkbox" name = "offices[]" value="21" id = "laguna" ><label style = "margin-left:15%;">Laguna</label>
                                                </td>
                                            </tr>
                                            <tr>
                                            <td style="background-color: #E6680E; color:white;">
                                                    <input class='calFilter' type="checkbox" name = "offices[]" value="7" id = "mbrtg"><label style = "margin-left:15%;">MBRTG</label>
                                                </td>
                                                <td style="background-color:#81D4FA; color:white;;padding:9px;">
                                                    <input class='calFilter' type="checkbox" name = "offices[]" value="23" id = "rizal"><label style = "margin-left:15%;">Rizal</label>
                                                </td>
                                            
                                            </tr>
                                            <tr>
                                            <td style="background-color: #0071c5; color:white;">
                                                    <input class='calFilter' type="checkbox" name = "offices[]" value="18" id = "lgmed"><label style = "margin-left:15%;">LGMED</label>
                                                </td>
                                                <td style="background-color:#d50000; color:white;;padding:9px;">
                                                    <input class='calFilter' type="checkbox" name = "offices[]" value="22" id = "quezon"><label style = "margin-left:15%;">Quezon</label>
                                                </td>
                                            
                                            </tr>
                                            <tr>
                                            <td style="background-color: #8F0CC7; color:white;">
                                                    <input class='calFilter' data-id = "9" type="checkbox" name = "offices[]" value="9" id = "pdmu" ><label style = "margin-left:15%;">PDMU</label>
                                                </td>
                                                <td style="background-color: #FFEB3B; color:white;;padding:9px;">
                                        <input class='calFilter' type="checkbox" name = "offices[]" value="24"id = "lucena"><label style = "margin-left:15%;">Lucena City</label>
                                    </td>
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
