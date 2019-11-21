<?php 
    session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>StudentLyfe</title>
    <link rel = "stylesheet" href = "styles.css">
</head>
<body>
    
    <header>
        <nav>
 
            <div>
                <?php  
                    if (isset($_SESSION["userID"])) {
                        echo "<form action = 'includes/logout_check.php' method = 'POST'>
                        <button type = 'submit' name = 'logout-submit'> Logout </button>
                    </form>";
                    }
                    else {
                        echo "<form action = 'includes/login_check.php' method = 'POST'>
                        <input type = 'text' name = 'uid' placeholder = 'E-mail or Username...'>
                        <input type = 'password' name = 'pwd' placeholder = 'Password...'>
                        <button type = 'submit' name = 'login-submit'> Login </button>
                        </form>
                        <a href = 'register.php'> Don't have an account? Register here! </a>";
                    }
                ?>
                

                
            </div>
        </nav>
    </header>

</body>
</html>