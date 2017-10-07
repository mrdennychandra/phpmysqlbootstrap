<!DOCTYPE html>
<html>
    <head>
        <title>Login</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
    </head>
    <body>
        <?php
        if (isset($_POST['submit'])) {
            $username = $_POST['username'];
            $password = $_POST['password'];
            if (empty($username) || empty($password)) {
                echo "username dan password tidak boleh kosong";
            } else {
                include 'konfigurasi/config.php';
                include 'konfigurasi/function.php';
                $con = connect_db();
                $query = "SELECT * FROM users WHERE username='$username' "
                        . "AND password=md5('$password')";
                $result = execute_query($con, $query);
                $data = mysqli_fetch_array($result);
                if (mysqli_num_rows($result) != 0) {
                    session_start();
                    $_SESSION['islogin'] = true;
                    $_SESSION['username'] = $username;
                    $_SESSION['role'] = $data['role'];
                    header("location:index.php");
                } else {
                    echo "username atau password tidak benar";
                }
            }
        }
        ?>
        <form method="POST">
            <fieldset>
                <legend>Login</legend>
                <div>
                    <label for="username">Username</label>
                    <input type="text" name="username">
                </div>
                <div>
                    <label for="password">Password</label>
                    <input type="password" name="password">
                </div>
                <div>
                    <input type="submit" name="submit" value="Login">
                </div>
            </fieldset>
        </form>
    </body>
</html>
