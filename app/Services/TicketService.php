<?php

namespace App\Services;

use App\Models\Ticket;

class TicketService
{
    /**
     * Ambil semua tiket.
     *
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function getAllTickets()
    {
        return Ticket::all();
    }

    /**
     * Hitung total tiket.
     *
     * @return int
     */
    public function getTicketCount()
    {
        return Ticket::count();
    }
}
