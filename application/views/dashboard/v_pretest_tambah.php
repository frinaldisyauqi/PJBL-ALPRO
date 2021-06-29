<div class="content-wrapper">
	<section class="content-header">
		<h1>
			PRETEST
			<small>Tambah Soal Pretest</small>
		</h1>
	</section>

	<section class="content">

		<div class="row">
			<div class="col-lg-6">
				<a href="<?php echo base_url().'dashboard/pretest'; ?>" class="btn btn-sm btn-primary">Kembali</a>
				
				<br/>
				<br/>

				<div class="box box-primary">
					<div class="box-header">
						<h3 class="box-title">Pretest</h3>
					</div>
					<div class="box-body">
						
						
						<form method="post" action="<?php echo base_url('dashboard/pretest_aksi') ?>">
							<div class="box-body">
								<div class="form-group">
									<label>Questions</label>
									<input type="text" name="pretest" class="form-control" placeholder="Input Question ..">
									<?php echo form_error('pretest'); ?>
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