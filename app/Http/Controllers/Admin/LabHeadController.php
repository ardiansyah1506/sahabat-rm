<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\LabHead;
use Illuminate\Http\Request;

class LabHeadController extends Controller
{
    public function index()
    {
        $labHeads = LabHead::latest()->get();
        return view('admin.lab_heads.index', compact('labHeads'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'nip' => 'nullable|string|max:255',
            'is_active' => 'boolean'
        ]);

        if ($request->is_active) {
            // Nonaktifkan yang lain supaya hanya satu yang aktif
            LabHead::where('is_active', true)->update(['is_active' => false]);
        }

        LabHead::create([
            'name' => $request->name,
            'nip' => $request->nip,
            'is_active' => $request->has('is_active') ? true : false,
        ]);

        return redirect()->route('admin.lab_heads.index')->with('success', 'Data Kepala Lab berhasil ditambahkan.');
    }

    public function update(Request $request, LabHead $labHead)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'nip' => 'nullable|string|max:255',
            'is_active' => 'boolean'
        ]);

        if ($request->has('is_active')) {
            // Nonaktifkan yang lain supaya hanya satu yang aktif
            LabHead::where('id', '!=', $labHead->id)->update(['is_active' => false]);
        }

        $labHead->update([
            'name' => $request->name,
            'nip' => $request->nip,
            'is_active' => $request->has('is_active') ? true : false,
        ]);

        return redirect()->route('admin.lab_heads.index')->with('success', 'Data Kepala Lab berhasil diperbarui.');
    }

    public function destroy(LabHead $labHead)
    {
        $labHead->delete();
        return redirect()->route('admin.lab_heads.index')->with('success', 'Data Kepala Lab berhasil dihapus.');
    }
}
