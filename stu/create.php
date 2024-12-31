<?php
$page_title='تسجيل طلاب';
require_once('../config.php');
include('../inc/head.php');
include('../inc/header.php');
include('../inc/nav.php');
include('../inc/main.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $sql = $student->insert("students", [
            'name' => $_POST['name'],
            'email' => $_POST['email'],
            'student_number' =>$_POST['student_number'], 
            'phone' => $_POST['phone'],
            'address' => $_POST['address'],
            'created_at' => date('Y-m-d H:i:s'),
        ]);
      }


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <center>
<div class="col-lg-6">

<div class="card">
  <div class="card-body">
   <h5 class="card-title">الطلاب</h5>
    <!-- Vertical Form -->
    <form class="row g-3" action="create.php" method="POST">
      <div class="col-12">
        <label for="inputNanme4" class="form-label">الاسم</label>
        <input type="text" class="form-control" id="inputNanme4" name="name" required>
      </div>
      <div class="col-12">
        <label for="inputEmail4" class="form-label">الايميل</label>
        <input type="email" class="form-control" id="inputEmail4" name="email" required>
      </div>
      <div class="col-12">
        <label for="inputPassword4" class="form-label">رقم الجلوس</label>
        <input type="password" class="form-control" id="inputPassword4" name="student_number" required>
      </div>
      <div class="col-12">
        <label for="inputPassword4" class="form-label">رقم الفون</label>
        <input type="password" class="form-control" id="inputPassword4"name="phone" required>
      </div>
     <div class="col-12">
        <label for="inputAddress" class="form-label">العنوان</label>
        <input type="text" class="form-control" id="inputAddress" placeholder=" "name="address"required >
      </div>
      <div class="text-center">
        <button type="submit" class="btn btn-primary">تسجبل طالب</button>
      </div>
    </form><!-- Vertical Form -->

  </div>
</div>
<center>
    
</html>
<?php   include('../inc/footer.php');?>