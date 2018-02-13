    <!-- Page -->
  <div class="page animsition">
    <div class="page-header"><!-- 
      <h1 class="page-title">Data kabupaten</h1> -->
      <h3 class="page-title">Data Kabupaten <button class="btn btn-success btn-sm" data-toggle="modal" data-target="#add"><i class="fa fa-plus"></i></button></h3>
      <ol class="breadcrumb">
        <li><a href="<?= base_url('admin') ?>">Dashboard</a></li>
        <li class="active">Data Kabupaten</li>
      </ol>
    </div>
    <div class="page-content">
      <!-- Panel Basic -->
      <div class="panel">
        <header class="panel-heading">
          <div class="panel-actions"></div>
          <h3 class="panel-title">Data Kabupaten</h3>

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
              <?php $i=1; foreach($kabupaten as $row): ?>
                <tr>
                  <td><?= $i ?></td>
                  <td><?= $row->nama ?></td>
                  <td>
                    <center>
                      <a href="#" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#edit" onclick="get_kabupaten(<?= $row->id_kabupaten ?>);"><i class="fa fa-edit"></i> Edit</a>
                      <a href="<?= base_url('admin/kabupaten?delete=true&id_kabupaten=' . $row->id_kabupaten) ?>" class="btn btn-danger btn-sm"><i class="fa fa-trash"></i> Delete</a>
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
                <?= form_open_multipart('admin/kabupaten', ['id' => 'tambah']) ?>
               <div class="modal-content">
                  <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title">Tambah Data Kabupaten</h4>
                  </div>
                  <div class="modal-body">
                        <div class="form-group">
                            <label for="Nama">Nama<span class="required">*</span></label>
                            <input type="text" class="form-control" name="nama" required>
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
                <?= form_open_multipart('admin/kabupaten', ['id' => 'edit_data']) ?>
               <div class="modal-content">
                  <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title">Edit Data Kabupaten</h4>
                  </div>
                  <div class="modal-body">
                        <input type="hidden" name="id_kabupaten" id="id_kabupaten">
                        <div class="form-group">
                            <label for="Nama">Nama<span class="required">*</span></label>
                            <input type="text" class="form-control" name="nama" required id="nama">
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

                function get_kabupaten(id_kabupaten) {
                  $.ajax({
                    url: '<?= base_url('admin/kabupaten') ?>',
                    type: 'POST',
                    data: {
                      id_kabupaten: id_kabupaten,
                      get: true
                    },
                    success: function(response) {
                        var json = $.parseJSON(response);
                        $('#id_kabupaten').val(json.id_kabupaten);
                        $('#nama').val(json.nama);
                    },
                    error: function(e) {
                      console.log(e.responseText);
                    }
                  });
                }
            </script>