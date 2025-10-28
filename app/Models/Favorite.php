<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id
 * @property int $user_id
 * @property int $univers_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 *
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Favorite newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Favorite newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Favorite query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Favorite whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Favorite whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Favorite whereUniversId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Favorite whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Favorite whereUserId($value)
 *
 * @mixin \Eloquent
 */
class Favorite extends Model
{
    protected $fillable = ['user_id', 'univers_id'];
}
