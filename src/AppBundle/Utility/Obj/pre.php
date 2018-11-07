<?php

namespace AppBundle\Utility\Obj;

use AppBundle\Utility\Obj\CreateClass\createClass;
/**
 * 
 */
class pre extends createClass
{
	protected $id;
	protected $type;
	protected $textColor;
	protected $backgroundColor;
	protected $text;
	protected $flowText;
	protected $js;
	protected $html;
	protected $textAling;

	public function __construct($arg = NULL){
		$this->reset($arg);
	}
	public function reset($arg = NULL)
	{
		$this->id = 'pre-'.$this->createID(5);
		$this->type = 'pre';
		$this->textColor = !isset($arg['textColor']) ? 'b-w-t,0' : $arg['textColor'];
		$this->backgroundColor = !isset($arg['backgroundColor']) ? 'b-w-t,2' : $arg['backgroundColor'];
		$this->text = !isset($arg['text']) ? '' : $arg['text'];
		$this->flowText = !isset($arg['flowText']) ? NULL : $arg['flowText'];		
		$this->js = !isset($arg['js']) ? array() : array($arg['js']);
		$this->textAling = !isset($arg['textAling']) ? NULL : $arg['textAling'];
		$this->html = NULL;
		$this->refreshInfo();			
	}
	public function refreshInfo(){
		$id = $this->id;
		$textColor =  $this->textColors($this->textColor);
		$backgroundColor =  $this->backgroundColors($this->backgroundColor);
		$text = is_array($this->text) ? var_export($this->text, TRUE) : $this->text;
		$flowText =  $this->flowText($this->flowText);
		$textAling =  $this->textAling($this->textAling);

		$search = array("{ID}", "{TEXTCOLOR}", "{BACKGROUNDCOLOR}", "{TEXT}", "{FLOWTEXT}", "{TEXTALING}");
		$replace = array("{$id}", "{$textColor}", "{$backgroundColor}", "{$text}", "{$flowText}", "{$textAling}");
		$tempHtml = '<pre id="{ID}" class="{TEXTCOLOR} {BACKGROUNDCOLOR} {FLOWTEXT} {TEXTALING}">{TEXT}</pre>';
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

