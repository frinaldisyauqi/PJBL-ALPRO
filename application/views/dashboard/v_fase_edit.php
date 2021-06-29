<div class="content-wrapper">
	<section class="content-header">
		<h1>
			Fase
			<small>Edit Fase</small>
		</h1>
	</section>

	<section class="content">

		<a href="<?php echo base_url().'dashboard/fase'; ?>" class="btn btn-sm btn-primary">Kembali</a>

		<br/>
		<br/>

		<?php foreach($fase as $f){ ?>

		<?php echo form_open_multipart('dashboard/fase_update'); ?>
			<div class="row">
				<div class="col-lg-9">

					<div class="box box-primary">
						<div class="box-body">

							<div class="box-body">
								<div class="form-group">
									<label>Fase</label>
									<input type="hidden" name="id" value="<?php echo $f->id_fase; ?>">
									<input type="text" name="nama_fase" class="form-control" placeholder="Masukkan nama fase.." value="<?php echo $f->nama_fase; ?>">
									<br/>
									<?php echo form_error('nama_fase'); ?>
								</div>

								<div class="form-group">
									<label>Start Fase</label>
									<input type="date" name="start_fase" class="form-control" placeholder="Masukkan waktu fase.." value="<?php echo $f->start_fase; ?>">
									<br/>
									<?php echo form_error('start_fase'); ?>
								</div>

								<div class="form-group">
									<label>Deadline</label>
									<input type="date" name="deadline" class="form-control" placeholder="Masukkan waktu fase.." value="<?php echo $f->start_fase; ?>">
									<br/>
									<?php echo form_error('deadline'); ?>
								</div>

								<div class="form-group">
									<label>Modul</label>
									<input type="file" name="modul">
									<br/>
									<?php 
									if(isset($upload_data_error)){
										echo $upload_data_error;
									}
									?>
									<?php echo form_error('modul'); ?>
								</div>

								<div class="form-group">
									<label>Lampiran</label>
									<?php echo form_error('lampiran'); ?>
									<br/>
									<textarea class="form-control" name="lampiran"> <?php echo $f->lampiran; ?> </textarea>
								</div>

								<div class="box-footer">
									<input type="submit" class="btn btn-success" value="Simpan">
								</div>
							</div>

						</div>
					</div>

				</div>


			</div>
		</div>
	<?php } ?>
	</section>

</div>