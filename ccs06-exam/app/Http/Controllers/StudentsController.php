<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class StudentsController extends Controller
{
    public function begin()
    {
        return view('begin');
    }

    public function enterGrades(Request $request)
    {
        $student_1 = $request->name_1;
        $student_2 = $request->name_2;
        $student_3 = $request->name_3;
        $student_4 = $request->name_4;
        $student_5 = $request->name_5;

        return view('enter-grades', [
            'student_1' => $student_1,
            'student_2' => $student_2,
            'student_3' => $student_3,
            'student_4' => $student_4,
            'student_5' => $student_5
        ]);
    }

    protected function computeAverageGrade($midterm, $finals)
    {
        $average = ($midterm + $finals) / 2;
        return round($average, 2);
    }

    protected function determineRemarks($average)
    {
        if ($average >= 75)
        {
            return "PASSED";
        }
        else
        {
            return "FAILED";
        }
    }

    public function computeGrades(Request $request)
    {
        $student_1 = $request->student_1;
        $student_2 = $request->student_2;
        $student_3 = $request->student_3;
        $student_4 = $request->student_4;
        $student_5 = $request->student_5;

        $s1_average = $this->computeAverageGrade($request->s1_midterm, $request->s1_finals);
        $s2_average = $this->computeAverageGrade($request->s2_midterm, $request->s2_finals);
        $s3_average = $this->computeAverageGrade($request->s3_midterm, $request->s3_finals);
        $s4_average = $this->computeAverageGrade($request->s4_midterm, $request->s4_finals);
        $s5_average = $this->computeAverageGrade($request->s5_midterm, $request->s5_finals);

        $s1_remarks = $this->determineRemarks($s1_average);
        $s2_remarks = $this->determineRemarks($s2_average);
        $s3_remarks = $this->determineRemarks($s3_average);
        $s4_remarks = $this->determineRemarks($s4_average);
        $s5_remarks = $this->determineRemarks($s5_average);

        return view('compute-grades', [
            'student_1' => $student_1,
            'student_2' => $student_2,
            'student_3' => $student_3,
            'student_4' => $student_4,
            'student_5' => $student_5,
            // Student 1 Grades
            's1_midterm' => $request->s1_midterm,
            's1_finals' => $request->s1_finals,
            's1_average' => $s1_average,
            's1_remarks' => $s1_remarks,
            // Student 2 Grades
            's2_midterm' => $request->s2_midterm,
            's2_finals' => $request->s2_finals,
            's2_average' => $s2_average,
            's2_remarks' => $s2_remarks,
            // Student 3 Grades
            's3_midterm' => $request->s3_midterm,
            's3_finals' => $request->s3_finals,
            's3_average' => $s3_average,
            's3_remarks' => $s3_remarks,
            // Student 4 Grades
            's4_midterm' => $request->s4_midterm,
            's4_finals' => $request->s4_finals,
            's4_average' => $s4_average,
            's4_remarks' => $s4_remarks,
            // Student 5 Grades
            's5_midterm' => $request->s5_midterm,
            's5_finals' => $request->s5_finals,
            's5_average' => $s5_average,
            's5_remarks' => $s5_remarks,
        ]);
    }
}
