<?php

namespace App\Http\Controllers;

use App\Models\Department;
use Illuminate\Http\Request;

class DepartmentController extends Controller
{
    public function index(Request $request)
    {
        $query = Department::orderBy('name');

        if ($request->filled('search')) {
            $query->where('name', 'like', '%' . $request->search . '%');
        }

        $departments = $query->paginate(15);
        return view('admin.departments.index', compact('departments'));
    }

    public function store(Request $request)
    {
        $request->validate(['name' => 'required|string|max:255|unique:departments,name']);
        Department::create(['name' => $request->name]);
        return back()->with('success', 'OPD berhasil ditambahkan.');
    }

    public function update(Request $request, Department $department)
    {
        $request->validate(['name' => 'required|string|max:255|unique:departments,name,' . $department->id]);
        $department->update(['name' => $request->name]);
        return back()->with('success', 'OPD berhasil diperbarui.');
    }

    public function destroy(Department $department)
    {
        $department->delete();
        return back()->with('success', 'OPD berhasil dihapus.');
    }
}
