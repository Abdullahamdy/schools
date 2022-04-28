<?php
namespace App\Repository;
interface StudentRepositoryInterface{
public function Create_Student();
public function Get_classrooms($id);
public function Get_Sections($id);
public function store_Student($request);
public function Get_Student();
public function edit($id);
public function Update_Student($request);
public function Delete_Student($request);
public function show_student($id);
public function upload_attachment($request);
public function Download_attachment($studentname,$filename);
public function Delete_attachment($request);

}
