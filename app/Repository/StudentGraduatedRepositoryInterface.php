<?php
namespace App\Repository;
interface StudentGraduatedRepositoryInterface{
    public function index();
    public function create();
    public function softDelete($request);
    public function update($request);
    public function Delete($request);

}
