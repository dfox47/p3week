<?php
/*
=====================================================
=====================================================
*/


////////////////////////////////////////////////////////////////////////////////
// 0 - Выключить, 1 - Включить.
$mode = 1;

// Путь к корню сайта.
$docroot = "/var/www/p3week/data/www/p3week.ru";

// Путь к файлу антивируса от корня сайта.
$script_filename = "/webanalyze/analize.php";

// Название сайта.
$sitename = "Сайт ГЧП p3week.ru";

// Начальный путь проверки. "/" - корень сайта. Например, нам надо сканировать не все, что есть на сервере, а только: http://zeos.in/forum/
// Для этого указываем так: $path = "/forum";
$path = "/";

// Название файла со снимком системы. Путь от корня сайта. Директория должна существовать и иметь права CHMOD - 777
// В целях безопасности мы рекомендуем переименовать файл на любое другое название с любым расширением и прописать путь в какую-то глубокую, отдаленную от корня папку.
$snapfile = "/webanalyze/snap.log";

// Список расширений файлов, которые необходимо проверять. "*" или "" - означает любые расширения. Расширения указывать без точек и через символ: |
// Например, $ext = "php|cgi|pl|perl|php3|php4|php5|php6|tpl|js|htaccess|htm|html|css|swf|txt|db|lng";
$ext = "*";

// Список расширений файлов, которые не надо учитывать при проверке. Расширения указывать без точек и через символ: |
// А также можно указывать имена файлов, которые тоже не надо учитывать. Например, $exclfiles = "index.php|jpg"; - здесь не будут учитываться файлы с именами "index.php" и все файлы с расширением JPG
$exclfiles = "jpg|jpeg|gif|bmp|png|tmp|gz|xml|flv|exe|doc|pdf|avi|mp3|mp4|wmv|m4v|m4a|mov|3gp|f4v|3gp|mpg|mpeg|error.php|plg_system_bfstop.log.php";

// Список папок, которые не надо проверять. Путь указывается относительно значения переменной "$path". Разделитель папок символ: |
// Например, $excldirs = "/folder|/files/web"; - здесь папки: http://zeos.in/folder и http://zeos.in/files/web сканер будет пропускать.
$excldirs = "/antv|/cache|/managed_cache/MYSQL";

// Укажите адрес электронной почты. Можно указать несколько через разделитель: |
$yourmail = "proekt@inetsys.ru";

// Пароль для создания снимка системы. Если Вы хотите запретить запуск антивируса по ссылке "http://Ваш_домен/путь_к_файлу_антивируса/название_файла_антивируса.php?mode=2&pass=1234567" то закомментируйте строчку, поставив перед ней два символа: //
$password = "Funrar3Inhy";

// Лимит времени на выполнение скрипта.
$mt = 600;
////////////////////////////////////////////////////////////////////////////////






















































////////////////////////////////////////////////////////////////////////////////
@error_reporting ( 0 ); // 2047 или E_ALL - вывод всех возможных ошибок.

if ( $mode == 0 ) die ();

$docroot = checkpath ( trim ( $docroot ) );
$script_filename = $docroot . checkpath ( trim ( $script_filename ) );
$allfiles = 0;
$timelimit = "";

if( !isset ( $mt ) || trim ( $mt ) == "" ) $mt = 0;

if ( $mt != 0 ) $mt = $mt - 2;

function dirListing ( $dir ) {
	global $exclfiles, $excldirs, $ext, $snapfile, $mt, $st, $timelimit, $allfiles, $docroot, $script_filename;

	$exclfiles = midtrim ( $exclfiles );
	$excldirs = midtrim ( $excldirs );
	$excldirs = checkpath ( $excldirs );
	$ext = midtrim ( $ext );
	$sfile = explode ( "/", $snapfile );
	$sfile = $sfile[count ( $sfile ) - 1];

	if ( $handle = opendir ( $dir ) ) {
		while ( false !== ( $file = readdir ( $handle ) ) ) {
			if ( $file != "." && $file != ".." ) {
				if ( is_dir ( $dir . "/" . $file ) ) {
					if ( !preg_match ( "#" . $excldirs . "#i", $dir . "/" . $file ) || $excldirs == "" ) @$snap .= dirListing ( $dir . "/" . $file );
				} else {
					if ( ( !preg_match ( "#" . $exclfiles . "#i", $file ) || $exclfiles == "" ) && $file != $sfile && $file != $sfile . ".tmp" && $file != $sfile . ".pid" && $dir . "/" . $file != $script_filename ) {
						if ( preg_match ( "#.*\.(" . $ext . ")#i", $file ) || $ext == "" ) {
							$allfiles++;
							$s = filesize ( $dir . "/" . $file );
							$t = filemtime ( $dir . "/" . $file );
							$h = md5_file ( $dir . "/" . $file );
							@$snap .= $dir . "/" . $file . "|" . $s . "|" . $t . "|" . $h . "\n";
							$nt = date ( "U" ) - $st;

							if ( $nt > $mt && $mt != 0 ) {
								$timelimit = "Некоторые файлы не были обработаны из-за превышения лимита времени (" . ( $mt + 2 ) . " сек.)";
								return $snap;
							}
						}
					}
				}
			}
		}

		closedir ( $handle );
	}

	return $snap;
}

