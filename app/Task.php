<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    // 追加・更新を行っても良いカラムの設定
    protected $fillable = ['title', 'executed'];
}
