<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * A Crop
 * @property string $name
 */

class Crop extends Model
{
    use HasFactory;

    public function sample(){
        return $this->hasMany(Sample::class);
    }
}
