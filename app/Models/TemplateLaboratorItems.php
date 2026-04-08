<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TemplateLaboratorItems extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $fillable = [
        'template_id',
        'laboratory_id',
        'quantity',
    ];
    
    public function templateHeader()
    {
        return $this->belongsTo(TemplateHeader::class, 'template_id');
    }

    public function laboratoryExpenses()
    {
        return $this->belongsTo(LaboratoryExpenses::class, 'laboratory_id');
    }
}
