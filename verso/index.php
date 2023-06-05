
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
	<canvas id="barcode"></canvas>
	<br><br><br>
<iframe src="otdav.pdf" id="myFrame" frameborder="0" width="300" height="300" style="display:none;"></iframe>
<input type="button" id="bt" onclick="print()" value="Print PDF" />
<canvas id="myCanvas" width="200" height="100" >
<canvas id="myCanvas2" width="200" height="100" >
<canvas id="myCanvas3" width="200" height="100" >
<canvas id="myCanvas4" width="200" height="100" >
<canvas id="myCanvas5" width="200" height="100" >
<canvas id="myCanvas6" width="200" height="100" >

<script>
    function print() {
        var objFra = document.getElementById('myFrame');
        objFra.contentWindow.focus();
        objFra.contentWindow.print();
    }
</script>
 <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/1.3.4/jspdf.min.js" integrity="sha256-vIL0pZJsOKSz76KKVCyLxzkOT00vXs+Qz4fYRVMoDhw="crossorigin="anonymous"></script>
  <script src="./JsBarcode.all.min.js"></script>
<script>
	 var string = "بطاقة منخرط";
	 string.split("").reverse().join("").split(" ").reverse().join(" ")
	 var c = document.getElementById("myCanvas");
	 var ctx = c.getContext("2d");
	 ctx.font = "30px Arial";
	 ctx.fillText(string,10,50);

	 var string2 = "CARTE ADHÉRENT";
	 string2.split("").reverse().join("").split(" ").reverse().join(" ")
	 var c2 = document.getElementById("myCanvas2");
	 var ctx2 = c2.getContext("2d");
	 ctx2.font = "20px Arial";
	 ctx2.fillText(string2,10,50);

	 var string3 = "تاريخ الاصدار";
	 string3.split("").reverse().join("").split(" ").reverse().join(" ")
	 var c3 = document.getElementById("myCanvas3");
	 var ctx3 = c3.getContext("2d");
	 ctx3.font = "15px Arial";
	 ctx3.fillText(string3,10,50);

	 var string4 = "هام جدا : هذه البطاقة شخصية و الا يمكن";
	 string4.split("").reverse().join("").split(" ").reverse().join(" ")
	 var c4 = document.getElementById("myCanvas4");
	 var ctx4 = c4.getContext("2d");
	 ctx4.font = "13px Arial";
	 ctx4.fillText(string4,10,50);

	 var string5 = "استعمالها من قبل صاحبها ";
	 string5.split("").reverse().join("").split(" ").reverse().join(" ")
	 var c5 = document.getElementById("myCanvas5");
	 var ctx5 = c5.getContext("2d");
	 ctx5.font = "13px Arial";
	 ctx5.fillText(string5,10,50);

	 var string6 = "و هي صالحة لثلاثة (3)سنوات";
	 string6.split("").reverse().join("").split(" ").reverse().join(" ")
	 var c6 = document.getElementById("myCanvas6");
	 var ctx6 = c6.getContext("2d");
	 ctx6.font = "13px Arial";
	 ctx6.fillText(string6,10,50);


	 
</script>
<script  charset="utf-8" type="text/javascript">
	JsBarcode("#barcode", "Dep 3 7089",{
		displayValue:false,
		width:1
	});

		
	  // init the jsPDF library
	  const pdf = new jsPDF('l', 'mm', [120 , 70]);
	  // actual PDF options
	  function printPDF(ff,kk) {

		   pdf.setFont("helvetica");
		   pdf.setFontType("bold");
		   pdf.setFontSize(11);
		   var today = new Date();
			 var dd = String(today.getDate()).padStart(2, '0');
			 var mm = String(today.getMonth() + 1).padStart(2, '0'); //January is 0!
			 var yyyy = today.getFullYear();
			 today = mm + '/' + dd + '/' + yyyy;
		   var imaaage="data:image/png;base64,"+ff;
		   var imaaage2="data:image/png;base64,"+kk;
		   //pdf.text(20 ,20 ,"ﻣﺮﺣﺒﺎ", { maxWidth: 250, align: "right", lang: 'ar' })
		   pdf.addImage(imaaage, 'PNG', 42, 17, 38, 26);
		   pdf.addImage(imaaage2, 'PNG', 0, 52, 119, 9);
		   pdf.addImage(ctx3.canvas.toDataURL(), 'JPEG', 65, 37,40, 20);
		   pdf.text(42, 47, today);
		   pdf.text(10, 58, `CODE A BARRE`);
		   pdf.addImage(ctx.canvas.toDataURL(), 'JPEG', 45, 0,40, 20);
		   pdf.addImage(ctx2.canvas.toDataURL(), 'JPEG', 40, 5,40, 20);
		   pdf.addImage(ctx4.canvas.toDataURL(), 'JPEG', 67, 57,40, 20);
		   pdf.addImage(ctx5.canvas.toDataURL(), 'JPEG', 45, 57,40, 20);
		   pdf.addImage(ctx6.canvas.toDataURL(), 'JPEG', 17, 57,40, 20);
		   pdf.addImage(ctx6.canvas.toDataURL(), 'JPEG', 17, 57,40, 20);
		   pdf.addImage(barcode, 'JPEG', 60, 53,40, 7);
		   //pdf.save("otdav");
		   pdf.autoPrint();
			 window.open(pdf.output('bloburl'), '_blank');
	  }
</script>
<?php
	 $homepage = file_get_contents('./logo.png');
	 $ty= base64_encode($homepage);
	 $homepage2 = file_get_contents('./cadre.png');
	 $ty2= base64_encode($homepage2);
	 echo "<script type='text/javascript'>",
	      "printPDF('$ty','$ty2');",
	      "</script>";
 ?> 
</body>
</html>