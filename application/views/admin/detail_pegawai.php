<!-- Page -->
<div class="page animsition">
    <div class="page-header">
        <h3 class="page-title">Detail Pegawai</h3>
        <ol class="breadcrumb">
            <li><a href="<?= base_url('admin') ?>">Dashboard</a></li>
            <li><a href="<?= base_url('admin/pegawai') ?>">Data Pegawai</a></li>
            <li class="active">Detail Pegawai</li>
        </ol>
    </div>
    <div class="page-content">
        <!-- Panel Basic -->
        <div class="panel">
            <header class="panel-heading">
                <div class="panel-actions"></div>
                <h3 class="panel-title">Detail Pegawai</h3>
            </header>
            <div class="panel-body">
                <?= $this->session->flashdata('msg') ?>
                <div class="row row-lg">
                    <div class="col-md-8">
                        <!-- Example Basic -->
                        <div class="example-wrap">
                            <div class="example table-responsive">
                                <table class="table">
                                    <tbody>
                                        <tr>
                                            <th>NIP</th>
                                            <td><?= $pegawai->nip ?></td>
                                        </tr>
                                        <tr>
                                            <th>Nama</th>
                                            <td><?= $pegawai->nama ?></td>
                                        </tr>
                                        <tr>
                                            <th>Jabatan</th>
                                            <td><?= $pegawai->jabatan ?></td>
                                        </tr>
                                        <tr>
                                            <th>Email</th>
                                            <td><?= $pegawai->email ?></td>
                                        </tr>
                                        <tr>
                                            <th>Nomor HP</th>
                                            <td><?= $pegawai->nomor_hp ?></td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <!-- End Example Basic -->
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>