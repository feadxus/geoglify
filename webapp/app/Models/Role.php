<?php

namespace App\Models;

use App\Traits\CreatedUpdatedBy;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Role extends Model
{
    use CreatedUpdatedBy, HasFactory, SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = ['title', 'description'];

    /**
     * The users that belong to the role.
     */
    public function permissions(): BelongsToMany
    {
        return $this->belongsToMany(Permission::class);
    }

    public function createdBy()
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    protected function getCreatorNameAttribute()
    {
        return $this->createdBy ? $this->createdBy->name : 'N/A';
    }

    public function updatedBy()
    {
        return $this->belongsTo(User::class, 'updated_by');
    }

    protected function getUpdaterNameAttribute()
    {
        return $this->updatedBy ? $this->updatedBy->name : 'N/A';
    }
}