function recSnap ( $snap, $istmp = false ) {
	global $snapfile, $docroot;

	$file = $docroot . $snapfile;

	if ( $istmp ) $file .= ".tmp";

	$f = fopen ( $file, "w" );
	fputs ( $f, $snap );
	fclose ( $f );
}

function checkSnap ( $snap ) {
	global $snapfile, $docroot;

	recSnap ( $snap, true );
	$snap = file_get_contents ( $docroot . $snapfile . ".tmp" );
	$fsnap = file_get_contents ( $docroot . $snapfile );
	$msnap = md5 ( $snap );
	$mfsnap = md5 ( $fsnap );

	if ( $msnap == $mfsnap ) {
		@unlink ( $docroot . $snapfile . ".tmp" );
		return 0;
	} else {
		$snaparr = explode ( "\n", $snap );
		$fsnaparr = explode ( "\n", $fsnap );
		$diff = array_diff ( $fsnaparr, $snaparr );
		$diff = array_unique ( $diff );
		$err = "";

		foreach ( $diff as $e ) {
			$e = explode ( "|", $e );
			$err .= $e[0] . "\n";
		}

		$diff = array_diff ( $snaparr, $fsnaparr );

		foreach ( $diff as $s ) {
			$elems = explode ( "|", $s );

			if ( strstr ( $fsnap, $elems[0] ) ) {
				if ( strstr ( $err, $elems[0] . "\n" ) ) {
					$err = str_replace ( $elems[0] . "\n", "Изменен файл: " . $elems[0] . "\n", $err );
				}
			} elseif ( $elems[0] != "" ) {
				$err .= "Добавлен файл: " . $elems[0] . "\n";
			}
		}

		unset ( $diff );
		$err = explode ( "\n", trim ( $err ) );
		$errors = "";

		foreach ( $err as $e ) {
			if ( substr ( $e, 0, 1 ) != "И" && substr ( $e, 0, 1 ) != "Д" && $e != "" ) $errors .= "Удален файл: " . $e . "\n";
			else $errors .= $e . "\n";
		}

		unset ( $err );
		$errors = str_replace ( $docroot, "", $errors );
		@unlink ( $docroot . $snapfile . ".tmp" );
		return $errors;
	}
}

function mailfromsite ( $buffer, $subject, $mail ) {
	global $path, $docroot, $sitename;

	$sitepath = str_replace ( $docroot, "", $path );
	$from_email = $mail;
	$email = $mail;

	if ( trim ( $sitename ) != "" ) $from_email = mime_encode ( $sitename, "windows-1251" ) . " <" . $from_email . ">";
	else $from_email = "<" . $from_email . ">";

	$buffer = str_replace ( "\r", "", $buffer );
	$headers = "From: " . $from_email . "\r\n";
	$headers .= "X-Mailer: ZEOS ANTIVIRUS\r\n";
	$headers .= "Content-Type: text/plain; charset=windows-1251\r\n";
	$headers .= "Content-Transfer-Encoding: 8bit\r\n";
	$headers .= "X-Priority: 1 (Highest)";

	return mail ( $email, mime_encode ( $subject, 'windows-1251' ), $buffer, $headers );
}

function mime_encode ( $text, $charset ) {
	return "=?" . $charset . "?B?" . base64_encode ( $text ) . "?=";
}

function midtrim ( $str ) {
	$str = trim ( $str );

	while ( strpos ( $str, "||" ) ) $str = str_replace ( "||", "|", $str );

	if ( substr ( $str, 0, 1 ) == "|" ) $str = substr ( $str, 1, strlen ( $str ) - 1 );

	if ( substr ( $str, strlen ( $str ) - 1, 1 ) == "|" ) $str = substr ( $str, 0, strlen ( $str ) - 1 );

	$str = explode ( "|", $str );
	$cs = count ( $str );

	for ( $i = 0; $i < $cs; $i++ ) {
		$str[$i] = trim ( $str[$i] );
	}

	$str = implode ( "|", $str );
	return $str;
}

function checkpath ( $str ) {
	$str = explode ( "|", $str );
	$cs = count ( $str );

	for ( $i = 0; $i < $cs; $i++ ) {
		if ( substr ( $str[$i], 0, 1 ) != "/" ) $str[$i] = "/" . $str[$i];

		if ( substr ( $str[$i], strlen ( $str[$i] ) - 1, 1 ) == "/" ) $str[$i] = substr ( $str[$i], 0, strlen ( $str[$i] ) - 1 );
	}

	$str = implode ( "|", $str );
	return $str;
}

