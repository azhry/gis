<!-- Page -->
<div class="page animsition">
    <div class="page-header">
        <h3 class="page-title">Edit Progress</h3>
        <ol class="breadcrumb">
            <li><a href="<?= base_url('admin') ?>">Dashboard</a></li>
            <li><a href="<?= base_url('admin/proyek') ?>">Data Proyek</a></li>
            <li><a href="<?= base_url('admin/detail_proyek/'.$id_proyek) ?>">Detail Proyek</a></li>
            <li class="active">Edit Progress</li>
        </ol>
    </div>
    <div class="page-content">
        <!-- Panel Basic -->
        <div class="panel">
            <header class="panel-heading">
                <div class="panel-actions"></div>
                <h3 class="panel-title">Edit Progress</h3>
            </header>
            <div class="panel-body">
                <?= $this->session->flashdata('msg') ?>
                <div class="row row-lg">
                    <div class="col-md-8">
                        <!-- Example Basic -->
                        <div class="example-wrap">
                            <?= form_open( 'admin/edit-progress/'.$progress->id_progress ) ?>
                            <input type="hidden" name="id_progress"  value="<?= $progress->id_progress ?>">
                            <div class="form-group">
                                <label for="serapan_anggaran">Serapan Anggaran</label>
                                <input type="number" value="<?= $progress->serapan_anggaran ?>" id="serapan_anggaran" name="serapan_anggaran" class="form-control">
                            </div>
                            <div class="form-group">
                                <label for="periode">Periode</label>
                                <input type="number" value="<?= $progress->periode ?>" id="periode" name="periode" class="form-control">
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