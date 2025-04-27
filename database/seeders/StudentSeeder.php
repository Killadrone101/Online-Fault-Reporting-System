<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class StudentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $students = [
            ['name' => 'John Doe', 'student_id' => '201901470'],
            ['name' => 'Jane Smith', 'student_id' => '201902345'],
            ['name' => 'Alice Brown', 'student_id' => '201903678'],
        ];

        foreach ($students as $student) {
            $nameParts = explode(' ', $student['name']);
            $firstName = strtoupper(substr($nameParts[0], 0, 2));
            $lastName = strtoupper(substr($nameParts[1], 0, 2));
            $password = $firstName . $lastName . substr($student['student_id'], -4);

            User::create([
                'name' => $student['name'],
                'email' => $student['student_id'] . '@ub.ac.bw',
                'password' => Hash::make($password),
                'role' => 'student',
                'student_id' => $student['student_id'],
            ]);
        }
    }
}
