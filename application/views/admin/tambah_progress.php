<!-- Page -->
<div class="page animsition">
    <div class="page-header">
        <h3 class="page-title">Tambah Progress</h3>
        <ol class="breadcrumb">
            <li><a href="<?= base_url('admin') ?>">Dashboard</a></li>
            <li><a href="<?= base_url('admin/proyek') ?>">Data Proyek</a></li>
            <li><a href="<?= base_url('admin/detail_proyek/'.$id_proyek) ?>">Detail Proyek</a></li>
            <li class="active">Tambah Progress</li>
        </ol>
    </div>
    <div class="page-content">
        <!-- Panel Basic -->
        <div class="panel">
            <header class="panel-heading">
                <div class="panel-actions"></div>
                <h3 class="panel-title">Tambah Progress</h3>
            </header>
            <div class="panel-body">
                <?= $this->session->flashdata('msg') ?>
                <div class="row row-lg">
                    <div class="col-md-8">
                        <!-- Example Basic -->
                        <div class="example-wrap">
                            <?= form_open( 'admin/tambah-progress/'.$id_proyek ) ?>

                            <div class="form-group">
                                <label for="serapan_anggaran">Serapan Anggaran</label>
                                <input type="number" id="serapan_anggaran" name="serapan_anggaran" class="form-control">
                            </div>
                            <div class="form-group">
                                <label for="periode">Periode</label>
                                <input type="number" id="periode" name="periode" class="form-control">
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