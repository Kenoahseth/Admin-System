<?php 

session_start();
include "components/connector.php";

if($_SERVER["REQUEST_METHOD"] == "POST") {
  $email = $_POST['email'];
  $input_password = $_POST['password'];

  $stmt = $conn -> prepare("SELECT user_id, password, user_type FROM users_table WHERE email = ?");
  $stmt -> bind_param("s", $email);
  $stmt -> execute();
  $stmt -> store_result();

  if ($stmt -> num_rows > 0) {
    $stmt -> bind_result($user_id, $password, $user_type);
    $stmt -> fetch();

    if ($input_password === $password) {
      $_SESSION['user_id'] = $user_id;
      $_SESSION['email'] = $email;
      $_SESSION['user_type'] = $user_type;

      if ($user_type === 'admin') {
        header("Location: index.php");
      } else {
        header("Location: employee/home.php");
      }
      exit();
    } else {
      echo "Invalid username or password.";
    }
  } else {
    echo "Invalid username or password.";
  }

  $stmt -> close();
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Login</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.css" />
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
    <link rel="stylesheet" href="styles.css" />
</head>

<body>
    <main class="login-container">
        <section class="login-flex">
            <form class="left-panel" method="POST">
                <h1 class="logo">Admin Logo</h1>
                <h1 class="welcome-msg">Welcome back!</h1>
                <div class="input-fields">
                    <div>
                        <label for="email">Email</label>
                        <input type="text" name="email" id="email" placeholder="Enter your email" required />
                    </div>
                    <div>
                        <label for="password">Password</label>
                        <input type="password" name="password" id="password" placeholder="Enter your password"
                            required />
                    </div>
                </div>
                <input type="submit" class="login-btn" value="Login">
                <a href="#" class="forgot-password">Forgot Password?</a>
            </form>
            <div class="right-panel"></div>
        </section>
    </main>
</body>

</html>