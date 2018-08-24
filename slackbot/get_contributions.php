<?php

class github_contributions{
    public function get_github_contributions( $username ) {
        try{
            $data = $this->http_get( "https://github.com/users/".$username."/contributions" );
            if( $this->parse_contributions( $data ) == "0" ) {
                return ":eyes:";
            }else {
                return ":thumbsup:";
            }
        }catch ( Exception $e ) {
            return $e->getMessage();
        }
    }
    
    function parse_contributions( $data ) {
        $today = date( 'Y-m-d' );
        $html_lines = str_replace( array( "\r\n","\r","\n" ), "\n", $data );
        $lines = explode( "\n", $html_lines );
        $date_data = array();
        foreach ( $lines as $line ) {
            $today = date( 'Y-m-d' );
            $html_lines = str_replace( array( "\r\n","\r","\n" ), "\n", $data );
            $lines = explode( "\n", $html_lines );
            foreach ( $lines as $line ) {
                if (preg_match("/data-count=\"([0-9]+)\" data-date=\"$today\"/", $line, $matches)) {
                    return $matches[1];
                }
            }
        }
        return $date_data;
    }

    function show_contributions() {
        echo "username:";
        $username = trim( fgets( STDIN ) );  
        $array_contributions = $this->get_github_contributions( $username );
        var_dump( $array_contributions );
    }
    function http_get( $url ){
        $option = [
            CURLOPT_RETURNTRANSFER => true, 
        ];
    
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