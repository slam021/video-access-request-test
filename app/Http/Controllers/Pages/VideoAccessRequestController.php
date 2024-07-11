<?php

namespace App\Http\Controllers\Pages;

use Carbon\Carbon;
use App\Models\Role;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use App\Models\VideoAccessRequest;
use App\Http\Controllers\Controller;

class VideoAccessRequestController extends Controller
{
    public function index()
    {
        $customer_id = auth()->user()->customer_id;
        //jika yang login customer tampilkan sesuai yg login
        if($customer_id){
            $data = VideoAccessRequest::with('customer', 'video')->where('customer_id', $customer_id)->latest()->get();
        }else{
            $data = VideoAccessRequest::with('customer', 'video')->latest()->get();
        }
        return view('pages.video_access_requests.index', compact('data'));
    }

    public function store(Request $request){
        $customer_id = auth()->user()->customer_id;
        $validation = $request->validate([
            'customer_id' => 'required',
            'video_id' => 'required',
        ]);

        // dd($validation);

        $create_video_access = VideoAccessRequest::create([
            'customer_id' => $customer_id,
            'video_id' => $request->video_id,
            'status' => 1, // pending
        ]);

        return redirect()->back()->with(['success' => 'Permintaan Sudah Tersampaikan!']);
    }

    public function edit($id)
    {
        $data_access = VideoAccessRequest::with('customer', 'video')->findOrFail($id);
        return view('pages.video_access_requests.edit', compact('data_access'));
    }

    public function update(Request $request, $id)
    {
        $validation = $request->validate([
            'status' => 'required',
        ]);

        $granted_at = Carbon::now();
        $expired_at = $granted_at->copy()->addHours(2); // +2jam
        // $expired_at = $granted_at->copy()->addSeconds(30); //+30detik

        $data_access = VideoAccessRequest::findOrFail($id);
        $data_access->update([
            'status' => $validation['status'],
            'granted_at' => $granted_at,
            'expired_at' => $expired_at,
        ]);
        return redirect()->route('video-access-request.index')->with('success', 'Data berhasil Diupdate!');
    }

    public function delete($id)
    {
        $data_access = VideoAccessRequest::findOrFail($id);

        $data_access->delete();

        //redirect to index
        return redirect()->back()->with(['success' => 'Data Berhasil Dihapus!']);
    }
}
