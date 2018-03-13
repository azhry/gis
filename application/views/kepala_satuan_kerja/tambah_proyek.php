<!-- Page -->
<div class="page animsition">
    <div class="page-header">
        <h3 class="page-title">Tambah Data Proyek <button class="btn btn-success btn-sm" data-toggle="modal" data-target="#add"><i class="fa fa-plus"></i></button></h3>
        <ol class="breadcrumb">
            <li><a href="<?= base_url('kepala_satuan_kerja') ?>">Dashboard</a></li>
            <li><a href="<?= base_url('kepala_satuan_kerja/proyek') ?>">Data Proyek</a></li>
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
                        <?= form_open_multipart( 'kepala_satuan_kerja/tambah-proyek' ) ?>
                            <div class="form-group">
                                <label for="Namobj">Namobj<span class="required">*</span></label>
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
                                <label for="id_provinsi">Provinsi<span class="required">*</span></label>
                                <select class="form-control" name="id_provinsi" required>
                                    <option>Pilih Provinsi</option>
                                    <?php foreach ($provinsi as $row): ?>
                                    <option value="<?= $row->id_provinsi ?>"><?= $row->nama ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="id_kabupaten">Kabupaten<span class="required">*</span></label>
                                <select class="form-control" name="id_kabupaten" required>
                                    <option>Pilih Kabupaten</option>
                                    <?php foreach ($kabupaten as $row): ?>
                                    <option value="<?= $row->id_kabupaten ?>"><?= $row->nama ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="Vol">Vol<span class="required">*</span></label>
                                <input type="text" class="form-control" name="vol" required>
                            </div>
                            <div class="form-group">
                                <label for="Biaya">Biaya<span class="required">*</span></label>
                                <input type="text" class="form-control" name="biaya" required>
                            </div>
                            <div class="form-group">
                                <label>Koordinat Lokasi Proyek</label><br>
                                Latitude: <input class="form-control" type="text" id="map-add-hidden_latitude" name="latitude" required><br>
                                Longitude: <input class="form-control" type="text" id="map-add-hidden_longitude" name="longitude" required>
                            </div>
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

<script type="text/javascript">
    $( document ).ready(function() {
        initMap( 'map-add' );
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
        $('#' + id + '-hidden_latitude').val(event.latLng.lat());
        $('#' + id + '-hidden_longitude').val(event.latLng.lng());

        });
        google.maps.event.addListener(map, 'mousemove', function(event){
            map.setOptions({draggableCursor: 'pointer'});
        });
    }
</script>