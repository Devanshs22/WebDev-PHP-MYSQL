<?php
session_start();

if (!isset($_SESSION['user_id'])) {
    header("Location: login.html");
    exit();
}

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "user_management"; 

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Get logged-in user's ID
$user_id = $_SESSION['user_id'];

// Fetch current user info
$sql = "SELECT username, email, phone, dob, address FROM users WHERE id=?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $user_id);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    $user = $result->fetch_assoc();
} else {
    echo "User not found.";
    exit();
}

// Handle update
if (isset($_POST['update'])) {
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $dob = $_POST['dob'];
    $address = $_POST['address'];

    $sql_update = "UPDATE users SET email=?, phone=?, dob=?, address=? WHERE id=?";
    $stmt_update = $conn->prepare($sql_update);
    $stmt_update->bind_param("ssssi", $email, $phone, $dob, $address, $user_id);
    
    if ($stmt_update->execute()) {
        header("Location: dashboard.php");
        exit();
    } else {
        echo "Error updating record.";
    }

    $stmt_update->close();
}

$stmt->close();
$conn->close();
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://fonts.googleapis.com/css2?family=Poppins&display=swap" rel="stylesheet">
    <title>Update User</title>
    <style>

        * {
            box-sizing: border-box;
            font-family: 'Poppins', sans-serif;
        }
        body {
            background: linear-gradient(135deg, #e0e7ff, #f0f4ff);
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
            background-color: #fff;
        }
        .container {
            width: 400px;
            padding: 20px;
            border-radius: 8px;
        }
        form {
            display: flex;
            flex-direction: column;
        }
        label, input {
            width: 100%;
            box-sizing: border-box;
        }
        input[type="Email"],
        input[type="text"],
        input[type="date"],
        input[type="tel"]{
            margin-bottom: 10px;
            border: none;
            font-weight: bold;
            padding: 10px;
        }
        input[type="submit"] {
            padding: 10px;
            margin-top: 30px;
            font-size: 20px;
            cursor: pointer;
             border: none;
            background-color: lightblue;
        }
        input[type="submit"]:hover {
            color: black;
            background-color: palegreen; 
        }
        h2 {
            text-align: center;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Update User Information</h2>
        <form method="post">
            <label for="email">Email:</label>
            <input type="email" id="email" name="email" value="<?php echo htmlspecialchars($user['email']); ?>" required>

            <label for="phone">Phone Number:</label>
            <input type="tel" id="phone" name="phone" value="<?php echo htmlspecialchars($user['phone']); ?>" required>

            <label for="dob">Date of Birth:</label>
            <input type="date" id="dob" name="dob" value="<?php echo htmlspecialchars($user['dob']); ?>" required>

            <label for="address">Address:</label>
            <input type="text" id="address" name="address" value="<?php echo htmlspecialchars($user['address']); ?>" required>

            <input type="submit" name="update" value="Update">
        </form>
    </div>
</body>
</html>