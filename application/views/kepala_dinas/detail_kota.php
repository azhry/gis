<!-- Page -->
<div class="page animsition">
    <div class="page-header"><!--
        <h1 class="page-title">Data Kota</h1> -->
        <h3 class="page-title">Detail Kota</h3>
        <ol class="breadcrumb">
            <li><a href="<?= base_url('kepala_dinas') ?>">Dashboard</a></li>
            <li><a href="<?= base_url('kepala_dinas/kota') ?>">Data Kota</a></li>
            <li class="active">Detail Kota</li>
        </ol>
    </div>
    <div class="page-content">
        <!-- Panel Basic -->
        <div class="panel">
            <header class="panel-heading">
                <div class="panel-actions"></div>
                <h3 class="panel-title">Detail Kota</h3>
            </header>
            <div class="panel-body">
                <?= $this->session->flashdata('msg') ?>
                <div id="map" style="width: 100%; height: 500px;"></div>
                
                <div class="row row-lg">
                    <div class="col-md-4">
                        <center>
                            <img src="<?= base_url('img/' . $kota->id . '.jpg') ?>" class="img-thumbnail" width="200" height="200">
                        </center>
                    </div>
                    <div class="col-md-8">
                        <!-- Example Basic -->
                        <div class="example-wrap">
                            <div class="example table-responsive">
                                <table class="table">
                                    <tbody>
                                        <tr>
                                            <th>kl_dat_das</th>
                                            <td><?= $kota->kl_dat_das ?></td>
                                        </tr>
                                        <tr>
                                            <th>Namobj</th>
                                            <td><?= $kota->namobj ?></td>
                                        </tr>
                                        <tr>
                                            <th>Tahun Data</th>
                                            <td><?= $kota->thn_data ?></td>
                                        </tr>
                                        <tr>
                                            <th>Provinsi</th>
                                            <td><?= $kota->nama_provinsi ?></td>
                                        </tr>
                                        <tr>
                                            <th>Kabupaten Kota</th>
                                            <td><?= $kota->nama_kabupaten ?></td>
                                        </tr>
                                        <tr>
                                            <th>Vol</th>
                                            <td><?= $kota->vol ?></td>
                                        </tr>
                                        <tr>
                                            <th>Biaya</th>
                                            <td><?= $kota->biaya ?></td>
                                        </tr>
                                        <tr>
                                            <th>Longitude</th>
                                            <td><?= $kota->longitude ?></td>
                                        </tr>
                                        <tr>
                                            <th>Latitude</th>
                                            <td><?= $kota->latitude ?></td>
                                        </tr>
                                        <tr>
                                            <th>Remarks</th>
                                            <td><?= $kota->remarks ?></td>
                                        </tr>
                                        <tr>
                                            <th>Metadata</th>
                                            <td><?= $kota->metadata ?></td>
                                        </tr>
                                        <tr>
                                            <th>lcode</th>
                                            <td><?= $kota->lcode ?></td>
                                        </tr>
                                        <tr>
                                            <th>fcode</th>
                                            <td><?= $kota->fcode ?></td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <!-- End Example Basic -->
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

  <script type="text/javascript">
    $(document).ready(function() {
      initMap();
    });

    function initMap() {
      var coordinate = {lat: <?= $kota->latitude ?>, lng: <?= $kota->longitude ?>};
      var map = new google.maps.Map(document.getElementById('map'), {
        zoom: 15,
        center: coordinate
      });

      var marker = new google.maps.Marker({
        position: coordinate,
        map: map
      });

      var contentString = '<div id="content">'+
        '<div id="siteNotice">'+
        '</div>'+
        '<h5 id="firstHeading" class="firstHeading"><?= $kota->kl_dat_das ?></h5>'+
        '<div id="bodyContent">'+
        '<p><?= $kota->namobj ?></p>'+
        '<img width="100" height="100" src="<?= base_url('img/' . $kota->id . '.jpg') ?>" />'+
        '</div>'+
        '</div>';
      var infoWindow = new google.maps.InfoWindow({
        content: contentString
      });
      infoWindow.open(map, marker);
      
      google.maps.event.addListener(map, 'mousemove', function(event){
        map.setOptions({draggableCursor: 'pointer'});
      });
    }
  </script>

            