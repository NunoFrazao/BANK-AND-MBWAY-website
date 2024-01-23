<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'id',
        'vcard',
        'date',
        'datetime',
        'type',
        'value',
        'old_balance',
        'new_balance',
        'payment_type',
        'payment_reference',
        'pair_vcard',
        'description',
        'custom_options',
    ];

    public function vCard()
    {
        return $this->belongsTo(vCard::class, 'vcard', 'phone_number');
    }

    public function customOptions()
    {
        return $this->json('custom_options');
    }
}
