<!DOCTYPE html>
<html lang="en">
<!--
<pre>
  <?php
    print_r($this->session->all_userdata());
    print_r($this->session->flashdata('errorLog'));

    echo $this->session->userdata('nama');
  ?>
</pre>
-->
<head>
  <?php $this->load->view("admin/_partials/head.php") ?>
</head>

<body class="bg-dark">

  <div class="container">
    <div class="card card-login mx-auto mt-5">
      <div class="card-header">Sistem Rekomendasi Siswa Berprestasi SMA BSS</div>
      <div class="card-body">

        <form action="<?php echo base_url('login/aksi_login'); ?>" method="post">
          <div class="form-group">
            <div class="form-label-group">
              <input type="text" id="inputUsername" name="username" class="form-control" placeholder="Username" required="required">
              <label for="inputUsername">Username</label>
            </div>
          </div>
          <div class="form-group">
            <div class="form-label-group">
              <input type="password" id="inputPassword" name="password" class="form-control" placeholder="Password" required="required">
              <label for="inputPassword">Password</label>
            </div>
          </div>
          <div class="form-group">
            <div class="form-label-group">
            	<?php if ($this->session->flashdata('error')): ?>
        			<div class="alert alert-danger" role="alert">
          				<?php echo $this->session->flashdata('error')  ?>
        			</div>
        		<?php endif; ?>
            </div>
          </div>
          <input class="btn btn-primary btn-block" type="submit" value="Login"></td>
        </form>
      </div>
    </div>
  </div>


  				

  <!-- Js -->
  <?php $this->load->view("admin/_partials/js.php") ?>

</body>

</html>
