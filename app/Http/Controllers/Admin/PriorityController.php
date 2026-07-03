<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Priority;
use App\Services\ActivityLogService;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class PriorityController extends Controller
{
    public function index()
    {
        $priorities = Priority::latest()->paginate(10);

        return view('admin.priorities.index', compact('priorities'));
    }

    public function create()
    {
        return view('admin.priorities.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama_prioritas' => [
                'required',
                'string',
                'max:100',
                Rule::unique('priorities', 'nama_prioritas'),
            ],
            'level' => [
                'nullable',
                'integer',
                'min:1',
                'max:10',
            ],
            'warna' => [
                'nullable',
                'string',
                'max:30',
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

        $priority = Priority::create($validated);

        ActivityLogService::log(
            'create',
            'prioritas',
            'Admin menambahkan prioritas aduan: ' . $priority->nama_prioritas,
            'priorities',
            $priority->id,
            null,
            $priority->toArray()
        );

        return redirect()
            ->route('admin.priorities.index')
            ->with('success', 'Prioritas berhasil ditambahkan.');
    }

    public function edit(Priority $priority)
    {
        return view('admin.priorities.edit', compact('priority'));
    }

    public function update(Request $request, Priority $priority)
    {
        $oldValues = $priority->toArray();

        $validated = $request->validate([
            'nama_prioritas' => [
                'required',
                'string',
                'max:100',
                Rule::unique('priorities', 'nama_prioritas')->ignore($priority->id),
            ],
            'level' => [
                'nullable',
                'integer',
                'min:1',
                'max:10',
            ],
            'warna' => [
                'nullable',
                'string',
                'max:30',
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

        $priority->update($validated);

        ActivityLogService::log(
            'update',
            'prioritas',
            'Admin mengubah prioritas aduan: ' . $priority->nama_prioritas,
            'priorities',
            $priority->id,
            $oldValues,
            $priority->fresh()->toArray()
        );

        return redirect()
            ->route('admin.priorities.index')
            ->with('success', 'Prioritas berhasil diperbarui.');
    }

    public function destroy(Priority $priority)
    {
        $oldValues = $priority->toArray();

        $priority->delete();

        ActivityLogService::log(
            'delete',
            'prioritas',
            'Admin menghapus prioritas aduan: ' . $oldValues['nama_prioritas'],
            'priorities',
            $oldValues['id'],
            $oldValues,
            null
        );

        return redirect()
            ->route('admin.priorities.index')
            ->with('success', 'Prioritas berhasil dihapus.');
    }
}
