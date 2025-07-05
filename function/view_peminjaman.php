<?php
	if(!(isset($_SESSION['no_level']))) {	
		buat_session();
	}	
?>

<div class="table-responsive" style="height: 600px;">
  <table class="table table-striped table-bordered">
	<thead>
	  <tr>																						  
		<th style="width: 4%; text-align: center;">No</th>
		<th style="width: 5%; text-align: center;">POSISI</th>
		<th style="width: 5%; text-align: center;">INFO</th>
		<th style="width: 10%; text-align: center;">DI.208</th>
		<th style="width: 5%; text-align: center;">TOWER</th>
		<th style="width: 5%; text-align: center;">RAK</th>
		<th style="width: 5%; text-align: center;">KOLOM</th>
		<th style="width: 5%; text-align: center;">BARIS</th>
		<th style="width: 5%; text-align: center;">ALBUM</th>
	  </tr>
	</thead>	
													  
	<tbody>											  
	  <?php 
		
		if(isset($_POST['btn_cari_peminjaman'])) {			// jika btn_cari_peminjaman di klik
		  $pdo = koneksi();		
		  		  
		  $sql = $pdo->prepare("SELECT DISTINCT peminjaman.id_peminjaman, warkah.id_warkah, tower.nama_tower, warkah.nama_rak, warkah.no_rak, 
		  										nomor_rak.rak_nomor, kolom.no_kolom, baris.no_baris, warkah.album_nomor, warkah.di_208_nomor, 
												warkah.di_208_tahun, peminjaman.status, peminjaman.keterangan, peminjaman.tgl_peminjaman, 
												isi_peminjaman.peminjam, isi_peminjaman.keperluan
								FROM warkah 
								LEFT JOIN (peminjaman LEFT JOIN isi_peminjaman ON peminjaman.id_peminjaman = isi_peminjaman.id_isi_peminjaman) 
										  ON warkah.id_warkah = peminjaman.id_warkah                        
								INNER JOIN tower ON warkah.id_tower = tower.id_tower
								INNER JOIN nomor_rak ON warkah.no_rak = nomor_rak.id_nomor_rak
								INNER JOIN kolom ON warkah.id_kolom = kolom.id_kolom
								INNER JOIN baris ON warkah.id_baris = baris.id_baris
								WHERE warkah.di_208_nomor = :keyword_peminjaman
										AND warkah.di_208_tahun = :keyword_peminjaman_tahun
								ORDER BY peminjaman.tgl_peminjaman DESC LIMIT 1");

		  $sql->bindParam(':keyword_peminjaman', $cari_peminjaman);		// $cari_peminjaman berasal dari cari_peminjaman.php
		  $sql->bindParam(':keyword_peminjaman_tahun', $cari_peminjaman_tahun);		// $cari_peminjaman_tahun berasal dari cari_peminjaman.php
		  $sql->execute(); // Eksekusi query insert
		  
		  $no = 1;
		  while($row = $sql->fetch()) {
		?>	  
			<tr>
			  <td style="text-align: center;"><?php echo $no; ?></td>

			  <td style="text-align: center;">
				<?php
					
					if($row['status'] == "I") {
						$keterangan = "DIPINJAM";

					} elseif($row['status'] == "A") {
						$keterangan = "DIKEMBALIKAN";
						
					} else {
						$keterangan = "ARSIP";
					}
					
				?>

				<a class="btn btn-danger btn-sm" href="javascript:void();" data-toggle="modal" data-target="#modal-peminjaman" data-backdrop="static"
					onclick="info_modal('<?php echo $no; ?>', '<?php echo $keterangan; ?>');"><?php echo $keterangan; ?></a>	
				</a>	
			  </td>

			  <td style="text-align: center;">
				<a target="_blank" href="info.php?id_warkah=<?php echo $row['id_warkah']; ?>" class="btn btn-info btn-sm">INFO</a>
			  </td>

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

			</tr>
			
			<input type="hidden" id="id_peminjaman-value-<?php echo $no; ?>" value="<?php echo $row['id_peminjaman']; ?>">
			<input type="hidden" id="id_warkah_peminjaman-value-<?php echo $no; ?>" value="<?php echo $row['id_warkah']; ?>">
			<input type="hidden" id="di_208_nomor_peminjaman-value-<?php echo $no; ?>" value="<?php echo $row['di_208_nomor']; ?>">
			<input type="hidden" id="di_208_tahun_peminjaman-value-<?php echo $no; ?>" value="<?php echo $row['di_208_tahun']; ?>">
			<input type="hidden" id="tower_peminjaman-value-<?php echo $no; ?>" value="<?php echo $row['nama_tower']; ?>">
			<input type="hidden" id="nama_rak_peminjaman-value-<?php echo $no; ?>" value="<?php echo $row['nama_rak']; ?>">
			<input type="hidden" id="no_rak_peminjaman-value-<?php echo $no; ?>" value="<?php echo $row['no_rak']; ?>">
			<input type="hidden" id="kolom_peminjaman-value-<?php echo $no; ?>" value="<?php echo $row['no_kolom']; ?>">
			<input type="hidden" id="baris_peminjaman-value-<?php echo $no; ?>" value="<?php echo $row['no_baris']; ?>">
			<input type="hidden" id="album_nomor_peminjaman-value-<?php echo $no; ?>" value="<?php echo $row['album_nomor']; ?>">			
			<input type="hidden" id="info-value-<?php echo $no; ?>" value="<?php echo $row['status']; ?>">
			<input type="hidden" id="keterangan-value-<?php echo $no; ?>" value="<?php echo $row['keterangan']; ?>">
			<input type="hidden" id="peminjam-value-<?php echo $no; ?>" value="<?php echo $row['peminjam']; ?>">
			<input type="hidden" id="keperluan-value-<?php echo $no; ?>" value="<?php echo $row['keperluan']; ?>">
	  <?php	  
			$no++;
		  }
		}  
	  ?>  
	</tbody>
  </table>
</div>


<script>

	function info_modal(no, posisi_warkah) {
		var id_peminjaman = $("#id_peminjaman-value-" + no).val();
		var id_warkah_peminjaman = $("#id_warkah_peminjaman-value-" + no).val();

		var isi_208_nomor = $("#di_208_nomor_peminjaman-value-" + no).val();
		var isi_208_tahun = $("#di_208_tahun_peminjaman-value-" + no).val();
		var tower = $("#tower_peminjaman-value-" + no).val();
		var rak = $("#nama_rak_peminjaman-value-" + no).val();
		var kolom = $("#kolom_peminjaman-value-" + no).val();
		var baris = $("#baris_peminjaman-value-" + no).val();
		var album = $("#album_nomor_peminjaman-value-" + no).val();
		var info = $("#info-value-" + no).val();
		var keterangan = $("#keterangan-value-" + no).val();
		var peminjam = $("#peminjam-value-" + no).val();
		var keperluan = $("#keperluan-value-" + no).val();

		if(info == "I") {
			$("#btn_kembalikan_peminjaman").show();
			$("#btn_simpan_peminjaman, #btn_terima_warkah").hide();

			$("#isi_peminjam_pertama, #isi_keperluan").attr("disabled", true);
			$("#isi_peminjam_teruskan, #btn_peminjam_teruskan, #isi_keperluan_teruskan").removeAttr("disabled");
		}
		else if(info == "A") {
			$("#btn_terima_warkah").show();
			$("#btn_simpan_peminjaman, #btn_kembalikan_peminjaman").hide();	
			
			$("#isi_peminjam_pertama, #isi_keperluan").attr("disabled", true);
			$("#isi_peminjam_teruskan, #btn_peminjam_teruskan, #isi_keperluan_teruskan").attr("disabled", true);
		}
		else {
			$("#btn_simpan_peminjaman").show();
			$("#btn_terima_warkah, #btn_kembalikan_peminjaman").hide();

			$("#isi_peminjam_pertama, #isi_keperluan, #btn_simpan_peminjaman").removeAttr("disabled", true);
			$("#isi_peminjam_teruskan, #btn_peminjam_teruskan, #isi_keperluan_teruskan").attr("disabled", true);
		}

		$("#isi_di208_peminjaman").html(`${isi_208_nomor}/${isi_208_tahun}`);
		$("#isi_tower_peminjaman").html(`${tower}`);
		$("#isi_rak_peminjaman").html(`${rak}`);
		$("#isi_kolom_peminjaman").html(`${kolom}`);
		$("#isi_baris_peminjaman").html(`${baris}`);
		$("#isi_album_peminjaman").html(`${album}`);

		$("#isi_peminjam_pertama").val(peminjam);
		$("#isi_keperluan").val(keperluan);


		$("#hidden_status_peminjaman").val(info);
		$("#hidden_id_peminjaman").val(id_peminjaman);
		$("#hidden_id_warkah_peminjaman").val(id_warkah_peminjaman);

		// if(posisi_warkah == "ARSIP") {
		// 	// $("#btn_simpan_peminjaman").show();
		// 	// $("#btn_kembalikan_peminjaman, #btn_terima_warkah").hide();

		// 	$("#isi_peminjam_pertama, #isi_keperluan, #btn_simpan_peminjaman").attr("enabled", true);

		// 	$("#isi_peminjam_teruskan, #btn_peminjam_teruskan, #isi_keperluan_teruskan").attr("disabled", true);
		
		// } else if(posisi_warkah == "DIPINJAM") {
		// 	$("#isi_peminjam_pertama, #isi_keperluan").attr("disabled", true);
		// 	$("#isi_peminjam_teruskan, #btn_peminjam_teruskan, #isi_keperluan_teruskan").attr("enabled", true);

		// } 	
		
	}

</script>