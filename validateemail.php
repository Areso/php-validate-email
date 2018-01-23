<?php
header('Content-type: text/plain; charset=utf-8');
//$email = $_GET['email'];
$email = $_POST['email'];
$allowedSymbols = array('a', 'b', 'c', 'd', 'e', 'f', 'g', 'h', 'i', 
	'j', 'k', 'l', 'm', 'n', 'o', 'p', 'q', 'r', 's', 't', 'u', 'v', 
	'w', 'x', 'y', 'z', 'A', 'B', 'C', 'D', 'E', 'F', 'G', 'H', 'I', 
	'J', 'K', 'L', 'M', 'N', 'O', 'P', 'Q', 'R', 'S', 'T', 'U', 'V', 
	'W', 'X', 'Y', 'Z', '0', '1', '2', '3', '4', '5', '6', '7', '8',
	'9', '.', '-');
$additionalSymbolsForLocalPart = array('_', '+');
$allowedSymbolsLocal = array_merge($allowedSymbols, $additionalSymbolsForLocalPart);
$firstProhibited = array('.', '-', '_', '+');
$findme          = '@';
$dotSymbolPos    = strpos($email, $findme);
if ($dotSymbolPos === False) {
	echo "неправильный адрес, пропущена собачка";
	return;
}
$emailLength  = strlen($email);
//echo $dotSymbolPos;
//return;
$localPart    = substr($email, 0, $dotSymbolPos);
//echo $localPart;
//return;
if (strlen($localPart) == 0) {
	echo "неправильный адрес, имя ящика не указано";
	return;
}
$localPartArray = str_split($localPart);
//echo $localPartArray[0];
//return;
foreach ($localPartArray as $symbol) {
	if (in_array($symbol, $allowedSymbolsLocal) === False) {
		echo "неправильный адрес, имя ящика содержит недоп символы";
		return;
	}
}
if (in_array($localPartArray[0], $firstProhibited) == True) {
	echo "неправильный адрес, имя ящика не может так начинаться";
	return;
}
$domainPart      = substr($email, $dotSymbolPos+1);
$domainPartArray = str_split($domainPart);
if (strlen($domainPart) == 0) {
	echo "неправильный адрес, имя домена не указано";
	return;
}
foreach ($domainPartArray as $symbol) {
	if (in_array($symbol, $allowedSymbols) == False) {
		echo "неправильный адрес, имя домена содержит недоп символы";
		return;
	}
}
if (in_array($domainPartArray[0], $firstProhibited) == True) {
	echo "неправильный адрес, имя домена не может так начинаться";
	return;
}
//TODO 
//add checking dots in domain part (at least one) or more
//add support IPv4, IPv6 as domain
//check exception localhost as domain 
//add localisation
//add checking domains at least 2 symbols long  
echo $email; 
?>
