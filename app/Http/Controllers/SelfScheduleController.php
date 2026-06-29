<?php

namespace App\Http\Controllers;

use App\Models\Student;

class SelfScheduleController extends Controller
{
    public function index(Student $student)
    {
        return view(
            'public-mod.self-schedule-page',
            compact('student')
        );
    }
}
