<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use App\Models\User;
use Illuminate\Database\Eloquent\Relations\Pivot;

/**
 * @property int $id
 * @property string $name
 * @property string $description
 * @property string $image
 * @property string $logo
 * @property string $couleur_principale
 * @property string $couleur_secondaire
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\User> $favoritedBy
 * @property-read int|null $favorited_by_count
 * @property-read \Illuminate\Notifications\DatabaseNotificationCollection<int, \Illuminate\Notifications\DatabaseNotification> $notifications
 * @property-read int|null $notifications_count
 *
 * @method static \Database\Factories\UniversFactory factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Univers newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Univers newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Univers query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Univers whereCouleurPrincipale($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Univers whereCouleurSecondaire($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Univers whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Univers whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Univers whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Univers whereImage($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Univers whereLogo($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Univers whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Univers whereUpdatedAt($value)
 *
 * @mixin \Eloquent
 */
class Univers extends Model
{
    /** @use HasFactory<\Database\Factories\UniversFactory> */
    use HasFactory, Notifiable;

    protected $fillable = [
        'name',
        'description',
        'image',
        'logo',
        'couleur_principale',
        'couleur_secondaire',
    ];

    /**
     * Les utilisateurs qui ont mis cet univers en favori.
     *
    * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany<\App\Models\User, $this, \Illuminate\Database\Eloquent\Relations\Pivot, 'pivot'>
     */
    public function favoritedBy()
    {
        return $this->belongsToMany(User::class, 'favorites');
    }
}
