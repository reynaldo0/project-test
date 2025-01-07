<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ticket extends Model
{
    use HasFactory;
    protected $fillable = [
        'title',
        'message',
        'labels',
        'categories',
        'priority',
        'attachment',
        'status',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id'); // Pastikan relasi ini menggunakan 'user_id'
    }

    public function assignedTo()
    {
        return $this->belongsTo(User::class, 'assigned_to'); // Relasi dengan agen yang ditugaskan
    }
}
