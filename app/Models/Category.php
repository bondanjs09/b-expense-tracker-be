<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    /**
     * Nama tabel di database
     */
    protected $table = 'bet_category_tbl';

    /**
     * Primary key
     */
    protected $primaryKey = 'id';

    /**
     * Auto increment karena BIGINT
     */
    public $incrementing = true;

    /**
     * Tipe primary key
     */
    protected $keyType = 'int';

    /**
     * Karena kita pakai createdAt & updatedAt custom
     */
    public $timestamps = false;

    /**
     * Kolom yang boleh diisi mass assignment
     */
    protected $fillable = [
        'name',
        'isActive',
        'createdBy',
        'updatedBy',
        'createdAt',
        'updatedAt',
    ];

    /**
     * Casting tipe data
     */
    protected $casts = [
        'isActive'  => 'boolean',
        'createdAt' => 'datetime',
        'updatedAt' => 'datetime',
    ];

    /**
     * =========================
     * RELATION (Optional)
     * =========================
     */

    // Relasi ke tabel expenses
    public function expenses()
    {
        return $this->hasMany(Expense::class, 'categoryId');
    }

    // Relasi ke user pembuat
    public function creator()
    {
        return $this->belongsTo(User::class, 'createdBy');
    }

    // Relasi ke user pengubah
    public function updater()
    {
        return $this->belongsTo(User::class, 'updatedBy');
    }
}
