<div class="content-wrapper">
	<section class="content-header">
		<h1>
			Dashboard
			<small>Control panel</small>
		</h1>
	</section>

	<section class="content">

		<div class="row">

			<div class="col-lg-3 col-xs-6">
				<div class="small-box bg-aqua">
					<div class="inner">
						<h3><?php echo $jumlah_fase ?></h3>
						<p>Jumlah Fase</p>
					</div>
					<div class="icon">
						<i class="ion ion-android-list"></i>
					</div>
				</div>
			</div>

			<div class="col-lg-3 col-xs-6">
				<div class="small-box bg-green">
					<div class="inner">
						<h3><?php echo $jumlah_tugas ?></h3>
						<p>Jumlah Tugas</p>
					</div>
					<div class="icon">
						<i class="ion ion-pie-graph"></i>
					</div>
				</div>
			</div>

			<div class="col-lg-3 col-xs-6">
				<div class="small-box bg-yellow">
					<div class="inner">
						<h3><?php echo $jumlah_user ?></h3>

						<p>Jumlah User</p>
					</div>
					<div class="icon">
						<i class="ion ion-person-add"></i>
					</div>
				</div>
			</div>
			
		</div>

		<div class="row">
			<div class="col-lg-6">
				
				<div class="box box-primary">
					<div class="box-header">
						<h3 class="box-title">Dashboard</h3>
					</div>
					<div class="box-body">
						<h3>Selamat Datang !</h3>

						<div class="table-responsive">
							<table class="table table-bordered table-hover">
								<tr>
									<th width="%">Nama</th>
									<th width="1px">:</th>
									<td>
										<?php 
										$id_pengguna = $this->session->userdata('id');
										$pengguna = $this->db->query("select * from user where user_id='$id_pengguna'")->row();
										?>
										<p><?php echo $pengguna->user_nama; ?></p>
									</td>
								</tr>
								<tr>
									<th width="20%">Username</th>
									<th width="1px">:</th>
									<td><?php echo $this->session->userdata('username') ?></td>
								</tr>
								<tr>
									<th width="20%">Level</th>
									<th width="1px">:</th>
									<td><?php echo $this->session->userdata('level') ?></td>
								</tr>
								<tr>
									<th width="20%">Status</th>
									<th width="1px">:</th>
									<td>Aktif</td>
								</tr>
							</table>
						</div>
					</div>
				</div>

			</div>
		</div>

	</section>

</div>