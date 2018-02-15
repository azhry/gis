<!-- Page -->
<div class="page animsition">
    <div class="page-header">
        <h3 class="page-title">Edit Pegawai</h3>
        <ol class="breadcrumb">
            <li><a href="<?= base_url('admin') ?>">Dashboard</a></li>
            <li><a href="<?= base_url('admin/pegawai') ?>">Data Pegawai</a></li>
            <li class="active">Edit Pegawai</li>
        </ol>
    </div>
    <div class="page-content">
        <!-- Panel Basic -->
        <div class="panel">
            <header class="panel-heading">
                <div class="panel-actions"></div>
                <h3 class="panel-title">Edit Pegawai</h3>
            </header>
            <div class="panel-body">
                <?= $this->session->flashdata('msg') ?>
                <div class="row row-lg">
                    <div class="col-md-8">
                        <!-- Example Basic -->
                        <div class="example-wrap">
                            <?= form_open_multipart( 'admin/edit-pegawai/' . $nip ) ?>

                            <div class="form-group">
                                <label for="nip">NIP</label>
                                <input type="text" id="nip" name="nip" value="<?= $pegawai->nip ?>" class="form-control">
                            </div>
                            <div class="form-group">
                                <label for="nama">Nama</label>
                                <input type="text" id="nama" name="nama" value="<?= $pegawai->nama ?>" class="form-control">
                            </div>
                            <div class="form-group">
                                <label for="jabatan">Jabatan</label>
                                <input type="text" id="jabatan" name="jabatan" value="<?= $pegawai->jabatan ?>" class="form-control">
                            </div>
                            <div class="form-group">
                                <label for="email">Email</label>
                                <input type="email" id="email" name="email" value="<?= $pegawai->email ?>" class="form-control">
                            </div>
                            <div class="form-group">
                                <label for="nomor_hp">No. HP</label>
                                <input type="nomor_hp" id="nomor_hp" name="nomor_hp" value="<?= $pegawai->nomor_hp ?>" class="form-control">
                            </div>
                            <div class="form-group">
                                <label for="password">Password</label>
                                <input type="password" id="password" name="password" class="form-control">
                            </div>
                            <div class="form-group">
                                <label for="role">Role</label>
                                <?php  
                                    $opt_role = [];
                                    foreach ( $role as $row ) $opt_role[$row->id_role] = $row->role;
                                    echo form_dropdown( 'id_role', $opt_role, $pegawai->id_role, [ 'id' => 'id_role', 'class' => 'form-control' ] );
                                ?>
                            </div>
                            <input type="submit" name="submit" value="Submit" class="btn btn-primary">
                            <?= form_close() ?>
                        </div>
                        <!-- End Example Basic -->
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>