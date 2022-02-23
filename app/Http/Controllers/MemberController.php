<?php

namespace App\Http\Controllers;

use App\Imports\MembersImport;
use App\Models\Member;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\Validator;

class MemberController extends Controller
{

    public function index()
    {
        return view('welcome');
    }
    public function search(Request $request)
    {
        $searchedMember = Member::where('id_number', $request->input('id_number'))->first();

        if ($searchedMember == "") {
            return view('results')->with(['errors' => "'Afwan Mshiriki Mwenye Namba Hiyo Hayajasajiliwa", 'member' => $searchedMember]);
        } else {

            return view('results')->with(['message' => 'Maa Shaa Allah, Umesajiliwa Kushiriki Dawrah Hii', 'member' => $searchedMember]);
        }
    }
    public function addMember(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'fullname' => 'required',
            'id_number' => 'required |unique:members',
            'university' => 'required',
            'phone1' => 'required',
            'phone2' => 'required',
            'amount' => 'required',
            'type' => 'required',
        ]);

        if ($validator->fails()) {
            return back()->withInput()->withErrors($validator);
        }

        $member =  Member::create([
            'fullname' => $request['fullname'],
            'id_number' => $request['id_number'],
            'university' => $request['university'],
            'phone1' => $request['phone1'],
            'phone2' => $request['phone2'],
            'amount' => $request['amount'],
            'type' => $request['type'],
        ]);
        return redirect()->back()->with(['message' => 'Umefanikiwa Kumsajili ' . $member->fullname, 'member' => $member]);
    }

    public function editMember(Request $request, $memberId)
    {

        $member = Member::find($memberId);
        if (!$member) {
            return back()->with(['error' => "Member not found"]);
        }

        $validator = Validator::make($request->all(), [
            'fullname' => 'required',
            'id_number' => 'required',
            'university' => 'required',
            'phone1' => 'required',
            'phone2' => 'required',
            'amount' => 'required',
            'type' => 'required',
        ]);

        // dd('hapa');
        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        $member->update([

            'fullname' => $request->input('fullname'),
            'id_number' => $request->input('id_number'),
            'university' => $request->input('university'),
            'phone1' => $request->input('phone1'),
            'phone2' => $request->input('phone2'),
            'amount' => $request->input('amount'),
            'type' => $request->input('type'),
        ]);
        $member->save();

        return redirect()->back()->with(['message' => 'Umefanikiwa Kubadili Taarifa za ' . $member->fullname, 'member' => $member]);
    }

    public function fileImport(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'import_file' => 'required|file|mimes:xls,xlsx,csv',
        ]);
        if ($validator->fails()) {
            return redirect()->back()->withInput()->withErrors($validator, 'bulk');
        }
        $path = $request->file('import_file');

        try {
            Excel::import(new MembersImport(), $path);
        } catch (\Maatwebsite\Excel\Validators\ValidationException $e) {
            $failures = [];
            foreach ($e->failures() as $failure) {
                $key = $failure->attribute() . $failure->row();
                $failures[$key] = "Row {$failure->row()}: " . implode(', ', $failure->errors());
            }

            return back()->withInput()->withErrors($failures, 'bulk');
        }

        return redirect()->back()->with(['message' => 'Umefanikiwa Kusajili Wanafunzi ']);
    }
    public function deleteMember($memberId)
    {
        $member = Member::findOrFail($memberId);

        $member->delete();
        return back()->with('message', 'Umefanikiwa Kumfuta Mshiriki');
    }
}
