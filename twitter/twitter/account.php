<?php
  include 'core/init.php';

  $user_id = $_SESSION['user_id'];
  $user    = $getFromU->userData($user_id);

  if($getFromU->loggedIn() === false){    //Giriş Yapıldı mı kontrol et.
    header('Location: '.BASE_URL.'index.php');
  }


  if(isset($_POST['submit'])){    //kullanıcı adı ve email değiştirirken gerekli kontrolleri sağla!
    $username   = $getFromU->checkInput($_POST['username']);
    $email      = $getFromU->checkInput($_POST['email']);
    $error      = array();
    if(!empty($username) and !empty($email)){
      if($user->username != $username and $getFromU->checkUsername($username) === true){
          $error['username'] = "Bu kullanıcı adı alınamaz!";
      }else if(preg_match("/[^a-zA-Z0-9\!]", $username)){ //hangi karakterlerin kullanabileceğini belirle!
        $error['username'] = "Sadece harf ve sayılardan oluşmalı!";
      }else if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
          $error['email'] = "Geçersiz mail formatı!";
      }else if($user->email != $email and $getFromU->checkEmail($email) === true){
          $error['email'] = "Bu mail daha önce kullanılmış!";
      }else{
        $getFromU->update('users', $user_id, array('username' => $username, 'email' => $email));
        header('Location: '.BASE_URL.'settings/account');
      }
    }else{
      $error['fields'] = "Tüm boşluklar doldurulmalı!";
    }
  }
?>

<html>
	<head>
		<title>Kullanıcı Adı & Mail Değiştir</title>
		<meta charset="UTF-8" />
		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.6.3/css/font-awesome.css"/>
    <script src="https://code.jquery.com/jquery-1.10.2.js"></script>
    <link href="https://fonts.googleapis.com/css?family=Rokkitt" rel="stylesheet"/>
		<link rel="stylesheet" href="<?php echo BASE_URL;?>assets/css/style-complete.css"/>
	</head>
	<!--Helvetica Neue-->
<body>
<div class="wrapper">
<!-- header wrapper -->
<div class="header-wrapper">

<div class="nav-container">
  <!-- Nav -->
   <div class="nav">
		 <div class="nav-left">
			<ul>
				<li><a href="<?php echo BASE_URL;?>home.php"><i class="fa fa-home" aria-hidden="true"></i>Ana Sayfa</a></li>
 				<li><a href="<?php echo BASE_URL;?>i/notifications"><i class="fa fa-bell" aria-hidden="true"></i>Bildirimler</a></li>
				<li id="messagePopup" rel="user_id"><i class="fa fa-envelope" aria-hidden="true"></i>Mesajlar</li>
 			</ul>
		</div>
		<!-- nav left ends-->
		<div class="nav-right">
			<ul>
				<li><input type="text" placeholder="Search" class="search"/><i class="fa fa-search" aria-hidden="true"></i></li>
				<div class="nav-right-down-wrap">
					<ul class="search-result">
					
					</ul>
				</div>
 				<li class="hover"><label class="drop-label" for="drop-wrap1"><img src="<?php echo BASE_URL.$user->profileImage;?>"/></label>
				<input type="checkbox" id="drop-wrap1">
				<div class="drop-wrap">
					<div class="drop-inner">
						<ul>
							<li><a href="<?php echo BASE_URL.$user->username;?>"><?php echo $user->username;?></a></li>
							<li><a href="<?php echo BASE_URL;?>settings/account">Ayarlar</a></li>
							<li><a href="<?php echo BASE_URL;?>includes/logout.php">Çıkış Yap</a></li>
						</ul>
					</div>
				</div>
				</li>
				<li><label for="pop-up-tweet" class="addTweetBtn">Konu Yaz!</label></li>

			</ul>
		</div>
		<!-- nav right ends-->
 
	</div>
	<!-- nav ends -->

</div><!-- nav container ends -->
</div><!-- header wrapper end -->
		
	<div class="container-wrap">

		<div class="lefter">
			<div class="inner-lefter">

				<div class="acc-info-wrap">
					<div class="acc-info-bg">
						<!-- PROFILE-COVER -->
						<img src="<?php echo BASE_URL.$user->profileCover;?>"/>  
					</div>
					<div class="acc-info-img">
						<!-- PROFILE-IMAGE -->
						<img src="<?php echo BASE_URL.$user->profileImage;?>"/>
					</div>
					<div class="acc-info-name">
						<h3><?php echo $user->screenName;?></h3>
						<span><a href="<?php echo BASE_URL.$user->username;?>">@<?php echo $user->username;?></a></span>
					</div>
				</div><!--Acc info wrap end-->

				<div class="option-box">
					<ul> 
						<li>
							<a href="<?php echo BASE_URL;?>settings/account" class="bold"> <!-- Üstüne geldiğinde renklendirme işlemi-->
							<div>
								Hesap
 								<span><i class="fa fa-angle-right" aria-hidden="true"></i></span>
							</div>
							</a>
						</li>
						<li>
							<a href="<?php echo BASE_URL;?>profileEdit.php" class="bold"> <!-- Üstüne geldiğinde renklendirme işlemi-->
							<div>
							 Profilini Düzenle
 								<span><i class="fa fa-angle-right" aria-hidden="true"></i></span>
							</div>
							</a>
						</li>
						<li>
							<a href="<?php echo BASE_URL;?>settings/password"> <!-- Üstüne geldiğinde renklendirme işlemi-->
							<div>
								Şifre
								<span><i class="fa fa-angle-right" aria-hidden="true"></i></span>
							</div>
							</a>
						</li>
					</ul>
				</div>

			</div>
		</div><!--LEFTER ENDS-->
		
		<div class="righter">
			<div class="inner-righter">
				<div class="acc">
					<div class="acc-heading">
						<h2>Hesap</h2>
						<h3>Temel ayarları değiştirin!</h3>
					</div>
					<div class="acc-content">
					<form method="POST">
						<div class="acc-wrap">
							<div class="acc-left">
								Kullanıcı Adı
							</div>
							<div class="acc-right">
								<input type="text" name="username" value="<?php echo $user->username;?>"/>
								<span>
                <?php if(isset($error['username'])) {echo $error['username'];}?> <!--  Kullanıcı Adı Yazıldı mı?-->
								</span>
							</div>
						</div>

						<div class="acc-wrap">
							<div class="acc-left">
								Email
							</div>
							<div class="acc-right">
								<input type="text" name="email" value="<?php echo $user->email;?>"/> 
								<span>
									<?php if(isset($error['email'])) {echo $error['email'];}?>   <!-- Mail alanı dolduruldu mu? ? -->
								</span>
							</div>
						</div>
						<div class="acc-wrap">
							<div class="acc-left">
								
							</div>
							<div class="acc-right">
								<input type="Submit" name="submit" value="Save changes"/>
							</div>
							<div class="settings-error">
              <?php if(isset($error['fields'])) {echo $error['fields'];}?> <!-- Alanlar dolduruldu mu ? --> 
   							</div>	
						</div>
					</form>
					</div>
				</div>
				<div class="content-setting">
					<div class="content-heading">
						
					</div>
					<div class="content-content">
						<div class="content-left">
							
						</div>
						<div class="content-right">
							
						</div>
					</div>
				</div>
			</div>	
		</div><!--RIGHTER ENDS-->

	</div>
	<!--CONTAINER_WRAP ENDS-->

	</div><!-- ends wrapper -->
</body>

</html>

