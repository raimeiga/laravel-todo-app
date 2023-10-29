<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Goal extends Model
{
    use HasFactory;
    public function user() {
        return $this->belongsTo(User::class);  //← usersテーブルとのリレーションシップを設定
    }
    public function todos() {
        return $this->hasMany(Todo::class);    //← todosテーブルとのリレーションシップを設定
    }   
}
