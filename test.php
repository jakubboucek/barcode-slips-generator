<link href="https://fonts.googleapis.com/css?family=Ubuntu+Mono" rel="stylesheet" type="text/css">
<style>
	table {
		border-spacing: 0;
		border-collapse: collapse;
	}
	table td {
		padding: 10px 5px;
		border: 1px solid #ccc;
		text-align: center;
		line-height: 1;
	}
	table td .logo {
		float:left;
	}
	table td div {
		font-size: 1.6em;
		font-family: 'Ubuntu Mono', sans-serif;
		font-weight: 400;
		padding: 3px 0 0 0;
	}
</style>
<table>
	<?php
		for($i=0;$i<13; $i++) {
	?>
	<tr>
		<?php
		for($j=0;$j<3;$j++) {
			$word = get('code', getWord(get('length',3)));
			$code = str_replace('-', '', $word);
			?>
				<td>
					<img src="logo.png" width=46 height=46 class="logo">
					<img src="gen.php?code=<?php echo $code; ?>" width="150" height="20">
					<div><?php echo $word; ?></div>
				</td>
			<?php
		}
		?>
	</tr>
	<?php
		}
	?>
</table>

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