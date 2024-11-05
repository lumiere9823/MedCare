<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Medication extends Model
{
    use HasFactory;

    protected $primaryKey = 'medication_id';

    protected $fillable = [
        'name',
        'description',
        'supplier_id',
        'price',
        'stock_quantity',
    ];

    public function supplier()
{
    return $this->belongsTo(User::class, 'supplier_id'); // Corrected foreign key column
}

}