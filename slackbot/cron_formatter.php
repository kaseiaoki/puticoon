<?php

$cron_formatter = new cron_formatter();
class cron_formatter
{
    function cron_format( $time, $name, $date_by ){
        $parsed_date =  date_parse_from_format ( "h:m",$time );
        $hour = $parsed_date["hour"];
        $minute = $parsed_date[ "minute" ];
        $date = "*/$date_by";
        return $custom_array = [ "hour" => $hour, "minute"=> $minute, "date" => $date, "name" => $name ];
    }
}