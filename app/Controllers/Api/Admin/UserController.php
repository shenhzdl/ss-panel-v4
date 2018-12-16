<?php
namespace App\Controllers\Api\Admin;

use Slim\Http\Request;
use Slim\Http\Response;
use App\Models\User;
use App\Controllers\BaseController;

class UserController extends BaseController
{
    public function index(Request $request, Response $response, $args)
    {
        $pageNum = 1;
        $keyword='';
        if (isset($request->getQueryParams()['page'])) {
            $pageNum = $request->getQueryParams()['page'];
        }
        if (isset($request->getQueryParams()['keyword'])) {
            $keyword = $request->getQueryParams()['keyword'];
        }
        if(True == empty($keyword))
        {
            $traffic = User::orderBy('expire_time', 'asc')
                ->paginate(30, [
                    '*',
                ], 'page', $pageNum);
        }
        else
        {
            $traffic = User::where('email','like','%'.$keyword.'%')
                ->orWhere('user_name','like','%'.$keyword.'%')
                ->orderBy('expire_time', 'asc')
                ->paginate(30, [
                    '*',
                ], 'page', $pageNum);
        }
        
        $traffic->setPath('/api/admin/users');
        //return $this->echoJsonWithData($res,$traffic);
        return $this->echoJson($response, $traffic);
    }

    // public function set(Request $request, Response $response, $args)
    // {
    //     $users = User::where('expire_time','<',time())
    //         ->where(function($query){
    //             $query->where('enable','=','1');
    //         })
    //         ->get();
    //     foreach($users as $user)
    //     {
    //         $user->enable = 0;
    //         $user->save();
    //     }
    //     return $this->echoJsonWithData($response, []);
    // }

    public function setone(Request $request, Response $response, $args)
    {
        $id = $request->getParam('user_id');
        $enable = $request->getParam('enable');
        $user = User::find($id);
        if($enable)
        {
            $enable = 1;
        }
        else
        {
            $enable = 0;
        }
        $user->enable = $enable;
        $user->save();
        return $this->echoJsonWithData($response, []);
    }

    public function addTraffic(Request $request, Response $response, $args)
    {
        $id = $request->getParam('user_id');
        $user = User::find($id);
        $user->addTraffic(30);
        return $this->echoJsonWithData($response, []);
    }
}