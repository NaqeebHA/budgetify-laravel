<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Budget extends Model
{
    use HasFactory;
    protected $fillable = [
        'amount',
        'account_id',
        'attachment',
        'category_id',
        'description',
        'in_out',
        'note',
        'txn_datetime'
    ];

    protected $casts = [
        'txn_datetime' => 'datetime', // 'datetime' is sufficient for datetime with timezone
    ];

    public function account()
    {
        return $this->belongsTo(Account::class);
    }

    public function category() {
        return $this->belongsTo(Category::class);
    }

    public function apparels()
    {
        return $this->hasMany(Apparel::class);
    }

    public function events()
    {
        return $this->hasMany(Event::class);
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

