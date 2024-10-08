<?php
$queryKategori = mysqli_query($koneksi, "SELECT * FROM kategori ORDER BY id DESC");
// $Kategori = mysqli_fetch_assoc($queryKategori);
// print_r($Kategori['id']);
// var_dump($Kategori);
?>

<div class="container mt-5">
    <div class="row">
        <div class="col-sm-12">
            <div class="card">
                <div class="card-header">
                    <h1>Data Kategori</h1>
                </div>
                <div class="card-body">
                    <div align="right" class="mb-3">
                        <a href="?pg=tambah-kategori" class="btn btn-primary">Tambah</a>
                    </div>

                    <?php
                    if (isset($_GET['tambah'])) {  ?>
                        <div class="alert alert-success">Data berhasil ditambah!</div>
                    <?php } ?>


                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Nama Kategori</th>
                                <th>Keterangan</th>

                        </thead>
                        <tbody>
                            <?php
                            $no = 1;
                            while ($rowKategori = mysqli_fetch_assoc($queryKategori)) : ?>
                                <tr>
                                    <td><?php echo $no++ ?></td>
                                    <td><?php echo $rowKategori['nama_kategori'] ?></td>
                                    <td><?php echo $rowKategori['keterangan'] ?></td>
                                    <td style="text-align: center;">
                                        <a href="?pg=tambah-kategori&edit=<?php echo $rowKategori['id'] ?>" class="btn btn-sm btn-success">Edit</a>
                                        <a onclick="return confirm('apakah anda yakin menghapus data?')" href="?pg=tambah-kategori&delete=<?php echo $rowKategori['id'] ?>" class="btn btn-sm btn-danger">Delete</a>
                                    </td>
                                </tr>
                            <?php endwhile ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>