  <!-- Page -->
  <div class="page animsition">
    <div class="page-header"><!-- 
      <h1 class="page-title">Data Kota</h1> -->
      <h3 class="page-title">Data Kota</h3>
      <ol class="breadcrumb">
        <li><a href="<?= base_url('admin') ?>">Dashborad</a></li>
        <li><a href="<?= base_url('admin/kota') ?>">Data Kota</a></li>
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
            <div id="map" style="width: 100%; height: 600px;"></div>
        </div>
      </div>
    </div>
  </div>

    <!-- page content -->
        <!-- <div class="right_col" role="main">
          <div class="">
            <div class="page-title">
              <div class="title_left">
                <h3 class="page-header">Detail Kota</h3>
              </div>
            </div>

            <div class="clearfix"></div>

            <div class="row">
              <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                  <div class="x_title">
                    <div>
                        <h2>Detail Kota</h2>
                    </div>
                    <ul class="nav navbar-right panel_toolbox">
                      <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                      </li>
                      <li><a class="close-link"><i class="fa fa-close"></i></a>
                      </li>
                    </ul>
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">
                    <?= $this->session->flashdata('msg') ?>
                    <div id="map" style="width: 100%; height: 600px;"></div>                            
                  </div>
                </div>
            </div>
        </div>
    </div>
  </div> -->

  <script type="text/javascript">
    $(document).ready(function() {
      initMap();
    });

    function initMap() {
      var coordinate = {lat: <?= $jalan->latitude ?>, lng: <?= $jalan->longitude ?>};
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
        '<h5 id="firstHeading" class="firstHeading"><?= $jalan->nama ?></h5>'+
        '<div id="bodyContent">'+
        '<p>Kecamatan: <?= $jalan->kecamatan ?><br>'+
        'Kelurahan: <?= $jalan->kelurahan ?><br>'+
        'Tipe: <?= $jalan->tipe ?><br>'+
        'Kondisi: <?= $jalan->kondisi ?>.</p>'+
        '<img width="100" height="100" src="<?= base_url('img/' . $jalan->id_data . '.jpg') ?>" />'+
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

            