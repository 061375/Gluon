<?php
namespace Libraries;
class gl_pdoDatabase
{
	private $errors;
	
	private $db;
	
	function __construct(ErrorHandler $error_handler )
	{
		$this->errors = new $error_handler;
    }
	/**
	 * @param array database options
	 * @return void
	 * */
	public function connect($conn)
	{
		// connect to the server
        try {
            $this->db = new PDO($conn);
        } catch (PDOException $e) {
            $this->_set_error_message("Unable to select database ".$e->getMessage());
			$this->errors->display_errors();
        }	
	}
	/**
	 * runs the requested query
	 * @param $s string MYSQL query
	 * @param $v array variables for the query
	 * @param $flags array operations to call after the query has run
	 * @return mixed
	 * */
    public function Query($s,$v = array(),$flags = false)
    {
        try {
            $q = $this->db->prepare($s);
            $q->execute($v);
            if(false !== $flags) {
                $re = array();
                foreach($flags as $flag) {
                    if(false !== method_exists($this,$flag))
                    $re[$flag] = $this->$flag($q);
                }
                return $re;
            }else{
                return $q;
            }
        } catch (PDOException $e) {
            $this->_set_error_message("query error ".$e->getMessage());
			$this->errors->display_errors();
        }
    }
	/**
	 * gets the last id for an insert
	 * @return int
	 * */
    public function lastId($q)
    {
        return $this->db->lastInsertId();
    }
	/**
	 * fetches and associative array
	 * @param object reference
	 * @return array
	 * */
    public function FetchAssoc($q)
    {
        return $q->fetchAll();
    }
	/**
	 * fetches number of rows return by previous query
	 * @param object reference
	 * @return int
	 * */
    public function NumRows($q)
    {
        return $q->rowCount();
    }
	/**
	 * fetches number of rows affected by previous query
	 * @param object reference
	 * @return int
	 * */
    public function RowsAffected($q)
    {
        return $q->rowCount($q);
    }
	/**
	 * runs a query and returns an associative array all in one command without flags
	 * @param $s string query
	 * @param $k string key associated to column of interest
	 * @param $v array values
	 * @param $else what to return if no results are returned
	 * @return array
	 * */
    public function FetchResult($s,$k,$v = array(),$else = false)
    {
        $result = $this->Query($s,$v,array('FetchAssoc'));
        return isset($result['FetchAssoc'][0][$k]) ? $result['FetchAssoc'][0][$k] : $else;
    }
    /**
     * In the event of a catchable error be sure to unlock the database
     * @param mixed error message if one is returned
     * @return void
     * */
    private function _set_error_message($message)
    {
        $this->errors->set_error_message($message);
    }
}