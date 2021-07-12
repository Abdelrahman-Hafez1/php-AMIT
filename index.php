<?php session_start();?>
<?php require 'admin/includes/config.php'?>
<?php include 'includes/header.php';?>
<!--[if lt IE 7]>
<p class="browsehappy">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> to improve your experience.</p>
<![endif]-->
<?php
	$page='';
    if(isset($_GET['page'])){
        $page=$_GET['page'];
    }else{
        $page=1;
    }
?>



<!-- Start Loading -->
<section class="loading-overlay">
	<div class="Loading-Page">
		<h1 class="loader">Loading...</h1>
	</div>
</section>
<!-- End Loading  -->

<!-- start header -->
<header>
	<!-- Top bar starts -->
	<div class="top-bar">
		<div class="container">
			<!-- if user login -->
			<?php if(isset($_SESSION['USER_NAME'])):?>
				<!-- dropDown login user starts -->
				<div class="tb-shopping-cart pull-left">
				<!-- Link with badge -->
				<a href="#" class="btn btn-white btn-xs b-dropdown"><i class="fa fa-user"></i> <i class="fa fa-angle-down color"></i></a>
				<!-- Dropdown content with item details -->
				<div class="b-dropdown-block left">
					<!-- Heading -->
					<h4> Hello <?=$_SESSION['FULL_NAME']?></h4>
					<ul class="list-unstyled">
						<!-- Item 1 -->
						<li>
							<!-- Item image -->
							<div class="">
								<a href="#">Profile</a>
							</div>
							
							<div class="clearfix"></div>
						</li>
						<!-- Item 2 -->
						<?php if($_SESSION['ROLE']!=0):?>
						<li>
							<div class="">
								<a href="admin/index.php">Dashboard</a>
							</div>
							
							<div class="clearfix"></div>
						</li>
						<?php endif?>
						<li>
							<div class="">
								<a href="logout.php">LogOut</a>
							</div>
							
							<div class="clearfix"></div>
						</li>
					</ul>
				</div>
			</div>
			<?php else:?>
			<!-- Contact starts -->
			<div class="tb-contact pull-left">
				<!-- Email -->
				<i class="fas fa-sign-in-alt"></i> &nbsp; <a href="signin.php">login</a>
				&nbsp;&nbsp;
				<!-- Phone -->
				<i class="fas fa-user-plus"></i> &nbsp; <a href="">Sign In</a>
			</div>
			<!-- Contact ends -->
			<?php endif?>

			<!-- Shopping kart starts -->
			<div class="tb-shopping-cart pull-right">
				<!-- Link with badge -->
				<a href="#" class="btn btn-white btn-xs b-dropdown"><i class="fa fa-shopping-cart"></i> <i class="fa fa-angle-down color"></i> <span class="badge badge-color">2</span></a>
				<!-- Dropdown content with item details -->
				<div class="b-dropdown-block">
					<!-- Heading -->
					<h4><i class="fa fa-shopping-cart color"></i> Your Items</h4>
					<ul class="list-unstyled">
						<!-- Item 1 -->
						<li>
							<!-- Item image -->
							<div class="cart-img">
								<a href="#"><img src="img/ecommerce/view-cart/1.png" alt="" class="img-responsive" /></a>
							</div>
							<!-- Item heading and price -->
							<div class="cart-title">
								<h5><a href="#">Premium Quality Shirt</a></h5>
								<!-- Item price -->
								<span class="label label-color label-sm">$1,90</span>
							</div>
							<div class="clearfix"></div>
						</li>
						<!-- Item 2 -->
						<li>
							<div class="cart-img">
								<a href="#"><img src="img/ecommerce/view-cart/2.png" alt="" class="img-responsive" /></a>
							</div>
							<div class="cart-title">
								<h5><a href="#">Premium Quality Shirt</a></h5>
								<span class="label label-color label-sm">$1,20</span>
							</div>
							<div class="clearfix"></div>
						</li>
					</ul>
					<a href="#" class="btn btn-white btn-sm">View Cart</a> &nbsp; <a href="#" class="btn btn-color btn-sm">Checkout</a>
				</div>
			</div>
			<!-- Shopping kart ends -->

			<!-- Langauge starts -->
			<div class="tb-language dropdown pull-right">
				<a href="#" data-target="#" data-toggle="dropdown"><i class="fa fa-globe"></i> English <i class="fa fa-angle-down color"></i></a>
				<!-- Dropdown menu with languages -->
				<ul class="dropdown-menu dropdown-mini" role="menu">
					<li><a href="#">Germany</a></li>
					<li><a href="#">France</a></li>
					<li><a href="#">Brazil</a></li>
				</ul>
			</div>
			<!-- Language ends -->

			<!-- Search section for responsive design -->
			<div class="tb-search pull-left">
				<a href="#" class="b-dropdown"><i class="fa fa-search square-2 rounded-1 bg-color white"></i></a>
				<div class="b-dropdown-block">
					<form>
						<!-- Input Group -->
						<div class="input-group">
							<input type="text" class="form-control" placeholder="Type Something">
									<span class="input-group-btn">
										<button class="btn btn-color" type="button">Search</button>
									</span>
						</div>
					</form>
				</div>
			</div>
			<!-- Search section ends -->

			<!-- Social media starts -->
			<div class="tb-social pull-right">
				<div class="brand-bg text-right">
					<!-- Brand Icons -->
					<a href="#" class="facebook"><i class="fa fa-facebook square-2 rounded-1"></i></a>
					<a href="#" class="twitter"><i class="fa fa-twitter square-2 rounded-1"></i></a>
					<a href="#" class="google-plus"><i class="fa fa-google-plus square-2 rounded-1"></i></a>
				</div>
			</div>
			<!-- Social media ends -->

			<div class="clearfix"></div>
		</div>
	</div>

	<!-- Top bar ends -->

	<!-- Header One Starts -->
	<div class="header-1">

		<!-- Container -->
		<div class="container">
			<div class="row">
				<div class="col-md-4 col-sm-4">
					<!-- Logo section -->
					<div class="logo">
						<h1><a href="index.html"><i class="fa fa-bookmark-o"></i> LookCare</a></h1>
					</div>
				</div>
				<div class="col-md-6 col-md-offset-2 col-sm-5 col-sm-offset-3 hidden-xs">
					<!-- Search Form -->
					<div class="header-search">
						<form>
							<!-- Input Group -->
							<div class="input-group">
								<input type="text" class="form-control" placeholder="Type Something">
										<span class="input-group-btn">
											<button class="btn btn-color" type="button">Search</button>
										</span>
							</div>
						</form>
					</div>
				</div>
			</div>
		</div>

		<!-- Navigation starts -->

		<div class="navi">
			<div class="container">
				<div class="navy">
					<ul>
						<!-- Main menu -->
						<li><a href="#">Home</a>
							<!-- Submenu -->
							<ul>

								<li><a href="index.html">Home 1</a></li>
								<li><a href="index-2.html"><span>Home 2</span></a></li>
								<li><a href="index-3.html"><span>Home 3</span></a></li>

							</ul>
						</li>

						<li><a href="#">Features</a>
							<ul>
								<li><a href="#">Footer</a>
									<ul>
										<li><a href="footer-one.html">Footer1</a></li>
										<li><a href="footer-two.html">Footer2</a></li>
										<li><a href="footer-three.html">Footer3</a></li>
									</ul>
								</li>
								<li><a href="#">Price Table</a>
									<ul>
										<li><a href="price-table-one.html">Price Table1</a></li>
										<li><a href="price-table-two.html">Price Table2</a></li>

									</ul>
								</li>

							</ul>
						</li>

						<li><a href="#">Category</a>
							<ul>
								<li><a href="#">Laptop</a>
									<ul>
										<li><a href="#">Vaio</a></li>
										<li><a href="#">Samsung</a></li>
										<li><a href="#">Toshiba</a></li>
										<li><a href="#">HP</a></li>

									</ul>
								</li>
								<li><a href="#">Smartphone</a>
									<ul>
										<li><a href="#">Iphone</a></li>
										<li><a href="#">Oppo</a></li>
										<li><a href="#">Nokia</a></li>
										<li><a href="#">Sony</a></li>
										<li><a href="#">Samsung</a></li>

									</ul>
								</li>
								<li><a href="#">Accessories</a>
									<ul>
										<li><a href="#">Headphone</a></li>
										<li><a href="#">Adapter</a></li>
										<li><a href="#">Bag</a></li>
										<li><a href="#">Baby doll</a></li>

									</ul>
								</li>
								<!-- Multi level menu -->
								<li><a href="#">Multi Level Menu</a>
									<ul>
										<!-- Sub menu -->
										<li><a href="#">Menu #1</a></li>
										<li><a href="#">Menu #1</a></li>
										<li><a href="#">Menu #1</a>
											<ul>
												<!-- Sub menu -->
												<li><a href="#">Menu #2</a></li>
												<li><a href="#">Menu #2</a></li>
												<li><a href="#">Menu #2</a>
													<ul>
														<!-- Sub menu -->
														<li><a href="#">Menu #3</a></li>
														<li><a href="#">Menu #3</a></li>
														<li><a href="#">Menu #3</a></li>
													</ul>
												</li>
											</ul>
										</li>
									</ul>
								</li>
							</ul>
						</li>

						<li><a href="#">Blog</a>
							<ul>
								<li><a href="blog.html"><span>Blog Default</span></a></li>
								<li><a href="blog-masonry.html"><span>Blog Masonry</span></a></li>
								<li><a href="blog-full-width.html"><span>Blog Full Width</span></a></li>
								<li><a href="single-post.html"><span>Single Page 1</span></a></li>
								<li><a href="single-post-v2.html"><span>Single Page 2</span></a></li>
							</ul>
						</li>

						<li><a href="#">Pages</a>
							<ul>
								<li><a href="shop.html"><span>Shop</span></a></li>
								<li><a href="single-product.html"><span>Single product</span></a></li>
								<li><a href="shopping-cart.html"><span>Cart</span></a></li>
								<li><a href="checkout.html"><span>Checkout</span></a></li>
								<li><a href="wishlist.html"><span>Wishlist</span></a></li>
								<li><a href="signin.html"><span>Sign In</span></a></li>
								<li><a href="signup.html"><span>Sign Up</span></a></li>
								<li><a href="404.html"><span>404 Page</span></a></li>
							</ul>
						</li>

						<li><a href="about.html">About Us</a></li>
						<li><a href="contact.html">Contact Us</a></li>
					</ul>
				</div>
			</div>
		</div>

		<!-- Navigation ends -->

	</div>

	<!-- Header one ends -->

