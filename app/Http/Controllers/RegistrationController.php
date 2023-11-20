<?php

namespace App\Http\Controllers;

use App\Models\Event;
use App\Models\Participant;
use Illuminate\Http\Request;

class RegistrationController extends Controller
{
    public function index()
    {
        return view("registration.form", [
            "events" => Event::get(),
        ]);
    }

    public function store(Request $request)
    {
        $validations = $request->validate([
            'event' => 'required',
            'name' => 'required',
            'email' => 'email|required',
            'phone' => 'required',
            'address' => 'required',
        ]);

        unset($validations['event']);

        $validations['event_id'] = $request->event;
        $validations['uniq_code'] = $this->generateUniqueCode();

        $participant = Participant::create($validations);

        if ($participant) {
            $msg = ['msg' => 'Registration success', 'msg_class' => 'success', 'msg_highlight' => 'Succeed'];
        } else {
            $msg = ['msg' => 'Registration failed', 'msg_class' => 'danger', 'msg_highlight' => 'Failed'];
        }

        return redirect("/registration/$participant->id")->with($msg);
    }

    private  function generateUniqueCode($length = 10)
    {
        $characters = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charactersNumber = strlen($characters);


        $code = '';

        while (strlen($code) < $length) {
            $position = rand(0, $charactersNumber - 1);
            $character = $characters[$position];
            $code = $code . $character;
        }

        if (Participant::where('uniq_code', $code)->exists()) {
            $this->generateUniqueCode($length);
        }

        return $code;
    }
}
