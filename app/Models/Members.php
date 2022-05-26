<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Members extends Model
{
    use HasFactory;
    //protected $table = "members" < ini nama tabelnya, bisa ada bisa ngg
    protected $fillable = [
        'user_id',
        'name',
        'jenis_kelamin',
        'status_aktif',
        'status_iuran'
    ];

    protected $guard = [
        'id'
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
