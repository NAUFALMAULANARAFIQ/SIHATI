<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Bidang;
use App\Models\User;
use App\Services\ActivityLogService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules\Password;

class UserController extends Controller
{
    public function index()
    {
        $users = User::with('bidang')
            ->orderByRaw("FIELD(role, 'admin', 'pegawai')")
            ->oldest()
            ->paginate(10);

        $bidangs = Bidang::where('is_active', true)
            ->orderBy('nama_bidang')
            ->get();

        return view('admin.users.index', compact('users', 'bidangs'));
    }

    public function create()
    {
        $bidangs = Bidang::where('is_active', true)
            ->orderBy('nama_bidang')
            ->get();

        return view('admin.users.create', compact('bidangs'));
    }
    public function show(User $user)
    {
        return view('admin.users.show', compact('user'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => [
                'required',
                'string',
                'max:100',
            ],
            'username' => [
                'required',
                'string',
                'max:50',
                'alpha_dash',
                Rule::unique('users', 'username'),
            ],
            'email' => [
                'required',
                'email',
                'max:100',
                Rule::unique('users', 'email'),
            ],
            'password' => [
                'required',
                'confirmed',
                Password::min(8)
                    ->letters()
                    ->numbers()
                    ->mixedCase(),
            ],
            'no_hp' => [
                'nullable',
                'string',
                'max:20',
                'regex:/^[0-9+\-\s]+$/',
            ],
            'role' => [
                'required',
                Rule::in(['admin', 'pegawai']),
            ],
            'bidang_id' => [
                'nullable',
                Rule::exists('bidangs', 'id'),
            ],
            'is_active' => [
                'nullable',
                'boolean',
            ],
        ]);

        $validated['password'] = Hash::make($validated['password']);
        $validated['is_active'] = $request->boolean('is_active');

        $user = User::create($validated);

        ActivityLogService::log(
            'create',
            'user',
            'Admin menambahkan pengguna: ' . $user->name,
            'users',
            $user->id,
            null,
            $this->safeUserLogData($user)
        );

        return redirect()
            ->route('admin.users.index')
            ->with('success', 'Pengguna berhasil ditambahkan.');
    }

    public function edit(User $user)
    {
        $bidangs = Bidang::where('is_active', true)
            ->orderBy('nama_bidang')
            ->get();

        return view('admin.users.edit', compact('user', 'bidangs'));
    }

    public function update(Request $request, User $user)
    {
        $oldValues = $this->safeUserLogData($user);

        $validated = $request->validate([
            'name' => [
                'required',
                'string',
                'max:100',
            ],
            'username' => [
                'required',
                'string',
                'max:50',
                'alpha_dash',
                Rule::unique('users', 'username')->ignore($user->id),
            ],
            'email' => [
                'required',
                'email:rfc',
                'max:100',
                Rule::unique('users', 'email')->ignore($user->id),
            ],
            'password' => [
                'nullable',
                'confirmed',
                Password::min(8)
                    ->letters()
                    ->numbers()
                    ->mixedCase(),
            ],
            'no_hp' => [
                'nullable',
                'string',
                'max:20',
                'regex:/^[0-9+\-\s]+$/',
            ],
            'role' => [
                'required',
                Rule::in(['admin', 'pegawai',]),
            ],
            'bidang_id' => [
                'nullable',
                Rule::exists('bidangs', 'id'),
            ],
        ]);

        if ($request->filled('password')) {
            $validated['password'] = Hash::make($validated['password']);
        } else {
            unset($validated['password']);
        }

        $user->update($validated);

        ActivityLogService::log(
            'update',
            'user',
            'Admin mengubah pengguna: ' . $user->name,
            'users',
            $user->id,
            $oldValues,
            $this->safeUserLogData($user->fresh())
        );

        return redirect()
            ->route('admin.users.index')
            ->with('success', 'Pengguna berhasil diperbarui.');
    }

    public function toggleActive(User $user)
    {
        if (Auth::id() === $user->id) {
            return redirect()
                ->route('admin.users.index')
                ->with('error', 'Anda tidak dapat menonaktifkan akun yang sedang digunakan.');
        }

        $oldValues = $this->safeUserLogData($user);

        $user->update(['is_active' => !$user->is_active]);

        $status = $user->fresh()->is_active ? 'diaktifkan' : 'dinonaktifkan';

        ActivityLogService::log(
            'update',
            'user',
            'Admin ' . $status . ' pengguna: ' . $user->name,
            'users',
            $user->id,
            $oldValues,
            $this->safeUserLogData($user->fresh())
        );

        return redirect()
            ->route('admin.users.index')
            ->with('success', 'Pengguna berhasil ' . $status . '.');
    }


    private function safeUserLogData(User $user): array
    {
        $data = $user->toArray();

        unset(
            $data['password'],
            $data['remember_token'],
            $data['email_verified_at']
        );

        return $data;
    }
}
