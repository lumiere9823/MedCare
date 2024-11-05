<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class Role extends Model
{

    protected $fillable = [
        'name',
        'description',
    ];

    /**
     * Get the users that have the role.
     */
    public function users()
    {
        return $this->belongsToMany(User::class);
    }
}