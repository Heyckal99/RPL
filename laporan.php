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
									<form id="form_laporan" class="form-horizontal form-label-left">

										<div class="item form-group">
											<div class="col-md-2 col-sm-2"></div>
										
											<div class="col-md-4 col-sm-4">							
												<input type="text" id="txt_cari_laporan" name="txt_cari_laporan" class="form-control" placeholder="Nomor Album"
														onkeypress="return hanyaAngka(event)" />										
										
											</div>
											
											<div class="col-md-3 col-sm-3">
												<button type="button" class="btn btn-info" id="btn_laporan" name="btn_laporan">Cari</button>												
											</div>
										</div>
									</form>	
									
									<h5>&nbsp;</h5>
									<div class="col-md-12 col-sm-12">
										<div id="tampilkan_data_laporan"><?php include "function/view_laporan.php"; ?> </div>
									</div>
								</div>
							</div>
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
