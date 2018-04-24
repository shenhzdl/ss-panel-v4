<?php


namespace App\Controllers\Api\Admin;

use Slim\Http\Request;
use Slim\Http\Response;
use App\Models\Order;
use App\Models\User;
use App\Controllers\BaseController;

class OrderController extends BaseController
{
    public function index(Request $req, Response $res, $args)
    {
        $pageNum = 1;
        if (isset($req->getQueryParams()['page'])) {
            $pageNum = $req->getQueryParams()['page'];
        }
        $traffic = Order::orderBy('id', 'desc')
            ->paginate(15, [
                '*',
            ], 'page', $pageNum);
        $traffic->setPath('/api/admin/orders');
        //return $this->echoJsonWithData($res,$traffic);
        return $this->echoJson($res, $traffic);
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

        $user_id = $arr['user_id'];
        $user = User::find($user_id);
        if($nowt > $user->expire_time)
        {
            $expire_time = strtotime('+'.$arr['renew'].' month',$nowt);
        }
        else
        {
            $expire_time = strtotime('+'.$arr['renew'].' month',$user->expire_time);
        }
        $user->transfer_enable = $user->transfer_enable + $arr['renew'] * 20*1000*1000*1000;
        $user->expire_time = $expire_time;
        $user->enable = 1;
        if($arr['renew'] >= 3)
        {
            $user->invite_num = $user->invite_num + floor($arr['renew']/3);
        }
        $user->save();
        return $this->saveModel($res, new Order(), $arr);
    }
}