<!--html-->
<!doctype html>
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

    <section id="logField">
        <h2>Log hier in!</h2>
        <h3><?php

            // show negative messages
            if ($login->errors) {
                foreach ($login->errors as $error) {
                    echo $error;    
                }
            }

            // show positive messages
            if ($login->messages) {
                foreach ($login->messages as $message) {
                    echo $message;
                }
            }
            ?> 
        </h3>
    <form method="post" action="index.php" name="loginform">
        <div id="logLabels">
            <div id="usrname"> <label for="login_input_username" class="log_label">Username</label>  </div>
            <div><label for="login_input_password_new" class="log_label">Password</label></div>
        </div>
        <div id="logFields">
            <input class="inputField" id="login_input_username" type="text" name="user_name" required />
            <input class="inputField" id="login_input_password" type="password" name="user_password" required autocomplete="off" />
            <input type="submit"  id="btnLogin" name="login" value="Log in" />
        </div>      
    </form>

    <a id="register" href="register.php">Registreer?</a>
</section>
    </div>
</body>
</html>

