<?php

$sql_view = "SELECT SUM(p_view) as view FROM db_product";
$query_view = mysqli_query($conn,$sql_view);
$result_view = mysqli_fetch_assoc($query_view);

$sql_ar_view = "SELECT SUM(article_view) as view FROM db_article";
$query_ar_view = mysqli_query($conn,$sql_ar_view);
$result_ar_view = mysqli_fetch_assoc($query_ar_view);


$sql_product = "SELECT COUNT(product_id) as count_produdct FROM db_product";
$query_product = mysqli_query($conn,$sql_product);
$result_product = mysqli_fetch_assoc($query_product);

// for chart 

// best sale
$sql_bestsale = "SELECT db_order_details.product_id,db_product.p_name,SUM(db_order_details.detail_qty) AS qty 
                FROM db_order_details 
                INNER JOIN db_product ON db_product.product_id = db_order_details.product_id
                INNER JOIN db_order ON db_order.order_id = db_order_details.order_id
                WHERE db_order.order_status IN (3,4)
                GROUP BY db_product.product_id 
                ORDER BY SUM(db_order_details.detail_qty) DESC";
$query_bestsale = mysqli_query($conn, $sql_bestsale);
$query_bestsale_chart = mysqli_query($conn, $sql_bestsale);

$label_bestsale = array();
$data_bestsale = array();
while($rs = mysqli_fetch_assoc($query_bestsale_chart)){
	$label_bestsale[] = "\"".$rs['p_name']."\"";
	$data_bestsale[] = "\"".$rs['qty']."\"";
}
$label_bestsale = implode(",", $label_bestsale);
$data_bestsale = implode(",", $data_bestsale);

// best member
$sql_bestmem = "SELECT db_member.m_id,db_member.m_username,COUNT(db_order.m_id) AS memsum
                FROM db_order
                INNER JOIN db_member ON db_member.m_id = db_order.m_id
                WHERE db_order.order_status IN (3,4)
                GROUP BY db_member.m_username
                ORDER BY COUNT(db_order.m_id) DESC";
$query_bestmem = mysqli_query($conn, $sql_bestmem);
$query_bestmem_chart = mysqli_query($conn, $sql_bestmem);

$label_bestmem = array();
$data_bestmem = array();
while($rs = mysqli_fetch_assoc($query_bestmem_chart)){
	$label_bestmem[] = "\"".$rs['m_username']."\"";
	$data_bestmem[] = "\"".$rs['memsum']."\"";
}
$label_bestmem = implode(",", $label_bestmem);
$data_bestmem = implode(",", $data_bestmem);

?>

<div class="row justify-content-between">
    <div class="col-auto">
        <h1 class="app-page-title mb-0">ข้อมูลรายงาน</h1>
    </div>
