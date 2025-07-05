<?php
	if(!(isset($_SESSION['no_level']))) {	// jika administrator
		buat_session();
	}	
?>

<div class="table-responsive" style="height: 600px;">
  <table class="table table-striped table-bordered">
	<thead>
	  <tr>																						  
		<th style="width: 7%; text-align: center;">No</th>
		<th style="width: 10%; text-align: center;">DI.208</th>
		<th style="width: 10%; text-align: center;">TOWER</th>
		<th style="width: 10%; text-align: center;">RAK</th>
		<th style="width: 10%; text-align: center;">KOLOM</th>
		<th style="width: 10%; text-align: center;">BARIS</th>
		<th style="width: 10%; text-align: center;">LORONG</th>
		<th style="width: 10%; text-align: center;">ALBUM</th>
		<th style="width: 10%; text-align: center;">SCAN</th>
		
	<?php	
		if(cek_jabatan() == 1) {
	?>		<th style="width: 20%; text-align: center;"><i class="fa fa-cog"></i></th>	
	<?php	
		} 	
	?>
	
	  </tr>
	</thead>	
													  
	<tbody>											  
	  <?php 
		
		if(isset($_POST['btn_cari_warkah'])) {			// jika btn_cari_warkah di klik
		  $pdo = koneksi();		
		  $keyword_no_di208 = $txt_cari_di208_nomor;
		  $keyword_tahun_di208 = $txt_cari_di208_tahun;
		  
		  $sql = $pdo->prepare("SELECT DISTINCT warkah.id_warkah, warkah.id_tower, tower.nama_tower, warkah.nama_rak, warkah.no_rak, nomor_rak.rak_nomor, 
								warkah.id_kolom, kolom.no_kolom, baris.id_baris, baris.no_baris, lorong.id_lorong, lorong.posisi_lorong, 
								warkah.album_nomor, warkah.di_208_nomor, warkah.di_208_tahun, 
								warkah.scan, warkah.tgl_entri
						FROM warkah
						INNER JOIN tower ON warkah.id_tower = tower.id_tower
						INNER JOIN nomor_rak ON warkah.no_rak = nomor_rak.id_nomor_rak
						INNER JOIN kolom ON warkah.id_kolom = kolom.id_kolom
						LEFT JOIN baris ON warkah.id_baris = baris.id_baris
						LEFT JOIN lorong ON warkah.id_lorong = lorong.id_lorong
						WHERE warkah.di_208_nomor LIKE :keyword_no_di208
							  AND warkah.di_208_tahun LIKE :keyword_tahun_di208
						ORDER BY warkah.di_208_tahun, warkah.di_208_nomor ASC");
						
		  $sql->bindParam(':keyword_no_di208', $keyword_no_di208);
		  $sql->bindParam(':keyword_tahun_di208', $keyword_tahun_di208);
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
			  <td style="text-align: center;"><?php echo $row['posisi_lorong']; ?></td>
			  <td style="text-align: center;"><?php echo $row['album_nomor']; ?></td>

			  <td style="text-align: center;">
		<?php 
					$scan = $row['scan'];
					
					if($scan == "O")
						$scan = "Belum";
					elseif($scan == "I")
						$scan = "Sudah";
						
					echo $scan; 
		?>
			  </td>
		
		<?php	
			if(cek_jabatan() == 1) {	// jika administrator
		?>		<td style="text-align: center;">				
				<a class="btn btn-success btn-sm" href="javascript:void();" data-toggle="modal" data-target="#tambah-modal-warkah" data-backdrop="static"
					onclick="ubah_bukutanah('<?php echo $no; ?>');">&nbsp;ubah&nbsp;</a>	
				</a>
				
				<a class="btn btn-danger btn-sm" href="javascript:void();" data-toggle="modal" data-target="#delete-modal-warkah"
					onclick="hapus('<?php echo $row['id_warkah']; ?>','<?php echo $row['di_208_nomor']; ?>','<?php echo $row['di_208_tahun']; ?>');">hapus</a>	
				</a>
			
			  </td>	
		<?php	
			} 
		?>	  
			</tr>
			
			<input type="hidden" id="id_warkah-value-<?php echo $no; ?>" value="<?php echo $row['id_warkah']; ?>">
			<input type="hidden" id="id_tower-value-<?php echo $no; ?>" value="<?php echo $row['id_tower']; ?>">
			<input type="hidden" id="nama_rak-value-<?php echo $no; ?>" value="<?php echo $row['nama_rak']; ?>">
			<input type="hidden" id="no_rak-value-<?php echo $no; ?>" value="<?php echo $row['no_rak']; ?>">
			<input type="hidden" id="id_kolom-value-<?php echo $no; ?>" value="<?php echo $row['id_kolom']; ?>">
			<input type="hidden" id="id_baris-value-<?php echo $no; ?>" value="<?php echo $row['id_baris']; ?>">
			<input type="hidden" id="id_lorong-value-<?php echo $no; ?>" value="<?php echo $row['id_lorong']; ?>">
			<input type="hidden" id="album_nomor-value-<?php echo $no; ?>" value="<?php echo $row['album_nomor']; ?>">
			<input type="hidden" id="di_208_nomor-value-<?php echo $no; ?>" value="<?php echo $row['di_208_nomor']; ?>">
			<input type="hidden" id="di_208_tahun-value-<?php echo $no; ?>" value="<?php echo $row['di_208_tahun']; ?>">
			<input type="hidden" id="scan-value-<?php echo $no; ?>" value="<?php echo $row['scan']; ?>">
	  <?php	  
			$no++;
		  }
		}  
	  ?>  
	</tbody>
  </table>
