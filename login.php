<?php
session_start();
include 'database.php';

if(isset($_POST["ic"]) && isset($_POST["password"])) {
    $ic = mysqli_real_escape_string($conn, $_POST["ic"]);
    $password = mysqli_real_escape_string($conn, $_POST["password"]);

    // Check user table
    $query = "SELECT * FROM user WHERE ic = '$ic'";
    $result = mysqli_query($conn, $query);

    if(mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);
        $hashedPassword = $row['password'];
        $name = $row['name'];

        if(password_verify($password, $hashedPassword)) {
			            $_SESSION['ic'] = $ic;

            $_SESSION['name'] = $name;
            $_SESSION['email'] = $row['email'];
            echo "<script>alert('User login successful.'); window.location.replace('dashboard_user.php');</script>";
            exit();
        } else {
            echo "<script>alert('Incorrect password. Please try again.');</script>";
        }
    } else {
        // Check MARO table
        $query = "SELECT * FROM MARO WHERE ic = '$ic'";
        $result = mysqli_query($conn, $query);

        if(mysqli_num_rows($result) > 0) {
            $row = mysqli_fetch_assoc($result);
            $hashedPassword = $row['password'];

            if(password_verify($password, $hashedPassword)) {
                $_SESSION['ic'] = $ic;
                $_SESSION['email'] = $row['email'];
                echo "<script>alert('Maro login successful.'); window.location.replace('dashboard_maro.php');</script>";
                exit();
            } else {
                echo "<script>alert('Incorrect password. Please try again.');</script>";
            }
        } else {
            // Check PIC table
            $query = "SELECT * FROM PIC WHERE ic = '$ic'";
            $result = mysqli_query($conn, $query);

            if(mysqli_num_rows($result) > 0) {
                $row = mysqli_fetch_assoc($result);
                $hashedPassword = $row['password'];
        $name = $row['name'];

                if(password_verify($password, $hashedPassword)) {
					            $_SESSION['name'] = $name;

                    $_SESSION['ic'] = $ic;
                    $_SESSION['email'] = $row['email'];

                    echo "<script>alert('PIC login successful.'); window.location.replace('pic.php');</script>";
                } else {
                    echo "<script>alert('Incorrect password. Please try again.');</script>";
                }
            } else {
                // Check unitsuper table
                $query = "SELECT * FROM unitsuper WHERE ic = '$ic'";
                $result = mysqli_query($conn, $query);

                if(mysqli_num_rows($result) > 0) {
                    $row = mysqli_fetch_assoc($result);
                    $hashedPassword = $row['password'];

                    if(password_verify($password, $hashedPassword)) {
                        $_SESSION['ic'] = $ic;
                        $_SESSION['email'] = $row['email'];
                        echo "<script>alert('You login successful.'); window.location.replace('dashboard_unitsuper.php');</script>";
                        exit();
                    } else {
                        echo "<script>alert('Incorrect password. Please try again.');</script>";
                    }
                } else {
                    echo "<script>alert('User not found. Please check your IC number.');</script>";
                }
            }
        }
    }
}
?>



<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>User Login</title>
<style>
  body {
    font-family: Arial, sans-serif;
    background-color: #f4f4f4;
    margin: 0;
    padding: 0;
    display: flex;
    justify-content: center;
    align-items: center;
    height: 100vh;
  }
  .login-container {
    background-color: #ffffff;
    padding: 20px;
    border-radius: 8px;
    box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
    width: 300px;
  }
  h2 {
    text-align: center;
    margin-bottom: 20px;
  }
  label {
    font-weight: bold;
  }
  input[type="text"],
  input[type="password"] {
    width: 100%;
    padding: 10px;
    margin-bottom: 10px;
    border: 1px solid #ccc;
    border-radius: 4px;
    box-sizing: border-box;
  }
  input[type="submit"] {
    background-color: #4caf50;
    color: #ffffff;
    padding: 10px 20px;
    border: none;
    border-radius: 4px;
    cursor: pointer;
    width: 100%;
    margin-bottom: 10px; 
  }
  input[type="submit"]:hover {
    background-color: #45a049;
  }
  .register-link {
    text-align: center;
  }
  .register-link a {
    color: #4caf50;
    text-decoration: none;
  }
  .register-link a:hover {
    text-decoration: underline;
  }
</style>
</head>
<body>

<div class="login-container">
  <h2>Login</h2>
  <form action="login.php" method="post">
    <label for="ic">IC:</label><br>
    <input type="text" id="ic" name="ic" required><br>
    <label for="password">Password:</label><br>
    <input type="password" id="password" name="password" required><br>
    <input type="submit" value="Login">
  </form>
  <div class="register-link">
    <p>Don't have an account? <a href="register.php">Register now</a></p>
  </div>
</div>

</body>
</html>
