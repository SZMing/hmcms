<?php
/**
 * Created by PhpStorm.
 * User: ming
 * Date: 17-6-13
 * Time: 下午3:23
 */

namespace Module\Api1\Src\Controller;

use Lib\Controller;
use Module\Api1\Src\Model\Interfaces\UserInterface;

use Lib\Request;

class UserController extends Controller
{
    private $user_model;
    private $request;
    public function __construct(UserInterface $user)
    {
        $this->request = new Request();
        $this->user_model = $user;
    }

    public function index()
    {
        return $this->user_model::index();
    }

    /**
     * 用户登录
     * @apiGroup User
     * @api {post} api_v1/user/login 001.用户登录
     * @apiVersion 1.0.0
     *
     * @apiParam {int} unionid 微信用户标识
     *
     * @apiSuccess {int} user_id 用户id
     * @apiSuccess {string} username 用户昵称
     * @apiSuccess {int} unionid 微信用户标识
     * @apiSuccess {string} pic 用户头像
     * @apiSuccess {string} rest 用户余额
     *
     */
    public function login()
    {
        if($this->request->is_post())
        {
            $data = $this->validator($this->request->post(),[
                'unionid' => 'required|numeric',
            ]);

            if(True !== $data)
            {
                return $this->fails(10002,'参数验证不合法',$data);
            }

            if($data = $this->user_model->login($this->request->post('unionid')))
            {
                return $this->success($data);
            }else
            {
                return $this->fails(10005,'登录失败');
            }
        }
    }

    /**
     * 用户注册
     * @apiGroup User
     * @api {post} api_v1/user/register 002.用户注册
     * @apiVersion 1.0.0
     *
     * @apiParam {int} unionid 微信用户标识
     * @apiParam {string} username 用户昵称
     * @apiParam {string} pic 用户头像
     *
     * @apiSuccess {int} user_id 用户id
     */
    public function register()
    {
        if($this->request->post())
        {

        }
    }

    /**
     * 用户设置密码
     *
     * @apiGroup User
     * @api {post} api_v1/user/set_password 003.用户设置密码
     * @apiVersion 1.0.0
     *
     * @apiParam {int} user_id 用户id
     * @apiParam {string} token 令牌token
     * @apiParam {int} unionid 微信用户标识
     * @apiParam {string} password 密码
     */
    public function set_password()
    {
        if($this->request->post())
        {
            $data = $this->validator($this->request->post(),[
                'user_id' => 'required|numeric',
                'token' => 'required',
                'unionid' => 'required|numeric',
                'password' => 'required'
            ]);

            if(True !== $data)
            {
                return $this->fails(10002,'参数验证不合法',$data);
            }

            if($this->user_model->set_password($this->request->post('unionid'),$this->request->post('user_id'),$this->request->post('password')))
            {
                return $this->success();
            }else
            {
                return $this->fails(10005,'设置失败');
            }
        }
    }

    /**
     * 用户修改密码
     *
     * @apiGroup User
     * @api {post} api_v1/user/update_password 004.用户修改密码
     * @apiVersion 1.0.0
     */
    public function update_password()
    {

    }

    /**
     * 用户找回密码
     *
     * @apiGroup User
     * @api {post} api_v1/user/check_password 005.用户找回密码
     * @apiVersion 1.0.0
     */
    public function check_password()
    {

    }

    /**
     * 用户绑定手机
     * @apiGroup User
     * @api {post} api_v1/user/bind_phonenum 006.用户绑定手机
     * @apiVersion 1.0.0
     *
     * @apiParam {int} user_id 用户id
     * @apiParam {string} token 令牌token
     * @apiParam {string} phonenum 手机号码
     *
     *
     */
    public function bind_phonenum()
    {
        if($this->request->post())
        {
            $data = $this->validator($this->request->post(),[
                'user_id' => 'required|numeric',
                'token' => 'required',
                'phonenum' => 'required'
            ]);

            if(True !== $data)
            {
                return $this->fails(10002,'参数验证不合法',$data);
            }

            if($this->user_model->bind_phonenum($this->request->post('user_id'),$this->request->post('phonenum')))
            {
                return $this->success();
            }else
            {
                return $this->fails(10005,'绑定手机失败');
            }
        }
    }

