<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'transaction_date', 'total_price', 'status'];

    // Relasi ke model TransactionItem
    public function items()
    {
        return $this->hasMany(TransactionItem::class);
    }

    // Relasi ke User
    public function users()
    {
        return $this->belongsTo(User::class);
    }
}