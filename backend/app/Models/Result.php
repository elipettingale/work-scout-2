<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Result extends Model
{
    use HasFactory;

    protected $fillable = [
        'job_site',
        'reference',
        'title',
        'min_rate',
        'max_rate',
        'length',
        'ir35',
        'remote',
        'description',
        'url',
        'posted_at'
    ];
    
    protected $dates = [
        'posted_at',
        'read_at'
    ];

    protected $casts = [
        'ir35' => 'bool',
        'remote' => 'bool',
        'keywords' => 'array',
        'raw' => 'array'
    ];

    public function parent()
    {
        return $this->belongsTo(Result::class, 'parent_id');
    }

    public function children()
    {
        return $this->hasMany(Result::class, 'parent_id');
    }

    public function markAsRead()
    {
        foreach ($this->children as $child) {
            $child->read_at = now();
            $child->save();
        }

        $this->read_at = now();
        $this->save();
    }
}
