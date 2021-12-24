<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ClassController extends Controller
{
    public function getStudentClass(){
        $studentClassPath = storage_path('/student_class/class.json');
        $classes = json_decode(file_get_contents($studentClassPath), true);

        return $classes;
    }
}
