<?php

/**
 *
 * Copyright 2011-2013, Museu Exploratório de Ciências da Unicamp (http://www.museudeciencias.com.br)
 *
 * Licensed under The MIT License
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright 2011-2013, Museu Exploratório de Ciências da Unicamp (http://www.museudeciencias.com.br)
 * @license       MIT License (http://www.opensource.org/licenses/mit-license.php)
 * @link          https://github.com/museudecienciasunicamp/mexc_lectures.git Mexc Lectures public repository
 */

class MexcSearchComponent extends Object
{
	function parseSearchString($string)
	{
		$parsed = array();
		$pieces = array_map('trim', explode(',', $string));
		foreach ($pieces as $string)
		{
			$type = 0;
			if (strpos($string, ':') !== false)
				list($type, $string) = explode(':', $string);
			$parsed[$type][] = $string;
		}
		return $parsed;
	}
}
