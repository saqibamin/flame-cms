<?php
// set MIME type
header("Content-type: image/png");
// connect to database server and select database
$conn = mysql_connect('localhost', 'root', '');
mysql_select_db('flame_cms');
// grab id of the captcha to be displayed
if(isset($_GET['cid']) && !empty($_GET['cid']))
{
	$randID = (int) $_GET['cid'];
}
else
	$randID = 1;

$captchaString = mysql_query("SELECT value FROM captcha WHERE id={$randID}");
$captchaString = mysql_fetch_assoc($captchaString);
$captchaString = $captchaString['value'];

mysql_close($conn); // close db connection

$captcha = imagecreatetruecolor(220, 50);
// allocate colors
$white = imagecolorallocate($captcha, 255, 255, 255);
$black = imagecolorallocate($captcha, 0, 0, 0);
$shadow = imagecolorallocate($captcha, 100, 100, 100);

imagefill($captcha, 0, 0, $white);
// horizontal position of first character
$x_pos = 30;

$font = "Chaparral.otf";

$terminate = strlen($captchaString);
for($i=0; $i < $terminate; $i ++)
{
	$angle = rand(-20, 25); /*random angle*/
	$y_pos = rand(30, 40); /*random vertical position of characters*/

	$character =  $captchaString[$i];

	// write this character to the image three times
	imagettftext($captcha, 30, $angle, $x_pos, $y_pos, $black, $font, $character);
	imagettftext($captcha, 30, $angle+1, $x_pos + rand(0, 1), $y_pos + rand(0, 1), $shadow, $font, $character);
	imagettftext($captcha, 30, $angle, $x_pos - rand(0, 1), $y_pos - rand(0, 1), $white, $font, $character);

	$x_pos += 30; // set horizontal position for next character
}
// send the image
imagepng($captcha);
// free up the memory
imagedestroy($captcha);

?>