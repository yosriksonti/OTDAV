<?php
    
    require_once('../check.php');
	define('QUADODO_IN_SYSTEM', true);
    require_once('../includes/header.php');
    include_once("../config.php");
    $userID=$qls->user_info['id'];
    $result = mysqli_query($mysqli, "SELECT * FROM ad_users WHERE id=$userID");
    $isAdmin=0;
    while($res = mysqli_fetch_array($result))
    {
        if($res['group_id']==1 )
            $isAdmin=1;
    }
			$id = $_GET['id'];
			$result = mysqli_query($mysqli, "SELECT * FROM adherants WHERE Matricule=$id");
            $res = mysqli_fetch_array($result);
            $imprime=$res['imprime'];
            if(($imprime=="0")&&($isAdmin!=1)||($isAdmin==1)){
                $ID = $res['Matricule'];
                $nom =$res['Nom_PrenomAR'];;
                $prenom = " ";
                $age = $res['Date_de_naissance'];
                $adresse = $res['Adresse_postale'];
                $CIN = $res['CIN'];
                $photo = $res['photo'];
                $email = $res['Email'];
                $tel = $res['Telephone'];
                $specialite='';
                $result2 = mysqli_query($mysqli, "SELECT * FROM adhesion WHERE Matricule=$id");
                $res2 = mysqli_fetch_array($result2);
                if($res2['Lit']==1)
                $specialite .=' اداب';
                
                if($res2['Comp']==1)
                $specialite .=' ملحن';
                
                if($res2['AutLyr']==1)
                $specialite .=' مؤلف';
                
                if($res2['Dram']==1)
                $specialite .=' دراما';
                
                if($res2['Plas']==1)
                $specialite .=' xxx';

?>

 <!DOCTYPE html>
<html lang="en">
	<head>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
	<meta charset="UTF-8">
	<title>Js-To-PDF</title>
	<style>
		body {
			padding: 40px;
		}
		button {
		   padding: 12px 50px;
		   border: none;
		   background-color: rgb(91,234,208);
		   color: #333;
		   cursor: pointer;
		   display: inline-block;
		}
	  	input {
	  	padding: 12px 20px;
		}
	</style>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
	</head>
	<body>
		<canvas id="barcode" style="display:none;"></canvas>
		<iframe src="otdav.pdf" id="myFrame" frameborder="0" width="300" height="300" style="display:none;"></iframe>
		<canvas id="myCanvas" width="200" height="100" style="display:none;"></canvas>
		<canvas id="myCanvas2" width="200" height="100" style="display:none;"></canvas>
		<canvas id="myCanvas3" width="200" height="100" style="display:none;"></canvas>
		<canvas id="myCanvas4" width="200" height="100" style="display:none;"></canvas>
		<canvas id="myCanvas5" width="200" height="100" style="display:none;"></canvas>
		<canvas id="myCanvas6" width="200" height="100" style="display:none;"></canvas>
		<canvas id="myCanvas7" width="200" height="100" style="display:none;"></canvas>
		<canvas id="myCanvas8" width="200" height="100" style="display:none;"></canvas>
		<canvas id="myCanvas9" width="200" height="100" style="display:none;"></canvas>
		<canvas id="myCanvas10" width="200" height="100" style="display:none;"></canvas>
		<canvas id="myCanvas11" width="200" height="100" style="display:none;"></canvas>
		<canvas id="myCanvas12" width="200" height="100" style="display:none;"></canvas>
		<canvas id="myCanvas13" width="200" height="100" style="display:none;"></canvas>
		<canvas id="myCanvas14" width="200" height="100" style="display:none;"></canvas>
		<canvas id="myCanvas15" width="200" height="100" style="display:none;"></canvas>
		<canvas id="myCanvas16" width="200" height="100" style="display:none;"></canvas>
		<script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/1.3.4/jspdf.min.js" integrity="sha256-vIL0pZJsOKSz76KKVCyLxzkOT00vXs+Qz4fYRVMoDhw="crossorigin="anonymous"></script>
		<script src="./JsBarcode.all.min.js"></script>
		<script>
			 var string = "الجمهورية التونسية";
			 string.split("").reverse().join("").split(" ").reverse().join(" ")
			 var c = document.getElementById("myCanvas");
			 var ctx = c.getContext("2d");
			 ctx.font = "18px Arial";
			 //ctx.fillText(string,10,50);

			 var string2 = "وزارة الشؤون الثقافية";
			 string2.split("").reverse().join("").split(" ").reverse().join(" ")
			 var c2 = document.getElementById("myCanvas2");
			 var ctx2 = c2.getContext("2d");
			 ctx2.font = "13px Arial";
			 //ctx2.fillText(string2,10,50);

			 var string3 = "المؤسسة التونسية لحقوق المؤلف والحقوق المجاورة";
			 string3.split("").reverse().join("").split(" ").reverse().join(" ")
			 var c3 = document.getElementById("myCanvas3");
			 var ctx3 = c3.getContext("2d");
			 ctx3.font = "11px Arial";
			 //ctx3.fillText(string3,10,50);

			 var string4 = "بطاقة منخرط";
			 string4.split("").reverse().join("").split(" ").reverse().join(" ")
			 var c4 = document.getElementById("myCanvas4");
			 var ctx4 = c4.getContext("2d");
			 ctx4.font = "22px Arial Bold";

			 //ctx4.fillText(string4,10,50);

			 var string5 = ":العدد المميز";
			 string5.split("").reverse().join("").split(" ").reverse().join(" ")
			 var c5 = document.getElementById("myCanvas5");
			 var ctx5 = c5.getContext("2d");
			 ctx5.font = "17px Arial";
			 //ctx5.fillText(string5,10,50);

			 var string6 = ":الاسم و اللقب";
			 string6.split("").reverse().join("").split(" ").reverse().join(" ")
			 var c6 = document.getElementById("myCanvas6");
			 var ctx6 = c6.getContext("2d");
			 ctx6.font = "22px Arial";
			 //ctx6.fillText(string6,10,50);

			 var string7 = ":الصنف";
			 string7.split("").reverse().join("").split(" ").reverse().join(" ")
			 var c7 = document.getElementById("myCanvas7");
			 var ctx7 = c7.getContext("2d");
			 ctx7.font = "22px Arial";
			 //ctx7.fillText(string7,10,50);

			 var string8 = ":عدد بطاقة التعريف الوطنية";
			 string8.split("").reverse().join("").split(" ").reverse().join(" ")
			 var c8 = document.getElementById("myCanvas8");
			 var ctx8 = c8.getContext("2d");
			 ctx8.font = "21px Arial";
			 //ctx8.fillText(string8,10,50);

			 var string9 = "<?php echo $nom;?>";
			 string9.split("").reverse().join("").split(" ").reverse().join(" ")
			 var c9 = document.getElementById("myCanvas9");
			 var ctx9 = c9.getContext("2d");
			 ctx9.font = "21px Arial";
			ctx9.fillText(string9,15,49);

			var string10 = "<?php echo $specialite;?>";
			string10.split("").reverse().join("").split(" ").reverse().join(" ")
			var c10 = document.getElementById("myCanvas10");
			var ctx10 = c10.getContext("2d");
			ctx10.font = "21px Arial";
			ctx10.fillText(string10,10,50);	



					 var string11 = "بطاقة منخرط";
					 string11.split("").reverse().join("").split(" ").reverse().join(" ")
					 var c11 = document.getElementById("myCanvas11");
					 var ctx11 = c11.getContext("2d");
					 ctx11.font = "30px Arial";
					 //ctx11.fillText(string11,10,50);

					 var string12 = "CARTE ADHÉRENT";
					 string12.split("").reverse().join("").split(" ").reverse().join(" ")
					 var c12 = document.getElementById("myCanvas12");
					 var ctx12 = c12.getContext("2d");
					 ctx12.font = "20px Arial";
					 //ctx12.fillText(string12,10,50);

					 var string13 = "تاريخ الاصدار";
					 string13.split("").reverse().join("").split(" ").reverse().join(" ")
					 var c13 = document.getElementById("myCanvas13");
					 var ctx13 = c13.getContext("2d");
					 ctx13.font = "15px Arial";
					 //ctx13.fillText(string13,10,50);

					 var string14 = "هام جدا : هذه البطاقة شخصية و الا يمكن";
					 string14.split("").reverse().join("").split(" ").reverse().join(" ")
					 var c14 = document.getElementById("myCanvas14");
					 var ctx14 = c14.getContext("2d");
					 ctx14.font = "13px Arial";
					 //ctx14.fillText(string14,10,50);

					 var string15 = "استعمالها من قبل صاحبها ";
					 string5.split("").reverse().join("").split(" ").reverse().join(" ")
					 var c15 = document.getElementById("myCanvas15");
					 var ctx15 = c15.getContext("2d");
					 ctx15.font = "13px Arial";
					 //ctx15.fillText(string15,10,50);

					 var string16 = "و هي صالحة لثلاثة (3)سنوات";
					 string16.split("").reverse().join("").split(" ").reverse().join(" ")
					 var c16 = document.getElementById("myCanvas16");
					 var ctx16 = c16.getContext("2d");
					 ctx16.font = "13px Arial";
					 //ctx16.fillText(string16,10,50); 
		</script>
		<script  charset="utf-8" type="text/javascript">
			JsBarcode("#barcode", "<?php echo $ID;?>",{
				displayValue:false,
				width:1
			});
			  const pdf = new jsPDF('l', 'mm', [120 , 70]);
			  // actual PDF options
			  function printPDF(ff,kk,ll,ss,ui,uk) {
				   pdf.setFont("helvetica");
				   pdf.setFontType("bold");
				   pdf.setFontSize(11);
				   var imaaage="data:image/png;base64,"+ff;
				   var imaaage2="data:image/png;base64,"+kk;
				   var imaaage3="data:image/jpeg;base64,"+ll;
				   var imaaage4="data:image/png;base64,"+ss;
				   pdf.addImage(imaaage, 'PNG', 0, 0, 120, 70);
				   //pdf.addImage(imaaage2, 'PNG', 38, 25, 44, 9);
				   pdf.addImage(imaaage3, 'JPEG', 5, 10, 24, 29);
				   //pdf.addImage(imaaage4, 'PNG', 5, 27, 30, 10);
				   pdf.text(53, 32, "<?php echo $ID;?>");
				   pdf.addImage(ctx.canvas.toDataURL(), 'JPEG', 47.5, -5,40, 20);
				   pdf.addImage(ctx2.canvas.toDataURL(), 'JPEG', 49, -1.5,40, 20);
				   pdf.addImage(ctx3.canvas.toDataURL(), 'JPEG', 39.5, 1,40, 20);
				   pdf.addImage(ctx4.canvas.toDataURL(), 'JPEG', 47.5, 13,40, 20);
				   pdf.addImage(ctx5.canvas.toDataURL(), 'JPEG', 63, 21,40, 20);
				   pdf.addImage(ctx6.canvas.toDataURL(), 'JPEG', 87, 33.5,40, 20);
				   pdf.addImage(ctx7.canvas.toDataURL(), 'JPEG', 96, 42.7,40, 20);
				   pdf.addImage(ctx8.canvas.toDataURL(), 'JPEG', 70, 51.9,40, 20);
				   pdf.addImage(ctx9.canvas.toDataURL(), 'JPEG', 65, 31,40, 20);
				   pdf.addImage(ctx10.canvas.toDataURL(), 'JPEG', 65, 38,40, 20);
				   pdf.text(48, 56, "<?php echo $CIN;?>");
				   pdf.text(70, 64, "<?php echo date('Y-m-d');?>");
				   var idp=("<?php echo $ID;?>");
				   printed(idp);
				   pdf.save("<?php echo $ID;?>");
				   pdf.autoPrint();
				   window.open(pdf.output('bloburl'), '_blank');

				   //verso

				     


					 const pdf2 = new jsPDF('l', 'mm', [120 , 70]);

					   pdf2.setFont("helvetica");
					   pdf2.setFontType("bold");
					   pdf2.setFontSize(11);
					   var today = new Date();
						 var dd = String(today.getDate()).padStart(2, '0');
						 var mm = String(today.getMonth() + 1).padStart(2, '0'); //January is 0!
						 var yyyy = today.getFullYear();
						 today = mm + '/' + dd + '/' + yyyy;
					   var imaaage="data:image/png;base64,"+ui;
					   var imaaage2="data:image/png;base64,"+uk;
					   //pdf.text(20 ,20 ,"ﻣﺮﺣﺒﺎ", { maxWidth: 250, align: "right", lang: 'ar' })
					   pdf2.addImage(imaaage, 'PNG', 0, 0, 120, 70);
					   //pdf2.addImage(imaaage2, 'PNG', 0, 52, 119, 9);
					   pdf2.addImage(ctx3.canvas.toDataURL(), 'JPEG', 65, 37,40, 20);
					   //pdf2.text(42, 47, today);
					   //pdf2.text(10, 58, `CODE A BARRE`);
					   pdf2.addImage(ctx11.canvas.toDataURL(), 'JPEG', 45, 0,40, 20);
					   pdf2.addImage(ctx12.canvas.toDataURL(), 'JPEG', 40, 5,40, 20);
					   pdf2.addImage(ctx14.canvas.toDataURL(), 'JPEG', 67, 57,40, 20);
					   pdf2.addImage(ctx15.canvas.toDataURL(), 'JPEG', 45, 57,40, 20);
					   pdf2.addImage(ctx16.canvas.toDataURL(), 'JPEG', 17, 57,40, 20);
					   pdf2.addImage(barcode, 'JPEG', 30, 53,60, 10);
					   pdf.save("otdav");
					   pdf2.autoPrint();
						 window.open(pdf2.output('bloburl'), '_blank');
			  }
		</script>
		<script type="text/javascript">
			function printed(idp) {
				$.ajax({
				   	type: 'POST',
				    url:'affect.php',
				    data: { text1: idp },
				    complete: function (response) {
				        $('#output').html(response.responseText);
				    },
				    error: function () {
				        $('#output').html('Bummer: there was an error!');
				    }
				});
			return false;
		}
		</script>
		<?php
		    
		    $homepage = file_get_contents('./recto-01.png');
			$homepage2 = file_get_contents('./cadre2.png');
			$homepage4 = file_get_contents('./signature.png');
			$homepage5 = file_get_contents('./verso-01.png');
			$homepage6 = file_get_contents('./cadre.png');
			$ph='../'.$photo;
			$pic = file_get_contents($ph);
			$ty= base64_encode($homepage);
			$ty2= base64_encode($homepage2);
			$ty3= base64_encode($pic);
			$ty4= base64_encode($homepage4);
			$ty5= base64_encode($homepage5);
	 		$ty6= base64_encode($homepage6);
			echo "<script type='text/javascript'>","printPDF('$ty','$ty2','$ty3','$ty4','$ty5','$ty6');","</script>";
			$result = mysqli_query($mysqli, "UPDATE adherants SET imprime=1 WHERE Matricule=$id");
		?>
		<?php 
	       }
           else{
            echo "<script>alert('cette carte a était déjà imprimée, merci de consulter votre aministrateur');window.close();</script>";
           }
            echo '<a href="../users.php">Renter au Dashboard</a>';

			
    ?>
    </body>
  </html>