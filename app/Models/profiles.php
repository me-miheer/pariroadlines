<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class profiles extends Model
{
    use HasFactory;
    protected $fillable = ['name','address','email','mobile1','mobile2','gst','account_number','ifsc_code','bank_name','pancard_number','logo','signature'];
}
