<?php
include_once 'vendor/autoload.php';
$loop = React\EventLoop\Factory::create();

$client = new Slack\RealTimeClient($loop);
$client->setToken('xoxb-107306355601-D9n5oUzgGrtvJy73cjNoh215');

// disconnect after first message
$client->on('message', function ($data) use ($client) {
    echo "Someone typed a message: " . $data['text'] . "\n";

//$client->disconnect();
});

$client->on('channel_join', function ($data) use ($client) {
    echo "Someone typed a message: " . $data['text'] . "\n";
    var_dump($data);
//$client->disconnect();
});
$client->getChannelById('general')->then(function (\Slack\Channel $channel) use ($client) {
    $channel->getMembers()->then(function (\Slack\User $member){
        var_dump($member);
    });
});



$loop->run();