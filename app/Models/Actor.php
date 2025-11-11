<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;

/**
 * @property int $id
 * @property string $email
 * @property string $description
 * @property string $first_name
 * @property string $last_name
 * @property string $address
 * @property string|null $height
 * @property string|null $weight
 * @property string|null $gender
 * @property int|null $age
 *
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 */
class Actor extends Model
{
    use HasFactory;

    protected $fillable = [
        'email',
        'description',
        'first_name',
        'last_name',
        'address',
        'height',
        'weight',
        'gender',
        'age',
    ];
}
