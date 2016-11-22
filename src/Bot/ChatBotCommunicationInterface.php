<?php
namespace BurdaCodeSlam\ChatBot\Bot;
use BurdaCodeSlam\ChatBot\Model\BlockChainElement;
/**
 * Interface ChatBotCommunicationInterface
 * @package BurdaCodeSlam\ChatBot\Bot
 */
interface ChatBotCommunicationInterface{

    /**
     * @param Chatbot $chatBot
     * @param $handler
     * @return ChatBotCommunicationInterface
     */
    public function receiveHandler($handler);

    /**
     * @param Chatbot $chatBot
     * @param BlockChainElement $message
     * @return ChatBotCommunicationInterface
     */
    public function sendMessage($chatBot,$message);
}