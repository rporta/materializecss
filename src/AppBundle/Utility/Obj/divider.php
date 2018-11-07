<?php

namespace AppBundle\Utility\Obj;

use AppBundle\Utility\Obj\CreateClass\createClass;
/**
 * 
 */
class divider extends createClass
{
	protected $id;
	protected $type;
	protected $backgroundColor;
	protected $js;
	protected $html;

	public function __construct($arg = NULL){
		$this->reset($arg);
	}
	public function reset($arg = NULL)
	{
		$this->id = 'divider-'.$this->createID(5);
		$this->type = 'divider';
		$this->backgroundColor = !isset($arg['backgroundColor']) ? 'b-w-t,2' : $arg['backgroundColor'];
		$this->js = !isset($arg['js']) ? array() : array($arg['js']);
		$this->html = NULL;
		$this->refreshInfo();			
	}
	public function refreshInfo(){
		$id = $this->id;
		$backgroundColor =  $this->backgroundColors($this->backgroundColor);

		$search = array("{ID}", "{BACKGROUNDCOLOR}");
		$replace = array("{$id}", "{$backgroundColor}");
		$tempHtml = '<div id="{ID}" class="divider {BACKGROUNDCOLOR}"></div>';
		$tempHtml = str_replace($search, $replace, $tempHtml);

		$this->html = $tempHtml;
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

