<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/9/10 0010
 * Time: 下午 9:53
 */


class user implements SplSubject{

    public $log_num;
    public $hobby;

    protected $observers = null; //用来存放所有上来的观察者

    public function __construct( $hobby )
    {
        $this->log_num = rand(1,10);
        $this->hobby   = $hobby;
        $this->observers = new SplObjectStorage();
    }

    public function login()
    {
        //操作session....
        $this->notify();
    }


    /**添加（注册）一个观察者
     * @param SPLObserver $observer
     */
    public function attach(SPLObserver $observer)
    {
        $this->observers->attach($observer);
    }

    /**删除一个观察者
     * @param SPLObserver $observer
     */
    public function detach(SPLObserver $observer)
    {
        $this->observers->detach($observer);
    }


    /**
     * 当状态发生改变时，通知所有观察者
     */
    public function notify()
    {
        $this->observers->rewind();  //rewind将文件指针的位置倒回文件的开头
        while( $this->observers->valid() ){ //valid检查当前位置是否有效
            $observer = $this->observers->current(); //返回数组中的当前元素的值
            $observer->update($this);
            $this->observers->next();
        }

        /**
         * valid此方法在 rewind() 和 next() 方法之后被调用以此用来检查当前位置是否有效。
         */
    }
}


//安全检查
class secrity implements SPLObserver{

    /**目标发送的通知
     * @param SplSubject $subject
     */
    public function update(SplSubject $subject)
    {
        if( $subject->log_num < 3 ){
            echo '这是第'.$subject->log_num.'次安全登录';
        }else{
            echo '这是第'.$subject->log_num.'次登录，异常';
        }
    }
}


//广告推送
class ad implements SPlObserver{

    /**目标发送的通知
     * @param SplSubject $subject
     */
    public function update(SplSubject $subject)
    {
        if($subject->hobby == 'sports'){
            echo 'you like sports,are you sure??';
        }else{
            echo 'good good study, day day up';
        }
    }
}

//实施观察
$user = new user('sports');
$user->attach(new secrity());
$user->attach(new ad());

$user->login();

/*
目标（Subject）和观察者（Observer）两种角色
目标角色是被观察的对象，持有并控制着某种状态，可以被任意多个观察者作为观察的目标，SPL 中使用 SplSubject接口规范了该角色的行为
SplSubject
    attach 添加（注册）一个观察者
    detach 删除一个观察者
    notify 当状态发生改变时，通知所有观察者

SPlObserver
    update 在目标发生改变时接收目标发送的通知；当关注的目标调用其 notify()时被调用

SplObjectStorage
    SplObjectStorage类实现了以对象为键的映射（map）或对象的集合（如果忽略作为键的对象所对应的数据）这种数据结构。


url:SplSubject 和 SplObserver 接口
https://www.ibm.com/developerworks/cn/opensource/os-cn-observerspl/
 */

