<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Services\TicketService;
use Illuminate\Http\Request;

class DashboardController extends Controller
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
        $ticketCount = $this->ticketService->getTicketCount();
        return view('ticket.dashboard', compact('ticketCount'));
    }

    public function index()
    {
        $ticketCount = $this->ticketService->getTicketCount();
        return view('ticket.dashboard');
    }
}
