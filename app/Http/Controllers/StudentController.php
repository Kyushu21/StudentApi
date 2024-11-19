<?php
namespace App\Http\Controllers;

use App\Models\Student;
use Illuminate\Http\Request;

class StudentController extends Controller
{
   public function index()
   {
       $students = Student::all();
       if ($students->isEmpty()) {
        $data = [
            'message' => 'No students found',
            'status' => 404
        ]; return response()->json($data, 404);
    } return response()->json($students, 200);
   }
   public function show ($id)
   {
       $student = Student::find($id);
       if ($student == null) {
              $data = [
                'message' => 'Student not found',
                'status' => 404
              ]; return response()->json($data, 404);
         } return response()->json($student, 200);
   }

public function store(Request $request)
{
     $student = new Student();
     $student->name = $request->name;
     $student->email = $request->email;
     $student->save();

     return response()->json($student, 201);
}

public function update(Request $request, $id)
{
     $student = Student::find($id);
     if ($student == null) {
          $data = [
                'message' => 'Student not found',
                'status' => 404
          ];
          return response()->json($data, 404);
     }

     $student->name = $request->name;
     $student->email = $request->email;
     $student->save();

     return response()->json($student, 200);
}

public function destroy($id)
{
     $student = Student::find($id);
     if ($student == null) {
          $data = [
                'message' => 'Student not found',
                'status' => 404
          ];
          return response()->json($data, 404);
     }

     $student->delete();

     $data = [
          'message' => 'Student deleted successfully',
          'status' => 200
     ];
     return response()->json($data, 200);
}
}