</header>
<!-- end header -->

<!-- start main content -->
<main class="main-container">

	<!-- new collection directory -->
	<section id="content-block" class="slider_area">
		<div class="container">
			<div class="content-push">
				<div class="row">

					<div class="col-md-3 col-md-push-9">
						<div class="sidebar-navigation">
							<div class="title">Product Categories<i class="fa fa-angle-down"></i></div>
							<div class="list">
								<a class="entry" href="#"><span><i class="fa fa-angle-right"></i>Evening dresses</span></a>
								<a class="entry" href="#"><span><i class="fa fa-angle-right"></i>Jackets and coats</span></a>
								<a class="entry" href="#"><span><i class="fa fa-angle-right"></i>Tops and Sweatshirts</span></a>
								<a class="entry" href="#"><span><i class="fa fa-angle-right"></i>Blouses and shirts</span></a>
								<a class="entry" href="#"><span><i class="fa fa-angle-right"></i>Trousers and Shorts</span></a>
								<a class="entry" href="#"><span><i class="fa fa-angle-right"></i>Evening dresses</span></a>
								<a class="entry" href="#"><span><i class="fa fa-angle-right"></i>Jackets and coats</span></a>
								<a class="entry" href="#"><span><i class="fa fa-angle-right"></i>Tops and Sweatshirts</span></a>
								<a class="entry" href="#"><span><i class="fa fa-angle-right"></i>Blouses and shirts</span></a>
							</div>
						</div>
						<div class="clear"></div>
					</div>

					<div class="col-md-9 col-md-pull-3">

						<div class="header_slider">
							<article class="boss_slider">
								<div class="tp-banner-container">
									<div class="tp-banner tp-banner0">
										<ul>
											<!-- SLIDE  -->
											<?php
												$stmt=$con->prepare("SELECT * FROM products LIMIT 3");
												$stmt->execute();
												$products=$stmt->fetchAll();
											?>
											<?php foreach($products as $product):?>
												<li data-link="#" data-target="_self" data-transition="flyin" data-slotamount="7" data-masterspeed="500" data-saveperformance="on">
													<!-- MAIN IMAGE --><img src="admin/assests/imgs/<?=$product['image']?>" alt="slidebg1" data-bgposition="left center" data-kenburns="off" data-duration="14000" data-ease="Linear.easeNone" data-bgpositionend="right center" />
													<!-- LAYER NR. 1 -->
													<div class="tp-caption very_big_white randomrotate customout rs-parallaxlevel-0" data-x="270" data-y="140" data-customout="x:0;y:0;z:0;rotationX:0;rotationY:0;rotationZ:0;scaleX:0.75;scaleY:0.75;skewX:0;skewY:0;opacity:0;transformPerspective:600;transformOrigin:50% 50%;" data-speed="300" data-start="500" data-end="4800" data-endspeed="300" data-easing="easeInOutBack" data-endeasing="easeOutBack" data-elementdelay="0.1" data-endelementdelay="0.1" style="z-index: 2;"> Trendy </div>
													<!-- LAYER NR. 2 -->
													<div class="tp-caption very_large_white_text randomrotate customout rs-parallaxlevel-0" data-x="270" data-y="250" data-customout="x:0;y:0;z:0;rotationX:0;rotationY:0;rotationZ:0;scaleX:0.75;scaleY:0.75;skewX:0;skewY:0;opacity:0;transformPerspective:600;transformOrigin:50% 50%;" data-speed="300" data-start="800" data-end="4800" data-endspeed="300" data-easing="easeInOutBack" data-endeasing="easeOutBack" data-elementdelay="0.1" data-endelementdelay="0.1" style="z-index: 2;"> selection </div>
													<!-- LAYER NR. 3 -->
													<div class="tp-caption large_white_text randomrotate customout rs-parallaxlevel-0" data-x="355" data-y="363" data-customout="x:0;y:0;z:0;rotationX:0;rotationY:0;rotationZ:0;scaleX:0.75;scaleY:0.75;skewX:0;skewY:0;opacity:0;transformPerspective:600;transformOrigin:50% 50%;" data-speed="300" data-start="1200" data-end="4800" data-endspeed="300" data-easing="easeInOutBack" data-endeasing="easeOutBack" data-elementdelay="0.1" data-endelementdelay="0.1" style="z-index: 2;"> SHOP NOW </div>

												</li>
											<?php endforeach?>
											<!-- <li data-link="#" data-target="_self" data-transition="3dcurtain-horizontal" data-slotamount="7" data-masterspeed="500" data-saveperformance="on"> -->
												<!-- MAIN IMAGE <img src="img/dummy.png" alt="slidebg1" data-lazyload="img/slide/slider2.png" data-bgposition="left center" data-kenburns="off" data-duration="14000" data-ease="Linear.easeNone" data-bgpositionend="right center" />
												 LAYER NR. 1 
												<div class="tp-caption very_big_white fade customout rs-parallaxlevel-0" data-x="270" data-y="140" data-customout="x:0;y:0;z:0;rotationX:0;rotationY:0;rotationZ:0;scaleX:0.75;scaleY:0.75;skewX:0;skewY:0;opacity:0;transformPerspective:600;transformOrigin:50% 50%;" data-speed="300" data-start="500" data-end="4800" data-endspeed="300" data-easing="easeOutBack" data-endeasing="easeOutBack" data-elementdelay="0.1" data-endelementdelay="0.1" style="z-index: 2;"> Trendy </div>
												 LAYER NR. 2 
												<div class="tp-caption very_large_white_text fade customout rs-parallaxlevel-0" data-x="270" data-y="250" data-customout="x:0;y:0;z:0;rotationX:0;rotationY:0;rotationZ:0;scaleX:0.75;scaleY:0.75;skewX:0;skewY:0;opacity:0;transformPerspective:600;transformOrigin:50% 50%;" data-speed="300" data-start="800" data-end="4800" data-endspeed="300" data-easing="easeOutBack" data-endeasing="easeOutBack" data-elementdelay="0.1" data-endelementdelay="0.1" style="z-index: 2;"> selection </div>
												 LAYER NR. 3 
												<div class="tp-caption large_white_text fade customout rs-parallaxlevel-0" data-x="355" data-y="363" data-customout="x:0;y:0;z:0;rotationX:0;rotationY:0;rotationZ:0;scaleX:0.75;scaleY:0.75;skewX:0;skewY:0;opacity:0;transformPerspective:600;transformOrigin:50% 50%;" data-speed="300" data-start="1200" data-end="4800" data-endspeed="300" data-easing="easeOutBack" data-endeasing="easeOutBack" data-elementdelay="0.1" data-endelementdelay="0.1" style="z-index: 2;"> SHOP NOW </div>
											</li>
											<li data-transition="boxslide" data-slotamount="7" data-masterspeed="500" data-saveperformance="on">
												 MAIN IMAGE <img src="img/dummy.png" alt="slidebg1" data-lazyload="img/slide/slide_3.jpg" data-bgposition="left center" data-kenburns="off" data-duration="14000" data-ease="Linear.easeNone" data-bgpositionend="right center" />
												 LAYER NR. 1 
												<div class="tp-caption large_white_text skewfromleftshort customout rs-parallaxlevel-0" data-x="355" data-y="363" data-customout="x:0;y:0;z:0;rotationX:0;rotationY:0;rotationZ:0;scaleX:0.75;scaleY:0.75;skewX:0;skewY:0;opacity:0;transformPerspective:600;transformOrigin:50% 50%;" data-speed="300" data-start="1200" data-end="4800" data-endspeed="300" data-easing="easeOutBack" data-endeasing="easeOutBack" data-elementdelay="0.1" data-endelementdelay="0.1" style="z-index: 2;"> SHOP NOW </div>
												 LAYER NR. 2 
												<div class="tp-caption very_large_white_text skewfromleftshort customout rs-parallaxlevel-0" data-x="270" data-y="250" data-customout="x:0;y:0;z:0;rotationX:0;rotationY:0;rotationZ:0;scaleX:0.75;scaleY:0.75;skewX:0;skewY:0;opacity:0;transformPerspective:600;transformOrigin:50% 50%;" data-speed="300" data-start="800" data-end="4800" data-endspeed="300" data-easing="easeOutBack" data-endeasing="easeOutBack" data-elementdelay="0.1" data-endelementdelay="0.1" style="z-index: 2;"> selection </div>
												 LAYER NR. 3 
												<div class="tp-caption very_big_white skewfromleftshort customout rs-parallaxlevel-0" data-x="270" data-y="140" data-customout="x:0;y:0;z:0;rotationX:0;rotationY:0;rotationZ:0;scaleX:0.75;scaleY:0.75;skewX:0;skewY:0;opacity:0;transformPerspective:600;transformOrigin:50% 50%;" data-speed="300" data-start="500" data-end="4800" data-endspeed="300" data-easing="easeOutBack" data-endeasing="easeOutBack" data-elementdelay="0.1" data-endelementdelay="0.1" style="z-index: 2;"> Trendy </div>
											</li>
											-->

										</ul>
										<div class="slideshow_control"></div>
									</div><!-- /.tp-banner -->
								</div>
							</article>
						</div><!-- /.header_slider -->

						<div class="clear"></div>

					</div>

				</div>
			</div>
		</div>
	</section>
	<!-- end new collection directory -->



