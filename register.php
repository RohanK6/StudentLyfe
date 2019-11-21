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

    <main>
        <h1> Register </h1>
        <?php
            if (isset($_GET["error"])) {
                if ($_GET["error"] == "emptyfields") {
                    echo "<p>Fill in all the fields!</p>";
                }
                else if ($_GET["error"] == "invalidusernameandemail") {
                    echo "<p>Invalid Username and Email!</p>";
                }
                else if ($_GET["error"] == "invalidemail") {
                    echo "<p>Invalid Email!</p>";
                }
                else if ($_GET["error"] == "invalidusername") {
                    echo "<p>Invalid Username!</p>";
                }
                else if ($_GET["error"] == "passwordsdonotmatch") {
                    echo "<p>Passwords Don't Match!</p>";
                }
                else if ($_GET["error"] == "usernameandemailalreadytaken") {
                    echo "<p>Username and Email Already Taken!</p>";
                }
                else if ($_GET["error"] == "usernamealreadytaken") {
                    echo "<p>Username Already Taken!</p>";
                }
                else if ($_GET["error"] == "emailalreadytaken") {
                    echo "<p>Email Already Taken!</p>";
                }
            }
            else if (isset($GET["register"])) {
                if ($_GET["register"] == "success") {
                    echo "<p>Registration Successful!</p>";
                }
            }
        ?>
        <form action = "includes/register_check.php" method = "POST">
            <input type = "text" name = "uName" placeholder = "Username...">
            <input type = "text" name = "uEmail" placeholder = "Email...">
            <input type = "password" name = "uPwd" placeholder = "Password...">
            <input type = "password" name = "uPwdRepeat" placeholder = "Repeat Password...">
            <button type = "submit" name = "register-submit"> Register </button>
        </form>
        <a href = "index.php"> Already have an account? Log in here! </a>
    </main>

<?php 
    require "footer.php";
?>
</body>
</html>