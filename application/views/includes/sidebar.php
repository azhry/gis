<div class="site-menubar">
    <div class="site-menubar-body">
        <div>
            <div>
                <?php if($this->data['id_role'] == 1): ?>
                <ul class="site-menu">
                    <li class="site-menu-item">
                        <a href="<?= base_url('admin') ?>" data-slug="dashboard">
                            <i class="site-menu-icon wb-dashboard" aria-hidden="true"></i>
                            <span class="site-menu-title">Dashboard</span>
                        </a>
                    </li>
                    <li class="site-menu-item">
                        <a href="<?= base_url('admin/proyek') ?>" data-slug="dashboard">
                            <i class="site-menu-icon fa fa-book" aria-hidden="true"></i>
                            <span class="site-menu-title">Daftar Proyek</span>
                        </a>
                    </li>
                    <li class="site-menu-item">
                        <a href="<?= base_url('admin/pegawai') ?>" data-slug="dashboard">
                            <i class="site-menu-icon fa fa-book" aria-hidden="true"></i>
                            <span class="site-menu-title">Data Pegawai</span>
                        </a>
                    </li>
                    <li class="site-menu-item">
                        <a href="<?= base_url('admin/peta-proyek') ?>" data-slug="dashboard">
                            <i class="site-menu-icon fa fa-book" aria-hidden="true"></i>
                            <span class="site-menu-title">Peta Proyek</span>
                        </a>
                    </li>
                    <!-- <li class="site-menu-item">
                        <a href="<?= base_url('admin/provinsi') ?>" data-slug="dashboard">
                            <i class="site-menu-icon fa fa-book" aria-hidden="true"></i>
                            <span class="site-menu-title">Provinsi</span>
                        </a>
                    </li> -->
                    <li class="site-menu-item">
                        <a href="<?= base_url('admin/kabupaten') ?>" data-slug="dashboard">
                            <i class="site-menu-icon fa fa-book" aria-hidden="true"></i>
                            <span class="site-menu-title">Kabupaten</span>
                        </a>
                    </li>
                </ul>
                <?php elseif($this->data['id_role'] == 2): ?>
                <ul class="site-menu">
                    <li class="site-menu-item">
                        <a href="<?= base_url('kepala-satuan-kerja') ?>" data-slug="dashboard">
                            <i class="site-menu-icon wb-dashboard" aria-hidden="true"></i>
                            <span class="site-menu-title">Dashboard</span>
                        </a>
                    </li>
                    <li class="site-menu-item">
                        <a href="<?= base_url('kepala-satuan-kerja/proyek') ?>" data-slug="dashboard">
                            <i class="site-menu-icon fa fa-book" aria-hidden="true"></i>
                            <span class="site-menu-title">Daftar Proyek</span>
                        </a>
                    </li>
                    <li class="site-menu-item">
                        <a href="<?= base_url('kepala-satuan-kerja/peta-proyek') ?>" data-slug="dashboard">
                            <i class="site-menu-icon fa fa-book" aria-hidden="true"></i>
                            <span class="site-menu-title">Peta Proyek</span>
                        </a>
                    </li>
                    <li class="site-menu-item">
                        <a href="<?= base_url('kepala-satuan-kerja/grafik-proyek') ?>" data-slug="dashboard">
                            <i class="site-menu-icon fa fa-bar-chart" aria-hidden="true"></i>
                            <span class="site-menu-title">Grafik Proyek</span>
                        </a>
                    </li>
                </ul>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>