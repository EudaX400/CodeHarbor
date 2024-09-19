<?php
session_start();
include("../user_db/db.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['login'])) {
        $email = trim($_POST['email']);
        $password = trim($_POST['password']);

        $query = "SELECT * FROM users WHERE email = :email";
        $statement = $con->prepare($query);

        if ($statement) {
            $statement->bindParam(':email', $email);
            $result = $statement->execute();

            if ($result) {
                $row = $statement->fetch(PDO::FETCH_ASSOC);

                if ($row) {
                    if (password_verify($password, $row['password'])) {
                        $user_id = $row['id'];
                        setcookie("user_id", $user_id, time() + (86400 * 30), "/");
                        header("Location: ../index.html");
                        exit();
                    } else {
                        $_SESSION['message'] = "Incorrect password"; 
                        header("Location: login.php"); 
                        exit();
                    }
                } else {
                    $_SESSION['message'] = "User not found";
                    header("Location: login.php"); 
                    exit();
                }
            } else {
                $errorInfo = $statement->errorInfo();
                $_SESSION['message'] = "Error executing the query: " . $errorInfo[2]; 
                header("Location: login.php");
                exit();
            }
        } else {
            $errorInfo = $con->errorInfo();
            $_SESSION['message'] = "Error preparing the query: " . $errorInfo[2];
            header("Location: login.php");
            exit();
        }
    }
}
?>

