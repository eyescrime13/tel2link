<html>
<head>
<meta charset="utf-8" />
<title>
Tel2Link
</title>
<style>
@import url('https://fonts.googleapis.com/css2?family=Noto+Sans&family=Noto+Sans+Mono&display=swap');
body
{
	font-family: 'Noto Sans Mono', monospace;
}
form
{
font-family: 'Noto Sans', sans-serif;
}
</style>
</head>
<body>
<center>
<form method="post" action="https://wildenberg.su/tel2link/">
<input type="text" name="testbot" />
<input type="submit" name="go" value="O. K." />
</form>
<?php

ini_set('error_reporting', 'E_ALL');
ini_set('display_errors', '1');

if($_POST['go'] == 'O. K.'){


function tel_valid($tel){

$tel_valid = "/^\\+?\\d{1,4}?[-.\\s]?\\(?\\d{1,3}?\\)?[-.\\s]?\\d{1,4}[-.\\s]?\\d{1,4}[-.\\s]?\\d{1,9}$/";

if(preg_match($tel_valid, $tel)){

	$tel = preg_replace('/[^0-9]/', '', $tel);
	$tel = ltrim($tel, '0');
	echo 'numéro correct +'.$tel.'';
	echo '<br />';
	echo '<a href="https://wa.me/'.$tel.'" target="_blank">WhatsApp</a>';
	echo '<br />';
	echo '<a href="https://t.me/+'.$tel.'" target="_blank">Telegram</a>';
	echo '<br />';

}else{

	echo 'numéro incorrect '.$tel.'';
	echo '<br />';

	}
}

function tel_code($tel){

$tel_valid = "/^\\+?\\d{1,4}?[-.\\s]?\\(?\\d{1,3}?\\)?[-.\\s]?\\d{1,4}[-.\\s]?\\d{1,4}[-.\\s]?\\d{1,9}$/";

include_once 'telcodes.inc.php';

if(preg_match($tel_valid, $tel)){
	
$tel = preg_replace('/[^0-9]/', '', $tel);
$tel = ltrim($tel, '0');


// $tel_array = [
    //3 digit
    // '353' => 'Irlande',
    //2 digit
    // '32' => 'Belgique',
	// '33' => 'France',
    // '34' => 'Espagne',
	// '41' => 'Suisse',
	// '44' => 'Royaume-Uni',
    // '49' => 'Allemagne',
    //1 digit
    // '1' => 'USA',
// ];

foreach($tel_array as $pays => $code){
	if(str_starts_with($tel, $pays)){
		echo $code;
		echo ' ';
		echo '(+'.$pays.')';
		echo '<br />';
		break;
	}
}

}

}

tel_valid($_POST['testbot']);


tel_code($_POST['testbot']);

echo '<br />';

// $tel = $_POST['testbot'];

// $tel = preg_replace('/[^0-9]/', '', $tel); //33601020304

// $tel = ltrim($tel, '0'); //33601020304

//$tel_array = array('32' => 'Belgique', '33' => 'France', '34' => 'Espagne', '41' => 'Suisse', '44' => 'Royaume-Uni', '49' => 'Allemagne');

// $tel_array = [
    // 3 digit
    // '353' => 'Irlande',
    // 2 digit
    // '32' => 'Belgique',
	// '33' => 'France',
    // '34' => 'Espagne',
	// '41' => 'Suisse',
	// '44' => 'Royaume-Uni',
    // '49' => 'Allemagne',
    //1 digit
    // '1' => 'USA',
// ];

// foreach($tel_array as $pays => $code){
	// if(str_starts_with($tel, $pays)){
		// echo $pays.'_'.$code;
		// break;
	// }
// }

}
?>
</center>
</body>
</html>
