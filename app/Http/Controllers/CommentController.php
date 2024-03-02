<?php

namespace App\Http\Controllers;

use App\Models\Name;
use App\Services\Name\DetailService;
use Exception;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    private DetailService $detailService;

    public function __construct(DetailService $detailService)
    {
        $this->detailService = $detailService;
    }

    public function store(Request $request, string $nameSlug): RedirectResponse
    {
        $name = $this->detailService->fetchNameData($nameSlug);

        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'content' => 'required|string|max:1000',
        ]);

        $validatedData['name'] = e($validatedData['name']);
        $validatedData['email'] = e($validatedData['email']);
        $validatedData['content'] = e($validatedData['content']);

        try {
            $name->comments()->create($validatedData);
            return back()->with('success', 'Comment added successfully.');
        } catch (Exception $e) {
            logger($e->getMessage());
            return back()->with('error', 'There was a problem adding your comment.');
        }
    }
}
