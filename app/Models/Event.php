<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Event extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'location',
        'description',
        'attachment',
        'budget_id',
        'from_time',
        'to_time'
    ];

    protected $casts = [
        'from_time' => 'datetime',
        'to_time'=> 'datetime',
    ];

    public function budget()
    {
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
}
