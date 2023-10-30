<?php
session_start();
include "top.php";
require "system/sistem.php";
dbConnect();
$produkid = $_GET['product_id'];
$umkmid = $_GET['umkm_id'];
$namaProduk = $_GET['product_name'];
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Ambil data dari formulir
    $namaPemesan = $_POST["nama-pemesan"];
    $tanggalPesan = $_POST["tanggal-pesan"];
    $alamatPengirim = $_POST["alamat-pengirim"];
    $keterangan = $_POST["keterangan"];
    $notelepon = $_POST["no-telepon"];

    // Di sini, Anda juga perlu mengambil ID produk yang dipesan dari formulir atau sesuai kebutuhan
    // ID produk dapat ditempatkan dalam hidden input di formulir di halaman order.php

    // Selanjutnya, Anda dapat menyimpan data pemesanan ke dalam tabel pesanan
    $query = "INSERT INTO pesanan (umkmid, produkid, nama, tanggal, alamat, keterangan, notelepon)
            VALUES ($umkmid, $produkid, '$namaPemesan', '$tanggalPesan', '$alamatPengirim', '$keterangan', '$notelepon')"; // Gantilah 1 dengan ID UMKM yang sesuai
    
    mysqli_query($dbconn, $query);
    
    $queryGetNoHp = "SELECT nohp FROM register WHERE umkmid = $umkmid";

    $result = mysqli_query($dbconn, $queryGetNoHp);

    if ($result) {
        $row = mysqli_fetch_assoc($result);

        if ($row) {
            $nohp = $row['nohp'];

            // Mengecek apakah nomor telepon dimulai dengan "0"
            if (substr($nohp, 0, 1) === '0') {
                // Jika dimulai dengan "0", ganti menjadi "62" dan tambahkan karakter-karakter selanjutnya
                $nohp = '62' . substr($nohp, 1);
            }

            $pesanKonfirmasi = "Halo, saya adalah $namaPemesan. Saya ingin menanyakan apakah saya dapat memesan produk $namaProduk. Saya telah melakukan pemesanan pada tanggal $tanggalPesan dan akan mengirimkannya ke alamat $alamatPengirim. Terima kasih. Silakan hubungi saya di nomor whatsapp ini jika Anda memerlukan informasi lebih lanjut.";



            header("Location: https://wa.me/$nohp?text=" . urlencode($pesanKonfirmasi));
            exit;
        } else {
            echo "Tidak ada hasil yang ditemukan untuk umkmid tersebut.";
        }
    } else {
        echo "Terjadi kesalahan dalam menjalankan query: " . mysqli_error($dbconn);
    }

    mysqli_free_result($result);

}
?>
<style>
        body {
            background-color: #f7f7f7;
        }

        .container-order {
            background-color: #fff;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            padding: 20px;
            margin-top: 20px;
        }

        .form-control {
            border: 2px solid #d1d1d1;
            border-radius: 5px;
            font-size: 16px;
            padding: 10px;
        }

        .form-group label {
            font-weight: 500;
            font-size: 18px;
            color: #333;
        }
    </style>

<div class="container container-order">
        <h2 class="mt-4">Form Pesanan</h2>
        <form action="" method="post">
          <input type="hidden" value="<= echo ?>">
          <div class="form-group">
            <label for="nama-pemesan">Nama Pelanggan:</label>
            <input type="text" class="form-control" id="nama-pemesan" name="nama-pemesan" required>
          </div>

          <div class="form-group">
              <label for="tanggal-pesan">Tanggal Pesanan:</label>
              <input type="date" class="form-control" id="tanggal-pesan" name="tanggal-pesan" required>
          </div>

            <div class="form-group">
                <label for="alamat-pengirim">Alamat Pengiriman:</label>
                <textarea class="form-control" id="alamat-pengirim" name="alamat-pengirim" rows="4" required></textarea>
            </div>

            <div class="form-group">
                <label for="no-telepon">No Telepon:</label>
                <textarea class="form-control" id="no-telepon" name="no-telepon" rows="4" required></textarea>
            </div>

            <div class="form-group">
                <label for="keterangan">Keterangan:</label>
                <textarea class="form-control" id="keterangan" name="keterangan" rows="4"></textarea>
            </div>

            <!-- Tambahkan input untuk Produk atau Barang yang Dipesan (Ordered Products/Items) jika diperlukan -->
            <div class="form-group text-right">
              <button type="submit" class="btn btn-lg btn-primary">Buat Pesanan</button>
            </div>
        </form>
    </div>

<?php
include "bottom.php";
?>