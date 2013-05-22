<!--html-->
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Eventfeeder</title>
    <link rel="stylesheet" href="css/reset.css">
    <link rel="stylesheet" href="css/style.css">
    <link href='http://fonts.googleapis.com/css?family=Jura:300,400,500,600' rel='stylesheet' type='text/css'>
</head>
<body>
    <div id="container">        
        <a href="index.php"><img id="logo" src="img/logo.png" alt="Eventfeeder"></a>
        <!-- backlink -->
        <a id="backlink" href="index.php">Terug naar de Loginpagina</a>


<form id="regform"method="post" action="register.php" name="registerform">
    <div id="error"><h3>
                    <?php

                    // show negative messages
                    if ($registration->errors) {
                        foreach ($registration->errors as $error) {
                            echo $error;    
                        }
                    }

                    // show positive messages
                    if ($registration->messages) {
                        foreach ($registration->messages as $message) {
                            echo $message;
                        }
                    }

                    ?>      
    </h3></div>
    <div id="regLabels">
        <label for="login_input_username" class="reg_label">Username</label>
        <label for="login_input_email" class="reg_label">User's email</label>
        <label for="login_input_password_new" class="reg_label">Password</label>
        <label for="login_input_password_repeat" class="reg_label">Repeat password</label>
    </div>  
     <div id="regInput">
        <input id="login_input_username" class="login_input" type="text" name="user_name" required />       
        <input id="login_input_email" class="login_input" type="email" name="user_email" required /> 
        <input id="login_input_password_new" class="login_input" type="password" name="user_password_new" required autocomplete="off" />  
        <input id="login_input_password_repeat" class="login_input" type="password" name="user_password_repeat" required autocomplete="off" />        
        <input type="submit"  name="register" id="btnCreateRegister" value="Registreer" />
     </div>  
</form>    
    </div>
</body>
</html>