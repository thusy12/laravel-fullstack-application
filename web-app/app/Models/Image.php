<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Image extends Model
{
    use HasFactory;

    use SoftDeletes;

    protected $fillable = ['user_id', 'file_path', 'status'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
