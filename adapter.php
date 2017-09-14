<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/9/14 0014
 * Time: 下午 11:01
 */

//适配器模式

class tianqi{
    public static function show()
    {
        $today = array( 'tep'=>28,'wind'=>7,'sun'=>'sunny' );
        return serialize( $today );
    }
}


//加个适配器
class AdapterTianqi extends tianqi{
    public static function show()
    {
        $today = parent::show();
        $today = unserialize($today);
        $today = json_encode($today);
        return $today;
    }
}

//客户端调研
$tq = unserialize( tianqi::show() );
echo '温度：',$tq['tep'],'<br/>';
echo '风力：',$tq['wind'],'<br/>';
echo 'sun：',$tq['sun'],'<br/>';

//java,python再来调用，通过适配器调用
$tq = AdapterTianqi::show();
$tq = json_decode($tq,true);
echo '温度：',$tq['tep'],'<br/>';
echo '风力：',$tq['wind'],'<br/>';
echo 'sun：',$tq['sun'],'<br/>';