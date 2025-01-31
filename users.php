<?php

session_start();

if (!isset($_SESSION['user'])) {
  header('Location:./login.php');
  die;
}

if ($_SESSION['user']['role'] != 'admin') {
  header('Location:./dashbord.php');
  die;

}

include_once('./database.php');

$sql = "SELECT * FROM users";


$stmt = $conn->prepare($sql);
$stmt->execute();
$users = $stmt->fetchAll();




//   echo "<pre>" ;
//             var_dump($result);
//             echo "</pre>";

?>



<?php include_once('./header.php') ?>

<!--begin::Sidebar-->
<?php include_once('./sidebar.php') ?>
<!--end::Sidebar-->
<!--begin::App Main-->
<main class="app-main">
  <!--begin::App Content Header-->
  <div class="app-content-header">
    <!--begin::Container-->
    <div class="container-fluid">
      <div class="card mb-4">
        <div class="card-header">
          <h3 class="card-title">لیست کاربران</h3>
          <a class="mx-5" href="./usercreate.php">ایجاد کاربر</a>
        </div>
        <!-- /.card-header -->
        <div class="card-body p-0">
          <table class="table table-sm">
            <thead>
              <tr>
                <th>ردیف</th>
                <th>نام</th>
                <th>ایمیل</th>
                <th>رمز عبور</th>
                <th>نقش</th>
                <th>عملیات</th>
              </tr>
            </thead>
            <tbody>
              <?php foreach ($users as $user): ?>
                <tr class="align-middle">
                  <td>
                    <?php echo $user['id'] ?>
                  </td>
                  <td>
                    <?php echo $user['name'] ?>
                  </td>
                  <td>
                    <?php echo $user['email'] ?>
                  </td>
                  <td>
                    <?php echo $user['password'] ?>
                  </td>
                  <td>
                    <?php echo $user['role'] ?>
                  </td>
                  <td>
                    <a href="./useredit.php?id=<?php echo $user['id']; ?>">ویرایش</a>
                    <a href="./userdelete.php?id=<?php echo $user['id']; ?>">حذف</a>
                  </td>
                </tr>
              <?php endforeach; ?>
            </tbody>
          </table>
        </div>
        <!-- /.card-body -->
      </div>

    </div>
    <!--end::Container-->
  </div>
  <!--end::App Content Header-->
  <!--begin::App Content-->
  <div class="app-content">
    <!--begin::Container-->
    <div class="container-fluid">


    </div>
    <!--end::Container-->
  </div>
  <!--end::App Content-->
</main>
<!--end::App Main-->


</div>
<!--end::App Wrapper-->
<!--begin::Script-->

<?php include_once('./footer.php') ?>