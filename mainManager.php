<?php
session_start();
include("user_db/db.php");

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['fileName']) && isset($_POST['content'])) {
        $fileNameWithType = $_POST['fileName'];
        $content = $_POST['content'];

        // Get the user ID from cookies
        $id_user = isset($_COOKIE['user_id']) ? $_COOKIE['user_id'] : null;

        if ($id_user !== null) {
            // Logic to save the file on the server (path where the file will be stored)
            $files_path = '/var/www/html/savedFiles/'; // Update with your server path
            $complete_path = $files_path . $fileNameWithType; // Save the complete file name with type

            // Save the content to the file
            $file_saved = file_put_contents($complete_path, $content);

            if ($file_saved !== false) {
                try {
                    // Prepare the SQL statement
                    $sql = "INSERT INTO files (id_user, file_name, file_path) VALUES (?, ?, ?)";
                    $stmt = $con->prepare($sql);

                    // Bind parameters and execute the statement
                    if ($stmt->execute([$id_user, $fileNameWithType, $complete_path])) {
                        $response = array("status" => "success", "message" => "File created successfully and saved in the database.");
                        echo json_encode($response);
                    } else {
                        $response = array("status" => "error", "message" => "Error inserting file information into the database: " . $stmt->errorInfo());
                        echo json_encode($response);
                    }
                } catch (PDOException $e) {
                    $response = array("status" => "error", "message" => "Error: " . $e->getMessage());
                    echo json_encode($response);
                }
            } else {
                $response = array("status" => "error", "message" => "Error saving the file on the server.");
                echo json_encode($response);
            }
        } else {
            $response = array("status" => "error", "message" => "User ID not found in cookies.");
            echo json_encode($response);
        }
    } else {
        $response = array("status" => "error", "message" => "Missing data to create the file.");
        echo json_encode($response);
    }
} else {
    $response = array("status" => "error", "message" => "Incorrect request.");
    echo json_encode($response);
}
?>

