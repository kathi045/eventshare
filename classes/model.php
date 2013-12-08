<?php

class Model
{
	protected $_model;
	
	function __construct($id=0)
        {
		$this->_model = substr(get_class($this),0,-5);
		$this->_table = strtolower($this->_model);
                $this->_id = $id;
	}

	function __destruct()
	{
            
	}
}
