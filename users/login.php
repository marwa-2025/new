<?php
ob_start(); // لمنع إرسال محتوى غير مقصود
$page_title = 'تسجيل دخول';

require_once('../config.php');
include('../inc/head.php');
include('../inc/header.php');
include('../inc/nav.php');
include('../inc/main.php');

// معالجة طلب تسجيل الدخول
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // استقبال البيانات من الفورم
    $email = trim($_POST['email']); // تنظيف البيانات
    $password = $_POST['password'];

    // التحقق من بيانات تسجيل الدخول
    if ($user->login($email, $password)) {
        // إعادة التوجيه إلى لوحة التحكم عند نجاح تسجيل الدخول
        header('Location: dashboard.php');
        exit;
    } else {
        $error_message = "البريد الإلكتروني أو كلمة المرور غير صحيح.";
    }
}
ob_end_flush();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>تسجيل دخول</title>
</head>
<body>
<main>
    <div class="container">
        <section class="section register min-vh-100 d-flex flex-column align-items-center justify-content-center py-4">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-lg-4 col-md-6 d-flex flex-column align-items-center justify-content-center">
                        <div class="d-flex justify-content-center py-4">
                            <a href="index.html" class="logo d-flex align-items-center w-auto">
                                <img src="assets/img/logo.png" alt="">
                                <span class="d-none d-lg-block">UniversityBoard</span>
                            </a>
                        </div>

                        <div class="card mb-3">
                            <div class="card-body">
                                <div class="pt-4 pb-2">
                                    <h5 class="card-title text-center pb-0 fs-4">تسجيل الدخول إلى حسابك</h5>
                                    <p class="text-center small">أدخل البريد الإلكتروني وكلمة المرور لتسجيل الدخول</p>
                                </div>

                                <!-- عرض رسالة الخطأ إن وجدت -->
                                <?php if (!empty($error_message)) : ?>
                                    <div class="alert alert-danger text-center">
                                        <?= htmlspecialchars($error_message) ?>
                                    </div>
                                <?php endif; ?>

                                <!-- نموذج تسجيل الدخول -->
                                <form action="" method="POST" class="row g-3 needs-validation" novalidate>
                                    <div class="col-12">
                                        <label for="email" class="form-label">البريد الإلكتروني</label>
                                        <div class="input-group has-validation">
                                            <input type="email" name="email" class="form-control" id="email" required>
                                            <div class="invalid-feedback">يرجى إدخال البريد الإلكتروني.</div>
                                        </div>
                                    </div>

                                    <div class="col-12">
                                        <label for="password" class="form-label">كلمة المرور</label>
                                        <input type="password" name="password" class="form-control" id="password" required>
                                        <div class="invalid-feedback">يرجى إدخال كلمة المرور.</div>
                                    </div>

                                    <div class="col-12">
                                        <button class="btn btn-primary w-100" type="submit">تسجيل الدخول</button>
                                    </div>
                                </form>
                            </div>
                        </div>

                        <div class="credits">
                            Designed by <a href="https://bootstrapmade.com/">BootstrapMade</a>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
</main>
<a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>
</body>
</html>
