<?php

namespace App;


class Employee
{
    private $db = null;

    public function __construct()
    {
        $this->db = new \MongoDB\Driver\Manager("mongodb://localhost:27017");
    }

    public function search()
    {
        $columns =  array(
        array('dt' => 'name', 'db' => 'name'),
        array('dt' => 'email', 'db' => 'email'),
        array('dt' => 'position', 'db' => 'position'),
        array('dt' => 'salary', 'db' => 'salary' ),
        array('dt' => 'ver', 'db' => 'id', "formatter" => function($i, $row){
            return "<a href='employees/{$i}' class='btn btn-primery'>ver</a>";
        })
        );
        $filters = \App\DatatableSsp::filter($_REQUEST, $_REQUEST['columns']);
        if(count($filters)>0){
            $filter = ['email' => ['$regex'=>"^{$filters['email']}"]];
       }else{
            $filter = [];
        }

        $limit = \App\DatatableSsp::limit($_REQUEST, $_REQUEST['columns']);

        $options = ['sort' => ['x' => -1], 'count' => 'id',
            'limit' => $limit['length'], 'skip' => $limit['start']];

        $query = new \MongoDB\Driver\Query($filter, $options);
        $query2 = new \MongoDB\Driver\Query($filter);
        $cursor = $this->db->executeQuery('test.employees', $query);
        $cursorTotal = $this->db->executeQuery('test.employees', $query2);
        $data = array();

        $total = count($cursorTotal->toArray());
        foreach ($cursor as $document) {
            $data[] = (array) $document;
        }
        $output = \App\DatatableSsp::data_output($columns,$data);
        return json_encode(array(
            "columns" => $_REQUEST['columns'],
            "draw" => isset ( $_REQUEST['draw'] ) ? intval( $_REQUEST['draw'] ) : 0,
            "recordsTotal" => $total,
            "recordsFiltered" => $total,
            'data' => $output
        ));
    }

    /**
     * @param $id employee
     * @return array
     */
    public function find($id)
    {
        $options = [];
        $filter = ['id' => $id];
        $query = new \MongoDB\Driver\Query($filter, $options);
        $cursor = $this->db->executeQuery('test.employees', $query);
        $data = array();
        foreach ($cursor as $document) {
            $data[] = (array) $document;
        }
        $skills = array();
        foreach ($data[0]['skills'] as $skill){
            $skills[] = $skill->skill;
        }
        $data[0]['skills'] = $skills;
        return $data[0];
    }

    /**
     * Busca los salario comprendidos entre $min y $max
     * @param $min
     * @param $max
     * @return array
     * Nota: Hago una busqueda de toda la coleccion porque
     * el salario no esta en formato numerico
     */
    public function filtrarPorSalario($min, $max)
    {
        $options = ['sort' => ['id' => -1]];
        $filter = [];
        $query = new \MongoDB\Driver\Query($filter, $options);
        $cursor = $this->db->executeQuery('test.employees', $query);
        $data = array();
        foreach ($cursor as $document) {
             $emp = (array) $document;
             $emp['salary'] = str_replace(array('$', ','), '', $emp['salary']);
             if($emp['salary'] > $min && $emp['salary'] < $max){
                $data[] = array(
                 'id' => $emp['id'],
                 'isOnline' => $emp['isOnline'],
                'salary' => $emp['salary'],
                'age' => $emp['age'],
                'position' => $emp['position'],
                'name' => $emp['name'],
                'gender' => $emp['gender'],
                'email' => $emp['email'],
                'phone' => $emp['phone'],
                'address' => $emp['address']);
             }
        }
        return $data;
    }

}

