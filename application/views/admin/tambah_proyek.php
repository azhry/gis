<link rel="stylesheet" type="text/css" href="<?= base_url( 'assets/vendor/bootstrap-datepicker/bootstrap-datepicker.min.css' ) ?>">

<!-- Page -->
<div class="page animsition">
    <div class="page-header">
        <h3 class="page-title">Tambah Data Proyek</h3>
        <ol class="breadcrumb">
            <li><a href="<?= base_url('admin') ?>">Dashboard</a></li>
            <li><a href="<?= base_url('admin/proyek') ?>">Data Proyek</a></li>
            <li class="active">Tambah Data Proyek</li>
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
                        <?= form_open_multipart( 'admin/tambah-proyek' ) ?>
                            <div class="form-group">
                                <label for="Namobj">Nama Proyek<span class="required">*</span></label>
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
                                <label for="id_kabupaten">Kabupaten<span class="required">*</span></label>
                                <select class="form-control" id="id_kabupaten" name="id_kabupaten" required>
                                    <option>Pilih Kabupaten</option>
                                    <?php foreach ($kabupaten as $row): ?>
                                    <option value="<?= $row->id_kabupaten ?>"><?= $row->nama ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="id_kecamatan">Kecamatan<span class="required">*</span></label>
                                <select class="form-control" id="id_kecamatan" name="id_kecamatan" required>
                                    <option>Pilih Kecamatan</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label>Koordinat Lokasi Proyek</label><br>
                                Latitude: <input step="any" class="form-control coord-input" type="number" id="map-add-hidden_latitude" name="latitude" required><br>
                                Longitude: <input step="any" class="form-control coord-input" type="number" id="map-add-hidden_longitude" name="longitude" required>
                            </div>
                            <div class="form-group">
                                <label for="Vol">Vol<span class="required">*</span></label>
                                <input type="text" class="form-control" name="vol" required>
                            </div>
                            <div class="form-group">
                                <label for="Biaya">Anggaran Biaya<span class="required">*</span></label>
                                <input type="text" class="form-control" name="anggaran" required>
                            </div>
                            <div class="form-group">
                                <label for="tanggal_selesai">Tanggal Mulai</label>
                                <input data-plugin="datepicker" type="text" class="datepicker form-control" required name="tanggal_mulai">
                            </div>
                            <div class="form-group">
                                <label for="tanggal_selesai">Tanggal Selesai</label>
                                <input data-plugin="datepicker" type="text" class="datepicker form-control" required name="tanggal_selesai">
                            </div>
                            <div class="form-group">
                                <label for="foto">Upload Foto Proyek<span class="required">*</span></label>
                                <input type="file" name="foto">
                            </div>
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
    var bengkulu = new google.maps.LatLng(-3.793703, 102.270013);
    var map = new google.maps.Map(document.getElementById( 'map-add' ), {
        zoom: 12,
        center: bengkulu
    });
    var marker = new google.maps.Marker({
        position: bengkulu,
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
        $('#' + id + '-hidden_latitude').val(null);
        $('#' + id + '-hidden_longitude').val(null);
        
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