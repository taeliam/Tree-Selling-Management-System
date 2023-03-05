<?php


// for chart 
// day
$sql_day = "SELECT SUM(order_total) AS total,
			DATE_FORMAT(order_date,'%d-%M-%Y') AS order_date
			FROM db_order
			WHERE order_status IN (3,4)
			GROUP BY DATE_FORMAT(order_date,'%d')
			ORDER BY DATE_FORMAT(order_date,'%d-%M-%Y') DESC LIMIT 7";
$query_day = mysqli_query($conn, $sql_day);
$query_daychart = mysqli_query($conn, $sql_day);

$order_date = array();
$total = array();
while($rs = mysqli_fetch_assoc($query_daychart)){
	$order_date[] = "\"".$rs['order_date']."\"";
	$total[] = "\"".$rs['total']."\"";
}
$order_date = implode(",", $order_date);
$total = implode(",", $total);

// month
$sql_month = "SELECT SUM(order_total) AS total,
			DATE_FORMAT(order_date,'%M-%Y') AS order_date
			FROM db_order
			WHERE order_status IN (3,4)
			GROUP BY DATE_FORMAT(order_date,'%M-%Y')
			ORDER BY DATE_FORMAT(order_date,'%M-%Y') DESC";
$query_month = mysqli_query($conn, $sql_month);
$query_monthchart = mysqli_query($conn, $sql_month);

$order_date_month = array();
$total_month = array();
while($rs = mysqli_fetch_assoc($query_monthchart)){
	$order_date_month[] = "\"".$rs['order_date']."\"";
	$total_month[] = "\"".$rs['total']."\"";
}
$order_date_month = implode(",", $order_date_month);
$total_month = implode(",", $total_month);

// year
$sql_year = "SELECT SUM(order_total) AS total,
			DATE_FORMAT(order_date,'%Y') AS order_date
			FROM db_order
			WHERE order_status IN (3,4)
			GROUP BY DATE_FORMAT(order_date,'%Y')
			ORDER BY DATE_FORMAT(order_date,'%Y') DESC";
$query_year = mysqli_query($conn, $sql_year);
$query_yearchart = mysqli_query($conn, $sql_year);

$order_date_year = array();
$total_year = array();
while($rs = mysqli_fetch_assoc($query_yearchart)){
	$order_date_year[] = "\"".$rs['order_date']."\"";
	$total_year[] = "\"".$rs['total']."\"";
}
$order_date_year = implode(",", $order_date_year);
$total_year = implode(",", $total_year);
?>
<div class="row justify-content-between">
    <div class="col-auto">
        <h1 class="app-page-title mb-0">รายงานรายได้</h1>
    </div>
    <div class="col-auto">
         <a href="?page=<?=$_GET['page']?>" class="btn app-btn-secondary">ย้อนกลับ</a>
    </div>
