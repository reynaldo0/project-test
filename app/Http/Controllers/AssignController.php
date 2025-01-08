<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Ticket;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AssignController extends Controller
{
    public function index()
    {
        // Ambil user yang sedang login
        $user = Auth::user();

        // Ambil tiket yang ditugaskan ke agen saat ini
        $assignedTickets = Ticket::where('agent_id', $user->id)->get();

        return view('agent.assign.index', compact('assignedTickets'));
    }
}
