<div class="content-wrapper">
	<section class="content-header">
		<h1>
			Fase
			<small>Manajemen Fase</small>
		</h1>
	</section>

	<section class="content">

		<div class="row">
			<div class="col-lg-12">

				<?php 
					if($this->session->userdata('level') == "Guru"){
					?>
					<a href="<?php echo base_url().'dashboard/fase_tambah'; ?>" class="btn btn-sm btn-primary">Buat fase baru</a>								
					<?php
					}
				?>

				<br/>
				<br/>

				<div class="box box-primary">
					<div class="box-header">
						<h3 class="box-title">Fase</h3>
					</div>
					<div class="box-body">

					<?php 
							if($this->session->flashdata('deleted')){
								echo "<script>swal('OK!', 'Your file was deleted successfully.', 'success');</script>";
							}else if($this->session->flashdata('error')){
								echo "<script>swal('ERROR!', 'Your file already contains answers.', 'error');</script>";
							}
						?>

						<div class="table-responsive">
							<table class="table table-bordered">
								<thead>
									<tr>
										<th width="1%">No</th>
										<th>Fase</th>
										<th>Time Start</th>
										<th>Deadline</th>
										<th>Modul</th>
										<th>Action</th>
									</tr>
								</thead>
								<tbody>
									<?php 
									$no = 1;
									foreach($fase as $f){ //pengulagan
										//strtitime function buat nangkap nilai waktu
										?>
										<tr>
											<td><?php echo $no++; ?></td>
											<td><?php echo $f->nama_fase; ?></td>
											<td><?php echo date('d/m/Y H:i', strtotime($f->start_fase)); ?></td>
											<td><?php echo date('d/m/Y H:i', strtotime($f->deadline)); ?></td>
											<td><?php echo $f->modul; ?></td>
										
											<td>
												<?php 
												if($this->session->userdata('level') == "Guru"){ // level nya guru, berarti ada buat di tampilan guru aja
													?>
													
													<a href="<?php echo base_url().'dashboard/fase_edit/'.$f->id_fase; ?>" class="btn btn-warning btn-sm"> <i class="fa fa-pencil"></i> </a>
														<button id="btndelete" onclick="sweet('<?php echo $f->modul; ?>',<?php echo $f->id_fase; ?>)" class="btn btn-danger btn-sm" ><i class="fa fa-trash"></i></button>
														<!-- Onclick, saat elemen di klik, maka fungsi sweet alert akan dieksekusi serta dgn menampilkan
														modulnya sesuai id fase -->
												<?php
												}
												?>

												<?php
												if ($this->session->userdata('level') == "Siswa"){
													?>
													<a href="<?php echo base_url().'dashboard/download/'.$f->id_fase; ?>" class = "btn btn-primary btn-sm">DOWNLOAD</a>
													<?php 
												}
												?>	
											</td>
										</tr>
									<?php } ?>
								</tbody>
							</table>
						</div>

					</div>
				</div>

			</div>
		</div>

	</section>
	<form id="formdelete" method="post" action="<?php echo base_url('dashboard/fase_hapus_aksi') ?>">	
		<input id="id_fase" type="hidden" name="fase_hapus" value="<?php echo $f->id_fase; ?>">
	</form>																	

</div>
<script>
	function sweet(modul,id){
		event.preventDefault(); // buat mencegah form ke submit
		$("#formdelete #id_fase").val(id); // akan mengkonfirmasi (menghapus sesuai form dan id)
		
		swal({
			title: "Are you sure?",
			text: "We need your confirmation.\n Your file : "+modul,
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
