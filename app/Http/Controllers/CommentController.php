<?php

namespace App\Http\Controllers;

use App\Models\Name;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    public function store(Request $request, Name $name): RedirectResponse
    {
        $validatedData = $request->validate([
            'name' => 'required|string',
            'email' => 'required|email',
            'content' => 'required|string',
        ]);

        $name->comments()->create($validatedData);

        return back()->with('success', 'Comment added successfully.');
    }
}
