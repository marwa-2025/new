<?php

$page_title='  المواد';
require_once('../config.php');
include('../inc/head.php');
include('../inc/header.php');
include('../inc/nav.php');
include('../inc/main.php');
if($_SERVER['REQUEST_METHOD']==='POST'){
$sql=$student->insert("subjects",[
    'title'=>$_POST['title'],
    'created_at'=>date('y-m-d H:i:s'),

]);
}


$subjects=$student->select("subjects",[],"id,title,created_at")



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
   <h5 class="card-title">اضافة مواد</h5>
    <!-- Vertical Form -->
    <form class="row g-3" action="create.php" method="POST">
      <div class="col-12">
        <label for="inputNanme4" class="form-label">اضافة مادة</label>
        <input type="text" class="form-control" id="inputNanme4" name="title">
      </div>
      <div class="text-center">
        <button type="submit" class="btn btn-primary">اضافة  مادة</button>
      </div>
    </form><!-- Vertical Form -->

  </div>
</div>
<center>
    
<main id="main" class="main">

<div class="pagetitle">
  <h1>عرض الطلاب  </h1>
  <nav>
    <ol class="breadcrumb">
      <li class="breadcrumb-item"><a href="">الرئيسية</a></li>
      <li class="breadcrumb-item">الطلاب</li>
      <li class="breadcrumb-item active">عرض الطلاب</li>
    </ol>
  </nav>
</div><!-- End Page Title -->


<section class="section">
  <div class="row">
    <div class="col-lg-12">

      <div class="card">
        <div class="card-body">
          <h5 class="card-title">المواد</h5>

      
</section>

  <section class="section">
    <div class="row">
      <div class="col-lg-12">

        <div class="card">
          <div class="card-body">
            <h5 class="card-title">عرض المواد</h5>
            <p></p>

            <!-- Table with stripped rows -->
            <table class="table product">
              <thead>
                <tr>
                  <th>
                    <b>الرقم</b>
                  </th>
                  <th>اسم المادة </th>
                  <th>التاريخ</th>
                </tr>
               <?php foreach($subjects as $subject):?>
              </thead>
              <tbody>
              <?php
                
                   ?>
                  <tr>
                  <td><?php echo $subject['id']?></td>
                  <td><?php echo $subject['title']?></td>
                  <td><?php echo $subject['created_at']?></td>
                
                    </tr><?php
                    endforeach;
                  
                ?>
              </tbody>
            </table>
            <!-- End Table with stripped rows -->

          </div>
        </div>

      </div>
    </div>
  </section>
              





</html>

<?php include('../inc/footer.php');?>