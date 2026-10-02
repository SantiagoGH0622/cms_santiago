<?php

namespace App\Http\Controllers;

use App\Models\Post;

class DashboardController extends Controller
{
    public function index()
    {
        $user = auth()->user();

        return view('dashboard', [
            'totalPosts'  => Post::count(),
            'myPosts'     => $user->posts()->count(),
            'recentPosts' => $user->posts()->latest()->take(5)->get(),
        ]);
    }
}
