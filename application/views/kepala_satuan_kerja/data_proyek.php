<!-- Page -->
<div class="page animsition">
    <div class="page-header">
        <h3 class="page-title">Data Proyek</h3>
        <ol class="breadcrumb">
            <li><a href="<?= base_url('kepala_satuan_kerja') ?>">Dashboard</a></li>
            <li class="active">Data Proyek</li>
        </ol>
    </div>
    <div class="page-content">
        <!-- Panel Basic -->
        <div class="panel">
            <header class="panel-heading">
                <div class="panel-actions"></div>
                <h3 class="panel-title">Data Proyek</h3>
            </header>
            <div class="btn-group">
                <a href="<?= base_url( 'kepala-satuan-kerja/proyek' ) ?>" class="btn btn-primary">Semua</a>
                <?php foreach ( $tahun as $row ): ?>
                    <a href="<?= base_url( 'kepala-satuan-kerja/proyek/' . $row->tahun ) ?>" class="btn btn-primary"><?= $row->tahun ?></a>
                <?php endforeach; ?>
            </div>
            <div class="panel-body">
                <div>
                    <?= $this->session->flashdata('msg') ?>
                </div>
                <table class="table table-hover dataTable table-striped width-full" data-plugin="dataTable">
                    <thead>
                        <tr>
                            <th>No</th><!-- 
                            <th>Foto</th> -->
                            <th>Nama Proyek</th>
                            <th>Kabupaten</th>
                            <th>Tahun</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $i=1; foreach($proyek as $row): ?>
                        <tr>
                            <td><?= $i ?></td>
                            <!-- <td>
                                <img src="<?= base_url('img/' . $row->id . '.jpg') ?>" width="100" height="100" onerror="this.src = 'http://placehold.it/100x100'">
                            </td> -->
                            <td><?= $row->namobj ?></td>
                            <td><?= $row->nama_kabupaten ?></td>
                            <td><?= $row->thn_data ?></td>
                            <td>
                                <center>
                                <a href="<?= base_url('kepala_satuan_kerja/detail-proyek/' . $row->id) ?>" class="btn btn-info btn-sm"><i class="fa fa-eye"></i> Detail</a>
                                </center>
                            </td>
                        </tr>
                        <?php $i++;endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
        <!-- End Panel Basic -->
    </div>
</div>
<script>
    $(document).ready(function() {
        $('#datatable').DataTable({
            responsive: true
        });
    });


</script>