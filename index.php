<?php
error_reporting(E_ALL);
ini_set('display_errors', 'On');

include('common/util.php');
$dbh = connectToDB();
?>

<!DOCTYPE html>
<html>
	<head>
		<title>Cursillo</title>
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<!-- Bootstrap -->
		<link href="assets/bootstrap/css/bootstrap.min.css" rel="stylesheet" media="screen">
	</head>
	<body>
		<div class="container">
			<?php include('common/nav.php'); ?>
			<div class="row menu-header">
				<h2 class="span12" style="text-align:center;">Menu</h2>
			</div>
			<div class="menu">
				<div class="row">
					<a href="<?php makeLink('cursillo/') ?>">
						<button type="button" class="btn span12">Cursillos</button>
					</a>
				</div>
				<div class="row">
					<a href="<?php makeLink('parish/') ?>">
						<button type="button" class="btn span12">Parishes</button>
					</a>
				</div>
				<div class="row">
					<a href="<?php makeLink('team/') ?>">
						<button type="button" class="btn span12">Teams</button>
					</a>
				</div>
				<div class="row">
					<a href="<?php makeLink('individual/') ?>">
						<button type="button" class="btn span12">Cursillistas</button>
					</a>
				</div>
				<div class="row">
					<a href="<?php makeLink('role/') ?>">
						<button type="button" class="btn span12" >Roles</button>
					</a>
				</div>
				<div class="row">
					<a href="<?php makeLink('talk/') ?>">
						<button type="button" class="btn span12">Talks</button>
					</a>
				</div>
			</div>
		</div>
	</body>
	<script src="http://code.jquery.com/jquery.js"></script>
	<script src="assets/bootstrap/js/bootstrap.min.js"></script>
	<script>
		$(document).ready(function(){
			$('[data-toggle="tooltip"]').tooltip();
		});
	</script>
</html>