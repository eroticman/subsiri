<?php 
	include 'config/init.php';
	$product_detail = product_detail($_GET['id']);
	$product_img_list  = product_img_list($_GET['id']);
?>
<!DOCTYPE html>
<html lang="en-US" dir="ltr">

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="description"
    content="จำหน่ายอุปกรณ์การสื่อสาร สำหรับงานติดตั้ง เดินระบบสายสัญญาณ ภายนอก ภายในอาคาร ราคาถูก คุณภาพดี">
  <meta name="keywords" content="<?php echo $product_detail->key_word; ?>">
  <meta name="author" content="Cyber Winner">

	<!-- <base href="https://subsiri.com/product"> -->

  <!-- ===============================================-->
  <!--    Document Title-->
  <!-- ===============================================-->
  <title><?php echo $product_detail->product_name; ?> | ทรัพย์ศิริ</title>


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
  <link href="assets/css/fotorama.css" rel="stylesheet">

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
              <h1 class="text-white mb-0">รายละเอียดสินค้า</h1>
            </div>
          </div>
        </div>
      </div>
    </section>

    <section class="spacer" id="about-us">
      <div class="container">
        <div class="row">
          <div class="col-lg-5 col-md-6 mb-3 order-md-0 order-1">
            <div class="fotorama border shadow-sm" data-arrows="true" data-height="400" data-nav="thumbs"
              data-allowfullscreen="true" data-loop="true" data-autoplay="true" data-transition="dissolve"
              data-arrows="true" data-click="true" data-swipe="false" data-trackpad="true">
              <?php foreach ($product_img_list as $imgDetail) : ?>
                <img src="img/product/<?php echo $imgDetail->product_id; ?>/<?php echo $imgDetail->img_name; ?>" alt="<?php echo $product_detail->product_name; ?>">
              <?php endforeach ?>
            </div>
          </div>
          <div class="col-lg-7 col-md-6 mb-3 order-md-1 order-0">
            <h3><b>ชื่อ :</b> <?php echo $product_detail->product_name; ?></h3>
            <hr>
            <h5 class="lh-base"><b>ราคา :</b> <?php echo $product_detail->price; ?> บาท</h5>
            <h5 class="lh-base"><b>ขนาด :</b> <?php echo $product_detail->size; ?></h5>
            <h5 class="lh-base"><b>รายละเอียด :</b> </h5>
            <?php echo $product_detail->description; ?>
          </div>
        </div>
      </div>
    </section>

    <?php 
      $product_related = product_related();
    ?>
    <section class="bg-gray spacer" id="related-product">
      <div class="container">
        <div class="row">
          <div class="col-12 mb-3 text-center">
            <h1 class="fw-bolder text-white bg-blue p-2">สินค้าที่เกี่ยวข้อง</h1>
          </div>
          <?php foreach ($product_related as $releated) : ?>
          <div class="col-lg-2 col-md-4 col-6 mb-3">
            <a href="products-detail?id=<?php echo $releated->id; ?>">
            <!-- <a href="product/<?php echo $releated->id; ?>/<?php echo $releated->url_name; ?>"> -->
              <div class="card rounded-0 border shadow">
                <div class="slide-box-img">
                  <img src="img/product/<?php echo $releated->id; ?>/<?php echo $releated->img_cover; ?>" class="d-block w-100" alt="<?php echo $releated->product_name; ?>" class="d-block w-100" alt="<?php echo $releated->product_name; ?>">
                </div>
                <div class="bg-white text-center py-3 title">
                  <h3 class="text-blue mb-0"><?php echo $releated->product_name; ?></h3>
                </div>
              </div>
            </a>
          </div>
          <?php endforeach ?>
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
  <script src="assets/js/fotorama.js"></script>

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