<!DOCTYPE html>
<html lang="en-US" dir="ltr">

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="description"
    content="จำหน่ายอุปกรณ์การสื่อสาร สำหรับงานติดตั้ง เดินระบบสายสัญญาณ ภายนอก ภายในอาคาร ราคาถูก คุณภาพดี">
  <meta name="keywords" content="ทรัพย์ศิริ">
  <meta name="author" content="Cyber Winner">

  <!-- ===============================================-->
  <!--    Document Title-->
  <!-- ===============================================-->
  <title>ติดต่อเรา | ทรัพย์ศิริ</title>


  <!-- ===============================================-->
  <!--    Favicons-->
  <!-- ===============================================-->
  <link rel="apple-touch-icon" sizes="180x180" href="assets/img/fav.jpg">
  <link rel="icon" type="image/jpg" sizes="32x32" href="assets/img/fav.jpg">
  <link rel="icon" type="image/jpg" sizes="16x16" href="assets/img/fav.jpg">
  <link rel="shortcut icon" type="image/x-icon" href="assets/img/fav.jpg">
  <link rel="manifest" href="assets/img/favicons/manifest.json">
  <meta name="msapplication-TileImage" content="assets/img/fav.jpg">
  <meta name="theme-color" content="#ffffff">


  <!-- ===============================================-->
  <!--    Stylesheets-->
  <!-- ===============================================-->
  <link href="assets/css/theme.css" rel="stylesheet" />
  <link rel="stylesheet" href="assets/css/owl.carousel.min.css">


</head>


<body>

  <!-- ===============================================-->
  <!--    Main Content-->
  <!-- ===============================================-->
  <?php include 'header.php' ?>
  <?php 
      include 'config/init.php';
      $contact_list = contact_list();
  ?>
  <main class="main">

    <section class="py-3" id="header">
      <div class="container">
        <div class="row">
          <div class="col-12 text-center">
            <div class="box-header mx-auto">
              <h1 class="text-white mb-0">ติดต่อเรา</h1>
            </div>
          </div>
        </div>
      </div>
    </section>

    <section class="spacer" id="contact-us">
      <div class="container">
        <div class="row mb-5 justify-content-center">
          <div class="col-md-5 mb-3">
            <h2 class="text-white bg-blue p-2 mb-3">ข้อมูลติดต่อ</h2>
            <h3 class="fw-bolder"><?php echo $contact_list[0]->contact_name; ?></h3>
            <h4 class="lh-base"><i class="fas fa-home text-blue"></i> : <?php echo $contact_list[0]->contact_address; ?>120</h4>
            <h4 class="lh-base"><i class="far fa-clock text-blue"></i> : <?php echo $contact_list[0]->date_time; ?></h4>
            <?php if (!empty($contact_list[0]->phone_1)) : ?>
            <h4><i class="fas fa-phone-square-alt text-blue"></i> : <a class="text-dark"
                href="tel:<?php echo $contact_list[0]->phone_1; ?>"><?php echo $contact_list[0]->phone_1; ?></a></h4>
            <?php endif ?>
            <?php if (!empty($contact_list[0]->phone_2)) : ?>
            <h4><i class="fas fa-phone-square-alt text-blue"></i> : <a class="text-dark"
                href="tel:<?php echo $contact_list[0]->phone_2; ?>"><?php echo $contact_list[0]->phone_2; ?></a></h4>
            <?php endif ?>
            <?php if (!empty($contact_list[0]->phone_3)) : ?>
            <h4><i class="fas fa-phone-square-alt text-blue"></i> : <a class="text-dark"
                href="tel:<?php echo $contact_list[0]->phone_3; ?>"><?php echo $contact_list[0]->phone_3; ?></a></h4>
            <?php endif ?>
            <?php if (!empty($contact_list[0]->phone_4)) : ?>
            <h4><i class="fas fa-phone-square-alt text-blue"></i> : <a class="text-dark"
                href="tel:<?php echo $contact_list[0]->phone_4; ?>"><?php echo $contact_list[0]->phone_4; ?></a></h4>
            <?php endif ?>
            <?php if (!empty($contact_list[0]->phone_5)) : ?>
            <h4><i class="fas fa-phone-square-alt text-blue"></i> : <a class="text-dark"
                href="tel:<?php echo $contact_list[0]->phone_5; ?>"><?php echo $contact_list[0]->phone_5; ?></a></h4>
            <?php endif ?>
          </div>
          <div class="col-md-7 mb-3">
            <iframe class="border shadow"
              src="<?php echo $contact_list[0]->google_map; ?>"
              width="100%" height="300" frameborder="0" style="border:0;" allowfullscreen="" aria-hidden="false"
              tabindex="0"></iframe>
          </div>
        </div>
        <div class="row">
          <div class="col-12">
            <h2 class="text-white text-center bg-blue p-2 mb-3">ส่งข้อความถึงเรา</h2>
            <div class="card border rounded shadow p-3">
              <form method="POST" action="">
                <div class="row">
                  <div class="col-md-6 mb-3">
                    <label for="exampleFormControlInput1" class="form-label">ชื่อ</label>
                    <input type="text" class="form-control" id="name" placeholder="Name">
                  </div>
                  <div class="col-md-6 mb-3">
                    <label for="exampleFormControlInput1" class="form-label">อีเมล์</label>
                    <input type="email" class="form-control" id="email"  placeholder="Email">
                  </div>
                  <div class="col-md-6 mb-3">
                    <label for="exampleFormControlInput1" class="form-label">เบอร์โทรศัพท์</label>
                    <input type="text" class="form-control" id="phone" placeholder="Phone Number">
                  </div>
                  <div class="col-md-6 mb-3">
                    <label for="exampleFormControlInput1" class="form-label">เรื่องติดต่อ</label>
                    <input type="text" class="form-control" id="subject"  placeholder="Subject">
                  </div>
                  <div class="col-md-12 mb-3">
                    <label for="exampleFormControlTextarea1" class="form-label">รายละเอียด</label>
                    <textarea class="form-control" id="" rows="3" id="description" placeholder="Description"></textarea>
                  </div>
                  <div class="col-12 mt-3 text-center">
                    <button type="submit" class="btn btn-primary col-md-3">ส่งข้อความ</button>
                  </div>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>
    </section>



    <?php include 'footer.php'?>

  </main>
  <!-- ===============================================-->
  <!--    End of Main Content-->
  <!-- ===============================================-->


  <!-- ===============================================-->
  <!--    JavaScripts-->
  <!-- ===============================================-->
  <script src="vendors/@popperjs/popper.min.js"></script>
  <script src="vendors/bootstrap/bootstrap.min.js"></script>
  <script src="vendors/is/is.min.js"></script>
  <script src="https://polyfill.io/v3/polyfill.min.js?features=window.scroll"></script>
  <script src="assets/js/theme.js"></script>
  <script src="assets/js/jquery.min.js"></script>
  <script src="assets/js/owl.carousel.min.js"></script>
  
	<script type="text/javascript">
              function sendEmail() {
                  var data = {
                      name: $("#name").val(),
                      email: $("#email").val(),
                      phone: $("#phone").val(),
                      subject: $("#subject").val(),
                      message: $("#description").val()
                  };
                  $.ajax({
                      type: "POST",
                      url: "mail.php",
                      data: data,
                      success: function(result){
                          // $('.success').fadeIn(1000);
                          alert('ส่งข้อความเรียบร้อย');
                          $('#contact-form')[0].reset();
                      }
                  });
              }
    </script>
</body>

</html>