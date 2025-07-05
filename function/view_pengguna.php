<?php
	if(!(isset($_SESSION['no_level']))) {	
		buat_session();
	}	
?>

<div class="table-responsive" style="height: 600px;">
  <table class="table table-striped table-bordered">
	<thead>
	  <tr>																						  
		<th style="width: 7%; text-align: center;">No</th>
		<th style="width: 13%; text-align: center;">username</th>
		<th style="width: 30%; text-align: center;">Nama</th>
		<th style="width: 10%; text-align: center;">Otoritas</th>
		<th style="width: 10%; text-align: center;"><i class="fa fa-cog"></i></th>
	  </tr>
	</thead>	
													  
	<tbody>											  
	  <?php 
		
		if(isset($_POST['btn_cari_nama'])) {			// jika btn_cari_nama di klik
		  $pdo = koneksi();		
		  $keyword_username = '%'.$txt_cari_nama.'%';
		  
		  $sql = $pdo->prepare("SELECT DISTINCT username.username, username.password, username.nama, username.no_level, username_level.otoritas
						FROM username, username_level
						WHERE username.no_level = username_level.no_level
							  AND (username.username LIKE :keyword_username OR username.nama LIKE :keyword_username)
						ORDER BY username.nama");
						
		  $sql->bindParam(':keyword_username', $keyword_username);
		  $sql->execute(); // Eksekusi query insert
		  
		  $no = 1;
		  while($row = $sql->fetch()) {
		?>	  
			<tr>
			  <td style="text-align: center;"><?php echo $no; ?></td>
			  <td style="text-align: center;"><?php echo $row['username']; ?></td>
			  <td style="text-align: center;"><?php echo $row['nama']; ?></td>
			  <td style="text-align: center;"><?php echo $row['otoritas']; ?></td>

			  <td style="text-align: center;">				
				<a class="btn btn-success btn-sm" href="javascript:void();" data-toggle="modal" data-target="#tambah-modal-username" data-backdrop="static"
					onclick="ubah_username('<?php echo $no; ?>');">&nbsp;ubah&nbsp;</a>	
				</a>
				
				<a class="btn btn-danger btn-sm" href="javascript:void();" data-toggle="modal" data-target="#delete-modal-username"
					onclick="hapus('<?php echo $row['username']; ?>','<?php echo $row['nama']; ?>');">hapus</a>	
				</a>
			
			  </td>	
		  
			</tr>
			
			<input type="hidden" id="username-value-<?php echo $no; ?>" value="<?php echo $row['username']; ?>">
			<input type="hidden" id="password-value-<?php echo $no; ?>" value="<?php echo $row['password']; ?>">
			<input type="hidden" id="nama-value-<?php echo $no; ?>" value="<?php echo $row['nama']; ?>">
			<input type="hidden" id="no_level-value-<?php echo $no; ?>" value="<?php echo $row['no_level']; ?>">
			<input type="hidden" id="otoritas-value-<?php echo $no; ?>" value="<?php echo $row['otoritas']; ?>">
	  <?php	  
			$no++;
		  }
		}  
	  ?>  
	</tbody>
  </table>
</div>


<script>

	function ubah_username(no) {
		var username = $("#username-value-" + no).val();
		var password = $("#password-value-" + no).val();
		var nama = $("#nama-value-" + no).val();
		var no_level = $("#no_level-value-" + no).val();
		var otoritas = $("#otoritas-value-" + no).val();
		
		$("#hidden_username").val(username);
		$("#txt_username").val(username);
		$("#txt_nama").val(nama);
		$("#txt_password").val(password);
		$("#otoritas").val(no_level);
		
		$("#btn_simpan_pengguna").hide();
		$("#pesan-sukses-pengguna").hide();
	}

	// Fungsi ini akan dipanggil ketika tombol hapus diklik
	function hapus(username, nama){
		$("#username_hapus").val(username);
		
		$("#label_hapus_username").html("Nama : " + nama + ", username : " + username + " akan dihapus ? "); 
	}
	
</script>