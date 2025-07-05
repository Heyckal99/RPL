<?php  ob_start(); ?>

<html>
<head>
  <title>Cetak PDF</title>
    
   <style>
        table {border-collapse:collapse; table-layout:fixed;width: 630px;}
        table td {word-wrap:break-word;width: 20%;}
   </style>
   
</head>
<body>
  
<table border="1" width="100%">
    <tr>
        <th>DI.208</th>
        <th>Nama</th>
        <th>Posisi</th>
        <th>Tanggal Peminjaman</th>
        <th>Peminjam</th>
        <th>Keperluan</th>
    </tr>

    <?php
        include "function/function.php";
        
        buat_session();
        cek_session();

        $id_warkah = $_GET['id_warkah'];
        
        $query = "SELECT DISTINCT peminjaman.id_peminjaman, warkah.id_warkah, tower.nama_tower, warkah.nama_rak, warkah.no_rak, 
                                    nomor_rak.rak_nomor, kolom.no_kolom, baris.no_baris, warkah.album_nomor, warkah.di_208_nomor, 
                                warkah.di_208_tahun, username.nama, peminjaman.status, peminjaman.keterangan, peminjaman.tgl_peminjaman, 
                                isi_peminjaman.peminjam, isi_peminjaman.keperluan
                    FROM warkah 
                    LEFT JOIN (peminjaman LEFT JOIN isi_peminjaman ON peminjaman.id_peminjaman = isi_peminjaman.id_isi_peminjaman) 
                    ON warkah.id_warkah = peminjaman.id_warkah                        
                    INNER JOIN tower ON warkah.id_tower = tower.id_tower
                    INNER JOIN nomor_rak ON warkah.no_rak = nomor_rak.id_nomor_rak
                    INNER JOIN kolom ON warkah.id_kolom = kolom.id_kolom
                    INNER JOIN baris ON warkah.id_baris = baris.id_baris  
                    INNER JOIN username ON peminjaman.username = username.username                              
                    WHERE warkah.id_warkah = :id_warkah
                    ORDER BY peminjaman.tgl_peminjaman DESC"; 

        $pdo = koneksi();
        $sql = $pdo->prepare($query);
        $sql->bindParam(':id_warkah', $id_warkah);
        $sql->execute();

        while($data = $sql->fetch()) {
            $tgl_peminjaman = ubah_tglwaktu_sql($data['tgl_peminjaman']);
            echo "<tr>";
            echo "<td style='width: 10%';>".$data['di_208_nomor']."/".$data['di_208_tahun']."</td>";
            echo "<td style='width: 20%';>".$data['nama']."</td>";
            echo "<td style='width: 10%';>".$data['keterangan']."</td>";
            echo "<td style='width: 15%';>".$tgl_peminjaman."</td>";
            echo "<td style='width: 20%';>".$data['peminjam']."</td>";
            echo "<td style='width: 25%';>".$data['keperluan']."</td>";
            echo "</tr>";
        }   
   ?>

</table>
</body>
</html>

<?php
    $html = ob_get_contents();
    ob_end_clean();
            
    require 'html2pdf/autoload.php';
    $pdf = new Spipu\Html2Pdf\Html2Pdf('L','A4','en');
    $pdf->pdf->SetDisplayMode('fullpage');
    $pdf->WriteHTML($html);
    $pdf->Output('info warkah.pdf');
?>