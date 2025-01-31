<?php

session_start();

if (!isset($_SESSION['user'])) {
    header('Location:./login.php');
    die;
}

$role = $_SESSION['user']['role'];
$uid = $_SESSION['user']['id'];

if ($role == 'user') {
    header('Location:./dashbord.php');
    die;

}

include_once('./database.php');

if($role == 'author'){
    $sql = "SELECT * FROM news WHERE user_id = '$uid'";
}
else{
    $sql = "SELECT * FROM news";
}

$stmt = $conn->prepare($sql);
$stmt->execute();
$news = $stmt->fetchAll();




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
                    <h3 class="card-title">خبر ها</h3>
                </div>
                <!-- /.card-header -->
                <div class="card-body p-0">
                    <table class="table table-sm">
                        <thead>
                            <tr>
                                <th>عنوان</th>
                                <th>متن</th>
                                <th>نویسنده</th>
                                <th>تصویر</th>
                                <th>عملیات</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($news as $new): ?>
                                <tr class="align-middle">
                                    <td class="w-25">
                                        <?php echo $new['title'] ?>
                                    </td>
                                    <td class="w-50">
                                        <?php echo substr($new['text'], 0, 500) ?>
                                    </td>
                                    <td>
                                        <?php echo $new['author'] ?>
                                    </td>
                                    <td>
                                        <?php echo $new['image'] ?>
                                    </td>
                                    <td>
                                        <a href="./newsedit.php?id=<?php echo $new['id']; ?>">ویرایش</a>
                                        <a href="./newsdelete.php?id=<?php echo $new['id']; ?>">حذف</a>
                                    </td>
                                </tr>
                            <?php endforeach ?>
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