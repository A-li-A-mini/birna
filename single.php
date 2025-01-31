<?php
include_once("./database.php");

if ($_GET['id']) {
    $newsid = $_GET['id'];

    $sql = "SELECT * FROM news WHERE id='$newsid'";

    $stmt = $conn->prepare($sql);
    $stmt->execute();
    $newsinfo = $stmt->fetchAll();

}


?>

<!DOCTYPE html>
<html lang="fa" dir="rtl">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Vazirmatn:wght@100..900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.rtl.min.css"
        integrity="sha384-dpuaG1suU0eT09tx5plTaGMLBsfDLzUCCUXOY2j/LSvXYuG6Bqs43ALlhIqAJVRb" crossorigin="anonymous">
    <link rel="stylesheet" href="./style.css">

    <title>birjand news agency</title>
</head>

<body>
    <header>
        <div class="container navbar">
            <div class="pt-3">
                <a class="m-2" href="./index.php">خانه</a>
                <a class="m-2" href="./index/politics.php">سیاسی</a>
                <a class="m-2" href="./index/sports.php">ورزشی</a>
                <a class="m-2" href="./index/news.php">همه اخبار</a>
            </div>
            <div class="pt-3">
                <button class="m-1 btn "><a href="./login.php">ورود</a></button>
                <button class="m-1 btn "><a href="./register.php">ثبت نام</a></button>
            </div>
        </div>
    </header>
    <main class="container-lg ">
        <div class="w-75 ms-auto me-auto">
            <div class="w-75 ms-auto me-auto p-2 m-2">
                <h3 class="d-inline-block ms-auto me-auto"><?php echo $newsinfo[0]['title'] ?></h3>
            </div>
            <div class="w-75 ms-auto me-auto p-2 m-2">
                <img class="ms-auto me-auto" src="<?php echo $newsinfo[0]['image'] ?>" alt="" width="100%">
            </div>
            <p class="ms-auto me-auto w-75 "><?php echo $newsinfo[0]['text'] ?></p>
        </div>

    </main>
    <footer class="mt-5 pt-5 ">
        <div class="container">
            <div class="mainfooter my-2">
                <ul class="">
                    <li class="my-1"><a href="./">خانه</a></li>
                    <li class="my-1"><a href="./index/news.php">همه اخبار</a></li>
                    <li class="my-1"><a href="./index/politics.php">اخبار سیاسی</a></li>
                    <li class="my-1"><a href="./index/sports.php">اخبار ورزشی</a></li>
                </ul>
                <div>
                    <p>برای ارسال نظرات، انتقادات و پیشنهادات <a class="text-danger"
                            href="mailto:info@birna.ir">اینجا</a> را کلیک کنید.</p>
                    <p>در صورت بروز مشکل به آدرس <a class="text-danger"
                            href="mailto:support@birna.ir">support@birna.ir</a> پیام دهید.</p>
                </div>
            </div>
            <p class="ms-auto me-auto text-center">تمامی محتوای سایت متعلق به بیرنا میباشد &copy;</p>
        </div>
    </footer>


    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"
        integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r"
        crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js"
        integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy"
        crossorigin="anonymous"></script>
</body>

</html>