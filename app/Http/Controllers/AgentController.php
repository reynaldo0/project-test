<?php

namespace App\Http\Controllers;

use App\Models\Ticket;
use App\Services\TicketService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AgentController extends Controller
{
    /**
     * Write code on Method
     *
     * @return response()
     */

    protected $ticketService;

    public function index()
    {
        $agentId = Auth::id();

        $assignedTickets = Ticket::where('agent_id', $agentId)->get();

        return view('agent.tickets', compact('assignedTickets'));
    }

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

        return view('agent.dashboard', compact('tickets', 'ticketCount'));
    }

    public function tickets()
    {
        $user = Auth::user();

        // Tiket milik agen
        $tickets = Ticket::where('agent_id', $user->id)->get();

        return view('agent.index', compact('tickets'));
    }

    public function create()
    {
        return view('agent.create');
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
        return view('agent.edit', compact('id'));
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

        return redirect()->route('agent.index')->with('success', 'Ticket updated successfully!');
    }

    public function destroy($id)
    {
        // Cari tiket berdasarkan ID
        $ticket = Ticket::findOrFail($id);

        // Hapus tiket
        $ticket->delete();

        // Redirect dengan pesan sukses
        return redirect()->route('agent.index')->with('success', 'Tiket berhasil dihapus.');
    }
}
