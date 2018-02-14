<!-- Page -->
<div class="page animsition">
    <div class="page-header"><!--
        <h1 class="page-title">Data Proyek</h1> -->
        <h3 class="page-title">Data Proyek <button class="btn btn-success btn-sm" data-toggle="modal" data-target="#add"><i class="fa fa-plus"></i></button></h3>
        <ol class="breadcrumb">
            <li><a href="<?= base_url('admin') ?>">Dashboard</a></li>
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
            <div class="panel-body">
                <div>
                    <?= $this->session->flashdata('msg') ?>
                </div>
                <table class="table table-hover dataTable table-striped width-full" data-plugin="dataTable">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Foto</th>
                            <th>KL_DAT_DAS</th>
                            <th>Namobj</th>
                            <th>Tahun</th>
                            <th>Provinsi</th>
                            <th>Kabupaten</th>
                            <!-- <th>Koordinat</th> -->
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $i=1; foreach($proyek as $row): ?>
                        <tr>
                            <td><?= $i ?></td>
                            <td>
                                <img src="<?= base_url('img/' . $row->id . '.jpg') ?>" width="100" height="100" onerror="this.src = 'http://placehold.it/100x100'">
                            </td>
                            <td><?= $row->kl_dat_das ?></td>
                            <td><?= $row->namobj ?></td>
                            <td><?= $row->thn_data ?></td>
                            <td><?= $row->nama_provinsi ?></td>
                            <td><?= $row->nama_kabupaten ?></td>
                            <td>
                                <center>
                                <a href="<?= base_url('admin/detail-proyek/' . $row->id) ?>" class="btn btn-info btn-sm"><i class="fa fa-eye"></i> Detail</a>
                                <a href="<?= base_url( 'admin/edit-proyek/' . $row->id ) ?>" class="btn btn-primary btn-sm"><i class="fa fa-edit"></i> Edit</a>
                                <a href="<?= base_url('admin/proyek?delete=true&id=' . $row->id) ?>" class="btn btn-danger btn-sm"><i class="fa fa-trash"></i> Delete</a>
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