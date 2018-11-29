<?php


namespace App\Controllers\Api;

use Slim\Http\Request;
use Slim\Http\Response;
use App\Models\Order;
use App\Models\User;
use App\Models\AppKey;
use App\Services\AliPayCode;
use App\Controllers\BaseController;

class OrderController extends BaseController
{

    public function getQrcode(Request $req, Response $res, $args)
    {
        $id = $args['id'];
        $month = $req->getQueryParams()['month'];
        $month = (int)$month;
        $code = new AliPayCode();
        $fileName = $code->get($month,$id);
        if($fileName == '')
        {
            $fileName = 'error';
        }
        return $this->echoJsonWithData($res, [
            'filename' => 'zfb'.$fileName
        ]);
    }

    public function store(Request $req, Response $res, $args)
    {
        $input = file_get_contents("php://input");
        $arr = json_decode($input, true);
        $keypara = $arr['appkey'];
        $keydata = Appkey::find(1)['appkey'];
        if( $keypara != $keydata)
        {
            return $this->echoJsonWithData($res, [
                'success' => false,
                'message' => '验证失败'
            ]);
        }
        $tradeno = $arr['alipaytradeno'];
        $c_order = Order::where('tradeno', $tradeno )->first();
        if($c_order!= null)
        {
            return $this->echoJsonWithData($res, [
                'success' => false,
                'message' => '订单号已存在'
            ]);
        }
        $amount = floatval($arr['amount']);
        $renew  = 0;
        switch ($amount) {
            case 10.00:
            case 9.99:
            case 10.01:
                $renew = 1;
                break;
            case 30.00:
            case 29.99:
            case 30.01:
                $renew = 3;
                break;
            case 100.00:
            case 99.99:
            case 100.01:
                $renew = 12;
                break;
        }
        //处理用户
        $code = new AliPayCode();
        $id = $code->getUserID($amount);
        $user = User::find($id);
        $nowt = time();
        if($nowt > $user->expire_time)
        {
            $expire_time = strtotime('+'.$renew.' month',$nowt);
        }
        else
        {
            $expire_time = strtotime('+'.$renew.' month',$user->expire_time);
        }
        $user->transfer_enable = $user->transfer_enable + $renew * 30*1024*1024*1024;
        $user->expire_time = $expire_time;
        if($renew >= 1)
        {
            $user->enable = 1;
        }
        if($renew == 12)
        {
            $user->invite_num = $user->invite_num + 1;
        }
        $user->save();
        //处理订单
        $order = new Order();
        $order->user_id = $id;
        $order->amount = $amount;
        $order->tradeno = $tradeno;
        $order->datetime = strtotime($arr['datetime']);
        $order->save();
        return $this->echoJsonWithData($res, $order);
    }
}