</div>


<script>

	function ubah_bukutanah(no) {
		var id_warkah = $("#id_warkah-value-" + no).val();
		var id_tower = $("#id_tower-value-" + no).val();
		var nama_rak = $("#nama_rak-value-" + no).val();
		var no_rak = $("#no_rak-value-" + no).val();
		var id_kolom = $("#id_kolom-value-" + no).val();

		var id_baris = $("#id_baris-value-" + no).val();
		var id_lorong = $("#id_lorong-value-" + no).val();

		var album_nomor = $("#album_nomor-value-" + no).val();
		var di_208_nomor = $("#di_208_nomor-value-" + no).val();
		var di_208_tahun = $("#di_208_tahun-value-" + no).val();
		var scan = $("#scan-value-" + no).val();
		
		$("#hidden_warkah_id").val(id_warkah);
		$("#tower").val(id_tower);
		
		if(nama_rak == 'A') {
			$('.nama_rak[value="A"]').iCheck('check');
		}
		else {
			$('.nama_rak[value="B"]').iCheck('check');
		}
		
		$("#nomor_rak").val(no_rak);
		$("#kolom").val(id_kolom);
		
		if(id_baris) {	// jika id baris terisi
			$("#baris").val('1').change();
			$("#baris_lorong").val(id_baris);
								
		} else if(id_lorong) {	// jika id_lorong terisi
			$("#baris").val('2').change();

		} else {
			$("#baris").val('0').change();
		}

		$("#album_nomor").val(album_nomor);
		
		album_tidak_aktif(false);
		$("#btn_tambah_album").hide();
		$("#btn_simpan_album").hide();
		
		$("#di208_nomor").val(di_208_nomor);
		$("#di208_tahun").val(di_208_tahun);
		
		if(scan == 'I') {
			$('.scan_warkah[value="I"]').iCheck('check');
		}
		else {
			$('.scan_warkah[value="O"]').iCheck('check');
		}
		
		di208_tidak_aktif(false);
		$("#btn_simpan_di208").hide();
		$("#btn_ubah_di208").show();
		
		$("#pesan-simpan, #pesan-sukses, #pesan-eror").hide();
	}

	// Fungsi ini akan dipanggil ketika tombol hapus diklik
	function hapus(id_warkah, di208_nomor, di208_tahun){
		$("#id_warkah_hapus").val(id_warkah);
		$("#di208_nomor_hapus").val(di208_nomor);
		$("#di208_tahun_hapus").val(di208_tahun);
		
		$("#label_hapus_warkah").html("DI.208 : " + di208_nomor + " / " + di208_tahun + " akan dihapus ? "); 
	}
	
</script>