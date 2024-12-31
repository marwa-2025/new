<?php
$page_title='لوحة تحكم المدير';
require_once('../config.php');
include('../inc/head.php');
include('../inc/header.php');
include('../inc/nav.php');
include('../inc/main.php');


$students=$student->select("students",[],"id,name,email,student_number,phone,address,created_at");


?>



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
            <h5 class="card-title">الطلاب</h5>

        
</section>

    <section class="section">
      <div class="row">
        <div class="col-lg-12">

          <div class="card">
            <div class="card-body">
              <h5 class="card-title">عرض المنتجات</h5>
              <p></p>

              <!-- Table with stripped rows -->
              <table class="table product">
                <thead>
                  <tr>
                    <th>
                      <b>الرقم</b>
                    </th>
                    <th>اسم الطالب </th>
                    <th>الايميل</th>
                    <th>رقم الجلوس</th>
                    <th>الفون</th>
                    <th>العنوان</th>
                    <th>التاريخ</th>
                    <th>النتيجة</th>
                  </tr>
                 <?php foreach($students as $student):?>
                </thead>
                <tbody>
                <?php
                  
                     ?>
                    <tr>
                    <td><?php echo $student['id']?></td>
                    <td><?php echo $student['name']?></td>
                    <td><?php echo $student['email']?></td>
                    <td><?php echo $student['student_number']?></td>
                    <td><?php echo $student['phone']?></td>
                    <td><?php echo $student['address']?></td>
                    <td><?php echo $student['created_at']?></td>
                    <td><a href="../results/create.php?id=<?php echo $student['id']?>&name=<?php echo urlencode($student['name']); ?>" class="btn btn-primary btn-lg active" role="button" aria-pressed="true">النتيجة </a></td>
  
                  
                    
                    <?php endforeach;?>
                      </tr>
                     
                    
                  
                </tbody>
              </table>
              <!-- End Table with stripped rows -->

            </div>
          </div>

        </div>
      </div>
    </section>
                
    <?php   include('../inc/footer.php');?>








