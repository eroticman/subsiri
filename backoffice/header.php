<?php 
require_once 'init.php';
require_once 'auth.php';
?>
<nav class="site-navbar navbar navbar-default navbar-fixed-top navbar-mega" role="navigation">

	<div class="navbar-header">
		<button type="button" class="navbar-toggler hamburger hamburger-close navbar-toggler-left hided" data-toggle="menubar">
			<span class="sr-only">Toggle navigation</span>
			<span class="hamburger-bar"></span>
		</button>
		<button type="button" class="navbar-toggler collapsed" data-target="#site-navbar-collapse" data-toggle="collapse">
			<i class="icon wb-more-horizontal" aria-hidden="true"></i>
		</button>
		<div class="navbar-brand navbar-brand-center site-gridmenu-toggle" data-toggle="gridmenu">
			<span class="navbar-brand-text hidden-xs-down"> X Home Car </span>
		</div>
	</div>

	<div class="navbar-container container-fluid">
		<!-- Navbar Collapse -->
		<div class="collapse navbar-collapse navbar-collapse-toolbar" id="site-navbar-collapse">
			<!-- Navbar Toolbar -->
			<ul class="nav navbar-toolbar">
				<li class="nav-item hidden-float" id="toggleMenubar">
					<a class="nav-link" data-toggle="menubar" href="#" role="button">
						<i class="icon hamburger hamburger-arrow-left">
							<span class="sr-only">Toggle menubar</span>
							<span class="hamburger-bar"></span>
						</i>
					</a>
				</li>
			</ul>
			<!-- End Navbar Toolbar -->

			<!-- Navbar Toolbar Right -->
			<ul class="nav navbar-toolbar navbar-right navbar-toolbar-right">
				<li class="nav-item dropdown">
					<a class="nav-link navbar-avatar" data-toggle="dropdown" href="#" aria-expanded="false" data-animation="scale-up" role="button">
						<span class="avatar avatar-online">
							<img src="assets/images/logo.png" alt="Administrator">
							<i></i>
						</span>
					</a>
					<div class="dropdown-menu" role="menu">
						<a class="dropdown-item" href="logout.php" role="menuitem"><i class="icon wb-power" aria-hidden="true"></i> Logout</a>
					</div>
				</li>		
			</ul>
			<!-- End Navbar Toolbar Right -->
		</div>
		<!-- End Navbar Collapse -->
	</div>
</nav>



