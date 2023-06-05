<script src="https://code.jquery.com/jquery-1.12.4.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/1.3.3/jspdf.min.js"></script>
<script src="https://html2canvas.hertzen.com/dist/html2canvas.js"></script>
<canvas id="myCanvas"></canvas>
<iframe id="frame"></iframe>

<?php 
$homepage = file_get_contents('./pdf/demandeAR.jpeg');
$ty= base64_encode($homepage);
echo "
<script type='text/javascript'>


var pdf=jsPDF('l','px',[450,450]);
var img='data:image/jpeg;base64,'+'$ty';
pdf.addImage(img, 'JPEG', 0, 0,450,450);


var ctx=document.getElementById('myCanvas').getContext('2d');
var canvas = document.getElementById('myCanvas');
ctx.font='16px Arial';

ctx.fillText('".date('Y-m-d')."',10,20);
var imgData=canvas.toDataURL('image/png',1.0);
pdf.addImage(imgData,'PNG',285,67);

ctx.clearRect(0,0,canvas.width,canvas.height);
ctx.fillText('name',10,20);
var imgData=canvas.toDataURL('image/png',1.0);
pdf.addImage(imgData,'PNG',250,205);

ctx.clearRect(0,0,canvas.width,canvas.height);
ctx.fillText('date_dp',10,20);
var imgData=canvas.toDataURL('image/png',1.0);
pdf.addImage(imgData,'PNG',80,205);

ctx.clearRect(0,0,canvas.width,canvas.height);
ctx.fillText('nbr_dp',10,20);
var imgData=canvas.toDataURL('image/png',1.0);
pdf.addImage(imgData,'PNG',270,215);

ctx.clearRect(0,0,canvas.width,canvas.height);
ctx.fillText('titre_ov',10,20);
var imgData=canvas.toDataURL('image/png',1.0);
pdf.addImage(imgData,'PNG',290,225);

ctx.clearRect(0,0,canvas.width,canvas.height);
ctx.fillText('desc',10,20);
var imgData=canvas.toDataURL('image/png',1.0);
pdf.addImage(imgData,'PNG',290,245);

ctx.clearRect(0,0,canvas.width,canvas.height);
ctx.fillText('auteur',10,20);
var imgData=canvas.toDataURL('image/png',1.0);
pdf.addImage(imgData,'PNG',110,255);

ctx.clearRect(0,0,canvas.width,canvas.height);
ctx.fillText('supp',10,20);
var imgData=canvas.toDataURL('image/png',1.0);
pdf.addImage(imgData,'PNG',100,275);

ctx.clearRect(0,0,canvas.width,canvas.height);
ctx.fillText('to',10,20);
var imgData=canvas.toDataURL('image/png',1.0);
pdf.addImage(imgData,'PNG',80,295);

ctx.clearRect(0,0,canvas.width,canvas.height);
ctx.fillText('from',10,20);
var imgData=canvas.toDataURL('image/png',1.0);
pdf.addImage(imgData,'PNG',180,295);








var iframe=document.getElementById('frame');

iframe.src=pdf.output('url');
pdf.autoPrint();
</script>";
?>
