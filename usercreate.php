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

if (isset($_POST['create_user_btn'])) {


  if (empty($_POST['name'])) {
    echo "<script>alert('نام را وارد کنید')</script>";
    die;
  }

  if (empty($_POST['email'])) {
    echo "<script>alert('ایمیل  را وارد ')</script>";
    die;
  }

  $email = htmlspecialchars($_POST['email']);
  $sql = "SELECT * FROM users WHERE email='$email'";

  $stmt = $conn->prepare($sql);
  $stmt->execute();
  $result = $stmt->fetchAll();

  if (isset($result[0])) {
    echo "<script>alert('این ایمیل از قبل وجود دارد')</script>";
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
  $role = htmlspecialchars($_POST['role']);

  $sql = "INSERT INTO users (name, email, password, role)
        VALUES ('$name','$email','$password','$role')";


  // use exec() because no results are returned
  $conn->exec($sql);

  header('Location:./users.php');
  die;
}



// echo "<pre>" ;
//           var_dump($_SESSION);
//           echo "</pre>";

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

      <div class="col-md-6">
        <!--begin::Quick Example-->
        <div class="card card-primary card-outline mb-4">
          <!--begin::Header-->
          <div class="card-header">
            <div class="card-title">ایجاد کاربر</div>
          </div>
          <!--end::Header-->
          <!--begin::Form-->
          <form action="./usercreate.php" method="post">
            <!--begin::Body-->
            <div class="card-body">
              <div class="mb-3">
                <label for="name" class="form-label">نام</label>
                <input name="name" type="text" class="form-control" id="name" aria-describedby="emailHelp">
              </div>
              <div class="mb-3">
                <label for="email" class="form-label">ایمیل</label>
                <input name="email" type="email" class="form-control" id="email" aria-describedby="emailHelp">
              </div>
              <div class="mb-3">
                <label for="password" class="form-label">رمز عبور</label>
                <input name="password" type="password" class="form-control" id="password">
              </div>
              <div class="mb-3">
                <label for="password_confirm" class="form-label">تکرار رمز عبور</label>
                <input name="password_confirm" type="password" class="form-control" id="password_confirm">
              </div>
              <div class="col-md-6">
                <label for="role" class="form-label">نقش</label>
                <select name="role" class="form-select" id="role" required="">
                  <option value="admin">مدیر</option>
                  <option value="author">نویسنده</option>
                  <option selected="" value="user">کاربر عادی</option>
                </select>
              </div>
            </div>
            <!--end::Body-->
            <!--begin::Footer-->
            <div class="card-footer">
              <button name="create_user_btn" type="submit" class="btn btn-primary">ثبت</button>
            </div>
            <!--end::Footer-->
          </form>
          <!--end::Form-->
        </div>
        <!--end::Quick Example-->
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