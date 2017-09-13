<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/9/13 0013
 * Time: 下午 11:49
 */


/*
 * 装饰器模式 decorator
    帖子的内容我写好了,
    三个部门的人员想控制他.
    编辑组要添导读文字
    审核组要去敏感字
    市场部想在末尾加点广告
    我只是一篇帖子,由你们来处置吧

 *
 *
 * */


class BaseArt
{
    protected $content;
    protected $art = null;

    public function __construct( $content )
    {
        $this->content = $content;
    }

    public function decorator()
    {
        return $this->content;
    }
}


//编辑文章摘要
class BianArt extends BaseArt
{
    public function __construct(BaseArt $art)
    {
        $this->art = $art;
        $this->decorator();
    }

    public function decorator()
    {
        return $this->content = $this->art->decorator().'小编摘要';
    }
}

//SEO关键词
class SEOArt extends BaseArt
{
    public function __construct(BaseArt $art)
    {
        $this->art = $art;
        $this->decorator();
    }

    public function decorator()
    {
        return $this->content = $this->art->decorator().'SEO关键词';
    }
}

$b = new SEOArt( new BianArt( new BaseArt('good good study') ) );
echo $b->decorator();
echo '<br>';
$b = new BianArt( new SEOArt( new BaseArt('good good study') ) );
echo $b->decorator();
