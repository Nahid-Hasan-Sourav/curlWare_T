<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Blog extends Model
{
    use HasFactory;

    // protected $fillable = ['blog_title', 'user_id', 'featured_image', 'content'];

    protected $guarded=[];

}
