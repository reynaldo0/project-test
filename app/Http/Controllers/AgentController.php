<?php

namespace App\Http\Controllers;

use App\Services\TicketService;
use Illuminate\Http\Request;

class AgentController extends Controller
{
    /**
     * Write code on Method
     *
     * @return response()
     */

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

        return view('agent.dashboard', compact('tickets', 'ticketCount'));
    }
}
