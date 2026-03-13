<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use App\Models\User;
use Carbon\Carbon;

/**
 * @property int $id
 * @property string $full_name
 * @property string $position
 * @property string $specialty
 * @property string|null $phone
 * @property string|null $email
 * @property string|null $passport
 * @property string|null $snils
 * @property string|null $inn
 * @property Carbon|null $employment_date
 * @property string|null $notes
 * @property int|null $user_id
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 */
class Employee extends Model
{
    protected $fillable = [
        'full_name', 'position', 'specialty', 'phone', 'email',
        'passport', 'snils', 'inn', 'employment_date', 'notes', 'user_id'
    ];

    protected $dates = ['employment_date'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
    /** @use HasFactory<\Database\Factories\EmployeeFactory> */
    use HasFactory;
}
