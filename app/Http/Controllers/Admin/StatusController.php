<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Status;
use App\Services\ActivityLogService;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class StatusController extends Controller
{
    public function index()
    {
        $statuses = Status::orderBy('urutan')->latest()->paginate(10);

        return view('admin.statuses.index', compact('statuses'));
    }

    public function create()
    {
        return view('admin.statuses.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama_status' => [
                'required',
                'string',
                'max:100',
                Rule::unique('statuses', 'nama_status'),
            ],
            'warna' => [
                'nullable',
                'string',
                'max:30',
            ],
            'urutan' => [
                'nullable',
                'integer',
                'min:1',
                'max:100',
            ],
            'deskripsi' => [
                'nullable',
                'string',
                'max:1000',
            ],
            'is_active' => [
                'nullable',
                'boolean',
            ],
        ]);

        $validated['is_active'] = $request->boolean('is_active');

        $status = Status::create($validated);

        ActivityLogService::log(
            'create',
            'status',
            'Admin menambahkan status aduan: ' . $status->nama_status,
            'statuses',
            $status->id,
            null,
            $status->toArray()
        );

        return redirect()
            ->route('admin.statuses.index')
            ->with('success', 'Status berhasil ditambahkan.');
    }

    public function edit(Status $status)
    {
        return view('admin.statuses.edit', compact('status'));
    }

    public function update(Request $request, Status $status)
    {
        $oldValues = $status->toArray();

        $validated = $request->validate([
            'nama_status' => [
                'required',
                'string',
                'max:100',
                Rule::unique('statuses', 'nama_status')->ignore($status->id),
            ],
            'warna' => [
                'nullable',
                'string',
                'max:30',
            ],
            'urutan' => [
                'nullable',
                'integer',
                'min:1',
                'max:100',
            ],
            'deskripsi' => [
                'nullable',
                'string',
                'max:1000',
            ],
            'is_active' => [
                'nullable',
                'boolean',
            ],
        ]);

        $validated['is_active'] = $request->boolean('is_active');

        $status->update($validated);

        ActivityLogService::log(
            'update',
            'status',
            'Admin mengubah status aduan: ' . $status->nama_status,
            'statuses',
            $status->id,
            $oldValues,
            $status->fresh()->toArray()
        );

        return redirect()
            ->route('admin.statuses.index')
            ->with('success', 'Status berhasil diperbarui.');
    }

    public function destroy(Status $status)
    {
        $oldValues = $status->toArray();

        $status->delete();

        ActivityLogService::log(
            'delete',
            'status',
            'Admin menghapus status aduan: ' . $oldValues['nama_status'],
            'statuses',
            $oldValues['id'],
            $oldValues,
            null
        );

        return redirect()
            ->route('admin.statuses.index')
            ->with('success', 'Status berhasil dihapus.');
    }
}
