<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/9/16 0016
 * Time: 下午 11:49
 */

//桥接模式

abstract class info
{
    protected $send = null;

    public function __construct( $send )
    {
        $this->send = $send; //存储消息
    }

    abstract public function msg( $content ); //等级

    public function send( $to,$content )
    {
        $content = $this->msg( $content ); //选择等级
        $this->send->send( $to,$content ); //内容
    }

}

class mail{
    public function send( $to,$content )
    {
        echo '站内给'.$to.'发消息内容是:'.$content;
    }

}

class email{
    public function send( $to,$content )
    {
        echo '邮件给'.$to.'发消息内容是:'.$content;
    }

}

class sms{
    public function send( $to,$content )
    {
        echo 'sms给'.$to.'发消息内容是:'.$content;
    }

}


class CommonInfo extends info{
    public function msg( $content )
    {
        return '普通'.$content;
    }

}

class WarnInfo extends info{
    public function msg( $content )
    {
        return '紧急'.$content;
    }

}

class DangerInfo extends info{
    public function msg( $content )
    {
        return '特急'.$content;
    }

}


//站内发普通短信息
$common_info = new CommonInfo( new mail() );
$common_info->send( 'aaa','aaaaaaaaa' );

echo '<br/>';

//手机发特急短信息
$danger_info = new DangerInfo( new sms() );
$danger_info->send( 'bbb','bbbbbbbbb' );
