<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Monster extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'description',
        'pv',
        'attack',
        'defense',
        'image_url',
        'type_id',
        'rarety_id',
        'user_id'
    ];
    //LIAISONS
    public function type(){
        return $this->belongsTo(Type::class);
    }
    public function user(){
        return $this->belongsTo(User::class, 'user_id');
    }
    public function rarety(){
        return $this->belongsTo(Rarety::class);
    }

    //UTILITAIRES
    public function shortDescription($limit = 45, $cut = '[...]'){
        return Str::limit($this->description, $limit, $cut);
    }
    public function slugify(){
        return Str::slug($this->name);
    }

    //Accessor !!!image_url est réserver par l'accessor. Du coup pour faire référence a la colonne en db du meme nmo on utilise le tableau attribute ou getRawOriginale('image_url') pour rendre plus clean le code et éviter des boucle infinie.
    //Dans les vues on utilise la propriété image_url qui trigger cet accessor au lieu de faireréférence au champ de meme nom dans la db ! 
    // public function getImageUrlAttribute(): string
    // {
    //     $path = trim($this->getRawOriginal('image_url') ?? '');

    //     if ($path === '') {
    //         return asset('images/default-monster.png');
    //     }

    //     if (str_starts_with($path, 'monsters/')) {
    //         return asset('storage/' . $path);
    //     }

    //     return asset('images/' . $path);
    // }

    public function getImageUrlAttribute(){
        $path = trim($this->getRawOriginal('image_url') ?? '');

        if ($path === '') {
            return asset('images/default-monster.pgn');
        }
        //Url Cloudinary (souvent le mm que d'autre service cloud)
        if (str_starts_with($path, 'http')) {
            return $path;
        }

        return asset('images/' .$path);
    }
}
