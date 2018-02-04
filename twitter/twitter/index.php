<?php
	include 'core/init.php' ;
	if(isset($_SESSION['user_id'])){
		header('Location: home.php');
	}
?>


<html>
	<head>
		<title>Twitter</title>
		<meta charset="UTF-8" />
		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.6.3/css/font-awesome.css"/>
		<link href="https://fonts.googleapis.com/css?family=Vollkorn+SC" rel="stylesheet"/>
		<link rel="stylesheet" href="assets/css/style-complete.css"/>
		<link href="https://fonts.googleapis.com/css?family=Rokkitt" rel="stylesheet"/>
	</head>
	<!--Helvetica Neue-->
<body>
<div class="front-img">
	<img src="assets/images/background.jpg"></img>
</div>	

<div class="wrapper">
<!-- header wrapper -->
<div class="header-wrapper">
	
	<div class="nav-container">
		<!-- Nav -->
		<div class="nav">
			
			<div class="nav-left">
				<ul>
					<li><i class="fa fa-twitter" aria-hidden="true"></i><a href="#">Ana Sayfa</a></li>
					<li><a href="#">Hakkımızda</a></li>
				</ul>
			</div><!-- nav left ends-->

			<div class="nav-right">
				<ul>
					<li><a href="#">KTU</a></li>
				</ul>
			</div><!-- nav right ends-->

		</div><!-- nav ends -->

	</div><!-- nav container ends -->

</div><!-- header wrapper end -->
	
<!---Inner wrapper-->
<div class="inner-wrapper">
	<!-- main container -->
	<div class="main-container">
		<!-- content left-->
		<div class="content-left">
			<h1>Hoşgeldiniz</h1>
			<br/>
			<p>Buraya Açıklama Kısmı Eklenecek</p>
		</div><!-- content left ends -->	

		<!-- content right ends -->
		<div class="content-right">
			<!-- Log In Section -->
			<div class="login-wrapper">
			  <?php include 'includes/login.php' ?>
			</div><!-- log in wrapper end -->

			<!-- SignUp Section -->
			<div class="signup-wrapper">
			<?php include 'includes/signup-form.php' ?>
			</div>
			<!-- SIGN UP wrapper end -->

		</div><!-- content right ends -->

	</div><!-- main container end -->

</div><!-- inner wrapper ends-->
</div><!-- ends wrapper -->
</body>
</html>
