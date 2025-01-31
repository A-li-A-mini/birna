<?php

session_start();

if (!isset($_SESSION['user'])) {
  header('Location:./login.php');
  die;
}

if ($_SESSION['user']['role'] == 'user') {
  header('Location:./dashbord.php');
  die;

}

include_once('./database.php');

if (isset($_POST['create_news'])) {

  if (empty($_POST['title'])) {
    echo "<script>alert('عنوان خبر را وارد کنید')</script>";
    die;
  }

  if (empty($_POST['text'])) {
    echo "<script>alert('متن خبر را وارد کنید')</script>";
    die;
  }

  if (empty($_POST['author'])) {
    echo "<script>alert('نام نویسنده را وارد کنید')</script>";
    die;
  }

  if ($_POST['category'] == 'null') {
    echo "<script>alert('دسته بندی خبر را تعیین کنید')</script>";
    die;
  }

  if ($_FILES['img']!= null) {
    $target_dir = "newsimage/";
    $target_file = $target_dir . basename($_FILES["img"]["name"]);
    $uploadOk = 1;
    $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

    // Check if image file is a actual image or fake image
    
      $check = getimagesize($_FILES["img"]["tmp_name"]);
      if ($check !== false) {
        echo "File is an image - " . $check["mime"] . ".";
        $uploadOk = 1;
      } else {
        echo "File is not an image.";
        $uploadOk = 0;
      }
    

    // Check if file already exists
    if (file_exists($target_file)) {
      echo "Sorry, file already exists.";
      $uploadOk = 0;
    }

    // Check file size
    if ($_FILES["img"]["size"] > 5000000) {
      echo "Sorry, your file is too large.";
      $uploadOk = 0;
    }

    // Allow certain file formats
    if (
      $imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
      && $imageFileType != "gif"
    ) {
      echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
      $uploadOk = 0;
    }

    // Check if $uploadOk is set to 0 by an error
    if ($uploadOk == 0) {
      echo "Sorry, your file was not uploaded.";
      // if everything is ok, try to upload file
    } else {
      if (move_uploaded_file($_FILES["img"]["tmp_name"], $target_file)) {
        echo "The file " . htmlspecialchars(basename($_FILES["img"]["name"])) . " has been uploaded.";
      } else {
        echo "Sorry, there was an error uploading your file.";
      }
    }
  }

  $userid = $_SESSION['user']['id'];

  $titel = htmlspecialchars($_POST['title']);
  $text = htmlspecialchars($_POST['text']);
  $author = htmlspecialchars($_POST['author']);
  $image = htmlspecialchars( $target_dir. basename($target_file));
  $category =htmlspecialchars($_POST['category']) ;
  $sql = "INSERT INTO news ( title, text, author, user_id, image, category)
        VALUES ('$titel','$text','$author', '$userid', '$image', '$category')";

  // use exec() because no results are returned
  $conn->exec($sql);

  header('Location:./news.php');
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
            <div class="card-title">ایجاد خبر</div>
          </div>
          <!--end::Header-->
          <!--begin::Form-->
          <form action="./newscreate.php" method="post" enctype="multipart/form-data">
            <!--begin::Body-->
            <div class="card-body">
              <div class="mb-3">
                <label for="title" class="form-label">عنوان خبر</label>
                <textarea name="title" type="text" class="form-control" id="title"
                  aria-describedby="emailHelp"></textarea>
              </div>
              <div class="mb-3">
                <label for="text" class="form-label">متن خبر</label>
                <textarea name="text" type="" class="form-control" id="text" aria-describedby="emailHelp"></textarea>
              </div>
              <div class="mb-3">
                <label for="author" class="form-label">نویسنده</label>
                <input name="author" type="text" class="form-control" id="author">
              </div>
              <div class="col-md-6">
                <label for="category" class="form-label">دسته بندی اخبار</label>
                <select name="category" class="form-select" id="category" required="">
                  <option selected="" value="null">تعیین دسته بندی خبر</option>
                  <option value="politics">سیاسی</option>
                  <option value="sports">ورزشی</option>
                </select>
              </div>
              <div class="mb-3">
                <label for="img" class="form-label">تصویر</label>
                <input name="img" type="file" class="form-control" id="img">
              </div>
            </div>
            <!--end::Body-->
            <!--begin::Footer-->
            <div class="card-footer">
              <button name="create_news" type="submit" class="btn btn-primary">ثبت خبر</button>
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