</div>
<hr class="mb-4">
<div class="row g-4 settings-section">
    <div class="col-12 col-md-12">
        <div class="app-card app-card-settings shadow-sm p-4">                      
            <div class="app-card-body">
                
                <div class="row g-4 mb-4">
                    <div class="col-12 col-lg-6">
                        <div class="app-card app-card-chart h-100 shadow-sm">
                            <div class="app-card-header p-3">
                                <div class="row justify-content-between align-items-center">
                                    <div class="col-auto">
                                        <h4 class="app-card-title">วัน (กราฟ)</h4>
                                    </div><!--//col-->
                                </div><!--//row-->
                            </div><!--//app-card-header-->
                            <div class="app-card-body p-3 p-lg-4">
                                <div class="chart-container">
                                    <canvas id="canvas-barchart" ></canvas>
                                </div>
                            </div><!--//app-card-body-->
                        </div><!--//app-card-->
                    </div><!--//col-->
                    <div class="col-12 col-lg-6">
                        <div class="app-card app-card-chart h-100 shadow-sm">
                            <div class="app-card-header p-3">
                                <div class="row justify-content-between align-items-center">
                                    <div class="col-auto">
                                        <h4 class="app-card-title">วัน (ตาราง)</h4>
                                    </div><!--//col-->
                                </div><!--//row-->
                            </div><!--//app-card-header-->
                            <div class="app-card-body p-3 p-lg-4">
                                <div class="mb-3 d-flex">   
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th scope="col">ลำดับ</th>
                                            <th scope="col">วัน/เดือน/ปี</th>
                                            <th scope="col">รายได้</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                            $i = 1;
                                            $sum_total = 0;
                                            foreach($query_day as $data):
                                            $sum_total += $data['total'];
                                        ?>
                                        <tr>
                                            <th scope="row"><?=$i++ ?></th>
                                            <td><?=$data['order_date']?></td>
                                            <td><?=number_format($data['total'],2)?></td>
                                        </tr>

                                        <?php endforeach;?>
                                        <tr class="table-warning">
                                            <td colspan="2">รวม</td>
                                            <td><?=number_format($sum_total,2)?></td>
                                        </tr>
                                    </tbody>
                                </table>
                                </div>
                            </div><!--//app-card-body-->
                        </div><!--//app-card-->
                    </div><!--//col-->
                </div><!--//row-->

                <div class="row g-4 mb-4">
                    <div class="col-12 col-lg-6">
                        <div class="app-card app-card-chart h-100 shadow-sm">
                            <div class="app-card-header p-3">
                                <div class="row justify-content-between align-items-center">
                                    <div class="col-auto">
                                        <h4 class="app-card-title">เดือน (กราฟ)</h4>
                                    </div><!--//col-->
                                </div><!--//row-->
                            </div><!--//app-card-header-->
                            <div class="app-card-body p-3 p-lg-4">
                                <div class="chart-container">
                                    <canvas id="canvas-barchart-month" ></canvas>
                                </div>
                            </div><!--//app-card-body-->
                        </div><!--//app-card-->
                    </div><!--//col-->
                    <div class="col-12 col-lg-6">
                        <div class="app-card app-card-chart h-100 shadow-sm">
                            <div class="app-card-header p-3">
                                <div class="row justify-content-between align-items-center">
                                    <div class="col-auto">
                                        <h4 class="app-card-title">เดือน (ตาราง)</h4>
                                    </div><!--//col-->
                                </div><!--//row-->
                            </div><!--//app-card-header-->
                            <div class="app-card-body p-3 p-lg-4">
                                <div class="mb-3 d-flex">   
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th scope="col">ลำดับ</th>
                                            <th scope="col">เดือน/ปี</th>
                                            <th scope="col">รายได้</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                            $i = 1;
                                            $sum_total = 0;
                                            foreach($query_month as $data):
                                            $sum_total += $data['total'];
                                        ?>
                                        <tr>
                                            <th scope="row"><?=$i++ ?></th>
                                            <td><?=$data['order_date']?></td>
                                            <td><?=number_format($data['total'],2)?></td>
                                        </tr>

                                        <?php endforeach;?>
                                        <tr class="table-warning">
                                            <td colspan="2">รวม</td>
                                            <td><?=number_format($sum_total,2)?></td>
                                        </tr>
                                    </tbody>
                                </table>
                                </div>
                            </div><!--//app-card-body-->
                        </div><!--//app-card-->
                    </div><!--//col-->
                </div><!--//row-->

                <div class="row g-4 mb-4">
                    <div class="col-12 col-lg-6">
                        <div class="app-card app-card-chart h-100 shadow-sm">
                            <div class="app-card-header p-3">
                                <div class="row justify-content-between align-items-center">
                                    <div class="col-auto">
                                        <h4 class="app-card-title">ปี (กราฟ)</h4>
                                    </div><!--//col-->
                                </div><!--//row-->
                            </div><!--//app-card-header-->
                            <div class="app-card-body p-3 p-lg-4">
                                <div class="chart-container">
                                    <canvas id="canvas-barchart-year" ></canvas>
                                </div>
                            </div><!--//app-card-body-->
                        </div><!--//app-card-->
                    </div><!--//col-->
                    <div class="col-12 col-lg-6">
                        <div class="app-card app-card-chart h-100 shadow-sm">
                            <div class="app-card-header p-3">
                                <div class="row justify-content-between align-items-center">
                                    <div class="col-auto">
                                        <h4 class="app-card-title">ปี (ตาราง)</h4>
                                    </div><!--//col-->
                                </div><!--//row-->
                            </div><!--//app-card-header-->
                            <div class="app-card-body p-3 p-lg-4">
                                <div class="mb-3 d-flex">   
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th scope="col">ลำดับ</th>
                                            <th scope="col">ปี</th>
                                            <th scope="col">รายได้</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                            $i = 1;
                                            $sum_total = 0;
                                            foreach($query_year as $data):
                                            $sum_total += $data['total'];
                                        ?>
                                        <tr>
                                            <th scope="row"><?=$i++ ?></th>
                                            <td><?=$data['order_date']?></td>
                                            <td><?=number_format($data['total'],2)?></td>
                                        </tr>

                                        <?php endforeach;?>
                                        <tr class="table-warning">
                                            <td colspan="2">รวม</td>
                                            <td><?=number_format($sum_total,2)?></td>
                                        </tr>
                                    </tbody>
                                </table>
                                </div>
                            </div><!--//app-card-body-->
                        </div><!--//app-card-->
                    </div><!--//col-->
                </div><!--//row-->

            </div><!--//app-card-->
        </div>
    </div>
</div><!--//row-->


<script>
	'use strict';

/* Chart.js docs: https://www.chartjs.org/ */

