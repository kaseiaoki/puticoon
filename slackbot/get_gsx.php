<?php

$gsx = new gsx();
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
        $columns = array();
        $columns_name = [ 'id','name','time','dateby'];
        foreach ( $records as $record) {
            foreach ($columns_name as $name) {
                $columns[$name] = $record->{"gsx$" . $name}->{'$t'};
            }
        }
        return $columns;
    }
}