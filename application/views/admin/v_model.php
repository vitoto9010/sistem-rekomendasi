<!DOCTYPE html>
<html lang="en">

<head>
	<?php $this->load->view("admin/_partials/head.php") ?>
</head>

<body id="page-top">

	<?php $this->load->view("admin/_partials/navbar.php") ?>
	<div id="wrapper">

		<?php $this->load->view("admin/_partials/sidebar.php") ?>

		<div id="content-wrapper">

			<div class="container-fluid">

				<?php $this->load->view("admin/_partials/breadcrumb.php") ?>
				<?php $this->load->view("admin/_partials/notifikasi.php") ?>

				<!--CARD FORM-->
				<div class="row">
					
					<div class="col-xl-4 col-md-6 col-sm-12 mb-3">
						<div class="card h-100">
							<div class="card-body">
								<form action="<?php echo site_url("admin/data/upload") ?>" method="post"
									enctype="multipart/form-data">
									<div class="form-group">
										<label for="name">Model File</label>
										<input
											class="form-control-file <?php echo form_error('file') ? 'is-invalid':'' ?>"
											type="file" name="file" />
										<div class="invalid-feedback">
											<?php echo form_error('file') ?>
										</div>
									</div>
									<input class="btn btn-info" type="submit" name="btn" value="Upload" />
								</form>

							</div>
							<a class="card-footer clearfix small z-1">
								<span class="float-left">Upload File untuk dijadikan Model Klasifikasi</span>
								<span class="float-right">
									<i class="fas fa-info-circle"></i>
								</span>
							</a>
						</div>
					</div>


					<div class="col-xl-4 col-md-6 col-sm-12 mb-3">
						<div class="card o-hidden h-100">
							<div class="card-body">
								
								<form action="<?php echo site_url('admin/data/download') ?>" method="post"
									enctype="multipart/form-data">
									<div class="form-group">
										<label for="name">Download Template Model</label>
									</div>
									<input class="btn btn-info" type="submit" name="btn" value="Download" />
								</form>
							</div>
							<a class="card-footer clearfix small z-1">
								<span class="float-left">Download Template Model</span>
								<span class="float-right">
									<i class="fas fa-info-circle"></i>
								</span>
							</a>
						</div>
					</div>

					<div class="col-xl-4 col-md-12 col-sm-12 mb-3">
						<div class="card h-100">
							<div class="card-body">
								<form action="<?php echo site_url('admin/data/model') ?>" method="post"
									enctype="multipart/form-data">
									<div class="form-group">
										<label for="name">Model List</label>
										<select id="pilihan_model" name="pilihan_model" class="custom-select">
											<option selected name="0">Pilih Model yang sudah ada</option>
											<?php 
												foreach ($model_list as $pilihan_model){
													echo "<option name='$pilihan_model' value='$pilihan_model'>$pilihan_model</option>";
												}
											?>
										</select>
									</div>
									<input class="btn btn-info" type="submit" name="action" value="Choose" />
									<input class="btn btn-danger" type="submit" name="action" value="Delete" />
								</form>
							</div>
							<a class="card-footer clearfix small z-1">
								<span class="float-left">Menggunakan Model yang sudah ada</span>
								<span class="float-right">
									<i class="fas fa-info-circle"></i>
								</span>
							</a>
						</div>
					</div>

				</div>
				<!-- /.row -->

				<!-- DataTables -->
				<div class="card mb-3">
					<div class="card-header">
						<span>
							Current Model < <?php echo $model_title ?> >
						</span>
					</div>
					<div class="card-body">
						<div class="table-responsive">
							<table class="table table-hover" id="dataTable" width="100%" cellspacing="0">
								<thead>
									<tr>
										<?php
											$keys = array_keys($model_data[1]);
											foreach ($keys as $header) {
												echo "<th>$header</th>";
											}
										?>
										<!-- <th>NIS</th>
										<th>POIN</th>
										<th>STATUS</th>
										<th>NILAI 1</th>
										<th>NILAI 2</th>
										<th>NILAI 3</th>
										<th>NILAI 4</th>
										<th>NILAI 5</th> -->
									</tr>
								</thead>
								<tbody>
									
										<?php
											foreach ($model_data as $field) {
												echo "<tr>";
												foreach ($keys as $col) {
													if ($col == 'NIS') {
														?>
															<td>
																<a
																	href="<?php echo site_url('admin/siswa/'.$field['NIS']); ?>"><?php echo $field['NIS'] ?>
																</a>												
															</td>
														<?php
													}
													else {
														echo "<td> $field[$col] </td>";
													}
												}
												echo "</tr>";
											}	
										?>
								</tbody>
							</table>
						</div>
					</div>

				</div>
				<!-- /.container-fluid -->

				<!-- Sticky Footer -->
				<?php $this->load->view("admin/_partials/footer.php") ?>

			</div>
			<!-- /.content-wrapper -->

		</div>
		<!-- /#wrapper -->


		<!-- Scrolltop -->
		<?php $this->load->view("admin/_partials/scrolltop.php") ?>

		<!-- Modal -->
		<?php $this->load->view("admin/_partials/modal.php") ?>

		<!-- Js -->
		<?php $this->load->view("admin/_partials/js.php") ?>

</body>

</html>
