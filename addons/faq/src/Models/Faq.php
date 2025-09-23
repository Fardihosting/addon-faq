<?php

namespace App\Addons\Faq\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Traits\Translatable; 
use App\Models\Store\Group;

class Faq extends Model
{
    use Translatable;

    protected $table = 'faqs';       

    protected $fillable = [
        'title',
        'answer',
        'group_id',
        'order',
    ];

    protected $casts = [
        'order' => 'integer',
    ];

    protected array $translatableKeys = [
        'title'   => 'text',
        'answer' => 'textarea',
    ];

    protected $attributes = [
        'order' => 0,
    ];

    public function group()
    {
        return $this->belongsTo(Group::class);
    }
}