<div class="site-menubar">
	<div class="site-menubar-body">
		<div>
			<div>
				<ul class="site-menu" data-plugin="menu">
					<?php if ($_SESSION['user']['group_id'] == 1) : ?>
						<li class="site-menu-item <?php echo ($current_file == 'index.php') ? 'active' : ''; ?>">
							<a class="animsition-link" href="index.php">
								<i class="site-menu-icon icon fa-home" aria-hidden="true"></i>
								<span class="site-menu-title">ระบบจัดการข้อมูล</span>
							</a>
						</li><li class="site-menu-item has-sub <?php echo ( in_array($current_file, array('slide.php', 'slide_add.php', 'slide_edit.php', 'video.php', 'video_edit.php') ) ) ? 'active open' : ''; ?>">
							<a href="javascript:void(0)">
								<i class="site-menu-icon icon fa-play-circle-o" aria-hidden="true"></i>
								<span class="site-menu-title">แบนเนอร์</span>
								<span class="site-menu-arrow"></span>
							</a>
							<ul class="site-menu-sub">
								<li class="site-menu-item <?php echo ( in_array($current_file, array('slide.php', 'slide_add.php', 'slide_edit.php') ) ) ? 'active' : ''; ?>">
									<a class="animsition-link" href="slide.php">
										<span class="site-menu-title">รูปภาพสไลด์</span>
									</a>
								</li>
								<li class="site-menu-item <?php echo ( in_array($current_file, array('video.php', 'video_edit.php') ) ) ? 'active' : ''; ?>">
									<a class="animsition-link" href="video.php">
										<span class="site-menu-title">วิดีโอ</span>
									</a>
								</li>
							</ul>
						</li>
						<li class="site-menu-item <?php echo ( in_array($current_file, array('article.php', 'article_add.php', 'article_edit.php') ) ) ? 'active' : ''; ?>">
							<a class="animsition-link" href="article.php">
								<i class="site-menu-icon icon fa-paper-plane" aria-hidden="true"></i>
								<span class="site-menu-title">บทความ</span>
							</a>
						</li>
						<li class="site-menu-item has-sub <?php echo ( in_array($current_file, array('product.php', 'product_add.php', 'product_edit.php', 'product-b.php', 'product-badd.php', 'product-bedit.php') ) ) ? 'active open' : ''; ?>">
							<a href="javascript:void(0)">
								<i class="site-menu-icon icon fa-car" aria-hidden="true"></i>
								<span class="site-menu-title">รถยนต์</span>
								<span class="site-menu-arrow"></span>
							</a>
							<ul class="site-menu-sub">
								<li class="site-menu-item <?php echo ( in_array($current_file, array('product.php', 'product_add.php', 'product_edit.php', 'product_detail.php') ) ) ? 'active' : ''; ?>">
									<a class="animsition-link" href="product.php">
										<span class="site-menu-title">รถใหม่</span>
									</a>
								</li>
								<li class="site-menu-item <?php echo ( in_array($current_file, array('product-b.php', 'product-badd.php', 'product-bedit.php') ) ) ? 'active' : ''; ?>">
									<a class="animsition-link" href="product-b.php">
										<span class="site-menu-title">ลูกค้าของเรา</span>
									</a>
								</li>
							</ul>
						</li>
						<li class="site-menu-item <?php echo ( in_array($current_file, array('customer.php', 'customer_add.php', 'customer_edit.php') ) ) ? 'active' : ''; ?>">
							<a class="animsition-link" href="customer.php">
								<i class="site-menu-icon icon fa-search-plus" aria-hidden="true"></i>
								<span class="site-menu-title">เสียงจากลูกค้า</span>
							</a>
						</li>
						<li class="site-menu-item <?php echo ( in_array($current_file, array('booking_all.php', 'booking_add.php', 'booking_edit.php', 'booking_detail.php') ) ) ? 'active' : ''; ?>">
							<a class="animsition-link" href="booking_all.php">
								<i class="site-menu-icon icon fa-book" aria-hidden="true"></i>
								<span class="site-menu-title">รายการจองรถ</span>
							</a>
						</li>
						<li class="site-menu-item <?php echo ( in_array($current_file, array('booking_history_foradmin.php') ) ) ? 'active' : ''; ?>">
							<a class="animsition-link" href="booking_history_foradmin.php">
								<i class="site-menu-icon icon fa-history" aria-hidden="true"></i>
								<span class="site-menu-title">รายการจองทั้งหมด</span>
							</a>
						</li>
						<li class="site-menu-item <?php echo ( in_array($current_file, array('user.php', 'user_add.php', 'user_edit.php') ) ) ? 'active' : ''; ?>">
							<a class="animsition-link" href="user.php">
								<i class="site-menu-icon icon fa-user-plus" aria-hidden="true"></i>
								<span class="site-menu-title">สมาชิก</span>
							</a>
						</li>

						<?php else : ?>  <!-- for sale -->
						<li class="site-menu-item <?php echo ( in_array($current_file, array('product.php', 'product_detail.php') ) ) ? 'active' : ''; ?>">
							<a class="animsition-link" href="product.php">
								<i class="site-menu-icon icon fa-car" aria-hidden="true"></i>
								<span class="site-menu-title">รถยนต์</span>
							</a>
						</li>
						<li class="site-menu-item <?php echo ( in_array($current_file, array('sale_customer.php', 'sale_customer_add.php', 'sale_customer_edit.php') ) ) ? 'active' : ''; ?>">
							<a class="animsition-link" href="sale_customer.php">
								<i class="site-menu-icon icon fa-user-plus" aria-hidden="true"></i>
								<span class="site-menu-title">รายชื่อลูกค้า</span>
							</a>
						</li>
						<li class="site-menu-item <?php echo ( in_array($current_file, array('booking.php', 'booking_add.php', 'booking_edit.php', 'booking_detail.php') ) ) ? 'active' : ''; ?>">
							<a class="animsition-link" href="booking.php">
								<i class="site-menu-icon icon fa-book" aria-hidden="true"></i>
								<span class="site-menu-title">การจองรถ</span>
							</a>
						</li>
						<li class="site-menu-item <?php echo ( in_array($current_file, array('booking_history.php') ) ) ? 'active' : ''; ?>">
							<a class="animsition-link" href="booking_history.php">
								<i class="site-menu-icon icon fa-history" aria-hidden="true"></i>
								<span class="site-menu-title">รายการจองทั้งหมด</span>
							</a>
						</li>
					<?php endif ?>

				</ul>
			</div>
		</div>
	</div>
	<div class="site-menubar-footer">
		<a href="logout.php" data-placement="top" data-toggle="tooltip" data-original-title="Logout">
			<span class="icon wb-power" aria-hidden="true"></span>
		</a>
	</div>
</div>