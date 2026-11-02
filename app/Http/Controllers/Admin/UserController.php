<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\View\View;

class UserController extends Controller
{
    /**
     * List all students with their learning statistics.
     */
    public function index(Request $request): View
    {
        $q = $request->query('q');

        $students = User::where('role', 'siswa')
            ->withCount(['recordings', 'activities' => fn ($query) => $query->whereNotNull('completed_at')])
            ->with([
                'quizAttempts' => fn ($query) => $query->latest()->take(1),
                'mcqAttempts' => fn ($query) => $query->latest()->take(1),
            ])
            ->when($q, fn ($query, $term) => $query->where(
                fn ($where) => $where->where('name', 'like', "%{$term}%")
                    ->orWhere('email', 'like', "%{$term}%")
            ))
            ->latest()
            ->paginate(10)
            ->withQueryString();

        return view('admin.siswa.index', [
            'students' => $students,
            'q' => $q,
        ]);
    }
}
