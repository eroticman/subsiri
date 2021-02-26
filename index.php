<!DOCTYPE html>
<html lang="en-US" dir="ltr">

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="description" content="จำหน่ายอุปกรณ์การสื่อสาร สำหรับงานติดตั้ง เดินระบบสายสัญญาณ ภายนอก ภายในอาคาร ราคาถูก คุณภาพดี">
  <meta name="keywords" content="ทรัพย์ศิริ">
  <meta name="author" content="Cyber Winner">


  <!-- ===============================================-->
  <!--    Document Title-->
  <!-- ===============================================-->
  <title>หน้าแรก | ทรัพย์ศิริ</title>


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

		$banner_list = banner_list();

  ?>
  <main class="main" id="banner-slide">

    <section class="py-0">
      <div id="carouselExampleControls" class="carousel slide" data-bs-ride="carousel">
        <div class="carousel-inner">
        <?php 
					$i = 0;
					foreach ($banner_list as $banner_detail) : 
        ?>
          <?php if ($i == '0') : ?>
            <div class="carousel-item active">
              <img src="img/banner/<?php echo $banner_detail->id; ?>/<?php echo $banner_detail->img_cover; ?>" alt="<?php echo $banner_detail->banner_name; ?>" class="d-block w-100" alt="subsiri">
            </div>
          <?php else : ?>
            <div class="carousel-item">
              <img src="img/banner/<?php echo $banner_detail->id; ?>/<?php echo $banner_detail->img_cover; ?>" alt="<?php echo $banner_detail->banner_name; ?>" class="d-block w-100" alt="subsiri">
            </div>
          <?php endif ?>
        <?php 
					$i++;
          endforeach 
        ?>
        </div>
      </div>
    </section>

    <section class="spacer" id="about-us">
      <div class="container">
        <div class="row justify-content-center">
          <div class="col-lg-10 col-md-12 text-center">
            <h1 class="fw-bold">บริษัท ทรัพย์ศิริ เทรดดิ้ง จำกัด</h1>
            <h4 class="lh-base">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor
              incididunt ut labore et
              dolore magna aliqua.<br> Quis ipsum suspendisse ultrices gravida. Risus commodo viverra maecenas accumsan
              lacus vel facilisis. </h4>
            <div class="row justify-content-center mt-3">
              <div class="col-lg-9 col-md-12">
                <div class="row g-2">
                  <div class="col-lg-4 col-md-4">
                    <button onclick="location.href='tel:099-0547456'"
                      class="btn btn-light border border-light shadow rounded-0 d-block w-100"><i
                        class="fas fa-phone-square-alt display-5 text-blue d-inline"></i>
                      <h4 class="position-relative d-inline top-5"> 099-0547456</h4>
                    </button>
                  </div>
                  <div class="col-lg-4 col-md-4">
                    <button onclick="location.href=''"
                      class="btn btn-light border border-light shadow rounded-0 d-block w-100"><i
                        class="fab fa-line display-5 text-blue d-inline"></i>
                      <h4 class="position-relative d-inline top-5"> sub_siri99</h4>
                    </button>
                  </div>
                  <div class="col-lg-4 col-md-4">
                    <button onclick="location.href=''"
                      class="btn btn-light border border-light shadow rounded-0 d-block w-100"><i
                        class="fab fa-facebook display-5 text-blue d-inline"></i>
                      <h4 class="position-relative d-inline top-5"> บ.ทรัพย์ศิริ จำกัด</h4>
                    </button>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>


    <section class="bg-gray spacer" id="best-sale">
      <div class="container">
        <div class="row">
          <div class="col-12 text-center mb-md-4 mb-3">
            <h1 class="fw-bolder text-blue">สินค้าขายดี</h1>
            <div class="underline">
              <span>
              </span>
            </div>
          </div>
          <div class="col-12 mb-md-4 mb-3">
            <div class="carousel-wrap owl-theme">
              <div class="owl-carousel owl-theme">
              <?php 
                $best_index = best_index();
                foreach ($best_index  as $best_detail) : 
              ?>
                <div class="item">
                  <a href="products-detail?id=<?php echo $best_detail->id; ?>">
					        <!-- <a href="product/<?php echo $best_detail->id; ?>/<?php echo $best_detail->url_name; ?>"> -->
                    <div class="card rounded-0 position-relative">
                      <img src="assets/img/corner.png" class="position-absolute top-0 start-0 z-index-1 w-25"
                        alt="subsiri">
                      <div class="slide-box-img">
                        <img src="img/product/<?php echo $best_detail->id; ?>/<?php echo $best_detail->img_cover; ?>" class="d-block w-100" alt="<?php echo $best_detail->product_name; ?>">
                      </div>
                      <div class="bg-white text-center py-3 title">
                        <h3 class="text-blue mb-0"><?php echo $best_detail->product_name; ?></h3>
                      </div>
                    </div>
                  </a>
                </div>
              <?php endforeach ?>
              </div>
            </div>
          </div>
          <div class="col-12 text-center">
            <button onclick="location.href='products'" class="btn btn-outline-primary">ดูทั้งหมด</button>
          </div>
        </div>
      </div>
    </section>


    <!-- ============================================-->
    <!-- <section> begin ============================-->
    <section class="spacer" id="customer">
      <div class="container">
        <div class="row g-2 justify-content-center">
          <div class="col-12 text-center mb-md-4 mb-3">
            <h1 class="fw-bolder text-white">ลูกค้าของเรา</h1>
            <div class="underline">
              <span>
              </span>
            </div>
          </div>
          <?php 
            $customer_index = customer_index();
            $i = 0;
            foreach ($customer_index as $customer_detail) :
          ?>
            <?php if ( $i%2 == 0 ) : ?>
            <div class="col-md-4 mb-3">
              <div class="card rounded-0 bg-blue-2 p-3">
                <div class="customer-img">
                  <img src="img/review/<?php echo $customer_detail->id; ?>/<?php echo $customer_detail->img_cover; ?>" class="d-block w-100" alt="subsiri">
                </div>
                <div class="content text-center py-3">
                  <h3 class="text-white"><?php echo $customer_detail->review_name; ?></h3>
                  <p class="text-white text-start"><?php echo $customer_detail->description; ?></p>
                </div>
              </div>
            </div>
            <?php else : ?>
              <div class="col-md-4 mb-3">
              <div class="card rounded-0 bg-blue-2 p-3">
                <div class="content text-center py-3">
                  <h3 class="text-white"><?php echo $customer_detail->review_name; ?></h3>
                  <p class="text-white text-start"><?php echo $customer_detail->description; ?></p>
                </div>
                <div class="customer-img">
                  <img src="img/review/<?php echo $customer_detail->id; ?>/<?php echo $customer_detail->img_cover; ?>" class="d-block w-100"
                    alt="subsiri">
                </div>
              </div>
            </div>
            <?php endif ?>
          <?php 
            $i++;
            endforeach 
          ?>
            </div>
          </div>

          <div class="col-12 text-center">
            <button onclick="location.href='customer'" class="btn btn-outline-light">ดูทั้งหมด</button>
          </div>

        </div>
      </div><!-- end of .container-->

    </section>
    <!-- <section> close ============================-->
    <!-- ============================================-->


    <section class="spacer my-md-5" id="services">
      <div class="container">
        <div class="row">
          <div class="col-md-4 mb-3 text-center mx-auto">
            <img src="assets/img/icon/like.png" class="w-25" alt="subsiri">
            <h3 class="fw-bold text-blue pt-3">สินค้าคุณภาพดี มาตรฐาน</h3>
          </div>
          <div class="col-md-4 mb-3 text-center mx-auto">
            <img src="assets/img/icon/true.png" class="w-25" alt="subsiri">
            <h3 class="fw-bold text-blue pt-3">ราคาถูก ราคาประหยัด</h3>
          </div>
          <div class="col-md-4 mb-3 text-center mx-auto">
            <img src="assets/img/icon/numberone.png" class="w-25" alt="subsiri">
            <h3 class="fw-bold text-blue pt-3">ลูกค้าไว้วางใจอันดับ 1</h3>
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
          items: 2,
          margin: 10,
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