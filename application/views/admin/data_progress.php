<!-- Page -->
<div class="page animsition">
    <div class="page-header">
        <h3 class="page-title">Data Progress <a class="btn btn-success btn-sm" href="<?= base_url( 'admin/tambah-progress/'.$id_proyek ) ?>"><i class="fa fa-plus"></i></a></h3>
        <ol class="breadcrumb">
            <li><a href="<?= base_url('admin') ?>">Dashboard</a></li>
            <li><a href="<?= base_url('admin/detail_proyek/'.$id_proyek) ?>">Detail Proyek</a></li>
            <li class="active">Data Progress</li>
        </ol>
    </div>
    <div class="page-content">
        <!-- Panel Basic -->
        <div class="panel">
            <header class="panel-heading">
                <div class="panel-actions"></div>
                <h3 class="panel-title">Data Progress</h3>
            </header>
            <div class="panel-body">
                <div>
                    <?= $this->session->flashdata('msg') ?>
                </div>
                <table class="table table-hover dataTable table-striped width-full" data-plugin="dataTable">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Serapan Anggaran</th>
                            <th>Periode</th>
                            <th>Persentase</th>
                            <th>Perkembangan</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $current_progress = 0; $i=1; foreach($progress as $row): $current_progress += ($row->serapan_anggaran / $proyek->anggaran) * 100; ?>
                        <tr>
                            <td><?= $i ?></td>
                            <td><?= $row->serapan_anggaran ?></td>
                            <td><?= $row->periode ?></td>
                            <td><?= ($row->serapan_anggaran / $proyek->anggaran) * 100 . '%' ?></td>
                            <td><?= $current_progress . '%' ?></td>
                            <td>
                                <center>
                                <a href="<?= base_url( 'admin/edit-progress/' . $row->id_progress ) ?>" class="btn btn-primary btn-sm"><i class="fa fa-edit"></i> Edit</a>
                                <a href="<?= base_url('admin/progress/' . $id_proyek . '?delete=true&id_progress=' . $row->id_progress) ?>" class="btn btn-danger btn-sm"><i class="fa fa-trash"></i> Delete</a>
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