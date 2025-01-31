<aside class="app-sidebar bg-body-secondary shadow" data-bs-theme="dark">
    <!--begin::Sidebar Brand-->
    <div class="sidebar-brand ">
        <!--begin::Brand Link-->
        <a href="./index.php" class="brand-link">
            <h2 class="brand-text fw-light">birna</h2>
        </a>
        <!--end::Brand Link-->
    </div>
    <!--end::Sidebar Brand-->
    <!--begin::Sidebar Wrapper-->
    <div class="sidebar-wrapper">
        <h5 class="text-white text-center py-3">
            <span>خوش آمدی </span>
            <?php
            echo $_SESSION['user']['name'];
            ?>
        </h5>
        <nav class="mt-2">
            <!--begin::Sidebar Menu-->
            <ul class="nav sidebar-menu flex-column" data-lte-toggle="treeview" role="menu" data-accordion="false">
                <li class="nav-item ">
                    <a href="./dashbord.php" class="nav-link active">
                        <i class="nav-icon bi bi-speedometer"></i>
                        <p>
                            داشبورد
                        </p>
                    </a>
                </li>
                <?php if ($_SESSION['user']['role'] != 'user'): ?>
                    <li class="nav-item ">
                        <a href="./newscreate.php" class="nav-link active">
                            <i class="nav-icon bi bi-speedometer"></i>
                            <p>
                                ایجاد خبر
                            </p>
                        </a>
                    </li>
                <?php endif; ?>
                <?php if ($_SESSION['user']['role'] != 'user'): ?>
                    <li class="nav-item ">
                        <a href="./news.php" class="nav-link active">
                            <i class="nav-icon bi bi-speedometer"></i>
                            <p>
                                خبر ها
                            </p>
                        </a>
                    </li>
                <?php endif; ?>
                <?php if ($_SESSION['user']['role'] == 'admin'): ?>
                    <li class="nav-item ">
                        <a href="./users.php" class="nav-link active">
                            <i class="nav-icon bi bi-speedometer"></i>
                            <p>
                                کاربران
                            </p>
                        </a>
                    </li>
                <?php endif; ?>
                <li class="nav-item ">
                    <a href="./logout.php" class="nav-link active">
                        <i class="nav-icon bi bi-speedometer"></i>
                        <p>
                            خروج
                        </p>
                    </a>
                </li>

            </ul>
            <!--end::Sidebar Menu-->
        </nav>
    </div>
    <!--end::Sidebar Wrapper-->
</aside>