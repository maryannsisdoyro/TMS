<?php
session_start();
error_reporting(0);
include ('includes/config.php');
if (strlen($_SESSION['alogin']) == 0) {
	header('location:index.php');
} else {
	?>
	<!DOCTYPE HTML>
	<html>

	<head>
		<title>TMS | Admin manage Users</title>
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<script
			type="application/x-javascript"> addEventListener("load", function() { setTimeout(hideURLbar, 0); }, false); function hideURLbar(){ window.scrollTo(0,1); } </script>
		<!-- Bootstrap Core CSS -->
		<link href="css/bootstrap.min.css" rel='stylesheet' type='text/css' />
		<!-- Custom CSS -->
		<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
			integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
		<link href="css/style.css" rel='stylesheet' type='text/css' />
		<link rel="stylesheet" href="css/morris.css" type="text/css" />
		<!-- Graph CSS -->
		<link href="css/font-awesome.css" rel="stylesheet">
		<!-- jQuery -->
		<script src="js/jquery-2.1.4.min.js"></script>
		<!-- //jQuery -->
		<!-- tables -->
		<link rel="stylesheet" type="text/css" href="css/table-style.css" />
		<link rel="stylesheet" type="text/css" href="css/basictable.css" />
		<script type="text/javascript" src="js/jquery.basictable.min.js"></script>
		<script type="text/javascript">
			$(document).ready(function () {
				$('#table').basictable();

				$('#table-breakpoint').basictable({
					breakpoint: 768
				});

				$('#table-swap-axis').basictable({
					swapAxis: true
				});

				$('#table-force-off').basictable({
					forceResponsive: false
				});

				$('#table-no-resize').basictable({
					noResize: true
				});

				$('#table-two-axis').basictable();

				$('#table-max-height').basictable({
					tableWrapper: true
				});
			});
		</script>
		<!-- //tables -->
		<link href='//fonts.googleapis.com/css?family=Roboto:700,500,300,100italic,100,400' rel='stylesheet'
			type='text/css' />
		<link href='//fonts.googleapis.com/css?family=Montserrat:400,700' rel='stylesheet' type='text/css'>
		<!-- lined-icons -->
		<link rel="stylesheet" href="css/icon-font.min.css" type='text/css' />
		<!-- //lined-icons -->
	</head>

	<body>
		<div class="page-container">
			<!--/content-inner-->
			<div class="left-content">
			<?php include ('includes/navbar.php'); ?>
				<div class="mother-grid-inner" style="margin-top: 70px;">
					<!--header start here-->
					<?php #include ('includes/header.php'); ?>
					<div class="clearfix"> </div>
				</div>
				<!--heder end here-->
				<ol class="breadcrumb">
					<li class="breadcrumb-item"><a href="index.html"></a><i class="fa fa-angle-right"></i>Manage Users
					</li>
				</ol>





				<div class="card">
					<div class="card-header text-center bg-primary">
						<h2>Manage Tourist</h2>
					</div>
					<div class="card-body">
					<form method="post" class="d-flex align-items-center gap-2">
								<input type="search" name="search" class="form-control my-3" placeholder="Search..." >
								<button type="submit" class="btn btn-primary"><i class="fa fa-search"></i></button>
							</form>
						<table class="table">
							<thead>
								<tr>
									<th>#</th>
									<th>Name</th>
									<th>Mobile No.</th>
									<th>Email Id</th>
									<th>RegDate </th>
									<th>Updation Date</th>
									<th>Action</th>
								</tr>
							</thead>
							<tbody>
								<?php 
								// $sql = "SELECT * from tblusers";
								if (isset($_POST['search'])) {
									$search = $_POST['search'];
									if ($search !== '') {
										$sql = "SELECT * from tblusers WHERE FullName LIKE '%$search%'";
									}else{
										$sql = "SELECT * from tblusers";
									}
								}else{
									$sql = "SELECT * from tblusers";
								}
								$query = $dbh->prepare($sql);
								$query->execute();
								$results = $query->fetchAll(PDO::FETCH_OBJ);
								$cnt = 1;
								if ($query->rowCount() > 0) {
									foreach ($results as $result) { ?>
										<tr>
											<td><?php echo htmlentities($cnt); ?></td>
											<td><?php echo htmlentities($result->FullName); ?></td>
											<td><?php echo htmlentities($result->MobileNumber); ?></td>
											<td><?php echo htmlentities($result->EmailId); ?></td>
											<td><?php echo htmlentities($result->RegDate); ?></td>
											<td><?php echo htmlentities($result->UpdationDate); ?></td>
											<td><a href="user-bookings.php?uid=<?php echo htmlentities($result->id); ?>&&uname=<?php echo htmlentities($result->FullName); ?>"
													class="btn btn-primary">User Bookings</td>
										</tr>
										<?php $cnt = $cnt + 1;
									}
								} ?>
							</tbody>
						</table>
					</div>
				</div>



				<!-- script-for sticky-nav -->
				<script>
					$(document).ready(function () {
						var navoffeset = $(".header-main").offset().top;
						$(window).scroll(function () {
							var scrollpos = $(window).scrollTop();
							if (scrollpos >= navoffeset) {
								$(".header-main").addClass("fixed");
							} else {
								$(".header-main").removeClass("fixed");
							}
						});

					});
				</script>
				<!-- /script-for sticky-nav -->
				<!--inner block start here-->
				<div class="inner-block">

				</div>
				<!--inner block end here-->
				<!--copy rights start here-->
				<?php include ('includes/footer.php'); ?>
				<!--COPY rights end here-->
			</div>
		</div>
		<!--//content-inner-->
		<!--/sidebar-menu-->
		<?php include ('includes/sidebarmenu.php'); ?>
		<div class="clearfix"></div>
		</div>
		<script>
			var toggle = true;

			$(".sidebar-icon").click(function () {
				if (toggle) {
					$(".page-container").addClass("sidebar-collapsed").removeClass("sidebar-collapsed-back");
					$("#menu span").css({ "position": "absolute" });
				}
				else {
					$(".page-container").removeClass("sidebar-collapsed").addClass("sidebar-collapsed-back");
					setTimeout(function () {
						$("#menu span").css({ "position": "relative" });
					}, 400);
				}

				toggle = !toggle;
			});
		</script>
		<!--js -->
		<script src="js/jquery.nicescroll.js"></script>
		<script src="js/scripts.js"></script>
		<!-- Bootstrap Core JavaScript -->
		<script src="js/bootstrap.min.js"></script>
		<!-- /Bootstrap Core JavaScript -->

	</body>

	</html>
<?php } ?>