    <!-- Page -->
  <div class="page animsition">
    <div class="page-header"><!-- 
      <h1 class="page-title">Data kabupaten</h1> -->
      <h3 class="page-title">Data Kecamatan <button class="btn btn-success btn-sm" data-toggle="modal" data-target="#add"><i class="fa fa-plus"></i></button></h3>
      <ol class="breadcrumb">
        <li><a href="<?= base_url('admin') ?>">Dashboard</a></li>
        <li class="active">Data Kecamatan</li>
      </ol>
    </div>
    <div class="page-content">
      <!-- Panel Basic -->
      <div class="panel">
        <header class="panel-heading">
          <div class="panel-actions"></div>
          <h3 class="panel-title">Data Kecamatan</h3>

        </header>
        <div class="panel-body">
          <div>
              <?= $this->session->flashdata('msg') ?>
          </div>
          <table class="table table-hover dataTable table-striped width-full" data-plugin="dataTable">
            <thead>
              <tr>
                <th>No</th>
                <th>Nama</th>
                <th>Aksi</th>
              </tr>
            </thead>
            <tbody>
              <?php $i=1; foreach($kecamatan as $row): ?>
                <tr>
                  <td><?= $i ?></td>
                  <td><?= $row->nama ?></td>
                  <td>
                    <center>
                      <a href="#" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#edit" onclick="get_kecamatan(<?= $row->id_kecamatan ?>);"><i class="fa fa-edit"></i> Edit</a>
                      <a href="<?= base_url('admin/kecamatan?delete=true&id_kecamatan=' . $row->id_kecamatan) ?>" class="btn btn-danger btn-sm"><i class="fa fa-trash"></i> Delete</a>
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
  <!-- End Page -->

  <style type="text/css"> .required{color: red;} </style>

            <div class="modal fade" tabindex="-1" role="dialog" id="add">
              <div class="modal-dialog" role="document">
                <?= form_open_multipart('admin/kecamatan', ['id' => 'tambah']) ?>
               <div class="modal-content">
                  <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title">Tambah Data Kecamatan</h4>
                  </div>
                  <div class="modal-body">
                        <div class="form-group">
                            <label for="Nama">Nama<span class="required">*</span></label>
                            <input type="text" class="form-control" name="nama" required>
                        </div>
                        <div class="form-group">
                            <label for="kabupaten">Kabupaten<span class="required">*</span></label>
                            <select class="form-control" name="id_kabupaten" required>
                              <option>Pilih Kabupaten</option>
                              <?php foreach ( $kabupaten as $row ): ?>
                                <option value="<?= $row->id_kabupaten ?>"><?= $row->nama ?></option>
                              <?php endforeach; ?>
                            </select>
                        </div>
                  </div>
                  <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Batal</button>
                    <input type="submit" name="simpan" value="Simpan" class="btn btn-primary" onclick="simpan_data()">
                  </div>
                  <?= form_close() ?>
                </div><!-- /.modal-content -->
              </div><!-- /.modal-dialog -->
            </div><!-- /.modal -->

            <div class="modal fade" tabindex="-1" role="dialog" id="edit">
              <div class="modal-dialog" role="document">
                <?= form_open_multipart('admin/kecamatan', ['id' => 'edit_data']) ?>
               <div class="modal-content">
                  <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title">Edit Data Kecamatan</h4>
                  </div>
                  <div class="modal-body">
                        <input type="hidden" name="id_kecamatan" id="id_kecamatan">
                        <div class="form-group">
                            <label for="Nama">Nama<span class="required">*</span></label>
                            <input type="text" class="form-control" name="nama" required id="nama">
                        </div>
                        <div class="form-group">
                          <label for="id_kabupaten">Kabupaten<span class="required">*</span></label>
                          <div id="container-kabupaten"></div>
                        </div>
                  </div>
                  <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Batal</button>
                    <input type="submit" name="edit" value="Edit" class="btn btn-primary" onclick="edit_data()">
                  </div>
                  <?= form_close() ?>
                </div><!-- /.modal-content -->
              </div><!-- /.modal-dialog -->
            </div><!-- /.modal -->
</div>

            <script>
                $(document).ready(function() {
                    $('#datatable').DataTable({
                        responsive: true
                    });

                    $('#add').on('shown.bs.modal', function() {
                      initMap('map-add');
                    });
                });

                function simpan_data(){
                  $("#add").submit();
                }

                function edit_data(){
                  $("#edit_data").submit();
                }

                function get_kecamatan(id_kecamatan) {
                  $.ajax({
                    url: '<?= base_url('admin/kecamatan') ?>',
                    type: 'POST',
                    data: {
                      id_kecamatan: id_kecamatan,
                      get: true
                    },
                    success: function(response) {
                        var json = $.parseJSON(response);
                        $('#id_kecamatan').val(json.id_kecamatan);
                        $('#nama').val(json.nama);
                        $('#container-kabupaten').html(json.dropdown);
                    },
                    error: function(e) {
                      console.log(e.responseText);
                    }
                  });
                }
            </script>