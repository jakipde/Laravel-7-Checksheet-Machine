<?php

namespace App\Models;

use Carbon\Traits\Timestamp;
use Illuminate\Database\Eloquent\Model;

class Main extends Model
{
    protected $connection = 'cmt'; // Specify the database connection
    protected $table = 'inline_defect_index'; // Specify the table name
    public $timestamps = false;
    protected $dates = [
        'datetime',
    ];
}
