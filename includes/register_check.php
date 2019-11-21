<?php 

if (isset($_POST["register-submit"])) {
    require "database_handler.php";

    $username = $_POST["uName"];
    $email = $_POST["uEmail"];
    $password = $_POST["uPwd"];
    $passwordRepeat = $_POST["uPwdRepeat"];

    if (empty($username) || empty($email) || empty($password) || empty($passwordRepeat)) {
        header("Location: ../register.php?error=emptyfields");
        exit();

    }
    else if ((!filter_var($email, FILTER_VALIDATE_EMAIL)) && (!preg_match("/^[a-zA-Z0-9]*$/", $username))) {
        header("Location: ../register.php?error=invalidusernameandemail");
        exit();
    }
    else if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        header("Location: ../register.php?error=invalidemail");
        exit();
    }
    else if (!preg_match("/^[a-zA-Z0-9]*$/", $username)) {
        header("Location: ../register.php?error=username");
        exit();
    }
    else if($password !== $passwordRepeat) {
        header("Location: ../register.php?error=passwordsdonotmatch");
        exit();
    }
    else {
        $sql_username = "SELECT * FROM users WHERE usernameUsers = ?";
        $statement = mysqli_stmt_init($connection);
        $sql_email = "SELECT * FROM users WHERE emailUsers = ?";
        $statement2 = mysqli_stmt_init($connection);

        if (!mysqli_stmt_prepare($statement, $sql_username)) {
            header("Location: ../register.php?error=sqlerror");
            exit();
        }
        else if (!mysqli_stmt_prepare($statement2, $sql_email)) {
            header("Location: ../register.php?error=sqlerror");
            exit();
        }
        else {
            mysqli_stmt_bind_param($statement, "s", $username);
            mysqli_stmt_execute($statement);
            mysqli_stmt_store_result($statement);
            $resultCheck = mysqli_stmt_num_rows($statement);

            mysqli_stmt_bind_param($statement2, "s", $email);
            mysqli_stmt_execute($statement2);
            mysqli_stmt_store_result($statement2);
            $resultCheck2 = mysqli_stmt_num_rows($statement2);

            if (($resultCheck > 0) && ($resultCheck2 > 0)) {
                header("Location: ../register.php?error=usernameandemailalreadytaken");
                exit();  
            }
            else if ($resultCheck > 0) {
                header("Location: ../register.php?error=usernamealreadytaken");
                exit();  
            }
            else if ($resultCheck2 > 0) {
                header("Location: ../register.php?error=emailalreadytaken");
                exit();  
            }
            else {
                $sql = "INSERT INTO users (usernameUsers, emailUsers, passwordUsers) VALUES (?, ?, ?)";
                $statement = mysqli_stmt_init($connection);
                if (!mysqli_stmt_prepare($statement, $sql)) {
                    header("Location: ../register.php?error=sqlerror");
                    exit();
                }
                else {
                    $hashed_pwd = password_hash($password, PASSWORD_DEFAULT);

                    mysqli_stmt_bind_param($statement, "sss", $username, $email, $hashed_pwd);
                    mysqli_stmt_execute($statement);
                    header("Location: ../register.php?register=success");
                    exit();
                }
            }
        }
    }
    mysqli_stmt_close($statement);
    mysqli_close($connection);
    }   
else {
    header("Location: ../register.php");
    exit();
}