<section id="popular-product" class="ecommerce">
	<div class="container">
		<!-- Shopping items content -->
		<div class="shopping-content">
			<?php
				

				$limit=8;
				$offset=($page-1)*$limit;

				$stmt=$con->prepare("SELECT * FROM products");
				$stmt->execute();
				$count=$stmt->rowCount();
				$totalPages=intval(ceil($count/$limit));

				$stmt=$con->prepare("SELECT * FROM products LIMIT $offset,$limit");
				$stmt->execute();
				$products=$stmt->fetchAll();
			?>
			<!-- Block heading two -->
			<div class="block-heading-two">
				<h3><span>Popular Items</span></h3>
			</div>
			
			<div class="row">
				<?php foreach($products as $product):?>
					<div class="col-md-3 col-sm-6">
						<!-- Shopping items -->
						<div class="shopping-item">
							<!-- Image -->
							<a href="single-product.html?selection=<?=$product['id']?>"><img class="img-responsive" src="admin/assests/imgs/<?=$product['image']?>" alt="" /></a>
							<!-- Shopping item name / Heading -->
							<h4><a href="single-product.html?selection=<?=$product['id']?>"><?=$product['name']?></a><span class="color pull-right"><?=$product['price']?></span></h4>
							<div class="clearfix"></div>
							<!-- Buy now button -->
							<div class="visible-xs">
								<a class="btn btn-color btn-sm" href="#">Buy Now</a>
							</div>
							<!-- Shopping item hover block & link -->
							<div class="item-hover bg-color hidden-xs">
								<a href="#">Add to cart</a>
							</div>
						</div>
					</div>
				<?php endforeach?>
					
			</div>
			<!-- Pagination -->
			<div class="shopping-pagination pull-right">
				<ul class="pagination">
					<?php if($page==1):?>
						<li class="disabled"><a href="#">&laquo;</a></li>
					<?php else:?>
						<li><a href="?page=<?=$page-1?>">&laquo;</a></li>
					<?php endif?>

					<?php for($i=1;$i<=$totalPages;$i++):?>
						<?php if($i==$page):?>
							<li class="active"><a href="#"> <?=$i?> </a></li>
						<?php else:?>
							<li><a href="#"><?=$i?></a></li>
						<?php endif?>
					<?php endfor?>

					<?php if($page==$totalPages):?>
						<li class="disabled"><a href="">&raquo;</a></li>
					<?php else:?>
						<li><a href="?page=<?=$page+1?>">&raquo;</a></li>
					<?php endif?>
				</ul>
			</div>
			<!-- Pagination end-->
		</div>
	</div>
