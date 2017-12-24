<?php


namespace App\Controllers\Api;

use Slim\Http\Request;
use Slim\Http\Response;
use App\Models\Order;
use App\Models\User;
use App\Controllers\BaseController;

class OrderController extends BaseController
{
    public function update(Request $req, Response $res, $args)
    {
        $id = $args['id'];
        $tradeno = $req->getParam('tradeno');
        $order = Order::where('tradeno','=',$tradeno)
            ->where(function($query){
                $query->where('user_id','=','0');
            })
            ->first();
        $renew = $order->renew;
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
        $user->transfer_enable = $user->transfer_enable + $renew * 20*1000*1000*1000;
        $user->expire_time = $expire_time;
        if($renew >= 1)
        {
            $user->enable = 1;
        }
        if($renew >= 3)
        {
            $user->invite_num = $user->invite_num + floor($renew/3);
        }
        $user->save();
        $order->user_id = $id;
        $order->save();
        return $this->echoJsonWithData($res, []);
    }

    private function saveModel(Response $response, Order $node, $arr)
    {
        foreach ($arr as $k => $v) {
            $node->$k = $v;
        }
        $node->save();
        return $this->echoJsonWithData($response, $node);
    }

    public function store(Request $req, Response $res, $args)
    {
        $input = file_get_contents("php://input");
        $arr = json_decode($input, true);
        //不要名称
        unset($arr['name']);
        $arr['datetime'] =  strtotime($arr['datetime']);
        $arr['method'] = '支付宝';
        switch ($arr['amount']) {
            case '10.0':
                $arr['renew'] = 1;
                break;
            case '30.0':
                $arr['renew'] = 3;
                break;
            case '50.0':
                $arr['renew'] = 6;
                break;
            case '100.0':
                $arr['renew'] = 12;
                break;
            default:
                $arr['renew'] = 0;
                break;
        }
        return $this->saveModel($res, new Order(), $arr);
    }
}