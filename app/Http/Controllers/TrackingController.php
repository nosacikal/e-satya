<?php

namespace App\Http\Controllers;

use App\Models\Submission;
use Illuminate\Http\Request;

class TrackingController extends Controller
{
    public function index(Request $request)
    {
        if ($request->has('nip')) {
            $query = Submission::where('nip', $request->nip);

            if ($request->has('submission_type')) {
                $query->where('submission_type', $request->submission_type);
            }

            $submission = $query->latest()->first();
            return view('public.tracking', compact('submission'));
        }
        return view('public.tracking');
    }

    public function track(Request $request)
    {
        $request->validate([
            'nip' => 'required',
            'submission_type' => 'required'
        ]);

        $submission = Submission::where('nip', $request->nip)
            ->where('submission_type', $request->submission_type)
            ->latest()
            ->first();

        if (!$submission) {
            return back()->withErrors(['nip' => 'Tidak ditemukan pengajuan dengan NIP dan jenis tersebut.'])->withInput();
        }

        return view('public.tracking', compact('submission'));
    }
}
