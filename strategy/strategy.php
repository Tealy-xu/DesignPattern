<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/9/12 0012
 * Time: 下午 11:01
 */


interface Math{
    public function calc( $op1,$op2 );
}

class MathAdd implements Math{
    public function calc( $op1,$op2 )
    {
        return $op1 + $op2;
    }
}

class MathSub implements Math{
    public function calc( $op1,$op2 )
    {
        return $op1 - $op2;
    }
}

class MathMul implements Math{
    public function calc( $op1,$op2 )
    {
        return $op1 * $op2;
    }
}

class MathDiv implements Math{
    public function calc( $op1,$op2 )
    {
        return $op1 / $op2;
    }
}

//封装一个虚拟计算器
class CMath{
    protected $calc = null;

    public function __construct( $type )
    {
        $calc = 'Math'.$type;
        $this->calc = new $calc();
    }

    public function calc($op1,$op2)
    {
        return $this->calc->calc($op1,$op2);
    }
}

$type = $_POST['op'];
$cmath = new CMath( $type );
echo $cmath->calc( $_POST['op1'],$_POST['op2'] );


