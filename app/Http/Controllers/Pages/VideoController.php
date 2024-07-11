<?php

namespace App\Http\Controllers\Pages;

use Carbon\Carbon;
use App\Models\Video;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use App\Models\VideoAccessRequest;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;

class VideoController extends Controller
{
    public function index()
    {
        $videos = Video::all();
        $customer_id = auth()->user()->customer_id;
        // dd($customer_id);
        return view('pages.videos.index', compact('videos', 'customer_id'));
    }

    public function show($id)
    {
        $video = Video::findOrFail($id);

        $customer_id = auth()->user()->customer_id;

        $data_access = VideoAccessRequest::where('customer_id', $customer_id)
        ->where('video_id', $id)
        ->orderBy('id', 'desc')
        ->first();

        if ($data_access) {
            //bandingkan waktu sekarang lebih besar daripada expired_date
            if (Carbon::now()->greaterThan($data_access->expired_at)) {
                $data_access->status = 3; // status selesai (done)
                $data_access->save();
            }
        }

        return view('pages.videos.show', compact('video', 'data_access', 'customer_id'));
    }

    public function checkStatus($id)
    {
        $video = Video::findOrFail($id);

        $customer_id = auth()->user()->customer_id;

        $data_access = VideoAccessRequest::where('customer_id', $customer_id)
        ->where('video_id', $id)
        ->orderBy('id', 'desc')
        ->first();

        return response()->json([
            'expired_at' => $data_access->expired_at,
            'status' => $data_access->status
        ]);
    }



    public function create()
    {
        return view('pages.videos.create');
    }

    // public function store(Request $request){
    //     $validation = $request->validate([
    //         'title' => 'required',
    //         'description' => 'required',
    //         'url' => 'required',
    //     ]);

    //     $create_video = Video::create($validation);

    //     return redirect()->route('video.index')->with(['success' => 'Data Berhasil Disimpan!']);
    // }

    public function store(Request $request)
    {
        // Validasi input
        $validatedData = $request->validate([
            'title' => 'required|max:255',
            'description' => 'required',
            'video_path' => 'required|mimes:mp4,mov,avi,wmv|max:204800', // maksimum 200MB
        ]);

        // Simpan video_path yang diunggah
        if ($request->hasFile('video_path')) {
            $file = $request->file('video_path');
            $fileName = time() . '_' . $file->getClientOriginalName();
            $filePath = $file->storeAs('videos', $fileName, 'public');

            // Buat entri video dalam database
            $video = new Video();
            $video->title = $validatedData['title'];
            $video->description = $validatedData['description'];
            $video->video_path = '/storage/' . $filePath; // Sesuaikan dengan lokasi penyimpanan video di storage
            $video->save();

            return redirect()->route('video.index')->with('success', 'Video berhasil diunggah.');
        }

        return back()->withInput()->withErrors(['video_path' => 'Gagal mengunggah video.']);
    }


    public function edit($id)
    {
        $video = Video::findOrFail($id);
        return view('pages.videos.edit', compact('video'));
    }

    public function update(Request $request, $id)
    {
        // Validasi input
        $validatedData = $request->validate([
            'title' => 'required|max:255',
            'description' => 'required',
            'video_path' => 'nullable|mimes:mp4,mov,avi,wmv|max:204800', // maksimum 200MB
        ]);

        // Temukan video yang akan diupdate
        $video = Video::findOrFail($id);
        $video->title = $validatedData['title'];
        $video->description = $validatedData['description'];

        // Jika ada file video baru yang diunggah, simpan yang baru
        if ($request->hasFile('video_path')) {
            // Hapus file video lama dari storage
            Storage::disk('public')->delete(str_replace('/storage/', '', $video->video_path));

            // Simpan file video baru
            $file = $request->file('video_path');
            $fileName = time() . '_' . $file->getClientOriginalName();
            $filePath = $file->storeAs('videos', $fileName, 'public');
            $video->video_path = '/storage/' . $filePath; // Sesuaikan dengan lokasi penyimpanan video di storage
        }

        $video->save();

        return redirect()->route('video.index')->with('success', 'Video berhasil diperbarui.');
    }

}
