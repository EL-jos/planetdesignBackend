<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Article extends Model
{
    use HasFactory, SoftDeletes;

    protected $guarded = ['id'];

    public function images(){
        return $this->morphMany(Image::class, 'imageable')->orderBy('priority');
    }

    public function subcategory(){
        return $this->belongsTo(Subcategory::class);
    }

    public function colors(){
        return $this->belongsToMany(Color::class);
    }

    public function  materials(){
        return $this->belongsToMany(Material::class);
    }

    public  function availability(){
        return $this->belongsTo(Availability::class);
    }

    public function quotes(){
        return $this->hasMany(Quote::class);
    }

    public function getFirstImageAttribute(){
        return $this->images->first()->path;
    }

    public function favorites()
    {
        return $this->hasMany(Favorite::class);
    }

    public function catalogs()
    {
        return $this->hasMany(Catalog::class);
    }

    public function compressImage(int $w = 100, int $h = 100){

        $width = $w;
        $height = $h;

        // Obtenez le chemin complet de l'image
        $imagePath = public_path($this->first_image);

        // Vérifier si le fichier existe
        if (file_exists($imagePath)) {
            // Redimensionner l'image
            $image = \Intervention\Image\Facades\Image::make($imagePath);

            // Redimensionner l'image si les paramètres de taille sont spécifiés
            if ($width && $height) {
                $image->fit($width, $height);
            }

            // Obtenez l'encodage de l'image redimensionnée
            $encodedImage = $image->encode('data-url');

            // Afficher l'image redimensionnée dans la balise <img>
            //return $encodedImage;
            //echo '<img src="'.$encodedImage.'">';
            echo $encodedImage;
        }else{
            dd('Le fichier n\existe pas');
        }

    }

    public function deal(){
        return $this->hasOne(Deal::class);
    }
}
