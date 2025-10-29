<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Deposit extends Model
{
    protected $table = 'deposit';
    protected $primaryKey = 'cust_ID';
    protected $guarded = [];
}
