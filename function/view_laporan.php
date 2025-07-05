<div class="table-responsive" style="height: 600px;">
  <table class="table table-striped table-bordered">
	<thead>
	  <tr>																						  
		<th style="width: 7%; text-align: center;">No</th>
		<th style="width: 23%; text-align: center;">DI.208</th>
		<th style="width: 10%; text-align: center;">TOWER</th>
		<th style="width: 10%; text-align: center;">RAK</th>
		<th style="width: 10%; text-align: center;">KOLOM</th>
		<th style="width: 10%; text-align: center;">BARIS</th>
		<th style="width: 15%; text-align: center;">ALBUM</th>
	  </tr>
	</thead>	
													  
	<tbody>											  
	  <?php 
		
		if(isset($_POST['btn_laporan'])) {			// jika btn_cari_warkah di klik
		  $pdo = koneksi();		
		  $keyword_laporan = $txt_cari_laporan;
		  
		  $sql = $pdo->prepare("SELECT DISTINCT warkah.id_warkah, warkah.id_tower, tower.nama_tower, warkah.nama_rak, warkah.no_rak, nomor_rak.rak_nomor, 
								warkah.id_kolom, kolom.no_kolom, warkah.id_baris, baris.no_baris, warkah.album_nomor, warkah.di_208_nomor, warkah.di_208_tahun, 
								warkah.scan, warkah.tgl_entri
						FROM warkah, tower, nomor_rak, kolom, baris
						WHERE warkah.id_tower = tower.id_tower
							  AND warkah.no_rak = nomor_rak.id_nomor_rak
							  AND warkah.id_kolom = kolom.id_kolom
							  AND warkah.id_baris = baris.id_baris
							  AND warkah.album_nomor = :keyword_laporan
						ORDER BY warkah.di_208_tahun, warkah.di_208_nomor ASC");
						
		  $sql->bindParam(':keyword_laporan', $keyword_laporan);
		  $sql->execute(); // Eksekusi query insert
		  
		  $no = 1;
		  while($row = $sql->fetch()) {
		?>	  
			<tr>
			  <td style="text-align: center;"><?php echo $no; ?></td>
			  <td style="text-align: center;">
				<?php 
					echo $row['di_208_nomor']; 
					echo " / ";
					echo $row['di_208_tahun'];
				?>
			  </td>
			  <td style="text-align: center;"><?php echo $row['nama_tower']; ?></td>
			  <td style="text-align: center;">
				<?php 
					echo $row['nama_rak']; 
					echo ".";
					echo $row['rak_nomor'];
				?>
			  </td>
			  <td style="text-align: center;"><?php echo $row['no_kolom']; ?></td>
			  <td style="text-align: center;"><?php echo $row['no_baris']; ?></td>
			  <td style="text-align: center;"><?php echo $row['album_nomor']; ?></td>
			  <td style="text-align: center;">

			  </td>
			  
			</tr>
	  <?php	  
			$no++;
		  }
		}  
	  ?>  
	</tbody>
  </table>
</div>