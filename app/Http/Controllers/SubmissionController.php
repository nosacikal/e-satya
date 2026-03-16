<?php

namespace App\Http\Controllers;

use App\Models\Department;
use App\Models\Submission;
use Illuminate\Http\Request;
use Carbon\Carbon;

class SubmissionController extends Controller
{
    public function create()
    {
        $departments = Department::orderBy('name')->get();
        return view('public.submission', compact('departments'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nip' => 'required|string|regex:/^[0-9]{18}$/',
            'name' => 'required|string|max:255',
            'phone' => 'required|string|max:20',
            'department_name' => 'required|string|max:255',
            'submission_type' => 'required|in:10 Tahun,20 Tahun,30 Tahun',
            'file_drh' => 'required|file|mimes:pdf|max:2048',
            'file_sk_cpns' => 'required|file|mimes:pdf|max:2048',
            'file_sk_pns' => 'required|file|mimes:pdf|max:2048',
        ], [
            'nip.min' => 'NIP harus 18 digit.',
            'nip.max' => 'NIP harus 18 digit.',
            'file_drh.max' => 'File DRH maksimal 2MB.',
            'file_sk_cpns.max' => 'File SK CPNS maksimal 2MB.',
            'file_sk_pns.max' => 'File SK PNS maksimal 2MB.',
        ]);

        // Validate tenure from NIP (YYYYMMDD YYYYMM T N NNN)
        // CPNS date starts at index 8 (9th character)
        $cpnsYear = (int) substr($request->nip, 8, 4);
        $currentYear = date('Y');
        $yearsOfService = $currentYear - $cpnsYear;

        $required = (int) explode(' ', $request->submission_type)[0];

        if ($yearsOfService < $required) {
            return back()->withErrors(['nip' => 'Masa kerja (estimasi ' . $yearsOfService . ' tahun) belum memenuhi syarat untuk pengajuan Satyalancana ' . $request->submission_type . '.'])->withInput();
        }

        $fileDrh = $request->file('file_drh')->store('submissions', 'public');
        $fileSkCpns = $request->file('file_sk_cpns')->store('submissions', 'public');
        $fileSkPns = $request->file('file_sk_pns')->store('submissions', 'public');

        Submission::create([
            'nip' => $request->nip,
            'name' => $request->name,
            'phone' => $request->phone,
            'department_name' => $request->department_name,
            'submission_type' => $request->submission_type,
            'file_drh' => $fileDrh,
            'file_sk_cpns' => $fileSkCpns,
            'file_sk_pns' => $fileSkPns,
            'status' => 'submitted',
        ]);

        return redirect()->route('tracking')->with('success', 'Pengajuan berhasil dikirim! Silakan lacak status Anda dengan NIP.');
    }

    public function reUpload(Request $request, Submission $submission)
    {
        $request->validate([
            'file_drh' => 'nullable|file|mimes:pdf|max:2048',
            'file_sk_cpns' => 'nullable|file|mimes:pdf|max:2048',
            'file_sk_pns' => 'nullable|file|mimes:pdf|max:2048',
        ]);

        $data = ['status' => 'submitted', 'rejection_reason' => null];

        if ($request->hasFile('file_drh')) {
            $data['file_drh'] = $request->file('file_drh')->store('submissions', 'public');
        }
        if ($request->hasFile('file_sk_cpns')) {
            $data['file_sk_cpns'] = $request->file('file_sk_cpns')->store('submissions', 'public');
        }
        if ($request->hasFile('file_sk_pns')) {
            $data['file_sk_pns'] = $request->file('file_sk_pns')->store('submissions', 'public');
        }

        $submission->update($data);

        return redirect()->route('tracking', ['nip' => $submission->nip])->with('success', 'Dokumen berhasil diperbarui. Status kembali dalam antrean.');
    }
}