    /**
     * 获取用户基本信息
     *
     * @apiGroup User
     * @api {post} api_v1/user/get_user_base_info 007.获取用户基本信息
     * @apiVersion 1.0.0
     *
     * @apiParam {int} user_id 用户id
     * @apiParam {string} token 令牌token
     *
     *
     *
     */
    public function get_user_base_info()
    {
        if($this->request->post())
        {
            $data = $this->validator($this->request->post(),[
                'user_id' => 'required|numeric',
                'token' => 'required',
            ]);

            if(True !== $data)
            {
                return $this->fails(10002,'参数验证不合法',$data);
            }

            if($user_info = $this->user_model->get_user_base_info((int)$this->request->post('user_id')))
            {
                return $this->success($user_info);
            }else
            {
                return $this->fails(10005,'获取用户基本信息失败');
            }
        }
    }

    /**
     * 获取用户的福利券（省代）
     *
     * @apiGroup User
     * @api {post} api_v1/user/get_user_flq 008.获取用户的福利券
     * @apiVersion 1.0.0
     */
    public function get_user_flq()
    {

    }

    /**
     * 获取用户公众券（公众号）
     *
     * @apiGroup User
     * @api {post} api_v1/user/get_user_gzq 009.获取用户公众券
     * @apiVersion 1.0.0
     */
    public function get_user_gzq()
    {

    }

    /**
     * 用户退出登录
     * @apiGroup User
     * @api {post} api_v1/user/logout 010.用户退出登录
     * @apiVersion 1.0.0
     */
    public function logout()
    {

    }

    /**
     * 用户修改昵称
     * @apiGroup User
     * @api {post} api_v1/user/update_user_username 011.用户修改昵称
     * @apiVersion 1.0.0
     *
     * @apiParam {int} user_id 用户id
     * @apiParam {string} token 令牌token
     * @apiParam {string} username 新昵称
     *
     */
    public function update_user_username()
    {
        if($this->request->post())
        {
            $data = $this->validator($this->request->post(),[
                'user_id' => 'required|numeric',
                'token' => 'required',
                'username' => 'required',
            ]);

            if(True !== $data)
            {
                return $this->fails(10002,'参数验证不合法',$data);
            }

            if($this->user_model->update_user_username($this->request->post('user_id'),$this->request->post('username')))
            {
                return $this->success();
            }else
            {
                return $this->fails(10005,'修改昵称失败');
            }
        }
    }

    /**
     * 用户修改性别
     *
     * @apiGroup User
     * @api {post} api_v1/user/update_user_sex 012.用户修改性别
     * @apiVersion 1.0.0
     *
     * @apiParam {int} user_id 用户id
     * @apiParam {string} token 令牌token
     * @apiParam {string} sex 用户性别（1为男，2为女）
     */
    public function update_user_sex()
    {
        if($this->request->post())
        {
            $data = $this->validator($this->request->post(),[
                'user_id' => 'required|numeric',
                'token' => 'required',
                'sex' => 'required|numeric',
            ]);

            if(True !== $data)
            {
                return $this->fails(10002,'参数验证不合法',$data);
            }

            if($this->user_model->update_user_sex($this->request->post('user_id'),$this->request->post('sex')))
            {
                return $this->success();
            }else
            {
                return $this->fails(10005,'修改性别失败');
            }
        }
    }

    /**
     * 用户添加银行卡
     *
     * @apiGroup User
     * @api {post} api_v1/user/add_user_bankcard 013.用户添加银行卡
     * @apiVersion 1.0.0
     *
     * @apiParam {int} user_id 用户id
     * @apiParam {string} token 令牌token
     * @apiParam {int} realname 身份证姓名
     * @apiParam {int} bank_num 银行卡卡号
     * @apiParam {int} phonenum 联系手机号码
     */
    public function add_user_bankcard()
    {
        if($this->request->post())
        {
            $data = $this->validator($this->request->post(),[
                'user_id' => 'required|numeric',
                'token' => 'required',
                'realname' => 'required',
                'bank_num' => 'required',
                'phonenum' => 'required'
            ]);

            if(True !== $data)
            {
                return $this->fails(10002,'参数验证不合法',$data);
            }

            //根据银行帐号获取银行名称
            $bank_name = $this->bankInfo($this->request->post('bank_num'),$this->config('bank.bank_list'));

            $arr = explode('-',$bank_name);

            if($this->user_model->add_user_bankcard($this->request->post('user_id'),$this->request->post('realname'),$this->request->post('bank_num'),$arr[0],$this->request->post('phonenum')))
            {
                return $this->success();
            }else
            {
                return $this->fails(10005,'添加银行卡失败');
            }
        }
    }


