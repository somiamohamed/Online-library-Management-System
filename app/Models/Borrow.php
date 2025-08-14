<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Borrow extends Model
{
    use HasFactory;

    protected $casts = [
    'borrowed_at' => 'datetime',
    'return_date' => 'datetime',
    ];

    protected $fillable = [
        'user_id',
        'book_id',
        'borrowed_at',
        'return_date',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function book()
    {
        return $this->belongsTo(Book::class);
    }
}
