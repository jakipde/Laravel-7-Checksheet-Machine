<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PartCustomerRak extends Model
{
    protected $table = 'part_customer_rak';

    protected $fillable = [
        'part_id',
        'customer_id',
        'rak_id',
    ];

    public $timestamps = false;

    public function part()
    {
        return $this->belongsTo(Part::class);
    }

    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }

    public function rak()
    {
        return $this->belongsTo(Rak::class);
    }
}
