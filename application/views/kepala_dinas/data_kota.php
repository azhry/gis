    <!-- Page -->
  <div class="page animsition">
    <div class="page-header"><!-- 
      <h1 class="page-title">Data Kota</h1> -->
      <h3 class="page-title">Data Kota 
      <ol class="breadcrumb">
        <li><a href="<?= base_url('kepala_dinas') ?>">Dashborad</a></li>
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
                <th>KL_DAT_DAS</th>
                <th>Namobj</th>
                <th>Tahun</th>
                <th>Provinsi</th>
                <th>Kabupaten</th>
                <th>Koordinat</th>
                <th>Aksi</th>
              </tr>
            </thead>
            <tbody>
              <?php $i=1; foreach($kota as $row): ?>
                <tr>
                  <td><?= $i ?></td>
                  <td><?= $row->kl_dat_das ?></td>
                  <td><?= $row->namobj ?></td>
                  <td><?= $row->thn_data ?></td>
                  <td><?= $row->provinsi ?></td>
                  <td><?= $row->kab_kota ?></td>
                  <td><?= $row->latitude ?>,<?= $row->longitude ?></td>
                  <td>
                    <center>
                      <a href="<?= base_url('kepala_dinas/detail-Kota/' . $row->id) ?>" class="btn btn-info btn-sm"><i class="fa fa-eye"></i> Detail</a>
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
           <script>
                $(document).ready(function() {
                    $('#datatable').DataTable({
                        responsive: true
                    });

                    $('#add').on('shown.bs.modal', function() {
                      initMap('map-add');
                    });
                });
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