<?php 

if (isset($_POST["login-submit"])) {
    require "database_handler.php";

    $uid = $_POST["uid"];
    $password = $_POST["pwd"];

    if (empty($uid) || empty($password)) {
        header("Location: ../index.php?error=emptyfields");
        exit();
    }
    else {
        $sql = "SELECT * FROM users WHERE usernameUsers = ? OR emailUsers = ?;";
        $statement = mysqli_stmt_init($connection);
        if (!mysqli_stmt_prepare($statement, $sql)) {
            header("Location: ../index.php?error=sqlerror");
            exit();
        }
        else {
            mysqli_stmt_bind_param($statement, "ss", $uid, $uid);
            mysqli_stmt_execute($statement);
            $result = mysqli_stmt_get_result($statement);
            if ($row = mysqli_fetch_assoc($result)) {
                $pwdCheck = password_verify($password, $row["passwordUsers"]);
                if (!$pwdCheck) {
                    header("Location: ../index.php?error=wrongpassword");
                    exit();
                }
                else if ($pwdCheck) {
                    session_start();
                    $_SESSION["userID"] = $row["idUsers"];
                    $_SESSION["userUsername"] = $row["usernameUsers"];
                    $_SESSION["userEmail"] = $row["emailUsers"];

                    header("Location: ../main/index.php");
                    exit();
                }
                else {
                    header("Location: ../index.php?error=wrongpassword");
                    exit();
                }
            }
            else {
                header("Location: ../index.php?error=nouser");
                exit();
            }
        }
    }

}
else {
    header("Location: ../index.php");
    exit();
}