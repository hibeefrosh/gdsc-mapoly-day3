<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Notification extends Model
{
    use HasFactory;


    protected $fillable = [
        'staff_id',
        'reference_staff_id',
        'page',
    ];

    public function sender()
    {
        return $this->belongsTo(User::class, 'staff_id');
    }

}
