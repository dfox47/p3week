<?php
/*
=====================================================
=====================================================
*/


////////////////////////////////////////////////////////////////////////////////
// 0 - ���������, 1 - ��������.
$mode = 1;

// ���� � ����� �����.
$docroot = "/var/www/p3week/data/www/p3week.ru";

// ���� � ����� ���������� �� ����� �����.
$script_filename = "/webanalyze/analize.php";

// �������� �����.
$sitename = "���� ��� p3week.ru";

// ��������� ���� ��������. "/" - ������ �����. ��������, ��� ���� ����������� �� ���, ��� ���� �� �������, � ������: http://zeos.in/forum/
// ��� ����� ��������� ���: $path = "/forum";
$path = "/";

// �������� ����� �� ������� �������. ���� �� ����� �����. ���������� ������ ������������ � ����� ����� CHMOD - 777
// � ����� ������������ �� ����������� ������������� ���� �� ����� ������ �������� � ����� ����������� � ��������� ���� � �����-�� ��������, ���������� �� ����� �����.
$snapfile = "/webanalyze/snap.log";

// ������ ���������� ������, ������� ���������� ���������. "*" ��� "" - �������� ����� ����������. ���������� ��������� ��� ����� � ����� ������: |
// ��������, $ext = "php|cgi|pl|perl|php3|php4|php5|php6|tpl|js|htaccess|htm|html|css|swf|txt|db|lng";
$ext = "*";

// ������ ���������� ������, ������� �� ���� ��������� ��� ��������. ���������� ��������� ��� ����� � ����� ������: |
// � ����� ����� ��������� ����� ������, ������� ���� �� ���� ���������. ��������, $exclfiles = "index.php|jpg"; - ����� �� ����� ����������� ����� � ������� "index.php" � ��� ����� � ����������� JPG
$exclfiles = "jpg|jpeg|gif|bmp|png|tmp|gz|xml|flv|exe|doc|pdf|avi|mp3|mp4|wmv|m4v|m4a|mov|3gp|f4v|3gp|mpg|mpeg|error.php|plg_system_bfstop.log.php";

// ������ �����, ������� �� ���� ���������. ���� ����������� ������������ �������� ���������� "$path". ����������� ����� ������: |
// ��������, $excldirs = "/folder|/files/web"; - ����� �����: http://zeos.in/folder � http://zeos.in/files/web ������ ����� ����������.
$excldirs = "/antv|/cache|/managed_cache/MYSQL";

// ������� ����� ����������� �����. ����� ������� ��������� ����� �����������: |
$yourmail = "proekt@inetsys.ru";

// ������ ��� �������� ������ �������. ���� �� ������ ��������� ������ ���������� �� ������ "http://���_�����/����_�_�����_����������/��������_�����_����������.php?mode=2&pass=1234567" �� ��������������� �������, �������� ����� ��� ��� �������: //
$password = "Funrar3Inhy";

// ����� ������� �� ���������� �������.
$mt = 600;
////////////////////////////////////////////////////////////////////////////////






















































////////////////////////////////////////////////////////////////////////////////
@error_reporting ( 0 ); // 2047 ��� E_ALL - ����� ���� ��������� ������.

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
								$timelimit = "��������� ����� �� ���� ���������� ��-�� ���������� ������ ������� (" . ( $mt + 2 ) . " ���.)";
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
					$err = str_replace ( $elems[0] . "\n", "������� ����: " . $elems[0] . "\n", $err );
				}
			} elseif ( $elems[0] != "" ) {
				$err .= "�������� ����: " . $elems[0] . "\n";
			}
		}

		unset ( $diff );
		$err = explode ( "\n", trim ( $err ) );
		$errors = "";

		foreach ( $err as $e ) {
			if ( substr ( $e, 0, 1 ) != "�" && substr ( $e, 0, 1 ) != "�" && $e != "" ) $errors .= "������ ����: " . $e . "\n";
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

if ( trim ( $snapfile ) == "" ) die ( "�������� ����� �� ������� ������� �� ����� ���� ������!" );

$snapfile = checkpath ( $snapfile );

if ( file_exists ( $docroot . $snapfile . ".pid" ) && date ( "U" ) - filemtime ( $docroot . $snapfile . ".pid" ) > 86400 ) @unlink ( $docroot . $snapfile . ".pid" );

if ( $mode != 0 && $mode != 1 ) die ( '������������ �����. ���������� ���������� $mode � 0 ��� 1' );

if ( isset ( $password ) ) {
	if ( isset ( $_GET['mode'] ) ) {
		$vmode = $_GET['mode'];

		if ( $vmode == 2 ) {
			if ( isset ( $_GET['pass'] ) ) $pass = $_GET['pass'];
			else $pass = "";

			if ( $pass === $password ) $mode = 2;
			else {
				print ( "<font color=\"red\">�������� ������!</font><br /><form method=\"get\"><input type=\"hidden\" name=\"mode\" value=\"2\"/>������� ������: <input type=\"password\" name=\"pass\"/><input type=\"submit\" value=\"���������\"/></form>" );
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

if ( substr ( sprintf ( '%o', fileperms ( $docroot . $snappath ) ), -3 ) != 777 && $mode == 2 ) die ( "� ��� ��� ���� ��� ������ �����: " . $snapfile );

if ( $thread->CheckPID ( $docroot . $snapfile . ".pid" ) ) die ( "��������� ��� ������� � �����������, ��������� ��������� ������." );

$thread->RegisterPID ( $docroot . $snapfile . ".pid" );

switch ( $mode ) {
	case '1':
		if ( !file_exists ( $docroot . $snapfile ) ) $res = "���� �� ������� ������� �� ������ ��� ������. ��������� ��������� � ������ 2";
		else {
			$st = date ( "U" );
			$path = $docroot . $path;
			$snap = dirListing ( $path );
			$res = checkSnap ( $snap );

			if ( $timelimit != "" ) $res .= $timelimit;

			$et = date ( "U" );
			$wtime = $et - $st;

			if ( $wtime == 0 ) $wtime = 1;

			if ( $wtime > 60 ) $wtime = floor ( $wtime / 60 ) . " ���. " . ( $wtime%60 );
		}

		if ( $res === 0 ) echo "�������� �� ������� | " . date ( "d.m.Y � H:i:s" ) . " | ����� ������������: " . $wtime . " ���. | ����� ������: " . $allfiles;
		else {
			echo nl2br ( $res );
			$yourmail = midtrim ( $yourmail );
			$mails = explode ( "|", $yourmail );

			foreach ( $mails as $m ) {
				mailfromsite ( $res, "�� ����� �������� �����", $m );
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

		if ( $wtime > 60 ) $wtime = floor ( $wtime / 60 ) . " ���. " . ( $wtime%60 );

		$res = "������ ������� ������� � ����: " . $snapfile . " | " . date ( "d.m.Y � H:i:s" ) . " | ����� ������������: " . $wtime . " ���. | ����� ������: " . $allfiles;

		if ( $timelimit != "" ) $res .= "\n" . $timelimit;

		echo nl2br ( $res );
		$yourmail = midtrim ( $yourmail );
		$mails = explode ( "|", $yourmail );

		foreach ( $mails as $m ) {
			mailfromsite ( $res, "������ ������ �������", $m );
		}

		$thread->KillPID ( $docroot . $snapfile . ".pid" );
		break;
}
////////////////////////////////////////////////////////////////////////////////
?>