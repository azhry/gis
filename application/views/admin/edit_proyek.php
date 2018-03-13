<link rel="stylesheet" type="text/css" href="<?= base_url( 'assets/vendor/bootstrap-datepicker/bootstrap-datepicker.min.css' ) ?>">

<!-- Page -->
<div class="page animsition">
    <div class="page-header">
        <h3 class="page-title">Edit Data Proyek</h3>
        <ol class="breadcrumb">
            <li><a href="<?= base_url('admin') ?>">Dashboard</a></li>
            <li><a href="<?= base_url('admin/proyek') ?>">Data Proyek</a></li>
            <li class="active">Edit Data Proyek</li>
        </ol>
    </div>
    <div class="page-content">
        <!-- Panel Basic -->
        <div class="panel">
            <header class="panel-heading">
                <div class="panel-actions"></div>
                <h3 class="panel-title">Tambah Data Proyek</h3>
            </header>
            <div class="panel-body">
                <div>
                    <?= $this->session->flashdata('msg') ?>
                </div>
                <div class="row">
                    <div class="col-md-4">
                        <?= form_open_multipart( 'admin/edit-proyek/' . $id_data ) ?>
                            <div class="form-group">
                                <label for="Namobj">Nama Proyek<span class="required">*</span></label>
                                <input type="text" class="form-control" value="<?= $proyek->namobj ?>" name="namobj" required>
                            </div>
                            <!-- <div class="form-group">
                                <label for="Kl_dat_das">Kl_dat_das<span class="required">*</span></label>
                                <input type="text" class="form-control" value="<?= $proyek->kl_dat_das ?>" name="kl_dat_das" required>
                            </div> -->
                            <div class="form-group">
                                <label for="thn_data">Tahun Data<span class="required">*</span></label>
                                <input type="number" class="form-control" value="<?= $proyek->thn_data ?>" name="thn_data" required>
                            </div>
                            <div class="form-group">
                                <label for="id_kabupaten">Kabupaten<span class="required">*</span></label>
                                <?php $data_kabupaten = []; foreach ($kabupaten as $row): ?>
                                    <?php $data_kabupaten[$row->id_kabupaten] = $row->nama; ?>
                                <?php endforeach; ?>
                                <?= form_dropdown( 'id_kabupaten', $data_kabupaten, $proyek->id_kabupaten, [ 'class' => 'form-control', 'name' => 'id_kabupaten', 'id' => 'id_kabupaten' ] ) ?>
                            </div>
                            <div class="form-group">
                                <label for="id_kecamatan">Kecamatan<span class="required">*</span></label>
                                <?php $data_kecamatan = []; foreach ($kecamatan as $row): ?>
                                    <?php $data_kecamatan[$row->id_kecamatan] = $row->nama; ?>
                                <?php endforeach; ?>
                                <?= form_dropdown( 'id_kecamatan', $data_kecamatan, $proyek->id_kecamatan, [ 'class' => 'form-control', 'name' => 'id_kecamatan', 'id' => 'id_kecamatan' ] ) ?>
                            </div>
                            <div class="form-group">
                                <label for="Vol">Vol<span class="required">*</span></label>
                                <input type="text" class="form-control" name="vol" value="<?= $proyek->vol ?>" required>
                            </div>
                            <div class="form-group">
                                <label for="Biaya">Anggaran<span class="required">*</span></label>
                                <input type="text" class="form-control" value="<?= $proyek->anggaran ?>" name="anggaran" required>
                            </div>
                            <div class="form-group">
                                <label>Koordinat Lokasi Proyek</label><br>
                                Latitude: <input class="form-control" type="text" id="map-add-hidden_latitude" name="latitude" value="<?= $proyek->latitude ?>" required><br>
                                Longitude: <input class="form-control" type="text" id="map-add-hidden_longitude" value="<?= $proyek->longitude ?>" name="longitude" required>
                            </div>
                            <div class="form-group">
                                <?php $waktu = explode(' ', $proyek->tanggal_mulai); ?>
                                <label for="tanggal_selesai">Tanggal Mulai</label>
                                <input data-plugin="datepicker" value="<?= count($waktu) > 1 ? $waktu[0] : '-'  ?>" type="text" class="datepicker form-control" required name="tanggal_mulai">
                            </div>
                            <div class="form-group">
                                <?php $waktu = explode(' ', $proyek->tanggal_selesai); ?>
                                <label for="tanggal_selesai">Tanggal Selesai</label>
                                <input data-plugin="datepicker" value="<?= count($waktu) > 1 ? $waktu[0] : '-'  ?>" type="text" class="datepicker form-control" required name="tanggal_selesai">
                            </div>
                            <!-- <div id="img-placeholder">
                                <img src="<?= base_url( 'img/' . $proyek->id . '.jpg' ) ?>" onerror="this.src = '<?= base_url('img/150x150.png') ?>'" width="150" height="150">
                            </div> -->
                            <!-- <div class="form-group">
                                <label for="foto">Upload Foto Proyek<span class="required">*</span></label>
                                <input type="file" name="foto">
                            </div> -->
                            <input type="submit" value="Submit" name="submit" class="btn btn-primary">
                        <?= form_close() ?>
                    </div>
                    <div class="col-md-8">
                        <div class="gmap" id="map-add" style="width: 100%; height: 750px;"></div>
                    </div>
                </div>
            </div>
        </div>
        <!-- End Panel Basic -->
    </div>
