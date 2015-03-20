<style>
	table {
		border-spacing: 0;
		border-collapse: collapse;
	}
	table td {
		padding: 10px 5px;
		border: 0.1px solid #ccc;
		text-align: center;
		line-height: 1;
	}
	table td div {
		font-size: 2em;
		font-family: Consolas, sans-serif;
	}
</style>
<table>
	<?php
		for($i=0;$i<13; $i++) {
	?>
	<tr>
		<?php
		for($j=0;$j<3;$j++) {
			$word = get('code', getWord(get('length',4)));
			?>
				<td>
					<img src="gen.php?code=<?php echo $word ?>" width="200" height="20">
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
	$rooms = "ABCDKLPSV";
	$chars = "ABCDEFHKLMNPQRSTUWXZ0123456789";
	$strlen = strlen($chars)-1;

	$o = "DXF";
	//$o .= $rooms[mt_rand(0,strlen($rooms)-1)];

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