</section>


	<!-- Start Our Shop Items -->

	<!-- Recent items Starts -->
	<section id="recent-product">
		<div class="container">
			<div class="row">
				<div class="col-md-12">
					<section class="related-products">



						<!-- Block heading two -->
						<div class="block-heading-two">
							<h3><span>Recommended Items</span></h3>
						</div>

						<div class="related-products-wrapper">

							<div class="related-products-carousel">

								<div class="product-control-nav">
									<a class="prev"><i class="fa fa-angle-left"></i></a>
									<a class="next"><i class="fa fa-angle-right"></i></a>
								</div>


								<div class="row product-listing">
									<div id="product-carousel" class="product-listing">

										<div class="product  item first ">

											<article>


												<figure>
													<a href="#">
														<img src="img/temp-images/T_2_front-300x300.jpg" class="img-responsive" alt="T_2_front">
													</a>
													<figcaption><span class="amount">$20.00</span></figcaption>
												</figure>

												<h4 class="title"><a href="#">Premium Quality</a></h4>


												<a href="#" class="button-add-to-cart">Add to cart</a>
											</article>

										</div>

										<div class="product  item first ">

											<article>


												<figure>
													<a href="#">
														<img src="img/temp-images/T_5_front-300x300.jpg" class="img-responsive " alt="T_5_front">
													</a>
													<figcaption><span class="amount">$20.00</span></figcaption>
												</figure>


												<h4 class="title"><a href="#">Ninja Silhouette</a></h4>


												<a href="#" class="button-add-to-cart">Add to cart</a>
											</article>

										</div>

										<div class="product  item first ">

											<article>


												<figure>
													<a href="#">
														<img src="img/temp-images/hoodie_2_front-300x300.jpg" class="img-responsive" alt="hoodie_2_front">
													</a>
													<figcaption><span class="amount">$35.00</span></figcaption>
												</figure>




												<h4 class="title"><a href="#">Woo Ninja</a></h4>


												<a href="#" class="button-add-to-cart">Add to cart</a>
											</article>

										</div>

										<div class="product  item first ">

											<article>


												<figure>
													<a href="#">
														<img src="img/temp-images/T_4_front-300x300.jpg" class="img-responsive" alt="T_4_front">
													</a>
													<figcaption>
														<span class="amount">$20.00</span></figcaption>
												</figure>




												<h4 class="title"><a href="#">Ship Your Idea</a></h4>


												<a href="#" class="button-add-to-cart">Add to cart</a>
											</article>

										</div>

										<div class="product  item first ">

											<article>


												<figure>
													<a href="#">
														<img src="img/temp-images/T_7_front-300x300.jpg" class="img-responsive" alt="T_7_front">
													</a>
													<figcaption><span class="amount">$18.00</span></figcaption>
												</figure>




												<h4 class="title"><a href="#">Happy Ninja</a></h4>


												<a href="#" class="button-add-to-cart">Add to cart</a>
											</article>

										</div>

										<div class="product  item first ">

											<article>


												<figure>
													<a href="#">
														<img src="img/temp-images/T_6_front-300x300.jpg" class="img-responsive" alt="T_6_front">
													</a>
													<figcaption><span class="amount">$20.00</span></figcaption>
												</figure>




												<h4 class="title"><a href="#">Woo Ninja</a></h4>


												<a href="#" class="button-add-to-cart">Add to cart</a>
											</article>

										</div>

										<div class="product  item first ">

											<article>


												<figure>
													<a href="#">
														<img src="img/temp-images/hoodie_4_front-300x300.jpg" class="img-responsive" alt="hoodie_4_front">
													</a>
													<figcaption><span class="amount">$35.00</span></figcaption>
												</figure>




												<h4 class="title"><a href="#">Happy Ninja</a></h4>


												<a href="#" class="button-add-to-cart">Add to cart</a>
											</article>

										</div>

										<div class="product  item first ">

											<article>


												<figure>
													<a href="#">
														<img src="img/temp-images/hoodie_3_front-300x300.jpg" class="img-responsive" alt="hoodie_3_front">
													</a>
													<figcaption><span class="amount">$35.00</span></figcaption>
												</figure>




												<h4 class="title"><a href="#">Patient Ninja</a></h4>


												<a href="#" class="button-add-to-cart">Add to cart</a>
											</article>

										</div>
									</div>

								</div>
							</div>

						</div>

					</section>
				</div>
			</div>
		</div>
	</section>

	<!-- Recent items Ends -->


	<div class="bt-block-home-parallax" style="background-image: url(img/resource/parallax2.jpg);">
		<div class="container">
			<div class="row">
				<div class="col-md-12">
					<div class="lookbook-product">
						<h2><a href="#" title="">Collection 2016 </a></h2>
						<ul class="simple-cat-style">
							<li><a href="#" title="">Dresses</a></li>
							<li><a href="#" title="">Coats & Jackets</a></li>
							<li><a href="#" title="">Jeans</a></li>
						</ul>
						<a href="#" title="">read more</a>
					</div>
				</div>
			</div>
		</div>
	</div><!-- /.bt-block-home-parallax -->

	<!-- Start Our Clients -->

	<section id="Clients" class="light-wrapper">
		<div class="container inner">
			<div class="row">
				<div class="Last-items-shop col-md-3 col-sm-6">

					<!-- Block heading two -->
					<div class="block-heading-two block-heading-three">
						<h3><span>Special Offer</span></h3>
					</div>
					<!--<div class="Top-Title-SideBar">
						<h3>Special Offer</h3>
					</div>-->
					<div class="Last-post">
						<ul class="shop-res-items">
							<li>
								<a href="#"><img src="img/small/50.jpg" alt=""></a>
								<h6><a href="#">Stockholm Chair high Mosta gruancy</a></h6>
								<span class="sale-date">$28.00</span>
							</li>
							<li>
								<a href="#"><img src="img/small/51.jpg" alt=""></a>
								<h6><a href="#">Stockholm Chair high Mosta gruancy</a></h6>
								<span class="sale-date">$40.00</span>
							</li>
							<li>
								<a href="#"><img src="img/small/52.jpg" alt=""></a>
								<h6><a href="#">Stockholm Chair high Mosta gruancy</a></h6>
								<span class="sale-date">$150.00</span>
							</li>
						</ul>
					</div>
				</div>
				<div class="Last-items-shop col-md-3 col-sm-6">
					<!-- Block heading two -->
					<div class="block-heading-two block-heading-three">
						<h3><span>Best Sellers</span></h3>
					</div>
					<!--<div class="Top-Title-SideBar">
						<h3>Best Sellers</h3>
					</div>-->
					<div class="Last-post">
						<ul class="shop-res-items">
							<li>
								<a href="#"><img src="img/small/53.jpg" alt=""></a>
								<h6><a href="#">Stockholm Chair high Mosta gruancy</a></h6>
								<span class="sale-date">$28.00</span>
							</li>
							<li>
								<a href="#"><img src="img/small/54.jpg" alt=""></a>
								<h6><a href="#">Stockholm Chair high Mosta gruancy</a></h6>
								<span class="sale-date">$40.00</span>
							</li>
							<li>
								<a href="#"><img src="img/small/55.jpg" alt=""></a>
								<h6><a href="#">Stockholm Chair high Mosta gruancy</a></h6>
								<span class="sale-date">$150.00</span>
							</li>
						</ul>
					</div>
				</div>
				<div class="Last-items-shop col-md-3 col-sm-6">
					<!-- Block heading two -->
					<div class="block-heading-two block-heading-three">
						<h3><span>Featured</span></h3>
					</div>
					<!--<div class="Top-Title-SideBar">
						<h3>Featured</h3>
					</div>-->
					<div class="Last-post">
						<ul class="shop-res-items">
							<li>
								<a href="#"><img src="img/small/56.jpg" alt=""></a>
								<h6><a href="#">Stockholm Chair high Mosta gruancy</a></h6>
								<span class="sale-date">$28.00</span>
							</li>
							<li>
								<a href="#"><img src="img/small/57.jpg" alt=""></a>
								<h6><a href="#">Stockholm Chair high Mosta gruancy</a></h6>
								<span class="sale-date">$40.00</span>
							</li>
							<li>
								<a href="#"><img src="img/small/55.jpg" alt=""></a>
								<h6><a href="#">Stockholm Chair high Mosta gruancy</a></h6>
								<span class="sale-date">$150.00</span>
							</li>
						</ul>
					</div>
				</div>
				<div class="Last-items-shop col-md-3 col-sm-6">
					<!-- Block heading two -->
					<div class="block-heading-two block-heading-three">
						<h3><span>Sales</span></h3>
					</div>
					<!--<div class="Top-Title-SideBar">
						<h3>Sales</h3>
					</div>-->
					<div class="Last-post">
						<ul class="shop-res-items">
							<li>
								<a href="#"><img src="img/small/55.jpg" alt=""></a>
								<h6><a href="#">Stockholm Chair high Mosta gruancy</a></h6>
								<span class="sale-date">$28.00</span>
							</li>
							<li>
								<a href="#"><img src="img/small/58.jpg" alt=""></a>
								<h6><a href="#">Stockholm Chair high Mosta gruancy</a></h6>
								<span class="sale-date">$40.00</span>
							</li>
							<li>
								<a href="#"><img src="img/small/50.jpg" alt=""></a>
								<h6><a href="#">Stockholm Chair high Mosta gruancy</a></h6>
								<span class="sale-date">$150.00</span>
							</li>
						</ul>
					</div>
				</div>

			</div>
		</div>
	</section>

	<!-- End Our Clients  -->

</main>
<!-- end main content -->



<!-- start footer area -->
<?php include 'includes/footer.php'?>


<?php include 'includes/jsFiles.php'?>


</body>


</html>