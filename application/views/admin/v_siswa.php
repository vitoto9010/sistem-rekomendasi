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

        <?php if ($this->session->flashdata('success')): ?>
        <div class="alert alert-success" role="alert">
          <?php echo $this->session->flashdata('success'); ?>
        </div>
        <?php endif; ?>

        <!-- Icon Cards-->
        <div class="row">
          <div class="col-xl-7 col-md-12 col-sm-12 mb-3">
            <div class="card h-100">
              <div class="card-header">
                <i class="fas fa-info-circle"></i>
                  Informasi Siswa
              </div>
              <div class="card-body">                
                <div class="table-responsive">
                  <table class="table" cellspacing="0">
                    <tbody>
                      <tr>

                        <td>
                          <img src="<?php echo base_url('upload/image/default.png') ?>">
                        </td>

                        <td>
                          <table class="table">
                            <tbody>

                              <tr>
                                <td>
                                  Nama Siswa
                                </td>
                                <td>
                                  <?php echo $siswa['NAMA'] ?>
                                </td>
                              </tr>

                              <tr>
                                <td>
                                  NIS
                                </td>
                                <td>
                                  <?php echo $siswa['NIS'] ?>
                                </td>
                              </tr>

                              <tr>
                                <td>
                                  NISN
                                </td>
                                <td>
                                  <?php echo $siswa['NISN'] ?>
                                </td>
                              </tr>

                              <tr>
                                <td>
                                  KELAS
                                </td>
                                <td>
                                  <?php echo $siswa['KELAS'] ?>
                                </td>
                              </tr>

                              <tr>
                                <td>
                                  POIN PLUS
                                </td>
                                <td>
                                  <?php echo $siswa['POIN'] ?>
                                </td>
                              </tr>
                            </tbody>
                          </table>
                        </td>

                      </tr>
                    </tbody>
                  </table>
                </div>

              </div>
            </div>
          </div>

          <!-- Bar Chart Example-->
          <div class="col-xl-5">
            <div class="card mb-3">
              <div class="card-header">
                <i class="fas fa-chart-bar"></i>
                Grafik Nilai Siswa</div>
                <div class="card-body">
                  <canvas id="myBarChart" width="100%" height="50"></canvas>
                </div>
            </div>
          </div>

        </div>

        <div class="row">
          <!-- Data Tables smt1 -->
          <div class="col-xl-2 col-md-6 col-sm-12 mb-3">
            <div class="card h-100">
              <div class="card-header">
                <span>Semester 1</span>
              </div>
              <div class="card-body">
                <div class="table-responsive table-sm">
                  <table class="table table-hover" cellspacing="0">
                    <thead>

                      <tr>
                        <th>MAPEL</th>
                        <th>NILAI</th>
                      </tr>

                    </thead>
                    <tbody>
                      <?php $jumlah1 = 0?>
                      <?php foreach ($smt1 as $field => $value): ?>
                      <tr <?php echo  $value <= 70 ? "style='color: #fff' class= 'bg-danger'" : "" ?> > 
                        <td>
                          <?php
                            if ($field == "NIS") {
                              continue;
                            } 
                            echo $field;
                          ?>
                        </td>
                        <td>
                          <?php
                            echo $value;
                            $jumlah1 += $value;
                          ?>
                        </td>
                      </tr>
                      
                      <?php endforeach; ?>
                    </tbody>
                  </table>
                </div>
              </div>
            </div>
          </div>

          <!-- Data Tables smt2 -->
          <div class="col-xl-2 col-md-6 col-sm-12 mb-3">
           <div class="card h-100">
              <div class="card-header">
                <span>Semester 2</span>
              </div>
              <div class="card-body">
                <div class="table-responsive table-sm">
                  <table class="table table-hover" cellspacing="0">
                    <thead>

                      <tr>
                        <th>MAPEL</th>
                        <th>NILAI</th>
                      </tr>
                      
                    </thead>
                    <tbody>
                      <?php $jumlah2 = 0?>
                      <?php foreach ($smt2 as $field => $value): ?>
                      <tr <?php echo  $value <= 70 ? "style='color: #fff' class= 'bg-danger'" : "" ?> > 
                        <td>
                          <?php
                            if ($field == "NIS") {
                              continue;
                            } 
                            echo $field;
                          ?>
                        </td>
                        <td>
                          <?php
                            echo $value;
                            $jumlah2 += $value;
                          ?>
                        </td>
                      </tr>
                      
                      <?php endforeach; ?>
                    </tbody>
                  </table>
                </div>
              </div>
            </div>
          </div>

          <!-- Data Tables smt3 -->
          <div class="col-xl-2 col-md-6 col-sm-12 mb-3">
            <div class="card h-100">
              <div class="card-header">
                <span>Semester 3</span>
              </div>
              <div class="card-body">
                <div class="table-responsive table-sm">
                  <table class="table table-hover" cellspacing="0">
                    <thead>

                      <tr>
                        <th>MAPEL</th>
                        <th>NILAI</th>
                      </tr>
                      
                    </thead>
                    <tbody>
                      <?php $jumlah3 = 0?>
                      <?php foreach ($smt3 as $field => $value): ?>
                      <tr <?php echo  $value <= 70 ? "style='color: #fff' class= 'bg-danger'" : "" ?> > 
                        <td>
                          <?php
                            if ($field == "NIS") {
                              continue;
                            } 
                            echo $field;
                          ?>
                        </td>
                        <td>
                          <?php
                            echo $value;
                            $jumlah3 += $value;
                          ?>
                        </td>
                      </tr>
                      
                      <?php endforeach; ?>
                    </tbody>
                  </table>
                </div>
              </div>
            </div>
          </div>

          <!-- Data Tables smt4 -->
          <div class="col-xl-2 col-md-6 col-sm-12 mb-3">
            <div class="card h-100">
              <div class="card-header">
                <span>Semester 4</span>
              </div>
              <div class="card-body">
                <div class="table-responsive table-sm">
                  <table class="table table-hover" cellspacing="0">
                    <thead>

                      <tr>
                        <th>MAPEL</th>
                        <th>NILAI</th>
                      </tr>
                      
                    </thead>
                    <tbody>
                      <?php $jumlah4 = 0?>
                      <?php foreach ($smt4 as $field => $value): ?>
                      <tr <?php echo  $value <= 70 ? "style='color: #fff' class= 'bg-danger'" : "" ?> > 
                        <td>
                          <?php
                            if ($field == "NIS") {
                              continue;
                            } 
                            echo $field;
                          ?>
                        </td>
                        <td>
                          <?php
                            echo $value;
                            $jumlah4 += $value;
                          ?>
                        </td>
                      </tr>
                      
                      <?php endforeach; ?>
                    </tbody>
                  </table>
                </div>
              </div>
            </div>
          </div>

          <!-- Data Tables smt5 -->
          <div class="col-xl-2 col-md-6 col-sm-12 mb-3">
            <div class="card h-100">
              <div class="card-header">
                <span>Semester 5</span>
              </div>
              <div class="card-body">
                <div class="table-responsive table-sm">
                  <table class="table table-hover" cellspacing="0">
                    <thead>

                      <tr>
                        <th>MAPEL</th>
                        <th>NILAI</th>
                      </tr>
                      
                    </thead>
                    <tbody>
                      <?php $jumlah5 = 0?>
                      <?php foreach ($smt5 as $field => $value): ?>
                      <tr <?php echo  $value <= 70 ? "style='color: #fff' class= 'bg-danger'" : "" ?> > 
                        <td>
                          <?php
                            if ($field == "NIS") {
                              continue;
                            } 
                            echo $field;
                          ?>
                        </td>
                        <td>
                          <?php
                            echo $value;
                            $jumlah5 += $value;
                          ?>
                        </td>
                      </tr>
                      
                      <?php endforeach; ?>
                    </tbody>
                  </table>
                </div>
              </div>
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

