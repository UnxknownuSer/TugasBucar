<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JournalView extends Model
{
    use HasFactory;

    protected $fillable = [
        'journal_id',
        'user_id',
        'ip',
    ];

    public function journal()
    {
        return $this->belongsTo(Journal::class);
    }

    public function user()
    {
        return $this->belongsTo(\App\Models\User::class);
    }
}
