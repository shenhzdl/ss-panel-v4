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
            $traffic = User::paginate(15, [
                '*',
            ], 'page', $pageNum);
        }
        else
        {
            $traffic = User::where('email','like','%'.$keyword.'%')
                ->orderBy('id', 'desc')
                ->paginate(15, [
                    '*',
                ], 'page', $pageNum);
        }
        
        $traffic->setPath('/api/admin/users');
        //return $this->echoJsonWithData($res,$traffic);
        return $this->echoJson($response, $traffic);
    }
}