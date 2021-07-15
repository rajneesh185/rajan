<?php if( ! defined('BASEPATH')) exit('No direct script access allowed');
class Openssl_security {
	public function __construct($class = NULL)
	{
		 
	}
	function e($data, $key) { 
		try {
			$iv = substr( hash( 'sha256', 'simple' ), 0, 16 );
			return str_rot13(bin2hex(openssl_encrypt($data,'AES-128-CBC', $key, 0, $iv)).'r22m14r16'.$iv);
		} catch (Exception $e) {
			die('invalid key.');
		}
	}
	 
	function d($data, $key) { 
		try {
			list($data,$iv) = explode('r22m14r16',str_rot13($data));
			return openssl_decrypt(hex2bin($data),'AES-128-CBC',$key, 0, $iv);
		} catch (Exception $e) {
			die('invalid key.');
		}
	}

}