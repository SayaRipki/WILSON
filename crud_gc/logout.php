<?php
// Mulai session
session_start();

// Hapus semua data sesi
session_unset();

// Hapus sesi dari server
session_destroy();

// Redirect ke halaman login
header("Location: login.php");
exit();
?>
