<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
    <meta name="description" content="bootstrap admin template">
    <meta name="author" content="">

    <title>Peta Proyek | Sistem Informasi Geografis</title>

    <!-- Stylesheets -->
  <link rel="stylesheet" href="<?= base_url('assets') ?>/css/bootstrap.min.css">
  <link rel="stylesheet" href="<?= base_url('assets') ?>/css/bootstrap-extend.min.css">
  <link rel="stylesheet" href="<?= base_url('assets') ?>/css/site.min.css">

  <script src="<?= base_url('assets') ?>/vendor/jquery/jquery.js"></script>

  <script>
    Breakpoints();
  </script>

  <!-- Google Maps API -->
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCcsdhzlDXAOHihT8kYUqvxBPhXDv4qtm0"></script>
</head>
<body>

    <!-- Page -->
    <div class="page animsition" style="margin-top: -5%;">
        <div class="row">
            <div class="col-md-10 col-md-offset-1">
                <div class="page-header">
                    <h3 class="page-title">Peta Proyek</h3>
                </div>
                <div class="page-content">
                    <!-- Panel Basic -->
                    <div class="panel">
                        <header class="panel-heading">
                            <div class="panel-actions"></div>
                        </header>
                        <div class="panel-body" id="laporan">
                            <h4 class="text-center" style="padding:3%;">Data Lokasi Proyek</h4>
                            <div id="map" style="width: 100%; height: 600px;"></div>
                            <br><br>
                            <div class="row">
                                <div class="col-md-8">
                                    <h4>Jarak lokasi proyek dari kota Bengkulu</h4>
                                    <table class="table table-bordered table-hover table-striped">
                                        <thead>
                                            <tr>
                                                <th>Icon</th>
                                                <th>Nama Proyek</th>
                                                <th>Jarak</th>
                                                <th>Kabupaten</th>
                                                <th>Dana</th>
                                            </tr>
                                        </thead>
                                        <tbody id="jarak-wrapper"></tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

