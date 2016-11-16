<?php
namespace App\Repo\Repositories;
use App\Event;
use Illuminate\Container\Container as App;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use RepositoryException;


/**
 * Class Repository
 *
 * Provides abstract methods for use in scalable database integration
 *
 * @package App\Repo\Repositories
 */
abstract class Repository  implements RepositoryInterface
{

    protected $model;
    private $app;

    /**
     * Repository constructor.
     * @param App $app
     */
    public function __construct(App $app){
        $this->app=$app;
        $this->makeModel();
    }

    abstract function model();

    public function makeModel() {
        $model = $this->app->make($this->model());

        if (!$model instanceof Model)
            throw new RepositoryException("Class {$this->model()} must be an instance of Illuminate\\Database\\Eloquent\\Model");

        return $this->model = $model;
    }

    /**
     * Create new event
     *
     * @param $input
     * @return static
     */
    public function create(Array $input){

       return $this->model->create($input);
    }

    /**
     * Returns database queries based on a two table join
     *
     * @param $table1
     * @param $table2
     * @param $column1
     * @param $column2
     * @param array $array
     * @return mixed
     */
    public function findMultipleJoin($table1,$table2, $column1,$column2,Array $array){
       
        $search = "";
        $joinedTable = $this->model->join(
            $table1,
            'events'.'.'.'id',
            '=',$table1.'.'.$column1)
            ->join(
                $table2,$table1.'.'.$column2,
                '=',$table2.'.'.'id'
            );
        
        foreach($array as $key => $value){
            $search = $joinedTable->where($key,$value);

        }


        return $search->get();
    }

    /**
     *
     * Returns multiple table joins
     *
     * @param $frstTable
     * @param $scndTable
     * @param $thrdTable
     * @param $frstCol
     * @param $scndCol
     * @param $thrdCol
     * @param $frthCol
     * @param array $array
     * @return mixed
     */
    public function findJoin($frstTable,$scndTable,$thrdTable,$frstCol,$scndCol,$thrdCol,$frthCol,Array$array){
        $search = "";
        $joinedTable = $this->model->join(
            $scndTable,
            $frstTable.'.'.$frstCol,'=',$scndTable.'.'.$scndCol
            )
            ->join(
                $thrdTable,$frstTable.'.'.$thrdCol,'=',$thrdTable.'.'.$frthCol
            );
        foreach($array as $key => $value){
            $search = $joinedTable->where($key,$value);
        }
        
        return $search->get();
    }

    /**
     * @param $userID
     * @param $eventID
     * @return mixed
     */
    public function showEvent($userID,$eventID){
        $joined = $this->model->with(['event.comments.user','event' => function($query) use($eventID,$userID){
            $query->where('events.id',$eventID)
                ->where('user_id',$userID);
        }])->get();
        
        return $joined;
    }

    

    /**
     * Update event table
     *
     * @param $id
     * @param $input
     * @return mixed
     */
    public function update($id, Array $input){
        return $this->model->where('id','=',$id)
            ->update($input);
    }

    /**
     * Find event by id
     *
     * @param $id
     * @return mixed
     */
    public function find($id){

        return $this->model->find($id);
    }


    /**
     * Returns row from db table based on where clause
     *
     * @param array $array associative array of keys and values to search for
     * @return string
     */
    public function findBy(Array $array){
        $search = "";
        foreach($array as $key => $value){
            $search = $this->model->where($key,$value)->get();
        }
        return $search;
    }

    /**
     * Return all events
     *
     * @return \Illuminate\Database\Eloquent\Collection|static[]
     */
    public function all(){

        return $this->model->all();
    }
    
    public function load($model,$method){
        return $this->model->load($method.$model);
    }

    /**
     * Returns comments from associated event
     * @param $body
     * @param $userID
     * @param $eventID
     * @return mixed
     */
    public function comment($body,$userID,$eventID){
       return $this->model->addComment($body,$userID,$eventID);
    }
}