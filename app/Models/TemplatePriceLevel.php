<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class TemplatePriceLevel extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $table = 'template_price_levels';

    protected $fillable = [
        'template_id',
        'price',
        'effective_from',
        'is_active',
    ];

    protected $casts = [
        'price' => 'decimal:2',
        'effective_from' => 'date',
        'is_active' => 'boolean',
    ];

    public function template()
    {
        return $this->belongsTo(TemplateHeader::class, 'template_id', 'id');
    }
}
