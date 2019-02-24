<?php
namespace controllers\internals;

class Incs extends \Controller
{
	/**
	 * Head html
	 */	
	public static function head ()
	{
	return self::render("incs/head");
	}

}
