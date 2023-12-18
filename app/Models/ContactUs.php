<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ContactUs extends Model
{
    use HasFactory;

    protected $table = 'contact_us';

    protected $fillable = [
        'customer_name',
        'email',
        'subject',
        'messages',
    ];

    public static function getTableName()
    {
        return with(new static)->getTable();
    }
}
