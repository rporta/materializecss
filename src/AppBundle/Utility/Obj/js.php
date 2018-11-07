<?php

namespace AppBundle\Utility\Obj;

use AppBundle\Utility\Obj\CreateClass\createClass;
/**
 * 
 */
class js extends createClass
{
	protected $id;
	protected $type;
	protected $js;
	protected $html;

	public function __construct($arg = NULL){
		$this->reset($arg);
	}
	public function reset($arg = NULL)
	{
		$this->id = 'js-'.$this->createID(5);
		$this->type = 'js';			
		$this->js = !isset($arg['js']) ? array() : array($arg['js']);
		$this->html = '';
		$this->refreshInfo();			
	}
	public function refreshInfo(){
		
	}
	public function refreshId(){
		$type = $this->type;
		$id = $this->createID(5);
		$this->id = "{$type}-{$id}";
	}
    public function __set($property, $value )
    {
        $this->$property = $value;
        $this->refreshInfo();
    }
    public function __get($property)
    {
        return $this->$property;
    }

}

