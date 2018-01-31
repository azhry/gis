<div class="site-menubar">
    <div class="site-menubar-body">
      <div>
        <div>
          <ul class="site-menu">
            <li class="site-menu-item has-sub active open">
              <a href="<?= base_url('admin') ?>" onclick="dashboard()" data-slug="dashboard">
                <i class="site-menu-icon wb-dashboard" aria-hidden="true"></i>
                <span class="site-menu-title">Dashboard</span>
              </a>
            </li>
            <li class="site-menu-item has-sub">
              <a href="<?= base_url('admin/kota') ?>" onclick="kota()" data-slug="dashboard">
                <i class="site-menu-icon fa fa-book" aria-hidden="true"></i>
                <span class="site-menu-title">Kota</span>
              </a>
            </li>
          </ul>
        </div>
      </div>
    </div>
  </div>

  <script type="text/javascript">
    function dashboard(){
      window.location = '<?= base_url('admin') ?>';
    }
    function kota(){
      window.location = '<?= base_url('admin/kota') ?>';
    }
  </script>