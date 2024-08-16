<?php

session_start();

include "config/koneksi.php";

if (isset($_POST['submit'])) {
    $email = $_POST['email'];
    $password = sha1($_POST['password']);
    $queryLogin = mysqli_query($koneksi, "SELECT * FROM user WHERE email = '$email'");


    if (mysqli_num_rows($queryLogin) > 0) {
        $dataUser = mysqli_fetch_assoc($queryLogin);
        if ($password == $dataUser['password']) {
            $_SESSION['NAMA_LENGKAP'] = $dataUser['nama_lengkap'];
            $_SESSION['ID_USEER'] = $dataUser['id'];
            header("location:index.php");
        }
    } else {
        header("location:login.php?error=login");
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Form</title>
    <link rel="stylesheet" href="bootstrap-5.3.3-dist/css/bootstrap.min.css">

</head>

<body>
    <div class="container mt-5 ">
        <div class="row justify-content-center">
            <div class="col-sm-5">
                <div class="card">
                    <div class="card-header">Login Form</div>
                    <div class="card-body">
                        <form action="" method="post">
                            <div class="mb-3">
                                <label for="" class="form-label">Email</label>
                                <input type="email" name="email" id="" class="form-control">
                            </div>
                            <div class="mb-3">
                                <label for="" class="form-label">Password</label>
                                <input type="password" name="password" id="" class="form-control">
                            </div>
                            <input type="submit" name="submit" id="" class="btn btn-primary">
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="bootstrap-5.3.3-dist/js/bootstrap.min.js"></script>
</body>

</html>