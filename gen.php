<?php

	define('KEY_STARTA', 103);
	define('KEY_STARTB', 104);
	define('KEY_STARTC', 105);

	define('KEY_STOP', 106);

function get($name, $default=NULL) {
	if(isset($_GET[$name]))
		return $_GET[$name];
	return $default;
}

$code = get('code');

if(!$code) {
	?>
<form action="" nethod="get">
	<input type="text" name="code" /><input type="submit" value="Odeslat" />
</form>
<?php
die();

}


$keys = ' !"#$%&\'()*+,-./0123456789:;<=>?@ABCDEFGHIJKLMNOPQRSTUVWXYZ[\\]^_`abcdefghijklmnopqrstuvwxyz{|}~'.chr(127);
$codes = array(
			'101111',	/* 00 */
			'111011',	/* 01 */
			'111110',	/* 02 */
			'010112',	/* 03 */
			'010211',	/* 04 */
			'020111',	/* 05 */
			'011102',	/* 06 */
			'011201',	/* 07 */
			'021101',	/* 08 */
			'110102',	/* 09 */
			'110201',	/* 10 */
			'120101',	/* 11 */
			'001121',	/* 12 */
			'011021',	/* 13 */
			'011120',	/* 14 */
			'002111',	/* 15 */
			'012011',	/* 16 */
			'012110',	/* 17 */
			'112100',	/* 18 */
			'110021',	/* 19 */
			'110120',	/* 20 */
			'102101',	/* 21 */
			'112001',	/* 22 */
			'201020',	/* 23 */
			'200111',	/* 24 */
			'210011',	/* 25 */
			'210110',	/* 26 */
			'201101',	/* 27 */
			'211001',	/* 28 */
			'211100',	/* 29 */
			'101012',	/* 30 */
			'101210',	/* 31 */
			'121010',	/* 32 */
			'000212',	/* 33 */
			'020012',	/* 34 */
			'020210',	/* 35 */
			'001202',	/* 36 */
			'021002',	/* 37 */
			'021200',	/* 38 */
			'100202',	/* 39 */
			'120002',	/* 40 */
			'120200',	/* 41 */
			'001022',	/* 42 */
			'001220',	/* 43 */
			'021020',	/* 44 */
			'002012',	/* 45 */
			'002210',	/* 46 */
			'022010',	/* 47 */
			'202010',	/* 48 */
			'100220',	/* 49 */
			'120020',	/* 50 */
			'102002',	/* 51 */
			'102200',	/* 52 */
			'102020',	/* 53 */
			'200012',	/* 54 */
			'200210',	/* 55 */
			'220010',	/* 56 */
			'201002',	/* 57 */
			'201200',	/* 58 */
			'221000',	/* 59 */
			'203000',	/* 60 */
			'110300',	/* 61 */
			'320000',	/* 62 */
			'000113',	/* 63 */
			'000311',	/* 64 */
			'010013',	/* 65 */
			'010310',	/* 66 */
			'030011',	/* 67 */
			'030110',	/* 68 */
			'001103',	/* 69 */
			'001301',	/* 70 */
			'011003',	/* 71 */
			'011300',	/* 72 */
			'031001',	/* 73 */
			'031100',	/* 74 */
			'130100',	/* 75 */
			'110003',	/* 76 */
			'302000',	/* 77 */
			'130001',	/* 78 */
			'023000',	/* 79 */
			'000131',	/* 80 */
			'010031',	/* 81 */
			'010130',	/* 82 */
			'003101',	/* 83 */
			'013001',	/* 84 */
			'013100',	/* 85 */
			'300101',	/* 86 */
			'310001',	/* 87 */
			'310100',	/* 88 */
			'101030',	/* 89 */
			'103010',	/* 90 */
			'301010',	/* 91 */
			'000032',	/* 92 */
			'000230',	/* 93 */
			'020030',	/* 94 */
			'003002',	/* 95 */
			'003200',	/* 96 */
			'300002',	/* 97 */
			'300200',	/* 98 */
			'002030',	/* 99 */
			'003020',	/* 100*/
			'200030',	/* 101*/
			'300020',	/* 102*/
			'100301',	/* 103*/
			'100103',	/* 104*/
			'100121',	/* 105*/
			'122000'	/*STOP*/
		);

$data = array();
$indcheck = array();

$indcheck[] = KEY_STARTB;
$data[] = $codes[KEY_STARTB]; //Start B

$codelen = strlen($code);
for($i=0;$i<$codelen;$i++) {
	$pos = strpos($keys, $code[$i]);
	if($pos === FALSE)
		die("Invalid char: $code[$i]");
	$indcheck[] = $pos;
	$data[] = $codes[$pos];
}

$checksumValue = $indcheck[0];
$c = count($indcheck);
for ($i = 1; $i < $c; $i++) {
	$checksumValue += $indcheck[$i] * $i;
}

$checksumValue = $checksumValue % 103;

$data[] = $codes[$checksumValue];
$data[] = $codes[KEY_STOP];
$data[] = "0"; //end bit

$data_string = implode('',$data);

$width = strlen($data_string);

for($c = $width, $i=0; $i< $c; $i++) {
	$width += intval($data_string[$i]);
}

$scale = 4;
$height = 1;
$space = 10;
$barwidth = $width*$scale+2*$space*$scale+3;

$im = imagecreatetruecolor($barwidth,$height);
$white = imagecolorallocate($im, 255,255,255);
$black = imagecolorallocate($im, 0,0,0);
imagefilledrectangle($im, 0, 0, $barwidth + 1, $height - 1, $white);

$x = $space;
$colors = array($black,$white);
foreach($data as $dataitem) {
	$currentColor = 0;
	$c = strlen($dataitem);
	for ($i = 0; $i < $c; $i++) {
		for ($j = 0; $j < intval($dataitem[$i]) + 1; $j++) {
					//$this->drawFilledRectangle($im, $this->positionX, 0, $this->positionX, $this->thickness - 1, $colors);
					//drawFilledRectangle($im, $x1, $y1, $x2, $y2, $color = self::COLOR_FG)
							$x1 = $x2 = $x++;
							$y1 = 0;
							$y2 = $height;
								if ($x1 > $x2) { // Swap
									$x1 ^= $x2 ^= $x1 ^= $x2;
								}

								if ($y1 > $y2) { // Swap
									$y1 ^= $y2 ^= $y1 ^= $y2;
								}

								// /*
								imagefilledrectangle($im,
									($x1*$scale),
									($y1),
									($x2*$scale)+$scale-1,
									($y2),
									$colors[$currentColor]); // */
		}

		$currentColor = ($currentColor + 1) % 2;
	}
}


header('Content-Type: image/png');
ob_start();
imagepng($im);
$bin = ob_get_contents();
ob_end_clean();
echo $bin;