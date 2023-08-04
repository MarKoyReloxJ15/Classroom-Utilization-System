<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">

    <link rel="stylesheet" href="adminStyle.css">
    <link rel="icon" href="images/rsuLogo.png" type="image/x-icon"/>   

    <title>Classroom Utilization Management System</title>
</head>
<body>


   <div class="cont">
   
    <img  class="logoBack" src="images/rsuLogo.png" alt="hellow to the world">

        <div class="secCont">

          <span style="cursor:pointer" onclick="openNav()">&#9776;</span>

          <div id="myNav" class="overlay" >
            <a href="javascript:void(0)" class="closebtn" onclick="closeNav()">&times;</a>
            <div class="overlay-content">
                   <div class="hiddenNav">
                            <ul>
                                <li class="tablinks" onclick="openTab(event, 'Home')">Home</li>
                                <li class="tablinks" onclick="openTab(event, 'Blocks')">Blocks</li>
                                <li class="tablinks" onclick="openTab(event, 'Schedules')">Schedules</li>
                                <li class="tablinks" onclick="openTab(event, 'Instructor')">Instructors</li>
                                <li class="tablinks" onclick="openTab(event, 'List')">List</li>
                                <li class="tablinks" onclick="logoutConfirmation()"><a href="#" style="text-decoration: none;">Logout</a></li>
                            </ul>
                    </div>
            </div>
          </div>


                <div class="scholNameCont">
                  <div class="scholName">
                    <img  class="scholNLogo" src="images/rsuLogo.png" alt="hellow to the world">
                    <h1>Romblon State University-Cajidiocan Campus</h1>
                </div>

                </div>

                <div class="G_tFCont">

                     <div class="graybox"> <!-- the standard in this part upto line 36 should be <nav> but I styled it too early-->
                        <h3>Admin</h3>
                            <ul>
                                <li id="HomeLi"class="tablinks" onclick="openTab(event, 'Home')">Home</li>
                                <li class="tablinks" onclick="openTab(event, 'Blocks')">Blocks</li>
                                <li class="tablinks" onclick="openTab(event, 'Schedules')">Schedules</li>
                                <li class="tablinks" onclick="openTab(event, 'Instructor')">Instructor</li>
                                <li class="tablinks" onclick="openTab(event, 'List')">List</li>
                                <li class="tablinks" onclick="logoutConfirmation()"><a href="#" style="text-decoration: none;color:black">Logout</a></li>
                            </ul>
                    </div>


                    <!-- home section -->
                    <div id="Home" class=" tabcontent Home" id="div1">
                        <h1 style="text-align: center;margin-top: 0;padding-top: 0;">Classroom Utilization Management System</h1>
                        <div ><!--former form-->
                            
                            <div class="overflowDiv"><!--this is the table for the home content for overflow-->
                           
                            <iframe src="HomeMainFunc/HomeTableMainFunc.php" frameborder="0" style="width: 100%;height:100%;">
                                <?php
                                    //include"";
                                ?>
                            </iframe>
                            </div>   <!--end for former form-->
                            </div>
                    </div>

                        <!--end for home section -->

                        

                    <!-----     blocks section   -->

                    <div id="Blocks" class="tabcontent blockSec" style="display: none;">
                      <h1 style="text-align: center;margin-top: 0;padding-top: 0;">Classroom Utilization Management System</h1>
                        <div><!-- use to be a form-->
                        <div class="overflowDiv">
                            <iframe src="CRUD_ForBlocks/index.php" frameborder="0" style="width: 100%;height:100%;">
                                <?php
                                    //include"";
                                ?>
                            </iframe>


                        </div>
                              
            </div><!-- end of used to be a form-->
                    </div>
                    <!-----    end of blocks section   -->



                    <!-----     schedules section   -->

                    <div id="Schedules" class="tabcontent SchedSec" style="display: none;">
                    <h1 style="text-align: center;margin-top: 0;padding-top: 0;">Classroom Utilization Management System</h1>
                    
                      <div><!-- use to be a form-->
                        
                      
                      <div class="overflowDiv"><!--this is the table for the home content for overflow  ____just save for later<img src="images/expand.png" alt="">-->
                      <button class="fulscren" title="Full Screen"><a href="Scheduling_SystemSimple PHP/schedulingsystem/tablelist.php" target="_self"><i class="material-icons" style="font-size:36px">fullscreen</i></a></button>     
                          <iframe src="Scheduling_SystemSimple PHP/schedulingsystem/tablelist.php" frameborder="0" style="width: 100%;height:100%;">    
                                                 
                           </iframe>
                        
                      </div>

                </div><!-- end of used to be a form-->
                  </div>

                    <!-----    end of  schedules section   -->




                    <!--        Instructor section    -->

                    <div id="Instructor" class="tabcontent InstructSec" style="display: none;">
                      <h1 style="text-align: center;margin-top: 0;padding-top: 0;">Classroom Utilization Management System</h1>
                        <div><!--former form----->
                          
                        <div class="overflowDiv">
                        <iframe src="CRUD/index.php" frameborder="0" style="width: 100%;height:100%;">                                
                            </iframe>


                        </div>

                    </div>
                    </div>
                    <!--           end of instructor section  -->

                    <!-- List Area                    -->

                    <div id="List" class="tabcontent InstructSec" style="display: none;">
                      <h1 style="text-align: center;margin-top: 0;padding-top: 0;">Classroom Utilization Management System</h1>
                        <div><!--former form----->
                          
                        <div class="overflowDiv">
                        <iframe src="Scheduling_SystemSimple PHP\schedulingsystem\list.php" frameborder="0" style="width: 100%;height:100%;">                                
                            </iframe>


                        </div>

                    </div>
                    </div>

                    <!-- end of list area            -->




                     <!--        logout section    -->

                     <!-- <div id="Logout" class="tabcontent LogoutSec" style="display: none;">
                      <h1 style="text-align: center;margin-top: 0;padding-top: 0;">Classroom Utilization Management System</h1>
                        <div>
                         
  
                    </div>
                    </div>  -->
                     <!--      end of login section  -->


            </div> 
        </div>

                
        </div>
    
   </div>
    <footer>

      
    </footer>
   <script src="adminScript.js"></script><!--for the javascript styling-->

</body>
</html>