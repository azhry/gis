
  <div class="page animsition">
    <div class="page-header">
      <h1 class="page-title">Dashboard</h1>
      <ol class="breadcrumb"><!-- 
        <li><a href="../index.html">Home</a></li>
        <li class="active">Structure</li> -->
      </ol>
    </div>

    <div class="page-content">
      <div class="panel">
        <div class="panel-body container-fluid">
         <div class="row row-lg">
              <div class="col-sm-12">
                <!-- Example Styles -->
                <div class="example-wrap"><!-- 
                  <h4 class="example-title">Styles</h4>
                  <p>Use any of the available blockquote classes to quickly create a
                    styled button.</p> -->
                    <div class="row row-lg">
                        <div class="col-md-3">
                            <center>
                                <img src="<?= base_url( 'img/logo2.jpg' ) ?>" width="150" height="100">
                            </center>
                        </div>
                        <div class="col-md-6">
                            <h3 class="text-center">
                               Jendral Cipta Karya Satuan Kerja Pengendalian dan Program Infrastruktur  Permukiman Rakyat Provinsi Bengkulu
                            </h3>
                            <h3 class="text-center"></h3>
                        </div>
                        <div class="col-md-3">
                            <!-- <center>
                                <img src="<?= base_url( 'img/logo.jpg' ) ?>" width="100" height="100">
                            </center> -->
                        </div>
                    </div>
                  <div class="row row-lg">
                    <div class="col-sm-3">
                      <div class="example">
                        <blockquote class="blockquote blockquote-success">
                          <a href="<?= base_url('admin/proyek') ?>"> 
                            <div class="row">
                                <div class="col-xs-3">
                                    <i class="fa fa-book fa-5x" style="font-size: 50px;"></i>
                                </div>
                                <div class="col-xs-9 text-right" style="color: black;">
                                    <div class="huge"><?= count($proyek) ?></div>
                                    <div>Proyek</div>
                                </div>
                            </div>
                          </a>
                        </blockquote>
                      </div>
                    </div>

                    <div class="col-sm-3">
                      <div class="example">
                        <blockquote class="blockquote blockquote-warning">
                          <a href="<?= base_url('admin/peta-proyek') ?>"> 
                            <div class="row">
                                <div class="col-xs-3">
                                    <i class="fa fa-book fa-5x" style="font-size: 50px;"></i>
                                </div>
                                <div class="col-xs-9 text-right" style="color: black;">
                                    <div class="huge"><?= count($proyek) ?></div>
                                    <div>Peta Proyek</div>
                                </div>
                            </div>
                          </a>
                        </blockquote>
                      </div>
                    </div>

                    <!-- <div class="col-sm-3">
                      <div class="example">
                        <blockquote class="blockquote blockquote-danger">
                          <a href="<?= base_url('admin/provinsi') ?>"> 
                            <div class="row">
                                <div class="col-xs-3">
                                    <i class="fa fa-book fa-5x" style="font-size: 50px;"></i>
                                </div>
                                <div class="col-xs-9 text-right" style="color: black;">
                                    <div class="huge"><?= count($provinsi) ?></div>
                                    <div>Provinsi</div>
                                </div>
                            </div>
                          </a>
                        </blockquote>
                      </div>
                    </div> -->

                    <div class="col-sm-3">
                      <div class="example">
                        <blockquote class="blockquote blockquote-info">
                          <a href="<?= base_url('admin/kabupaten') ?>"> 
                            <div class="row">
                                <div class="col-xs-3">
                                    <i class="fa fa-book fa-5x" style="font-size: 50px;"></i>
                                </div>
                                <div class="col-xs-9 text-right" style="color: black;">
                                    <div class="huge"><?= count($kabupaten) ?></div>
                                    <div>Kabupaten</div>
                                </div>
                            </div>
                          </a>
                        </blockquote>
                      </div>
                    </div>

                    <div class="col-sm-3">
                      <div class="example">
                        <blockquote class="blockquote blockquote-default">
                          <a href="<?= base_url('admin/pegawai') ?>"> 
                            <div class="row">
                                <div class="col-xs-3">
                                    <i class="fa fa-users fa-5x" style="font-size: 50px;"></i>
                                </div>
                                <div class="col-xs-9 text-right" style="color: black;">
                                    <div class="huge"><?= count($pegawai) ?></div>
                                    <div>Pegawai</div>
                                </div>
                            </div>
                          </a>
                        </blockquote>
                      </div>
                    </div>


                  </div> 
                </div>
                <!-- End Example Styles -->
              </div>
            </div>
          </div>
        </div>
      </div>
  </div>