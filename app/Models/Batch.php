<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Batch extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'sort_order'];

    /**
     * Get resources for this batch
     */
    public function academicResources()
    {
        return $this->hasMany(AcademicResource::class);
    }

    /**
     * Scope to get batches in sorted order (descending by default)
     */
    public function scopeSorted($query, $direction = 'desc')
    {
        return $query->orderBy('sort_order', $direction);
    }

    /**
     * Extract sort order from batch name (e.g., "2k21" -> 21)
     */
    public static function extractSortOrder($name)
    {
        // Extract last 2 digits from names like "2k21"
        preg_match('/(\d+)$/', $name, $matches);
        return isset($matches[1]) ? (int)$matches[1] : 0;
    }
}
