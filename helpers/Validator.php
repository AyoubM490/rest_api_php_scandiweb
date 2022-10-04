<?php
class Validator{
	public static function validSKU($var)
    {
        $pattern = "/^([A-Z0-9]){8}$/";
        if(preg_match($pattern, $var)) return true;
        return false;
    }
    public static function validName($var)
    {
    	$pattern = "/^([A-Za-z0-9\s]){3,}$/";
    	if(preg_match($pattern, $var)) return true;
        return false;
    }
    public static function validNumInp($var)
    {
    	$var = floatval($var);
    	if($var&&$var>0) return true;
		return false;
    }
}
?>