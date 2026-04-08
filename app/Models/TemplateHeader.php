<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class TemplateHeader extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $dates = ['deleted_at'];
    protected $fillable = [
        'id',
        'name',
        'name_si',
        'template_type_id',
        'template_category_id',
        'template_center_id',
        'isDisplay',
        'created_by',
        'updated_by',
    ];

    public function templateType()
    {
        return $this->belongsTo(TemplateTypes::class, 'template_type_id', 'id');
    }

    public function templateCenter()
    {
        return $this->belongsTo(Center::class, 'template_center_id', 'id');
    }

    public function templateCategory()
    {
        return $this->belongsTo(TemplateCategory::class, 'template_category_id', 'id');
    }

    public function templateBodies()
    {
        return $this->hasMany(TemplateBody::class, 'template_id');
    }

    public function templateLaboratorItems()
    {
        return $this->hasMany(TemplateLaboratorItems::class, 'template_id');
    }
    
    public function priceLevels()
    {
        return $this->hasMany(TemplatePriceLevel::class, 'template_id', 'id');
    }

    public function userCreateInfo()
    {
        return $this->belongsTo(User::class, 'created_by', 'id');
    }

    public function userUpdateInfo()
    {
        return $this->belongsTo(User::class, 'updated_by', 'id');
    }
}
