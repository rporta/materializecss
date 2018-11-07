<?php

namespace AppBundle\Utility\Obj;

use AppBundle\Utility\Obj\CreateClass\createClass;
/**
 * 
 */
class icon extends createClass
{
	protected $id;
	protected $type;
	protected $icon;
	protected $size;
	protected $textColor;
	protected $shadow;
	protected $cardPanel;
	protected $hoverable;
	protected $js;
	protected $class;
	protected $float;
	protected $html;

	public function __construct($arg = NULL){
		$this->reset($arg);			
	}
	public function reset($arg = NULL)
	{
		$this->id = 'icon-'.$this->createID(5);
		$this->type = 'icon';
		$this->icon = !isset($arg['icon']) ? 'add' : $arg['icon'];
		$this->size = !isset($arg['size']) ? 0 : $arg['size'];
		$this->textColor = !isset($arg['textColor']) ? NULL : $arg['textColor'];
		$this->shadow = !isset($arg['shadow']) ? NULL : $arg['shadow'];
		$this->cardPanel = !isset($arg['cardPanel']) ? NULL : $arg['cardPanel'];		
		$this->hoverable = !isset($arg['hoverable']) ? NULL : $arg['hoverable'];
		$this->js = !isset($arg['js']) ? array() : array($arg['js']);
		$this->class = !isset($arg['class']) ? NULL : $arg['class'];		
		$this->float = !isset($arg['float']) ? NULL : $arg['float'];
		$this->html = NULL;
		$this->refreshInfo();			
	}
	public function refreshInfo(){
		$id = $this->id;
		$icon = $this->icon;
		$size = $this->sizeIcon($this->size);
		$textColor =  $this->textColors($this->textColor);
		$shadow =  $this->shadow($this->shadow);	
		$cardPanel =  $this->cardPanel($this->cardPanel);		
		$hoverable =  $this->hoverable($this->hoverable);
		$class = $this->class;		
		$float =  $this->float($this->float);	

		$search = array("{ID}", "{SIZE}", "{ICON}", "{TEXTCOLOR}", "{SHADOW}", "{CARDPANEL}", "{HOVERABLE}", "{FLOAT}", "{CLASS}");
		$replace = array("{$id}", "{$size}", "{$icon}", "{$textColor}", "{$shadow}", "{$cardPanel}", "{$hoverable}", "{$float}", "{$class}");
		$tempHtml = '<i id="{ID}" class="material-icons {SIZE} {TEXTCOLOR} {SHADOW} 
{CARDPANEL} {HOVERABLE} {FLOAT} {CLASS}">{ICON}</i>';
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

