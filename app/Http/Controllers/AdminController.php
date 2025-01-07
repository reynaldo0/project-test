<?php

namespace App\Http\Controllers;

use App\Http\Controllers\TicketController; // Import TicketController
use Illuminate\Http\Request;

class AdminController extends Controller
{
    protected $ticketController;

    public function __construct(TicketController $ticketController)
    {
        $this->ticketController = $ticketController;
    }

    /**
     * Dashboard admin dengan data dari TicketController
     */
    public function dashboard()
    {
        // Panggil metode index dari TicketController
        $data = $this->ticketController->index();

        // Tampilkan view admin dashboard dengan data tiket
        return view('admin.index', $data);
    }

    /**
     * Form pembuatan tiket admin
     */
    public function createTicket()
    {
        // Panggil metode create dari TicketController
        return $this->ticketController->create();
    }

    /**
     * Simpan tiket baru
     */
    public function storeTicket(Request $request)
    {
        // Panggil metode store dari TicketController
        return $this->ticketController->store($request);
    }

    /**
     * Edit tiket
     */
    public function editTicket($id)
    {
        // Panggil metode edit dari TicketController
        return $this->ticketController->edit($id);
    }
}
