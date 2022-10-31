<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FCMJob extends Model
{
    use HasFactory;

    protected $table = 'fcm_job';

    protected $fillable = [
        'identifier',
        'deliverAt',
    ];
}
