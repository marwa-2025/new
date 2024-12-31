<?php
ob_start();
require_once('../config.php');

// تحقق من وجود استعلام logout
if (isset($_GET['logout']) && $_GET['logout'] == 'true') {
    // قم بتسجيل الخروج باستخدام دالة logout
    $user->logout();
    
    // إعادة توجيه المستخدم إلى صفحة login.php
    header("Location: login.php");
    exit;
}
ob_end_flush();
?>
