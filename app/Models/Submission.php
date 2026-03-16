<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Submission extends Model
{
    protected $fillable = [
        'nip',
        'name',
        'phone',
        'department_name',
        'submission_type',
        'file_drh',
        'file_sk_cpns',
        'file_sk_pns',
        'status',
        'rejection_reason'
    ];
}
