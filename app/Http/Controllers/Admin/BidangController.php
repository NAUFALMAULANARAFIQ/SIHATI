<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Bidang;
use App\Services\ActivityLogService;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class BidangController extends Controller
{
    public function index()
    {
        $bidangs = Bidang::latest()->paginate(10);

        return view('admin.bidangs.index', compact('bidangs'));
    }

    public function create()
    {
        return view('admin.bidangs.create');
    }

    public function show(Bidang $bidang){
        return view('admin.bidangs.show', compact('bidang'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama_bidang' => [
                'required',
                'string',
                'max:100',
                Rule::unique('bidangs', 'nama_bidang'),
            ],
            'keterangan' => [
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

        $bidang = Bidang::create($validated);

        ActivityLogService::log(
            'create',
            'bidang',
            'Admin menambahkan bidang: ' . $bidang->nama_bidang,
            'bidangs',
            $bidang->id,
            null,
            $bidang->toArray()
        );

        return redirect()
            ->route('admin.bidangs.index')
            ->with('success', 'Bidang berhasil ditambahkan.');
    }

    public function edit(Bidang $bidang)
    {
        return view('admin.bidangs.edit', compact('bidang'));
    }

    public function update(Request $request, Bidang $bidang)
    {
        $oldValues = $bidang->toArray();

        $validated = $request->validate([
            'nama_bidang' => [
                'required',
                'string',
                'max:100',
                Rule::unique('bidangs', 'nama_bidang')->ignore($bidang->id),
            ],
            'keterangan' => [
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

        $bidang->update($validated);

        ActivityLogService::log(
            'update',
            'bidang',
            'Admin mengubah bidang: ' . $bidang->nama_bidang,
            'bidangs',
            $bidang->id,
            $oldValues,
            $bidang->fresh()->toArray()
        );

        return redirect()
            ->route('admin.bidangs.index')
            ->with('success', 'Bidang berhasil diperbarui.');
    }

    public function destroy(Bidang $bidang)
    {
        $oldValues = $bidang->toArray();

        $bidang->delete();

        ActivityLogService::log(
            'delete',
            'bidang',
            'Admin menghapus bidang: ' . $oldValues['nama_bidang'],
            'bidangs',
            $oldValues['id'],
            $oldValues,
            null
        );

        return redirect()
            ->route('admin.bidangs.index')
            ->with('success', 'Bidang berhasil dihapus.');
    }
}
