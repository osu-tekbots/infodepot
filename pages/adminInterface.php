<?php
use DataAccess\InfoDepotItemsDao;

session_start();

include_once PUBLIC_FILES . '/lib/shared/authorize.php';

$isAdmin = isset($_SESSION['userID']) && !empty($_SESSION['userID']) 
	&& isset($_SESSION['accessLevel']) && $_SESSION['accessLevel'] == 'Admin';

//TODO Fixme: uncomment after development	
//allowIf($isAdmin);

$itemsDao = new InfoDepotItemsDao($dbConn, $logger);

$title = 'Admin Interface';
$css = array(
    'assets/css/sb-admin.css'
);
include_once PUBLIC_FILES . '/modules/header.php';

?>
<div id="page-top">

	<div id="wrapper">

		<!-- Sidebar -->
		<ul class="sidebar navbar-nav">
			<li class="nav-item active">
				<a class="nav-link" href="adminInterface.php">
					<i class="fas fa-fw fa-tachometer-alt"></i>
					<span>Dashboard</span>
				</a>
			</li>
			<li class="nav-item">
				<a class="nav-link" href="pages/adminItems.php">
					<i class="fas fa-fw fa-chart-area"></i>
					<span>Items</span></a>
			</li>
			<li class="nav-item">
				<a class="nav-link" href="pages/adminUser.php">
					<i class="fas fa-fw fa-table"></i>
					<span>Users</span></a>
			</li>
		</ul>

		<div id="content-wrapper">

			<div class="container-fluid">

				<!-- Breadcrumbs-->
				<ol class="breadcrumb">
					<li class="breadcrumb-item">
						<a>Dashboard</a>
					</li>
					<li class="breadcrumb-item active">Overview</li>
				</ol>

				<?php
					//TODO: Modify stats to items instead, pending items. 
					//$stats = $projectsDao->getCapstoneProjectStats();
					//$pendingProjects = $stats['projectsPending'];
					//$pendingCategories = $stats['projectsNeedingCategoryPlacement'];
				?>
				<!-- Icon Cards-->
				<div class="row">
					<div class="col-xl-3 col-sm-6 mb-3">
						<div class="card text-white bg-success o-hidden h-100">
							<div class="card-body">
								<div class="card-body-icon">
									<i class="fas fa-fw fa-shopping-cart"></i>
								</div>
								<div class="mr-5">Browse and Review Items</div>
							</div>
							<a class="card-footer text-white clearfix small z-1" href="pages/adminItems.php">
								<span class="float-left">View Details</span>
								<span class="float-right">
									<i class="fas fa-angle-right"></i>
								</span>
							</a>
						</div>
					</div>
					<div class="col-xl-3 col-sm-6 mb-3">
						<div class="card text-white bg-primary o-hidden h-100">
							<div class="card-body">
								<div class="card-body-icon">
									<i class="fas fa-users"></i>
								</div>
								<div class="mr-5">Users Table</div>
							</div>
							<a class="card-footer text-white clearfix small z-1" href="pages/adminUser.php">
								<span class="float-left">View Details</span>
								<span class="float-right">
									<i class="fas fa-angle-right"></i>
								</span>
							</a>
						</div>
					</div>
				</div>

				<!-- Area Chart Example-->
				
				<div class="card mb-3">
					<div class="card-header">
						<i class="fas fa-chart-area"></i>
						Bar Graph</div>
					<div id="barGraphContainer" style="height: 300px; width: 100%;"></div>
					<div class="card-footer small text-muted"></div>
				</div>

				<div class="card mb-3">
					<div class="card-header">
						<i class="fas fa-chart-area"></i>
						Pie Chart</div>
					<div id="chartContainer" style="height: 300px; width: 100%;"></div>
					<div class="card-footer small text-muted"></div>
				</div>


			</div>
		</div>
	</div>
</div>

<script>

window.onload = function () {

var options = {
	animationEnabled: true,
	title: {
		text: "Most Popular Keywords"
	},
	axisY: {
		title: "Number Of Times Tagged",
		suffix: "",
		includeZero: false
	},
	axisX: {
		title: "Keywords"
	},
	data: [{
		type: "column",
		yValueFormatString: "#,##0.0#"%"",
		dataPoints: [
			{ label: "Machine Learning", y: 10.09 },
			{ label: "Artificial Intelligence", y: 10.40 },
			{ label: "Embedded Systems", y: 18.50 },
			{ label: "Coding", y: 11.96 },
			{ label: "Circuits", y: 7.80 },
			{ label: "Probability", y: 15.56 },
			{ label: "Statistical Analysis", y: 7.20 },
			{ label: "3D Printing", y: 7.3 }

		]
	}]
};

var options1 = {
	title: {
		text: "User Type"
	},
	subtitles: [{
		text: ""
	}],
	animationEnabled: true,
	data: [{
		type: "pie",
		startAngle: 40,
		toolTipContent: "<b>{label}</b>: {y}%",
		showInLegend: "true",
		legendText: "{label}",
		indexLabelFontSize: 16,
		indexLabel: "{label} - {y}%",
		dataPoints: [
			{ y: 48.36, label: "Proposers" },
			{ y: 26.85, label: "Students" },
			{ y: 1.49, label: "Admins" }
		]
	}]
};

$("#barGraphContainer").CanvasJSChart(options);
$("#chartContainer").CanvasJSChart(options1);

}


</script>

<?php 
include_once PUBLIC_FILES . '/modules/footer.php' ; 
?>
