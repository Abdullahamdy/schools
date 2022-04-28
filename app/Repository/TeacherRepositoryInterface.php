<?php
namespace App\Repository;
interface TeacherRepositoryInterface{
public function getAllTeachers();


public function getSpeciailization();

public function getGender();

public function StoreTeachers($request);
public function UpdateTeacher($request);
public function EditTeacher($id);
public function getAllGenders();
public function getAllspeciailaizations();

}
