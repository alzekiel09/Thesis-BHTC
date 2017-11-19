<?php
require_once '../logincheck.php';
require ('../config.php');
?>
<!DOCTYPE html>
<html lang="en">

    <head>
        <title>BHTC-PMIS</title>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1" />
        <link rel="icon" href="../assets/images/project_logo.png" type="image/x-icon" />
        <link rel="stylesheet" type="text/css" id="theme" href="../css/theme-brown.css" />
        <link rel="stylesheet" type="text/css" href="../assets2/vendor/font-awesome/css/font-awesome.min.css" />
        <script src="../js/plugins/jquery/jquery.min.js"></script>
        <script src = "../js/jquery.canvasjs.min.js"></script>
        <?php include_once '../js/loadchart/annual_population.php'?>
    </head>
    <body>
        <?php 
    $query = $conn->query("SELECT * FROM `user` WHERE `user_id` = $_SESSION[user_id]") or die(mysqli_error());
        $find = $query->fetch_array();
        ?>
        <div class="page-container">
            <div class="page-sidebar">
                <ul class="x-navigation">
                    <li class="xn-logo">
                        <a href="../home.php">BHTC-PMIS</a>
                        <a href="#" class="x-navigation-control"></a>
                    </li>
                    <li class="xn-profile">
                        <a href="#" class="profile-mini">
                            <img src="../assets/images/users/no-image.jpg" alt="John Doe" />
                        </a>
                        <div class="profile">
                            <div class="profile-image">
                                <img src="../assets/images/project_logo.png" alt="John Doe" />
                            </div>
                            <div class="profile-data">
                                <div class="profile-data-name">
                                    <?php 
                                    echo $find['firstname']." ".$find['lastname'];
                                    ?>
                                </div>
                                <div class="profile-data-title">
                                    <?php 
                                    echo $find['position'];
                                    ?>
                                </div>
                            </div>
                            <div class="profile-controls">
                                <a href="pages-profile.html" class="profile-control-left"><span class="fa fa-info"></span></a>
                            </div>
                        </div>
                    </li>
                    <li class="active">
                        <a href="../home.php"><span class="fa fa-desktop"></span> <span class="xn-text">Dashboard</span></a>
                    </li>
                    <li class="xn-openable">
                        <a href="#"><span class="fa fa-folder-open"></span> <span class="xn-text">Master File</span></a>       
                        <ul>
                            <li><a href="../master_file_patient.php"><span class="fa fa-group"></span><span class="xn-text">Patient Master File</span></a></li>
                            <li><a href="../master_file_medtech.php"><span class="fa fa-user-md"></span><span class="xn-text">Medical Technologist</span></a></li>
                        </ul>
                    </li> 
                    <li class="xn-openable">
                        <a href="#"><span class="fa fa-pencil-square-o"></span> <span class="xn-text">Transactions</span></a>
                        <ul>
                            <li> <a href="../patient_examination_schedule_table.php"><span class="fa fa-calendar"></span> <span class="xn-text">Follow-up Examination</span></a> </li>
                            <li> <a href="../laboratory_request_table.php"><span class="fa fa-plus"></span> <span class="xn-text">Laboratory Request</span></a> </li>
                            <li> <a href="../registration_table.php"><span class="fa fa-file-text"></span> <span class="xn-text">Registration</span></a> </li>
                            <li> <a href="../patient_treatment_table.php"><span class="fa fa-user-md"></span> <span class="xn-text">Treatment</span></a> </li>
                            <li> <a href="../patient_certification_table.php"><span class="fa fa-book"></span> <span class="xn-text">Certification</span></a> </li>
                            <li> <a href="../medication_dispensation.php"><span class="fa fa-medkit"></span> <span class="xn-text">Medication Dispensation</span></a> </li>
                        </ul>
                    </li>
                    <li class="xn-openable">
                        <a href="#"><span class="fa fa-bar-chart-o"></span> <span class="xn-text">Reports</span></a>
                        <ul>
                            <li><a href="../reports.php"><span class="fa fa-group"></span><span class="xn-text">TB Case Report</span></a></li>
                            <li><a href="../charts-nvd3.html"><span class="fa fa-tint"></span><span class="xn-text">Examination Report</span></a></li>
                        </ul>
                    </li>
                    <li class="xn-openable">
                        <a href="#"><span class="fa fa-gears"></span> <span class="xn-text">System Maintenance</span></a>       
                        <ul>
                            <li><a href="../change_password.php"><span class="fa fa-key"></span><span class="xn-text">Update Profile</span></a></li>
                            <li><a href="../system_backup.php?id=<?php echo $find['user_id']?>&username=<?php echo $find['username']?>"><span class="fa fa-cloud-download"></span><span class="xn-text">Download Database</span></a></li>
                        </ul>
                    </li> 
                </ul>
            </div>

            <div class="page-content">
                <ul class="x-navigation x-navigation-horizontal x-navigation-panel">
                    <li class="xn-icon-button">
                        <a href="#" class="x-navigation-minimize"><span class="fa fa-bars"></span></a>
                    </li>
                    <li class="xn-icon-button pull-right">
                        <a href="#" class="mb-control" data-box="#mb-signout"><span class="fa fa-power-off"></span></a>
                    </li>
                </ul>
                <ul class="breadcrumb">
                    <li><a href="../home.php">Home</a></li>
                    <li class="#">Reports</li>
                    <li><a href="../reports.php">TB Cases Report</a></li>
                    <li class="#">Patient Population</li>
                </ul>
                <div class="page-content-wrap">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="panel panel-default tabs">
                                <ul class="nav nav-tabs" role="tablist">
                                    <li class="active"><a href="#tab-first" role="tab" data-toggle="tab">Graphical</a></li>
                                    <li><a href="#tab-second" role="tab" data-toggle="tab">Tabular</a></li>
                                </ul>
                                <div class="panel-body tab-content">
                                    <div class="tab-pane active" id="tab-first">

                                        <div class="row">
                                            <div class="panel-heading">
                                                <h3 class="panel-title"><strong> <span class="fa fa-bar-chart"></span> Patient Annual Population</strong></h3>
                                            </div>
                                            <div class="panel-body">
                                                <div id="annual_population" style="width: 100%; height: 350px"></div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="tab-pane" id="tab-second">
                                        <div class="panel-body list-group list-group-contacts scroll" style="height: 435px;">
                                            <div class="row">
                                                <table class="table table-hover">
                                                    <thead>
                                                        <tr>
                                                            <th>Year</th>
                                                            <th><center>Number of Patients Registererd per Year</center></th>

                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <?php
    $year = date('Y');
                                   $conn = new mysqli("localhost", "root", "", "thesis") or die(mysqli_error());
                                   $q1 = $conn->query("SELECT COUNT(*) as total FROM `registration` WHERE `year` = '$2016'") or die(mysqli_error());
                                   $fetch1 = $q1->fetch_array();
                                   $q2 = $conn->query("SELECT COUNT(*) as total FROM `registration` WHERE `year` = '2017'") or die(mysqli_error());
                                   $fetch2 = $q2->fetch_array();
                                   $q3 = $conn->query("SELECT COUNT(*) as total FROM `registration` WHERE `year` = '2018'") or die(mysqli_error());
                                   $fetch3 = $q3->fetch_array();
                                   $q4 = $conn->query("SELECT COUNT(*) as total FROM `registration` WHERE `year` = '2019'") or die(mysqli_error());
                                   $fetch4 = $q4->fetch_array();
                                   $q5 = $conn->query("SELECT COUNT(*) as total FROM `registration` WHERE `year` = '2020'") or die(mysqli_error());
                                   $fetch5 = $q5->fetch_array();
                                   $q6 = $conn->query("SELECT COUNT(*) as total FROM `registration` WHERE `year` = '2021'") or die(mysqli_error());
                                   $fetch6 = $q6->fetch_array();
                                   $q7 = $conn->query("SELECT COUNT(*) as total FROM `registration` WHERE `year` = '2022'") or die(mysqli_error());
                                   $fetch7 = $q7->fetch_array();

                                                        ?>
                                                        <tr>
                                                            <td>2016</td>
                                                            <td><center><strong><?php echo $fetch1['total']?></strong></center></td>
                                                        </tr>
                                                        <tr>
                                                            <td>2017</td>
                                                            <td><center><strong><?php echo $fetch2['total']?></strong></center></td>
                                                        </tr>
                                                        <tr>
                                                            <td>2018</td>
                                                            <td><center><strong><?php echo $fetch3['total']?></strong></center></td>
                                                        </tr>
                                                        <tr>
                                                            <td>2019</td>
                                                            <td><center><strong><?php echo $fetch4['total']?></strong></center></td>
                                                        </tr>
                                                        <tr>
                                                            <td>2020</td>
                                                            <td><center><strong><?php echo $fetch5['total']?></strong></center></td>
                                                        </tr>
                                                        <tr>
                                                            <td>2021</td>
                                                            <td><center><strong><?php echo $fetch6['total']?></strong></center></td>
                                                        </tr>
                                                        <tr>
                                                            <td>2022</td>
                                                            <td><center><strong><?php echo $fetch7['total']?></strong></center></td>
                                                        </tr>
                                                    </tbody>
                                                </table>


                                            </div></div>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="message-box message-box-danger animated fadeIn" data-sound="alert" id="mb-signout">
            <div class="mb-container">
                <div class="mb-middle">
                    <div class="mb-title"><span class="glyphicon glyphicon-off"></span> Log <strong>Out</strong> ?</div>
                    <div class="mb-content">
                        <p>Are you sure you want to log out?</p>
                        <p>Press No if youwant to continue work. Press Yes to logout current user.</p>
                    </div>
                    <div class="mb-footer">
                        <div class="pull-right">
                            <a href="../logout.php" class="btn btn-danger btn-lg">Yes</a>
                            <button class="btn btn-default btn-lg mb-control-close">No</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <script>
            $(document).ready(function(){
                $("#pyear").on('change', function(){
                    var year=$(this).val();
                    window.location = 'reports_patient_population.php?year='+year;
                });
            });
        </script>
        <audio id="audio-alert" src="audio/alert.mp3" preload="auto"></audio>
        <audio id="audio-fail" src="audio/fail.mp3" preload="auto"></audio>
        <script type='text/javascript' src='../js/plugins/bootstrap/bootstrap-select.js'></script>
        <script type="text/javascript" src="../js/plugins/jquery/jquery-ui.min.js"></script>
        <script type="text/javascript" src="../js/plugins/bootstrap/bootstrap.min.js"></script>
        <script type='text/javascript' src='../js/plugins/icheck/icheck.min.js'></script>
        <script type="text/javascript" src="../js/plugins/mcustomscrollbar/jquery.mCustomScrollbar.min.js"></script>
        <script type="text/javascript" src="../js/plugins.js"></script>
        <script type="text/javascript" src="../js/actions.js"></script>
    </body>
</html>


<!-- -->