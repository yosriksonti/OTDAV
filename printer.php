<?php
	ob_start();
	session_start();
    require_once('includes/header.php');
	include_once("config.php");
	//if(isset($_SESSION['role'])=='administrator'||isset($_SESSION['role'])=='user')
	{
        /*
	    $query1= mysqli_query($mysqli,"SELECT * FROM `users` WHERE `userid`='".$_SESSION['userid']."'");
        $row=mysqli_fetch_array($query1);
        $role=$row['role'];
		$arr1 = mysqli_fetch_array($query1);
		$num1 = mysqli_num_rows($query1); 
        */
		$num1=1;
        //if($num1==1)
        {

            $id = $_GET['id'];

            $result = mysqli_query($mysqli,"SELECT * FROM adherents WHERE Matricule='$id'");
            ($res = mysqli_fetch_array($result));
            {
                
                
                    $ID = $res['Matricule'];
                    $nom = $res['Nom_PrenomFR'];
                    $prenom = $res['Nom_PrenomAR'];
                    //$age = $res['age'];
                    $age=2;
                    $adresse = $res['Adresse_postale'];
                    $CIN = $res['CIN'];
                    $photo = $res['photo'];
                    $email = $res['Email'];
                    $tel = $res['Telephone'];
                    //$specialite = $res['specialite'];
                    $specialite=" ";
                }
?>

  <!DOCTYPE html>
  <html lang="en">

    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
        <meta charset="UTF-8">
        <title>Impression <?php echo $nom;?></title>
        <style>
        body {
            padding: 40px;
        }        
        button {
            padding: 12px 50px;
            border: none;
            background-color: rgb(91, 234, 208);
            color: #333;
            cursor: pointer;
            display: inline-block;
        }
        input {
            padding: 12px 20px;
        }
        </style>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
        <script src="qrious.js"></script>

    </head>
    <body>
    		<canvas id="qr"  style="display:none;"></canvas>
        <canvas id="barcode" style="display:none;"></canvas>
        <iframe src="otdav.pdf" id="myFrame" frameborder="0" width="300" height="300" style="display:none;"></iframe>
        <canvas id="myCanvas9" width="400" height="200" style="display:none;"></canvas>
        <canvas id="myCanvas10" width="400" height="200" style="display:none;"></canvas>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/1.3.4/jspdf.min.js" integrity="sha256-vIL0pZJsOKSz76KKVCyLxzkOT00vXs+Qz4fYRVMoDhw=" crossorigin="anonymous"></script>
        <script src="./JsBarcode.all.min.js"></script>
        <script>
        	var qr = new QRious({
      element: document.getElementById('qr'),
      value: '<?php echo $CIN;?>'
})
        var string9 = "<?php echo $nom;?>";
        string9.split("").reverse().join("").split(" ").reverse().join(" ")
        var c9 = document.getElementById("myCanvas9");
        var ctx9 = c9.getContext("2d");
        ctx9.font = "50px Arial";
        ctx9.fillText(string9, 10, 50);

        var string10 = "<?php echo $specialite;?>";
        string10.split("").reverse().join("").split(" ").reverse().join(" ")
        var c10 = document.getElementById("myCanvas10");
        var ctx10 = c10.getContext("2d");
        ctx10.font = "50px Arial";
        ctx10.fillText(string10, 10, 50);

        var c11 = document.getElementById("qr");
        var ctx11 = c11.getContext("2d");
        //ctx11.fillRect(50,50,50,50);

				var img = new Image();
				img.src = c11.toDataURL();
        </script>
        <script charset="utf-8" type="text/javascript">
        JsBarcode("#barcode", "<?php echo $CIN;?>", {
            displayValue: false,
            width: 1
        });
        const pdf = new jsPDF('l', 'mm', [86, 54]);
        // actual PDF options
        function printPDF(ff, vv, kk, ll, ss, ui, uk, nn) {
            pdf.setFont("helvetica");
            pdf.setFontType("normal");
            pdf.setFontSize(7);
            var tjk=parseInt("<?php echo strlen($nom);?>");
            var tjk2=parseInt("<?php echo strlen($specialite);?>");
            console.log(tjk);
            var imaaage = "data:image/png;base64," + ff;
            var imaaage1 = "data:image/png;base64," + vv;
            var imaaage2 = "data:image/png;base64," + kk;
            var imaaage3 = "data:image/jpeg;base64," + ll;
            var imaaage4 = "data:image/png;base64," + ss;
            pdf.addImage(imaaage, 'PNG', 0, 0, 86, 54);
            pdf.addImage(imaaage3, 'JPEG', 3, 3, 18, 21);
            pdf.addImage(imaaage4, 'PNG', 5, 20, 20, 5);
            pdf.text(32, 26, "0000000<?php echo $ID;?>");
            pdf.setFontSize(9);
            var tjk3=57-(tjk/1.45);
            pdf.addImage(ctx9.canvas.toDataURL("image/png"), 'JPEG', tjk3, 31, 36, 16);
            tjk2=74.7-(tjk/1.95)-(tjk2/1.95);
            pdf.addImage(ctx10.canvas.toDataURL(), 'JPEG', tjk2, 36.5, 36, 16);
            pdf.text(33, 46, "<?php echo $CIN;?>");
            var idp = ("<?php echo $ID;?>");
            printed(idp);
            //pdf.save("<?php echo $ID;?>");
            pdf.autoPrint();
            window.open(pdf.output('bloburl'), '_blank');

            //verso
            const pdf2 = new jsPDF('l', 'mm', [86, 54]);
            pdf2.setFont("helvetica");
            pdf2.setFontType("bold");
            pdf2.setFontSize(8);
            var today = new Date()
            var dd = String(today.getDate()).padStart(2, '0');
            var mm = String(today.getMonth() + 1).padStart(2, '0'); //January is 0!
            var yyyy = today.getFullYear();
            today = mm + '/' + dd + '/' + yyyy;
            var imaaage3 = "data:image/png;base64," + nn;
            pdf2.addImage(imaaage3, 'PNG', 0, 0, 86, 54);
            pdf2.text(42.5, 44.5, today);
            pdf2.addImage(barcode, 'JPEG', 10.3, 41, 30, 5);
            pdf2.addImage(img, 'JPEG', 6, 6, 12, 12);
            //pdf.save("otdav");
            pdf2.autoPrint();
            window.open(pdf2.output('bloburl'), '_blank');
            window.close();
        }
        </script>
        <script type="text/javascript">
        function printed(idp) {
            $.ajax({
                type: 'POST',
                url: 'affect.php',
                data: {
                    text1: idp
                },
                complete: function(response) {
                    $('#output').html(response.responseText);
                },
                error: function() {
                    $('#output').html('Bummer: there was an error!');
                }
            });
            return false;
        }
        </script>
        <?php
		  $homepage = file_get_contents('./backgound19.png');
		  $homepage1 = file_get_contents('./ref.png');
			$homepage2 = file_get_contents('./cadre2.png');
			$homepage4 = file_get_contents('./signature.png');
			$homepage5 = file_get_contents('./logo.png');
			$homepage6 = file_get_contents('./cadre.png');
			$homepage7 = file_get_contents('./backgoundv7.png');
			$ty= base64_encode($homepage);
			$ty1= base64_encode($homepage1);
			$ty2= base64_encode($homepage2);
			$ty3= base64_encode($photo);
			$ty4= base64_encode($homepage4);
			$ty5= base64_encode($homepage5);
	 		$ty6= base64_encode($homepage6);
	 		$ty7= base64_encode($homepage7);
			echo "<script type='text/javascript'>","printPDF('$ty','$ty1','$ty2','$ty3','$ty4','$ty5','$ty6','$ty7');","</script>"; 
		?>
		<?php 
       /*else{
        echo "<script>alert('cette carte a était déjà imprimée, merci de consulter votre aministrateur');window.close();</script>";
       }*/
    }
	    //else
	    {
	      //header ("location:../login.php");
	    }
	    }    
			/*else
	      header ("location:../login.php");
          */
    ?>
    </body>
  </html>