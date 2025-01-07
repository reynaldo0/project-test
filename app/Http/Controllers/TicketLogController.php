<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Ticket;
use App\Models\User;
use Illuminate\Http\Request;

class TicketLogController extends Controller
{
    public function index()
    {
        $agents = User::where('role', 'agent')->get();
        $tickets = Ticket::all();
        $tickets = Ticket::with('user')->get();
        return view('admin.ticket_logs.index', compact('tickets', 'agents'));
    }

    public function details($id)
    {
        // Mengambil tiket berdasarkan ID dan memuat data user terkait
        $ticket = Ticket::with('user')->findOrFail($id);

        // Mengembalikan detail tiket dalam format JSON
        return response()->json([
            'id' => $ticket->id,
            'title' => $ticket->title,
            'description' => $ticket->description,
            'created_at' => $ticket->created_at->format('d M Y H:i'),
            'user' => [
                'name' => $ticket->user ? $ticket->user->name : 'Tidak Diketahui', // Pastikan user ada
            ],
            'status' => $ticket->status,
        ]);
    }

    public function show($ticketId)
    {
        $ticket = Ticket::with('user', 'assignedTo')->findOrFail($ticketId);
        $agents = User::where('role', 'agent')->get(); // Ambil agen dari user yang memiliki role agent
        return view('admin.ticket.show', compact('ticket', 'agents'));
    }

    public function assignTicket(Request $request, $ticketId)
    {
        $ticket = Ticket::findOrFail($ticketId);

        // Validasi agen yang dipilih
        $request->validate([
            'agent_id' => 'required|exists:users,id',
        ]);

        // Assign agen ke tiket
        $ticket->agent_id = $request->agent_id;
        $ticket->save();

        return redirect()->back()->with('success', 'Agen berhasil ditugaskan.');
    }
}
