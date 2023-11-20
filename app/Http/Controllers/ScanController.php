<?php

namespace App\Http\Controllers;

use App\Models\Participant;
use Illuminate\Http\Request;

class ScanController extends Controller
{
    public function index()
    {
        return view("scan-qrcode.form");
    }

    public function show(Request $request)
    {
        $participant = Participant::where('uniq_code', $request->code)->first();

        return view('scan-qrcode.checkin', ['participant' => $participant]);
    }

    public function store(Request $request)
    {

        $update = Participant::where('id', $request->participant_id)->update([
            'have_arrived' => 1,
            'arrived_at' => date('Y-m-d H:i:s'),
        ]);

        if ($update) {
            $msg = ['msg' => 'Checkin success', 'msg_class' => 'success', 'msg_highlight' => 'Succeed'];
        } else {
            $msg = ['msg' => 'Checkin failed', 'msg_class' => 'danger', 'msg_highlight' => 'Failed'];
        }

        return redirect("/scan-qrcode")->with($msg);
    }
}
