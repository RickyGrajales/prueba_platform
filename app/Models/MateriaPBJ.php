<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MateriaPBJ extends Model
{

    use HasFactory;

    protected $table = 'materias_pbj';

    protected $fillable = ['nombre'];

} 