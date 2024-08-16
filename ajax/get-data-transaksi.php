<?php


include "../config/koneksi.php";
// echo "halo";
if (isset($_GET['kode_transaksi'])) {
    $dataDetailPeminjam = [];

    $id = $_GET['kode_transaksi'];
    $queryTrans = mysqli_query($koneksi, "SELECT*FROM peminjaman LEFT JOIN anggota ON anggota.id = peminjaman.id_anggota WHERE peminjaman.id='$id'");
    $rowPeminjaman = mysqli_fetch_assoc($queryTrans);

    $queryDetailPinjam = mysqli_query($koneksi, "SELECT*FROM detail_peminjaman 
    LEFT JOIN kategori ON kategori.id=detail_peminjaman.id_kategori
    LEFT JOIN buku ON buku.id=detail_peminjaman.id_buku WHERE id_peminjaman='$id'");

    while ($rowDetaiPinjam = mysqli_fetch_assoc($queryDetailPinjam)) {
        $dataDetailPeminjam[] = $rowDetaiPinjam;
    }



    $respon = json_encode([
        'data' => $rowPeminjaman,
        'detail_pinjam' => $dataDetailPeminjam
    ]);
    echo $respon;
    // print_r($dataDetailPeminjam);
    // die;
}
