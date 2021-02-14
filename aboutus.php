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
  <title>เกี่ยวกับเรา | ทรัพย์ศิริ</title>


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
  <main class="main">

    <section class="py-3" id="header">
      <div class="container">
        <div class="row">
          <div class="col-12 text-center">
            <div class="box-header mx-auto">
              <h1 class="text-white mb-0">เกี่ยวกับเรา</h1>
            </div>
          </div>
        </div>
      </div>
    </section>

    <section class="spacer" id="about-us">
      <div class="container">
        <div class="row justify-content-center">
          <div class="col-md-6">
            <img src="assets/img/about.jpg" class="img-fluid rounded shadow-lg" alt="subsiri">
          </div>
          <div class="col-md-6 text-start my-auto">
            <h2>เกี่ยวกับเรา</h2>
            <h1 class="fw-bold text-blue">บริษัท ทรัพย์ศิริ เทรดดิ้ง จำกัด</h1>
            <h5 class="lh-base">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor
              incididunt ut labore et
              dolore magna aliqua.<br> Quis ipsum suspendisse ultrices gravida. Risus commodo viverra maecenas accumsan
              lacus vel facilisis. </h5>
            <h5 class="lh-base">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor
              incididunt ut labore et
              dolore magna aliqua.<br> Quis ipsum suspendisse ultrices gravida. Risus commodo viverra maecenas accumsan
              lacus vel facilisis. </h5>
            <h5 class="lh-base">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor
              incididunt ut labore et
              dolore magna aliqua.<br> Quis ipsum suspendisse ultrices gravida. Risus commodo viverra maecenas accumsan
              lacus vel facilisis. </h5>
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

  <script>
    $('.owl-carousel').owlCarousel({
      loop: true,
      margin: 30,
      nav: false,
      dots: true,
      autoplay: true,
      autoplayHoverPause: true,
      responsive: {
        0: {
          items: 1
        },
        600: {
          items: 3
        },
        1000: {
          items: 4,
          dots: true,
        }
      }
    })
  </script>

</body>

</html>