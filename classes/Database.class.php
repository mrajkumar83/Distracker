<?php
class Database
{
	private $_strHost;
	private $_strUser;
	private $_strPassword;
	private $_strDatabase;
	public $_resConn;  // connection link;
	public $_resResult;
	public $_rowCount = 0 ;
	public $newRowId;
	public $totalcnt;

	function Database($strHost = DATABASE_HOST, $strDatabase = DATABASE_NAME, $strUser = DATABASE_USER, $strPassword = DATABASE_PASSWORD)
	{
		$this->_strHost = $strHost ;
		$this->_strDatabase = $strDatabase;
		$this->_strUser = $strUser;
		$this->_strPassword = $strPassword;
		$this->_rowCount = 0;	
		$this->connect();
	}
	protected function connect() //  returns connection resource
	{
		$res = mysql_pconnect($this->_strHost, $this->_strUser, $this->_strPassword);//  ) or die('Unable to connect to DB');
		 if(mysql_errno($res) == 0)
		{
			mysql_select_db($this->_strDatabase, $res)
			  or die("Error accessing database!!!!!!".$this->_strDatabase);  // Or redirect to DATABASE ERROR page.
			$this->_resConn = $res;
			return $this;
		}
		else
		{
			 return false;
		}
	}

	

	function query($strSql) // returns false on error
    {

      if(trim($strSql) != '')
      {
		if($this->_resResult = mysql_query($strSql, $this->_resConn ))
        {
          $this->_rowCount = mysql_num_rows($this->_resResult);
          return $this->_resResult;

        }

        else

        {

          if(defined('APPLICATION_TITLE'))

            echo '<b>' . APPLICATION_TITLE . '</b><br>';

          echo 'Error executing query: ' . $strSql . '<br>';

          echo mysql_error();
		  trigger_error('Error executing query: '.mysql_error(),E_USER_ERROR);

        }

      }

      return false;

    }



    function change($strSql) // for insert/update/delete
    {

      if(trim($strSql) != '')
      {

        if($this->_resResult = mysql_query($strSql, $this->_resConn))

        {

            $this->newRowId = mysql_insert_id();

            $this->_rowCount = mysql_affected_rows($this->_resConn);

            return $this->_resResult;

        }

        else

        {

          if(defined('APPLICATION_TITLE'))

            echo '<b>' . APPLICATION_TITLE . '</b><br>';

          echo 'Error executing query: ' . $strSql . '<br>';

          echo mysql_error();          

          //throw new Exception('Error Executing Query '.$strSql.'<br/>'.mysql_error($this->_resConn),mysql_errno($this->_resConn));

        }

      }
      return false;

    }

    function getRowObject()
    {
      $theObject = null;
      if($this->_resResult)
      {
         $theObject = mysql_fetch_object($this->_resResult);
          if(!$theObject)
              echo mysql_error();
      }
      return $theObject;
    }

    function getRowCount()
    {
      return $this->_rowCount;
    }

    function getNewRowId()
    {
      return $this->_newRowId;
    }

	function queryFetch($query){

		$res = mysql_query($query, $this->_resConn);
		$this->_rowCount = mysql_num_rows($res);
		return $res;

	}  

}