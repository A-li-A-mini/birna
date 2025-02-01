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


if ($_GET['id'] == 1 && $_SESSION['user']['id'] != 1) {
  header('Location:./users.php');
  die;
}

if (isset($_GET['id'])) {
  $userid = $_GET['id'];

  $sql = "SELECT * FROM users WHERE id='$userid'";

  $stmt = $conn->prepare($sql);
  $stmt->execute();
  $userinfo = $stmt->fetchAll();

}

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
  $role = $_POST['role'];
  $userid = $_GET['id'];

  $sql = "UPDATE  users SET name = '$name', email = '$email' , password = '$password' , role = '$role' WHERE id = $userid ";


  // use exec() because no results are returned
  $conn->exec($sql);

  header('Location:./users.php');
  die;
}



echo "<pre>";
var_dump($userinfo);
echo "</pre>";

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
          <form action="./useredit.php?id=<?php echo $userinfo[0]['id'] ?>" method="post">
            <!--begin::Body-->
            <div class="card-body">
              <div class="mb-3">
                <label for="name" class="form-label">نام</label>
                <input name="name" type="text" class="form-control" id="name" value="<?php echo $userinfo[0]['name'] ?>"
                  aria-describedby="emailHelp">
              </div>
              <div class="mb-3">
                <label for="email" class="form-label">ایمیل</label>
                <input name="email" type="email" class="form-control" id="email"
                  value="<?php echo $userinfo[0]['email'] ?>" aria-describedby="emailHelp">
              </div>
              <div class="mb-3">
                <label for="password" class="form-label">رمز عبور</label>
                <input name="password" type="text" class="form-control" id="password"
                  value="<?php echo $userinfo[0]['password'] ?>">
              </div>
              <div class="mb-3">
                <label for="password_confirm" class="form-label">تکرار رمز عبور</label>
                <input name="password_confirm" type="password" class="form-control" id="password_confirm">
              </div>
              <div class="col-md-6">

                <label for="role" class="form-label">نقش</label>
                <select name="role" class="form-select" id="role" required="">
                  <option value="admin" <?php if ($userinfo[0]['role'] == 'admin')
                    echo "selected" ?>>مدیر</option>
                    <option value="author" <?php if ($userinfo[0]['role'] == 'author')
                    echo 'selected' ?>>نویسنده</option>
                    <option value="user" <?php if ($userinfo[0]['role'] == 'user')
                    echo 'selected' ?>>کاربر عادی</option>
                  </select>
                </div>
              </div>
              <!--end::Body-->
              <!--begin::Footer-->
              <div class="card-footer">
                <button name="edit_user_btn" type="submit" class="btn btn-primary">ویرایش</button>
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