    /**
     * 获取银行信息
     */
    private function bankInfo($card,$bankList)
    {
        $card_8 = substr($card, 0, 8);
        if (isset($bankList[$card_8])) {
            return $bankList[$card_8];
        }
        $card_6 = substr($card, 0, 6);
        if (isset($bankList[$card_6])) {
            return $bankList[$card_6];
        }
        $card_5 = substr($card, 0, 5);
        if (isset($bankList[$card_5])) {
            return $bankList[$card_5];
        }
        $card_4 = substr($card, 0, 4);
        if (isset($bankList[$card_4])) {
            return $bankList[$card_4];
        }
        return '该卡号信息暂未录入';
    }

    /**
     * 获取用户银行卡列表
     *
     * @apiGroup User
     * @api {post} api_v1/user/get_user_bankcard_lists 014.获取用户银行卡列表
     * @apiVersion 1.0.0
     *
     * @apiParam {int} user_id 用户id
     * @apiParam {string} token 令牌token
     */
    public function get_user_bankcard_lists()
    {
        if($this->request->post())
        {
            $data = $this->validator($this->request->post(),[
                'user_id' => 'required|numeric',
                'token' => 'required',
            ]);

            if(True !== $data)
            {
                return $this->fails(10002,'参数验证不合法',$data);
            }

            $data = $this->user_model->get_user_bankcard_lists($this->request->post('user_id'));

            //获取银行卡图片
            foreach($data as &$da)
            {
                $da['pic'] = $this->config('pic.local').'bankpic/default.jpg';

                if(strpos($da['bank_name'], '招商') !== false)
                {
                    $da['pic'] = $this->config('pic.local').'bankpic/zhaoshang.png';
                    continue;
                }

                if(strpos($da['bank_name'], '人民') !== false)
                {
                    $da['pic'] = $this->config('pic.local').'bankpic/renmin.png';
                    continue;
                }

                if(strpos($da['bank_name'], '兴业') !== false)
                {
                    $da['pic'] = $this->config('pic.local').'bankpic/xingye.png';
                    continue;
                }

                if(strpos($da['bank_name'], '中国') !== false)
                {
                    $da['pic'] = $this->config('pic.local').'bankpic/zhongguo.png';
                    continue;
                }

                if(strpos($da['bank_name'], '中信') !== false)
                {
                    $da['pic'] = $this->config('pic.local').'bankpic/zhongxin.png';
                    continue;
                }


                if(strpos($da['bank_name'], '工商') !== false)
                {
                    $da['pic'] = $this->config('pic.local').'bankpic/gongshang.png';
                    continue;
                }

                if(strpos($da['bank_name'], '光大') !== false)
                {
                    $da['pic'] = $this->config('pic.local').'bankpic/guangda.png';
                    continue;
                }

                if(strpos($da['bank_name'], '广发') !== false)
                {
                    $da['pic'] = $this->config('pic.local').'bankpic/guangfa.png';
                    continue;
                }

                if(strpos($da['bank_name'], '华夏') !== false)
                {
                    $da['pic'] = $this->config('pic.local').'bankpic/huaxia.png';
                    continue;
                }

                if(strpos($da['bank_name'], '建设') !== false)
                {
                    $da['pic'] = $this->config('pic.local').'bankpic/jianshe.png';
                    continue;
                }

                if(strpos($da['bank_name'], '交通') !== false)
                {
                    $da['pic'] = $this->config('pic.local').'bankpic/jiaotong.png';
                    continue;
                }

                if(strpos($da['bank_name'], '民生') !== false)
                {
                    $da['pic'] = $this->config('pic.local').'bankpic/minsheng.png';
                    continue;
                }

                if(strpos($da['bank_name'], '农业') !== false)
                {
                    $da['pic'] = $this->config('pic.local').'bankpic/nongye.png';
                    continue;
                }

                if(strpos($da['bank_name'], '平安') !== false)
                {
                    $da['pic'] = $this->config('pic.local').'bankpic/pingan.png';
                    continue;
                }

                if(strpos($da['bank_name'], '浦发') !== false)
                {
                    $da['pic'] = $this->config('pic.local').'bankpic/pufa.png';
                    continue;
                }

                if(strpos($da['bank_name'], '邮政') !== false)
                {
                    $da['pic'] = $this->config('pic.local').'bankpic/youzheng.png';
                    continue;
                }
            }

            return $this->success($data);
        }
    }

