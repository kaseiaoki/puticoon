<?php
include_once __DIR__."/get_gsx.php";
include_once __DIR__.'/slack_bot.php';
include_once __DIR__.'/slack_bot_info.php';
include_once __DIR__.'/get_contributions.php';

$get_gsx = new gsx();
$record = $get_gsx->get_column( $get_gsx->get_json() );
$parsed_date =  date_parse_from_format ( "h:m",$record['time'] );
$target_hour = $parsed_date["hour"];

date_default_timezone_set('Asia/Tokyo');
$date = date("G");

$jsonUrl = 'secrets.json';
$json = file_get_contents( $jsonUrl );
$decoded_json = json_decode( $json, true );
$url = $decoded_json['url'];

$week = date("w" );

$github_contributions = new github_contributions();
if( $date  == $target_hour ){
    $message = $github_contributions->get_github_contributions( $record['name'] );
    $bot = new SlackBot();
    print_r( $bot->post_message( new SlackBotInfo( $url, $message ) ) );
}






