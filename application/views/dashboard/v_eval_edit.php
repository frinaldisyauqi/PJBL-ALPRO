<div class="content-wrapper">
	<section class="content-header">
		<h1>
			EVALUASI
			<small>Edit Soal Evaluasi</small>
		</h1>
	</section>

	<section class="content">

		<div class="row">
			<div class="col-lg-6">
				<a href="<?php echo base_url().'dashboard/evaluasi'; ?>" class="btn btn-sm btn-primary">Kembali</a>
				
				<br/>
				<br/>

				<div class="box box-primary">
					<div class="box-header">
						<h3 class="box-title">EVALUASI</h3>
					</div>
					<div class="box-body">
						
						<?php foreach($eval as $e){ ?>

							<form method="post" action="<?php echo base_url('dashboard/eval_update') ?>">
								<div class="box-body">
									<div class="form-group">
										<label>Questions</label>
										<input type="hidden" name="id" value="<?php echo $e->id_eval; ?>">
										<input type="text" name="eval" class="form-control" placeholder="Input Question .." value="<?php echo $e->pertanyaan; ?>">
										<?php echo form_error('eval'); ?>
									</div>
								</div>

								<div class="box-footer">
									<input type="submit" class="btn btn-success" value="Update">
								</div>
							</form>

						<?php } ?>

					</div>
				</div>

			</div>
		</div>

	</section>

</div>