    /**
     * 用户修改银行卡
     *
     * @apiGroup User
     * @api {post} api_v1/user/update_user_bankcard 015.用户修改银行卡
     * @apiVersion 1.0.0
     *
     * @apiParam {int} bank_id 银行卡id
     * @apiParam {int} user_id 用户id
     * @apiParam {string} token 令牌token
     * @apiParam {string} bank_num 新银行卡号
     */
    public function update_user_bankcard()
    {
        if($this->request->post())
        {
            $data = $this->validator($this->request->post(),[
                'user_id' => 'required|numeric',
                'bank_id' => 'required|numeric',
                'token' => 'required',
                'bank_num' => 'required',
            ]);

            if(True !== $data)
            {
                return $this->fails(10002,'参数验证不合法',$data);
            }

            if($this->user_model->update_user_bankcard($this->request->post('user_id'),$this->request->post('bank_id'),$this->request->post('bank_num')))
            {
                return $this->success();
            }else
            {
                return $this->fails(10005,'修改银行卡失败');
            }
        }
    }

    /**
     * 用户删除银行卡
     * @apiGroup User
     * @api {post} api_v1/user/delete_user_bankcard 016.用户删除银行卡
     * @apiVersion 1.0.0
     *
     * @apiParam {int} user_id 用户id
     * @apiParam {int} bank_id 银行卡id
     * @apiParam {string} token 令牌token
     */
    public function delete_user_bankcard()
    {
        if($this->request->post())
        {
            $data = $this->validator($this->request->post(),[
                'user_id' => 'required|numeric',
                'bank_id' => 'required|numeric',
                'token' => 'required',
            ]);

            if(True !== $data)
            {
                return $this->fails(10002,'参数验证不合法',$data);
            }

            if($this->user_model->delete_user_bankcard($this->request->post('user_id'),$this->request->post('bank_id')))
            {
                return $this->success();
            }else
            {
                return $this->fails(10005,'删除银行卡失败');
            }
        }
    }

    /**
     * 用户添加收货地址
     *
     * @apiGroup User
     * @api {post} api_v1/user/add_user_address 017.用户添加收货地址
     * @apiVersion 1.0.0
     *
     * @apiParam {int} user_id 用户id
     * @apiParam {string} token 令牌token
     *
     * @apiParam {string} realname 收货人姓名
     * @apiParam {string} phonenum 收货人联系电话
     * @apiParam {string} province 省
     * @apiParam {string} city 市
     * @apiParam {string} town 乡镇
     * @apiParam {string} detail_address 详细地址
     *
     */
    public function add_user_address()
    {
        if($this->request->post())
        {
            $data = $this->validator($this->request->post(),[
                'user_id' => 'required|numeric',
                'token' => 'required',
                'realname' => 'required',
                'phonenum' => 'required',
                'province' => 'required',
                'city' => 'required',
                'town' => 'required',
                'detail_address' => 'required'
            ]);

            if(True !== $data)
            {
                return $this->fails(10002,'参数验证不合法',$data);
            }

            if($this->user_model->add_user_address($this->request->post('user_id'),$this->request->post('realname'),$this->request->post('phonenum'),$this->request->post('province'),$this->request->post('city'),$this->request->post('town'),$this->request->post('detail_address')))
            {
                return $this->success();
            }else
            {
                return $this->fails(10005,'添加银行卡失败');
            }

        }
    }

    /**
     * 用户修改收货地址
     *
     * @apiGroup User
     * @api {post} api_v1/user/update_user_address 018.用户修改收货地址
     * @apiVersion 1.0.0
     *
     * @apiParam {int} user_id 用户id
     * @apiParam {string} token 令牌token
     *
     * @apiParam {int} address_id 收获地址id
     *
     * @apiParam {string} realname 收货人姓名
     * @apiParam {string} phonenum 收货人联系电话
     * @apiParam {string} province 省
     * @apiParam {string} city 市
     * @apiParam {string} town 乡镇
     * @apiParam {string} detail_address 详细地址
     *
     */
    public function update_user_address()
    {
        if($this->request->post())
        {
            $data = $this->validator($this->request->post(),[
                'user_id' => 'required|numeric',
                'address_id' => 'required|numeric',
                'token' => 'required',
                'realname' => 'required',
                'phonenum' => 'required',
                'province' => 'required',
                'city' => 'required',
                'town' => 'required',
                'detail_address' => 'required'
            ]);

            if(True !== $data)
            {
                return $this->fails(10002,'参数验证不合法',$data);
            }

            if($this->user_model->update_user_address($this->request->post('address_id'),$this->request->post('user_id'),$this->request->post('realname'),$this->request->post('phonenum'),$this->request->post('province'),$this->request->post('city'),$this->request->post('town'),$this->request->post('detail_address')))
            {
                return $this->success();
            }else
            {
                return $this->fails(10005,'添加银行卡失败');
            }

        }
    }

