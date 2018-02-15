<!-- Page -->
<div class="page animsition">
    <div class="page-header">
        <h3 class="page-title">Data Pegawai <a class="btn btn-success btn-sm" href="<?= base_url( 'admin/tambah-pegawai' ) ?>"><i class="fa fa-plus"></i></a></h3>
        <ol class="breadcrumb">
            <li><a href="<?= base_url('admin') ?>">Dashboard</a></li>
            <li class="active">Data Pegawai</li>
        </ol>
    </div>
    <div class="page-content">
        <!-- Panel Basic -->
        <div class="panel">
            <header class="panel-heading">
                <div class="panel-actions"></div>
                <h3 class="panel-title">Data Pegawai</h3>
            </header>
            <div class="panel-body">
                <div>
                    <?= $this->session->flashdata('msg') ?>
                </div>
                <table class="table table-hover dataTable table-striped width-full" data-plugin="dataTable">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>NIP</th>
                            <th>Nama</th>
                            <th>Jabatan</th>
                            <th>Email</th>
                            <th>No. HP</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $i=1; foreach($pegawai as $row): ?>
                        <tr>
                            <td><?= $i ?></td>
                            <td><?= $row->nip ?></td>
                            <td><?= $row->nama ?></td>
                            <td><?= $row->jabatan ?></td>
                            <td><?= $row->email ?></td>
                            <td><?= $row->nomor_hp ?></td>
                            <td>
                                <center>
                                <a href="<?= base_url('admin/detail-pegawai/' . $row->nip) ?>" class="btn btn-info btn-sm"><i class="fa fa-eye"></i> Detail</a>
                                <a href="<?= base_url( 'admin/edit-pegawai/' . $row->nip ) ?>" class="btn btn-primary btn-sm"><i class="fa fa-edit"></i> Edit</a>
                                <a href="<?= base_url('admin/pegawai?delete=true&nip=' . $row->nip) ?>" class="btn btn-danger btn-sm"><i class="fa fa-trash"></i> Delete</a>
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