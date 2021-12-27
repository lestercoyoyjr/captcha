<?php
    // Here with POST method we're gonna check if we can send data from our site
    if(!empty($_POST)){
        $name = $_POST['name'];
		$password = $_POST['password'];
        // this "g-recaptcha" is called from the class "g-recaptcha" in the html section but we add response because it will be added as a new element
		$captcha = $_POST['g-recaptcha-response'];

        // $secret = 'aqui va la clave secreta';
        $secret = "6LdLms4dAAAAAIclRzFZXvMEuF698iPASlG9GYfl";

        // to verify the captcha is correct
        if(!$captcha){
            echo "Por favor verifica el captcha";
        } else {
			
            // check from google side everything is working as expected
			$response = file_get_contents("https://www.google.com/recaptcha/api/siteverify?secret=$secret&response=$captcha");
			
            // verify data is correct
            // var_dump($response);

            // so we can read the google response and we can know what it means
			$arr = json_decode($response, TRUE);
			
            // validate response
			if($arr['success'])
			{
				echo '<h2>Thanks</h2>';
				} else {
				echo '<h3>Error al comprobar Captcha </h3>';
			}
		}

        
        $response = file_get_contents("https://www.google.com/recaptcha/api/siteverify?secret=$secret&response=$captcha");

        // verify data is correct
        var_dump($response);
    }
?>

<!--Html to see the result-->
<html>
	<head>
		<title>Google Recapcha</title>
		<!--The api we need to add to call to captcha-->
		<script src='https://www.google.com/recaptcha/api.js'></script>
		
	</head>
	<body>
        <!--Here we can send the info to the file we it supposses it will check validation-->	
		<form id="form" action="<?php $_SERVER['PHP_SELF']; ?>" method="POST">
			Usuario: <input type="text" name="name">
			<br><br>
			Password: <input type="password" name="password">
			<br><br>

            <!--This is to show the captcha from the API called in the header-->
            <!-- <div class="g-recaptcha" data-sitekey="aqui va la clave del sitio"></div> -->
			<div class="g-recaptcha" data-sitekey="6LdLms4dAAAAABlrx6iryCHfrMRHCEE-WJKVwPhw"></div>
			<br>
			<input type="submit" name="login" value="Login">
			
		</form>
	</body>
</html>