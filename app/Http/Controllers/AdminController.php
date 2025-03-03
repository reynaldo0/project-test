<?php

namespace App\Http\Controllers;

use App\Http\Controllers\TicketController;
use App\Models\Ticket;
use App\Services\TicketService;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    protected $ticketService;

    public function __construct(TicketService $ticketService)
    {
        $this->ticketService = $ticketService;
    }
    
    /**
     * Admin dashboard yang menampilkan data tiket
     */
    public function dashboard()
    {
        $tickets = $this->ticketService->getAllTickets();
        $ticketCount = $this->ticketService->getTicketCount();

        return view('admin.index', compact('tickets', 'ticketCount'));
    }

    public function create()
    {
        return view('admin.create');
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

        return redirect()->route('admin.dashboard')->with('success', 'Ticket berhasil dibuat!');
    }

    public function edit(Ticket $id)
    {
        return view('admin.edit', compact('id'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'message' => 'required|string',
            'labels' => 'nullable|array',
            'categories' => 'nullable|array',
            'priority' => 'required|in:low,medium,high',
            'attachment' => 'nullable|file|mimes:jpg,jpeg,png,pdf|max:2048',
        ]);

        $ticket = Ticket::findOrFail($id);

        $ticket->title = $request->input('title');
        $ticket->message = $request->input('message');
        $ticket->labels = json_encode($request->input('labels', []));
        $ticket->categories = json_encode($request->input('categories', []));
        $ticket->priority = $request->input('priority');

        if ($request->hasFile('attachment')) {
            $fileName = time() . '_' . $request->file('attachment')->getClientOriginalName();
            $request->file('attachment')->storeAs('attachments', $fileName, 'public');
            $ticket->attachment = $fileName;
        }

        $ticket->save();

        return redirect()->route('admin.index')->with('success', 'Ticket updated successfully!');
    }

    public function destroy($id)
    {
        // Cari tiket berdasarkan ID
        $ticket = Ticket::findOrFail($id);

        // Hapus tiket
        $ticket->delete();

        // Redirect dengan pesan sukses
        return redirect()->route('admin.index')->with('success', 'Tiket berhasil dihapus.');
    }
}
