<?php

namespace Controllers;

use Illuminate\Support\Carbon;
use Models\Participant;

class IndexController
{
    /**
     * @return array
     */
    public function index():array
    {
        return [];
    }

    /**
     * @return void
     */
    public function checkWinner():void
    {
        $yesterdayParticipants = Participant::where('date', Carbon::yesterday())->count();
        $yesterdayParticipants = $yesterdayParticipants > 100 ? 100 : ($yesterdayParticipants <= 0 ? 1 : $yesterdayParticipants);
        $rnd1 = rand(0, $yesterdayParticipants * 10);
        $rnd2 = rand(0, $yesterdayParticipants * 10);
        $win = false;

        if($rnd1 == $rnd2){
            $win = true;
        }

        $participant = Participant::query();

        $result = [
            'result' => $win,
            'participated' => false,
        ];

        if(Participant::getWinnerToday()->exists()){
            $win = false;
        }

        if(!$participant->getParticipant()->exists()){
            $participant->create([
                'ip' => $_SERVER['REMOTE_ADDR'],
                'date' => Carbon::now(),
                'result' => $win,
            ]);
        }else{
            $user = $participant->getParticipant()->first();
            $result['result'] = $user->result;
            $result['participated'] = true;
        }
//sleep(3);
        header('Content-Type: application/json');
        http_response_code(200);
        echo json_encode($result);
        die();
    }
}