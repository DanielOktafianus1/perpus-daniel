<?php

if (isset($_GET['edit'])) {
    $id = $_GET['edit'];
    $edit = mysqli_query($koneksi, "SELECT * FROM level WHERE id = '$id'");
    $rowEdit = mysqli_fetch_assoc($edit);
}

if (isset($_POST['simpan'])) {

    $id = isset($_GET['edit']) ? $_GET['edit'] : '';

    $nama_level = $_POST['nama_level'];
    $keterangan = $_POST['keterangan'];


    if (!$id) {
        $insert = mysqli_query($koneksi, "INSERT INTO level (nama_level, keterangan) VALUES ('$nama_level','$keterangan')");
    } else {
        $update = mysqli_query($koneksi, "UPDATE level SET nama_level = '$nama_level', keterangan ='$keterangan' WHERE id = '$id'");
    }

    header("location:?pg=level&tambah=berhasil");
}
if (isset($_GET['delete'])) {
    $id = $_GET['delete'];

    $delete = mysqli_query($koneksi, "DELETE FROM level WHERE id = '$id'");
    header("location:?pg=level");
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
                            <label for="" class="form-label">Nama level</label>
                            <input type="text" name="nama_level" class="form-control" value="<?= $rowEdit['nama_level'] ?? '' ?>">
                        </div>

                        <div class=" mb-3">
                            <label for="" class="form-label">Keterangan</label>
                            <input type="text" name="keterangan" class="form-control" value="<?= $rowEdit['keterangan'] ?? '' ?>">
                        </div>



                        <input type="submit" class="btn btn-primary" name="simpan" value="Simpan">

                    </form>
                </div>
            </div>
        </div>
    </div>
</div>