<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        .btn {
            background-color: #3498db;
            color: #fff;
            padding: 20px;
            text-align: center;
            margin: 10px;
            border-radius: 8px;
            text-decoration: none;
            transition: background-color 0.3s ease;
            cursor: pointer;
        }
        a{
            text-decoration: none;
        }

        .btn:hover {
            background-color: #2980b9;
        }

        .admin-title {
            font-size: 24px;
            margin-bottom: 20px;
        }
    </style>
</head>
<body>

    <div class="admin-title"><h1>
    Admin Actions
    </h1></div>
    <a href="notApproved.php">
        <h1  class="btn">
        Not Approved Products
        </h1>
    </a>
    <a href="approved.php">
        <h1 class="btn">
        Approved Products
        </h1>
    </a>
    <button style="background-color: #3498db; color: #fff; padding: 10px 20px; border: none; border-radius: 5px; text-decoration: none; cursor: pointer; transition: background-color 0.3s ease;">
    <a href="../index.php" style="text-decoration: none; color: inherit;">Back Home</a>
</button>
</body>
</html>
