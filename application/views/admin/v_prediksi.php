<!DOCTYPE html>
<html lang="en">

<head>
	<?php $this->load->view("admin/_partials/head.php") ?>
</head>

<body id="page-top">

	<!-- Navbar -->
	<?php $this->load->view("admin/_partials/navbar.php") ?>

	<div id="wrapper">

		<!-- Sidebar -->
		<?php $this->load->view("admin/_partials/sidebar.php") ?>

		<div id="content-wrapper">

			<div class="container-fluid">

				<!-- Breadcrumbs-->
				<?php $this->load->view("admin/_partials/breadcrumb.php") ?>
				<?php $this->load->view("admin/_partials/notifikasi.php") ?>

				<!-- Icon Cards-->
				<div class="row">

					<div class="col-xl-5 col-md-6 col-sm-12 mb-3">
						<div class="card h-100">
							<div class="card-body">
								<form action="<?php echo site_url("admin/prediksi/upload") ?>" method="post"
									enctype="multipart/form-data">
									<div class="form-group">
										<label for="name">Upload Data Siswa</label>
										<input class="form-control-file <?php echo form_error('file') ? 'is-invalid':'' ?>" type="file"
											name="file" />
										<div class="invalid-feedback">
											<?php echo form_error('file') ?>
										</div>
									</div>
									<input class="btn btn-info" type="submit" name="btn" value="Upload" />
								</form>

							</div>
							<a class="card-footer clearfix small z-1">
								<span class="float-left">Upload File data Siswa yang ingin dilakukan Kalkulasi Peringkat</span>
								<span class="float-right">
									<i class="fas fa-info-circle"></i>
								</span>
							</a>
						</div>
					</div>

					<div class="col-xl-5 col-md-6 col-sm-12 mb-3">
						<div class="card h-100">
							<div class="card-body">
								<form action="<?php echo site_url('admin/prediksi/rekomendasi') ?>" method="post"
									enctype="multipart/form-data">
									<div class="form-group">
										<label for="name">Kalkulasi Rekomendasi Siswa</label>
									</div>
									<input class="btn btn-info" type="submit" name="btn" value="Kalkulasi" />
								</form>
							</div>
							<a class="card-footer clearfix small z-1">
								<span class="float-left">Kalkulasi untuk menentukan Rekomendasi Siswa</span>
								<span class="float-right">
									<i class="fas fa-info-circle"></i>
								</span>
							</a>
						</div>
					</div>

					<div class="col-xl-2 col-md-6 col-sm-12 mb-3">
						<div class="card h-100">
							<div class="card-body">
								<form action="<?php echo site_url('admin/data/download') ?>" method="post"
									enctype="multipart/form-data">
									<div class="form-group">
										<label for="name">Download Template Data Siswa</label>
									</div>
									<input class="btn btn-info" type="submit" name="btn" value="Download" />
								</form>
							</div>
							<a class="card-footer clearfix small z-1">
								<span class="float-left">Download Template Data Siswa</span>
								<span class="float-right">
									<i class="fas fa-info-circle"></i>
								</span>
							</a>
						</div>
					</div>

				</div>
				<!-- /.row -->

				<div class="row">
					<div class="col-xl-12 col-md-12 col-sm-12 mb-3">
						<div class="card h-100">
							<div class="card-body">
								<form action="<?php echo site_url('admin/prediksi/update') ?>" method="post"
									enctype="multipart/form-data">
									<div class="form-row">
										<?php
											foreach ($bobot as $bbt) {
												$kriteria = $bbt['KRITERIA'];
												echo "<div class='form-group col-md-2'>";
												?>
													<label for='name'> <?php echo $bbt['KRITERIA']?> </label>
													<input class="form-control form-control-md" type="text" name="<?php echo $kriteria ?>" id="<?php echo $kriteria ?>" placeholder="" onkeyup="hitung_total_bobot()"
													value="<?php echo $bbt['BOBOT']*100 ?>">
												<?php
												echo"</div>";
												
											}
											
										
										?>
										<!-- <div class="form-group col-md-2">
											<label for="name">Bobot Nilai 1</label>
											<input class="form-control form-control-md" type="text" id="bobn1" placeholder="" onkeyup="hitung_total_bobot()" value="0">
										</div>
										<div class="form-group col-md-2">
											<label for="name">Bobot Nilai 2</label>
											<input class="form-control form-control-md" type="text" id="bobn2" placeholder="" onkeyup="hitung_total_bobot()" value="0">
										</div>
										<div class="form-group col-md-2">
											<label for="name">Bobot Nilai 3</label>
											<input class="form-control form-control-md" type="text" id="bobn3" placeholder="" onkeyup="hitung_total_bobot()" value="0">
										</div>
										<div class="form-group col-md-2">
											<label for="name">Bobot Nilai 4</label>
											<input class="form-control form-control-md" type="text" id="bobn4" placeholder="" onkeyup="hitung_total_bobot()" value="0">
										</div>
										<div class="form-group col-md-2">
											<label for="name">Bobot Nilai 5</label>
											<input class="form-control form-control-md" type="text" id="bobn5" placeholder="" onkeyup="hitung_total_bobot()" value="0">
										</div>
										<div class="form-group col-md-2">
											<label for="name">Bobot Poin</label>
											<input class="form-control form-control-md" type="text" id="bobpoin" placeholder="" onkeyup="hitung_total_bobot()" value="0">
										</div> -->
									</div>

									<div class="form-row">
										<input class="form-control form-control-md w-auto mr-3" type="text" id="bobtotal" placeholder="Jumlah Bobot" readonly>
										<input class="btn btn-info" type="submit" name="update_button" id="update_button" value="Update" />
									</div>
								</form>
							</div>
							<a class="card-footer clearfix small z-1">
								<span class="float-left">Bobot Algoritma</span>
								<span class="float-right">
									<i class="fas fa-info-circle"></i>
								</span>
							</a>
						</div>
					</div>
					
				</div>
				
				<!-- DataTables -->
				<div class="card mb-3">
					<div class="card-header">
						<span>Rekomendasi Siswa Berprestasi</span>
					</div>
					<div class="card-body">
						<div class="table-responsive">
							<table class="table table-hover" id="dataTable" width="100%" cellspacing="0">
								<thead>
									<tr>
										<th>NIS</th>
										<th>PERINGKAT</th>
									</tr>
								</thead>
								<tbody>
									<?php
                    $rank = 1;
                    foreach ($hasil as $field):
                  ?>
									<tr>
										<td width="">
											<a href="<?php echo site_url('admin/siswa/'.$field['NIS']); ?>"><?php echo $field['NIS'] ?></a>
										</td>
										<td width="small">
											<?php echo $rank++ ?>
										</td>
									</tr>
									<?php endforeach; ?>
								</tbody>
							</table>
						</div>
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

	<script>
		function hitung_total_bobot() {
			var bobArr = [];
			<?php foreach ($bobot as $bbt):?>
				bobArr.push(parseFloat(document.getElementById("<?php echo $bbt['KRITERIA'] ?>").value));				
			<?php endforeach ?>
						
			var bobTotal = document.getElementById("bobtotal");
			var upBtn = document.getElementById("update_button");

			var total = bobArr.reduce(accumulator);
			
			if (total != 100) {
				upBtn.setAttribute("class", "btn btn-danger");
				upBtn.disabled = true;
			}
			else
			{
				upBtn.setAttribute("class", "btn btn-success");
				upBtn.disabled = false;
			}

			bobTotal.value = total;
			
			

		}

		function accumulator(total, num) {
			return total + num;
		}

		window.onload = function() {
			hitung_total_bobot();
		}

	</script>
</body>

</html>
