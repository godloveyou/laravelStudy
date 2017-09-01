<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\User;
class Article extends Model
{
    protected $table = 'articles';
    protected $fillable=['content'];
    public function user()
    {
        return $this->belongsTo('App\Models\User');
    }

}
