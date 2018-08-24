<?php
include_once __DIR__.'/slack_bot.php';
include_once __DIR__.'/slack_bot_info.php';
include_once __DIR__.'/get_contributions.php';

$github_contributions = new github_contributions();
$message = $github_contributions->get_github_contributions( $argv[1] );

$jsonUrl = 'secrets.json';
$json = file_get_contents( $jsonUrl );
$decoded_json = json_decode( $json, true );
$url = $decoded_json['url'];

$bot = new SlackBot();
print_r( $bot->post_message( new SlackBotInfo( $url, $message ) ) );