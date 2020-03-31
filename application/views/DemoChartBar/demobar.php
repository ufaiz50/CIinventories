<?php
$koneksi     = mysqli_connect("localhost", "root", "", "ci_barang");
$penjualan      = mysqli_query($koneksi, "SELECT SUM(jumlah_keluar) as jumlah_keluar FROM barang_keluar GROUP BY barang_id");
$jenis = mysqli_query($koneksi, "SELECT * FROM barang");
 ?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>Demo Grafik Batang</title>
    <script src="js/Chart.js"></script>
    <style type="text/css">
            .container {
                width: 50%;
                margin: 15px auto;
            }
    </style>
  </head>
  <body>

<div class="col-xl-12 col-lg-12">
    <div class="card shadow mb-4">
            <!-- Card Header - Dropdown -->
        <div class="card-header bg-primary py-3 d-flex flex-row align-items-center justify-content-between">
        <h6 class="m-0 font-weight-bold text-white">penjualan setiap barang pada bulan <?= date('M'); ?></h6>
        </div>
        <div class="card-body">
            <div class="chart-bar">
                <div class="chartjs-size-monitor">
                    <div class="chartjs-size-monitor-expand">
                        <div class=""></div>
                    </div>
                        <div class="chartjs-size-monitor-shrink">
                            <div class=""></div>
                    </div>
                </div>
                    <canvas id="demobar" width="669" height="320" class="chartjs-render-monitor" style="display: block; width: 669px; height: 320px;"></canvas>
            </div>
        </div>
    </div>
</div>

      	<script  type="text/javascript">

    	  var ctx = document.getElementById("demobar").getContext("2d");
    	  var data = {
    	            labels: [<?php while ($p = mysqli_fetch_array($jenis)) { echo '"' . $p['nama_barang'] . '",';}?>],
    	            datasets: [
    	            {
    	              label: "Penjualan Smartphone",
    	              data: [<?php while ($p = mysqli_fetch_array($penjualan)) { echo '"' . $p['jumlah_keluar'] . '",';}?>],
                    backgroundColor: [
                      "rgba(59, 100, 222, 1)",
                      "rgba(203, 222, 225, 0.9)",
                      "rgba(102, 50, 179, 1)",
                      "rgba(201, 29, 29, 1)",
                      "rgba(81, 230, 153, 1)",
                      "rgba(246, 34, 19, 1)"]
    	            }
    	            ]
    	            };

    	  var myBarChart = new Chart(ctx, {
    	            type: 'bar',
    	            data: data,
    	            options: {
    	            barValueSpacing: 20,
    	            scales: {
    	              yAxes: [{
    	                  ticks: {
    	                      min: 0,
    	                  }
    	              }],
    	              xAxes: [{
    	                          gridLines: {
    	                              color: "rgba(0, 0, 0, 0)",
    	                          }
    	                      }]
    	              }
    	          }
    	        });
    	</script>

  </body>
</html>
