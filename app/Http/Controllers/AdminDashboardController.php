<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Services\TicketService;
use Illuminate\Http\Request;

class AdminDashboardController extends Controller
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
        return view('admin.dashboard', compact('ticketCount'));
    }

    public function index()
    {
        $ticketCount = $this->ticketService->getTicketCount();
        return view('admin.dashboard');
    }
}
