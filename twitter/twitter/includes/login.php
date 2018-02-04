<?php
if(isset($_POST['login']) && !empty($_POST['login'])){
  $email    = $_POST['email'];
  $password = $_POST['password'] ;
  if(!empty($email) or !empty($password)){
    $email = $getFromU ->checkInput($email);
    $password = $getFromU ->checkInput($password);

    if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
          $error = "Invalid Format" ;
    }else{
      if($getFromU->login($email, $password) === false){
        $error = "Parola veya email yanlış !" ;
      }
    }
  }else{
    $error = "Isminizi veya Sifrenizi Girin ! " ;
  }
}
?>

<div class="login-div">
<form method="post"> 
	<ul>
		<li>
		  <input type="text" name="email" placeholder="Lütfen Email Adresini Yaz"/>
		</li>
		<li>
		  <input type="password" name="password" placeholder="Şifreni Gir"/><input type="submit" name="login" value="Giriş Yap"/>
		</li>
		<li>
		  <input type="checkbox" Value="Remember me"> Beni Hatırla
		</li>
	</ul>
  <?php
  if(isset($error)){
    echo '<li class="error-li">
	  <div class="span-fp-error">'.$error.'</div>
	 </li>' ;
  }
  ?>
	  

	</form>
</div>