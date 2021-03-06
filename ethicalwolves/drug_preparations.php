<?php
require_once 'logincheck.php';
require ('config.php');

if(ISSET($_POST['drug_preparations'])){
    $date = $_POST['date'];
    $isoniazid = $_POST['isoniazid'];
    $rifampicin = $_POST['rifampicin'];
    $pyrazinamide = $_POST['pyrazinamide'];
    $ethambutol = $_POST['ethambutol'];
    $streptomycin = $_POST['streptomycin'];
    $patient_id = $_GET['id'];

    $conn = new mysqli("localhost", "root", "", "thesis") or die(mysqli_error());
    $conn->query("INSERT INTO `drug_preparations` VALUES('', '$date', '$isoniazid', '$rifampicin', '$pyrazinamide', '$ethambutol', '$streptomycin', '$patient_id')") or die(mysqli_error());
    header ('location:patient_treatment_table.php');
    $conn->close();
}


?>
<!DOCTYPE html>
<html lang="en">

    <head>
        <!-- META SECTION -->
        <title>BHTC-PMIS</title>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1" />

        <link rel="icon" href="assets/images/project_logo.png" type="image/x-icon" />
        <!-- END META SECTION -->

        <!-- CSS INCLUDE -->
        <link rel="stylesheet" type="text/css" id="theme" href="css/theme-brown.css" />
        <!-- EOF CSS INCLUDE -->
    </head>

    <body>
        <?php
        $conn = new mysqli("localhost", "root", "", "thesis") or die(mysqli_error());
        $query = $conn->query("SELECT * FROM `user` WHERE `user_id` = '$_SESSION[user_id]'") or die(mysqli_error());
        $find = $query->fetch_array();
        ?>
        <!-- START PAGE CONTAINER -->
        <div class="page-container">

            <!-- START PAGE SIDEBAR -->
            <div class="page-sidebar">
                <!-- START X-NAVIGATION -->
                <ul class="x-navigation">
                    <li class="xn-logo">
                        <a href="home.php">BHTC-PMIS</a>
                        <a href="#" class="x-navigation-control"></a>
                    </li>
                    <li class="xn-profile">
                        <a href="#" class="profile-mini">
                            <img src="assets/images/users/no-image.jpg" alt="John Doe" />
                        </a>
                        <div class="profile">
                            <div class="profile-image">
                                <img src="assets/images/project_logo.png" alt="John Doe" />
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

                    <li>
                        <a href="home.php"><span class="fa fa-desktop"></span> <span class="xn-text">Dashboard</span></a>
                    </li>

                    <li> <a href="master_file_patient.php"><span class="fa fa-folder-open"></span> <span class="xn-text">Patient Master File</span></a> </li>

                    <li class="xn-openable">
                        <a href="#"><span class="fa fa-pencil-square-o"></span> <span class="xn-text">Transactions</span></a>
                        <ul>
                            <li> <a href="patient_examination_schedule.php"><span class="fa fa-calendar"></span> <span class="xn-text">Examination Schedule</span></a> </li>
                            <li  class="active"> <a href="laboratory_request_table.php"><span class="fa fa-plus"></span> <span class="xn-text">Laboratory Request</span></a> </li>
                            <li> <a href="registration_table.php"><span class="fa fa-tags"></span> <span class="xn-text">Registration</span></a> </li>
                            <li> <a href="patient_treatment_table.php"><span class="fa fa-user-md"></span> <span class="xn-text">Treatment</span></a> </li>
                            <!--- examination_schedule.php -->
                            <li> <a href="medication_dispensation.php"><span class="fa fa-medkit"></span> <span class="xn-text">Medication Dispensation</span></a> </li>

                        </ul>
                    </li>
                    <li class="xn-openable">
                        <a href="#"><span class="fa fa-bar-chart-o"></span> <span class="xn-text">Reports</span></a>
                        <ul>
                            <li><a href="tb_case_report.php"><span class="fa fa-group"></span><span class="xn-text">TB Case Report</span></a></li>
                            <li><a href="charts-nvd3.html"><span class="fa fa-tint"></span><span class="xn-text">Examination Report</span></a></li>
                        </ul>
                    </li>
                    <li>
                        <a href="system_backup.php"><span class="fa fa-gears"></span> <span class="xn-text">System Maintenance</span></a>
                    </li>


                </ul>
                <!-- END X-NAVIGATION -->
            </div>
            <!-- END X-NAVIGATION -->


            <!-- END PAGE SIDEBAR -->

            <!-- PAGE CONTENT -->
            <div class="page-content">

                <!-- START X-NAVIGATION VERTICAL -->
                <ul class="x-navigation x-navigation-horizontal x-navigation-panel">
                    <!-- TOGGLE NAVIGATION -->
                    <li class="xn-icon-button">
                        <a href="#" class="x-navigation-minimize"><span class="fa fa-bars"></span></a>
                    </li>
                    <!-- END TOGGLE NAVIGATION -->
                    <!-- SIGN OUT -->
                    <li class="xn-icon-button pull-right">
                        <a href="#" class="mb-control" data-box="#mb-signout"><span class="fa fa-power-off"></span></a>
                    </li>
                    <!-- END SIGN OUT -->
                </ul>
                <!-- END X-NAVIGATION VERTICAL -->

                <!-- START BREADCRUMB -->
                <ul class="breadcrumb">
                    <li><a href="home.php">Home</a></li>
                    <li><a href="#">Transaction</a></li>
                    <li><a href="patient_treatment_table.php">Patient Individual Treatment</a></li>
                    <li class="active">Treatment</li>
                </ul>

                <div class="page-content-wrap">
                    <div class="row">
                        <div class="col-md-12">
                            <?php
                            $conn = new mysqli('localhost', 'root', '', 'thesis') or die(mysqli_error());
                            $q = $conn->query("SELECT * FROM `patient` WHERE `patient_id` = '$_GET[id]' && `patient_name` = '$_GET[patient_name]'") or die(mysqli_error());
                            $f = $q->fetch_array();
                            $q2 = $conn->query("SELECT * FROM `clinical_findings` WHERE `patient_id` = '$_GET[id]'") or die(mysqli_error());
                            $f2 = $q2->fetch_array();
                            ?>
                            <form role="form" class="form-horizontal" method="post">
                                <div class="panel panel-primary">
                                    <div class="panel-body list-group list-group-contacts scroll" style="height: 450px;">
                                        <div class="panel-heading">
                                            <h3 class="panel-title"><strong> <span class="fa fa-tint"></span> Drug Preparations</strong></h3>
                                        </div>
                                        <div class="panel-body">
                                            <div class="block">
                                                <div class="form-group ">
                                                    <div class="col-md-6 col-xs-6">
                                                        <div class="input-group">
                                                            <span class="input-group-addon"><span class="fa fa-calendar"></span></span>
                                                            <input  data-toggle="tooltip" data-placement="right" title="Date" type="text" class="form-control datepicker" name="date" placeholder="Date" required/>
                                                        </div>
                                                    </div>
                                                </div>
                                                <hr>
                                                <h3>Drug Preparations for <?php echo $f['patient_name']?></h3>
                                                <h5 class="push-up-20">Isoniazid</h5>
                                                <div class="form-group ">
                                                    <div class="col-md-12 col-xs-12">
                                                        <div class="input-group">
                                                            <span class="input-group-addon"><span class="fa fa-info"></span></span>
                                                            <input data-toggle="tooltip" data-placement="top" title="Isoniazid" type="number" class="form-control" name="isoniazid" placeholder="Isoniazid" required/>
                                                        </div>
                                                    </div>
                                                </div>
                                                <h5 class="push-up-20"> Rifampicin</h5>
                                                <div class="form-group ">
                                                    <div class="col-md-12 col-xs-12">
                                                        <div class="input-group">
                                                            <span class="input-group-addon"><span class="fa fa-info"></span></span>
                                                            <input data-toggle="tooltip" data-placement="top" title="Rifampicin" type="number" class="form-control" name="rifampicin" placeholder="Rifampicin" required/>
                                                        </div>
                                                    </div>
                                                </div><h5 class="push-up-20"> Pyrazinamide</h5>
                                                <div class="form-group ">
                                                    <div class="col-md-12 col-xs-12">
                                                        <div class="input-group">
                                                            <span class="input-group-addon"><span class="fa fa-info"></span></span>
                                                            <input data-toggle="tooltip" data-placement="top" title="Pyrazinamide" type="number" class="form-control" name="pyrazinamide" placeholder="Pyrazinamide" required/>
                                                        </div>
                                                    </div>
                                                </div><h5 class="push-up-20"> Ethambutol</h5>
                                                <div class="form-group ">
                                                    <div class="col-md-12 col-xs-12">
                                                        <div class="input-group">
                                                            <span class="input-group-addon"><span class="fa fa-info"></span></span>
                                                            <input data-toggle="tooltip" data-placement="top" title="Ethambutol" type="number" class="form-control" name="ethambutol" placeholder="Ethambutol" required/>
                                                        </div>
                                                    </div>
                                                </div>
                                                <h5 class="push-up-20"> Streptomycin</h5>
                                                <div class="form-group ">
                                                    <div class="col-md-12 col-xs-12">
                                                        <div class="input-group">
                                                            <span class="input-group-addon"><span class="fa fa-info"></span></span>
                                                            <input data-toggle="tooltip" data-placement="top" title="Streptomycin" type="number" class="form-control" name="streptomycin" placeholder="Streptomycin" required/>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="panel-footer">
                                        <button type="submit" name="drug_preparations" class="btn btn-info pull-right"> <span class="fa fa-check"> Submit </span></button>
                                    </div>
                                    <?php require_once 'drug_preparations.php' ?>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <!-- END PAGE CONTENT WRAPPER -->
            </div>
            <!-- END PAGE CONTENT -->
        </div>
        <div class="message-box message-box-danger animated fadeIn" data-sound="alert" id="mb-signout">
            <div class="mb-container">
                <div class="mb-middle">
                    <div class="mb-title"><span class="glyphicon glyphicon-off"></span> Log <strong>Out</strong> ?</div>
                    <div class="mb-content">
                        <p>Are you sure you want to log out?</p>
                        <p>Press No if you want to continue work. Press Yes to logout current user.</p>
                    </div>
                    <div class="mb-footer">
                        <div class="pull-right">
                            <a href="logout.php" class="btn btn-danger btn-lg">Yes</a>
                            <button class="btn btn-default btn-lg mb-control-close">No</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <audio id="audio-alert" src="audio/alert.mp3" preload="auto"></audio>
        <audio id="audio-fail" src="audio/fail.mp3" preload="auto"></audio>
        <script type="text/javascript" src="js/plugins/jquery/jquery.min.js"></script>
        <script type="text/javascript" src="js/plugins/jquery/jquery-ui.min.js"></script>
        <script type="text/javascript" src="js/plugins/bootstrap/bootstrap.min.js"></script>
        <script type='text/javascript' src='js/plugins/icheck/icheck.min.js'></script>
        <script type="text/javascript" src="js/plugins/mcustomscrollbar/jquery.mCustomScrollbar.min.js"></script>
        <script type='text/javascript' src='js/plugins/bootstrap/bootstrap-datepicker.js'></script>
        <script type='text/javascript' src='js/plugins/bootstrap/bootstrap-select.js'></script>
        <script type="text/javascript" src="js/plugins.js"></script>
        <script type="text/javascript" src="js/actions.js"></script>
        <script type='text/javascript' src='js/plugins/icheck/icheck.min.js'></script>
        <script type="text/javascript" src="js/plugins/mcustomscrollbar/jquery.mCustomScrollbar.min.js"></script>
    </body>
</html>