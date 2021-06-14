

<!DOCTYPE html>
<html>
<head>

	<title>
		<?php echo isset($page_title)?$page_title:$title;?> - Grenoble Reggae Orchestra
	</title>
	
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">

	
	<link rel="icon" href="<?php echo base_url("images/favicon-GRO.ico");?>" />

	<!-- STYLE!-->
	<link rel="stylesheet" href="<?php echo base_url("css/style.css");?>" />	
	
	<!-- Pour les vignettes réseaux sociaux (Open Graph) !-->
	<meta property="og:title" content="<?php echo isset($page_title)?$page_title:$title;?>" />
	<meta property="og:description" content="<?php echo isset($page_description)?$page_description:""; ?>" />
	<meta property="og:image" content="<?php echo base_url("images/logo_small.png") ?>" />
	<meta property="og:width" content="200" />
	<meta property="og:height" content="200" />
	
	
	<!-- JQuery 3.4.1 !-->
	<script
			  src="https://code.jquery.com/jquery-3.4.1.min.js"
			  integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo="
			  crossorigin="anonymous">
	</script>
	
	
	<!-- BOOTSTRAP 3.3.7 !-->
	<link href="https://stackpath.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet">
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" />
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	
	<!-- Popper !-->
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.11.0/umd/popper.min.js" integrity="sha384-b/U6ypiBEHpOf/4+1nzFpr53nxSS+GLCkfwBdFNTxtclqqenISfwAzpKaMNFNmj4" crossorigin="anonymous"></script>

	
	
	<script type="text/javascript">

		$(function() {
			// On stylise les colonnes
			update_style();
		});
		

		// Permet de centrer des td avec la class "centerTD" dans le theader
		function update_style() {
			$("table .centerTD").each(function() {
				$(this).css("text-align","center");
				$(this).parents("table").find("tr:not(.tablesorter-childRow) td:nth-child("+($(this).index()+1)+")").css("text-align","center");
				$(this).parents("table").find("tr:not(.tablesorter-childRow) th:nth-child("+($(this).index()+1)+")").css("text-align","center");
			});
		}

	</script>
	
	
</head>


 <body id="bootstrap-overrides">

	<div class="navbar-wrapper">
	<div id="canevas" class="container">

		<div class="row hidden-xs" id="page_title">
			<a href="<?php echo base_url();?>"><h1>Grenoble<br><?php echo str_repeat("&nbsp;",3)?>Reggae<br><?php echo str_repeat("&nbsp;",5)?>Orchestra</h1></a>
		</div>
			
