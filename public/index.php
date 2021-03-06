<?php

include('../src/common.php');

use Monolog\Logger;
use Monolog\Handler\StreamHandler;
use unreal4u\TelegramAPI\Telegram\Types\Update;
use unreal4u\TelegramAPI\Telegram\Types\InlineQueryResultArticle;
use unreal4u\TelegramAPI\Telegram\Methods\AnswerInlineQuery;
use unreal4u\TelegramAPI\TgLog;

$parsedRequestUri = trim($_SERVER['REQUEST_URI'], '/');
if (array_key_exists($parsedRequestUri, BOT_TOKENS)) {
    $currentBot = BOT_TOKENS[$parsedRequestUri];

    $logger = new Logger($currentBot);
    $streamHandler = new StreamHandler('telegramApiLogs/main.log');
    #$streamHandler->setLevel(Logger::INFO);
    $logger->pushHandler($streamHandler);

    $logger->addDebug('--------------------------------');
    $logger->addInfo(sprintf('New request on bot %s', $currentBot));
    $rest_json = file_get_contents("php://input");
    $_POST = json_decode($rest_json, true);

    try {
        $completeName = 'unreal4u\\Bots\\' . $currentBot;
        $bot = new $completeName($logger, $parsedRequestUri);
        $bot->run($_POST);
    } catch (\Exception $e) {
        $logger->addError(sprintf('Captured exception: "%s"', $e->getMessage()));
    }
} else {
    header('Location: https://github.com/unreal4u?tab=repositories', true, 302);
}

