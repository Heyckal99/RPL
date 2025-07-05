<?php		
	include "function/function.php";
	
	buat_session();
	cek_session();
?>


<!DOCTYPE html>
<html lang="en">
  <head>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
	<!-- Meta, title, CSS, favicons, etc. -->
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">

	<title>Aplikasi Warkah </title>

	<!-- Bootstrap -->
	<link href="vendors/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
	<!-- Font Awesome -->
	<link href="vendors/font-awesome/css/font-awesome.min.css" rel="stylesheet">
	
	<!-- sweetalert -->
	<link href="vendors/sweetalert/css/sweetalert2.min.css" rel="stylesheet"> 
	
	<!-- iCheck -->
	<link href="vendors/iCheck/skins/flat/green.css" rel="stylesheet">
	
	<!-- Custom Theme Style -->
	<link href="build/css/custom.min.css" rel="stylesheet">
	<link href="build/css/bootstrap-select.min.css" rel="stylesheet">
	
  </head>

	<body class="nav-md">
		<?php 
			include "function/layout.php"; 
		?>
		
		<div class="container body">
		  <div class="main_container">
			<div class="col-md-3 left_col">
			  <div class="left_col scroll-view">
				<?php view_nav_title(); ?>  <!-- function for view title -->

				<div class="clearfix"></div>
				<br/>
				<br/>
				<br/>

				<!-- sidebar menu -->
				<div id="sidebar-menu" class="main_menu_side hidden-print main_menu">
				  <div class="menu_section">					
					<?php view_nav_left(); ?>	<!-- function for view nav menu  -->
				  </div>				 
				</div>
				<!-- /sidebar menu -->
			  </div>
			</div>

			<!-- top navigation -->
			<div class="top_nav">
			  <?php top_navigation(); ?>  <!-- function for top navigation  -->
			</div>
			<!-- /top navigation -->

			<!-- page content -->
			<div class="right_col" role="main">
				<div class="">
					<div class="page-title">
						<div class="title_left">
							<h3></h3>
						</div>
					</div>
					<div class="clearfix"></div>
					
					<div class="row">
						<div class="col-md-12 ">
							<div class="x_panel">
								<div class="x_title">
									<h2>Warkah</h2>
									<div class="clearfix"></div>
								</div>
								<div class="x_content">
									<br />
									<form id="form_cari_pengguna" class="form-horizontal form-label-left">

										<div class="item form-group">
											<div class="col-md-2 col-sm-2"></div>
										
											<div class="col-md-4 col-sm-4">							
												<input type="text" id="txt_cari_di208_nomor" name="txt_cari_di208_nomor" class="form-control" placeholder="Nomor DI.208">
											</div>
											
											<div class="col-md-3 col-sm-3">							
												<input type="text" id="txt_cari_di208_tahun" name="txt_cari_di208_tahun" class="form-control" placeholder="Tahun DI.208">
											</div>
											
											<div class="col-md-3 col-sm-3">
												<button type="button" class="btn btn-info" id="btn_cari_warkah" name="btn_cari_warkah">Cari</button>
												
												<button type="button" class="btn btn-success" id="btn_tambah_warkah"
															data-toggle="modal" data-target="#tambah-modal-warkah" data-backdrop="static">Tambah
												</button>											
												
											</div>
										</div>
									</form>	
									
									<h5>&nbsp;</h5>
									<div class="col-md-12 col-sm-12">
										<div id="tampilkan_data_warkah"><?php include "function/view_warkah.php"; ?> </div>
									</div>
								</div>
							</div>
						</div>
					</div>	  
				</div>
			</div>
			
			<div id="delete-modal-warkah" class="modal fade">
				<div class="modal-dialog">
					<div class="modal-content">
						<div class="modal-header">
							<h4 class="modal-title">
								Konfirmasi
							</h4>
							
							<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>							
						</div>
						<div class="modal-body">
							<input type="hidden" id="id_warkah_hapus">
							<input type="hidden" id="di208_nomor_hapus">
							<input type="hidden" id="di208_tahun_hapus">
							
							<span id="label_hapus_warkah"></span>
						</div>
						<div class="modal-footer">
							<!-- Beri id "btn-hapus" untuk tombol hapus nya -->
							<button type="button" class="btn btn-danger" id="btn_hapus_warkah">Ya</button>  
							
							<button type="button" class="btn btn-primary" data-dismiss="modal">Tidak</button>
						</div>
					</div>
				</div>
			</div>
			
			
			<div id="tambah-modal-warkah" class="modal fade">
				<div class="modal-dialog">
					<div class="modal-content">
						<div class="modal-header">							
							<h4 class="modal-title" id="modal-warkah-title">
								<!-- Beri id "modal-title" untuk tag span pada judul modal -->
								input warkah
							</h4>
							<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
						</div>
						
						<div class="modal-body">
							<form id="form">
								
							  <!--	hidden data pada saat klik tombol simpan atau untuk keperluan ubah data pada form index.php	-->	
							  <input type="hidden" id="hidden_warkah_id" />  <!-- hidden untuk data id warkah -->	
							  <input type="hidden" id="hidden_tower_id" />  <!-- hidden untuk data id tower -->
							  <input type="hidden" id="hidden_nama_rak" />
							  <input type="hidden" id="hidden_no_rak" />
							  <input type="hidden" id="hidden_kolom_id" />
							  <input type="hidden" id="hidden_baris_id" />
							  <input type="hidden" id="hidden_baris_lorong_id" />
							  <input type="hidden" id="hidden_album_no" />
							  
							  <div class="form-group">
								
							  </div>
							  
							  <div class="form-group">
								<select name="tower" id="tower" class="form-control" data-width="100%">
								  <option value="0">Pilih Tower...</option>
								  <?php 									
										tower();
								  ?>								
								</select>
							  </div>
							  
							  <div class="form-group" style="font-size: 1rem; font-style:inherit;">
								<label>Rak</label>								
								
									<span style="margin: 0 0 0 10px;"> A: <input type="radio" class="nama_rak" name="nama_rak" value="A" /> </span> 
									<span style="margin: 0 0 0 10px;"> B: <input type="radio" class="nama_rak" name="nama_rak" value="B" /> </span>
									<span style="margin: 0 0 0 10px;"> C: <input type="radio" class="nama_rak" name="nama_rak" value="C" /> </span>
									<span>
										<select name="nomor_rak" id="nomor_rak" class= "form-control" data-live-search="true">
										  <option value="0">Pilih Nomor Rak...</option>
											<?php 									
												nomor_rak();
										    ?>
										</select>	  																										
									</span>
							  </div>
							  
							  <div class="form-group">
								<select name="kolom" id="kolom" class="form-control" data-width="100%">
								  <option value="0">Pilih Kolom...</option>
								  <?php 									
										kolom();
								  ?>								
								</select>
							  </div>
							  
							  <div class="form-group">
								<select name="baris" id="baris" class="form-control" data-width="100%">
								  <option value="0">Pilih Baris atau Lorong...</option>								  								
								  <option value="1">Baris</option>								  								
								  <option value="2">Lorong</option>								  								
								</select>
							  </div>

							  <div class="form-group">
								<select name="baris_lorong" id="baris_lorong" class="form-control" data-width="100%">
								  <option value="0">Pilih Posisi...</option>								  							
								</select>
							  </div>
							  
							  <div class="form-group">
								<input type="text" class="form-control" maxlength="12" id="album_nomor" name="album_nomor" placeholder="No Album" 
										onkeypress="return hanyaAngka(event)"/>
							  </div>

							  <button type="button" class="btn btn-success pull-right" id="btn_tambah_album">Tambah Album</button>
							  <button type="button" class="btn btn-danger pull-right" id="btn_simpan_album">Simpan</button>					
							  
							</form>
							
							<div class="form-group" style="margin-top: 20px;">
							  <span>
								<input type="text" style="width:60%; display:inline; margin-right: 10px;" class="form-control" maxlength="10" id="di208_nomor" placeholder="No DI.208..." 
										onkeypress="return hanyaAngka(event)" />
							  </span>
							  
							  <span>
								<input type="text" style="width:36%; display:inline;" class="form-control" maxlength="4" id="di208_tahun" placeholder="Tahun DI.208..." 
										onkeypress="return hanyaAngka(event)" />
							  </span>
						
							</div>
						
						<div class="modal-footer">
							<span id="pesan-simpan" style="color: black;">sedang menyimpan...</span>
							<span id="pesan-sukses" style="color: green;">data sudah disimpan...</span>
							<span id="pesan-eror" style="color: red;">data gagal disimpan...</span>
							
							<button type="button" class="btn btn-primary pull-right" id="btn_simpan_di208">Simpan</button> 
							<button type="button" class="btn btn-primary pull-right" id="btn_ubah_di208">Ubah Data</button>
						
							<button type="button" class="btn btn-danger" data-dismiss="modal">Tutup</button>
						</div>
					</div>
				</div>
			</div>
			
			
			
				
			<!-- /page content -->
			<!-- footer content -->
			<!-- /footer content -->
		</div>
	</div>
	
		
	<!-- jQuery -->
	<script src="vendors/jquery/dist/jquery.min.js"></script>
	<!-- Bootstrap -->
	<script src="vendors/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
	    
	<!-- sweetalert -->
	<script src="vendors/sweetalert/js/sweetalert2.min.js"></script>
	<!-- JQuery blockUI -->
	<script src="vendors/blockui_master/jquery.blockUI.js"></script>
	
	<!-- iCheck -->
	<script src="vendors/iCheck/icheck.min.js"></script>
	
	<!-- select with data live search -->
	<script src="build/js/bootstrap-select.min.js" rel="stylesheet"></script>
	
	<!-- Custom Theme Scripts -->
	<script src="build/js/custom.min.js"></script>
	<script src="build/js/ajax.js"></script>
	
	<script>
		function hanyaAngka(evt) {		//  fungsi javascript agar textbox hanya bisa diisi angka saja
			var charCode = (evt.which) ? evt.which : event.keyCode
			
			if(charCode > 31 && (charCode < 48 || charCode > 57))
				return false;
			
			return true;
		}
	</script>
	
  </body>
</html>
