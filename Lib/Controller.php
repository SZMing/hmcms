<?php
/**
 * Created by PhpStorm.
 * User: ming
 * Date: 17-6-13
 * Time: 下午2:41
 */

namespace Lib;

class Controller
{
    /**
     * 验证的方法
     */
    public function validator($arr,$brr)
    {
        //将$_POST/$_GET中的键取出来
        $newarr = array_keys($arr);
        $str = [];
        foreach ($brr as $key => $val)
        {
            //先判断所验证的信息是否在第一个数组中
            if(!in_array($key,$newarr))
            {
                $str[] = '参数 '.$key.' 缺失';
            }

            //分解验证条件为数组
            $a = explode('|',$val);
            foreach ($a as $v)
            {
                switch ($v)
                {
                    case 'required':

                        if(!$arr[$key])
                        {
                            $str[] =  $key. ' 参数缺少值';
                        }
                        break;

                    case 'numeric':
                        if(!is_numeric($arr[$key]))
                        {
                            $str[] =  $key. ' 参数必须为数字类型';
                        }
                        break;
                }
            }
        }

        if(0 === count($str))
        {
            return true;
        }else
        {
            return $str;
        }
    }

    /**
     * 验证的errors
     */
    public function errors($data)
    {
        return $data;
    }

    /**
     * success response
     */
    public function success($arr = [],$page = 0,$offset = 0,$code = 10000,$msg = '本次操作成功')
    {
        header('Content-type: application/json');
        $data = [
            'data'=>$arr,
            'page' => ['page' => $page,'offset' => $offset],
            'code' => $code,
            'msg' => $msg,
        ];

        return json_encode($data);
    }

    /**
     * fails response
     */
    public function fails($code = 10001,$msg,$arr = [])
    {
        header('Content-type: application/json');
        $data = [
            'code' => $code,
            'msg' => $msg,
            'data' => $arr,
        ];

        return json_encode($data);
    }

    /**
     * config
     */
    public function config($param)
    {
        $arr = explode('.',$param);
        $data = require BASEPATH . '/../Config/'.$arr[0].'.php';
        return $data[$arr[1]];
    }


    /**
     * 观察者
     */
    public function watcher($class,$watcher_class)
    {
        $data = require_once BASEPATH . '/../Config/watcher.php';
        $actionpath = $data[$class]['action'];
        $action = new $actionpath();
        $action->register($watcher_class);
        $action->notify();
    }


    /**
     * 渲染模板
     */
    public function render($viewpath = '',$data = [])
    {
        require_once BASEPATH . '/../vendor/autoload.php';

        //分割路径，获得当前执行的模块
        $arr = explode('/',$viewpath);

        $loader = new \Twig_Loader_Filesystem(BASEPATH . '/../Module/'.ucfirst($arr[0]).'/Src/View');

        $twig = null;
        if(False === $this->config('twig.cache'))
        {
            $twig = new \Twig_Environment($loader,array('debug' => false));
        }else
        {
            $twig = new \Twig_Environment($loader,[
                'cache' => BASEPATH . '/../Bootstrap/cache/view',
            ]);
        }

        //配置定界符
        $lexer = new \Twig_Lexer($twig,$this->config('twig.tags'));
        $twig->setLexer($lexer);

        //手机浏览器
        if(self::mobile())
        {
            return $twig->render(ucfirst($arr[1]).'/wap_'.$arr[2].'.twig',$data);
        }else
        {
            return $twig->render(ucfirst($arr[1]).'/'.$arr[2].'.twig',$data);
        }
    }

    /**
     * 手机浏览器
     */
    static private function mobile()
    {
        $user_agent = $_SERVER ['HTTP_USER_AGENT'];
        $mobile_browser = Array (
            "mqqbrowser", // 手机QQ浏览器
            "opera mobi", // 手机opera
            "juc",
            "iuc", // uc浏览器
            "fennec",
            "ios",
            "applewebKit/420",
            "applewebkit/525",
            "applewebkit/532",
            "ipad",
            "iphone",
            "ipaq",
            "ipod",
            "iemobile",
            "windows ce", // windows phone
            "240×320",
            "480×640",
            "acer",
            "android",
            "anywhereyougo.com",
            "asus",
            "audio",
            "blackberry",
            "blazer",
            "coolpad",
            "dopod",
            "etouch",
            "hitachi",
            "htc",
            "huawei",
            "jbrowser",
            "lenovo",
            "lg",
            "lg-",
            "lge-",
            "lge",
            "mobi",
            "moto",
            "nokia",
            "phone",
            "samsung",
            "sony",
            "symbian",
            "tablet",
            "tianyu",
            "wap",
            "xda",
            "xde",
            "zte"
        );

        $is_mobile = false;
        foreach ( $mobile_browser as $device ) {
            if (stristr ( $user_agent, $device )) {
                $is_mobile = true;
                break;
            }
        }
        return $is_mobile;
    }
}