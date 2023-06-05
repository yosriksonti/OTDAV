<?php
define('QUADODO_IN_SYSTEM', true);
require_once('check.php');
require_once('includes/header.php');
include_once("config.php");
if($_SERVER['REQUEST_METHOD'] == 'POST')
{
        $mat = $_GET['id'];
        $namefr = mysqli_real_escape_string($mysqli, $_POST['namefr']);
        $namear = mysqli_real_escape_string($mysqli, $_POST['namear']);
        $pseudo = mysqli_real_escape_string($mysqli, $_POST['pseudo']);
    $cin = mysqli_real_escape_string($mysqli, $_POST['cin']);
    $email = mysqli_real_escape_string($mysqli, $_POST['email']);
    $phonenumber = mysqli_real_escape_string($mysqli, $_POST['mobile']);
    $bd = mysqli_real_escape_string($mysqli, $_POST['bd']);
    $adress = mysqli_real_escape_string($mysqli, $_POST['adresse']);    
    $cotisdate = mysqli_real_escape_string($mysqli, $_POST['cotis']);    
    $RIB = mysqli_real_escape_string($mysqli, $_POST['rib']);     
    $dated = mysqli_real_escape_string($mysqli, $_POST['dated']);
    $obs = mysqli_real_escape_string($mysqli, $_POST['obs']);
    $result = mysqli_query($mysqli,"SELECT photo FROM adherants where Matricule='$mat");
    foreach($result as $row)
    $file_name=$row['photo'];
    unlink($file_name);
    if(isset($_FILES['image'])){
      $errors= array();
      $file_name = $_FILES['image']['name'];
      $file_size =$_FILES['image']['size'];
      $file_tmp =$_FILES['image']['tmp_name'];
      $file_type=$_FILES['image']['type'];
      $file_ext=strtolower(end(explode('.',$_FILES['image']['name'])));
      
      $extensions= array("jpeg","jpg","png");
      
      if(in_array($file_ext,$extensions)=== false){
         $errors[]="extension not allowed, please choose a JPEG or PNG file.";
      }
      
      if($file_size > 2097152){
         $errors[]='File size must be excately 2 MB';
      }
      
      if(empty($errors)==true){
         move_uploaded_file($file_tmp,"images/".$file_name);
         echo "Success";
      }else{
         print_r($errors);
      }
      $file_name="images/".$file_name;
   }
    
    $result = mysqli_query($mysqli, "UPDATE Adherants SET Nom_PrenomFR='$namefr',Nom_PrenomAR='$namear',Pseudonyme='$pseudo', Date_de_naissance='$bd',Date_de_deces='$dated', CIN='$cin', Cotisation='$cotisdate',Telephone='$phonenumber',Adresse_postale='$adress',RIB='$RIB',Email='$email',Observations='$obs',photo='$file_name' WHERE Matricule= '$mat'");
    header('Location: users.php');
        if(!$result){
            echo("Error description: " . mysqli_error($mysqli));
        }

}

?>
<!doctype html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7" lang=""> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8" lang=""> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9" lang=""> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js" lang=""> <!--<![endif]-->
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>OTDAV - Dashboard</title>
    <meta name="description" content="OTDAV - Dashboard">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="apple-touch-icon" href="https://flutter.tn/wp-content/uploads/2019/07/cropped-otdav-180x180.png">
    <link rel="shortcut icon" href="https://flutter.tn/wp-content/uploads/2019/07/cropped-otdav-180x180.png">

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/normalize.css@8.0.0/normalize.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.1.3/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/font-awesome@4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/gh/lykmapipo/themify-icons@0.1.2/css/themify-icons.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/pixeden-stroke-7-icon@1.2.3/pe-icon-7-stroke/dist/pe-icon-7-stroke.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/flag-icon-css/3.2.0/css/flag-icon.min.css">
    <link rel="stylesheet" href="assets/css/cs-skin-elastic.css">
    <link rel="stylesheet" href="assets/css/style.css">
    <!-- <script type="text/javascript" src="https://cdn.jsdelivr.net/html5shiv/3.7.3/html5shiv.min.js"></script> -->
    <link href="https://cdn.jsdelivr.net/npm/chartist@0.11.0/dist/chartist.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/jqvmap@1.5.1/dist/jqvmap.min.css" rel="stylesheet">

    <link href="https://cdn.jsdelivr.net/npm/weathericons@2.1.0/css/weather-icons.css" rel="stylesheet" />
    <link href="https://cdn.jsdelivr.net/npm/fullcalendar@3.9.0/dist/fullcalendar.min.css" rel="stylesheet" />

   <style>
    #weatherWidget .currentDesc {
        color: #ffffff!important;
    }
        .traffic-chart {
            min-height: 335px;
        }
        #flotPie1  {
            height: 150px;
        }
        #flotPie1 td {
            padding:3px;
        }
        #flotPie1 table {
            top: 20px!important;
            right: -10px!important;
        }
        .chart-container {
            display: table;
            min-width: 270px ;
            text-align: left;
            padding-top: 10px;
            padding-bottom: 10px;
        }
        #flotLine5  {
             height: 105px;
        }

        #flotBarChart {
            height: 150px;
        }
        #cellPaiChart{
            height: 160px;
        }

    </style>
