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
        <?php include_once '../js/loadchart/barangay_population.php'?>
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
                    <li class="#">Barangay Population</li>
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
                                                <h3 class="panel-title"><strong> <span class="fa fa-bar-chart"></span> TB Patient Population Per Barangay</strong></h3>
                                                <div class="btn-group pull-right">
                                                    <div class="pull-left">
                                                        <select id="pyear" class="validate[required] select" data-style="btn-info">
                                                            <option>Please Select Year...</option>
                                                            <option value="<?php 
    if(isset($_GET['year'])){
        $value=$_GET['year']; 
        echo $value;
    }
                                   else{
                                       echo date('Y');
                                   }
                                                                           ?>">
                                                                <?php 
                                                                if(isset($_GET['year'])){
                                                                    $value=$_GET['year']; 
                                                                    echo $value;
                                                                }
                                                                else{
                                                                    echo date('Y');
                                                                }
                                                                ?></option>
                                                            <?php
                                                            for($y=2015; $y<=2020; $y++){
                                                            ?>
                                                            <option value="<?php echo $y ?>"><?php echo $y; ?></option>
                                                            <?php
                                                            }
                                                            ?>
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="panel-body">
                                                <div id="barangay_population" style="width: 100%; height: 350px"></div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="tab-pane" id="tab-second">
                                        <div class="panel-body list-group list-group-contacts scroll" style="height: 430px;">
                                            <div class="row">
                                                <table class="table table-hover">
                                                    <thead>
                                                        <tr>
                                                            <th>Barangay</th>
                                                            <th><center>Number of Patients per Barangay</center></th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <?php
                                                        $year = date('Y');
                                                        if(isset($_GET['year']))
                                                        {
                                                            $year=$_GET['year'];
                                                        }

                                                        $conn = new mysqli("localhost", "root", "", "thesis") or die(mysqli_error());

                                                        $abcasa = $conn->query("SELECT COUNT(*) as total FROM `patient` WHERE `year` =  '$year' && `status` = 'Registered' && `barangay` = 'Abcasa'") or die(mysqli_error());
                                                        $fetch1 = $abcasa->fetch_array();

                                                        $alangilan = $conn->query("SELECT COUNT(*) as total FROM `patient` WHERE `year` =  '$year' && `status` = 'Registered' && `barangay` = 'Alangilan'") or die(mysqli_error());
                                                        $fetch2 = $alangilan->fetch_array();

                                                        $alijis = $conn->query("SELECT COUNT(*) as total FROM `patient` WHERE `year` =  '$year' && `status` = 'Registered' && `barangay` = 'Alijis'") or die(mysqli_error());
                                                        $fetch3 = $alijis->fetch_array();

                                                        $banago = $conn->query("SELECT COUNT(*) as total FROM `patient` WHERE `year` =  '$year' && `status` = 'Registered' && `barangay` = 'Banago'") or die(mysqli_error());
                                                        $fetch4 = $banago->fetch_array();

                                                        $bata = $conn->query("SELECT COUNT(*) as total FROM `patient` WHERE `year` =  '$year' && `status` = 'Registered' && `barangay` = 'Bata'") or die(mysqli_error());
                                                        $fetch5 = $bata->fetch_array();

                                                        $cabug = $conn->query("SELECT COUNT(*) as total FROM `patient` WHERE `year` =  '$year' && `status` = 'Registered' && `barangay` = 'Cabug'") or die(mysqli_error());
                                                        $fetch6 = $cabug->fetch_array();

                                                        $estefania = $conn->query("SELECT COUNT(*) as total FROM `patient` WHERE `year` =  '$year' && `status` = 'Registered' && `barangay` = 'Estefania'") or die(mysqli_error());
                                                        $fetch7 = $estefania->fetch_array();

                                                        $felisa = $conn->query("SELECT COUNT(*) as total FROM `patient` WHERE `year` =  '$year' && `status` = 'Registered' && `barangay` = 'Felisa'") or die(mysqli_error());
                                                        $fetch8 = $felisa->fetch_array();

                                                        $granada = $conn->query("SELECT COUNT(*) as total FROM `patient` WHERE `year` =  '$year' && `status` = 'Registered' && `barangay` = 'Granada'") or die(mysqli_error());
                                                        $fetch9 = $granada->fetch_array();

                                                        $handumanan = $conn->query("SELECT COUNT(*) as total FROM `patient` WHERE `year` =  '$year' && `status` = 'Registered' && `barangay` = 'Handumanan'") or die(mysqli_error());
                                                        $fetch10 = $handumanan->fetch_array();

                                                        $lopezjaena = $conn->query("SELECT COUNT(*) as total FROM `patient` WHERE `year` =  '$year' && `status` = 'Registered' && `barangay` = 'Lopez Jaena'") or die(mysqli_error());
                                                        $fetch11 = $lopezjaena->fetch_array();

                                                        $mabini = $conn->query("SELECT COUNT(*) as total FROM `patient` WHERE `year` =  '$year' && `status` = 'Registered' && `barangay` = 'Mabini'") or die(mysqli_error());
                                                        $fetch12 = $mabini->fetch_array();

                                                        $mandalagan = $conn->query("SELECT COUNT(*) as total FROM `patient` WHERE `year` =  '$year' && `status` = 'Registered' && `barangay` = 'Mandalagan'") or die(mysqli_error());
                                                        $fetch13 = $mandalagan->fetch_array();

                                                        $mansilingan = $conn->query("SELECT COUNT(*) as total FROM `patient` WHERE `year` =  '$year' && `status` = 'Registered' && `barangay` = 'Mansilingan'") or die(mysqli_error());
                                                        $fetch14 = $mansilingan->fetch_array();

                                                        $montevista = $conn->query("SELECT COUNT(*) as total FROM `patient` WHERE `year` =  '$year' && `status` = 'Registered' && `barangay` = 'Montevista'") or die(mysqli_error());
                                                        $fetch15 = $montevista->fetch_array();

                                                        $pahanocoy = $conn->query("SELECT COUNT(*) as total FROM `patient` WHERE `year` =  '$year' && `status` = 'Registered' && `barangay` = 'Pahanocoy'") or die(mysqli_error());
                                                        $fetch16 = $pahanocoy->fetch_array();

                                                        $ptataytay= $conn->query("SELECT COUNT(*) as total FROM `patient` WHERE `year` =  '$year' && `status` = 'Registered' && `barangay` = 'Punta Taytay'") or die(mysqli_error());
                                                        $fetch17 = $ptataytay->fetch_array();

                                                        $singcang = $conn->query("SELECT COUNT(*) as total FROM `patient` WHERE `year` =  '$year' && `status` = 'Registered' && `barangay` = 'Singcang'") or die(mysqli_error());
                                                        $fetch18 = $singcang->fetch_array();

                                                        $sumag = $conn->query("SELECT COUNT(*) as total FROM `patient` WHERE `year` =  '$year' && `status` = 'Registered' && `barangay` = 'Sumag'") or die(mysqli_error());
                                                        $fetch19 = $sumag->fetch_array();

                                                        $taculing = $conn->query("SELECT COUNT(*) as total FROM `patient` WHERE `year` =  '$year' && `status` = 'Registered' && `barangay` = 'Taculing'") or die(mysqli_error());
                                                        $fetch20 = $taculing->fetch_array();

                                                        $tangub = $conn->query("SELECT COUNT(*) as total FROM `patient` WHERE `year` =  '$year' && `status` = 'Registered' && `barangay` = 'Tangub'") or die(mysqli_error());
                                                        $fetch21 = $tangub->fetch_array();

                                                        $villaesperanza = $conn->query("SELECT COUNT(*) as total FROM `patient` WHERE `year` =  '$year' && `status` = 'Registered' && `barangay` = 'Villa Esperanza'") or die(mysqli_error());
                                                        $fetch22 = $villaesperanza->fetch_array();

                                                        $villamonte = $conn->query("SELECT COUNT(*) as total FROM `patient` WHERE `year` =  '$year' && `status` = 'Registered' && `barangay` = 'Villamonte'") or die(mysqli_error());
                                                        $fetch23 = $villamonte->fetch_array();

                                                        $vistaalegre = $conn->query("SELECT COUNT(*) as total FROM `patient` WHERE `year` =  '$year' && `status` = 'Registered' && `barangay` = 'Vista Alegre'") or die(mysqli_error());
                                                        $fetch24 = $vistaalegre->fetch_array();

                                                        ?>
                                                        <tr>
                                                            <td>Barangay Abcasa</td>
                                                            <td><center><strong><?php echo $fetch1['total']?></strong></center></td>
                                                        </tr>
                                                        <tr>
                                                            <td>Barangay Alangilan</td>
                                                            <td><center><strong><?php echo $fetch2['total']?></strong></center></td>
                                                        </tr>
                                                        <tr>
                                                            <td>Barangay Alijis</td>
                                                            <td><center><strong><?php echo $fetch3['total']?></strong></center></td>
                                                        </tr>
                                                        <tr>
                                                            <td>Barangay Banago</td>
                                                            <td><center><strong><?php echo $fetch4['total']?></strong></center></td>
                                                        </tr>
                                                        <tr>
                                                            <td>Barangay Bata</td>
                                                            <td><center><strong><?php echo $fetch5['total']?></strong></center></td>
                                                        </tr>
                                                        <tr>
                                                            <td>Barangay Cabug</td>
                                                            <td><center><strong><?php echo $fetch6['total']?></strong></center></td>
                                                        </tr>
                                                        <tr>
                                                            <td>Barangay Estefania</td>
                                                            <td><center><strong><?php echo $fetch7['total']?></strong></center></td>
                                                        </tr>
                                                        <tr>
                                                            <td>Barangay Felisa</td>
                                                            <td><center><strong><?php echo $fetch8['total']?></strong></center></td>
                                                        </tr>
                                                        <tr>
                                                            <td>Barangay Granda</td>
                                                            <td><center><strong><?php echo $fetch9['total']?></strong></center></td>
                                                        </tr>
                                                        <tr>
                                                            <td>Barangay Handumanan</td>
                                                            <td><center><strong><?php echo $fetch10['total']?></strong></center></td>
                                                        </tr>
                                                        <tr>
                                                            <td>Barangay Lopez Jaena</td>
                                                            <td><center><strong><?php echo $fetch11['total']?></strong></center></td>
                                                        </tr>
                                                        <tr>
                                                            <td>Barangay Mabini</td>
                                                            <td><center><strong><?php echo $fetch12['total']?></strong></center></td>
                                                        </tr>
                                                        <tr>
                                                            <td>Barangay Mandalagan</td>
                                                            <td><center><strong><?php echo $fetch13['total']?></strong></center></td>
                                                        </tr>
                                                        <tr>
                                                            <td>Barangay Mansilingan</td>
                                                            <td><center><strong><?php echo $fetch14['total']?></strong></center></td>
                                                        </tr>

                                                        <tr>
                                                            <td>Barangay Montevista</td>
                                                            <td><center><strong><?php echo $fetch15['total']?></strong></center></td>
                                                        </tr>
                                                        <tr>
                                                            <td>Barangay Pahanocoy</td>
                                                            <td><center><strong><?php echo $fetch16['total']?></strong></center></td>
                                                        </tr>
                                                        <tr>
                                                            <td>Barangay Punta Taytay</td>
                                                            <td><center><strong><?php echo $fetch17['total']?></strong></center></td>
                                                        </tr>
                                                        <tr>
                                                            <td>Barangay Singcang</td>
                                                            <td><center><strong><?php echo $fetch18['total']?></strong></center></td>
                                                        </tr>
                                                        <tr>
                                                            <td>Barangay Sum-ag</td>
                                                            <td><center><strong><?php echo $fetch19['total']?></strong></center></td>
                                                        </tr>
                                                        <tr>
                                                            <td>Barangay Taculing</td>
                                                            <td><center><strong><?php echo $fetch20['total']?></strong></center></td>
                                                        </tr>
                                                        <tr>
                                                            <td>Barangay Tangub</td>
                                                            <td><center><strong><?php echo $fetch21['total']?></strong></center></td>
                                                        </tr>
                                                        <tr>
                                                            <td>Barangay Villa Esperanza</td>
                                                            <td><center><strong><?php echo $fetch22['total']?></strong></center></td>
                                                        </tr>
                                                        <tr>
                                                            <td>Barangay Villamonte</td>
                                                            <td><center><strong><?php echo $fetch23['total']?></strong></center></td>
                                                        </tr>
                                                        <tr>
                                                            <td>Barangay Vista Alegre</td>
                                                            <td><center><strong><?php echo $fetch24['total']?></strong></center></td>
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
                    window.location = 'reports_barangay_population.php?year='+year;
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