<?php

namespace App\Http\Controllers;

use App\Models\Submission;
use App\Models\Department;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function dashboard()
    {
        $totalSubmissions = Submission::count();
        $processing = Submission::whereIn('status', ['submitted', 'verification', 'processing'])->count();
        $completed = Submission::where('status', 'completed')->count();
        $approved = Submission::where('status', 'approved')->count();

        $recentSubmissions = Submission::latest()->take(10)->get();

        return view('admin.dashboard', compact('totalSubmissions', 'processing', 'completed', 'approved', 'recentSubmissions'));
    }

    public function submissions(Request $request)
    {
        $query = Submission::latest();

        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                  ->orWhere('nip', 'like', "%{$search}%");
            });
        }

        if ($request->filled('department')) {
            $query->where('department_name', $request->department);
        }

        if ($request->filled('type')) {
            $query->where('submission_type', $request->type);
        }

        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        $submissions = $query->paginate(15);
        $departments = Department::orderBy('name')->get();

        return view('admin.submissions.index', compact('submissions', 'departments'));
    }

    public function showSubmission(Submission $submission)
    {
        return view('admin.submissions.show', compact('submission'));
    }

    public function updateStatus(Request $request, Submission $submission)
    {
        $request->validate([
            'status' => 'required|in:submitted,verification,processing,approved,completed,rejected',
            'rejection_reason' => 'required_if:status,rejected|nullable|string'
        ]);

        $submission->update([
            'status' => $request->status,
            'rejection_reason' => $request->status === 'rejected' ? $request->rejection_reason : null
        ]);

        return back()->with('success', 'Status pengajuan berhasil diperbarui.');
    }
}
