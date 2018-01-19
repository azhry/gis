  <script src="http://maps.google.com/maps/api/js?sensor=false"></script>


  <!-- Footer -->
  <footer class="site-footer">
    <span class="site-footer-legal">© 2015 Remark</span>
    <div class="site-footer-right">
      Crafted with <i class="red-600 wb wb-heart"></i> by <a href="http://themeforest.net/user/amazingSurge">amazingSurge</a>
    </div>
  </footer>

  <!-- Core  -->
  <script src="<?= base_url('assets') ?>/vendor/jquery/jquery.js"></script>
  <script src="<?= base_url('assets') ?>/vendor/bootstrap/bootstrap.js"></script>
  <script src="<?= base_url('assets') ?>/vendor/animsition/jquery.animsition.js"></script>
  <script src="<?= base_url('assets') ?>/vendor/asscroll/jquery-asScroll.js"></script>
  <script src="<?= base_url('assets') ?>/vendor/mousewheel/jquery.mousewheel.js"></script>
  <script src="<?= base_url('assets') ?>/vendor/asscrollable/jquery.asScrollable.all.js"></script>
  <script src="<?= base_url('assets') ?>/vendor/ashoverscroll/jquery-asHoverScroll.js"></script>

  <!-- Plugins -->
  <script src="<?= base_url('assets') ?>/vendor/switchery/switchery.min.js"></script>
  <script src="<?= base_url('assets') ?>/vendor/intro-js/intro.js"></script>
  <script src="<?= base_url('assets') ?>/vendor/screenfull/screenfull.js"></script>
  <script src="<?= base_url('assets') ?>/vendor/slidepanel/jquery-slidePanel.js"></script>

  <script src="<?= base_url('assets') ?>/vendor/chartist-js/chartist.min.js"></script>
  <script src="<?= base_url('assets') ?>/vendor/aspieprogress/jquery-asPieProgress.min.js"></script>
  <script src="<?= base_url('assets') ?>/vendor/gmaps/gmaps.js"></script>
  <script src="<?= base_url('assets') ?>/vendor/matchheight/jquery.matchHeight-min.js"></script>

  <!-- Scripts -->
  <script src="<?= base_url('assets') ?>/js/core.js"></script>
  <script src="<?= base_url('assets') ?>/js/site.js"></script>

  <script src="<?= base_url('assets') ?>/js/sections/menu.js"></script>
  <script src="<?= base_url('assets') ?>/js/sections/menubar.js"></script>
  <script src="<?= base_url('assets') ?>/js/sections/sidebar.js"></script>

  <script src="<?= base_url('assets') ?>/js/configs/config-colors.js"></script>
  <script src="<?= base_url('assets') ?>/js/configs/config-tour.js"></script>

  <script src="<?= base_url('assets') ?>/js/components/asscrollable.js"></script>
  <script src="<?= base_url('assets') ?>/js/components/animsition.js"></script>
  <script src="<?= base_url('assets') ?>/js/components/slidepanel.js"></script>
  <script src="<?= base_url('assets') ?>/js/components/switchery.js"></script>
  <script src="<?= base_url('assets') ?>/js/components/gmaps.js"></script>
  <script src="<?= base_url('assets') ?>/js/components/matchheight.js"></script>

  <script>
    $(document).ready(function($) {

      Site.run();

      // widget-linearea
      (function() {
        var linearea = new Chartist.Line('#widgetLinearea .ct-chart', {
          labels: ['SUN', 'MON', 'TUE', 'WED', 'THU', 'FRI', 'SAT'],
          series: [
            [0, 2.5, 2, 2.8, 2.6, 3.8, 0],
            [0, 1.4, 0.5, 2, 1.2, 0.9, 0]
          ]
        }, {
          low: 0,
          showArea: true,
          showPoint: false,
          showLine: false,
          fullWidth: true,
          chartPadding: {
            top: 0,
            right: 10,
            bottom: 0,
            left: 0
          },
          axisX: {
            showGrid: false,
            labelOffset: {
              x: -14,
              y: 0
            },
          },
          axisY: {
            labelOffset: {
              x: -10,
              y: 0
            },
            labelInterpolationFnc: function(num) {
              return num % 1 === 0 ? num : false;
            }
          }
        });
      })();

      //widget-pie-progress
      (function() {
        $("#widgetPieProgress .pieProgress-one").asPieProgress({
          namespace: 'pie-progress',
          barcolor: $.colors("primary", 600),
          trackcolor: $.colors("blue-grey", 100),
        });

        $("#widgetPieProgress .pieProgress-two").asPieProgress({
          namespace: 'pie-progress',
          barcolor: $.colors("cyan", 600),
          trackcolor: $.colors("blue-grey", 100),
        });

        $("#widgetPieProgress .pieProgress-three").asPieProgress({
          namespace: 'pie-progress',
          barcolor: $.colors("purple", 600),
          trackcolor: $.colors("blue-grey", 100),
        });
      })();

      // widget bar
      (function() {
        var bar = new Chartist.Bar('#widgetBar .ct-chart', {
          labels: ['A', 'B', 'C', 'D', 'E', 'F', 'G', 'H', 'I'],
          series: [
            [160, 200, 150, 400, 460, 440, 240, 250, 50],
            [600 - 160, 600 - 200, 600 - 150, 600 - 400, 600 -
              460, 600 - 440, 600 - 240, 600 - 250, 600 - 50
            ]
          ]
        }, {
          stackBars: true,
          fullWidth: true,
          seriesBarDistance: 0,
          axisX: {
            showGrid: false,
          },
          axisY: {
            showGrid: false,
            labelInterpolationFnc: function(num) {
              return num / 200 % 1 === 0 ? num : false;
            }
          }
        });
      })();

      // widget gmap
      (function() {
        var map = new GMaps({
          el: '#gmap',
          lat: -12.043333,
          lng: -77.028333,
          zoomControl: true,
          zoomControlOpt: {
            style: "SMALL",
            position: "TOP_LEFT"
          },
          panControl: true,
          streetViewControl: false,
          mapTypeControl: false,
          overviewMapControl: false
        });

        map.addStyle({
          styledMapName: "Styled Map",
          styles: $.components.get('gmaps', 'styles'),
          mapTypeId: "map_style"
        });

        map.setStyle("map_style");
      })();
    });
  </script>

</body>

</html>