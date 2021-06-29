<div class="content-wrapper">
	<section class="content-header">
		<h1>
			User
			<small>User Website</small>
		</h1>
	</section>

	<section class="content">

		<div class="row">
			<div class="col-lg-12">
				
				<a href="<?php echo base_url().'dashboard/user_tambah'; ?>" class="btn btn-sm btn-primary">Tambah user baru</a>

				<div class="navbar-form navbar-right">
					<?php echo form_open('dashboard/cari'); ?>
						<select name="cariberdasarkan">
							<option value="">Berdasarkan :</option>
							<option value="user_nama">Nama</option>
							<option value="user_email">Email</option>
							<option value="user_username">Usename</option>
							<option value="user_status">Status</option>
							<option value="kelas">Kelas</option>
							<option value="nama_anggota">Nama Anggota</option>
						</select>

						<input type="text" name="yangdicari" id="">
						<input type="submit" name="cari" class="btn btn-success btn-sm">
					<?php echo form_close(); ?>

					<?php 
						if (isset($jumlah)) {
							if ($cariberdasarkan=="") {
								echo "Jumlah data <b>'".$yangdicari."'</b> : ".$jumlah;
							}else{
								echo "Jumlah data <b>'".$cariberdasarkan.":".$yangdicari."'</b> : ".$jumlah;
							}
							echo "<br/>";
						}

					 ?>
				</div>

				<br/>
				<br/>
				<br/>

				<div class="box box-primary">
					<div class="box-header">
						<h3 class="box-title">User</h3>
					</div>
					<div class="box-body">
					
					<?php 
						if($this->session->flashdata('deleted')){
							echo "<script>swal('OK!', 'Your file was deleted successfully.', 'success');</script>";
						}else if($this->session->flashdata('error')){
							echo "<script>swal('ERROR!', 'Your file already contains answers.', 'error');</script>";
						}
					?>

						<table class="table table-bordered">
							<thead>
								<tr>
									<th width="1%">No</th>
									<th>Nama</th>
									<th>Email</th>
									<th>Username</th>
									<th>Level</th>
									<th>Status</th>
									<th>Kelas</th>
									<th>Action</th>
								</tr>
							</thead>

							<tbody>
								<?php 
								$no = 1;
								foreach($user as $u){ 
									?>
									<tr>
										<td><?php echo $no++; ?></td>
										<td><?php echo $u->user_nama; ?></td>
										<td><?php echo $u->user_email; ?></td>
										<td><?php echo $u->user_username; ?></td>
										<td><?php echo $u->user_level; ?></td>
										<td>
											<?php 
											if($u->user_status == 1){
												echo "Aktif";
											}else{
												echo "Non Aktif";
											}
											?>
										</td>
										<td><?php echo $u->kelas; ?></td>
										<td>
											<a href="<?php echo base_url().'dashboard/detail/'.$u->user_id; ?>" class="btn btn-primary btn-sm">DETAIL</a>
											<a href="<?php echo base_url().'dashboard/user_edit/'.$u->user_id; ?>" class="btn btn-warning btn-sm"> <i class="fa fa-pencil"></i> </a>
											<button id="btndelete" onclick="sweet('<?php echo $u->user_nama; ?>',<?php echo $u->user_id; ?>)" class="btn btn-danger btn-sm" ><i class="fa fa-trash"></i></button>
											</td>
									</tr>
								<?php } ?>
							</tbody>
						</table>

					</div> 
				</div>

			</div>
		</div>

	</section>
	<form  id="formdelete" method="post" action="<?php echo base_url('dashboard/user_hapus_aksi') ?>">
		<input id="user_id" type="hidden" name="user_hapus" value="<?php echo $u->user_id; ?>">
	</form>	

</div>
<script>
	function sweet(user_nama,id){
		event.preventDefault(); // buat mencegah form ke submit
		$("#formdelete #user_id").val(id);
		
		swal({
			title: "Are you sure?",
			text: "We need your confirmation.\n User: "+user_nama,
			type: "warning",
			showCancelButton: true,
			confirmButtonColor: "#8FBC8F",
			confirmButtonText: "Yes, delete it!",
			cancelButtonColor: "#DD6B55",
			cancelButtonText: "No, safe please!",
			closeOnConfirm: false,
			closeOnCancel: false
		},
		function(isConfirm){
			if (isConfirm) {
				$("#formdelete").submit();
				// mengirimkan formulir saat user klik yes
				$("#formdelete").trigger('reset');
			} else {
				swal("OK!", "Confirmation canceled.", "success");
			}
		});
	}
</script>