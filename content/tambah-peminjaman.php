<?php

// include "function/helper.php";

if (isset($_GET['detail'])) {
    $id = $_GET['detail'];
    $detail = mysqli_query($koneksi, "SELECT anggota.nama_lengkap as nama_anggota, peminjaman.*, user.nama_lengkap FROM peminjaman LEFT JOIN anggota ON anggota.id = peminjaman.id_anggota LEFT JOIN user ON user.id = peminjaman.id_user WHERE peminjaman.id = '$id'");
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


    $kode_transaksi = $_POST['kode_transaksi'];
    $id_kategori = $_POST['id_kategori'];
    $id_anggota = $_POST['id_anggota'];
    $id_user = $_POST['id_user'];
    $tgl_pinjam = $_POST['tgl_pinjam'];
    $tgl_kembali = $_POST['tgl_kembali'];

    if (!$id) {
        $insert = mysqli_query($koneksi, "INSERT INTO peminjaman (kode_transaksi,id_anggota,id_user,tgl_pinjam,tgl_kembali, status) VALUES ('$kode_transaksi','$id_anggota','$id_user','$tgl_pinjam','$tgl_kembali','1')");
    }

    if ($insert) {
        $id_pinjam = mysqli_insert_id($koneksi);
        foreach ($id_kategori as $key => $value) {
            $id_kategori = $_POST['id_kategori'][$key];
            $id_buku = $_POST['id_buku'][$key];
            $insert = mysqli_query($koneksi, "INSERT INTO detail_peminjaman (id_peminjaman,id_buku,id_kategori)VALUES('$id_pinjam','$id_buku','$id_kategori')");
        }
    }


    header("location:?pg=peminjaman&tambah=berhasil");
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
$queryBuku = mysqli_query($koneksi, "SELECT* FROM buku ORDER BY id DESC");

?>
<?php if (isset($_GET['detail'])) : ?>

    <div class="container mt-5">
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header">
                        <h1>Detail Transaksi Peminjaman</h1>
                    </div>
                    <div class="card-body">
                        <div class="mb-3 row">
                            <div class="col-sm-6">
                                <div class="row mb-3 ">
                                    <div class="col-sm-4">
                                        <label for="" class="">Kode Transaksi:</label>
                                    </div>
                                    <div class="col-sm-4">
                                        <label for="" class=""><?= $rowDetail['kode_transaksi'] ?></label>
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <div class="col-sm-4">
                                        <label for="" class="">Tanggal Pinjam:</label>
                                    </div>
                                    <div class="col-sm-8">
                                        <label for=""
                                            class=""><?= date('D,d M Y', strtotime($rowDetail['tgl_pinjam']))  ?></label>
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <div class="col-sm-4">
                                        <label for="" class="">Tanggal Kembali:</label>
                                    </div>
                                    <div class="col-sm-8">
                                        <label for=""
                                            class=""><?= date('D,d M Y', strtotime($rowDetail['tgl_kembali']))  ?></label>
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <div class="col-sm-4">
                                        <label for="" class="">Lama Peminjaman:</label>
                                    </div>
                                    <div class="col-sm-8">
                                        <label for="" class=""><?= $interval->days . " hari" ?></label>
                                    </div>
                                </div>

                            </div>
                            <div class="col-sm-6">
                                <div class="row mb-3">
                                    <div class="col-sm-4">
                                        <label for="" class="">Nama Anggota:</label>
                                    </div>
                                    <div class="col-sm-8">
                                        <label for="" class=""><?= $rowDetail['nama_anggota'] ?></label>
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <div class="col-sm-4">
                                        <label for="" class="">Nama Petugas:</label>
                                    </div>
                                    <div class="col-sm-8">
                                        <label for="" class=""><?= $rowDetail['nama_lengkap'] ?></label>
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <div class="col-sm-4">
                                        <label for="" class="">Status:</label>
                                    </div>
                                    <div class="col-sm-8">
                                        <label for="" class=""><?php echo getStatus($rowDetail['status']) ?></label>
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
                        <h1>Data User</h1>
                    </div>

                    <div class="card-body">
                        <form action="" method="post">
                            <div class="row mb-3">
                                <div class="col-sm-2">
                                    <label for="">kode_transaksi</label>
                                </div>
                                <div class="col-sm-3">
                                    <input type="text" class="form-control" name="kode_transaksi"
                                        value="<?php echo ($kode_transaksi ?? '') ?>" readonly>
                                </div>
                            </div>

                            <div class="row mb-3">
                                <div class="col-sm-2">
                                    <label for="">Nama Anggota</label>

                                </div>
                                <div class="col-sm-3">
                                    <select name="id_anggota" id="id_anggota" class="form-control">
                                        <option value="">Pilih Anggota</option>
                                        <?php while ($rowLevel = mysqli_fetch_assoc($anggota)) : ?>
                                            <option value="<?= $rowLevel['id'] ?>"><?= $rowLevel['nama_lengkap'] ?></option>
                                        <?php endwhile; ?>
                                    </select>
                                </div>
                            </div>

                            <div class="row mb-3">
                                <div class="col-sm-2">
                                    <label for="">Tanggal Pinjam</label>

                                </div>
                                <div class="col-sm-3">
                                    <input type="date" class="form-control" name="tgl_pinjam" value="">
                                </div>
                            </div>

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
                            <br><br>

                            <!-- Get Data Kategori Buku dan Buku -->

                            <div class="row mb-3">
                                <div class="col-sm-2">
                                    <label for="">Pilih Kategori</label>
                                </div>
                                <div class="col-sm-3">
                                    <select id="id_kategori" class="form-control">
                                        <option value="">Pilih Kategori</option>
                                        <?php while ($rowKategori = mysqli_fetch_assoc($queryKategori)) : ?>
                                            <option value="<?= $rowKategori['id'] ?>"><?= $rowKategori['nama_kategori'] ?>
                                            </option>
                                        <?php endwhile; ?>
                                    </select>
                                </div>
                            </div>


                            <div class="row mb-3">
                                <div class="col-sm-2">
                                    <label for="">Nama Buku</label>

                                </div>
                                <div class="col-sm-3">
                                    <select id="id_buku" class="form-control">
                                        <option value="">Pilih Buku</option>
                                        <?php while ($rowLevel = mysqli_fetch_assoc($anggota)) : ?>
                                            <option value="<?= $rowAnggota['id'] ?>"><?= $rowAnggota['nama_lengkap'] ?>
                                            </option>
                                        <?php endwhile; ?>
                                    </select>
                                </div>
                            </div>
                            <input type="hidden" id="tahun_terbit" name="">
                            <div class="mt-5 mb-5">
                                <div align="right" class="mb-3">
                                    <button type="button" id="tambah-row" class="btn btn-primary tambah-row">
                                        Tambah
                                    </button>
                                </div>
                                <table class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Kategori Buku</th>
                                            <th>Judul Buku</th>
                                            <th>Tahun Terbit</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>

                                    </tbody>
                                </table>

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