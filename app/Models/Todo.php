<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Todo extends Model
{
    use HasFactory;

     public function user() {
         return $this->belongsTo(User::class); //← usersテーブルとのリレーションシップを設定
     }

     public function goal() {
         return $this->belongsTo(Goal::class); //← goalsテーブルとのリレーションシップを設定
     }   
     
     public function tags() {
        return $this->belongsToMany(Tag::class)->withTimestamps();
    }    
}
