<?php
namespace BurdaCodeSlam\ChatBot\Bot;

class SimpleCommunication implements ChatBotCommunicationInterface
{

    /**
     * @var array
     */
    protected $handlers = array();

    /**
     * Receive message
     * @param $handler
     */
    public function receiveHandler($handler)
    {
        $this->handlers[] = $handler;
    }

    /**
     * Send Message from Chatbot:
     * @param Chatbot $chatbot
     * @param $message
     */
    public function sendMessage($chatbot, $message)
    {
        foreach ($this->handlers as  $chatBotHandlerObject) {
            if($chatbot === null){
                call_user_func(array($chatBotHandlerObject, "receive"), $message);
                break;
            }
            if ( $chatBotHandlerObject != $chatbot) {
                call_user_func(array($chatBotHandlerObject, "receive"), $message);
                break;
            }
        }
    }


}