class Thread {
	function RegisterPID ( $pidFile ) {
		if ( $fp = fopen ( $pidFile, 'w' ) ) {
			fwrite ( $fp, " " );
			fclose ( $fp );
			@chmod ( $pidFile, 0777 );
			return true;
		}

		return false;
	}

	function CheckPID ( $pidFile ) {
		if ( file_exists ( $pidFile ) ) return true;
		return false;
	}

	function KillPID ( $pidFile ) {
		if ( file_exists ( $pidFile ) ) @unlink ( $pidFile );
	}
}

header ( 'Content-type: text/html; charset=windows-1251' );
$thread = new Thread ();

if ( trim ( $snapfile ) == "" ) die ( "Название файла со снимком системы не может быть пустым!" );

$snapfile = checkpath ( $snapfile );

if ( file_exists ( $docroot . $snapfile . ".pid" ) && date ( "U" ) - filemtime ( $docroot . $snapfile . ".pid" ) > 86400 ) @unlink ( $docroot . $snapfile . ".pid" );

if ( $mode != 0 && $mode != 1 ) die ( 'Неправильный режим. Установите переменную $mode в 0 или 1' );

if ( isset ( $password ) ) {
	if ( isset ( $_GET['mode'] ) ) {
		$vmode = $_GET['mode'];

		if ( $vmode == 2 ) {
			if ( isset ( $_GET['pass'] ) ) $pass = $_GET['pass'];
			else $pass = "";

			if ( $pass === $password ) $mode = 2;
			else {
				print ( "<font color=\"red\">Неверный пароль!</font><br /><form method=\"get\"><input type=\"hidden\" name=\"mode\" value=\"2\"/>Введите пароль: <input type=\"password\" name=\"pass\"/><input type=\"submit\" value=\"Отправить\"/></form>" );
				die ();
			}
		} else die ();
	}
}

if ( $ext == "*" ) $ext = "";

$path = checkpath ( $path );
$spath = explode ( "/", $snapfile );
$snappath = "";
$csn = count ( $spath );

for ( $i = 1; $i < $csn - 1; $i++ ) {
	$snappath .= "/" . $spath[$i];
}

if ( substr ( sprintf ( '%o', fileperms ( $docroot . $snappath ) ), -3 ) != 777 && $mode == 2 ) die ( "У Вас нет прав для записи файла: " . $snapfile );

if ( $thread->CheckPID ( $docroot . $snapfile . ".pid" ) ) die ( "Антивирус уже запущен и выполняется, дождитесь окончания работы." );

$thread->RegisterPID ( $docroot . $snapfile . ".pid" );

switch ( $mode ) {
	case '1':
		if ( !file_exists ( $docroot . $snapfile ) ) $res = "Файл со снимком системы не создан или удален. Запустите программу в режиме 2";
		else {
			$st = date ( "U" );
			$path = $docroot . $path;
			$snap = dirListing ( $path );
			$res = checkSnap ( $snap );

			if ( $timelimit != "" ) $res .= $timelimit;

			$et = date ( "U" );
			$wtime = $et - $st;

			if ( $wtime == 0 ) $wtime = 1;

			if ( $wtime > 60 ) $wtime = floor ( $wtime / 60 ) . " мин. " . ( $wtime%60 );
		}

		if ( $res === 0 ) echo "Различия не найдены | " . date ( "d.m.Y в H:i:s" ) . " | Время сканирования: " . $wtime . " сек. | Всего файлов: " . $allfiles;
		else {
			echo nl2br ( $res );
			$yourmail = midtrim ( $yourmail );
			$mails = explode ( "|", $yourmail );

			foreach ( $mails as $m ) {
				mailfromsite ( $res, "На сайте изменены файлы", $m );
			}
		}

		$thread->KillPID ( $docroot . $snapfile . ".pid" );
		break;
	case '2':
		$st = date ( "U" );
		$path = $docroot . $path;
		$snap = dirListing ( $path );
		recSnap ( $snap );
		unset ( $snap );
		$et = date ( "U" );
		$wtime = $et - $st;

		if ( $wtime == 0 ) $wtime = 1;

		if ( $wtime > 60 ) $wtime = floor ( $wtime / 60 ) . " мин. " . ( $wtime%60 );

		$res = "Снимок системы записан в файл: " . $snapfile . " | " . date ( "d.m.Y в H:i:s" ) . " | Время сканирования: " . $wtime . " сек. | Всего файлов: " . $allfiles;

		if ( $timelimit != "" ) $res .= "\n" . $timelimit;

		echo nl2br ( $res );
		$yourmail = midtrim ( $yourmail );
		$mails = explode ( "|", $yourmail );

		foreach ( $mails as $m ) {
			mailfromsite ( $res, "Создан снимок системы", $m );
		}

		$thread->KillPID ( $docroot . $snapfile . ".pid" );
		break;
}
////////////////////////////////////////////////////////////////////////////////
?>