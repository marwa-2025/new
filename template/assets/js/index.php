<?php

require_once ("../config.php");
auth_check();

$page_title ='الأقسام';
include('../inc/head.php');
include('../inc/header.php');
include('../inc/sidebar.php');
?>
<main id="main" class="main">

  <div class="pagetitle">
    <h1>عرض الأقسام</h1>
    <nav>
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="">الرئيسية</a></li>
        <li class="breadcrumb-item">الأقسام</li>
        <li class="breadcrumb-item active">عرض الأقسام</li>
      </ol>
    </nav>
  </div><!-- End Page Title -->

  <section class="section">
    <div class="row">
      <div class="col-lg-12">

        <div class="card">
          <div class="card-body">
            <h5 class="card-title">الأقسام</h5>

            <!-- General Form Elements -->
            <form method="POST">
              <div class="row mb-3">
                <label for="inputText" class="col-sm-2 col-form-label" >القسم</label>
                <div class="col-sm-10">
                  <input type="text" class="form-control" name="category_name">
                </div>
              </div>
              
              <div class="row mb-3">
              <label class="col-sm-2 col-form-label"> </label>
                <div class="col-sm-10">
                  <button type="submit" class="btn btn-primary">اضافة الصنف</button>
                </div>
              </div>
            </form>
            </div>
              </div>
              </div>
              </div>
</section>
       
<?php
$sql = "SELECT * FROM categories";
$result = $conn->query($sql);
?> 
<br><br><br>
                <h5 class="card-title">التصنيفات<span></span></h5>
                <section class="section">
      <div class="row">
        <div class="col-lg-12">

          <div class="card">
            <div class="card-body">
              <h5 class="card-title">عرض التصنيفات</h5>
              <p></p>

              <!-- Table with stripped rows -->
              <table class="table cat">
                <thead>
                  <tr>
                    <th>
                      <b>الرقم</b>
                    </th>
                    <th>اسم الصنف</th>
                    <th>تعديل</th>
                    <th>حذف</th>
                  </tr>
                </thead>
                <tbody>
                <?php
                  if ($result->num_rows > 0) {
                      while($row = $result->fetch_assoc()) {?>
                    <tr>
                      
                      <td><?php echo $row['id']?></td>
    <td><a href="category_products.php?category_id=<?php echo $row['id']?>"><?php echo $row['name']?></a></td> 
      <td><a href="edit.php?id=<?php echo $row['id']?>" class='btn btn-info'>تعديل</a></td>           
      <td><a href="delete.php?id=<?php echo $row['id']?>" class='btn btn-danger'>حذف</a></td>           

                     </tr><?php
                      }
                  }?>
                </tbody>
              </table>
              <!-- End Table with stripped rows -->

            </div>
          </div>

        </div>
      </div>
    </section>
                
            



</main><!-- End #main -->
<script>
  const cat = select('.cat', true)
  cat.forEach(datatable => {
    new simpleDatatables.DataTable(datatable, {
      perPageSelect: [5, 10, 15, ["All", -1]],
      columns: [{
          select: 0,
          sortSequence: ["desc", "asc"]
        },
        {
          select: 1,
          sortSequence: ["desc"]
        },
       
      ]
    });
  })

</script>

<?php
include('../inc/footer.php');
?>
