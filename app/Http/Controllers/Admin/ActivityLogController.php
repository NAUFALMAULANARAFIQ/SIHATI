<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ActivityLog;
use App\Models\User;
use Illuminate\Http\Request;

class ActivityLogController extends Controller
{
    public function index(Request $request)
    {
        $query = ActivityLog::with('user');

        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('description', 'like', "%{$search}%")
                  ->orWhere('action', 'like', "%{$search}%")
                  ->orWhere('module', 'like', "%{$search}%");
            });
        }

        if ($request->filled('date_from')) {
            $query->whereDate('created_at', '>=', $request->date_from);
        }

        if ($request->filled('date_to')) {
            $query->whereDate('created_at', '<=', $request->date_to);
        }

        if ($request->filled('modules')) {
            $query->whereIn('module', (array) $request->modules);
        }

        if ($request->filled('actions')) {
            $query->whereIn('action', (array) $request->actions);
        }

        if ($request->filled('user_id')) {
            $query->where('user_id', $request->user_id);
        }

        $sort = $request->sort === 'asc' ? 'asc' : 'desc';
        $query->orderBy('created_at', $sort);

        $logs = $query->paginate(10)->withQueryString();

        $modules = ActivityLog::select('module')->distinct()->pluck('module');
        $actions = ActivityLog::select('action')->distinct()->pluck('action');
        $users = User::whereIn('id', ActivityLog::select('user_id')->distinct())->get();

        return view('admin.activity-logs.index', compact('logs', 'modules', 'actions', 'users'));
    }
}
