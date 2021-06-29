<div class="content-wrapper">
	<section class="content-header">
		<h1>
			Tugas
			<small>Nilai Tugas</small>
		</h1>
	</section>

	<section class="content">

		<a href="<?php echo base_url().'dashboard/tugas'; ?>" class="btn btn-sm btn-primary">Kembali</a>

		<br/>
		<br/>

		<div class="box box-primary">
					<div class="box-header">
						<h3 class="box-title">TUGAS</h3>
					</div>
					<div class="box-body">
						
						<?php foreach($tugas as $t){ ?>

							<form method="post" action="<?php echo base_url('dashboard/proses_tugas_nilai') ?>">
								<div class="box-body">
									<div class="form-group">
										<label>Nilai</label>
										<input type="hidden" name="id" value="<?php echo $t->id_tugas; ?>">
										<input type="number" name="nilai" class="form-control" value="<?php echo $t->nilai; ?>">
										<?php echo form_error('nilai'); ?>
									</div>
								</div>

								<div class="box-footer">
									<input type="submit" class="btn btn-success" value="Update">
								</div>
							</form>

						<?php } ?>

					</div>
		</div>
	</section>

</div>
