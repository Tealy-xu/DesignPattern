<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/8/28 0028
 * Time: 下午 11:42
 */

//单例模式 singleton
/*class sigle{

}

$s1 = new sigle();
$s2 = new sigle();

//注意，2个对象是1个的时候，才全等
if( $s1 === $s2 ){

}*/

class sigle{
    protected static $ins = null;

    public static function getIns()
    {
        if( self::$ins===null ){
            self::$ins = new sigle();
        }

        return self::$ins;
    }

    //方法前家final，则方法不能被覆盖，类前家final，则类不能被继承
    final protected function __construct()
    {

    }

    //封锁clone
    final protected function __clone()
    {
        // TODO: Implement __clone() method.
    }


}

$s1 = sigle::getIns();
$s2 = sigle::getIns();

if( $s1 === $s2 ) {
    echo 'one';
}else{
    echo 'two';
}

