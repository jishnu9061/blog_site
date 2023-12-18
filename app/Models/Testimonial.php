<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Testimonial extends Model
{
    use HasFactory;

    protected $table = 'testimonials';

    protected $fillable = [
        'posted_by',
        'message',
        'profile_image',
    ];

    public static function getTableName()
    {
        return with(new static)->getTable();
    }

}
