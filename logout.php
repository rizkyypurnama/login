<?php
session_start();

session_unset();

session_destroy();

echo "
<script>
alert('Kamu Berhasil Logout');
document.location.href = 'index.php';
</script>";

exit;

?>