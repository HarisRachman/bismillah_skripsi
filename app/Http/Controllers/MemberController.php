<?php

namespace App\Http\Controllers;

use App\Models\Member;
use App\Models\Mentor;
use App\Models\Division;
use App\Models\Presence;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use PhpOffice\PhpSpreadsheet\IOFactory;

class MemberController extends Controller
{

    public function index()
    {
        $members = Member::all();
        $division = Division::select('id', 'name')->get();
        $mentors = Mentor::select('id', 'name')->get();
        return view('peserta.create', compact('division', 'mentors', 'members', 'presensiNow'));
    }

    public function read()
    {
        $members = Member::all();
        $division = Division::select('id', 'name')->get();
        $mentors = Mentor::select('id', 'name')->get();
        return view('peserta.read', compact('division', 'mentors', 'members'));
    }

    public function alldata()
    {
        if(auth()->user()->role == '3'){
            $members = Member::where('is_aktif', '1')->get();
        }else{
            $members = Member::where('is_aktif', '1')->where('mentors_id', Mentor::where('email', auth()->user()->email)->first()->id)->get();
        }
        
        return view('peserta.alldata', compact('members'));
    }

    public function aktifasi()
    {
        $members = Member::where('is_aktif', 0)->where('submission_status', 'Diterima')->orderBy('created_at', 'desc')->get();
        return view('peserta.aktifasi', compact('members'));
    }

    public function pengajuan()
    {
        $members = Member::where('is_aktif', 0)->orderBy('created_at', 'desc')->get();
        $divisions = Division::all();
        $mentors = Mentor::all();
        return view('peserta.pengajuan', compact('members', 'divisions', 'mentors'));
    }

    public function storeDataPost(Request $request)
    {
        $validated = $request->validate([
            'mentors_id' => 'required',
            'divisions_id' => 'required',
            'start' => 'required',
            'end' => 'required',
            'name' => 'required',
            'nikp' => 'required',
            'univ' => 'required',
            'email' => 'required',
            'description' => 'required',
            'phone' => 'required',
            'cv' => 'required',
            'internship_letter' => 'required'
        ]);
        $namecv = $request->file('file')->getClientOriginalName();
        $nameinternletter =  $request->file('file')->getClientOriginalName();
        $pathcv = $request->file('cv')->store('public/files/cv');
        $pathinternletter = $request->file('internship_letter')->store('public/files/internletter');

        $addMember = new Member([
            'mentors_id' => $request->get('name'),
            'divisions_id' => $request->get('divisions_id'),
            'start' => $request->get('start'),
            'end' => $request->get('end'),
            'name' => $request->get('name'),
            'nikp' => $request->get('nikp'),
            'univ' => $request->get('univ'),
            'email' => $request->get('email'),
            'description' => $request->get('description'),
            'phone' => $request->get('phone'),
            'cv' => $namecv,
            'internship_letter' => $nameinternletter
        ]);

        $addMember->path = $pathcv;
        $addMember->path = $pathinternletter;

        $addMember->save();
        return redirect('/createdivision')->with('status', 'File Has been uploaded successfully in laravel 8');
    }

    public function edit($id)
    {
        $members = Member::findOrFail($id);
        $divisions = Division::select('id', 'name')->get();
        $mentor = Mentor::select('id', 'name')->get();
        return view('peserta.edit', [
            'members' => $members,
            'divisions' => $divisions,
            'mentor' => $mentor
        ]);
    }

    public function update(Request $request, Member $members)
    {
        $request->validate([
            'mentors_id' => 'required',
            'divisions_id' => 'required',
            'start' => 'required',
            'end' => 'required',
            'name' => 'required',
            'nikp' => 'required',
            'univ' => 'required',
            'email' => 'required',
            'description' => 'required',
            'phone' => 'required',
            'cv' => 'required',
            'internship_letter' => 'required'
        ]);


        $name = $request->name;
        $mentors_id = $request->mentors_id;
        $divisions_id = $request->divisions_id;
        $start = $request->start;
        $end = $request->end;
        $nikp = $request->nikp;
        $univ = $request->univ;
        $email = $request->email;
        $description = $request->description;
        $phone = $request->phone;
        $cv = $request->cv;
        $internship_letter = $request->internship_letter;


        $updateMember = [
            'name' => $name,
            'mentors_id' => $mentors_id,
            'divisions_id' => $divisions_id,
            'start' => $start,
            'end' => $end,
            'nikp' => $nikp,
            'univ' => $univ,
            'email' => $email,
            'description' => $description,
            'phone' => $phone,
            'cv' => $cv,
            'internship_letter' => $internship_letter
        ];

        Member::where('id', $request->id_member)->update($updateMember);
        return redirect('/readmember');
    }

    public function dataDiri(Member $id)
    {
        $data = [];
        $member = $id->load('getDivision', 'getMentor');
        $data = [
            'start' => date('d F Y', strtotime($member->start)),
            'end' => date('d F Y', strtotime($member->end)),
            'nama' => $member->name,
            'nikp' => $member->nikp,
            'univ' => $member->univ,
            'email' => $member->email,
            'phone' => $member->phone,
            'pembimbing' => @$member->getMentor->name,
            'divisi' => @$member->getDivision->name,
            'deskripsi' => $member->description,
            'cv' => $member->cv,
            'internship_letter' => $member->internship_letter,
            'transkip' => $member->transcripts,
            'status' => $member->submission_status
        ];
        return response()->json(['member' => $data]);
    }

