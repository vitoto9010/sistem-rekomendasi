        <?php if ($this->session->flashdata('success')): ?>
        <div class="alert alert-success" role="alert">
          <?php echo $this->session->flashdata('success'); ?>
        </div>
        <?php endif; ?>

        <?php if ($this->session->flashdata('prediksi')): ?>
        <div class="alert alert-success" role="alert">
          <?php echo $this->session->flashdata('prediksi'); ?>
        </div>
        <?php endif; ?>

        <?php if ($this->session->flashdata('error')): ?>
        <div class="alert alert-danger" role="alert">
          <?php echo $this->session->flashdata('error')  ?>
        </div>
        <?php endif; ?>
