<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

/**
 * App\Models\ParentGuardian
 *
 * @property int $id
 * @property int $user_id
 * @property string|null $occupation
 * @property string|null $emergency_contact
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\User $user
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Student> $children
 * 
 * @method static \Illuminate\Database\Eloquent\Builder|ParentGuardian newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ParentGuardian newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ParentGuardian query()
 * @method static \Illuminate\Database\Eloquent\Builder|ParentGuardian whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ParentGuardian whereUserId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ParentGuardian whereOccupation($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ParentGuardian whereEmergencyContact($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ParentGuardian whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ParentGuardian whereUpdatedAt($value)
 * @method static \Database\Factories\ParentGuardianFactory factory($count = null, $state = [])
 * 
 * @mixin \Eloquent
 */
class ParentGuardian extends Model
{
    use HasFactory;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'parents';

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'user_id',
        'occupation',
        'emergency_contact',
    ];

    /**
     * Get the user that owns the parent record.
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get the children (students) associated with this parent.
     */
    public function children(): BelongsToMany
    {
        return $this->belongsToMany(Student::class, 'parent_student', 'parent_id', 'student_id')
            ->withPivot('relationship')
            ->withTimestamps();
    }
}