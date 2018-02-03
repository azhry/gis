    <!-- Page -->
  <div class="page animsition">
    <div class="page-header"><!-- 
      <h1 class="page-title">Data Kota</h1> -->
      <h3 class="page-title">Data Kota <button class="btn btn-success btn-sm" data-toggle="modal" data-target="#add"><i class="fa fa-plus"></i></button></h3>
      <ol class="breadcrumb">
        <li><a href="<?= base_url('admin') ?>">Dashboard</a></li>
        <li class="active">Data Kota</li>
      </ol>
    </div>
    <div class="page-content">
      <!-- Panel Basic -->
      <div class="panel">
        <header class="panel-heading">
          <div class="panel-actions"></div>
          <h3 class="panel-title">Data Kota</h3>

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
              <?php $i=1; foreach($kota as $row): ?>
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
                  <!-- <td><?= $row->latitude ?>,<?= $row->longitude ?></td> -->
                  <td>
                    <center>
                      <a href="<?= base_url('admin/detail-Kota/' . $row->id) ?>" class="btn btn-info btn-sm"><i class="fa fa-eye"></i> Detail</a>
                      <a href="#" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#edit" onclick="get_kota(<?= $row->id ?>);"><i class="fa fa-edit"></i> Edit</a>
                      <a href="<?= base_url('admin/Kota?delete=true&id=' . $row->id) ?>" class="btn btn-danger btn-sm"><i class="fa fa-trash"></i> Delete</a>
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
                <?= form_open_multipart('admin/kota', ['id' => 'tambah']) ?>
               <div class="modal-content">
                  <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title">Tambah Data Kota</h4>
                  </div>
                  <div class="modal-body">
                        <div class="form-group">
                            <label for="Namobj">Namobj<span class="required">*</span></label>
                            <input type="text" class="form-control" name="namobj" required>
                        </div>
                        <div class="form-group">
                            <label for="Kl_dat_das">Kl_dat_das<span class="required">*</span></label>
                            <input type="text" class="form-control" name="kl_dat_das" required>
                        </div>
                        <div class="form-group">
                            <label for="thn_data">Tahun Data<span class="required">*</span></label>
                            <input type="number" class="form-control" name="thn_data" required>
                        </div>
                        <div class="form-group">
                            <label for="id_provinsi">Provinsi<span class="required">*</span></label>
                            <select class="form-control" name="id_provinsi" required>
                                <option>Pilih Provinsi</option>
                                <?php foreach ($provinsi as $row): ?>
                                    <option value="<?= $row->id_provinsi ?>"><?= $row->nama ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="id_kabupaten">Kabupaten Kota<span class="required">*</span></label>
                            <select class="form-control" name="id_kabupaten" required>
                                <option>Pilih Kabupaten</option>
                                <?php foreach ($kabupaten as $row): ?>
                                    <option value="<?= $row->id_kabupaten ?>"><?= $row->nama ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="Vol">Vol<span class="required">*</span></label>
                            <input type="text" class="form-control" name="vol" required>
                        </div>
                        <div class="form-group">
                            <label for="Biaya">Biaya<span class="required">*</span></label>
                            <input type="text" class="form-control" name="biaya" required>
                        </div>
                        <div class="form-group">
                            <label>Pilih Koordinat Lokasi Proyek</label>
                            <div class="gmap" id="map-add" style="width: 100%; height: 250px;"></div>
                            <p>Koordinat: <span id="map-add-latitude"></span>, <span id="map-add-longitude"></span></p>
                            <input type="hidden" id="map-add-hidden_latitude" name="latitude" required>
                            <input type="hidden" id="map-add-hidden_longitude" name="longitude" required>
                        </div>
                        <div class="form-group">
                            <label for="foto">Upload Foto Proyek<span class="required">*</span></label>
                            <input type="file" name="foto">
                        </div>
                        <div class="form-group">
                            <label for="Remarks">Remarks<span class="required">*</span></label>
                            <input type="text" class="form-control" name="remarks" required>
                        </div>
                        <div class="form-group">
                            <label for="Metadata">Metadata<span class="required">*</span></label>
                            <input type="text" class="form-control" name="metadata" required>
                        </div>
                        <div class="form-group">
                            <label for="lcode">lcode<span class="required">*</span></label>
                            <input type="text" class="form-control" name="lcode" required>
                        </div>
                        <div class="form-group">
                            <label for="fcode">fcode<span class="required">*</span></label>
                            <input type="text" class="form-control" name="fcode" required>
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
                <?= form_open_multipart('admin/kota', ['id' => 'edit_data']) ?>
               <div class="modal-content">
                  <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title">Detail Data Kota</h4>
                  </div>
                  <div class="modal-body">
                        <input type="hidden" name="id" id="id">
                        <div class="form-group">
                            <label for="Namobj">Namobj<span class="required">*</span></label>
                            <input type="text" class="form-control" name="namobj" required id="namobj">
                        </div>
                        <div class="form-group">
                            <label for="Kl_dat_das">Kl_dat_das<span class="required">*</span></label>
                            <input type="text" class="form-control" name="kl_dat_das" required id="kl_dat_das">
                        </div>
                        <div class="form-group">
                            <label for="thn_data">Tahun Data<span class="required">*</span></label>
                            <input type="number" class="form-control" name="thn_data" required id="thn_data">
                        </div>
                        <div class="form-group">
                            <label for="id_provinsi">Provinsi<span class="required">*</span></label>
                            <div id="id_provinsi"></div>
                        </div>
                        <div class="form-group">
                            <label for="id_kabupaten">Kabupaten Kota<span class="required">*</span></label>
                            <div id="id_kabupaten"></div>
                        </div>
                        <div class="form-group">
                            <label for="Vol">Vol<span class="required">*</span></label>
                            <input type="text" class="form-control" name="vol" required id="vol">
                        </div>
                        <div class="form-group">
                            <label for="Biaya">Biaya<span class="required">*</span></label>
                            <input type="text" class="form-control" name="biaya" required id="biaya">
                        </div>
                        <div class="form-group">
                            <label>Pilih Koordinat Jalan</label>
                            <div class="gmap" id="map-edit" style="width: 100%; height: 250px;"></div>
                            <p>Koordinat: <span id="map-edit-latitude"></span>, <span id="map-edit-longitude"></span></p>
                            <input type="hidden" id="map-edit-hidden_latitude" name="latitude" required>
                            <input type="hidden" id="map-edit-hidden_longitude" name="longitude" required>
                        </div>
                        <div id="img-placeholder">
                          <img src="<?= base_url('img/150x150.png') ?>" width="150" height="150">
                        </div>
                        <div class="form-group">
                            <label for="foto">Upload Foto Proyek<span class="required">*</span></label>
                            <input type="file" name="foto" id="foto">
                        </div>
                        <div class="form-group">
                            <label for="Remarks">Remarks<span class="required">*</span></label>
                            <input type="text" class="form-control" name="remarks" required id="remarks">
                        </div>
                        <div class="form-group">
                            <label for="Metadata">Metadata<span class="required">*</span></label>
                            <input type="text" class="form-control" name="metadata" required id="metadata">
                        </div>
                        <div class="form-group">
                            <label for="lcode">lcode<span class="required">*</span></label>
                            <input type="text" class="form-control" name="lcode" required id="lcode">
                        </div>
                        <div class="form-group">
                            <label for="fcode">fcode<span class="required">*</span></label>
                            <input type="text" class="form-control" name="fcode" required id="fcode">
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

                function get_kota(id) {
                  $.ajax({
                    url: '<?= base_url('admin/Kota') ?>',
                    type: 'POST',
                    data: {
                      id: id,
                      get: true
                    },
                    success: function(response) {
                        var json = $.parseJSON(response);
                        $('#id').val(json.id);
                        $('#namobj').val(json.namobj);
                        $('#kl_dat_das').val(json.kl_dat_das);
                        $('#thn_data').val(json.thn_data);
                        $('#vol').val(json.vol);
                        $('#biaya').val(json.biaya);
                        $('#remarks').val(json.remarks);
                        $('#metadata').val(json.metadata);
                        $('#lcode').val(json.lcode);
                        $('#fcode').val(json.fcode);

                        $('#id_provinsi').html(json.dropdown_provinsi);
                        $('#id_kabupaten').html(json.dropdown_kabupaten);
                        $('#img-placeholder').html('<img src="<?= base_url('img') ?>/' + json.id + '.jpg?' + json.id + '" width="150" height="150">');

                        editMap('map-edit', json.latitude, json.longitude);
                    },
                    error: function(e) {
                      console.log(e.responseText);
                    }
                  });
                }

                function initMap(id) {
                  $('#' + id + '-latitude').text('');
                  $('#' + id + '-longitude').text('');
                  $('#' + id + '-hidden_latitude').val(null);
                  $('#' + id + '-hidden_longitude').val(null);
                  var coordinate = {lat: -6.121435, lng: 106.774124};
                  var map = new google.maps.Map(document.getElementById(id), {
                    zoom: 8,
                    center: coordinate
                  });
                  var marker = new google.maps.Marker({
                    position: coordinate,
                    map: map
                  });
                  google.maps.event.addListener(map, 'click', function(event){
                    var latLng = new google.maps.LatLng(event.latLng.lat(), event.latLng.lng());
                    marker.setPosition(latLng);
                    $('#' + id + '-latitude').text(event.latLng.lat());
                    $('#' + id + '-longitude').text(event.latLng.lng());
                    $('#' + id + '-hidden_latitude').val(event.latLng.lat());
                    $('#' + id + '-hidden_longitude').val(event.latLng.lng());

                  });
                  google.maps.event.addListener(map, 'mousemove', function(event){
                    map.setOptions({draggableCursor: 'pointer'});
                  });
                }

                function editMap(id, latitude, longitude) {
                  $('#' + id + '-latitude').text(latitude);
                  $('#' + id + '-longitude').text(longitude);
                  $('#' + id + '-hidden_latitude').val(latitude);
                  $('#' + id + '-hidden_longitude').val(longitude);
                  var coordinate = {lat: parseFloat(latitude), lng: parseFloat(longitude)};
                  var map = new google.maps.Map(document.getElementById(id), {
                    zoom: 8,
                    center: coordinate
                  });
                  var marker = new google.maps.Marker({
                    position: coordinate,
                    map: map
                  });
                  google.maps.event.addListener(map, 'click', function(event){
                    var latLng = new google.maps.LatLng(event.latLng.lat(), event.latLng.lng());
                    marker.setPosition(latLng);
                    $('#' + id + '-latitude').text(event.latLng.lat());
                    $('#' + id + '-longitude').text(event.latLng.lng());
                    $('#' + id + '-hidden_latitude').val(event.latLng.lat());
                    $('#' + id + '-hidden_longitude').val(event.latLng.lng());

                  });
                  google.maps.event.addListener(map, 'mousemove', function(event){
                    map.setOptions({draggableCursor: 'pointer'});
                  });
                }
            </script>