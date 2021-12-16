<?php 

class Sanitize 
{
	public static function stringSanitize($string) 
	{
		$result = stripslashes($string);
		$quotes = array('\'', '"', '%');
		$result = str_replace($quotes, '', $result);
		$result = filter_var($result, FILTER_SANITIZE_STRING);
		return $result;
	}
		
	public static function cleanHyphens($string) 
	{
        $string = str_replace(' ', '-', $string); // Replaces all spaces with hyphens.
        $string = preg_replace('/[^A-Za-z0-9\-]/', '', $string); // Removes special chars.
        return preg_replace('/-+/', '-', $string); // Replaces multiple hyphens with single one.
	}

	public static function replaceSpecialChars($text) 
	{
		$utf8 = array(
			'/Ã¡/'    =>   'A',
			'/[áàâãªä]/u'   =>   'a',
			'/[ÁÀÂÃÄ]/u'    =>   'A',			
			'/[ÍÌÎÏ]/u'     =>   'I',
			'/[íìîï]/u'     =>   'i',
			'/[éèêë]/u'     =>   'e',
			'/[ÉÈÊË]/u'     =>   'E',
			'/[óòôõºö]/u'   =>   'o',
			'/[ÓÒÔÕÖ]/u'    =>   'O',
			'/[úùûü]/u'     =>   'u',
			'/[ÚÙÛÜ]/u'     =>   'U',
			'/ç/'           =>   'c',
			'/Ç/'           =>   'C',
			'/ñ/'           =>   'n',
			'/Ñ/'           =>   'N',
			'/–/'           =>   '-', // UTF-8 hyphen to "normal" hyphen
			'/[’‘‹›‚]/u'    =>   ' ', // Literally a single quote
			'/[“”«»„]/u'    =>   ' ', // Double quote
			'/ /'           =>   ' ', // nonbreaking space (equiv. to 0x160)
		);
		return preg_replace(array_keys($utf8), array_values($utf8), $text);
	}

	public static function cleanHyphenizeSpecialChars($string) 
	{
		return
			preg_replace(
				array('#[\\s-]+#', '#[^A-Za-z0-9. -_]+#'),
				array('-', ''),
				urldecode($string)
			);
	}

}

