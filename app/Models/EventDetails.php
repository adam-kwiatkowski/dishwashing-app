<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class EventDetails extends Model
{
  public $timestamps = false;

  protected $fillable = [
    'event_id',
    'utensil_id',
    'amount',
  ];

  public function event(): BelongsTo
  {
    return $this->belongsTo(Event::class);
  }

  public function utensil(): BelongsTo
  {
    return $this->belongsTo(Utensil::class);
  }
}
