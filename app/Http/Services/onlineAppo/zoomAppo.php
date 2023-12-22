<?php

namespace App\Http\Services\onlineAppo;

use Carbon\Carbon;
use MacsiDigital\Zoom\Facades\Zoom;

class zoomAppo{
    /**
     * Get the path the user should be redirected to when they are not authenticated.
     *0 The SMS is sent successfully.
     *-1 User is not subscribed
     * @param  \Illuminate\Http\Request  $request
     * @return string|null
     */

    


    public function createZoom($topic, $start_time){

        $user = Zoom::user()->first();
        
        $meetingData = [
            'topic' => $topic,
            'start_time' => new Carbon($start_time), // best to use a Carbon instance here ( new Carbon('2020-08-12 10:00:00'))
            //'timezone' => config('zoom.timezone'), //get it from the zoom user info
            'timezone' => 'Africa/Cairo',
        ];

        $meeting = Zoom::meeting()->make($meetingData);
            
        $meeting->settings()->make([
            'join_before_host' => false,
            'approval_type' => 1,
            'registration_type' => 2,
            'enforce_login' => false,
            'waiting_room' => false,
        ]);

        return $user->meetings()->save($meeting);

    }


}