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

if (isset($_GET['id'])) {
  $newsid = $_GET['id'];

  $sql = "SELECT * FROM news WHERE id='$newsid'";

  $stmt = $conn->prepare($sql);
  $stmt->execute();
  $newsinfo = $stmt->fetchAll();

}

if (isset($_POST['edit_news_btn'])) {

  // var_dump($_POST);  

  if (empty($_POST['title'])) {
    echo "<script>alert('عنوان را وارد کنید')</script>";
    die;
  }

  if (empty($_POST['text'])) {
    echo "<script>alert('متن  را وارد ')</script>";
    die;
  }

  if (empty($_POST['author'])) {
    echo "<script>alert('نام نویسنده را وارد کنید')</script>";
    die;
  }

  if ($_FILES['img']) {
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

  $title = htmlspecialchars($_POST['title']);
  $text = htmlspecialchars($_POST['text']);
  $author = htmlspecialchars($_POST['author']);
  $image = htmlspecialchars( $target_dir. basename($target_file));
  $newsid = $_GET['id'];

  $sql = "UPDATE  news SET title = '$title', text = '$text' , author = '$author' , image='$image' WHERE id = $newsid ";


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
            <div class="card-title">ویرایش خبر</div>
          </div>
          <!--end::Header-->
          <!--begin::Form-->
          <form action="./newsedit.php?id=<?php echo $newsinfo[0]['id'] ?>" method="post" enctype="multipart/form-data">
            <!--begin::Body-->
            <div class="card-body">
              <div class="mb-3">
                <label for="title" class="form-label">عنوان</label>
                <textarea name="title" type="text" class="form-control" id="title"
                  value=""><?php echo $newsinfo[0]['title'] ?></textarea>
              </div>
              <div class="mb-3">
                <label for="text" class="form-label">متن خبر</label>
                <textarea name="text" type="text" class="form-control" id="text"
                  value=""><?php echo $newsinfo[0]['text'] ?></textarea>
              </div>
              <div class="mb-3">
                <label for="author" class="form-label">نویسنده</label>
                <input name="author" type="text" class="form-control" id="author"
                  value="<?php echo $newsinfo[0]['author'] ?>">
              </div>
              <div class="mb-3">
                <label for="img" class="form-label">تصویر</label>
                <img src="<?php echo $newsinfo[0]['image'] ?>" alt="" width="100%">
                <input name="img" type="file" class="form-control" id="img"
                  value="">
              </div>
            </div>
            <!--end::Body-->
            <!--begin::Footer-->
            <div class="card-footer">
              <button name="edit_news_btn" type="submit" class="btn btn-primary">ویرایش</button>
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