<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Services\ActivityLogService;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index()
    {
        $categories = Category::latest()->paginate(10);

        return view('admin.categories.index', compact('categories'));
    }

    public function create()
    {
        return view('admin.categories.create');
    }

    public function show(Category $category){
        return view('admin.categories.show', compact('category'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama_kategori' => 'required|string|max:100|unique:categories,nama_kategori',
            'deskripsi' => 'nullable|string',
            'is_active' => 'nullable|boolean',
        ]);

        $validated['is_active'] = $request->boolean('is_active');

        $category = Category::create($validated);

        ActivityLogService::log(
            'create',
            'kategori',
            'Admin menambahkan kategori aduan: ' . $category->nama_kategori,
            'categories',
            $category->id,
            null,
            $category->toArray()
        );

        return redirect()
            ->route('admin.categories.index')
            ->with('success', 'Kategori berhasil ditambahkan.');
    }

    public function edit(Category $category)
    {
        return view('admin.categories.edit', compact('category'));
    }

    public function update(Request $request, Category $category)
    {
        $oldValues = $category->toArray();

        $validated = $request->validate([
            'nama_kategori' => 'required|string|max:100|unique:categories,nama_kategori,' . $category->id,
            'deskripsi' => 'nullable|string',
            'is_active' => 'nullable|boolean',
        ]);

        $validated['is_active'] = $request->boolean('is_active');

        $category->update($validated);

        ActivityLogService::log(
            'update',
            'kategori',
            'Admin mengubah kategori aduan: ' . $category->nama_kategori,
            'categories',
            $category->id,
            $oldValues,
            $category->fresh()->toArray()
        );

        return redirect()
            ->route('admin.categories.index')
            ->with('success', 'Kategori berhasil diperbarui.');
    }

    public function destroy(Category $category)
    {
        $oldValues = $category->toArray();

        $category->delete();

        ActivityLogService::log(
            'delete',
            'kategori',
            'Admin menghapus kategori aduan: ' . $oldValues['nama_kategori'],
            'categories',
            $oldValues['id'],
            $oldValues,
            null
        );

        return redirect()
            ->route('admin.categories.index')
            ->with('success', 'Kategori berhasil dihapus.');
    }
}
