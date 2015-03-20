<!DOCTYPE html>
<html lang="cs">
<head>
	<meta name="author" content="Jakub Bouček; mailto:pan@jakubboucek.cz">
	<title>Čárové kódy</title>

	<link rel="shortcut icon" href="//cdn.socialbakers.com/favicon.ico">

	<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
	<script type="text/javascript" src="./js/main.min.js" async="async"></script>
	<link href="https://fonts.googleapis.com/css?family=Fira+Mono" rel="stylesheet" type="text/css">
	<style>
		table {
			border-spacing: 0;
			border-collapse: collapse;
		}
		table td {
			border: 1px solid transparent;
			padding: 0;
		}
		table td .inner {
			padding: 10px 0px;
			text-align: center;
			line-height: 1;
			width: 48.5mm;
			height: 25.5mm;
			-webkit-box-sizing: border-box; /* Safari 3.0 - 5.0, Chrome 1 - 9, Android 2.1 - 3.x */
			-moz-box-sizing: border-box;    /* Firefox 1 - 28 */
			box-sizing: border-box;         /* Safari 5.1+, Chrome 10+, Firefox 29+, Opera 7+, IE 8+, Android 4.0+, iOS any */
			overflow: hidden;
		}
		table td .logo {
			float:left;
			width: 34px;
			height: 34px;
			margin-left: 10px;
		}
		table td .code {
			margin-top: 5px;
			height: 25px;
			width: 139px;
		}
		table td .word {
			margin-top: 13px;
			font-size: 1.8em;
			font-family: 'Fira Mono', sans-serif;
			font-weight: 400;
			padding: 3px 0 0 0;
		}

		header {
			font-family: Arial;
			font-size: 0.8em;
			background-color: #ffe173;
			border-radius: 5px;
			border: 1px solid #a68200;
			margin: 10px 0px 30px;
			padding: 15px;
		}

		label {
			margin-right: 15px;
		}

		#print {
			font-weight: bold;
			padding: 0.8em;
		}

		.spinner {
			display: inline-block;
			position: relative;
			width: 16px;
			height: 16px;
			margin-top: -2px;
			top: 4px;
			margin-right: 5px;
		}

		@media print {
			@page {
				size: 210mm 297mm;
				margin: 8mm;
				margin-top: 9mm;
			}
			body {
				padding: 0;
				margin: 0;
			}
			header {
				display: none;
			}
			body table td {
				border: 0.5mm solid transparent;
			}
			body.border table td {
				border: 0.5mm solid #ccc;
			}
		}

		@media screen {
			body table td {
				border: 0.5mm solid #ccc;
			}
			body.border table td {
				border: 0.5mm solid red;
			}
		}
	</style>
</head>
<body class="">

	<header>
		<input type="button" value="Další kódy" id="refresh">
		<input type="checkbox" id="test"> <label for="test">S tisknutelným rámečkem</label>
		<button type="button" id="print"><div class="spinner"></div>Uložit a tisknout</a>
	</header>

<table>
	<?php
		$codes = array();
		for($i=0;$i<11; $i++) {
	?>
	<tr>
		<?php
		for($j=0;$j<4;$j++) {
			$word = get('code', getWord(get('length',3)));
			$codes[] = $code = str_replace('-', '', $word);
			?>
				<td><div class="inner">
					<img src="logo.png" class="logo">
					<img src="gen.php?code=<?php echo $code; ?>" class="code">
					<div class="word"><?php echo $word; ?></div>
				</div></td>
			<?php
		}
		?>
	</tr>
	<?php
		}
	?>
</table>
<script> window.currentCodes = <?php echo json_encode($codes); ?>;</script>
<?php

function getWord($length=3) {
	//return "00000";
	$chars = "ABCDEFHKLMNPQRSTUWX0123456789";
	$strlen = strlen($chars)-1;

	$o = "SB-FT-";

	for($i=0;$i<$length;$i++) {
		$o .= $chars[mt_rand(0,$strlen)];
	}
	return $o;
}
function get($name, $default=NULL) {
	if(isset($_GET[$name]))
		return $_GET[$name];
	return $default;
}