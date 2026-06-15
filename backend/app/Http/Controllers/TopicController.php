<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Topic;

class TopicController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $topics = $request
                    ->user()
                    ->topics()
                    ->latest()
                    ->get();

        return response()->json($topics);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
        ]);
        
        $topic = $request
                    ->user()
                    ->topics()
                    ->create($validated);

        return response()->json($topic, 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(Request $request, Topic $topic)
    {
        if ($topic->user_id !== $request->user()->id) {
            abort(403);
        }

        return response()->json($topic);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Topic $topic)
    {
        if ($topic->user_id !== $request->user()->id) {
            abort(403);
        }

        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
        ]);

        $topic->update($validated);
        return response()->json($topic);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request, Topic $topic)
    {
        if ($topic->user_id !== $request->user()->id) {
            abort(403);
        }

        $topic->delete();
        return response()->json(null, 204);
    }
}
