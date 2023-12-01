<?php
session_start();
echo $_SESSION['username'];
// Check if the user is logged in or not
if (!isset($_SESSION['username'])) {
    header("Location: /khaled/Structured%20Tp/Project_Palestine/login");
    exit();
}

// Initialize variables
$error_message = "";

// Process form submission for additional information and image upload
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Your code for handling additional information and image upload
    // Example: Save bio to the database
    $bio = $_POST['bio'];

    // Example: Handle image upload
    if ($_FILES["image"]["error"] == 0) {
        $target_directory = __DIR__ . '/../../uploads/';
        $target_file = $target_directory . basename($_FILES["image"]["name"]);

        if (move_uploaded_file($_FILES["image"]["tmp_name"], $target_file)) {
            // Image uploaded successfully
            $image_name = basename($_FILES["image"]["name"]);

            // Save bio and image name to the database
            try {
                $host = "localhost";
                $username = "root";
                $password = "";
                $database = "psproject";

                $connect = new PDO("mysql:host=$host; dbname=$database", $username, $password);
                $connect->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

                // Assuming you have a table named 'user_details' to store additional information
                $query = "UPDATE users SET bio = :bio, avatar_url = :profile_image WHERE username = :username";
                $statement = $connect->prepare($query);
                $username = $_SESSION["username"];
                $result = $statement->execute(
                    array(
                        'username' =>$username,
                        'bio' => $bio,
                        'profile_image' => $image_name
                    )
                );

                if ($result) {
                    // Redirect to a success page or perform other actions
                    header("Location: /khaled/Structured%20Tp/Project_Palestine/");
                    exit();
                } else {
                    $error_message = "Error inserting data into the database.";
                }
            } catch (PDOException $error) {
                $error_message = $error->getMessage();
            }
        } else {
            $error_message = "Error uploading the image.";
        }
    }
}
?>

<!DOCTYPE html>
<html>

<head>
    <title>Register Success</title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" />
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
</head>

<body>
    <br />
    <div class="container" style="width:500px;">
        <?php
        if ($error_message) {
            echo '<label class="text-danger">' . $error_message . '</label>';
        }
        ?>
        <h3 align="">Register Success</h3><br />
        <form method="post" enctype="multipart/form-data">
            <label>Bio:</label>
            <textarea name="bio" rows="4" cols="50"></textarea>
            <br>

            <label>Upload Image:</label>
            <input type="file" name="image" accept="image/*">
            <br>

            <input type="submit" name="submit" class="btn btn-info" value="Submit">
        </form>
        <br>
        <a href="/khaled/Structured%20Tp/Project_Palestine/" class="btn btn-info">Go Home</a>
    </div>
</body>

</html>
