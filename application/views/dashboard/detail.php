<div class="content-wrapper">
	<section class="content">
		<h3><strong>DETAIL USER</strong></h3>

		<table class="table">
			<tr>
				<th>Nama</th>
				<td><?php echo $detail->user_nama; ?></td>
			</tr>

			<tr>
				<th>Email</th>
				<td><?php echo $detail->user_email; ?></td>
			</tr>

			<tr>
				<th>Username</th>
				<td><?php echo $detail->user_username; ?></td>
			</tr>

			<tr>
				<th>Level</th>
				<td><?php echo $detail->user_level; ?></td>
			</tr>

			<tr>
				<th>Status</th>
				<td><?php echo $detail->user_status; ?></td>
			</tr>
			
			<tr>
				<th>Kelas</th>
				<td><?php echo $detail->kelas; ?></td>
			</tr>

			<tr>
				<th>Nama Anggota</th>
				<td><?php echo $detail->nama_anggota; ?></td>
			</tr>


		</table>

	</section>
</div>