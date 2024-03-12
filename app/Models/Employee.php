<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    protected $fillable = ['name', 'email', 'department_id'];

    public function department()
    {
        return $this->belongsTo(Department::class);
    }

    public static function searchEmployees($searchTerm = null, $sortField = 'name', $sortDirection = 'asc', $perPage = 5)
    {
        $query = self::with('departments');

        if ($searchTerm) {
            $query->where('name', 'like', "%$searchTerm%");
        }

        return $query->orderBy($sortField, $sortDirection)
            ->paginate($perPage);
    }


    // public static function searchEmployees($searchTerm = null, $sortField = 'name', $sortDirection = 'asc', $perPage = 5)
    // {
    //     dd($searchTerm);
    //     return self::with('departments')->when($searchTerm, function ($query) use ($searchTerm) {
    //         $query->where('name', 'like', "%$searchTerm%");
    //     })
    //         ->orderBy($sortField, $sortDirection)
    //         ->paginate($perPage);
    // }
}
