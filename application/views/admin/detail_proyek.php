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
                <div>
                    <a href="<?= base_url('admin/progress/'.$proyek->id) ?>" class="btn btn-success btn-sm"><i class="fa fa-book"></i> Data Progress</a>
                    <a href="<?= base_url('admin/tambah_progress/'.$proyek->id) ?>" class="btn btn-success btn-sm"><i class="fa fa-plus"></i> Progress</a><!-- 
                    <a href="<?= base_url('admin/edit_progress') ?>" class="btn btn-success btn-sm"><i class="fa fa-edit"></i> Edit Progress</a> -->
                </div>
                <hr>

                <?= $this->session->flashdata('msg') ?>
                <div id="map" style="width: 100%; height: 500px;"></div>
                
                <div class="row row-lg">
                    <!-- <div class="col-md-4">

                        <center>
                            <img src="<?= base_url('img/' . $proyek->id . '.jpg') ?>" class="img-thumbnail" width="200" height="200">
                        </center>
                    </div> -->
                    <div class="col-md-8">
                        <!-- Example Basic -->
                        <div class="example-wrap">
                            <div class="example table-responsive">
                                <table class="table">
                                    <tbody>
                                        <!-- <tr>
                                            <th>kl_dat_das</th>
                                            <td><?= $proyek->kl_dat_das ?></td>
                                        </tr> -->
                                        <tr>
                                            <th>Nama Proyek</th>
                                            <td><?= $proyek->namobj ?></td>
                                        </tr>
                                        <tr>
                                            <th>Tahun</th>
                                            <td><?= $proyek->thn_data ?></td>
                                        </tr>
                                        <!-- <tr>
                                            <th>Provinsi</th>
                                            <td><?= $proyek->nama_provinsi ?></td>
                                        </tr> -->
                                        <tr>
                                            <th>Kabupaten</th>
                                            <td><?= $proyek->nama_kabupaten ?></td>
                                        </tr>
                                        <tr>
                                            <th>Vol</th>
                                            <td><?= $proyek->vol ?></td>
                                        </tr>
                                        <tr>
                                            <th>Anggaran Biaya</th>
                                            <td><?= 'Rp ' . number_format($proyek->anggaran, 0, ',', '.') ?></td>
                                        </tr>
                                        <tr>
                                            <th>Tanggal Mulai</th>
                                            <td><?= $proyek->tanggal_mulai ?></td>
                                        </tr>
                                        <tr>
                                            <th>Tanggal Selesai</th>
                                            <td><?= $proyek->tanggal_selesai ?></td>
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
            labels: [
                <?php foreach ( $progress as $row ): ?>
                '<?= 'Periode ' . $row->periode ?>', 
                <?php endforeach; ?>
            ],
            datasets:[{
                label: 'Progress Proyek <?= $proyek->namobj ?>',
                borderColor: "rgba(26,179,148,0.8)",
                pointBackgroundColor: "rgba(26,179,148,0.5)",
                pointBorderColor: "rgba(26,179,148,0.8)",
                data: [
                    <?php foreach ( $progress as $row ): ?>
                    '<?= $row->progress ?>', 
                    <?php endforeach; ?>
                ]
            }],
        },
        options: {
            scales: {
                yAxes: [{
                    display: true,
                    ticks: {
                        beginAtZero: true,
                        steps: 10,
                        stepValue: 5,
                        max: 100
                    }
                }]
            }
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

            