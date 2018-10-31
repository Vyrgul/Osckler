<?php
	$tokenBot = '716763266:AAHdrzafV-QvMtRAQF0BwgBMVvtVrS6aqUA';
	$urlApi = 'https://api.telegram.org/bot'.$tokenBot.'/';

	function processarMsg($message){
		$chat_id = $message['chat']['id'];
//apiRequest('sendMessage', array('chat_id' => $chat_id, 'text' => $message['reply_to_message']));
		$message_id = $message['message_id'];
		$user_id = $message['from']['id'];

		//if($chat_id == 538743041){
		//apiRequest('sendMessage', array('chat_id' => $chat_id, 'parse_mode' => 'Markdown', 'text' => $message));
		//}

		if(isset($message['text'])){

			$arquivo = "logs.txt";
			$fp = fopen($arquivo, "a+");
			fwrite($fp, $message['from']['first_name'].' => '.$message['text']."\n\r");
			fclose($fp);

			$comando = explode(' ', $message['text'])[0];

			$resto = trim(str_replace($comando, '', $message['text']));

			switch (strtolower($comando)){
				case '/start':
					apiRequest('sendChatAction', array('chat_id' => $chat_id, 'action' => 'typing'));
					apiRequest('sendMessage', array('chat_id' => $chat_id, 'parse_mode' => 'Markdown', 'text' => 'Olá *'.$message['from']['first_name'].'*, Ainda estou em desenvolvimento :c', 'reply_markup'));
				break;

				case '!purge':
					$getChatMember = apiRequest('getChatMember', array('chat_id' => $chat_id, 'user_id' => $user_id));
					$json = json_decode($getChatMember, true);
					if($json['result']['status'] == 'creator' || $json['result']['status'] == 'administrator'){
        if(isset($message['reply_to_message']['message_id'])){
						for($i = $message['reply_to_message']['message_id']; $i < $message_id; $i++) { 
						apiRequest('deleteMessage', array('chat_id' => $chat_id, 'message_id' => $i));
						}
						apiRequest('sendChatAction', array('chat_id' => $chat_id, 'action' => 'typing'));
						apiRequest('sendMessage', array('chat_id' => $chat_id, 'parse_mode' => 'Markdown', 'text' => '*Purge finalizado*'));
        }else{
       		apiRequest('sendChatAction', array('chat_id' => $chat_id, 'action' => 'typing'));
						apiRequest('sendMessage', array('chat_id' => $chat_id, 'parse_mode' => 'Markdown', 'text' => '*Purge não finalizado*, Você deve usar o comando respondendo a alguma mensagem.'));
        }
					}else{
						apiRequest('sendChatAction', array('chat_id' => $chat_id, 'action' => 'typing'));
						apiRequest('sendMessage', array('chat_id' => $chat_id, 'parse_mode' => 'Markdown', 'text' => 'Oops.. Você *não tem permissão* para executar o comando :('));
					}
				break;
						
				case '!promover':
				if(strlen($resto) >= 5){
					$user_from_id = $resto;
				}else{
					$user_from_id = $message['reply_to_message']['from']['id'];
				}
				$getChatMember = apiRequest('getChatMember', array('chat_id' => $chat_id, 'user_id' => $user_id));
				$json = json_decode($getChatMember, true);
				if($json['result']['status'] == 'creator' || $json['result']['status'] == 'administrator' && $json['result']['can_promote_members'] == true){
					apiRequest('promoteChatMember', array('chat_id' => $chat_id, 'user_id' => $user_from_id, 'can_delete_messages' => true, 'can_restrict_members' => true));
					apiRequest('sendMessage', array('chat_id' => $chat_id, 'parse_mode' => 'Markdown', 'text' => 'Usuário promovido '.PHP_EOL.' +Apagar mensagens '.PHP_EOL.' +Banir usuários'));
				}else{
					apiRequest('sendChatAction', array('chat_id' => $chat_id, 'action' => 'typing'));
					apiRequest('sendMessage', array('chat_id' => $chat_id, 'parse_mode' => 'Markdown', 'text' => 'Oops.. Você *não tem permissão* para executar o comando :('));
				}
				//$getChatMember = apiRequest('getChatMember', array('chat_id' => $chat_id, 'user_id' => $user_from_id));
				//apiRequest('sendMessage', array('chat_id' => $chat_id, 'parse_mode' => 'Markdown', 'text' => $getChatMember));
				break;

				case '!rebaixar':
				if(strlen($resto) >= 5){
					$user_from_id = $resto;
				}else{
					$user_from_id = $message['reply_to_message']['from']['id'];
				}
				$getChatMember = apiRequest('getChatMember', array('chat_id' => $chat_id, 'user_id' => $user_id));
				$json = json_decode($getChatMember, true);
				if($json['result']['status'] == 'creator' || $json['result']['status'] == 'administrator' && $json['result']['can_promote_members'] == true){
					apiRequest('promoteChatMember', array('chat_id' => $chat_id, 'user_id' => $user_from_id));
					apiRequest('sendMessage', array('chat_id' => $chat_id, 'parse_mode' => 'Markdown', 'text' => 'Usuário rebaixado '.PHP_EOL.' -Apagar mensagens '.PHP_EOL.' -Banir usuários'));
				}else{
					apiRequest('sendChatAction', array('chat_id' => $chat_id, 'action' => 'typing'));
					apiRequest('sendMessage', array('chat_id' => $chat_id, 'parse_mode' => 'Markdown', 'text' => 'Oops.. Você *não tem permissão* para executar o comando :('));
				}
				break;

				case '!admins':
					$getChatAdministrators = apiRequest('getChatAdministrators', array('chat_id' => $chat_id));
					$json = json_decode($getChatAdministrators, true);
					$admins = array();
					for($i = 0; $i < count($json['result']); $i++){
						if($json['result'][$i]['status'] == 'creator'){
							$creator = $json['result'][$i]['user']['first_name'];
						}else{
							$admins[] = $json['result'][$i]['user']['first_name'];
						}
					}
					apiRequest('sendMessage', array('chat_id' => $chat_id, 'parse_mode' => 'Markdown', 'text' => '*Criador:* '.$creator."\r\n\r\n".'*Administradores:* '.implode("\r\n", $admins)."\r\n\r\n".'*Moderadores:* em breve.'));
				break;

				case '!sair_bot':
				apiRequest('sendMessage', array('chat_id' => $chat_id, 'parse_mode' => 'Markdown', 'text' => '*Estou deixando este chat..* Até mais.'));
				apiRequest('leaveChat', array('chat_id' => $chat_id));
				break;

				default:
				// apiRequest('sendMessage', array('chat_id' => $chat_id, 'text' => '\u{1F914}'));

				/*$arquivo = 'logs.txt';
			    $fp = fopen($arquivo, 'a+');
			    fwrite($fp, ''.'\n\r');
			    fclose($fp);*/
				}
	 		}else{
	 			//apiRequest('sendChatAction', array('chat_id' => $chat_id, 'action' => 'typing'));
	     		//apiRequest('sendMessage', array('chat_id' => $chat_id, 'parse_mode' => 'Markdown', 'text' => '*Olá*'));
	 		}
	}
	function apiRequest($method, $parameters){
		$options = array(
			'http' => array(
			'method'  => 'POST',
			'content' => json_encode($parameters),
			'header' => 'Content-Type: application/json'
		));
		$context  = stream_context_create($options);
		return (file_get_contents($GLOBALS['urlApi'].$method, false, $context));
	}
	$update_response = file_get_contents('php://input');
	$update = json_decode($update_response, true);
	if(isset($update['message'])){
		processarMsg($update['message']);
	}
