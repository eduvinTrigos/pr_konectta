<?php

class Cs extends CI_Model {

    public function __construct()
    {
        $this->load->database();
    }

     /**
    * pushtodb
    *
    * This method is used to Insert data into a database table
    *
    * @access public
    * @param array $data array with table columns and values to be saved in table
    * @param string $table table name to insert data
    * @param string $table table name to insert data
    * @param boolean $last_query defines if the last query executed will be returned
    * @return string || boolean 
    */
    public function pushtodb($data, $table,$last_query=null)
    {

        $this->db->set($data);
        $query = $this->db->insert($table, $data);
        if(!$query)
        {
            return array($this->db->error()['message']);
        }
        if($last_query)
        {
            return $this->db->last_query();
        }
        return $query;
    }
    /**
    * getCampos
    *
    * This method is used to retrieve data from specific table
    *
    * @access public
    * @param string $table table name to load columns and data
    * @param array || string $where filter with key => value structure or in string iduser = 2
    * @param string $campos defines the columns of the table to retrieve
    * @param boolean $result defines if the last query result will be an array or an object
    * @param string $groupby defines if the query will be grouped or not
    * @param array $orderby defines if the query will be ordered, structure [field, direction] or [[field,direction],[field,direction]]
    * @param boolean $returnquery defines if the last query executed will be returned
    * @return array || object
    */
    public function getCampos($table, $where = NULL, $campos="*", $result=0, $groupby=NULL, $orderby=NULL,$returnquery=NULL)
    {
        try {
            
            $this->db->select($campos);
            if($groupby)
            {
                $this->db->group_by($groupby);
            }
            if($orderby)
            {
                if(is_array($orderby[0]) && count($orderby[0])>1)
                {
                    foreach ($orderby[0] as $key => $value) {
                        $this->db->order_by($value,$orderby[1][$key]);
                    }
                }else{
                    $this->db->order_by($orderby[0],$orderby[1]);
                }
            }
            if(!$where){
                $query = $this->db->get($table);
                if($returnquery)
                {
                    return $this->db->last_query();
                }
                if($result==1){
                    return $query;
                }else{
                    if(!is_array($query) && $query)
                    {
                        return $query->result_array();
                    }else{
                        throw new Exception("Error Processing Request: ".$this->db->error()['message'], 1);
                        
                    }
                }
            }

            $query = $this->db->get_where($table, $where);

            if($returnquery)
            {
                return $this->db->last_query();
            }
            if($result==1){
                return $query;
            }else{  
                if(!is_array($query) && $query)
                {
                    return $query->result_array();
                }else{
                    throw new Exception("Error Processing Request: ".$this->db->error()['message'], 1);
                    
                }
            }
        } catch (Exception $e) {
            return ["msj" => "Error :".$e->getMessage()];
        }
    }
    /**
    * getCamposAndJoin
    *
    * This method is used to retrieve data from multiple tables joining them
    *
    * @access public
    * @param string $table table name to load columns and data
    * @param array || string $where filter with key => value structure or in string iduser = 2
    * @param array $join filled with the tables to join
    * @param array $fjoin filled with the columns to join, ex: u.profile = p.profile
    * @param string $campos defines the columns of the table to retrieve
    * @param boolean $result defines if the last query result will be an array or an object
    * @param string $groupby defines if the query will be grouped or not
    * @param array $orderby defines if the query will be ordered, structure [field, direction] or [[field,direction],[field,direction]]
    * @param array $limit defines the limit of the query and if the query is paginated, structure [start, end]
    * @param boolean $returnquery defines if the last query executed will be returned
    * @return array || object
    */
    public function getCamposAndJoin($table, $where, $join, $fjoin, $campos="*", $result=0, $groupby=NULL, $orderby=NULL,$limit=NULL,$having=null,$lastquery=null)
    {
        try {
            $this->db->select($campos);
            $this->db->from($table);
            if(is_array($join)){
                for ($i=0; $i < count($join); $i++) { 
                    if(strpos($join[$i], TABLE_PREFIX) === FALSE)
                    {
                        $join[$i] = TABLE_PREFIX.$join[$i];
                    }
                    $this->db->join($join[$i],$fjoin[$i],'left');
                }
            }else{
                $this->db->join($join, $fjoin,'left');
            }
            if($where)
            {
                $this->db->where($where);    
            }
            if($groupby)
            {
                $this->db->group_by($groupby);
            }
            if($orderby)
            {
                if(is_array($orderby[0]) && count($orderby[0])>1)
                {
                    foreach ($orderby[0] as $key => $value) {
                        $this->db->order_by($value,$orderby[1][$key]);
                    }
                }else{
                    $this->db->order_by($orderby[0],$orderby[1]);
                }
            }
            if($limit)
            {
                $this->db->limit($limit[0],$limit[1]);
            }
            if($having)
            {
                $this->db->having($having);
            }
            $query = $this->db->get();

            if(!is_array($query) && $query)
            {
                if($lastquery)
                {
                    return $this->db->last_query();
                }
                if($result>0)
                {
                    return $query;
                }
                return $query->result_array();
            }else{
                throw new Exception("Error Processing Request: ".$this->db->error()["message"], 1);
                
            }
        } catch (Exception $e) {
            return $e->getMessage();
        }
    }
    /**
    * execsql
    *
    * Function to execute a query
    *
    * @access public
    * @param string $sql query to be executed "Select * from $table"
    * @param boolean $last defines if the last query executed will be returned
    * @return array || object
    */
    public function execsql($sql,$last=false)
    {
        $query = $this->db->query($sql);
        
        if(!$query)
        {
            return $this->db->error();
        }
        if($last)
        {
            return $this->db->last_query();
        }
        return $query->result_array();
    }
    /**
    * updaterequest
    *
    * Function to update data in a table
    *
    * @access public
    * @param string $table table name to load columns and data
    * @param array || string $whereF filter with key => value structure or in string iduser = 2
    * @param array $data defines the data to be updated with structure columnname => columnvalue
    * @param boolean $returnquery defines if the last query executed will be returned
    * @return boolean
    */
    public function updaterequest($table, $whereF, $data, $returnquery=null)
    {
        
        $this->db->where($whereF);
        $update = $this->db->update($table, $data);
        if($returnquery)
        {
            return $this->db->last_query();
        }
        return $update;
    }
    /**
    * updaterequest
    *
    * Function to update data in a table
    *
    * @access public
    * @param array || string $where filter with key => value structure or in string iduser = 2
    * @param string $table table name to load columns and data
    * @return boolean
    */
    public function deleterequest($where, $table)
    {
        $this->db->where($where);
        $query=$this->db->delete($table);
        return $query;
    }
    
    public function fechadehoy()
    {
        return date("Y-m-d H:i:s");
    }
}