    /**
     * 用户默认收货地址
     *
     * @apiGroup User
     * @api {post} api_v1/user/default_user_address 019.用户默认收货地址
     * @apiVersion 1.0.0
     */
    public function default_user_address()
    {

    }

    /**
     * 获取用户收货地址列表
     *
     * @apiGroup User
     * @api {post} api_v1/user/get_user_address_lists 020.获取用户收货地址列表
     * @apiVersion 1.0.0
     */
    public function get_user_address_lists()
    {

    }

    /**
     * 用户删除收货地址
     *
     * @apiGroup User
     * @api {post} api_v1/user/delete_user_address 021.用户删除收货地址
     * @apiVersion 1.0.0
     */
    public function delete_user_address()
    {

    }

    /**
     * 获取个人消息列表
     *
     * @apiGroup User
     * @api {post} api_v1/user/get_user_msg_lists 022.获取个人消息列表
     * @apiVersion 1.0.0
     */
    public function get_user_msg_lists()
    {

    }

    /**
     * 获取个人消息详情
     *
     * @apiGroup User
     * @api {post} api_v1/user/get_user_msg_detail 023.获取个人消息详情
     * @apiVersion 1.0.0
     */
    public function get_user_msg_detail()
    {

    }

    /**
     * 获取用户所属公众号信息
     *
     * @apiGroup User
     * @api {post} api_v1/user/get_user_gz_info 024.获取用户所属公众号信息
     * @apiVersion 1.0.0
     */
    public function get_user_gz_info()
    {

    }

    /**
     * 用户申请为推广员
     * @apiGroup User
     * @api {post} api_v1/user/user_apply_tg 025.用户申请为推广员
     * @apiVersion 1.0.0
     *
     */
    public function user_apply_tg()
    {

    }

    /**
     * 获取用户的推广二维码
     *
     * @apiGroup User
     * @api {post} api_v1/user/get_user_qcode 026.获取用户的推广二维码
     * @apiVersion 1.0.0
     */
    public function get_user_qcode()
    {

    }

    /**
     * 获取用户的推广信息
     *
     * @apiGroup User
     * @api {post} api_v1/user/get_user_tg_info 027.获取用户的推广信息
     * @apiVersion 1.0.0
     */
    public function get_user_tg_info()
    {

    }

    /**
     * 获取用户推广人员列表
     *
     * @apiGroup User
     * @api {post} api_v1/user/get_user_tg_users 028.获取用户推广人员列表
     * @apiVersion 1.0.0
     */
    public function get_user_tg_users()
    {

    }

    /**
     * 获取用户业绩明细
     *
     * @apiGroup User
     * @api {post} api_v1/user/get_user_yjmx 029.获取用户业绩明细
     * @apiVersion 1.0.0
     */
    public function get_user_yjmx()
    {

    }

    /**
     * 用户提现
     * @apiGroup User
     * @api {post} api_v1/user/user_tx 030.用户提现
     * @apiVersion 1.0.0
     */
    public function user_tx()
    {

    }

    /**
     * 获取用户提现记录
     * @apiGroup User
     * @api {post} api_v1/user/user_tx_lists 031.获取用户提现记录
     * @apiVersion 1.0.0
     */
    public function user_tx_lists()
    {

    }

    /**
     * 获取用户充值列表
     * @apiGroup User
     * @api {post} api_v1/user/user_cz_lists 032.获取用户充值列表
     * @apiVersion 1.0.0
     */
    public function user_cz_lists()
    {

    }

    /**
     * 获取用户的商城兑换列表（手机壳等）
     * @apiGroup User
     * @api {post} api_v1/user/get_user_shop_exchanges 033.获取用户的商城兑换列表
     * @apiVersion 1.0.0
     */
    public function get_user_shop_exchanges()
    {

    }

    /**
     * 获取用户物流记录列表
     * @apiGroup User
     * @api {post} api_v1/user/get_user_wl_lists 034.获取用户物流记录列表
     * @apiVersion 1.0.0
     */
    public function get_user_wl_lists()
    {

    }

    /**
     * 获取用户店铺消费列表
     * @apiGroup User
     * @api {post} api_v1/user/get_user_store_xfs 035.获取用户店铺消费列表
     * @apiVersion 1.0.0
     */
    public function get_user_store_xfs()
    {

    }

    /**
     * 用户意见反馈
     * @apiGroup User
     * @api {post} api_v1/user/user_opinion 036.用户意见反馈
     * @apiVersion 1.0.0
     */
    public function user_opinion()
    {

    }
}