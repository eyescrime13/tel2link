<?php
$content = file_get_contents('php://input');
file_put_contents('message.txt', $content);

define('TOKEN', '2010769306:AAFaW_0eb_sMUAt7yh-t5ditzqfzRFZo-WA');

// fonction qui envoie un message à l'utilisateur
function sendMessage($chat_id, $text) {
    $q = http_build_query([
        'chat_id' => $chat_id,
		'parse_mode' => 'HTML',
		'disable_web_page_preview' => 1,
        'text' => $text
        ]);
    file_get_contents('https://api.telegram.org/bot'.TOKEN.'/sendMessage?'.$q);
}
//  $data = [         
// 			   'chat_id' => $chat_id,           
//             'parse_mode' => 'HTML',
//             'disable_web_page_preview' => 1,      // set to true which disables the preview
//             'text'    => $message, 
// 			];

// récupération des données envoyées par Telegram
//$content = file_get_contents('php://input');
$update = json_decode($content, true);

// l'utilisateur contacte le bot
if(preg_match('/^\/start/', $update['message']['text'])) {
    sendMessage($update['message']['chat']['id'], 'Bonjour '.$update['message']['from']['username'].' !');
    sendMessage($update['message']['chat']['id'], 'Envoyez un numéro de téléphone précédé de /wa afin d\' obtenir le lien vers son WhatsApp');
    sendMessage($update['message']['chat']['id'], 'Envoyez un numéro de téléphone précédé de /tg afin d\' obtenir le lien vers son Telegram');
    sendMessage($update['message']['chat']['id'], 'Merci d\'entrer les numéros de téléphone au format international avec le + devant (sans le 00)');
    sendMessage($update['message']['chat']['id'], 'Exemple : +33 6 12 34 56 78');

}elseif(preg_match('/^\/wa/', $update['message']['text'])) {

	$tel_wa = preg_replace('/[^0-9]/', '', $update['message']['text']);
	$tel_wa = ltrim($tel_wa, "0");
	sendMessage($update['message']['chat']['id'], 'https://wa.me/'.$tel_wa.'');


//  sendMessage($update['message']['chat']['id'], 'whatsapp://send?phone='.$tel_wa.'');
//  sendMessage($update['message']['chat']['id'], '<a href="whatsapp://send?phone='.$tel_wa.'">WhatsApp '.$tel_wa.'</a>');
//  sendMessage($update['message']['chat']['id'], '[WhatsApp](whatsapp://send?phone='.$tel_wa.')');

	// function tel_valid($tel){
	// $tel_valid = "/^\\+?\\d{1,4}?[-.\\s]?\\(?\\d{1,3}?\\)?[-.\\s]?\\d{1,4}[-.\\s]?\\d{1,4}[-.\\s]?\\d{1,9}$/";
	// if(preg_match($tel_valid, $tel)){
	// $tel = preg_replace('/[^0-9]/', '', $tel);
    // sendMessage($update['message']['chat']['id'], 'Test O. K.');
	// }else{
	// sendMessage($update['message']['chat']['id'], 'Numéro incorrect');
	// }
	// }
//	tel_valid($update['message']['text']);

}elseif(preg_match('/^\/tg/', $update['message']['text'])){

	$tel_tg = preg_replace('/[^0-9+]/', '', $update['message']['text']);
    sendMessage($update['message']['chat']['id'], 'https://t.me/'.$tel_tg.'');

}elseif(preg_match('/^\/liste/', $update['message']['text'])){

function tel_valid($tel){

$tel_valid = "/^\\+?\\d{1,4}?[-.\\s]?\\(?\\d{1,3}?\\)?[-.\\s]?\\d{1,4}[-.\\s]?\\d{1,4}[-.\\s]?\\d{1,9}$/";

if(preg_match($tel_valid, $tel)){

	$tel = preg_replace('/[^0-9]/', '', $tel);
	$tel = ltrim($tel, '0');
	sendMessage($update['message']['chat']['id'], 'numéro correct '.$tel.'');

}else{
	
	$tel = preg_replace('/[^0-9]/', '', $tel);
	$tel = ltrim($tel, '0');
	sendMessage($update['message']['chat']['id'], 'numéro incorrect '.$tel.'');

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
		echo $pays.'_'.$code;
		sendMessage($update['message']['chat']['id'], ''.$code.' (+'.$pays.')');
		break;
	}
}

}

}

tel_valid($_POST['testbot']);

tel_code($_POST['testbot']);

}else{
    sendMessage($update['message']['chat']['id'], 'Commande incorrecte');
}
?>