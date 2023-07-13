<?php

namespace App\Http\Controllers\Admin;

use App\Models\Check;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CheckControlController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $checks = Check::with('user')->get();

        $checks = $checks->map(function ($check) {
            return [
                'description' => $check->user->name,
                'amount' => $check->amount,
                'date' => $check->created_at
            ];
        })->toArray();

        return view('admin.checks-list', compact('checks'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Check $check)
    {
        // $check->with('user');
        // dd($check);
        // dd($check->user());
        return view('admin.check-details', compact('check'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
