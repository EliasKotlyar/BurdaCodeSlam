<?php
namespace BurdaCodeSlam\ChatBot\Bot;

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
     * @param $message
     * @return ChatBotCommunicationInterface
     */
    public function sendMessage($chatBot,$message);
}