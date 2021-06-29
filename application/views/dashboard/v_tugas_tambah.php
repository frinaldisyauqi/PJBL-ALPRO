<div class="content-wrapper">
	<section class="content-header">
		<h1>
			Tugas
			<small>Tambah tugas</small>
		</h1>
	</section>

	<section class="content">

		<a href="<?php echo base_url().'dashboard/tugas'; ?>" class="btn btn-sm btn-primary">Kembali</a>

		<br/>
		<br/>

		<?php echo form_open_multipart('dashboard/tugas_aksi'); ?>
			<div class="row">
				<div class="col-lg-9">

					<div class="box box-primary">
						<div class="box-body">

								<div class="form-group">
									<label>Fase</label>
									<select class="form-control" name="nama_fase">
										<option value="">- Pilih Fase</option>
										<?php foreach ($fase as $f) { ?>
											<option <?php if(set_value('fase') == $f->id_fase){ echo "selected='selected'";} ?> value="<?php echo $f->id_fase ?>"><?php echo $f->nama_fase; ?></option>
										<?php } ?>
									</select>
									<br/>
									<?php echo form_error('fase'); ?>
								</div>

								<div class="form-group">
									<label>Jawaban</label>
									<input type="file" name="jawaban">
									<br/>
									<?php 
									if(isset($tugas_data_error)){
										echo $tugas_data_error;
									}
									?>
									<?php echo form_error('jawaban'); ?>
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
		</form>

	</section>

</div>