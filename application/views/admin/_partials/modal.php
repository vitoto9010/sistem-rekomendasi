<!-- Logout Modal-->
<div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Siap untuk Logout?</h5>
        <button class="close" type="button" data-dismiss="modal" aria-label="Tutup">
          <span aria-hidden="true">×</span>
        </button>
      </div>
      <div class="modal-body">Pilih Logout dibawah untuk kembali mengakhiri sesi.</div>
      <div class="modal-footer">
        <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
        <a class="btn btn-primary" href="<?php echo base_url('login/logout'); ?>">Logout</a>
      </div>
    </div>
  </div>
</div>

<!-- Denied Modal-->
<div class="modal fade" id="deniedModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Anda Tidak Memiliki Akses.</h5>
        <button class="close" type="button" data-dismiss="modal" aria-label="Tutup">
          <span aria-hidden="true">×</span>
        </button>
      </div>
      <div class="modal-body">Pilih tombol Kembali untuk menutup pesan.</div>
      <div class="modal-footer">
        <button class="btn btn-secondary" type="button" data-dismiss="modal">Kembali</button>
      </div>
    </div>
  </div>
</div>