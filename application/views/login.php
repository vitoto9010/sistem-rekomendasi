<!DOCTYPE html>
<html lang="en">
<pre>
  <?php
    print_r($this->session->all_userdata());

    echo $this->session->userdata('nama');
  ?>
</pre>

<head>
  <?php $this->load->view("admin/_partials/head.php") ?>
</head>

<body class="bg-dark">

  <div class="container">
    <div class="" color="">
      <div class="">
        <label for=""></label>

      </div>

    </div>
    <div class="card card-login mx-auto mt-5">
      <div class="card-header">Login</div>
      <div class="card-body">
        <form action="<?php echo base_url('login/aksi_login'); ?>" method="post">
          <div class="form-group">
            <div class="form-label-group">
              <input type="email" id="inputEmail" class="form-control" placeholder="Email address" required="required" autofocus="autofocus">
              <label for="inputEmail">Email address</label>
            </div>
          </div>
          <div class="form-group">
            <div class="form-label-group">
              <input type="password" id="inputPassword" class="form-control" placeholder="Password" required="required">
              <label for="inputPassword">Password</label>
            </div>
          </div>
          <div class="form-group">
            <div class="checkbox">
            </div>
          </div>
          <input class="btn btn-primary btn-block" type="submit" value="Login"></td>
          <a class="btn btn-primary btn-block" href="">Login</a>
        </form>
      </div>
    </div>
  </div>

  <!-- Js -->
  <?php $this->load->view("admin/_partials/js.php") ?>

</body>

</html>