</body>
<script type="text/javascript">
  // Bar Chart Example
  var n1 = <?php echo $jumlah1 / 16 ?>;
  var n2 = <?php echo $jumlah2 / 16?>;
  var n3 = <?php echo $jumlah3 / 15?>;
  var n4 = <?php echo $jumlah4 / 15?>;
  var n5 = <?php echo $jumlah5 / 15?>;
  var ctx = document.getElementById("myBarChart");
  var myLineChart = new Chart(ctx, {
    type: 'bar',
    data: {
      labels: ["Semester 1", "Semester 2", "Semester 3", "Semester 4", "Semester 5"],
      datasets: [{
        label: "Nilai",
        backgroundColor: "rgba(2,117,216,1)",
        borderColor: "rgba(2,117,216,1)",
        data: [n1, n2, n3, n4, n5],
      }],
    },
    options: {
      scales: {
        xAxes: [{
          time: {
            unit: 'Semester'
          },
          gridLines: {
            display: false
          },
          ticks: {
            maxTicksLimit: 6
          }
        }],
        yAxes: [{
          ticks: {
            min: 0,
            max: 100,
            maxTicksLimit: 5
          },
          gridLines: {
            display: true
          }
        }],
      },
      legend: {
        display: false
      }
    }
  });
</script>
</html>
