<script src="https://code.jquery.com/jquery-1.12.4.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/1.3.3/jspdf.min.js"></script>
<script src="https://html2canvas.hertzen.com/dist/html2canvas.js"></script>
<canvas id="myCanvas"></canvas>

<?php >
echo "
<script>
var ctx=document.getElementById("myCanvas").getContext("2d");
ctx.font="12px Arial";
ctx.fillText('123');

var pdf=jsPDF('l','mm',[120,70]);
var image='data:image/png;base64,demandeAR';
pdf.addImage(image,'PDF',0,0,100,200);
pdf.addImage(ctx.convas.toDataURL(),'JPEG',0,0,100,100);
pdf.save('test');
</script>"
?>
