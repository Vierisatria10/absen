<?php
session_start();

$_SESSION['id_user']='';
$_SESSION['username']='';
$_SESSION['nama']='';
$_SESSION['email']='';

unset($_SESSION['id_user']);
unset($_SESSION['username']);
unset($_SESSION['nama']);
unset($_SESSION['email']);

session_unset();
session_destroy();
echo '<script type="text/javascript">alert("Anda Berhasil Logout"); window.location.href="login.php"</script>'; 


?>