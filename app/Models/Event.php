<?php

namespace App\Models;

use Eloquent;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Carbon;

/**
 * App\Models\Event
 *
 * @property int $id
 * @property int $quantity
 * @property int $utensil_id
 * @property int $user_id
 * @property string $type
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @method static Builder|Event newModelQuery()
 * @method static Builder|Event newQuery()
 * @method static Builder|Event query()
 * @method static Builder|Event whereCreatedAt($value)
 * @method static Builder|Event whereId($value)
 * @method static Builder|Event whereQuantity($value)
 * @method static Builder|Event whereType($value)
 * @method static Builder|Event whereUpdatedAt($value)
 * @method static Builder|Event whereUserId($value)
 * @method static Builder|Event whereUtensilId($value)
 * @mixin Eloquent
 * @property int $amount
 * @method static Builder|Event whereAmount($value)
 */
class Event extends Model
{
    use HasFactory;

    protected $fillable = [
        'event_type_id',
        'user_id',
    ];

    public function details(): HasMany
    {
        return $this->hasMany(EventDetail::class);
    }
}
