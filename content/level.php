<?php
$queryLevel = mysqli_query($koneksi, "SELECT * FROM level ORDER BY id DESC");
$Level = mysqli_fetch_assoc($queryLevel);
// print_r($Users['']);
?>
<div class="container mt-5">
    <div class="row">
        <div class="col-sm-12">
            <div class="card">
                <div class="card-header">
                    <h1>Data Level</h1>
                </div>
                <div class="card-body">
                    <div align="right" class="mb-3">
                        <a href="?pg=tambah-level" class="btn btn-primary">Tambah</a>
                    </div>

                    <?php
                    if (isset($_GET['tambah'])) {  ?>
                    <div class="alert alert-success">Data berhasil ditambah!</div>
                    <?php } ?>


                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Nama Level</th>
                                <th>Keterangan</th>

                        </thead>
                        <tbody>
                            <?php
                            $no = 1;
                            while ($rowLevel = mysqli_fetch_assoc($queryLevel)) : ?>
                            <tr>
                                <td><?php echo $no++ ?></td>
                                <td><?php echo $rowLevel['nama_level'] ?></td>
                                <td><?php echo $rowLevel['keterangan'] ?></td>
                                <td style="text-align: center;">
                                    <a href="?pg=tambah-level&edit=<?php echo $rowLevel['id'] ?>"
                                        class="btn btn-sm btn-success">Edit</a>
                                    <a onclick="return confirm('apakah anda yakin menghapus data?')"
                                        href="?pg=tambah-level&delete=<?php echo $rowLevel['id'] ?>"
                                        class="btn btn-sm btn-danger">Delete</a>
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