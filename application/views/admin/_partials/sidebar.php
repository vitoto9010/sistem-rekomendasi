<!-- Sidebar -->
<ul class="sidebar navbar-nav">
    <li class="nav-item <?php echo $this->uri->segment(2) == 'prediksi' ? 'active': '' ?>">
        <a class="nav-link" href="<?php echo site_url('admin/prediksi') ?>"
            data-toggle="<?php echo $this->session->userdata('modal') ?>"
            data-target="<?php echo $this->session->userdata('target') ?>"
            >
            <i class="fas fa-fw fa-tachometer-alt"></i>
            <span>Prediksi</span>
        </a>
    </li>
    <li class="nav-item <?php echo $this->uri->segment(2) == 'data' ? 'active': '' ?>" >
        <a class="nav-link" href="<?php echo site_url('admin/data') ?>"
            data-toggle="<?php echo $this->session->userdata('modal') ?>"
            data-target="<?php echo $this->session->userdata('target') ?>"
            >
            <i class="fas fa-fw fa-users"></i>
            <span>Model</span></a>
    </li>
</ul>