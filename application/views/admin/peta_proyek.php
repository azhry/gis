<!-- Page -->
<div class="page animsition">
    <div class="page-header">
        <h3 class="page-title">Peta Proyek</h3>
        <ol class="breadcrumb">
            <li><a href="<?= base_url('admin') ?>">Dashboard</a></li>
            <li class="active">Peta Proyek</li>
        </ol>
    </div>
    <div class="page-content">
        <!-- Panel Basic -->
        <div class="panel">
            <header class="panel-heading">
                <div class="panel-actions"></div>
                <h3 class="panel-title">Peta Proyek</h3>
            </header>
            <div class="panel-body">
                <div id="map" style="width: 100%; height: 600px;"></div>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">
    $(document).ready(function() {
        initMap();
    });

    function initMap() {
        var coordinate = {lat: -6.121435, lng: 106.774124};
        var map = new google.maps.Map(document.getElementById('map'), {
            zoom: 8,
            center: coordinate
        });

        <?php foreach ($proyek as $row): ?>
            var marker_<?= $row->id ?> = new google.maps.Marker({
                position: {lat: <?= $row->latitude ?>, lng: <?= $row->longitude ?>},
                map: map
            });
            var infoWindow_<?= $row->id ?> = new google.maps.InfoWindow({
                content: '<div id="content">'+
                    '<div id="siteNotice">'+
                    '</div>'+
                    '<h5 id="firstHeading" class="firstHeading"><?= $row->kl_dat_das ?></h5>'+
                    '<div id="bodyContent">'+
                    '<p><?= $row->namobj ?></p>'+
                    '<img width="100" height="100" src="<?= base_url('img/' . $row->id . '.jpg') ?>" />'+
                    '</div>'+
                    '</div>'
            });
            
            marker_<?= $row->id ?>.addListener('mouseover', function(event) {
                infoWindow_<?= $row->id ?>.open(map, this);
            });
            marker_<?= $row->id ?>.addListener('mouseout', function(event) {
                infoWindow_<?= $row->id ?>.close();
            });
        <?php endforeach; ?>

        google.maps.event.addListener(map, 'mousemove', function(event){
            map.setOptions({draggableCursor: 'pointer'});
        });

        google.maps.event.addListener(map, 'mouseover', function(event) {

        });
    }
</script>