<!DOCTYPE html>
<html>
<head>
	<title></title>
	<style type="text/css">
		#bigWrapper{
			width: 100%;
		}
		.header{
			text-align: center;
			font-size: 26px;
			margin-bottom: 50px;
			border-bottom: 5px double black;
			padding-bottom: 15px;
		}

		#logoo{
			margin-top: -200px;
			width: 130px;
			height: 200px;
			margin-left: 10px;
			margin-right: 60px;	
		}
		#logoo img{
			width: 130px;
			height: 80px;
		}
		.title{
			margin-left: 50px;
			margin-top: -190px;
		}
		.kontak{
			margin-top: 5px;
			font-size: 12px;
			text-align: center;
		}
		table,th,td{
			border: 1px solid black;
		}
		table {
		    border-collapse: collapse;
		}
		tr:nth-child(even) {
			background-color: #f2f2f2
		}
		tr:first-child{
			width: 40px;
		}
		th{
		    background-color: #4CAF50;
		    color: white;
			/*min-width: 100px;*/
		}
		td{
			padding: 2px;
			padding-left: 10px; 
			text-align: center;
		}
	</style>
</head>
<body>
	<div id="bigWrapper">
		<div class="content" style="margin: 0 auto; width:100%;">
			<p style="margin-top: -30px; width: 100%; font-weight: bold; font-size: 22px; text-align: center; margin-bottom: 30px;">Laporan Proyek</p>
			<table style="width: 100%;">
				<thead>
					<tr>
						<th>No.</th>
	                    <th>Nama Proyek</th>
                        <th>Kabupaten</th>
                        <th>Kecamatan</th>
                        <th>Anggaran</th>
                        <th>Tanggal Mulai</th>
                        <th>Tanggal Selesai</th>
                        <th>Koordinat</th>
	                </tr>
				</thead>
				<tbody>
					<?php $i = 0; foreach ($proyek as $row): ?>
						<tr>
							<td><?= ++$i ?></td>
							<td><?= $row->namobj ?></td>
                            <td><?= $row->nama_kabupaten ?></td>
                            <td><?= $row->nama_kecamatan ?></td>
                            <td><?= 'Rp ' . number_format($row->anggaran, 0, ',', '.') ?></td>
                            <td><?= $row->tanggal_mulai ?></td>
                            <td><?= $row->tanggal_selesai ?></td>
                            <td><?= $row->latitude . ', ' . $row->longitude ?></td>
						</tr>
					<?php endforeach; ?>
				</tbody>
			</table>
		</div>
	</div>
</body>
</html>