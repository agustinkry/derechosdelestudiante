<?php

class UtlText {

	public static function validateEmail($email) {
		$regex = "/^([a-z0-9+_]|\-|\.)+@(([a-z0-9_]|\-)+\.)+[a-z]{2,6}$/i";
		if (strpos($email, '@') !== false && strpos($email, '.') !== false) {
			if (preg_match($regex, $email)) {
				return true;
			} else {
				return false;
			}
		} else {
			return false;
		}
	}

	public static function validateIp($ip) {
		$val_0_to_255 = "(25[012345]|2[01234]\d|[01]?\d\d?)";
		$reg = "#^($val_0_to_255\.$val_0_to_255\.$val_0_to_255\.$val_0_to_255)$#";

		if (preg_match($reg, $ip)) {
			return true;
		} else {
			return false;
		}
	}

	public static function generarToken($largo = 50) {
		$tokenLimpio = '';
		$cadena = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789';

		for ($i = 1; $i <= $largo; $i++) {
			$tokenLimpio .= substr($cadena, rand(0, 61), 1);
		}
		return md5($tokenLimpio);
	}
	
	public static function printFileReport($file_url, $file_bytes)
	{
		echo "<li>";
		echo "Archivo creado de $file_bytes bytes <BR>";
		echo "<a href='$file_url' target='_blank' title='Abrir en ventana nueva' alt='Abrir en ventana nueva'>$file_url</a>";
		echo "<BR>";
	}

	public static function cut($text = '', $length = 80)
	{
		$newText = '';
		$text = strip_tags($text);
		if (strlen($text) > $length) {
			$arrayText = explode(' ', $text);
			$counter = 0;
			$final = (strlen($text) > $length) ? '...' : '';
			while ($length >= strlen($newText) + strlen($arrayText[$counter])) {
				$newText .= ' '.$arrayText[$counter];
				++$counter;
			}
			$newText .= $final;
			return $newText;
		} else {
			return $text;
		}
	}

	public static function optimize($text, $length = 0, $brAllowed = true)
	{
		if ($length > 0) $text = self::cut($text, $length);
		if ($brAllowed) $text = nl2br($text);
		//$text = str_replace("&apos;", "'", $text);
		//$text = utf8_encode(stripslashes($text));
		$text = stripslashes($text);
		return $text;
	}

	public static function sanitizeOutput($text, $length = 0, $brAllowed = false)
	{
		$text = stripslashes(htmlentities(utf8_decode($text)));
		if ($length > 0) $text = self::cut($text, $length);
		if ($brAllowed) $text = nl2br($text);
		return $text;
	}

	public static function cleanHtml($text, $length = 0)
	{
		//$text = eregi_replace("(SIZE=\")([0-9]{1,2})(\")", "style=\"font-size:\\2px\"", stripslashes($text)); // DEPRECATED
		$text = preg_replace('/(SIZE=")([0-9]{1,2})(")/', '', stripslashes($text));
		//$text = preg_replace('/(<\/?)(\w+)([^>]*>)/', '', stripslashes($text));
		$text = str_ireplace('LETTERSPACING="0"', '', $text);
		$text = str_ireplace('<p ', '<parrafo ', $text);
		$text = str_ireplace('</p>', '</parrafo><br />', $text);
		$text = str_ireplace(' FACE="tahoma"', '', $text);
		$text = str_ireplace(' COLOR="#666666"', '', $text);
		$text = str_ireplace(' COLOR="#0000FF"', '', $text);
		$text = str_ireplace('13px', '11px', $text);
		$text = str_ireplace(' face="Verdana"', '', $text);
		$text = str_ireplace(' color="#000000"', '', $text);
        $text = str_ireplace('&apos;', "'", $text);//Estoy sirve para IE
		//$text = self::optimize($text, $length);
		if ($length > 0)
			$text = self::cut($text, $length);
		return $text;
	}

	public static function urlOptimize($text, $excludeChars = 'a-zA-Z0-9_')
	{
		$text = trim($text);
		$text = self::noAccents($text);
		$text = preg_replace("/[^$excludeChars ]/", '', $text);
		$text = str_replace(' ', '-', $text);
		$text = strtolower($text);
		return $text;
	}

	public static function noAccents($text)
	{
		$text = str_replace('á', 'a',  $text);
		$text = str_replace('é', 'e',  $text);
		$text = str_replace('í', 'i',  $text);
		$text = str_replace('ó', 'o',  $text);
		$text = str_replace('ú', 'u',  $text);
		$text = str_replace('Á', 'A',  $text);
		$text = str_replace('É', 'E',  $text);
		$text = str_replace('Í', 'I',  $text);
		$text = str_replace('Ó', 'O',  $text);
		$text = str_replace('Ú', 'U',  $text);
		$text = str_replace('ñ', 'n',  $text);
		$text = str_replace('Ñ', 'N',  $text);
		return $text;
	}

	public static function removeLastChar($text, $charToRemove)
	{
		if (strrpos($text, $charToRemove) == strlen($text) - 1)
			$text = substr_replace($text, '', strlen($text) - 1);
		return $text;
	}

	public static function toUpper($text)
	{
		$text = strtoupper($text);
		$text = str_replace('�', '&Aacute;', $text);
		$text = str_replace('�', '&Eacute;', $text);
		$text = str_replace('�', '&Iacute;', $text);
		$text = str_replace('�', '&Oacute;', $text);
		$text = str_replace('�', '&Uacute;', $text);
		$text = str_replace('�', '&Ntilde;', $text);
		return $text;
	}

	public static function toLower($text)
	{
		$text = strtolower($text);
		$text = str_replace('�', '&aacute;', $text);
		$text = str_replace('�', '&eacute;', $text);
		$text = str_replace('�', '&iacute;', $text);
		$text = str_replace('�', '&oacute;', $text);
		$text = str_replace('�', '&uacute;', $text);
		$text = str_replace('�', '&ntilde;', $text);
		return $text;
	}

	public static function getJSText($requestName, $methodPost = true)
	{
		$DATA = ($methodPost) ? $_POST : $_GET;
		$str_return = utf8_encode(urldecode($DATA[$requestName]));
		// PATCH
		$str_return = str_replace("%u20AC", "€", $str_return);
		return $str_return;
	}

}