<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/9/11 0011
 * Time: 下午 11:28
 */

header('content-type: text/html; charset=utf-8');



class board{

    protected $power = 1;
    protected $top   = 'admin';

    public function process($lev)
    {
        if( $lev <= $this->power ){
            echo '版主删帖';
        }else{
            $top = new $this->top;
            $top->process($lev);
        }
    }
}

class admin{

    protected $power = 2;
    protected $top   = 'police';

    public function process($lev)
    {
        if( $lev <= $this->power ){
            echo '管理员封账号';
        }else{
            $top = new $this->top;
            $top->process($lev);
        }
    }
}

class police{

    protected $power;
    protected $top;

    public function process($lev)
    {
        echo '解决！！';
    }
}

//责任链模式来处理举报问题
$lev = $_POST['jubao']+0;

$jubao = new board();
$jubao->process( $lev );