<?php
  include '../core/init.php';
  $user_id = $_SESSION['user_id'];
  $user = $getFromU->userData($user_id);

  if(isset($_GET['step']) === true && empty($_GET['step']) === false){
    if(isset($_POST['next'])){
      $username = $getFromU->checkInput($_POST['username']);

      if(!empty($username)){
        if(strlen($username) > 20){
          $error = "İsim 6-20 karakter arasında olmak zorunda !" ;
        }else if($getFromU->checkUsername($username) === true){
            $error = "Username is already teken!";
        }else{
					$getFromU->update('users', $user_id, array('username' => $username));
					header('Location: signup.php?step=2 ');
        }
      }else{
        $error = "Please enter your username to choose";
      }
    }
    ?>
      <!doctype html>
<html>
	<head>
		<title>twitter</title>
		<meta charset="UTF-8" />
 		<link rel="stylesheet" href="assets/css/font/css/font-awesome.css"/>
		<link rel="stylesheet" href="../assets/css/style-complete.css"/>
		<link href="https://fonts.googleapis.com/css?family=Paytone+One" rel="stylesheet"/>
		<link href="https://fonts.googleapis.com/css?family=Saira+Semi+Condensed" rel="stylesheet"/>
	</head>
	<!--Helvetica Neue-->
<body>
<div class="wrapper">
<!-- nav wrapper -->
<div class="nav-wrapper">
	
	<div class="nav-container">	
		<div class="nav-second">
			<ul>
				<li><a href="#"<i class="fa fa-twitter" aria-hidden="true"></i></a></li>							
			</ul>
		</div><!-- nav second ends-->
	</div><!-- nav container ends -->

</div><!-- nav wrapper end -->

<!---Inner wrapper-->
<div class="inner-wrapper">
	<!-- main container -->
	<div class="main-container">
		<!-- step wrapper-->
<?php if($_GET['step'] == '1'){?>
 		<div class="step-wrapper">
		    <div class="step-container">
				<form method="post">
					<h2>Şimdi İsmini Seçme Zamanı!</h2>
					<h0><div align="center"><p>Unutma! İsmini istediğin zaman değiştirebilirsin!</p> </div></h0>
					<div>
						<input type="text" name="username" placeholder="Kullanıcı Adı"/>
					</div>
					<div>
						<ul>
						  <li><?php if(isset($error)){echo $error;}?></li>
						</ul>
					</div>
					<div>
						<input type="submit" name="next" value="Next"/>
					</div>
				 </form>
			</div>
		</div>
  <?php }?>
  <?php if($_GET['step'] == '2'){?>
	<div class='lets-wrapper'>
		<div class='step-letsgo'>
			<h2>Seni aramızda görmekten dolayı çok mutluyuz, <?php echo $user->screenName;?></h2>
			<p>	&nbsp	Dereden geldim, tepeden geldim, sandığa girdim bir de ne göreyim, köşede bir hanım 
					oturuyor. Şöyle ettim, böyle ettim, hanım yerinden kalktı, yüzüme baktı, çıktık.birlikte yola, 
					ne sağa saptık,ne sola... Az gittik.uz gittik., dere tepe düz gittik, altı ay bir güz gittik, bir de 
					arkamıza baktık ki bir arpa boyu yer gitmişiz... Ne dönülür geri, ne gidilir ileri...</p>
			<br/>
			<p>
				Güzel bi tanıtım yazısı yazılacak buraya.
			</p>
			<span>
				<a href='../home.php' class='backButton'>Devam et!</a>
			</span>
		</div>
	</div>
<?php }?>
		
	</div><!-- main container end -->

</div><!-- inner wrapper ends-->
</div><!-- ends wrapper -->

</body>
</html>
	
    <?php
  }
?>