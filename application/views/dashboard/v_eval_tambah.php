<div class="content-wrapper">
	<section class="content-header">
		<h1>
			EVALUASI
			<small>Tambah Soal Evaluasi</small>
		</h1>
	</section>

	<section class="content">

		<div class="row">
			<div class="col-lg-6">
				<a href="<?php echo base_url().'dashboard/evaluasi'; ?>" class="btn btn-sm btn-primary">Kembali</a>
				
				<br/>
				<br/>

				<div class="box box-primary">

					<div class="box-body">
						
						
						<form method="post" action="<?php echo base_url('dashboard/eval_aksi') ?>">
							<div class="box-body">
								<div class="form-group">
									<label>Pertanyaan</label>
									<input type="text" name="eval" class="form-control" placeholder="Input Questions ..">
									<?php echo form_error('eval'); ?>
								</div>
							</div>

							<div class="box-footer">
								<input type="submit" class="btn btn-success" value="Simpan">
							</div>
						</form>

					</div>
				</div>

			</div>
		</div>

	</section>

</div>