<?php
require 'vendor/autoload.php';
use PhpSlackBot\Bot;
use BurdaCodeSlam\ChatBot\Bot\ChatBotCommunicationInterface;

// This special command executes on all events
class SuperCommand extends \PhpSlackBot\Command\BaseCommand implements ChatBotCommunicationInterface
{
    /**
     * @var string
     */
    protected $handler;

    /**
     * @var string
     */
    protected $chatBotHandlerObject;

    /**
     * @var string
     */
    protected $toMessage;

    /**
     * @return mixed
     */
    public function getToMessage()
    {
        return $this->toMessage;
    }

    /**
     * @param mixed $toMessage
     */
    public function setToMessage($toMessage)
    {
        $this->toMessage = $toMessage;
    }

    /**
     * @param \BurdaCodeSlam\ChatBot\Bot\Chatbot $chatBot
     * @param $handler
     * @return ChatBotCommunicationInterface
     */
    public function receiveHandler($handler)
    {
        $this->handler = $handler;
    }

    /**
     * @param \BurdaCodeSlam\ChatBot\Bot\Chatbot $chatBot
     * @param $message
     * @return ChatBotCommunicationInterface
     */
    public function sendMessage($chatBot, $message)
    {
        $channelName = $channel->getChannelIdFromChannelName();
        $this->send($this->toMessage, $channel, $message->toString());
    }

    /**
     * @return mixed
     */
    public function getChatBotHandlerObject()
    {
        return $this->chatBotHandlerObject;
    }

    /**
     * @param mixed $chatBotHandlerObject
     */
    public function setChatBotHandlerObject($chatBotHandlerObject)
    {
        $this->chatBotHandlerObject = $chatBotHandlerObject;
    }

    protected function configure()
    {
// We don't have to configure a command name in this case
    }

    protected function execute($data, $context)
    {
        if (!isset($data['type'])) {
            return;
        }
        if ($data['type'] == 'message') {
            $channel = $this->getChannelNameFromChannelId($data['channel']);
            $username = $this->getUserNameFromUserId($data['user']);
            echo $username . ' from ' . ($channel ? $channel : 'DIRECT MESSAGE') . ' : ' . $data['text'] . PHP_EOL;

            try {
                $data = @unserialize(base64_decode($data['text']));
                call_user_func(array($this->chatBotHandlerObject, "receive"), $data);
            } catch (Exception $e) {

            }

        }
    }
}

$bot = new Bot();
$bot->setToken('xoxb' . '-107306355601' . '-TfaDZfoFn4Gi07stsSWQ6PKs'); // Get your token here https://my.slack.com/services/new/bot
$command = new SuperCommand();
$chatBot = new \BurdaCodeSlam\ChatBot\Bot\Chatbot("Bot N1", $command);
$command->setChatBotHandlerObject($chatBot);
$command->setToMessage("U358Z8T17");
//$bot->loadCatchAllCommand();
$bot->loadCatchAllCommand($command);
$bot->run();