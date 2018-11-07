<?php

namespace AppBundle\Utility\Obj;

use AppBundle\Utility\Obj\CreateClass\createClass;

class br extends createClass
{
	protected $id;
	protected $type;
	protected $repeat;
	protected $js;
	protected $html;

	public function __construct($arg = NULL)
	{
		$this->reset($arg);
	}
	public function reset($arg = NULL)
	{
		$this->id = 'br-'.$this->createID(5);
		$this->type = 'br';
		$this->repeat = !isset($arg['repeat']) ? 1 : $arg['repeat'];
		$this->js = !isset($arg['js']) ? array() : array($arg['js']);
		$this->html = NULL;
		$this->refreshInfo();
	}
	public function refreshInfo($arg = null){
		$repeat = $this->repeat;
		$outHtml =  str_repeat("<br>", $repeat);
		$this->html = $outHtml;
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