<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Ticket;
use App\Services\TicketService;
use Illuminate\Http\Request;

class TicketController extends Controller
{
    protected $ticketService;

    public function __construct(TicketService $ticketService)
    {
        $this->ticketService = $ticketService;
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $tickets = Ticket::all();
        $ticketCount = $tickets->count();
        return view('ticket.index', compact('tickets', 'ticketCount'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('ticket.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'title' => 'required|string|max:255',
            'message' => 'required|string',
            'labels' => 'required|array',
            'labels.*' => 'string|max:50',
            'categories' => 'required|array',
            'categories.*' => 'string|max:50',
            'priority' => 'required|in:low,medium,high',
            'attachment' => 'nullable|file|mimes:jpeg,png,jpg,pdf|max:2048',
        ]);

        // Simpan data ke database
        \App\Models\Ticket::create([
            'title' => $validatedData['title'],
            'message' => $validatedData['message'],
            'labels' => json_encode($validatedData['labels']),
            'categories' => json_encode($validatedData['categories']),
            'priority' => $validatedData['priority'],
            'attachment' => $request->file('attachment') ? $request->file('attachment')->store('uploads/files') : null,
        ]);

        return redirect()->route('ticket.index')->with('success', 'Ticket berhasil dibuat!');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Ticket $id) {}

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