    public function rejectSubmition(Member $id)
    {
        $id->update([
            'submission_status' => 'Ditolak'
        ]);

        return back()->with('success', 'Pengajuan berhasil ditolak');
    }

    public function acceptSubmition(Member $id, Request $request)
    {
        $request->validate([
            'divisi' => 'required',
            'pembimbing' => 'required',
            'start'=>'required',
            'end'=>'required'
        ]);

        $id->update([
            'divisions_id' => $request->divisi,
            'mentors_id' => $request->pembimbing,
            'start'=>$request->start,
            'end'=>$request->end,
            'submission_status' => 'Diterima',
        ]);

        return back()->with('success', 'Peserta berhasil di terima');
    }

    public function activatePeserta(Member $id)
    {
        $last_nikp = Member::whereNotNull('activate_number')->orderBy('activate_number', 'desc')->first();
        $no_aktifasi = $last_nikp->activate_number + 1;
        if (Str::length($no_aktifasi) == 1) {
            $no_aktifasi = '0' . $no_aktifasi;
        }
        $nikp = 'P00' . $no_aktifasi;
        $id->update([
            'nikp' => $nikp,
            'is_aktif' => 1,
            'activate_number' => $no_aktifasi
        ]);

        return back()->with('success', 'Peserta berhasil di aktifasi');
    }

    public function submissionKP()
    {
        return view('peserta.form-pengajuan');
    }

    public function submitKP(Request $request){
     
        $request->validate([
            'name'=>'required',
            'email'=>'required',
            'phone'=>'required',
            'univ'=>'required',
            'description'=>'required',
            'start'=>'required',
            'end'=>'required',
            'cv'=>'required',
            'transcripts'=>'required',
            'internship_letter'=>'required'
        ]);
        $fileName_cv = null;
        $fileName_transcript = null;
        $fileName_letter = null;
        if ($request->hasFile('cv')) {
            $file = $request->cv;
            $dest = 'file/berkas_peserta';
            $fileName_cv = 'CV' . '_' . $request->name .date("YmdHis")  .  "." . $file->getClientOriginalExtension();
            $file->move($dest, $fileName_cv);
        }

        if ($request->hasFile('transcripts')) {
            $file = $request->transcripts;
            $dest = 'file/berkas_peserta';
            $fileName_transcript = 'Transkrip' . '_' . $request->name .date("YmdHis")  .  "." . $file->getClientOriginalExtension();
            $file->move($dest, $fileName_transcript);
        }

        if ($request->hasFile('internship_letter')) {
            $file = $request->internship_letter;
            $dest = 'file/berkas_peserta';
            $fileName_letter = 'SP' . '_' . $request->name .date("YmdHis")  .  "." . $file->getClientOriginalExtension();
            $file->move($dest, $fileName_letter);
        }
        Member::create([
            'name'=>$request->name,
            'email'=>$request->email,
            'phone'=>$request->phone,
            'univ'=>$request->univ,
            'description'=>$request->description,
            'start'=>$request->start,
            'end'=>$request->end,
            'cv'=>$fileName_cv,
            'transcripts'=>$fileName_transcript,
            'internship_letter'=>$fileName_letter,
            'submission_status'=>'Pending',
            'is_aktif'=>0,
        ]);
        return back()->with('success','Pengajuan Berhasil Dikirim');
    }

    public function export(){
        $spreadsheet = IOFactory::load('file/excel_template/Data-Peserta.xlsx');
        foreach(range('A','H') as $columnID) {
            $spreadsheet->getActiveSheet()->getColumnDimension($columnID)
                ->setAutoSize(true);
        }
        if(auth()->user()->role == '3'){
            $members = Member::with('getDivision')->where('is_aktif',1)->get();
        }else{
            $members = Member::with('getDivision')->where('is_aktif',1)->where('mentors_id',session()->get('id'))->get();
        }
       
        $row = 2;
        $no = 1;
        foreach ($members as $member) {
            $spreadsheet->setActiveSheetIndex(0)->setCellValue("A{$row}", "{$no}");
            $spreadsheet->setActiveSheetIndex(0)->setCellValue("B{$row}", $member->name);
            $spreadsheet->setActiveSheetIndex(0)->setCellValue("C{$row}", $member->univ);
            $spreadsheet->setActiveSheetIndex(0)->setCellValue("D{$row}", @$member->getDivision->name);
            $spreadsheet->setActiveSheetIndex(0)->setCellValue("E{$row}", $member->email);
            $spreadsheet->setActiveSheetIndex(0)->setCellValue("F{$row}", $member->phone);
            $spreadsheet->setActiveSheetIndex(0)->setCellValue("G{$row}", date('d F Y', strtotime($member->start)));
            $spreadsheet->setActiveSheetIndex(0)->setCellValue("H{$row}", date('d F Y', strtotime($member->end)));
            $row++;
            $no++;
        }
        $writer = IOFactory::createWriter($spreadsheet, 'Xlsx');
        ob_end_clean(); 
        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header("Content-Disposition: attachment; filename=Reports Data Peserta" . date('Y-m-d') . ".xlsx");
        $writer->save('php://output');
    }
}
