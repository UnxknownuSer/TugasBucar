<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Journal extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'authors',
        'year',
        'keywords',
        'status',
        'pdf_path',
        'user_id',
        'download_count',
    ];

    public function user()
    {
        return $this->belongsTo(\App\Models\User::class);
    }

    public function views()
    {
        return $this->hasMany(\App\Models\JournalView::class);
    }
}
