<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class TicketLogController extends Controller
{
    public function index()
    {
        return view('admin.ticket_logs.index'); // Buat file view ticket_logs/index.blade.php
    }
}
