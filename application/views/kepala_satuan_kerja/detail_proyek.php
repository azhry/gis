<!-- Page -->
<div class="page animsition">
    <div class="page-header">
        <h3 class="page-title">Detail Proyek</h3>
        <ol class="breadcrumb">
            <li><a href="<?= base_url('kepala_satuan_kerja') ?>">Dashboard</a></li>
            <li><a href="<?= base_url('kepala_satuan_kerja/proyek') ?>">Data Proyek</a></li>
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
                
                <div id="print-area">
                    <div class="row row-lg">
                        <div class="col-md-8 col-md-offset-2">
                            <div class="example-wrap">
                                <div class="example table-responsive">
                                    <table width="500" class="table">
                                        <tbody>
                                            <tr>
                                                <th>Nama Proyek</th>
                                                <td><?= $proyek->namobj ?></td>
                                            </tr>
                                            <tr>
                                                <th>Tahun Data</th>
                                                <td><?= $proyek->thn_data ?></td>
                                            </tr>
                                            <tr>
                                                <th>Kabupaten</th>
                                                <td><?= $proyek->nama_kabupaten ?></td>
                                            </tr>
                                            <tr>
                                                <th>Kecamatan</th>
                                                <td><?= $proyek->nama_kecamatan ?></td>
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
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-8 col-md-offset-2">
                            <h3>Grafik</h3>
                            <canvas id="proyek" height="220"></canvas>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-12">
                        <button id="unduh-laporan" type="button" class="btn btn-success"><i class="fa fa-download"></i> Unduh Laporan</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript" src="<?= base_url( 'assets/js/jspdf.min.js' ) ?>"></script>
<script type="text/javascript" src="<?= base_url( 'assets/js/html2canvas.js' ) ?>"></script>
<script type="text/javascript" src="<?= base_url('assets/js/plugins/Chart.min.js') ?>"></script>

  <script type="text/javascript">
    function downloadPDF2() {
        var newCanvas = document.querySelector('#print-area');
        html2canvas(newCanvas)
        .then(canvas => {
            //create image from dummy canvas
            var newCanvasImg = canvas.toDataURL("image/png", 1.0);
          
            //creates PDF from img
            var doc = new jsPDF('portrait', "pt", "a4");
            var width = doc.internal.pageSize.width;    
            var height = doc.internal.pageSize.height;
            doc.setFontSize(20);
            doc.addImage(newCanvasImg, 'PNG', 0, 0, width, height);
            doc.save('laporan.pdf');
            $( '#unduh-laporan' ).prop( 'disabled', false );
        });
     }
    $(document).ready(function() {
      initMap();

        $( '#unduh-laporan' ).on('click', function(){

            $( this ).prop( 'disabled', true );
            downloadPDF2();

        });

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
                    <?php $current_progress = 0; foreach ( $progress as $row ): $current_progress += $row->progress; ?>
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
        // '<img width="100" height="100" src="<?= base_url('img/' . $proyek->id . '.jpg') ?>" />'+
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

            