<?php

namespace App\Http\Controllers;

use Auth;
use App\Models\File;
use App\Models\Research;
use Illuminate\Http\Request;
use Brian2694\Toastr\Facades\Toastr;

class FileController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    function __construct()
    {
        $this->middleware('permission:file-list|file-create|file-edit|file-delete', ['only' => ['index', 'show']]);
        $this->middleware('permission:file-create', ['only' => ['create', 'store']]);
        $this->middleware('permission:file-edit', ['only' => ['edit', 'update']]);
        $this->middleware('permission:file-delete', ['only' => ['destroy']]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $research_id = $request->only('research_id');

        $files = File::where('research_id', $research_id)->pluck('type', 'id')->countBy()->all();
        // dd($files);
        if ($research_id) {
            $files = File::where('research_id', $research_id)->get();
            return view('files.index', ['files' => $files, 'id' => $research_id['research_id']])
                ->with('i', (request()->input('page', 1) - 1) * 10);
        }
        return redirect()->route('researchs.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $rq = $request->only('id', 'type');
        // Log::debug("ID",$id);
        // if (!$id) return back();
        return view('files.create', $rq);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'file' => 'required',
            'id' => 'required',
        ]);
        $research_id = $request->get('id');
        $image = time() . '.' . $request->file('file')->getClientOriginalName();
        $data = $request->only('_token', '_method', 'type');
        $data['filename'] = $image;
        $data['research_id'] = $research_id;

        if (!$data['research_id']) {
            Toastr::error('Tải tệp thất bại!');
            return ['error' => 'Tải tệp thất bại!'];
        }

        $request->file->move(public_path('uploads'), $image);
        File::create($data);

        $files = File::where('research_id', $research_id)->pluck('type', 'id')->countBy()->all();
        $research = Research::find($research_id);
        if ((($files["0"] ?? 0) > 0) && (($files["1"] ?? 0) > 0) && (($files["2"] ?? 0) > 0) && (($files["3"] ?? 0) > 0)) {
            $research->status = 1;
            Toastr::success('Bạn vẫn có thể chỉnh sửa đề tài đến khi hết hạn.', 'Đề tài đã được gửi đi');
        } else {
            Toastr::error('Thiếu tệp đính kèm');
            $research->status = 0;
        }
        $research->save();

        return ['message' => 'Tải file thành công!', 'id' => $data['research_id']];
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\File  $file
     * @return \Illuminate\Http\Response
     */
    public function show(File $file)
    {
        if (($file->research->user_id == Auth::user()->id) || (Auth::user()->role < 3)|| (Auth::user()->role == 5)) {
            if (file_exists(public_path('uploads') . '/' . $file->filename))
                return response()->file(public_path('uploads') . '/' . $file->filename);
            Toastr::error("Tệp tin không tồn tại.", "Lỗi hiển thị");
            return back();
        }
        Toastr::error("Bạn đang cố gắng truy cập nội dung không đủ quyền hạn.");
        return redirect()->route('researchs.index');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\File  $file
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, File $file)
    {
        $id = $request->get('id');
        return view('files.edit', compact('file', 'id'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\File  $file
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, File $file)
    {
        $status = $request->get('status');
        if (!$status) {
            Toastr::error("Bạn chưa phê duyệt tệp tin.");
            return back()->withInput();
        }

        if ($status == 2 && !$request->get('comment')) {
            Toastr::error("Vui lòng điền lý do tên tin không hợp lệ.");
            return back()->withInput();
        }
        $file->update($request->all());
        Toastr::success('Phê duyệt thành công!');

        $research_id = $file['research_id'];
        $files = File::where([['research_id', $research_id], ['type', '>', 0]])->pluck('status', 'id')->countBy()->all();
        // Log::debug("TEST" . $research_id, $files);
        if (($files["0"] ?? 0) == 0) {
            $research = Research::find($research_id);
            if (($files["2"] ?? 0) == 0) $research->status = 2;
            else $research->status = 3;
            $research->save();
        }

        return redirect()->route('researchs.show', $request->get('id'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\File  $file
     * @return \Illuminate\Http\Response
     */
    public function destroy(File $file)
    {
        // Log::debug("File", $file);
        $file->delete();
        if (file_exists(public_path('uploads') . '/' . $file->filename))
            unlink(public_path('uploads') . '/' . $file->filename);

        $research_id = $file['research_id'];
        $files = File::where('research_id', $research_id)->pluck('type', 'id')->countBy()->all();
        $research = Research::find($research_id);
        if ((($files["0"] ?? 0) > 0) && (($files["1"] ?? 0) > 0) && (($files["2"] ?? 0) > 0) && (($files["3"] ?? 0) > 0)) {
            $research->status = 1;
            Toastr::success('Bạn vẫn có thể chỉnh sửa đề tài đến khi hết hạn.', 'Đề tài đã được gửi đi');
        } else {
            Toastr::error('Thiếu tệp đính kèm');
            $research->status = 0;
        }
        $research->save();
        return back()
            ->with('success', 'Xóa tệp tin thành công');
    }
}
