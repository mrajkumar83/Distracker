<?php
class Query extends Database{
	function storeDetails($table, $params, $id = NULL){
		$q = (($id) ? 'UPDATE '. $table .' SET '. $params .$id : 'INSERT INTO ' . $table . ' SET ' . $params);	
		//echo $q,'<hr>';		
		$retVal = (string)($this->change($q))? true : 'Err0';
        return $retVal;
	}
	
	function delData($table, $id = NULL, $cond = NULL) {
		if($cond == NULL)
		{
			if($id == NULL)
			{
				$q = 'TRUNCATE TABLE '.$table;
			}
			else 
			{
				$q = 'DELETE FROM '.$table.' WHERE '.$id;
			}
		}
		else
		{
			$q = 'DELETE FROM '.$table;
			if($id)
			{
				$q .= ' WHERE '.$id;
			}
		}
			        
        return $this->change($q);
    }
	
	function fetchRecord($table, $params = ' * ', $cond = NULL){
		$q = 'SELECT'.$params.'FROM '. $table.(($cond) ? ' WHERE '.$cond : '');		
		$this->query($q);
		//echo $q,'<hr>';
        return $this->getRowObject();		
	}
	
	function fetchAllRecord($table, $params = ' * ', $cond = NULL, $search = NULL, $ord=NULL, $ordkey = 'ASC', $startPt = 0, $limit = MAX_ENTRIES_PER_PAGE){
		$suffix = '';
		if($cond)
			$suffix = ' WHERE '.$cond;
		if($search)
			$suffix .= (($cond) ? ' AND ' : ' WHERE ').$search;
			
		$q = 'SELECT '.$params.'FROM '. $table;
		$this->query($q.$suffix);
		$this->totalcnt = $this->_rowCount;
		if($ord)
			$suffix .= ' ORDER BY '.$ord.' '.$ordkey;
		if($limit != 'All')
			$suffix .= ' LIMIT '.$startPt.','.$limit;
			
		$q .= $suffix;
		echo $q,'<hr>';
		return $this->query($q);
	}
	function callProcedure()
	{
		$arg =  func_get_args();
		$cnt = (int) func_num_args();
		$params = (string)'(';
		for($i=1; $i<$cnt; $i++)
		{
			$params .= $arg[$i].',';
		}
		$q = 'CALL '.$arg[0].trim($params, ',').');';
		if(strpos($arg[$cnt-1], '@') != -1)
		{
			mysql_query($q, $this->_resConn);
			$q = ' SELECT '.$arg[$cnt-1].';';			
		}
		return mysql_query($q, $this->_resConn );
	}
	
}//End of class