window.chartColors = {
	green: '#75c181',
	gray: '#a9b5c9',
	text: '#252930',
	border: '#e7e9ed'
};

// Chart.js Bar Chart 

var barChartConfig = {
	type: 'bar',

	data: {
		labels: [<?php echo $order_date;?>],
		datasets: [{
			label: '1วัน(บาท)',
			backgroundColor: '#FFD700',
			borderColor: '#FFD700',
			borderWidth: 1,
			maxBarThickness: 16,
			
			data: [
				<?php echo $total; ?>
			]
		}]
	},
	options: {
		responsive: true,
		aspectRatio: 1.5,
		legend: {
			position: 'bottom',
			align: 'end',
		},
		title: {
			display: true,
			text: 'รายงานรายได้ แยกตามวัน (บาท)'
		},
		tooltips: {
			mode: 'index',
			intersect: false,
			titleMarginBottom: 10,
			bodySpacing: 10,
			xPadding: 16,
			yPadding: 16,
			borderColor: window.chartColors.border,
			borderWidth: 1,
			backgroundColor: '#fff',
			bodyFontColor: window.chartColors.text,
			titleFontColor: window.chartColors.text,

		},
		scales: {
			xAxes: [{
				display: true,
				gridLines: {
					drawBorder: false,
					color: window.chartColors.border,
				},

			}],
			yAxes: [{
				display: true,
				gridLines: {
					drawBorder: false,
					color: window.chartColors.borders,
				},

				
			}]
		}
		
	}
}

var barChartConfig_month = {
	type: 'bar',

	data: {
		labels: [<?php echo $order_date_month;?>],
		datasets: [{
			label: '1เดือน(บาท)',
			backgroundColor: '#FFD700',
			borderColor: '#FFD700',
			borderWidth: 1,
			maxBarThickness: 16,
			
			data: [
				<?php echo $total_month; ?>
			]
		}]
	},
	options: {
		responsive: true,
		aspectRatio: 1.5,
		legend: {
			position: 'bottom',
			align: 'end',
		},
		title: {
			display: true,
			text: 'รายงานรายได้ แยกตามเดือน (บาท)'
		},
		tooltips: {
			mode: 'index',
			intersect: false,
			titleMarginBottom: 10,
			bodySpacing: 10,
			xPadding: 16,
			yPadding: 16,
			borderColor: window.chartColors.border,
			borderWidth: 1,
			backgroundColor: '#fff',
			bodyFontColor: window.chartColors.text,
			titleFontColor: window.chartColors.text,

		},
		scales: {
			xAxes: [{
				display: true,
				gridLines: {
					drawBorder: false,
					color: window.chartColors.border,
				},

			}],
			yAxes: [{
				display: true,
				gridLines: {
					drawBorder: false,
					color: window.chartColors.borders,
				},

				
			}]
		}
		
	}
}

var barChartConfig_year = {
	type: 'bar',

	data: {
		labels: [<?php echo $order_date_year;?>],
		datasets: [{
			label: '1ปี(บาท)',
			backgroundColor: '#FFD700',
			borderColor: '#FFD700',
			borderWidth: 1,
			maxBarThickness: 16,
			
			data: [
				<?php echo $total_year; ?>
			]
		}]
	},
	options: {
		responsive: true,
		aspectRatio: 1.5,
		legend: {
			position: 'bottom',
			align: 'end',
		},
		title: {
			display: true,
			text: 'รายงานรายได้ แยกตามปี (บาท)'
		},
		tooltips: {
			mode: 'index',
			intersect: false,
			titleMarginBottom: 10,
			bodySpacing: 10,
			xPadding: 16,
			yPadding: 16,
			borderColor: window.chartColors.border,
			borderWidth: 1,
			backgroundColor: '#fff',
			bodyFontColor: window.chartColors.text,
			titleFontColor: window.chartColors.text,

		},
		scales: {
			xAxes: [{
				display: true,
				gridLines: {
					drawBorder: false,
					color: window.chartColors.border,
				},

			}],
			yAxes: [{
				display: true,
				gridLines: {
					drawBorder: false,
					color: window.chartColors.borders,
				},

				
			}]
		}
		
	}
}







// Generate charts on load
window.addEventListener('load', function(){
	
	// var lineChart = document.getElementById('canvas-linechart').getContext('2d');
	// window.myLine = new Chart(lineChart, lineChartConfig);
	
	var barChart = document.getElementById('canvas-barchart').getContext('2d');
	window.myBar = new Chart(barChart, barChartConfig);

    var barChart_month = document.getElementById('canvas-barchart-month').getContext('2d');
	window.myBar = new Chart(barChart_month, barChartConfig_month);

    var barChart_year = document.getElementById('canvas-barchart-year').getContext('2d');
	window.myBar = new Chart(barChart_year, barChartConfig_year);
	

});	
	

</script>