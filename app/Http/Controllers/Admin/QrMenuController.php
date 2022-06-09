<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Session;
use Auth;
use Image;
use App\Admin\Qr_Code;
use QRCode;

class QrMenuController extends Controller
{
    public function qrCode()
    {
        $qr_codes = Qr_Code::where('admin_id',auth('admin')->user()->id)->get();
        Session::flash('page', 'qr_code');
        return view('admin.qr_code.qr_code', compact('qr_codes'));
    }


    public function addQrCode()
    {
        $data = request()->all();
        $qr_code = rand(111,99999);
        $file = "image/qr/$qr_code.png";
        $admin_id = auth('admin')->user()->id;

        $link = "http://127.0.0.1:8000/{$qr_code}-{$admin_id}-{$data['table_no']}-{$data['floor']}";
        QRCode::text($link)->setErrorCorrectionLevel("H")->setOutfile($file)->png();

        $newQr = new Qr_Code();
        $newQr->admin_id = auth('admin')->user()->id;
        $newQr->table_no = $data['table_no'];
        $newQr->floor = $data['floor'];
        $newQr->table_no = $data['table_no'];
        $newQr->image = $file;
        $newQr->link = $link;
        $newQr->status = 1;
        $newQr->save();
        return redirect()->back()->with('success_message', 'QRCode has been added sucessfully');
    }

    public function editQrCode($id)
    {
        $data = request()->all();
        $qr_code = rand(111,99999);
        $file = "image/qr/$qr_code.png";
        $admin_id = auth('admin')->user()->id;
        $link = "http://127.0.0.1:8000/{$qr_code}-{$admin_id}-{$data['table_no']}-{$data['floor']}";        QRCode::text($link)->setErrorCorrectionLevel("H")->setOutfile($file)->png();
        $newQr =  Qr_Code::find($id);
        $newQr->admin_id = auth('admin')->user()->id;
        $newQr->table_no = $data['table_no'];
        $newQr->floor = $data['floor'];
        $newQr->table_no = $data['table_no'];
        $newQr->image = $file;
        $newQr->link = $link;
        $newQr->status = 1;
        $newQr->save();
        return redirect()->back()->with('success_message', 'QRCode has been update sucessfully');
    }

    public function deleteQrCode($id)
    {
        Qr_Code::where('id',$id)->delete();
        return redirect()->back()->with('success_message', 'QRCode has been deleted sucessfully');
    }
}
