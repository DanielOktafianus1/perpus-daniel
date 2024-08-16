<?php

// include "function/helper.php";

if (isset($_GET['detail'])) {
    $id = $_GET['detail'];
    $detail = mysqli_query($koneksi, "SELECT anggota.nama_lengkap as nama_anggota, peminjaman.*, user.nama_lengkap FROM peminjaman 
    LEFT JOIN anggota ON anggota.id = peminjaman.id_anggota 
    LEFT JOIN user ON user.id = peminjaman.id_user 
    WHERE peminjaman.id = '$id'");
    $rowDetail = mysqli_fetch_assoc($detail);
    // var_dump($);

    // MENGHITUNG DURASI PINJAM

    $tanggal_pinjam = $rowDetail['tgl_pinjam'];
    $tanggal_kembali = $rowDetail['tgl_kembali'];

    $date_pinjam = new DateTime($tanggal_pinjam);
    $date_kembali = new DateTime($tanggal_kembali);
    $interval = $date_pinjam->diff($date_kembali);

    // echo "Durasi buku yang dipinjam selama " . $interval->days . "hari";

    // DATA BUKU
    $queryDetail = mysqli_query($koneksi, "SELECT*FROM detail_peminjaman 
    LEFT JOIN buku ON buku.id = detail_peminjaman.id_buku 
    LEFT JOIN kategori ON kategori.id = buku.id_kategori 
    WHERE id_peminjaman='$id'");
}

if (isset($_POST['simpan'])) {

    $id = isset($_GET['edit']) ? $_GET['edit'] : '';


    // $kode_transaksi = $_POST['kode_transaksi'];
    $id_peminjaman = $_POST['id_peminjaman'];
    // $id_kategori = $_POST['id_kategori'];
    // $id_anggota = $_POST['id_anggota'];
    $id_user = $_POST['id_user'];
    $tgl_pinjam = $_POST['tgl_pinjam'];
    $tgl_kembali = $_POST['tgl_kembali'];
    $denda = $_POST['denda'];
    $terlambat = $_POST['terlambat'];

    if (!$id) {
        // $insert = mysqli_query($koneksi, "INSERT INTO peminjaman (kode_transaksi,id_kategori,id_anggota,id_user,tgl_pinjam,tgl_kembali, status) VALUES ('$kode_transaksi','$id_anggota','$id_user','$tgl_pinjam','$tgl_kembali','1')");

        $insertPengembalian = mysqli_query($koneksi, "INSERT INTO pengembalian (id_peminjaman,denda,tgl_pengembalian,terlambat)VALUES('$id_peminjaman','$denda','$tgl_kembali','$terlambat')");


        header("location:index.php?pg=pengembalian");
        $updatePeminjaman = mysqli_query($koneksi, "UPDATE peminjaman SET status = 2 WHERE id=$id_peminjaman");
    }

    // if ($insert) {
    //     $id_pinjam = mysqli_insert_id($koneksi);
    //     foreach ($id_kategori as $key => $value) {
    //         $id_kategori = $_POST['id_kategori'][$key];
    //         $id_buku = $_POST['id_buku'][$key];
    //         $insert = mysqli_query($koneksi, "INSERT INTO detail_peminjaman (id_peminjaman,id_buku,id_kategori)VALUES('$id_pinjam','$id_buku','$id_kategori')");
    //     }
    // }




    // header("location:?pg=peminjaman&tambah=berhasil");
}

$anggota = mysqli_query($koneksi, "SELECT * FROM anggota");


if (isset($_GET['delete'])) {
    $id = $_GET['delete'];
    $delete = mysqli_query($koneksi, "UPDATE peminjaman SET delete_at=1 WHERE id = $id");
    header("location:?pg=peminjaman&deletberhasil");
}

$level = mysqli_query($koneksi, "SELECT*FROM level ORDER BY id DESC");
$queryKodeTrans  = mysqli_query($koneksi, "SELECT max(id) as id_transaksi FROM peminjaman");
$rowKodeTrans = mysqli_fetch_assoc($queryKodeTrans);
$no_urut = $rowKodeTrans['id_transaksi'];
$no_urut++;

$kode_transaksi = "PJ" . date("dmY") . sprintf("%03s", $no_urut);

$queryAnggota = mysqli_query($koneksi, "SELECT*FROM anggota ORDER BY id DESC");
$rowAnggota = mysqli_fetch_assoc($queryAnggota);
$queryKategori = mysqli_query($koneksi, "SELECT* FROM kategori ORDER BY id DESC");
$queryPeminjaman = mysqli_query($koneksi, "SELECT* FROM peminjaman WHERE status = 1 ORDER BY id DESC");

?>
<?php if (isset($_GET['detail'])) : ?>

<div class="container mt-5">
    <div class="row">
        <div class="col-sm-12">
            <div class="card">
                <div class="card-header">
                    <h1>Detail Transaksi Pengembalian</h1>
                </div>
                <div class="card-body">
                    <div class="mb-3 row">
                        <div class="col-sm-6">

                            <div class="row mb-3">
                                <div class="col-sm-4">
                                    <label for="" class="">Tanggal Kembali:</label>
                                </div>
                                <div class="col-sm-8">
                                    <label for="" class=""
                                        name=""><?= date('D,d M Y', strtotime($rowDetail['tgl_kembali'])) ?></label>
                                </div>
                            </div>

                            <div class="row mb-3">
                                <div class="col-sm-4">
                                    <label for="" class="">Nama Petugas:</label>
                                </div>
                                <div class="col-sm-8">
                                    <label for="" class="" name="nama_petugas"><?= $rowDetail['nama_lengkap'] ?></label>
                                </div>
                            </div>
                            <div class="row  mb-3">
                                <div class="col-sm-4">
                                    <label for="" class="">Kode Peminjaman:</label>
                                </div>
                                <div class="col-sm-8">
                                    <select name="id_peminjaman" id="" class="form-select-sm">
                                        <option value="" selected>Kode Peminjaman</option>
                                        <?php while ($peminjaman = mysqli_fetch_assoc($queryPeminjaman)) { ?>
                                        <option value="<?php $peminjaman['id'] ?>">
                                            <?= $peminjaman['kode_transaksi'] ?>
                                        </option>
                                        <?php } ?>

                                    </select>
                                </div>
                            </div>

                        </div>
                    </div>
                    <div class="mb-5 mt-5">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Kategori</th>
                                    <th>Judul Buku</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $no = 1;
                                    while ($rowDetail = mysqli_fetch_assoc($queryDetail)) { ?>
                                <tr>
                                    <td><?php echo $no++ ?></td>
                                    <td><?= $rowDetail['nama_kategori'] ?></td>
                                    <td><?php echo $rowDetail['judul'] ?></td>
                                </tr>
                                <?php } ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php else : ?>
<div class="container mt-5">
    <div class="row">
        <div class="col-sm-12">
            <div class="card">
                <div class="card-header">
                    <h1>Pengembalian</h1>
                </div>

                <div class="card-body">
                    <form action="" method="post">

                        <div class="row mb-3">
                            <div class="col-sm-2">
                                <label for="">Tanggal Kembali</label>
                            </div>
                            <div class="col-sm-3">
                                <input type="date" class="form-control" name="tgl_kembali" value="">
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-sm-2">
                                <label for="">Petugas</label>
                            </div>
                            <div class="col-sm-3">
                                <input type="text" class="form-control" name="petugas"
                                    value="<?php echo ($_SESSION['NAMA_LENGKAP'] ?? '') ?> " readonly>
                                <input type="hidden" class="form-control" name="id_user"
                                    value="<?php echo ($_SESSION['ID_USEER'] ?? '') ?> ">
                            </div>
                        </div>

                        <div class="row  mb-3">
                            <div class="col-sm-2">
                                <label for="" class="">Kode Peminjaman:</label>
                            </div>
                            <div class="col-sm-3">
                                <select name="id_peminjaman" id="kode_peminjaman" class="form-select">
                                    <option value="">Kode Peminjaman</option>
                                    <?php while ($peminjaman = mysqli_fetch_assoc($queryPeminjaman)) { ?>
                                    <option value="<?php echo $peminjaman['id'] ?>">
                                        <?= $peminjaman['kode_transaksi'] ?>
                                    </option>
                                    <?php } ?>

                                </select>
                            </div>
                        </div><br><br>

                        <div class="row mb-3">
                            <div class="col-sm-6">
                                <div class="row mb-3">
                                    <div class="col-sm-3">
                                        <label for="">Nama Anggota</label>
                                    </div>
                                    <div class="col-sm-9">
                                        <input type="text" id="nama_anggota" class="form-control" readonly
                                            placeholder="Nama Anggota">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-sm-6">
                                <div class="row mb-3">
                                    <div class="col-sm-3">
                                        <label for="">Tanggal Pinjam</label>
                                    </div>
                                    <div class="col-sm-9">
                                        <input type="text" id="tanggal_pinjam" class="form-control" readonly
                                            placeholder="Tanggal Pinjam" name="tgl_pinjam">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-sm-6">
                                <div class="row mb-3">
                                    <div class="col-sm-3">
                                        <label for="">Tanggal Kembali</label>
                                    </div>
                                    <div class="col-sm-9">
                                        <input type="text" id="tanggal_kembali" class="form-control" readonly
                                            placeholder="Tanggal Kembali" name="tgl_kembali">
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-sm-6">
                                <div class="row mb-3">
                                    <div class="col-sm-3">
                                        <label for="">Terlambat</label>
                                    </div>
                                    <div class="col-sm-9">
                                        <input type="text" id="tgl_terlambat" class="form-control" readonly
                                            placeholder="Informasi Keterlambatan" name="terlambat">
                                        <input type="hidden" id="denda" name="denda">
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Get Data Kategori Buku dan Buku -->


                        <div class="mt-5 mb-5">
                            <div class="table-responsive">
                                <table class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Kategori Buku</th>
                                            <th>Judul Buku</th>
                                            <th>Tahun Terbit</th>

                                        </tr>
                                    </thead>
                                    <tbody>

                                    </tbody>
                                </table>
                                <div align="right" class="total-denda">
                                    <h5> </h5>
                                </div>
                            </div>
                        </div>

                        <div class="mb-3">
                            <input type="submit" class="btn btn-primary" name="simpan" value="Simpan">
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<?php endif ?>