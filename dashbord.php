<?php

session_start();

if (!isset($_SESSION['user'])) {
  header('Location:./login.php');
  die;
}

include_once('./database.php');

// echo "<pre>";
// var_dump($_SESSION);
// echo "</pre>";

$userid = $_SESSION['user']['id'];

$sql = "SELECT * FROM users WHERE id='$userid'";

$stmt = $conn->prepare($sql);
$stmt->execute();
$userinfo = $stmt->fetchAll();




if (isset($_POST['edit_user_btn'])) {

  // var_dump($_POST);  

  if (empty($_POST['name'])) {
    echo "<script>alert('نام را وارد کنید')</script>";
    die;
  }

  if (empty($_POST['email'])) {
    echo "<script>alert('ایمیل  را وارد ')</script>";
    die;
  }

  if (empty($_POST['password']) || empty($_POST['password_confirm'])) {
    echo "<script>alert('رمز عبور را بررسی کنید')</script>";
    die;
  }

  if ($_POST['password'] != $_POST['password_confirm']) {
    echo "<script>alert('رمز عبور و تکرار آن را بررسی کنید')</script>";
    die;
  }



  $name = htmlspecialchars($_POST['name']);
  $email = htmlspecialchars($_POST['email']);
  $password = htmlspecialchars($_POST['password']);
  $role = $_SESSION['user']['role'];
  $userid = $_SESSION['user']['id'];

  $sql = "UPDATE  users SET name = '$name', email = '$email' , password = '$password'  WHERE id = $userid ";


  // use exec() because no results are returned
  $conn->exec($sql);
  $sql1 = "SELECT * FROM users WHERE id= $userid";
  $stmt1 = $conn->prepare($sql1);
  $stmt1->execute();
  $newsession = $stmt1->fetch(PDO::FETCH_ASSOC);

  $_SESSION['user'] = $newsession;
  header('Location:./dashbord.php');
  die;
}

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
      <div class="card mb-4 w-75 ">
        <div class="card-header">
          <h3 class="card-title">اطلاعات فردی</h3>
        </div>
        <!-- /.card-header -->
        <div class="card-body p-0">
          <form action="./dashbord.php" method="post">
            <!--begin::Body-->
            <div class="card-body">
              <div class="mb-3">
                <label for="name" class="form-label">نام</label>
                <input name="name" type="text" class="form-control" id="name"
                  value="<?php echo $_SESSION['user']['name'] ?>">
              </div>
              <div class="mb-3">
                <label for="email" class="form-label">ایمیل</label>
                <input name="email" type="email" class="form-control" id="email"
                  value="<?php echo $_SESSION['user']['email'] ?>" autocomplete="off">
              </div>
              <div class="mb-3">
                <label for="password" class="form-label">رمز عبور</label>
                <input name="password" type="password" class="form-control " id="password"
                  value="<?php echo $_SESSION['user']['password'] ?>">
              </div>
              <div class="mb-3">
                <label for="password_confirm" class="form-label">تکرار رمز عبور</label>
                <input name="password_confirm" type="password" class="form-control" id="password_confirm">
              </div>
              <div class="col-md-6">
                <label for="role" class="form-label">نقش</label>
                <input name="role" class="form-control" id="role" value="<?php echo $_SESSION['user']['role'] ?>"
                  disabled>

              </div>
              <!--end::Body-->
              <!--begin::Footer-->
              <div class="card-footer">
                <button name="edit_user_btn" type="submit" class="btn btn-primary">ویرایش</button>
              </div>
              <!--end::Footer-->
          </form>
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