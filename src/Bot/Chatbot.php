<?php
namespace BurdaCodeSlam\ChatBot\Bot;

use BurdaCodeSlam\ChatBot\Model\BlockChainElement;

/**
 * Class Chatbot
 * @package BurdaCodeSlam\ChatBot\Bot
 */
class Chatbot
{

    /**
     * @var BlockChainElement BlockChain
     */
    protected $blockChain = null;
    /**
     * @var string Name of the Bot
     */
    protected $name;
    /**
     * @var ChatBotCommunicationInterface Communication Interface
     */

    protected $communicationPort;

    /**
     * Chatbot constructor.
     * @param $name
     * @param $communicationPort
     */
    public function __construct($name, $communicationPort)
    {
        $this->setName($name);
        $this->communicationPort = $communicationPort;
        $this->communicationPort->receiveHandler($this);
    }

    /**
     * Receive Message Handler
     * @param $message
     */
    public function receive($message)
    {

        $this->blockChain = $message;
        $count = $this->blockChain->getCount();
        $this->debugMessage('Receiving Blockchain...BlockChain Count' . $count);
        $this->debugMessage( $this->blockChain->toString());

        $this->addNewBlockChainElement(rand(0, 10000));


        if ($count < 10) {
            $this->debugMessage('Sending BlockChain');
            $this->communicationPort->sendMessage($this, $this->blockChain);
        }


    }

    public function debugMessage($message)
    {
        echo "Bot " . $this->getName() . ":" . $message . "\r\n";
    }

    /**
     * Get Name of the Bot
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * set Name of the Bot
     * @param string $name
     */
    public function setName($name)
    {
        $this->name = $name;
    }

    /**
     * Add new Element for BlockChain
     * @param $string
     */
    public function addNewBlockChainElement($string)
    {
        $element = new BlockChainElement($string);
        if ($this->blockChain !== null) {
            $this->blockChain->append($element);
        } else {
            $this->blockChain = $element;
        }

    }


}