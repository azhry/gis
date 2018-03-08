<!-- Page -->
<div class="page animsition">
    <div class="page-header">
        <h3 class="page-title">Detail Proyek</h3>
        <ol class="breadcrumb">
            <li><a href="<?= base_url('admin') ?>">Dashboard</a></li>
            <li><a href="<?= base_url('admin/proyek') ?>">Data Proyek</a></li>
            <li class="active">Detail Proyek</li>
        </ol>
    </div>
    <div class="page-content">
        <!-- Panel Basic -->
        <div class="panel">
            <header class="panel-heading">
                <div class="panel-actions"></div>
                <h3 class="panel-title">Detail Proyek</h3>
            </header>
            <div class="panel-body">
                <?= $this->session->flashdata('msg') ?>
                <div id="map" style="width: 100%; height: 500px;"></div>
                
                <div class="row row-lg">
                    <div class="col-md-4">
                        <center>
                            <img src="<?= base_url('img/' . $proyek->id . '.jpg') ?>" class="img-thumbnail" width="200" height="200">
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
                                            <td><?= $proyek->kl_dat_das ?></td>
                                        </tr>
                                        <tr>
                                            <th>Namobj</th>
                                            <td><?= $proyek->namobj ?></td>
                                        </tr>
                                        <tr>
                                            <th>Tahun Data</th>
                                            <td><?= $proyek->thn_data ?></td>
                                        </tr>
                                        <tr>
                                            <th>Provinsi</th>
                                            <td><?= $proyek->nama_provinsi ?></td>
                                        </tr>
                                        <tr>
                                            <th>Kabupaten</th>
                                            <td><?= $proyek->nama_kabupaten ?></td>
                                        </tr>
                                        <tr>
                                            <th>Vol</th>
                                            <td><?= $proyek->vol ?></td>
                                        </tr>
                                        <tr>
                                            <th>Biaya</th>
                                            <td><?= $proyek->biaya ?></td>
                                        </tr>
                                        <tr>
                                            <th>Longitude</th>
                                            <td><?= $proyek->longitude ?></td>
                                        </tr>
                                        <tr>
                                            <th>Latitude</th>
                                            <td><?= $proyek->latitude ?></td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <!-- End Example Basic -->
                    </div>
                </div>

                <div class="row">
                    <div>
                        <h3>Grafik</h3>
                        <canvas id="proyek" height="120"></canvas>
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>


<script type="text/javascript" src="<?= base_url('assets/js/plugins/Chart.min.js') ?>"></script>

  <script type="text/javascript">
    $(document).ready(function() {
      initMap();

      var lineChart = document.getElementById('proyek').getContext('2d');
      new Chart(lineChart, {
        type : 'line',
        data:{
            labels: ['label1', 'label2', 'label3'],
            datasets:[{
                label: 'data1',
                borderColor: "rgba(26,179,148,0.8)",
                pointBackgroundColor: "rgba(26,179,148,0.5)",
                pointBorderColor: "rgba(26,179,148,0.8)",
                data: [1, 2, 3]
            },
            {
                label: 'data2',
                borderColor: "yellow",
                pointBackgroundColor: "rgba(26,179,148,0.5)",
                pointBorderColor: "rgba(26,179,148,0.8)",
                data: [3, 2, 1]
            }],
        }
      });

    });

    function initMap() {
      var coordinate = {lat: <?= $proyek->latitude ?>, lng: <?= $proyek->longitude ?>};
      var map = new google.maps.Map(document.getElementById('map'), {
        zoom: 12,
        center: coordinate
      });

      var marker = new google.maps.Marker({
        position: coordinate,
        map: map
      });

      var contentString = '<div id="content">'+
        '<div id="siteNotice">'+
        '</div>'+
        '<h5 id="firstHeading" class="firstHeading"><?= $proyek->kl_dat_das ?></h5>'+
        '<div id="bodyContent">'+
        '<p><?= $proyek->namobj ?></p>'+
        '<img width="100" height="100" src="<?= base_url('img/' . $proyek->id . '.jpg') ?>" />'+
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

            