<?php

session_start();
include 'function/helper.php';
include 'config/koneksi.php';
//   "<h1>Selamat datang " . (isset($_SESSION['NAMA_LENGKAP']) ? $_SESSION['NAMA_LENGKAP'] : '') . "<h1>";

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Selamat Datang,</title>
    <link rel="stylesheet" href="bootstrap-5.3.3-dist/css/bootstrap.min.css">


    <style>
        /* body {
        /* background-image: url('anakpunk.jpg');
        background-size: cover; */
        /* } */
        */ nav.menu {
            background-color: white;
            box-shadow: 0 0 3px black;
        }
    </style>
</head>

<body>
    <div class="wrapper">
        <nav class="menu navbar navbar-expand-lg bg-body-tertiary">
            <div class="container-fluid">
                <a class="navbar-brand" href="#">Perpustakaan</a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                    data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                    aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav me-auto mb-2 mb-lg-0">

                        <!-- navbar Home -->
                        <li class="nav-item">
                            <a class="nav-link active" aria-current="page" href="?pg=home">Home</a>
                        </li>



                        <!-- Peminjaman -->
                        <li class="nav-item">
                            <a class="nav-link" href="?pg=peminjaman">Peminjaman</a>
                        </li>

                        <!-- Pengembalian -->
                        <li class="nav-item">
                            <a class="nav-link" href="?pg=pengembalian">Pengembalian</a>
                        </li>


                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown"
                                aria-expanded="false" id="navbarDropdown" data-bs-toggle="dropdown">
                                Master Data
                            </a>
                            <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                                <li><a class="dropdown-item" href="?pg=buku">Buku</a></li>
                                <li>
                                    <a class="dropdown-item" href="?pg=kategori">Kategori</a>
                                </li>
                                <li>
                                    <hr class="dropdown-divider">
                                </li>
                                <li>
                                    <a class="dropdown-item" href="?pg=level">Level</a>
                                </li>
                                <li>
                                    <a class="dropdown-item" href="?pg=users">User</a>
                                </li>
                                <li>
                                    <a class="dropdown-item" href="?pg=anggota">Anggota</a>
                                </li>

                            </ul>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" aria-disabled="true" href="../?pg=keluar">Keluar</a>
                        </li>
                    </ul>

                </div>
            </div>
        </nav>

        <!-- content start -->
        <?php
        if (isset($_GET['pg'])) {
            if (file_exists('content/' . $_GET['pg'] . '.php')) {
                include 'content/' . $_GET['pg'] . '.php';
            } else {
                echo 'not found';
            }
        } else {
            include 'content/home.php';
        }
        ?>
        <!-- content end -->
    </div>
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"
        integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.3/dist/umd/popper.min.js"
        integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.1.3/dist/js/bootstrap.min.js"
        integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous">
    </script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/2.9.2/umd/popper.min.js"
        integrity="sha512-2rNj2KJ+D8s1ceNasTIex6z4HWyOnEYLVC3FigGOmyQCZc2eBXKgOxQmo3oKLHyfcj53uz4QMsRCWNbLd32Q1g=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="bootstrap-5.3.3-dist/js/bootstrap.min.js"></script>
    <script src="bootstrap-5.3.3-dist/js/jquery-3.7.1.min.js"></script>
    <script src="bootstrap-5.3.3-dist/js/momentJs.js"></script>
    <script>
        $('#id_kategori').change(function() {
            let id = $(this).val();
            let option = ""
            $.ajax({
                url: "ajax/get-buku.php/?id_kategori=" + id,
                type: "GET",
                dataType: "json",
                success: function(data) {
                    option += "<option value=''>Pilih Buku</option>"
                    $.each(data, function(key, value) {
                        let tahun_terbit = $('#tahun_terbit').val(value.tahun_terbit);
                        option += "<option value=" + value.id + ">" + value.judul + "</option>"
                        console.log(data);

                    });
                    $('#id_buku').html(option)
                }
            })
        })

        $('#tambah-row').click(function() {
            // alert('duar');
            if ($('#id_kategori').val() == "") {
                alert('pilih dulu kategorinya kocak');
                return false;
            }
            if ($('#id_buku').val() == "") {
                alert('pilih dulu bukunya kocak');
                return false;
            }
            let nama_kategori = $('#id_kategori').find("option:selected").text(),
                nama_buku = $('#id_buku').find("option:selected").text(),
                tahun_terbit = $("#tahun_terbit").val(),
                id_kategori = $('#id_kategori').val(),
                id_buku = $('#id_buku').val();

            let tbody = $('tbody');
            let no = tbody.find('tr').length + 1;
            let table = "<tr>";

            table += "<td>" + no + "</td>";
            table += "<td>" + nama_kategori + " <input type='hidden' name=id_kategori[] value='" + id_kategori +
                "'></td>";
            table += "<td>" + nama_buku + "<input type='hidden' name=id_buku[] value='" + id_buku +
                "'></td>";
            table += "<td>" + tahun_terbit + "</td>";
            table += "<td><button type='button' class='remove btn btn-sm btn-success'>Delete</td>";

            table += "</tr>";

            tbody.append(table);

            $('.remove').click(function() {
                $(this).closest('tr').remove();
            })
        });

        $('#kode_peminjaman').change(function() {
            let id = $(this).val();
            console.log(id)
            $.ajax({
                url: "ajax/get-data-transaksi.php?kode_transaksi=" + id,
                type: "GET",
                dataType: "json",
                success: function(data) {
                    $('#nama_anggota').val(data.data.nama_lengkap);
                    $('#tanggal_pinjam').val(data.data.tgl_pinjam);
                    $('#tanggal_kembali').val(data.data.tgl_kembali);



                    let tbody = $('tbody')
                    newRow = "";
                    let no = tbody.find('tr').length + 1;
                    $.each(data.detail_pinjam, function(index, val) {
                        console.log('nilai sesudah di looping', val);
                        newRow += "<tr>";
                        newRow += "<td>" + (index + 1) + "</td>"
                        newRow += "<td>" + val.nama_kategori + "</td>"
                        newRow += "<td>" + val.judul + "</td>"
                        newRow += "<td>" + val.tahun_terbit + "</td>"
                        newRow += "</tr>";
                    });
                    tbody.html(newRow);


                    let tgl_kembali = new moment(data.data.tgl_kembali);
                    let tgl_pengembalian = new moment('2024-08-16');
                    let selisih = tgl_kembali.diff(tgl_pengembalian, 'days');
                    if (selisih < 0) {
                        selisih = 0
                    };
                    let denda = 10000;
                    let totalDenda = selisih * denda;
                    $('#denda').val(totalDenda);
                    $('#tgl_terlambat').val(selisih);
                    $('.total-denda').html("<h5>Rp." + totalDenda.toLocaleString('id-ID') + "</h5>");


                    // console.log('Rp', totalDenda.toLocaleString('id-ID'))
                }
            })
        });

        let tanggalSekarang = new Date();
        let formatIndonesia = new Intl.DateTimeFormat('id-ID', {
            year: 'numeric',
            month: '2-digit',
            day: '2-digit'
        }).format(tanggalSekarang);

        // let tgl_kembali = $('#tgl_kembali').val();
        // let tgl_pengembalian = $('#tgl_pengembalian');
        // let tamggal_2 = new moment('2024-08-12');
        // let tanggal_1 = new moment('2024-08-16');

        // let selisih = tanggal_1.diff(tamggal_2, 'days');
    </script>
</body>

</html>