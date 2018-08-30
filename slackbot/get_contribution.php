<?php
/**
 * Created by PhpStorm.
 * User: s1321
 * Date: 2018/08/29
 * Time: 23:05
 */

class get_contribution{
    function parse_contributions( $username ) {
        try{
            $data = $this->http_get( "https://github.com/users/".$username."/contributions" );
        }catch ( Exception $e ) {
            return $e->getMessage();
        }
        $today = date( 'Y-m-d' );
        $html_lines = str_replace( array( "\r\n","\r","\n" ), "\n", $data );
        $lines = explode( "\n", $html_lines );
        $contributions=array();
        foreach ( $lines as $line ) {
            if ( strpos($line,"data-count" ) ){
                preg_match("/data-count=\"([0-9]+)\"/", $line, $matches);
                $line_count = $matches;
                preg_match("/data-date=\"(.*?)\"/", $line, $matches);
                $line_data = $matches[1];
                $contributions[$line_data]= $line_count[1];
            }
        }
        return $contributions;
    }

    function day_calc( $contributions, $days ) {
        foreach( range(1, $days ) as $day ){
            if( $contributions[ date("Y-m-d", strtotime("-1 day"))] < 1) {
                return true;
            }
        }
        return false;
    }
    function http_get( $url ){
        $option = [CURLOPT_RETURNTRANSFER => true];
        $curl = curl_init( $url );
        curl_setopt_array( $curl, $option );

        $data = curl_exec($curl);
        $info = curl_getinfo($curl);

        if ( $info['http_code'] !== 200 ) {
            return false;
        } else {
            return $data;
        }
    }
}