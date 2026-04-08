<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TemplateBody extends Model
{
    use HasFactory;

    public $timestamps = false;
    
    protected $fillable = [
        'template_id',
        'product_id',
        'quantity',
        'duration',
        'dose',
        'frequency_id',
    ];
    
    public function templateHeader()
    {
        return $this->belongsTo(TemplateHeader::class, 'template_id');
    }

    public function product()
    {
        return $this->belongsTo(Product::class, 'product_id');
    }

    public function drugFrequency()
    {
        return $this->belongsTo(DrugFrequency::class, 'frequency_id');
    }
}
