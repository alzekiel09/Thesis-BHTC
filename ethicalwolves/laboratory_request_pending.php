<?php
require_once 'logincheck.php';
require ('config.php');

$q = $conn->query("SELECT COUNT(*) as total FROM `laboratory_request` WHERE `status` = 'Pending'") or die(mysqli_error());
$f = $q->fetch_array();

?>
<!DOCTYPE html>
<html lang="en">

    <head>
        <!-- META SECTION -->
        <title>
            <?php 

            if ($f['total'] > 0)   {
                echo '(';    
                echo $f['total']; 
                echo ') BHTC-PMIS';
            }
            else 
                echo 'BHTC-PMIS'
            ?>
        </title>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1" />
        <link rel="icon" href="assets/images/project_logo.png" type="image/x-icon" />
        <link rel="stylesheet" type="text/css" id="theme" href="css/theme-brown.css" />
        <link rel="stylesheet" type="text/css" href="assets2/vendor/font-awesome/css/font-awesome.min.css" />
    </head>
    <body class="page-container-boxed">
        <?php 
                $query = $conn->query("SELECT * FROM `user` WHERE `user_id` = $_SESSION[user_id]") or die(mysqli_error());
            $find = $query->fetch_array();
        ?>
        <!-- START PAGE CONTAINER -->
        <div class="page-container">
            <div class="page-sidebar">
                <ul class="x-navigation">
                    <li class="xn-logo">
                        <a href="home.php">BHTC-PMIS</a>
                        <a href="#" class="x-navigation-control"></a>
                    </li>
                    <li class="xn-profile">
                        <a href="#" class="profile-mini">
                            <img src="assets/images/project_logo.png" alt="John Doe" />
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
                    <li class="active">
                        <a href="dashboard_medtech.php"><span class="fa fa-desktop"></span> <span class="xn-text">Dashboard</span></a>
                    </li>
                    <li>
                        <a href="medtech_patient_master_file.php"><span class="fa fa-folder-open"></span> <span class="xn-text">Patient Master File</span></a>
                    </li>
                    <li>
                        <a href="medtech_laboratory_request.php"><span class="fa fa-flask"></span> <span class="xn-text">Laboratory Request</span></a>
                    </li>
                    <li>
                        <a href="medtech_examination_reports.php"><span class="fa fa-bar-chart"></span> <span class="xn-text">Examination Reports</span></a>
                    </li>
                </ul>
            </div>
            <div class="page-content">
                <ul class="x-navigation x-navigation-horizontal x-navigation-panel">
                    <!-- TOGGLE NAVIGATION -->
                    <li class="xn-icon-button">
                        <a href="#" class="x-navigation-minimize"><span class="fa fa-bars"></span></a>
                    </li>
                    <li class="xn-icon-button pull-right">
                        <a href="index.php" class="mb-control" data-box="#mb-signout"><span class="fa fa-power-off"></span></a>
                    </li>

                </ul>
                <ul class="breadcrumb">
                    <li><a href="dashboard_medtech.php">Home</a></li>
                    <li><a href="medtech_laboratory_request.php">Laboratory Request</a></li>
                    <li class="active">Confirm Laboratory Request</li>
                </ul>
                <div class="page-content-wrap">
                    <div class="row">
                        <div class="col-md-8">
                            <?php
                            $q1 = $conn->query("SELECT * FROM `patient` WHERE `patient_id` = '$_GET[id]'") or die(mysqli_error());
                            $f1 = $q1->fetch_array();
                            ?>
                            <div class="panel panel-info">
                                <div class="panel-body list-group list-group-contacts scroll" style="height: 450px;">
                                    <div class="panel-heading">
                                        <h3 class="panel-title"><strong> <span class="fa fa-file-text"></span> Laboratory Requests of <?php echo $f1['patient_name']?></strong></h3>
                                    </div>
                                    <div class="panel-body">
                                        <?php
    $q1 = $conn->query("SELECT * FROM `patient` WHERE `patient_id` = '$_GET[id]'") or die(mysqli_error());
                                            $f1 = $q1->fetch_array();
                                            $id = $f1['patient_id'];
                                            $q = $conn->query("SELECT * FROM `laboratory_request` WHERE `patient_id` = '$_GET[id]' ORDER BY `status` DESC") or die(mysqli_error());
                                            while ($f = $q->fetch_array()) 
                                            {
                                                if($f['status'] == 'Pending'){
                                                    echo "<textarea  style = color:#000;font-size:13px;height:68px;' disabled = 'disabled' class = 'form-control'>Date Requested:    ".$f['date_of_request']."                                                                                                                                                                                                                             Test Requested:     ".$f['test_requested']."                                                                                                                                                                                                                   Requesting Physician: ".$f['requesting_physician']."</textarea><br/><a class = 'btn btn-danger' href = 'examination_result_form.php?patient_id=".$_GET['id']."&lab_request_id=".$f['lab_request_id']."&patient_name=".$f1['patient_name']."'><span class = 'fa fa-pencil-square-o'></span> Confirm</a><br /><br />";
                                                }
                                                else{
                                                    echo "<textarea  style = color:#000;font-size:13px;height:68px;' disabled = 'disabled' class = 'form-control'> Date Requested:    ".$f['date_of_request']."                                                                                   
 Test Requested:     ".$f['test_requested']."         
 Requesting Physician: ".$f['requesting_physician']."</textarea><br /><a class = 'btn btn-info' disabled = 'disabled'><span class = 'glyphicon glyphicon-check'></span>Confirmed</a><br /><br />";
                                                }
                                            }
                                        ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <!-- START DATATABLE EXPORT -->
                            <div class="panel panel-info">
                                <div class="panel-heading">
                                    <h3 class="panel-title"><span class="fa fa-clipboard"></span> Laboratory Request History</h3>
                                </div>
                                <div class="panel-body list-group list-group-contacts scroll" style="height: 400px;">
                                    <div class="panel-body">
                                        <table id="laboratory_request" class="table table-hover">
                                            <thead>
                                                <tr class="info">
                                                    <th><center>Date Requested</center></th>
                                                    <th><center>Status</center></th>
                                                    <th><center>View Record</center></th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php
                                                $conn = new mysqli('localhost', 'root', '', 'thesis') or die(mysqli_error());
                                                $query = $conn->query("SELECT * FROM `laboratory_request` WHERE `patient_id` = '$_GET[id]' ORDER BY `lab_request_id` DESC") or die(mysqli_error());
                                                while($fetch = $query->fetch_array()){
                                                ?>
                                                <tr>
                                                    <td><center><?php echo $fetch['date_of_request']?></center></td>
                                                    <td><center><strong><?php echo $fetch['status']?></strong></center></td>
                                                    <td>
                                                        <center>
                                                            <a href="#viewdata<?php echo $fetch['lab_request_id'];?>" data-toggle="modal" data-target="#viewdata<?php echo $fetch['lab_request_id'];?>" class="btn btn-info btn-sm" ><span class="fa fa-search"></span> </a>
                                                        </center>
                                                    </td>
                                                </tr>
                                                <?php
                                                }
                                                $conn->close();
                                                ?>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
        <?php
        $conn = new mysqli("localhost", "root", "", "thesis") or die(mysqli_error());
        $query = $conn->query("SELECT * FROM `laboratory_request` ORDER BY `lab_request_id` DESC") or die(mysqli_error());
        while($fetch = $query->fetch_array()){
        ?>
        <div id="viewdata<?php echo $fetch['lab_request_id'];?>"  class="modal fade" tabindex="-1" role="dialog" aria-labelledby="defModalHead" aria-hidden="true" style="display:none;">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                        <h4 class="modal-title" id="defModalHead"><span class="fa fa-file-text"></span> Laboratory Request of <?php echo $f1['patient_name']?></h4>
                    </div>
                    <form role="form" class="form-horizontal" action="edit_query.php" method="post">
                        <div class="modal-body">
                            <div class="panel-body">
                                <div class="panel panel-info">
                                    <div class="panel-body profile">
                                        <div class="panel-body">                                    
                                            <div class="contact-info">
                                                <p><small style="font-size:13px;">Name of Collection Unit</small><br/><?php echo $fetch['collection_unit']?></p>
                                                <p><small style="font-size:13px;">Date of Request</small><br/><?php echo $fetch['date_of_request']?></p>
                                                <p><small style="font-size:13px;">Requesting Physician</small><br/><?php echo $fetch['requesting_physician']?></p>
                                                <p><small style="font-size:13px;">Date Sample 1 Collected</small><br/><?php echo $fetch['date_sample_collected']?></p>
                                                <p><small style="font-size:13px;">Date Sample 2 Collected</small><br/><?php echo $fetch['date_sample_collected2']?></p>
                                                <p><small style="font-size:13px;">Name of Sample Collector</small><br/><?php echo $fetch['sample_collector']?></p>
                                                <p><small style="font-size:13px;">Contact Number</small><br/><?php echo $fetch['contact_number']?></p>
                                                <p><small style="font-size:13px;">Reason For Examination</small><br/><?php echo $fetch['reason_for_examination']?></p>
                                                <p><small style="font-size:13px;">Specimen Type</small><br/><?php echo $fetch['specimen_type']?></p>
                                                <p><small style="font-size:13px;">Test Requested</small><br/><?php echo $fetch['test_requested']?></p>
                                            </div>
                                        </div>    
                                    </div>    
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-danger" data-dismiss="modal"><span class="fa fa-times"></span>Close</button>                        
                        </div>

                    </form>
                </div>
            </div>
        </div>
        <?php
        }
        $conn->close();
        ?> 

        <div class="message-box animated fadeIn" data-sound="alert" id="mb-signout">
            <div class="mb-container">
                <div class="mb-middle">
                    <div class="mb-title"><span class="fa fa-power-off"></span> Log <strong>Out</strong> ?</div>
                    <div class="mb-content">
                        <p>Are you sure you want to log out?</p>
                        <p>Press No if youwant to continue work. Press Yes to logout current user.</p>
                    </div>
                    <div class="mb-footer">
                        <div class="pull-right">
                            <a href="index.php" class="btn btn-success btn-lg">Yes</a>
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
        <script type='text/javascript' src='js/plugins/bootstrap/bootstrap-datepicker.js'></script>
        <script type='text/javascript' src='js/plugins/bootstrap/bootstrap-select.js'></script>
        <script type='text/javascript' src='js/plugins/validationengine/languages/jquery.validationEngine-en.js'></script>
        <script type="text/javascript" src="js/plugins.js"></script>
        <script type="text/javascript" src="js/actions.js"></script>
        <script type='text/javascript' src='js/plugins/icheck/icheck.min.js'></script>
        <script type="text/javascript" src="js/plugins/mcustomscrollbar/jquery.mCustomScrollbar.min.js"></script>
    </body>

</html>