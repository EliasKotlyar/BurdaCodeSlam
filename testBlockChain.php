<?php
include_once 'vendor/autoload.php';
$chatBotCommunication = new \BurdaCodeSlam\ChatBot\Bot\SimpleCommunication();

$bot1 = new \BurdaCodeSlam\ChatBot\Bot\Chatbot("Bot N1",$chatBotCommunication);
$bot2 = new \BurdaCodeSlam\ChatBot\Bot\Chatbot("Bot N2",$chatBotCommunication);


$blockChain = new \BurdaCodeSlam\ChatBot\Model\BlockChainElement("First Element");
$chatBotCommunication->sendMessage(null,$blockChain);