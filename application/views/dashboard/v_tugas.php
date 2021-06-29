<div class="content-wrapper">
	<section class="content-header">
		<h1>
			Tugas
			<small>Manajemen tugas</small>
		</h1>
	</section>

	<section class="content">

		<div class="row">
			<div class="col-lg-12">

				<?php 
					if($this->session->userdata('level') == "Siswa"){
					?>
					<a href="<?php echo base_url().'dashboard/tugas_tambah'; ?>" class="btn btn-sm btn-primary">Input Data</a>								
					<?php
					}
				?>

				<br/>
				<br/>

				<div class="box box-primary">
					<div class="box-header">
						<h3 class="box-title">Tugas</h3>
					</div>
					<div class="box-body"><!--   -->
						<?php 
						//menampilkan sebuah notifikasi setelah melakukan proses, jika session berhasil dihapus
							if($this->session->flashdata('deleted')){
								echo "<script>swal('OK!', 'Your answer was deleted successfully.', 'success');</script>";
							}
						?>
						<div class="table-responsive">
							<table class="table table-bordered">
								<thead>
									<tr>
										<th width="1%">No</th>
										<th>Waktu Pengumpulan</th>
										<th>Fase</th>
										<th>Pengirim Tugas</th>
										<th>Jawaban</th>
										<th>Nilai</th>
										<th>Action</th>
									</tr>
								</thead>
								<tbody>
									<?php 
									$no = 1;
									foreach($tugas as $t){ 
										if (($this->session->userdata('id') == $t->user_id) ||
										   ($this->session->userdata('level') == "Guru")){
										?>
										<tr>
											<td><?php echo $no++; ?></td>
											<td><?php echo date('d/m/Y H:i', strtotime($t->waktu_pengumpulan)); ?></td>
											<td><?php echo $t->nama_fase; ?></td>
											<td><?php echo $t->user_nama; ?></td>
											<td><?php echo $t->jawaban; ?></td>
											<td><?php echo $t->nilai; ?></td>

										
											<td>
												<?php 
												if($this->session->userdata('level') == "Siswa"){
												?>
														<a href="<?php echo base_url().'dashboard/tugas_edit/'.$t->id_tugas; ?>" class="btn btn-warning btn-sm"> <i class="fa fa-pencil"></i> </a>
														<button id="btndelete"  onclick="sweet('<?php echo $t->jawaban; ?>','<?php echo $t->id_tugas; ?>')" class="btn btn-danger btn-sm" ><i class="fa fa-trash"></i></button>
												

												<?php
												}
												?>

												<?php
												if ($this->session->userdata('level') == "Guru"){
													?>
													<a href="<?php echo base_url().'dashboard/downloadTugas/'.$t->id_tugas; ?>" class = "btn btn-primary btn-sm">DOWNLOAD</a>
													<a href="<?php echo base_url().'dashboard/tugas_nilai/'.$t->id_tugas; ?>" class = "btn btn-warning btn-sm">NILAI</a>
													<?php 
												}
												?>	
											</td>
										</tr>
										<?php
										}
									} ?>
								</tbody>
							</table>
						</div>

					</div>
				</div>

			</div>
		</div>

	</section>
	<form id="formdelete" method="post" action="<?php echo base_url('dashboard/tugas_hapus_aksi') ?>">
		<input id="id_tugas" type="hidden" name="tugas_hapus">
	</form>
</div>


<script>

	function sweet(jawaban,id){
		event.preventDefault(); // mencegah langsung mengirimkan form (disubmit)
		$("#formdelete #id_tugas").val(id); // akan mengkonfirmasi (menghapus sesuai form dan id)

		var form = event.target.form; // menyimpan form
		swal({
			title: "Are you sure?",
			text: "We need your confirmation.\n Your answer : "+jawaban,
			type: "warning",
			showCancelButton: true,
			confirmButtonColor: "#DD6B55",
			confirmButtonText: "Yes, delete it!",
			cancelButtonText: "No, safe please!",
			closeOnConfirm: false,
			closeOnCancel: false
		},
		function(isConfirm){
			if (isConfirm) {
				$("#formdelete").submit();
				 // submitting the form when user press yes
				$("#formdelete").trigger('reset');
			} else {
				swal("OK!", "Confirmation canceled.", "success");
			}
		});
	}
</script>
