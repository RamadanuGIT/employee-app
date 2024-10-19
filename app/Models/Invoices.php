<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Invoices extends Model
{
    use HasFactory;

    protected $fillable = [
        'no_invoice',
        'date',
        'company_name',
        'job_name',
        'value',
        'penerbitan',
        'spi',
        'pelunasan',

    ];
}