</div>
<!-- End Page -->

<script type="text/javascript" src="<?= base_url( 'assets/vendor/bootstrap-datepicker/bootstrap-datepicker.min.js' ) ?>"></script>
<script type="text/javascript">
    var coordinate = {lat: <?= $proyek->latitude ?>, lng: <?= $proyek->longitude ?>};
    var map = new google.maps.Map(document.getElementById('map-add'), {
        zoom: 8,
        center: coordinate
    });
    var marker = new google.maps.Marker({
        position: coordinate,
        map: map
    });

    $( document ).ready(function() {
        $('.datepicker').datepicker({
            format: 'yyyy-mm-dd'
        });
        initMap( 'map-add' );

        $( '#map-add-hidden_latitude, #map-add-hidden_longitude' ).keypress(function() {
            var lat = $( '#map-add-hidden_latitude' ).val();
            var lng = $( '#map-add-hidden_longitude' ).val();

            var latLng = new google.maps.LatLng( lat, lng );
            marker.setPosition( latLng );
            map.setCenter( latLng );
        });

        $( '#id_kabupaten' ).on('change', function() {
            $.ajax({
                url: '<?= base_url( 'admin/tambah-proyek?id_kabupaten=' ) ?>' + $( this ).val(),
                type: 'GET',
                success: function( response ) {
                    var json = $.parseJSON( response );
                    var html = '<option>Pilih Kecamatan</option>';
                    for ( var i = 0; i < json.length; i++ ) {
                        html += '<option value="' + json[i].id_kecamatan + '">' + json[i].nama + '</option>';
                    }
                    $( '#id_kecamatan' ).html( html );
                }
            });
        });
    });

    function initMap(id) {
        $('#' + id + '-latitude').text('');
        $('#' + id + '-longitude').text('');
        $('#' + id + '-hidden_latitude').val(<?= $proyek->latitude ?>);
        $('#' + id + '-hidden_longitude').val(<?= $proyek->longitude ?>);
        
        google.maps.event.addListener(map, 'click', function(event){
            var latLng = new google.maps.LatLng(event.latLng.lat(), event.latLng.lng());
            marker.setPosition(latLng);
            $('#' + id + '-hidden_latitude').val(event.latLng.lat());
            $('#' + id + '-hidden_longitude').val(event.latLng.lng());

        });
        google.maps.event.addListener(map, 'mousemove', function(event){
            map.setOptions({draggableCursor: 'pointer'});
        });
    }
</script>