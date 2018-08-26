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
    function get_column( $records ){
        $columns =array();
        $columns_name = [ 'gsx$id','gsx$name','gsx$time','gsx$date_by'];
        foreach( $columns_name as $name ){
            $columns[] = $records->{ $name }->{ '$t' };
        }
        return $columns;
    }
}