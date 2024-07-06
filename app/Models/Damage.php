<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Damage extends Model
{
    use HasFactory, SoftDeletes;

    protected $guarded = [];

    public function product()
    {
        return $this->belongsTo(Product::class, 'product_id', 'id');
    }

    public function createdby()
    {
        return $this->belongsTo(User::class, 'created_by', 'id');
    }

    public function status()
    {
        return ($this->deleted_at) ? "<span class='badge bg-danger'>Deleted</span>" : "<span class='badge bg-success'>Active</span>";
    }

    public function refno()
    {
        return "REF#" . $this->id;
    }
}
