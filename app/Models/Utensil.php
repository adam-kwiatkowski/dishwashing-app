<?php

namespace App\Models;

use Eloquent;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Support\Carbon;

/**
 * App\Models\Utensil
 *
 * @property int $id
 * @property string $name
 * @property int $quantity
 * @property int $used
 * @property string|null $image_url
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @method static Builder|Utensil newModelQuery()
 * @method static Builder|Utensil newQuery()
 * @method static Builder|Utensil query()
 * @method static Builder|Utensil whereCreatedAt($value)
 * @method static Builder|Utensil whereId($value)
 * @method static Builder|Utensil whereImageUrl($value)
 * @method static Builder|Utensil whereName($value)
 * @method static Builder|Utensil whereQuantity($value)
 * @method static Builder|Utensil whereUpdatedAt($value)
 * @method static Builder|Utensil whereUsed($value)
 * @mixin Eloquent
 * @property int $total_amount
 * @property int $available
 * @method static Builder|Utensil whereAvailable($value)
 * @method static Builder|Utensil whereTotalAmount($value)
 */
class Utensil extends Model
{
  use HasFactory;

  protected $fillable = [
    'name',
    'total_amount',
    'available',
    'image_url',
  ];

  public function events(): HasMany
  {
    return $this->hasMany(Event::class);
  }

  public function latest_event(): HasOne
  {
    return $this->hasOne(Event::class)->latestOfMany();
  }
}
