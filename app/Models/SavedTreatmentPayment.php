<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class SavedTreatmentPayment extends Model
{
    use HasFactory, SoftDeletes;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'saved_treatments_payments';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'template_id',
        'payment',
        'created_by',
        'updated_by',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'payment' => 'decimal:2',
    ];

    /**
     * Get the treatment that owns the payment.
     */
    public function savedTreatment()
    {
        return $this->belongsTo(SavedTreatment::class, 'template_id');
    }

    /**
     * Accessor for formatted payment amount.
     */
    public function getFormattedPaymentAttribute(): string
    {
        return number_format($this->payment, 2);
    }

    /**
     * Mutator to ensure payment is stored as decimal.
     */
    public function setPaymentAttribute($value): void
    {
        $this->attributes['payment'] = floatval($value);
    }
}