<?php $current_page = basename($_SERVER['PHP_SELF'],'.php'); ?>
<nav class="navbar navbar-expand-lg navbar-light fixed-top py-1" data-navbar-on-scroll="data-navbar-on-scroll">
    <div class="container"><a class="navbar-brand d-flex align-items-center fw-bold fs-2" href="index"><img
                class="d-inline-block me-3 logo" src="assets/img/logo.jpg" alt="logo subsiri" /></a>
        <button class="navbar-toggler collapsed" type="button" data-bs-toggle="collapse"
            data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false"
            aria-label="Toggle navigation"><span class="navbar-toggler-icon"></span></button>
        <div class="collapse navbar-collapse border-top border-lg-0 mt-4 mt-lg-0" id="navbarSupportedContent">
            <ul class="navbar-nav ms-auto pt-2 pt-lg-0">
                <li class="nav-item"><a class="nav-link <?php echo($current_page == 'index') ? 'active' : ''?>" href="index">หน้าแรก</a></li>
                <li class="nav-item"><a class="nav-link <?php echo($current_page == 'aboutus') ? 'active' : ''?>" href="aboutus">เกี่ยวกับเรา</a></li>
                <li class="nav-item"><a class="nav-link <?php echo($current_page == 'products' or $current_page == 'products-detail') ? 'active' : ''?>" href="products">สินค้า</a></li>
                <li class="nav-item"><a class="nav-link <?php echo($current_page == 'customer') ? 'active' : ''?>" href="customer">ลูกค้าของเรา</a></li>
                <li class="nav-item"><a class="nav-link <?php echo($current_page == 'contactus') ? 'active' : ''?>" href="contactus">ติดต่อเรา</a></li>
            </ul>
        </div>
    </div>
</nav>