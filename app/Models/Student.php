<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Student extends Authenticatable
{
    use Notifiable;

    protected $fillable = [
        'student_id',
        'name',
        'email',
        'password',
        'batch',
        'phone',
        'profile_picture',
        'cgpa',
        'current_semester',
        'is_active',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
        'cgpa' => 'decimal:2',
        'is_active' => 'boolean',
    ];

    /**
     * Generate student ID based on batch and serial number
     * Format: BBYY### where BB=batch year, 07=dept code, ###=serial (001-121)
     * Example: 2107063 = 2k21 batch, dept 07 (CSE), student #063
     */
    public static function generateStudentId(string $batch, int $serialNumber): string
    {
        // Extract last 2 digits from batch (2k21 -> 21)
        $batchDigits = substr($batch, 2, 2);
        
        // Department code for CSE is always 07
        $deptCode = '07';
        
        // Serial number padded to 3 digits (001-121)
        $serial = str_pad($serialNumber, 3, '0', STR_PAD_LEFT);
        
        return $batchDigits . $deptCode . $serial;
    }

    /**
     * Get next available serial number for a batch
     */
    public static function getNextSerialForBatch(string $batch): int
    {
        $batchDigits = substr($batch, 2, 2);
        $lastStudent = self::where('batch', $batch)
            ->where('student_id', 'like', $batchDigits . '07%')
            ->orderBy('student_id', 'desc')
            ->first();

        if (!$lastStudent) {
            return 1; // First student in this batch
        }

        // Extract last 3 digits and increment
        $lastSerial = (int) substr($lastStudent->student_id, -3);
        return $lastSerial + 1;
    }

    /**
     * Validate if student ID format is correct
     * Must be 7 digits: BB07### where BB is batch year, 07 is dept, ### is 001-121
     */
    public static function isValidStudentIdFormat(string $studentId): bool
    {
        // Must be exactly 7 digits
        if (!preg_match('/^\d{7}$/', $studentId)) {
            return false;
        }

        // Extract batch digits (first 2 digits)
        $batchDigits = substr($studentId, 0, 2);
        
        // Check if batch is valid (20-24 for now, can be extended)
        if (!in_array((int)$batchDigits, [20, 21, 22, 23, 24])) {
            return false;
        }

        // Check department code (must be 07 for CSE)
        $deptCode = substr($studentId, 2, 2);
        if ($deptCode !== '07') {
            return false;
        }

        // Check serial number (001-121)
        $serial = (int) substr($studentId, 4, 3);
        if ($serial < 1 || $serial > 121) {
            return false;
        }

        return true;
    }

    /**
     * Get batch from student ID (e.g., 2107063 -> 2k21)
     */
    public function getBatchFromId(): string
    {
        $batchDigits = substr($this->student_id, 0, 2);
        return '2k' . $batchDigits;
    }

    /**
     * Get serial number from student ID (e.g., 2107063 -> 63)
     */
    public function getSerialFromId(): int
    {
        return (int) substr($this->student_id, 4, 3);
    }
}
