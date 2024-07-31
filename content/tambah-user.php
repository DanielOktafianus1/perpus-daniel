<?php

if (isset($_GET['edit'])) {
    $id = $_GET['edit'];
    $edit = mysqli_query($koneksi, "SELECT * FROM user WHERE id = '$id'");
    $rowEdit = mysqli_fetch_assoc($edit);
}

if (isset($_POST['simpan'])) {

    $id = isset($_GET['edit']) ? $_GET['edit'] : '';

    $nama_lengkap = $_POST['nama_lengkap'];
    $email = $_POST['email'];
    $password = sha1($_POST['password']);

    if (!$id) {
        $insert = mysqli_query($koneksi, "INSERT into user (nama_lengkap, email, password) VALUES ('$nama_lengkap','$email','$password')");
    } else {
        $update = mysqli_query($koneksi, "UPDATE user SET nama_lengkap= '$nama_lengkap', email='$email', password='$password' WHERE id = '$id'");
    }

    header("location:?pg=users&tambah=berhasil");
}




if (isset($_GET['delete'])) {
    $id = $_GET['delete'];

    $delete = mysqli_query($koneksi, "DELETE FROM user WHERE id = '$id'");
    header("location:?pg=users");
}
?>
<div class="container mt-5">
    <div class="row">
        <div class="col-sm-12">
            <div class="card">
                <div class="card-header">
                    <h1>Data User</h1>
                </div>
                <div class="card-body">
                    <form action="" method="post">

                        <div class="mb-3">
                            <label for="" class="form-label">Nama Lengkap</label>
                            <input type="text" name="nama_lengkap" class="form-control" value="<?= $rowEdit['nama_lengkap'] ?? '' ?>">
                        </div>

                        <div class=" mb-3">
                            <label for="" class="form-label">Email</label>
                            <input type="email" name="email" class="form-control" value="<?= $rowEdit['email'] ?? '' ?>">
                        </div>

                        <div class="mb-3">
                            <label for="" class="form-label">Password</label>
                            <input type="password" name="password" class="form-control" value="<?= $rowEdit['password'] ?? '' ?>">
                        </div>

                        <input type="submit" class="btn btn-primary" name="simpan" value="Simpan">

                    </form>
                </div>
            </div>
        </div>
    </div>
</div>