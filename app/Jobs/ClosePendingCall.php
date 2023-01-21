<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

use App\Model\CallRequest;
use Carbon\Carbon;

class ClosePendingCall implements ShouldQueue {
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public function __construct() {}

    public function handle() {
        $oneMinuteAgo   = Carbon::now()->subMinute();
        $openCalls      = CallRequest::where('status','pending')->where('created_at','<',$oneMinuteAgo)->get(['id','unique_code']);

        foreach ($openCalls as $openCall)  {

            $unique_code = $openCall->unique_code;

            $cal = CallRequest::where('unique_code',$unique_code)->first();
        
            if($cal->count()) {
            
                $old_status=$cal->status;

                $cal->status='end';

                if($old_status=='doing') $cal->end_call = Carbon::now();

                $cal->end_call_id = $cal->user_id;

                $cal->update();

                if($old_status=='doing') {

                    $min_call = Carbon::parse($cal->start_call)->diffInSeconds(Carbon::parse($cal->end_call),false);

                    $cal->price_call=(round($min_call/60,1))*$cal->price_min;

                    $cal->update();

                    //return amount
                    $user = $cal->user;
                    if($user) {
                        $user->amount += ($cal->price_service-$cal->price_call);
                        $user->update();
                    }

                } elseif($old_status=='pending')  {
                    //return amount
                    $user=$cal->user;
                    if($user) {
                        $user->amount+=$cal->price_service;
                        $user->update();
                    }
                }

            }
            
        }

    }
}
