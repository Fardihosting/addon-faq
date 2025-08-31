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
        'reponse',
        'group_id',
        'pinned',
    ];

    protected $casts = [
        'pinned' => 'boolean',
    ];

    protected array $translatableKeys = [
        'title'   => 'text',
        'reponse' => 'textarea',
    ];

    public function group()
    {
        return $this->belongsTo(Group::class);
    }
}
