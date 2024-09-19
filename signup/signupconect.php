<?php
session_start();
include("../user_db/db.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['signUp'])) {
        
        if (
            strlen($_POST['email']) >= 1 &&
            strlen($_POST['user_name']) >= 1 &&
            strlen($_POST['password']) >= 1 &&
            strlen($_POST['passwordRep']) >= 1
        ) {
            $email = trim($_POST['email']);
            $user_name = trim($_POST['user_name']);
            $password = trim($_POST['password']);
            $passwordRep = trim($_POST['passwordRep']);

            if ($password === $passwordRep) {

                $password = password_hash($password, PASSWORD_DEFAULT);

                $query = "INSERT INTO users VALUES(DEFAULT,:email,:user_name,:passwd)";

                $statement = $con->prepare($query);
                $statement->bindParam(':email', $email);
                $statement->bindParam(':user_name', $user_name);
                $statement->bindParam(':passwd', $password);

                $result = $statement->execute();

                if ($result) {
                    $_SESSION['message'] = "Sign Up successful!";
                    header("Location: ../login/login.php");
                    exit();
                } else {
                    $_SESSION['message'] = "Error occurred during Sign Up";
                    header("Location: signup.php");
                    exit();
                }
            } else {
                $_SESSION['message'] = "Passwords do not match";
                header("Location: signup.php");
                exit();
            }
        } else {
            $_SESSION['message'] = "Please complete all fields";
            header("Location: signup.php");
            exit();
        }
    }
}
?>
