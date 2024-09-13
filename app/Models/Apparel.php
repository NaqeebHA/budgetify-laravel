<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;
use Carbon\Carbon;

class Apparel extends Model
{
    use HasFactory;

    protected $fillable = [
        'note',
        'color',
        'description',
        'attachment',
        'qty',
        'purchased_date',
        'price',
        'brand_id',
        'style_id',
        'type_id',
        'budget_id'
    ];

    protected $casts = [
        'purchased_date' => 'date',
    ];

    public function brand()
    {
        return $this->belongsTo(Brand::class);
    }
    public function style() {
        return $this->belongsTo(Style::class);
    }
    public function type() {
        return $this->belongsTo(ApparelType::class);
    }
    public function budget() {
        return $this->belongsTo(Budget::class);
    }
    protected static function boot()
    {
        parent::boot();

        static::deleting(function ($budget) {
            // Check if there is a file associated with the model
            if ($budget->attachment) {
                // Delete the file from storage
                Storage::delete('public/' . $budget->attachment);
            }
        });
    }

    public function getDateAttribute($value) {
        return Carbon::parse($value)->format('Y-m-d');
    }
}
