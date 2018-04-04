<!-- Page -->
<div class="page animsition">
    <div class="page-header">
        <h3 class="page-title">Grafik Proyek</h3>
        <ol class="breadcrumb">
            <li><a href="<?= base_url('kepala_satuan_kerja') ?>">Dashboard</a></li>
            <li class="active">Grafik Proyek</li>
        </ol>
    </div>
    <div class="page-content">
        <!-- Panel Basic -->
        <div class="panel">
            <header class="panel-heading">
                <div class="panel-actions"></div>
                <h3 class="panel-title">Grafik Progress Proyek</h3>
                <button onclick="downloadPDF();" id="unduh-laporan" type="button" class="btn btn-primary"><i class="fa fa-download"></i> Unduh Grafik Laporan</button>
            </header>
            <div class="panel-body">
            	<div class="row">
            		<div class="col-md-4">
            			<br>
            			<?php foreach ( $kabupaten as $row ): ?>
            				<button onclick="get_proyek_by_kabupaten('<?= $row->id_kabupaten ?>');" style="width: 100%;" class="btn btn-success" type="button"><?= $row->nama ?></button><br>
            			<?php endforeach; ?>
            		</div>
            		<div class="col-md-8">
	                    <canvas id="laporan-keseluruhan-proyek" width="800" height="450"></canvas>
	                </div>
            	</div>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript" src="<?= base_url('assets/js/plugins/Chart.min.js') ?>"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/1.3.5/jspdf.debug.js"></script>
<script type="text/javascript" src="<?= base_url( 'assets/js/html2canvas.js' ) ?>"></script>

<script type="text/javascript">
	
	
	function getRandom(max) {
	  	return Math.random() * Math.floor(max);
	}

	function downloadPDF() {
		html2canvas(document.getElementById("laporan-keseluruhan-proyek"), {
            useCORS: true,
            onrendered: function( canvas ) {

                var imgData = canvas.toDataURL( 'image/png' );
                var doc = new jsPDF( 'p', 'mm' );
                doc.addImage( imgData, 'PNG', 3, 3 );
                doc.save( 'laporan-jumlah-proyek.pdf' );

            }
        });
	}

	function get_proyek_by_kabupaten( id_kabupaten ) {

		$.ajax({
			url: '<?= base_url( 'kepala_satuan_kerja/grafik_proyek' ) ?>',
			type: 'POST',
			data: {
				get: true,
				id_kabupaten: id_kabupaten
			},
			beforeSend: function() {

			},
			success: function( response ) {

				var json = $.parseJSON( response );

				var labels 	= [ 'Periode 1', 'Periode 2', 'Periode 3', 'Periode 4' ];

				var datasets = [];
				for ( var i = 0; i < json.main.length; i++ ) {

					var data 	= [];
					var current_progress = 0;
					for ( var j = 0; j < 4; j++ ) {

						var progress = json.main[i].progress[j];
						current_progress += Number(progress != undefined ? progress.progress : 0);
						data.push( progress != undefined ? current_progress : 0 );

					}

					datasets.push({
						label: json.main[i].proyek.namobj,
						backgroundColor: 'rgba(' + Math.floor(getRandom( 255 )) + ',' + Math.floor(getRandom( 255 )) + ',' + Math.floor(getRandom( 255 )) + ',0.5)',
						borderColor: "rgba(" + Math.floor(getRandom( 255 )) + "," + Math.floor(getRandom( 255 )) + ", " + Math.floor(getRandom( 255 )) + ",0.8)",
				        pointBackgroundColor: "rgba(26,179,148,0.5)",
				        pointBorderColor: "rgba(26,179,148,0.8)",
				        data: data	
					});

				}

				var ctx = new Chart(document.getElementById("laporan-keseluruhan-proyek"), {
				    type: 'bar',
				    data: {
				      labels: labels,
				      datasets: datasets
				    },
				    options: {
				      legend: { display: false },
				      title: {
				        display: true,
				        text: 'Grafik Progress Proyek Per Kabupaten'
				      },
				      scales: {
				      	yAxes: [{
				      		ticks: {
				      			min: 0,
				      			max: 100,
				      			stepSize: 10
				      		}
				      	}]
				      }
				    }
				});

			},
			error: function( err ) { console.log( err.responseText ) }
		});

	}

	<?php if ( count( $kabupaten ) > 0 ): ?>
		get_proyek_by_kabupaten('<?= $kabupaten[0]->id_kabupaten ?>');                	
	<?php endif; ?>
</script>