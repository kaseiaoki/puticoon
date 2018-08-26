<?php

$cron_formatter = new cron_formatter();
class cron_formatter
{
    function cron_format( $time, $name, $date ){
        $parsed_date =  date_parse_from_format ( "h:m",$time );
        $hour = $parsed_date["hour"];
        $minute = $parsed_date[ "minute" ];
        var_dump($hour,$minute);
    }
}