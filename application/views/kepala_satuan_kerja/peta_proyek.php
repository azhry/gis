<!-- Page -->
<div class="page animsition">
    <div class="page-header">
        <h3 class="page-title">Peta Proyek</h3>
        <ol class="breadcrumb">
            <li><a href="<?= base_url('kepala_satuan_kerja') ?>">Dashboard</a></li>
            <li class="active">Peta Proyek</li>
        </ol>
    </div>
    <div class="page-content">
        <!-- Panel Basic -->
        <div class="panel">
            <header class="panel-heading">
                <div class="panel-actions"></div>
            </header>
            <div class="panel-body" id="laporan">
                <h4 class="text-center">Data Lokasi Proyek</h4>
                <div id="map" style="width: 100%; height: 600px;"></div>
                <br><br>
                <div class="row">
                    <div class="col-md-8">
                        <!-- <h4>Jarak lokasi proyek dari kota Bengkulu <span id="btn-container"><button id="download-btn" class="btn btn-primary btn-sm" onclick="saveReport();" type="button"><i class="fa fa-download"></i> Download Laporan</button></span></h4>
                        <table class="table table-bordered table-hover table-striped">
                            <thead>
                                <tr>
                                    <th>Nama Proyek</th>
                                    <th>Jarak</th>
                                    <th>Kabupaten</th>
                                    <th>Dana</th>
                                </tr>
                            </thead>
                            <tbody id="jarak-wrapper"></tbody>
                        </table> -->
                        <a href="<?= base_url( 'kepala-satuan-kerja/download-laporan-proyek' ) ?>" class="btn btn-info pull-right"><i class="fa fa-download"></i> Unduh laporan</a>
                    </div>
                    <div class="col-md-4">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>Icon</th>
                                    <th>Range Progress</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>
                                        <img src="http://maps.google.com/mapfiles/ms/icons/red-dot.png">
                                    </td>
                                    <td>0 - 35%</td>
                                </tr>
                                <tr>
                                    <td>
                                        <img src="http://maps.google.com/mapfiles/ms/icons/blue-dot.png">
                                    </td>
                                    <td>36 - 75%</td>
                                </tr>
                                <tr>
                                    <td>
                                        <img src="http://maps.google.com/mapfiles/ms/icons/green-dot.png">
                                    </td>
                                    <td>76 - 100%</td>
                                </tr>
                            </tbody>
                        </table>
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
            <?php $row = (object)$row; ?>

            var marker_<?= $row->id ?> = new google.maps.Marker({
                position: {lat: <?= $row->latitude ?>, lng: <?= $row->longitude ?>},
                map: map,
                <?php if ( $row->progress >= 0 && $row->progress <= 35 ): ?>
                icon: 'http://maps.google.com/mapfiles/ms/icons/red-dot.png'
                <?php elseif ( $row->progress > 35 && $row->progress <= 75 ): ?>
                icon: 'http://maps.google.com/mapfiles/ms/icons/blue-dot.png'
                <?php elseif ( $row->progress > 75 ): ?>
                icon: 'http://maps.google.com/mapfiles/ms/icons/green-dot.png'
                <?php endif; ?>
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

            <?php 
                // $progress = $this->progress_m->get_progress( $row->id ); ?>

            directionService.route(request_<?= $row->id ?>, function(response, status) {
                if (status == google.maps.DirectionsStatus.OK) {
                    directionDisplay_<?= $row->id ?>.setDirections(response);
                    directionDisplay_<?= $row->id ?>.setMap(map);
                    $( '#jarak-wrapper' ).append('<tr>' + 
                        // '<td><img src="http://maps.google.com/mapfiles/kml/pal2/icon<?= $row->id % 63 ?>.png"></td>' +
                        '<td onclick="mapFocus(\'<?= $row->latitude ?>\', \'<?= $row->longitude ?>\')"><?= '$row->namobj' ?></td>' +
                        '<td>' + (response.routes[0].legs[0].distance.value / 1000).toString().replace( '.', ',' ) + ' km</td>' +
                        '<td><?= '$row->nama_kabupaten' ?></td>' +
                        '<td><?= 'Rp ' . 'number_format($row->anggaran, 0, ',', '.')' ?></td>' +
                    '</tr>');

                    var infoWindow_<?= $row->id ?> = new google.maps.InfoWindow({
                        content: '<div id="content" style="height: 400px; overflow-y: scroll; width: 400px !important;">'+
                            '<div class="row">' +
                                '<div class="col-md-8">' +
                                    <?php foreach ( $row->proyek as $proyek ): ?>
                                    '<table class="table table-bordered">' +
                                        '<tr>' +
                                            '<td><strong>Nama Proyek</strong></td>' +
                                            '<td><?= $proyek->namobj ?></td>' +
                                        '</tr>' +
                                        // '<tr>' +
                                        //     '<td><strong>Jarak</strong></td>' +
                                        //     '<td>' + (response.routes[0].legs[0].distance.value / 1000).toString().replace( '.', ',' ) + 'km</td>' +
                                        // '</tr>' +
                                        '<tr>' +
                                            '<td><strong>Tahun</strong></td>' +
                                            '<td><?= $proyek->thn_data ?></td>' +
                                        '</tr>' +
                                        '<tr>' +
                                            '<td><strong>Kabupaten</strong></td>' +
                                            '<td><?= $proyek->nama_kabupaten ?></td>' +
                                        '</tr>' +
                                        '<tr>' +
                                            '<td><strong>Dana</strong></td>' +
                                            '<td><?= 'Rp ' . number_format($proyek->anggaran, 0, ',', '.') ?></td>' +
                                        '</tr>' +
                                        '<tr>' +
                                            '<td><strong>Akan selesai dalam</strong></td>' +
                                            '<td><?php $waktu = explode(" ", $proyek->tanggal_selesai);if ( count( $waktu ) > 1 ) {$selesai = new DateTime($waktu[0]);$sekarang = new DateTime(date('Y-m-d'));if ( $sekarang > $selesai ) {echo '0';} else {echo $selesai->diff( $sekarang )->format( '%m bulan' );}}?></td>' +
                                        '</tr>' +
                                    '</table>' +
                                    <?php endforeach; ?>
                                    '<div class="progress">' +
                                        '<div class="progress-bar" role="progressbar" aria-valuenow="<?= $row->progress ?>" aria-valuemin="0" aria-valuemax="100" style="width:<?= $row->progress ?>%">' +
                                            '<?= $row->progress ?>%' +
                                        '</div>' +
                                    '</div>' +
                                '</div>' +
                            '</div>' +
                        '</div>',
                        maxWidth: 600
                    });
                    
                    marker_<?= $row->id ?>.addListener('mouseover', function(event) {
                        infoWindow_<?= $row->id ?>.open(map, this);
                    });

                    marker_<?= $row->id ?>.addListener('click', function(event) {
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