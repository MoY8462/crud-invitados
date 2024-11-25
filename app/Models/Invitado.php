<?php
// app/Models/Invitado.php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Invitado extends Model
{
    use HasFactory;

    protected $fillable = ['nombre', 'estatus', 'tipo', 'principal', 'folio_id'];

    public function folio()
    {
        return $this->belongsTo(Folio::class);
    }
}