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
        if($nowt > $user->expire_time)
        {
            $expire_time = strtotime('+'.$renew.' month',$nowt);
        }
        else
        {
            $expire_time = strtotime('+'.$renew.' month',$user->expire_time);
        }
        $suer->transfer_enable = $suer->transfer_enable + $renew * 20*1000*1000*1000;
        $user->expire_time = $expire_time;
        $user->invite_num = $user->invite_num + $arr['renew'];
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
        $nowt = time();
        $arr['datetime'] =  $nowt;
        $arr['method'] = '支付宝';
        switch ($arr['total']) {
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
                break;
        }
        return $this->saveModel($res, new Order(), $arr);
    }
}