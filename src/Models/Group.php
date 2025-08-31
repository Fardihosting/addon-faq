<?php

namespace App\Addons\Faq\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;

class Group extends Model
{
    use HasFactory, SoftDeletes;

    // nom de la table si jamais Laravel essaie "groups" par défaut
    protected $table = 'groups';

    // colonnes modifiables
    protected $fillable = [
        'name',
        'slug',
        'status',
        'description',
        'image',
        'pinned',
        'sort_order',
        'parent_id',
    ];

    // Casts (pinned en booléen, status éventuellement enum string)
    protected $casts = [
        'pinned' => 'boolean',
        'sort_order' => 'integer',
        'parent_id' => 'integer',
    ];

    /**
     * Relation: un group peut contenir plusieurs FAQs
     */
    public function faqs()
    {
        return $this->hasMany(\App\Models\Faq::class, 'group_id');
    }

    /**
     * Relation hiérarchique : un group peut avoir un parent
     */
    public function parent()
    {
        return $this->belongsTo(self::class, 'parent_id');
    }

    /**
     * Relation hiérarchique : un group peut avoir plusieurs enfants
     */
    public function children()
    {
        return $this->hasMany(self::class, 'parent_id');
    }
}
