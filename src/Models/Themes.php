<?php

namespace Sashagm\Themes\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Themes extends Model
{
    use HasFactory;



    protected $fillable = [
        'title',
        'description',
        'author',
        'version',
        'active',

    ];
}
