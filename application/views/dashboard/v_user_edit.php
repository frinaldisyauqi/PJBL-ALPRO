<div class="content-wrapper">
	<section class="content-header">
		<h1>
			User
			<small>Edit User</small>
		</h1>
	</section>

	<section class="content">

		<div class="row">
			<div class="col-lg-6">
				<a href="<?php echo base_url().'dashboard/user'; ?>" class="btn btn-sm btn-primary">Kembali</a>
				
				<br/>
				<br/>

				<div class="box box-primary">
					<div class="box-header">
						<h3 class="box-title">User</h3>
					</div>
					<div class="box-body">
						
						<?php foreach($user as $u){ ?>

							<form method="post" action="<?php echo base_url('dashboard/user_update') ?>">
								<div class="box-body">
									<div class="form-group">
										<label>Nama</label>
										<input type="hidden" name="id" value="<?php echo $u->user_id; ?>">
										<input type="text" name="nama" class="form-control" placeholder="Masukkan nama user .." value="<?php echo $u->user_nama; ?>">
										<?php echo form_error('nama'); ?>
									</div>
									<div class="form-group">
										<label>Email</label>
										<input type="email" name="email" class="form-control" placeholder="Masukkan email user .." value="<?php echo $u->user_email; ?>">
										<?php echo form_error('email'); ?>
									</div>
									<div class="form-group">
										<label>Username</label>
										<input type="text" name="username" class="form-control" placeholder="Masukkan username user.." value="<?php echo $u->user_username; ?>">
										<?php echo form_error('username'); ?>
									</div>
									<div class="form-group">
										<label>Password</label>
										<input type="password" name="password" class="form-control" placeholder="Masukkan password user..">
										<?php echo form_error('password'); ?>
										<small>Kosongkan jika tidak ingin mengubah password</small>
									</div>
									<div class="form-group">
										<label>Level</label>
										<select class="form-control" name="level">
											<option value="">- Pilih Level -</option>
											<option <?php if($u->user_level == "Guru"){ echo "selected='selected'";} ?> value="Guru">Guru</option>
											<option <?php if($u->user_level == "Siswa"){ echo "selected='selected'";} ?> value="Siswa">Siswa</option>
										</select>
										<?php echo form_error('level'); ?>
									</div>
									<div class="form-group">
										<label>Status</label>
										<select class="form-control" name="status">
											<option value="">- Pilih Status -</option>
											<option <?php if($u->user_status == "1"){ echo "selected='selected'"; } ?> value="1">Aktif</option>
											<option <?php if($u->user_status == "0"){ echo "selected='selected'"; } ?> value="0">Non-Aktif</option>
										</select>
										<?php echo form_error('status'); ?>
									</div>
									<div class="form-group">
										<label>Kelas</label>
										<input type="text" name="kelas" class="form-control" placeholder="Masukkan kelas user ..">
										<?php echo form_error('kelas'); ?>
									</div>
									<div class="form-group">
										<label>Nama Anggota</label>
										<input type="text" name="nama_anggota" class="form-control" placeholder="Masukkan nama user ..">
										<?php echo form_error('nama_anggota'); ?>
									</div>
									</div>

								<div class="box-footer">
									<input type="submit" class="btn btn-success" value="Simpan">
								</div>
							</form>

						<?php } ?>

					</div>
				</div>

			</div>
		</div>

	</section>

</div>