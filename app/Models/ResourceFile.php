<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ResourceFile extends Model
{
    protected $fillable = ['resource_item_id', 'titre', 'file_name', 'file_path', 'file_type'];

    public function resource()
    {
        return $this->belongsTo(ResourceItem::class, 'resource_item_id');
    }
}
