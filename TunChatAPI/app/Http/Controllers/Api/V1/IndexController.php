<?php
namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\V1\Request;
use App\Http\Responses\Api\V1\Status;

class IndexController extends Controller
{
    public function status(Request $request)
    {
        $stats = $request->get('status');

        return Status::ok()->response();
    }
}
