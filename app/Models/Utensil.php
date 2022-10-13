<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Utensil
 *
 * @property int $id
 * @property string $name
 * @property int $quantity
 * @property int $used
 * @property string|null $image_url
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|Utensil newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Utensil newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Utensil query()
 * @method static \Illuminate\Database\Eloquent\Builder|Utensil whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Utensil whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Utensil whereImageUrl($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Utensil whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Utensil whereQuantity($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Utensil whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Utensil whereUsed($value)
 * @mixin \Eloquent
 * @property int $total_amount
 * @property int $available
 * @method static \Illuminate\Database\Eloquent\Builder|Utensil whereAvailable($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Utensil whereTotalAmount($value)
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
}
