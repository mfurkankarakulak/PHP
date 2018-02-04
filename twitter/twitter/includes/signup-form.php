<?php
	if(isset($_POST['signup'])){
		$screenName = $_POST['screenName'];
		$password 	= $_POST['password'];
		$email 		= $_POST['email'];
		$error 		= '';
		if(empty($screenName) or empty($password) or empty($email)){
			$error = 'Tüm Alanların Doldurulması Zorunludur' ;
		}else{
			$email = $getFromU->checkInput($email) ;
			$screenName = $getFromU->checkInput($screenName) ;
			$password = $getFromU->checkInput($password) ;

			if(!filter_var($email)){
				$error = 'O ne biçim email ?' ;
			}else if(strlen($screenName) > 20){
				$error = 'Isim 6 ile 20 Karakter Arasında Olmak Zorunda';
			}else if(strlen($password) < 5){
				$error = 'Parola Çok Kısa Değil mi sence de?' ;
			}else{
				if($getFromU->checkEmail($email) === true){ // user.php ' de kayıtlı fonksiyon
					$error = 'Emailini Birileri Kullanıyor' ; 
				}else{
					$user_id = $getFromU->create('users', array('email' => $email, 'password' => md5($password), 'screenName' => $screenName, 'profileImage' => 'assets/images/defaultProfileImage.png' , 'profileCover' => 'assets/images/defaultProfileCover.png')) ;
					$_SESSION['user_id'] = $user_id ;
					header('Location: includes/signup.php?step=1');
				}
			}
		}
	}
?>

<form method="post">
<div class="signup-div"> 
	<h3>Kayıt Ol </h3>
	<ul>
		<li>
		    <input type="text" name="screenName" placeholder="Kullanıcı Adı"/>
		</li>
		<li>
		    <input type="email" name="email" placeholder="Email"/>
		</li>
		<li>
			<input type="password" name="password" placeholder="Şifren"/>
		</li>
		<li>
			<input type="submit" name="signup" Value="Twittere Kayıt Ol">
		</li>
		<?php
		if(isset($error)){
			echo '<li class="error-li">
			<div class="span-fp-error">'.$error.'</div>
		   </li> ';
		}
		?>
	</ul>
	 
</div>
</form>