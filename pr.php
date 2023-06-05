
<script src="//netdna.bootstrapcdn.com/bootstrap/3.0.0/js/bootstrap.min.js"></script>
<script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
<!------ Include the above in your HEAD tag ---------->

                                               
                                               <?php
                                                     $query1= mysqli_query($mysqli,"SELECT * FROM `adherants` WHERE Matricule=".$_GET['id']);
                                                      //$arr1 = mysqli_fetch_array($query1);
                                                      $i=1;
                                                                 //var_dump($arr1->Matricule);
                                                     while($row = mysqli_fetch_array($query1))
                                                     { $rows[] = $row;
                                                         //var_dump($rows);
                                                                           

                                                  ?>
<div class="container">
    <div class="row">
        <div class="col-xs-9" >
            <div class="well well-sm">
                <div class="row">
                    <div class="col-sm-6 col-md-4">
                        <img src="<?php echo $row['photo']; if (!isset($row['photo'])) echo "images/avatar/default.png";  ?>" alt="" class="img-rounded img-responsive" style="width:500;height:250" />
                    </div>
                    <div class="col-sm-6 col-md-8">
                        <h3>
                            <?php echo $row['Nom_PrenomFR']; if(isset($row['Nom_PrenomAR'])) echo ' ( '.$row['Nom_PrenomAR'].' )';  ?> </h3>
                           <?php if(isset($row['Pseudonyme'])) echo '<p>'.$row['Pseudonyme'].'</p>';?>
                        <i class="fa fa-map-marker">  
                        </i><?php echo ' '.$row['Adresse_postale'].' ';if (!isset($row['Adresse_postale'])) echo "Non disponible";?>
                        <p>
                            <i class="fa fa-envelope"></i><?php echo' '.$row['Email'];if (!isset($row['Email'])) echo "Non disponible";?>
                            <br />
                            <i class="fa fa-phone"></i><?php echo ' '.$row['Telephone'];if (!isset($row['Telephone'])) echo "Non disponible";?>
                            <br />
                            <i class="fa fa-gift"></i><?php echo ' '.$row['Date_de_naissance']; if (isset($row['Date_de_deces'])) echo ' - '.$row['Date_de_deces']?>
                            </br >
                            <i class="fa fa-user"></i><?php echo ' '.$row['CIN'];if (!isset($row['CIN'])) echo "Non disponible";?>
                            <br />
                            <i class="fa fa-euro"></i><?php echo ' '.$row['RIB'];if (!isset($row['RIB'])) echo "Non disponible";?>
                            <br />

                       </p> <?php } ?>
                        <!-- Split button -->
                        
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
