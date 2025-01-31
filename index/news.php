<?php

include_once('../database.php');

$sql = "SELECT * FROM news ORDER BY date DESC";
$stmt = $conn->prepare($sql);
$stmt->execute();
$news = $stmt->fetchAll();



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
    <link rel="stylesheet" href="../style.css">

    <title>birjand news agency</title>
</head>

<body>
    <header>
        <div class="container navbar">
            <div class="pt-3">
                <a class="m-2" href="../">خانه</a>
                <a class="m-2" href="./politics.php">سیاسی</a>
                <a class="m-2" href="./sports.php">ورزشی</a>
                <a class="m-2" href="./news.php">همه اخبار</a>
            </div>
            <div class="pt-3">
                <button class="m-1 btn "><a href="../login.php">ورود</a></button>
                <button class="m-1 btn "><a href="../register.php">ثبت نام</a></button>
            </div>
        </div>
    </header>
    <main class="container">
        <h3>همه اخبار</h3>
        <div class="row">
            <?php foreach ($news as $new): ?>
                <div class="col-12 col-lg-3 col-md-6 col-sm-8 ms-auto me-auto ms-lg-0 me-lg-0 my-2">
                    <a href="../single.php?id=<?php echo $new['id'] ?>">
                        <div class="card ">
                            <img class="card-img" src="../<?php echo $new['image'] ?>" alt="" width="100%">
                            <div class="card-body">
                                <h4><?php echo $new['title'] ?></h4>
                                <p><?php echo substr($new['text'], 0, 250) ?></p>
                            </div>
                        </div>
                    </a>
                </div>
            <?php endforeach ?>
        </div>

    </main>
    <footer class="pt-5 mt-1">
        <div class="container">
            <div class="mainfooter my-2">
                <ul class="">
                    <li class="my-1"><a href="./">خانه</a></li>
                    <li class="my-1"><a href="./index/news.php">همه اخبار</a></li>
                    <li class="my-1"><a href="./index/politics.php">اخبار سیاسی</a></li>
                    <li class="my-1"><a href="./index/sports.php">اخبار ورزشی</a></li>
                </ul>
                <div>
                <p>برای ارسال نظرات، انتقادات و پیشنهادات <a class="text-danger" href="mailto:info@birna.ir">اینجا</a> را کلیک کنید.</p>
                <p>در صورت بروز مشکل به آدرس <a class="text-danger" href="mailto:support@birna.ir">support@birna.ir</a> پیام دهید.</p>
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