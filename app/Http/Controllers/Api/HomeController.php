<?php

namespace App\Http\Controllers\Api;

use App\User;
use App\Model\NewCallRequest;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Carbon\Carbon;

class HomeController extends Controller
{
    public function end_call($call_code)
    {
        $reply = call_me_reply($call_code);
        if(isset($reply['result']) || $reply==0)
        {
            return response()->json([
                'status' => 'error',
                'msg' => 'Not Found Call Request',
            ]);
        }
        $call = NewCallRequest::where('uniq_id', $call_code)->where('status','!=','end')->first();
        try {
            if (!$call) {
                return response()->json([
                    'status' => 'error',
                    'msg' => 'Not Found Call Request',
                ]);
            }

            $call->start_call = $reply['calldate'];
            $call->min_call = $reply['duration'];
            $call->price_call = (int)$reply['duration'] * (int)$call->price_min;
            $call->status = 'end';
            $call->update();

            $user=User::find($call->user_id);
            if($user)
            {
                $after_price=(int)$user->amount - (int)$call->price_call;
                $user->amount=$after_price;
                $user->update();
            }

            return response()->json([
                'status' => 'success',
                'msg' => 'Success End Call',
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'msg' => 'Error Catch Function',
            ]);
        }
    }
}
