<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class CakeInterestList extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'cakes_interest_list';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'email'
    ];

    /**
     * @return BelongsTo
     */
    public function cake(): BelongsTo
    {
        return $this->belongsTo(Cake::class);
    }
}
