<?php

namespace AppBundle\Utility\Obj;

use AppBundle\Utility\Obj\CreateClass\createClass;
/**
 * 
 */
class style extends createClass
{
	protected $id;
	protected $type;
	protected $style;
	protected $html;
	protected $js;

	public function __construct($arg = NULL){
		$this->reset($arg);
	}
	public function reset($arg = NULL)
	{
		$this->id = 'style-'.$this->createID(5);
		$this->type = 'style';			
		$this->style = !isset($arg['style']) ? NULL : $arg['style'];
		$this->html = NULL;
		$this->js = array();
		$this->refreshInfo();			
	}
	public function refreshInfo(){
		$id = $this->id;
		$style = $this->style;
		
		$search = array("{ID}", "{STYLE}");
		$replace = array($id, $style);

		$tempHtml = '<style id="{ID}">{STYLE}</style>';
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

