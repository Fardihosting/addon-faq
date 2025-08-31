<?php

namespace App\Addons\Faq\Models;

use Illuminate\Database\Eloquent\Model;
use App\Addons\Faq\Models\Group;

class Faq extends Model
{
    protected $table = 'faqs';              // si le nom de table est "faqs"
    protected $fillable = ['title', 'reponse', 'group_id'];

    public function group()
    {
        return $this->belongsTo(Group::class);
    }
}
