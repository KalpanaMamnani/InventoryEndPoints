<?php

// app/Models/Discount.php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Discount extends Model
{
    protected $table = 'discount';

    protected $fillable = [
        'category',
        'discount',
    ];
}
