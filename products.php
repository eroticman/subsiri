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
  <title>สินค้า | ทรัพย์ศิริ</title>


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
    $best_index = best_index();
    $product_list = product_list();
  ?>
  <main class="main">

    <section class="py-3" id="header">
      <div class="container">
        <div class="row">
          <div class="col-12 text-center">
            <div class="box-header mx-auto">
              <h1 class="text-white mb-0">สินค้า</h1>
            </div>
          </div>
        </div>
      </div>
    </section>

    <section class="spacer bg-gray" id="best-sale">
      <div class="container">
        <div class="row">
          <div class="col-12 mb-md-4 mb-3">
            <h1 class="fw-bolder text-blue">สินค้าขายดี</h1>
            <hr>
            <div class="carousel-wrap owl-theme">
              <div class="owl-carousel owl-theme">
              <?php foreach ($best_index  as $best_detail) : ?>
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
        </div>
      </div>
    </section>


    <section class="spacer" id="best-sale">
      <div class="container">
        <div class="row g-md-6 g-2">
          <div class="col-12 mb-md-4 mb-3">
            <h1 class="fw-bolder text-blue">สินค้าทั้งหมด</h1>
            <hr>
          </div>
          <?php foreach ($product_list as $detail) : ?>
          <div class="col-md-3 col-6 mb-3">
            <a href="products-detail?id=<?php echo $detail->id; ?>">
            <!-- <a href="product/<?php echo $detail->id; ?>/<?php echo $detail->url_name; ?>"> -->
              <div class="card rounded-0 border shadow">
                <div class="slide-box-img">
                  <img src="img/product/<?php echo $detail->id; ?>/<?php echo $detail->img_cover; ?>" class="d-block w-100" alt="<?php echo $detail->product_name; ?>" class="d-block w-100" alt="<?php echo $detail->product_name; ?>">
                </div>
                <div class="bg-white text-center py-3 title">
                  <h3 class="text-blue mb-0"><?php echo $detail->product_name; ?></h3>
                </div>
              </div>
            </a>
          </div>
          <?php endforeach ?>

          <?php 
            $total = product_count();

            $pagination = pagination( $total->counter, 8);
          ?>  

          <div class="col-12 mx-auto mt-3">
            <nav>
              <ul class="pagination justify-content-center">
                <?php if ( $pagination['total'] > 0 ) : ?>
                  <?php if ( $pagination['prev'] ) : ?>
                    <li class="page-item">
                      <a class="page-link" href="products?page=<?php echo $pagination['prev']; ?>"><</a>
                    </li>
                  <?php endif; ?>
                  <?php for ( $i = 1; $i <= $pagination['total']; $i++ ) : ?>
                    <?php 
                      $page1 = $pagination['page'] - 2;
                      $page2 = $pagination['page'] + 2;

                      if ( ( $i == 1 ) or ( $i == $pagination['total'] ) or ( $i >= $page1 and $i <= $page2 ) ) :
                    ?>
                        <li class="page-item <?php echo ($i == $pagination['page']) ? 'active' : ''; ?>"><a class="page-link" href="products?page=<?php echo $i; ?>" ><?php echo $i; ?></a></li>
                    <?php elseif ( ( ( $i > 1 ) and ( $i == ( $page1 - 1 ) ) ) or ( ( $i < $pagination['total'] ) and ( $i == ( $page2 + 1 ) ) ) ) : ?>
                        <li class="page-item"><a href="#" class="page-link">...</a></li>
                    <?php endif ?>
                  <?php endfor ?>
                  <?php if ( $pagination['total'] != $pagination['page'] ) : ?>
                    <li class="page-item">
                      <a class="page-link " href="products?page=<?php echo $pagination['next']; ?>">></a>
                    </li>
                  <?php endif ?>
              <?php endif ?>
              </ul>
            </nav>
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