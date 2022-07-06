<script>
var tiempo;
function ini() {
  tiempo = setTimeout('location="<?php echo SERVERURL; ?>php/signin_out/signinout.php"',14400000); // 4 horas
}

function parar() {
  clearTimeout(tiempo);
  tiempo = setTimeout('location="<?php echo SERVERURL; ?>php/signin_out/signinout.php"',14400000); // 4 horas
}

</script>