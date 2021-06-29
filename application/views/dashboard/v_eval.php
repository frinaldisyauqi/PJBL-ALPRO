<div class="content-wrapper">
	<section class="content-header">
		<h1>
			EVALUASI
			<small>Manajemen Evaluasi</small>
		</h1>
	</section>

	<section class="content">

		<div class="row">
			<div class="col-lg-9">
			<?php 
					if($this->session->userdata('level') == "Guru"){
					?>
					<a href="<?php echo base_url().'dashboard/eval_tambah'; ?>" class="btn btn-sm btn-primary">Tambah Soal</a>
			
					<?php
					}
				?>
				
				
				<br/>
				<br/>

				<div class="box box-primary">
					<div class="box-header">
						<h3 class="box-title">Evaluasi</h3>
					</div>
					<div class="box-body">
						<?php 
							if($this->session->flashdata('deleted')){
								echo "<script>swal('OK!', 'Your answer was deleted successfully.', 'success');</script>";
							}
						?>
						<table class="table table-bordered">
							<thead>
								<tr>
									<th width="1%">No</th>
									<th>Pertanyaan</th>
									<?php 
										if($this->session->userdata('level') == "Guru"){
										?>
											<th>Action</th>
										<?php
										}
									?>
								</tr>
							</thead>
							<tbody>
								<?php 
								$no = 1;
								foreach($eval as $e){ 
									?>
									<tr>
										<td><?php echo $no++; ?></td>
										<td><?php echo $e->pertanyaan; ?></td>
								<?php 
									if($this->session->userdata('level') == "Guru"){
								?>
										<td>
										<a href="<?php echo base_url().'dashboard/eval_edit/'.$e->id_eval; ?>" class="btn btn-warning btn-sm"> <i class="fa fa-pencil"></i> </a>
										<button id="btndelete"  onclick="sweet('<?php echo $e->pertanyaan; ?>','<?php echo $e->id_eval; ?>')" class="btn btn-danger btn-sm" ><i class="fa fa-trash"></i></button>
										</td>
										<?php } ?>
									</tr>
								<?php } ?>
							</tbody>
						</table>
					</div>
				</div>

			</div>
		</div>

	</section>
	<form id="formdelete" method="post" action="<?php echo base_url('dashboard/eval_hapus') ?>">
		<input id="id_eval" type="hidden" name="eval_hapus">
	</form>
</div>

<script>
	
	function sweet(pertanyaan,id){
		event.preventDefault(); // prevent form submit
		$("#formdelete #id_eval").val(id); // akan mengkonfirmasi (menghapus sesuai form dan id)
				
		var form = event.target.form; // storing the form
		swal({
			title: "Are you sure?",
			text: "We need your confirmation. \n Your question: \n"+pertanyaan,
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
				          // mengirimkan formulir saat user klik yes
				$("#formdelete").trigger('reset');
			} else {
				swal("OK!", "Confirmation canceled.", "success");
			}
		});
	}//akhir

</script>

