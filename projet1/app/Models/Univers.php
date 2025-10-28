<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Notifications\Notifiable;


class Univers extends Model
{
    use HasFactory, Notifiable;

        protected $fillable = [
        'name',
        'description',
        'image',
        'logo',
        'couleur_principale',
        'couleur_secondaire',
    ];

    public function favoritedBy()
    {
    return $this->belongsToMany(User::class, 'favorites');
    }
}
