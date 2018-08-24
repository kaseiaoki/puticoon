<?php
class SlackBotInfo{
    public $channel = '#panopticon';
    public $username = 'Michelle';
  
    public $icon_emoji = ':eyes:';
 
    protected $message = '';
    protected $url = '';
    public function __construct( $url = '', $message = '' )
    {
        $this->set_url( $url );
        $this->set_message( $message );
    }
    public function set_url( $url ){
        $this->url = $url;
    }
    public function set_message( $message ){
        $this->message = $message;
    }
    public function get_post_info()
    {
        return array(
            'url'  => $this->url,
            'body' => array(
                'payload' => json_encode(array(
                    'channel'    => $this->channel,
                    'username'   => $this->username,
                    'icon_emoji' => $this->icon_emoji,
                    'text'       => $this->message,
                )),
            ),
        );
    }
}