</div>
<hr class="mb-4">
<div class="row g-4 settings-section">
    <div class="col-12 col-md-12">
        <div class="app-card app-card-settings shadow-sm p-4">                      
            <div class="app-card-body">
                <div class="row g-4 mb-4">
                    <div class="col-6 col-lg-4">
                        <div class="app-card app-card-stat shadow-sm h-100">
                            <div class="app-card-body p-3 p-lg-4">
                                <h4 class="stats-type mb-1">สินค้าทั้งหมด</h4>
                                <div class="stats-figure"><?= $result_product['count_produdct'] ?></div>
                                <div class="stats-meta">อย่าง</div>
                            </div><!--//app-card-body-->
                            <a class="app-card-link-mask" href="?page=product"></a>
                        </div><!--//app-card-->
                    </div><!--//col-->
                    <div class="col-6 col-lg-4">
                        <div class="app-card app-card-stat shadow-sm h-100">
                            <div class="app-card-body p-3 p-lg-4">
                                <h4 class="stats-type mb-1">การดูสินค้าทั้งหมด</h4>
                                <div class="stats-figure"><?= $result_view['view'] ?></div>
                                <div class="stats-meta">ครั้ง</div>
                            </div><!--//app-card-body-->
                            <a class="app-card-link-mask" href="#"></a>
                        </div><!--//app-card-->
                    </div><!--//col-->
                    <div class="col-6 col-lg-4">
                        <div class="app-card app-card-stat shadow-sm h-100">
                            <div class="app-card-body p-3 p-lg-4">
                                <h4 class="stats-type mb-1">การดูบทความทั้งหมด</h4>
                                <div class="stats-figure"><?= $result_ar_view['view'] ?></div>
                                <div class="stats-meta">ครั้ง</div>
                            </div><!--//app-card-body-->
                            <a class="app-card-link-mask" href="#"></a>
                        </div><!--//app-card-->
                    </div><!--//col-->
                </div><!--//row-->

                <div class="col-auto mb-3">
                    <a href="?page=<?=$_GET['page']?>&function=income" class="btn btn-sm btn-warning">รายงานรายได้</a>
                </div>

                <div class="row g-4 mb-4">
                    <div class="col-12 col-lg-6">
                        <div class="app-card app-card-chart h-100 shadow-sm">
                            <div class="app-card-header p-3">
                                <div class="row justify-content-between align-items-center">
                                    <div class="col-auto">
                                        <h4 class="app-card-title">จำนวนการซื้อต้นไม้ (กราฟ)</h4>
                                    </div><!--//col-->
                                </div><!--//row-->
                            </div><!--//app-card-header-->
                            <div class="app-card-body p-3 p-lg-4">
                                <div class="chart-container">
                                    <canvas id="canvas-barchart-bestsale" ></canvas>
                                </div>
                            </div><!--//app-card-body-->
                        </div><!--//app-card-->
                    </div><!--//col-->
                    
                    <div class="col-12 col-lg-6">
                        <div class="app-card app-card-chart h-100 shadow-sm">
                            <div class="app-card-header p-3">
                                <div class="row justify-content-between align-items-center">
                                    <div class="col-auto">
                                        <h4 class="app-card-title">จำนวนการขายต้นไม้ (ตาราง)</h4>
                                    </div><!--//col-->
                                </div><!--//row-->
                            </div><!--//app-card-header-->
                            <div class="app-card-body p-3 p-lg-4">
                                <div class="mb-3 d-flex">   
                                    <table class="table">
                                        <thead>
                                            <tr>
                                                <th scope="col">ลำดับ</th>
                                                <th scope="col">ชื่อต้นไม้</th>
                                                <th scope="col">จำนวนการขาย</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                                $i = 1;
                                                $sum_total = 0;
                                                foreach($query_bestsale as $data):
                                                $sum_total += $data['qty'];
                                            ?>
                                            <tr>
                                                <th scope="row"><?=$i++ ?></th>
                                                <td><?=$data['p_name']?></td>
                                                <td><?=$data['qty']?></td>
                                            </tr>

                                            <?php endforeach;?>
                                            <tr class="table-success">
                                                <td colspan="2">รวม</td>
                                                <td><?=$sum_total?></td>
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
                                        <h4 class="app-card-title">จำนวนการสั่งซื้อของลูกค้า (กราฟ)</h4>
                                    </div><!--//col-->
                                </div><!--//row-->
                            </div><!--//app-card-header-->
                            <div class="app-card-body p-3 p-lg-4">
                                <div class="chart-container">
                                    <canvas id="canvas-barchart-bestmem" ></canvas>
                                </div>
                            </div><!--//app-card-body-->
                        </div><!--//app-card-->
                    </div><!--//col-->
                    
                    <div class="col-12 col-lg-6">
                        <div class="app-card app-card-chart h-100 shadow-sm">
                            <div class="app-card-header p-3">
                                <div class="row justify-content-between align-items-center">
                                    <div class="col-auto">
                                        <h4 class="app-card-title">จำนวนการสั่งซื้อของลูกค้า (ตาราง)</h4>
                                    </div><!--//col-->
                                </div><!--//row-->
                            </div><!--//app-card-header-->
                            <div class="app-card-body p-3 p-lg-4">
                                <div class="mb-3 d-flex">   
                                    <table class="table">
                                        <thead>
                                            <tr>
                                                <th scope="col">ลำดับ</th>
                                                <th scope="col">รหัสบัญชีผู้ใช้</th>
                                                <th scope="col">บัญชีผู้ใช้</th>
                                                <th scope="col">จำนวนการสั่ง (ครั้ง)</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                                $i = 1;
                                                $sum_total = 0;
                                                foreach($query_bestmem as $data):
                                                $sum_total += $data['memsum'];
                                            ?>
                                            <tr>
                                                <th scope="row"><?=$i++ ?></th>
                                                <td><?=$data['m_id']?></td>
                                                <td><?=$data['m_username']?></td>
                                                <td><?=$data['memsum']?></td>
                                            </tr>

                                            <?php endforeach;?>
                                            <tr class="table-success">
                                                <td colspan="3">รวม</td>
                                                <td><?=$sum_total?></td>
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

var barChartConfig_bestsale = {
	type: 'bar',

	data: {
		labels: [<?php echo $label_bestsale;?>],
		datasets: [{
			label: 'จำนวนการซื้อ(ต้น)',
			backgroundColor: window.chartColors.green,
			borderColor: window.chartColors.green,
			borderWidth: 1,
			maxBarThickness: 16,
			
			data: [
				<?php echo $data_bestsale; ?>
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
			text: 'รายงานการซื้อต้นไม้'
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

var barChartConfig_bestmem = {
	type: 'bar',

	data: {
		labels: [<?php echo $label_bestmem;?>],
		datasets: [{
			label: 'จำนวนการสั่งซื้อ(ครั้ง)',
			backgroundColor: window.chartColors.green,
			borderColor: window.chartColors.green,
			borderWidth: 1,
			maxBarThickness: 16,
			
			data: [
				<?php echo $data_bestmem; ?>
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
			text: 'รายงานการสั่งซื้อ'
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


    var barChart_bestsale = document.getElementById('canvas-barchart-bestsale').getContext('2d');
	window.myBar = new Chart(barChart_bestsale, barChartConfig_bestsale);

    var barChart_bestmem = document.getElementById('canvas-barchart-bestmem').getContext('2d');
	window.myBar = new Chart(barChart_bestmem, barChartConfig_bestmem);
	

});	
	

</script>