<script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/1.3.5/jspdf.debug.js"></script>
<script type="text/javascript" src="<?= base_url( 'assets/js/html2canvas.js' ) ?>"></script>
<script type="text/javascript">
    var bengkulu = new google.maps.LatLng(-3.793703, 102.270013);
    var mapOptions = {
        zoom: 12,
        center: bengkulu
    };
    var map = new google.maps.Map(document.getElementById('map'), mapOptions);

    $(document).ready(function() {
        initMap();
    });

    function initMap() {

        var directionService = new google.maps.DirectionsService();

        var marker_bengkulu = new google.maps.Marker({
            position: bengkulu,
            map: map
        });

        <?php foreach ($proyek as $row): ?>
            var marker_<?= $row->id ?> = new google.maps.Marker({
                position: {lat: <?= $row->latitude ?>, lng: <?= $row->longitude ?>},
                map: map,
                icon: 'http://maps.google.com/mapfiles/kml/pal2/icon<?= $row->id % 63 ?>.png'
            });

            var destination_<?= $row->id ?> = new google.maps.LatLng(<?= $row->latitude ?>, <?= $row->longitude ?>);
            var bounds_<?= $row->id ?> = new google.maps.LatLngBounds();
            bounds_<?= $row->id ?>.extend(bengkulu);
            bounds_<?= $row->id ?>.extend(destination_<?= $row->id ?>);
            map.fitBounds(bounds_<?= $row->id ?>);
            var request_<?= $row->id ?> = {
                origin: bengkulu,
                destination: destination_<?= $row->id ?>,
                travelMode: google.maps.TravelMode.DRIVING
            };

            var directionDisplay_<?= $row->id ?> = new google.maps.DirectionsRenderer({
                suppressMarkers: true
            });

            directionService.route(request_<?= $row->id ?>, function(response, status) {
                if (status == google.maps.DirectionsStatus.OK) {
                    directionDisplay_<?= $row->id ?>.setDirections(response);
                    directionDisplay_<?= $row->id ?>.setMap(map);
                    $( '#jarak-wrapper' ).append('<tr>' + 
                        '<td><img src="http://maps.google.com/mapfiles/kml/pal2/icon<?= $row->id % 63 ?>.png"></td>' +
                        '<td onclick="mapFocus(\'<?= $row->latitude ?>\', \'<?= $row->longitude ?>\')"><?= $row->namobj ?></td>' +
                        '<td>' + (response.routes[0].legs[0].distance.value / 1000).toString().replace( '.', ',' ) + ' km</td>' +
                        '<td><?= $row->nama_kabupaten ?></td>' +
                        '<td><?= 'Rp ' . number_format($row->biaya, 0, ',', '.') ?></td>' +
                    '</tr>');

                    var infoWindow_<?= $row->id ?> = new google.maps.InfoWindow({
                        content: '<div id="content">'+
                            '<div class="row">' +
                                '<div class="col-md-4">' +
                                    '<center>' +
                                        '<img class="img-thumbnail" width="100" height="100" src="<?= base_url('img/' . $row->id . '.jpg') ?>" />'+
                                    '</center>' +
                                '</div>' +
                                '<div class="col-md-8">' +
                                    '<table class="table table-bordered">' +
                                        '<tr>' +
                                            '<td><strong>Nama Proyek</strong></td>' +
                                            '<td><?= $row->namobj ?></td>' +
                                        '</tr>' +
                                        '<tr>' +
                                            '<td><strong>Jarak</strong></td>' +
                                            '<td>' + (response.routes[0].legs[0].distance.value / 1000).toString().replace( '.', ',' ) + 'km</td>' +
                                        '</tr>' +
                                        '<tr>' +
                                            '<td><strong>Tahun</strong></td>' +
                                            '<td><?= $row->thn_data ?></td>' +
                                        '</tr>' +
                                        '<tr>' +
                                            '<td><strong>Kabupaten</strong></td>' +
                                            '<td><?= $row->nama_kabupaten ?></td>' +
                                        '</tr>' +
                                        '<tr>' +
                                            '<td><strong>Dana</strong></td>' +
                                            '<td><?= 'Rp ' . number_format($row->biaya, 0, ',', '.') ?></td>' +
                                        '</tr>' +
                                        '<tr>' +
                                            '<td><strong>Akan selesai dalam</strong></td>' +
                                            '<td><?php $waktu = explode(" ", $row->tanggal_selesai);if ( count( $waktu ) > 1 ) {$selesai = new DateTime($waktu[0]);$sekarang = new DateTime(date('Y-m-d'));if ( $sekarang > $selesai ) {echo '0';} else {echo $selesai->diff( $sekarang )->format( '%m bulan' );}}?></td>' +
                                        '</tr>' +
                                    '</table>' +
                                    '<div class="progress">' +
                                        '<div class="progress-bar" role="progressbar" aria-valuenow="<?= $row->persentase_penyelesaian ?>" aria-valuemin="0" aria-valuemax="100" style="width:<?= $row->persentase_penyelesaian ?>%">' +
                                            '<?= $row->persentase_penyelesaian ?>%' +
                                        '</div>' +
                                    '</div>' +
                                '</div>' +
                            '</div>' +
                        '</div>'
                    });
                    
                    marker_<?= $row->id ?>.addListener('mouseover', function(event) {
                        infoWindow_<?= $row->id ?>.open(map, this);
                    });
                    marker_<?= $row->id ?>.addListener('mouseout', function(event) {
                        infoWindow_<?= $row->id ?>.close();
                    });
                }
            });
        <?php endforeach; ?>

        google.maps.event.addListener(map, 'mousemove', function(event){
            map.setOptions({draggableCursor: 'pointer'});
        });

        google.maps.event.addListener(map, 'mouseover', function(event) {

        });
    }

    function mapFocus( lat, lng ) {

        map.setCenter( new google.maps.LatLng(lat, lng) );

    }

    function saveReport() {
        //get transform value
        var transform=$("#map").css("transform")
        var comp=transform.split(",") //split up the transform matrix
        var mapleft=parseFloat(comp[4]) //get left value
        var maptop=parseFloat(comp[5])  //get top value
        $("#map").css({ //get the map container. not sure if stable
          "transform":"none",
          "left":mapleft,
          "top":maptop,
        })
        $( '#btn-container' ).html('');
        html2canvas(document.getElementById( 'laporan' ), {
            useCORS: true,
            onrendered: function( canvas ) {

                var imgData = canvas.toDataURL( 'image/png' );
                var doc = new jsPDF( 'p', 'mm' );
                doc.addImage( imgData, 'PNG', 3, 3 );
                doc.save( 'laporan-proyek.pdf' );
                $( '#btn-container' ).html( '<button id="download-btn" class="btn btn-primary btn-sm" onclick="saveReport();" type="button"><i class="fa fa-download"></i> Download Laporan</button>' );

            }
        });

    }
</script>
<!-- Core  -->
  <script src="<?= base_url('assets') ?>/vendor/bootstrap/bootstrap.js"></script>
  <script src="<?= base_url('assets') ?>/vendor/animsition/jquery.animsition.js"></script>
  <script src="<?= base_url('assets') ?>/vendor/asscroll/jquery-asScroll.js"></script>


</body>
</html>