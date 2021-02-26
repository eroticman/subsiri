<?php 
    $aboutus_text = about_us_text();
    $contact_list = contact_list();
?>
<footer id="footer" class="py-md-5 py-3">
    <div class="container">
        <div class="row">
            <div class="col-md-4 text-white">
                <h3 class="text-white">เกี่ยวกับเรา</h3>
                <hr class="d-md-none d-block">
                <p><?php echo $aboutus_text[0]->description; ?></p>
            </div>
            <div class="col-md-3 text-white">
                <h3 class="text-white">ผังเว็บไซต์</h3>
                <hr class="d-md-none d-block">
                <p>
                    <ul class="list-unstyled">
                        <li><a class="text-white" href="/">หน้าแรก</a></li>
                        <li><a class="text-white" href="aboutus">เกี่ยวกับเรา</a></li>
                        <li><a class="text-white" href="products">สินค้า</a></li>
                        <li><a class="text-white" href="customer">ลูกค้าของเรา</a></li>
                        <li><a class="text-white" href="contactus">ติดต่อเรา</a></li>
                    </ul>
                </p>
            </div>
            <div class="col-md-5 text-white">
                <h3 class="text-white">ติดต่อเรา</h3>
                <hr class="d-md-none d-block">
                <h4 class="text-white "><?php echo $contact_list[0]->contact_name; ?></h4>
                <p class="mb-md-0 mb-2">ที่อยู่ : <?php echo $contact_list[0]->contact_address; ?></p>
                <p class="mb-md-0 mb-2">เวลาทำการ : <?php echo $contact_list[0]->date_time; ?></p>
                <?php if (!empty($contact_list[0]->phone_1)) : ?>
                    <p class="text-white mb-1"><i class="fas fa-phone-square-alt"></i> : <a class="text-white" href="tel:<?php echo $contact_list[0]->phone_1; ?>"><?php echo $contact_list[0]->phone_1; ?></a></p>
                <?php endif ?>
                <?php if (!empty($contact_list[0]->phone_2)) : ?>
                    <p class="text-white mb-1"><i class="fas fa-phone-square-alt"></i> : <a class="text-white" href="tel:<?php echo $contact_list[0]->phone_2; ?>"><?php echo $contact_list[0]->phone_2; ?></a></p>
                <?php endif ?>
                <?php if (!empty($contact_list[0]->phone_3)) : ?>
                    <p class="text-white mb-1"><i class="fas fa-phone-square-alt"></i> : <a class="text-white" href="tel:<?php echo $contact_list[0]->phone_3; ?>"><?php echo $contact_list[0]->phone_3; ?></a></p>
                <?php endif ?>
                <?php if (!empty($contact_list[0]->phone_4)) : ?>
                    <p class="text-white mb-1"><i class="fas fa-phone-square-alt"></i> : <a class="text-white" href="tel:<?php echo $contact_list[0]->phone_4; ?>"><?php echo $contact_list[0]->phone_4; ?></a></p>
                <?php endif ?>
                <?php if (!empty($contact_list[0]->phone_5)) : ?>
                    <p class="text-white mb-1"><i class="fas fa-phone-square-alt"></i> : <a class="text-white" href="tel:<?php echo $contact_list[0]->phone_5; ?>"><?php echo $contact_list[0]->phone_5; ?></a></p>
                <?php endif ?>
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <hr class="bg-white">
            </div>
            <div class="col-lg-9 col-md-7">
                <p class="text-white">© 2020 All rights reserved by Sub Siri Co.,Ltd | Powered by : <a class="text-white" href="" target="_blank">Cyber Winner</a></p>
            </div>
            <div class="col-lg-3 col-md-5 text-md-end text-center">
                <a href=""><img src="assets/img/social/facebook.png" class="icon-social" alt="subsiri"></a>
                <a href=""><img src="assets/img/social/line.png" class="icon-social" alt="subsiri"></a>
                <a href=""><img src="assets/img/social/instagram.png" class="icon-social" alt="subsiri"></a>
                <a href=""><img src="assets/img/social/youtube.png" class="icon-social" alt="subsiri"></a>
                <a href=""><img src="assets/img/social/googlemap.png" class="icon-social" alt="subsiri"></a>
            </div>
        </div>
    </div>
</footer>