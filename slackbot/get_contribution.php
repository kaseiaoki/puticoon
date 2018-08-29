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
        foreach ( $lines as $line ) {
            if ( preg_match("/data-count=\"([0-9]+)\"/", $line, $matches) ) {
                return $matches;
            }
        }
    }
}