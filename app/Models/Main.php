<?php

namespace App\Models;

use Carbon\Traits\Timestamp;
use Illuminate\Database\Eloquent\Model;

class Main extends Model
{
    protected $connection = 'cmt'; // Specify the database connection
    protected $table = 'inline_defect_index'; // Specify the table name
    protected $fillable = ['line_id', 'date', 'pf_retry', 'pf_ng', 'atsu_retry', 'atsu_ng'];

    public $timestamps = false;
    protected $dates = [
        'datetime',
    ];
}
