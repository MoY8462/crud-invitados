<?php
// app/Models/Folio.php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Folio extends Model
{
    use HasFactory;

    protected $fillable = ['numero_folio'];

    public function invitados()
    {
        return $this->hasMany(Invitado::class);
    }
}