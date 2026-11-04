<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $userTeacherEmail = 'richard@ski.sch.id';
        $userStudentEmail = 'andi@ski.sch.id';

        //user Teacher
        User::updateOrCreate(
            ['email' => $userTeacherEmail],
            [
                'name' => 'Richard',
                'password' => bcrypt('password'),
                'role' => 'teacher',
            ]
        );

        //user Student
        User::updateOrCreate(
            ['email' => $userStudentEmail],
            [
                'name' => 'Andi',
                'password' => bcrypt('password'),
                'role' => 'student',
            ]
        );
    }
}
