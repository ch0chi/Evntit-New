<?php
namespace App\Repo\Repositories;



use Illuminate\Pagination\Paginator;

interface RepositoryInterface{

    public function create(Array $input);
    public function update($id, Array $input);
    public function findMultipleJoin($table1,$table2, $column1,$column2,Array $array);
    public function findJoin($table1,$table2,$table3,$column1,$column2,$column3,$column4, Array $array);
    public function find($id);
    public function findBy(Array $array);
    public function all();
    public function load($model,$method);
    public function comment($body,$userID,$eventID);
    public function showEvent($userID,$eventID);
}