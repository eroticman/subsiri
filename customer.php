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
  <title>ลูกค้าของเรา | ทรัพย์ศิริ</title>


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

      $customer_list = customer_list();
  ?>
  <main class="main">

    <section class="py-3" id="header">
      <div class="container">
        <div class="row">
          <div class="col-12 text-center">
            <div class="box-header mx-auto">
              <h1 class="text-white mb-0">ลูกค้าของเรา</h1>
            </div>
          </div>
        </div>
      </div>
    </section>

    <section class="spacer" id="customer-us">
      <div class="container">
        <div class="row justify-content-center">
        <?php 
          $i = 0;
          foreach ($customer_list as $customer_detail) :
        ?>
            <?php if ( $i%2 == 0 ) : ?>
              <div class="col-lg-4 col-md-6 mb-3">
                <div class="card rounded border shadow overflow-hidden">
                  <div class="customer-img">
                    <img src="img/review/<?php echo $customer_detail->id; ?>/<?php echo $customer_detail->img_cover; ?>" class="d-block w-100" alt="subsiri">
                  </div>
                  <div class="content text-center p-3">
                    <h3 class=""><?php echo $customer_detail->review_name; ?></h3>
                    <p class=" text-start"><?php echo $customer_detail->description; ?></p>
                  </div>
                </div>
              </div>
            <?php else : ?>
              <div class="col-lg-4 col-md-6 mb-3">
                <div class="card rounded border shadow overflow-hidden">
                  <div class="content text-center p-3">
                    <h3 class="">ขอขอบพระคุณลูกค้า</h3>
                    <p class=" text-start"><?php echo $customer_detail->description; ?></p>
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

          <?php 
            $total = customer_count();

            $pagination = pagination( $total->counter, 6);
          ?>  

          <div class="col-12 mx-auto mt-3">
            <nav>
              <ul class="pagination justify-content-center">
              <?php if ( $pagination['total'] > 0 ) : ?>
                <?php if ( $pagination['prev'] ) : ?>
                  <li class="page-item">
                    <a class="page-link" href="customer?page=<?php echo $pagination['prev']; ?>"><</a>
                  </li>
                <?php endif; ?>
                <?php for ( $i = 1; $i <= $pagination['total']; $i++ ) : ?>
                  <?php 
                    $page1 = $pagination['page'] - 2;
                    $page2 = $pagination['page'] + 2;

                    if ( ( $i == 1 ) or ( $i == $pagination['total'] ) or ( $i >= $page1 and $i <= $page2 ) ) :
                  ?>
                      <li class="page-item <?php echo ($i == $pagination['page']) ? 'active' : ''; ?>"><a class="page-link" href="customer?page=<?php echo $i; ?>" ><?php echo $i; ?></a></li>
                  <?php elseif ( ( ( $i > 1 ) and ( $i == ( $page1 - 1 ) ) ) or ( ( $i < $pagination['total'] ) and ( $i == ( $page2 + 1 ) ) ) ) : ?>
                      <li class="page-item"><a href="#" class="page-link">...</a></li>
                  <?php endif ?>
                <?php endfor ?>

                <?php if ( $pagination['total'] != $pagination['page'] ) : ?>
                  <li class="page-item">
                    <a class="page-link " href="customer?page=<?php echo $pagination['next']; ?>">></a>
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

</body>

</html>