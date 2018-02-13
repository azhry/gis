<div class="site-menubar">
    <div class="site-menubar-body">
        <div>
            <div>
                <?php if($this->data['role'] == "admin"): ?>
                <ul class="site-menu">
                    <li class="site-menu-item">
                        <a href="<?= base_url('admin') ?>" onclick="dashboard()" data-slug="dashboard">
                            <i class="site-menu-icon wb-dashboard" aria-hidden="true"></i>
                            <span class="site-menu-title">Dashboard</span>
                        </a>
                    </li>
                    <li class="site-menu-item">
                        <a href="<?= base_url('admin/kota') ?>" onclick="kota()" data-slug="dashboard">
                            <i class="site-menu-icon fa fa-book" aria-hidden="true"></i>
                            <span class="site-menu-title">Kota</span>
                        </a>
                    </li>
                    <li class="site-menu-item">
                        <a href="<?= base_url('admin/peta-proyek') ?>" onclick="kota()" data-slug="dashboard">
                            <i class="site-menu-icon fa fa-book" aria-hidden="true"></i>
                            <span class="site-menu-title">Peta Proyek</span>
                        </a>
                    </li>
                    <li class="site-menu-item">
                        <a href="<?= base_url('admin/provinsi') ?>" data-slug="dashboard">
                            <i class="site-menu-icon fa fa-book" aria-hidden="true"></i>
                            <span class="site-menu-title">Provinsi</span>
                        </a>
                    </li>
                    <li class="site-menu-item">
                        <a href="<?= base_url('admin/kabupaten') ?>" data-slug="dashboard">
                            <i class="site-menu-icon fa fa-book" aria-hidden="true"></i>
                            <span class="site-menu-title">Kabupaten</span>
                        </a>
                    </li>
                </ul>
                <?php elseif($this->data['role'] == "kepala dinas"): ?>
                <ul class="site-menu">
                    <li class="site-menu-item">
                        <a href="<?= base_url('kepala_dinas') ?>" onclick="dashboard()" data-slug="dashboard">
                            <i class="site-menu-icon wb-dashboard" aria-hidden="true"></i>
                            <span class="site-menu-title">Dashboard</span>
                        </a>
                    </li>
                    <li class="site-menu-item">
                        <a href="<?= base_url('kepala_dinas/kota') ?>" onclick="kota()" data-slug="dashboard">
                            <i class="site-menu-icon fa fa-book" aria-hidden="true"></i>
                            <span class="site-menu-title">Kota</span>
                        </a>
                    </li>
                    <li class="site-menu-item">
                        <a href="<?= base_url('kepala_dinas/peta-proyek') ?>" onclick="kota()" data-slug="dashboard">
                            <i class="site-menu-icon fa fa-book" aria-hidden="true"></i>
                            <span class="site-menu-title">Peta Proyek</span>
                        </a>
                    </li>
                </ul>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>