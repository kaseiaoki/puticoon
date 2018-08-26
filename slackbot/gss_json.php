<?php

$gsx = new gsx();
$gsx->get_json();
class gsx
{
    const data = "https://spreadsheets.google.com/feeds/list/1FNTb9V41nReF1_6Ejp4y9k6-NFcQG0BKF08wHo2Yn7s/od6/public/values?alt=json";
    function get_json(){
        $json = file_get_contents( self::data );
        $json_decode= json_decode( $json );
        $json = $json_decode;
        $records  = $json->feed->entry;
        return $records;
    }
}

//["gsx$id"]=>
//array(1) {
//["$t"]=>
//  string(1) "1"
//}
//["gsx$name"]=>
//array(1) {
//["$t"]=>
//  string(9) "kaseiaoki"
//}
//["gsx$time"]=>
//array(1) {
//["$t"]=>
//  string(5) "20:00"
//}
//["gsx$databy"]=>
//array(1) {
//["$t"]=>
//  string(1) "2"
