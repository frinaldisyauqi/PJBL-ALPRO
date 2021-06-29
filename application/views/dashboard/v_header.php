<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title>Simple | Dashboard</title>
	<meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
	<link rel="stylesheet" href="<?php echo base_url(); ?>assets/bower_components/bootstrap/dist/css/bootstrap.min.css">
	<link rel="stylesheet" href="<?php echo base_url(); ?>assets/bower_components/font-awesome/css/font-awesome.min.css">
	<link rel="stylesheet" href="<?php echo base_url(); ?>assets/bower_components/Ionicons/css/ionicons.min.css">
	<link rel="stylesheet" href="<?php echo base_url(); ?>assets/dist/css/AdminLTE.min.css">
	<link rel="stylesheet" href="<?php echo base_url(); ?>assets/dist/css/skins/_all-skins.min.css">
	<link rel="stylesheet" href="<?php echo base_url(); ?>assets/bower_components/morris.js/morris.css">
	<link rel="stylesheet" href="<?php echo base_url(); ?>assets/bower_components/jvectormap/jquery-jvectormap.css">
	<link rel="stylesheet" href="<?php echo base_url(); ?>assets/bower_components/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css">
	<link rel="stylesheet" href="<?php echo base_url(); ?>assets/bower_components/bootstrap-daterangepicker/daterangepicker.css">
	<link rel="stylesheet" href="<?php echo base_url(); ?>assets/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css">
	<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.css">
	<script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.js"></script>
</head>
<body class="hold-transition skin-blue sidebar-mini">
	<div class="wrapper">

		<header class="main-header">			
			<a href="<?php echo base_url(); ?>" class="logo">
				<span class="logo-mini"><b>SIMPLE</b></span>
				<span class="logo-lg"><b>SIMPLE</b></span>
			</a>
			
			<nav class="navbar navbar-static-top">
				
				<a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
					<span class="sr-only">Toggle navigation</span>
				</a>

				<div class="navbar-custom-menu">
					<ul class="nav navbar-nav">
						<li class="dropdown user user-menu">
							<a href="#" class="dropdown-toggle" data-toggle="dropdown">
								<img src="<?php echo base_url(); ?>assets/dist/img/avatar5.png" class="user-image" alt="User Image">
								<span class="hidden-xs">Hak Akses : <b><?php echo $this->session->userdata('level') ?></b></span>
							</a>
							<ul class="dropdown-menu">
								<li class="user-header">
									<img src="<?php echo base_url(); ?>assets/dist/img/user2-160x160.jpg" class="img-circle" alt="User Image">
									<p>
										<?php echo $this->session->userdata('username') ?>
										<small>Hak akses : <?php echo $this->session->userdata('level') ?></small>
									</p>
								</li>
								
								<li class="user-footer">
									<div class="pull-left">
										<a href="<?php echo base_url().'dashboard/profil' ?>" class="btn btn-default btn-flat">Profil</a>
									</div>
									<div class="pull-right">
										<a href="<?php echo base_url().'dashboard/keluar' ?>" class="btn btn-default btn-flat">Log Out</a>
									</div>
								</li>
							</ul>
						</li>
					</ul>
				</div>
			</nav>
		</header>
		<aside class="main-sidebar">
			<section class="sidebar">
				<div class="user-panel">
					<div class="pull-left image">
						<img src="<?php echo base_url(); ?>assets/dist/img/avatar5.png" class="img-circle" alt="User Image">
					</div>
					<div class="pull-left info">
						<?php 
						$id_pengguna = $this->session->userdata('id');
						$pengguna = $this->db->query("select * from user where user_id='$id_pengguna'")->row();
						?>
						<p><?php echo $pengguna->user_nama; ?></p>
						<a href="#"><i class="fa fa-circle text-success"></i>Online</a>
					</div>
				</div>
				
				<ul class="sidebar-menu" data-widget="tree">
					<li class="header">MAIN NAVIGATION</li>
					<li>
						<a href="<?php echo base_url().'dashboard' ?>">
							<i class="fa fa-dashboard"></i>
							<span>DASHBOARD</span>
						</a>
					</li>
	
					<li class="treeview">
						<a href="#">
							<i class="fa fa-laptop"></i>
							<span>PROJEK</span>
							<span class="pull-right-container">
							<i class="fa fa-angle-left pull-right"></i>
							</span>
						</a>
						<ul class="treeview-menu">
							<li><a href="<?php echo base_url().'dashboard/pretest' ?>"><i class="fa fa-circle-o"></i> Pretest</a></li>
							<li><a href="<?php echo base_url().'dashboard/fase' ?>"><i class="fa fa-circle-o"></i> Fase</a></li>
							<li><a href="<?php echo base_url().'dashboard/tugas' ?>"><i class="fa fa-circle-o"></i> Tugas</a></li>
						
							<li>
							<?php 
								if($this->session->userdata('level') == "Guru"){
								?>
								<a href="<?php echo base_url().'dashboard/evaluasi'; ?>"><i class="fa fa-circle-o"></i>Evaluasi</a>
								
								<?php
								}
							?>
							</li>
						</ul>
					</li>

					<?php 
					if($this->session->userdata('level') == "Guru"){
					?>

					<li class="treeview">
						<a href="#">
							<i class="fa fa-edit"></i>
							<span>USER & PENGATURAN</span>
							<span class="pull-right-container">
								<i class="fa fa-angle-left pull-right"></i>
							</span>
						</a>
						<ul class="treeview-menu">
							<li><a href="<?php echo base_url().'dashboard/user' ?>"><i class="fa fa-users"></i> User & Hak Akses</a></li>
							<li><a href="<?php echo base_url().'dashboard/ganti_password' ?>"><i class="fa fa-lock"></i> Ganti Password</a></li>
							<li><a href="<?php echo base_url().'dashboard/pengaturan' ?>"><i class="fa fa-edit"></i> Pengaturan Website</a></li>
						</ul>
					</li>	

					<?php
					} 
					?>
					
					<li><a href="<?php echo base_url().'dashboard/profil' ?>"><i class="fa fa-circle-o"></i> Profil</a></li>
					<li>
						<a href="<?php echo base_url().'dashboard/keluar' ?>">
							<i class="fa fa-share"></i>
							<span>KELUAR</span>
						</a>
					</li>
				</ul>
			</section>
		</aside>