</head>

<body>
    
    <!-- Left Panel -->
   <?php require_once "include.php"; ?>

        <!-- /#header -->
        <!-- Content -->
        <div class="content">
            <!-- Animated -->
            <div class="animated fadeIn">
                <!-- Widgets  -->
               <div class="card">
                <?php
                $mat=$_GET['id'];
                 $query1= mysqli_query($mysqli,"SELECT * FROM `adherants` where Matricule='$mat'");

                                                     
                                                      //$arr1 = mysqli_fetch_array($query1);
                                                      $i=1;
                                                                 //var_dump($arr1->Matricule);
                                                     while($row = mysqli_fetch_array($query1))
                                                     { $rows[] = $row; ?>
                        <div class="card-header">Ajout d'adhérant</div>
                        <div class="card-body card-block">
                            <form action="" method="post" class="" enctype="multipart/form-data">
                                <small >(*) : Requis</small>
                                <div class="form-group">
                                    <div class="input-group">
                                        <input type="text" id="namefr" name="namefr" placeholder="Nom et prénom(FR) *" class="form-control" <?php echo'required';?> value="<?php echo $row['Nom_PrenomFR']; ?>">
                                        <div class="input-group-addon"><i class="fa fa-user"></i></div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="input-group">
                                        <input type="text" id="namear" name="namear" placeholder="Nom et prénom(AR)" class="form-control" value="<?php echo $row['Nom_PrenomAR']; ?>" >
                                        <div class="input-group-addon"><i class="fa fa-user"></i></div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="input-group">
                                        <input type="text" id="pseudo" name="pseudo" placeholder="Pseudonyme" class="form-control" value="<?php echo $row['Pseudonyme']; ?>" >
                                        <div class="input-group-addon"><i class="fa fa-user"></i></div>
                                    </div>
                                </div>
                                 <div class="form-group">
                                    <div class="input-group">
                                        <input type="number" id="cin" name="cin" placeholder="CIN *" class="form-control" <?php echo'required';?> minlength="8" maxlength="8" value="<?php echo $row['CIN']; ?>">
                                        <div class="input-group-addon"><i class="fa fa-asterisk"></i></div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="input-group">
                                        <input type="email" id="email" name="email" placeholder="Email *" class="form-control" <?php echo'required';?> value="<?php echo $row['Email']; ?>">
                                        <div class="input-group-addon"><i class="fa fa-envelope"></i></div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="input-group">
                                        <input type="tel" id="mobile" name="mobile" placeholder="Télephone *" class="form-control" <?php echo'required';?> value="<?php echo $row['Telephone']; ?>">
                                        <div class="input-group-addon"><i class="fa fa-phone"></i></div>
                                    </div>
                                </div>
                                <div class="form-group">
                                   
                                    <div class="input-group">
                                        <input type="date" id="bd" name="bd" placeholder="Date de naissance" class="form-control" <?php echo'required';?> value="<?php echo $row['Date_de_naissance']; ?>">
                                        <div class="input-group-addon"><i class="fa fa-calendar"></i></div>
                                        
                                    </div>
                                    <small class="form-text text-muted">Date naissance *</small>
                                </div>
                                <div class="form-group">
                                   
                                    <div class="input-group">
                                        <input type="date" id="bd" name="dated" placeholder="Date de deces" class="form-control" value="<?php echo $row['Date_de_deces']; ?>" >
                                        <div class="input-group-addon"><i class="fa fa-calendar"></i></div>
                                        
                                    </div>
                                    <small class="form-text text-muted">Date deces *</small>
                                </div>
                                <div class="form-group">
                                    <div class="input-group">
                                        <input type="text" id="adresse" name="adresse" placeholder="Adresse *" class="form-control" <?php echo'required';?> value="<?php echo $row['Adresse_postale']; ?>">
                                        <div class="input-group-addon"><i class="fa fa-home"></i></div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    
                                    <div class="input-group">
                                        <input type="text" id="cotis" name="cotis" placeholder="Cotisation" class="form-control" value="<?php echo $row['Cotisation']; ?>" >
                                        <div class="input-group-addon"><i class="fa fa-asterisk"></i></div>

                                    </div>
                                                                            
                                </div>
                                <div class="form-group">
                                    <div class="input-group">
                                        <input type="text" id="rib" name="rib" placeholder="RIB *" class="form-control" <?php echo'required';?> value="<?php echo $row['RIB']; ?>">
                                        <div class="input-group-addon"><i class="fa fa-asterisk"></i></div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="input-group">
                                        <input type="text" id="obs" name="obs" placeholder="Observations" class="form-control" value="<?php echo $row['Observations'];} ?>">
                                        <div class="input-group-addon"><i class="fa fa-pencil"></i></div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <small class="form-text text-muted">   Image ( max: 2 MB )</small>
                                    <div class="input-group">
                                        <input type="file" name="image" />
                                        <div class="input-group-addon"><i class="fa fa-user"></i></div>

                                    </div>

                                </div>
                               
                                <div class="form-actions form-group"><button type="submit" class="btn btn-secondary btn-sm">Submit</button></div>
                            </form>
                        </div>
                    </div>
            <!-- /#add-category -->
            </div>
            <!-- .animated -->
        </div>
        <!-- /.content -->
        <div class="clearfix"></div>
        <!-- Footer -->
        <footer class="site-footer">
            <div class="footer-inner bg-white">
                <div class="row">
                    <div class="col-sm-6">
                        Copyright &copy; 2019 OTDAV
                    </div>
                    
                </div>
            </div>
        </footer>
        <!-- /.site-footer -->
    </div>
    <!-- /#right-panel -->

    <!-- Scripts -->
    <script src="https://cdn.jsdelivr.net/npm/jquery@2.2.4/dist/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.4/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.1.3/dist/js/bootstrap.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/jquery-match-height@0.7.2/dist/jquery.matchHeight.min.js"></script>
    <script src="assets/js/main.js"></script>

    <!--  Chart js -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js@2.7.3/dist/Chart.bundle.min.js"></script>

    <!--Chartist Chart-->
    <script src="https://cdn.jsdelivr.net/npm/chartist@0.11.0/dist/chartist.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chartist-plugin-legend@0.6.2/chartist-plugin-legend.min.js"></script>

    <script src="https://cdn.jsdelivr.net/npm/jquery.flot@0.8.3/jquery.flot.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/flot-pie@1.0.0/src/jquery.flot.pie.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/flot-spline@0.0.1/js/jquery.flot.spline.min.js"></script>

    <script src="https://cdn.jsdelivr.net/npm/simpleweather@3.1.0/jquery.simpleWeather.min.js"></script>
    <script src="assets/js/init/weather-init.js"></script>

    <script src="https://cdn.jsdelivr.net/npm/moment@2.22.2/moment.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/fullcalendar@3.9.0/dist/fullcalendar.min.js"></script>
    <script src="assets/js/init/fullcalendar-init.js"></script>

        <script src="assets/js/lib/data-table/datatables.min.js"></script>
    <script src="assets/js/lib/data-table/dataTables.bootstrap.min.js"></script>
    <script src="assets/js/lib/data-table/dataTables.buttons.min.js"></script>
    <script src="assets/js/lib/data-table/buttons.bootstrap.min.js"></script>
    <script src="assets/js/lib/data-table/jszip.min.js"></script>
    <script src="assets/js/lib/data-table/vfs_fonts.js"></script>
    <script src="assets/js/lib/data-table/buttons.html5.min.js"></script>
    <script src="assets/js/lib/data-table/buttons.print.min.js"></script>
    <script src="assets/js/lib/data-table/buttons.colVis.min.js"></script>
    <script src="assets/js/init/datatables-init.js"></script>


    <script type="text/javascript">
        $(document).ready(function() {
          $('#bootstrap-data-table-export').DataTable(  {responsive: true});
      } );

  </script>

    <!--Local Stuff-->
    <script>
        jQuery(document).ready(function($) {
            "use strict";

            // Pie chart flotPie1
            var piedata = [
                { label: "Desktop visits", data: [[1,32]], color: '#5c6bc0'},
                { label: "Tab visits", data: [[1,33]], color: '#ef5350'},
                { label: "Mobile visits", data: [[1,35]], color: '#66bb6a'}
            ];

            $.plot('#flotPie1', piedata, {
                series: {
                    pie: {
                        show: true,
                        radius: 1,
                        innerRadius: 0.65,
                        label: {
                            show: true,
                            radius: 2/3,
                            threshold: 1
                        },
                        stroke: {
                            width: 0
                        }
                    }
                },
                grid: {
                    hoverable: true,
                    clickable: true
                }
            });
            // Pie chart flotPie1  End
            // cellPaiChart
            var cellPaiChart = [
                { label: "Direct Sell", data: [[1,65]], color: '#5b83de'},
                { label: "Channel Sell", data: [[1,35]], color: '#00bfa5'}
            ];
            $.plot('#cellPaiChart', cellPaiChart, {
                series: {
                    pie: {
                        show: true,
                        stroke: {
                            width: 0
                        }
                    }
                },
                legend: {
                    show: false
                },grid: {
                    hoverable: true,
                    clickable: true
                }

            });
            // cellPaiChart End
            // Line Chart  #flotLine5
            var newCust = [[0, 3], [1, 5], [2,4], [3, 7], [4, 9], [5, 3], [6, 6], [7, 4], [8, 10]];

            var plot = $.plot($('#flotLine5'),[{
                data: newCust,
                label: 'New Data Flow',
                color: '#fff'
            }],
            {
                series: {
                    lines: {
                        show: true,
                        lineColor: '#fff',
                        lineWidth: 2
                    },
                    points: {
                        show: true,
                        fill: true,
                        fillColor: "#ffffff",
                        symbol: "circle",
                        radius: 3
                    },
                    shadowSize: 0
                },
                points: {
                    show: true,
                },
                legend: {
                    show: false
                },
                grid: {
                    show: false
                }
            });
            // Line Chart  #flotLine5 End
            // Traffic Chart using chartist
            if ($('#traffic-chart').length) {
                var chart = new Chartist.Line('#traffic-chart', {
                  labels: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun'],
                  series: [
                  [0, 18000, 35000,  25000,  22000,  0],
                  [0, 33000, 15000,  20000,  15000,  300],
                  [0, 15000, 28000,  15000,  30000,  5000]
                  ]
              }, {
                  low: 0,
                  showArea: true,
                  showLine: false,
                  showPoint: false,
                  fullWidth: true,
                  axisX: {
                    showGrid: true
                }
            });

                chart.on('draw', function(data) {
                    if(data.type === 'line' || data.type === 'area') {
                        data.element.animate({
                            d: {
                                begin: 2000 * data.index,
                                dur: 2000,
                                from: data.path.clone().scale(1, 0).translate(0, data.chartRect.height()).stringify(),
                                to: data.path.clone().stringify(),
                                easing: Chartist.Svg.Easing.easeOutQuint
                            }
                        });
                    }
                });
            }
            // Traffic Chart using chartist End
            //Traffic chart chart-js
            if ($('#TrafficChart').length) {
                var ctx = document.getElementById( "TrafficChart" );
                ctx.height = 150;
                var myChart = new Chart( ctx, {
                    type: 'line',
                    data: {
                        labels: [ "Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul" ],
                        datasets: [
                        {
                            label: "Visit",
                            borderColor: "rgba(4, 73, 203,.09)",
                            borderWidth: "1",
                            backgroundColor: "rgba(4, 73, 203,.5)",
                            data: [ 0, 2900, 5000, 3300, 6000, 3250, 0 ]
                        },
                        {
                            label: "Bounce",
                            borderColor: "rgba(245, 23, 66, 0.9)",
                            borderWidth: "1",
                            backgroundColor: "rgba(245, 23, 66,.5)",
                            pointHighlightStroke: "rgba(245, 23, 66,.5)",
                            data: [ 0, 4200, 4500, 1600, 4200, 1500, 4000 ]
                        },
                        {
                            label: "Targeted",
                            borderColor: "rgba(40, 169, 46, 0.9)",
                            borderWidth: "1",
                            backgroundColor: "rgba(40, 169, 46, .5)",
                            pointHighlightStroke: "rgba(40, 169, 46,.5)",
                            data: [1000, 5200, 3600, 2600, 4200, 5300, 0 ]
                        }
                        ]
                    },
                    options: {
                        responsive: true,
                        tooltips: {
                            mode: 'index',
                            intersect: false
                        },
                        hover: {
                            mode: 'nearest',
                            intersect: true
                        }

                    }
                } );
            }
            //Traffic chart chart-js  End
            // Bar Chart #flotBarChart
            $.plot("#flotBarChart", [{
                data: [[0, 18], [2, 8], [4, 5], [6, 13],[8,5], [10,7],[12,4], [14,6],[16,15], [18, 9],[20,17], [22,7],[24,4], [26,9],[28,11]],
                bars: {
                    show: true,
                    lineWidth: 0,
                    fillColor: '#ffffff8a'
                }
            }], {
                grid: {
                    show: false
                }
            });
            // Bar Chart #flotBarChart End
        });
    </script>
</body>
</html>
