<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Kodeine\Metable\Metable;

class Page extends Model
{
    use HasFactory, Metable;

    protected $guarded = [
        'id'
    ];

    protected $table = 'pages';
    protected $metaTable = 'page_meta';

    protected $fillable = [
        'name','description','status',
    ];

    public static function getTableName()
    {
        return with(new static)->getTable();
    }
}
