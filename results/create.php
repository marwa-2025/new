<?php
$page_title = 'تسجيل طلاب';
require_once('../config.php');
include('../inc/head.php');
include('../inc/header.php');
include('../inc/nav.php');
include('../inc/main.php');

// التحقق من وجود البيانات في GET
if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // جلب بيانات الطالب بناءً على id
    $students = $student->select("students", ["id" => $id], "id, name");

    // التحقق من البيانات باستخدام POST
    if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['student_id'], $_POST['subject_id'], $_POST['result'], $_POST['degree'])) {
        // إضافة البيانات في جدول النتائج
        $results = $student->insert('results', [
            'student_id' => $_POST['student_id'],
            'subject_id' => $_POST['subject_id'],
            'result' => $_POST['result'],
            'degree' => $_POST['degree'],
        ]);

        // تحقق من نجاح الإدخال
        if ($results) {
            echo "<div class='alert alert-success'>تم تسجيل النتيجة بنجاح.</div>";
        } else {
            echo "<div class='alert alert-danger'>حدث خطأ أثناء تسجيل النتيجة.</div>";
        }
    }

    // جلب جدول المواد باستخدام الدالة select
    $subjects = $student->select("subjects", [], "id, title, created_at");

    // جلب جدول النتائج للطالب المحدد باستخدام الدالة select
    $results = $student->select(
        "results r 
        JOIN students s ON r.student_id=s.id
        JOIN subjects sub ON r.subject_id=sub.id",
        ['student_id' => $id],
        "s.name AS student_name, sub.title AS subject_title, r.result, r.degree"
    );

   
// حساب المجموع الكلي للدرجات
$totalDegreesResult = $student->select(
    "results",
    ['student_id' => $id],
    "SUM(degree) AS total_degree"
);
$totalDegrees = $totalDegreesResult[0]['total_degree'] ?? 0;

//    المجموع الكلي للطالب
$overallTotal = 500;

// نتيجة الطالب النهائية
$remaining = $overallTotal - $totalDegrees;

} else {
echo "<div class='alert alert-danger'>لم يتم تحديد الطالب.</div>";
exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>تسجيل النتيجة</title>
</head>
<body>
    <center>
        <div class="col-lg-6">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">الطلاب</h5>
                    <form class="row g-3" action="" method="POST">
                        <?php if (!empty($students)) : ?>
                            <?php foreach ($students as $student) : ?>
                                <div class="col-12">
                                    <label class="form-label">رقم الطالب: <?php echo $student['id']; ?></label>
                                    <input type="hidden" name="student_id" value="<?php echo $student['id']; ?>">
                                </div>
                                <div class="col-12">
                                    <label class="form-label">اسم الطالب: <?php echo $student['name']; ?></label>
                                </div>
                            <?php endforeach; ?>
                        <?php endif; ?>

                        <label class="my-1 mr-2" for="subjectSelect">المادة</label>
                        <select class="custom-select my-1 mr-sm-2" id="subjectSelect" name="subject_id" required>
                            <option selected disabled>اختر المادة...</option>
                            <?php foreach ($subjects as $subject) : ?>
                                <option value="<?php echo $subject['id']; ?>">
                                    <?php echo $subject['title']; ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                        <div class="col-12">
                            <label for="inputNanme4" class="form-label">درجة الطالب في المادة</label>
                            <input type="text" class="form-control" id="inputNanme4" name="degree" required>
                        </div>
                        <label class="my-1 mr-2" for="resultSelect">النتيجة</label>
                        <select class="custom-select my-1 mr-sm-2" id="resultSelect" name="result" required>
                            <option selected disabled>اختر النتيجة...</option>
                            <option value="ناجح">ناجح</option>
                            <option value="راسب">راسب</option>
                        </select>
                        <button type="submit" class="btn btn-primary">تسجيل النتيجة</button>
                    </form>
                </div>
            </div>
        </div>
    </center>

    <main id="main" class="main">
        <div class="pagetitle">
            <h1>عرض الطلاب</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="">الرئيسية</a></li>
                    <li class="breadcrumb-item">الطلاب</li>
                    <li class="breadcrumb-item active">عرض الطلاب</li>
                </ol>
            </nav>
        </div>
        <section class="section">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">عرض النتائج</h5>
                            <table class="table product">
                                <thead>
                                    <tr>
                                        <th>اسم الطالب</th>
                                        <th>المادة</th>
                                        <th>درجة الطالب في المادة</th>
                                        <th>النتيجة</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php if (!empty($results)) : ?>
                                        <?php foreach ($results as $result) : ?>
                                            <tr>
                                                <td><?php echo $result['student_name']; ?></td>
                                                <td><?php echo $result['subject_title']; ?></td>
                                                <td><?php echo $result['degree']; ?></td>
                                                <td><?php echo $result['result']; ?></td>
                                            </tr>
                                        <?php endforeach; ?>
                                    <?php else : ?>
                                        <tr>
                                            <td colspan="4">لا توجد نتائج مسجلة.</td>
                                        </tr>
                                    <?php endif; ?>
                                </tbody>
                            </table>

                            <h5>المجموع الكلي: <?php echo $overallTotal; ?></h5>
                        <h5>مجموع درجات الطالب: <?php echo $totalDegrees ?: 0; ?></h5>
                        <h5> النتيجة النهائية: <?php echo $remaining; ?></h5>
                                    </div>
                                    </div>
            </div>
        </div>
    </section>
</body>
</html>
<?php include('../inc/footer.php'); ?>