<?php

namespace AppBundle\Utility\Obj;

use AppBundle\Utility\Obj\CreateClass\createClass;
/**
 * 
 */
class blockquote extends createClass
{
	protected $id;
	protected $type;
	protected $icon;
	protected $textColor;
	protected $backgroundColor;
	protected $borderColor;
	protected $text;
	protected $textAling;
	protected $shadow;
	protected $truncate;
	protected $cardPanel;
	protected $hoverable;
	protected $flowText;
	protected $js;
	protected $html;

	public function __construct($arg = NULL){
		$this->reset($arg);			
	}
	public function reset($arg = NULL){
		$this->id = 'blockquote-'.$this->createID(5);
		$this->type = 'blockquote';
		$this->icon = !isset($arg['icon']) ? 'add' : $arg['icon'];
		$this->textColor = !isset($arg['textColor']) ? 'b-w-t,0' : $arg['textColor'];
		$this->backgroundColor = !isset($arg['backgroundColor']) ? 'b-w-t,2' : $arg['backgroundColor'];
		$this->borderColor = !isset($arg['borderColor']) ? NULL : $arg['borderColor'];
		$this->text = !isset($arg['text']) ? '' : $arg['text'];
		$this->textAling = !isset($arg['textAling']) ? NULL : $arg['textAling'];
		$this->shadow = !isset($arg['shadow']) ? NULL : $arg['shadow'];
		$this->truncate = !isset($arg['truncate']) ? NULL : $arg['truncate'];			
		$this->cardPanel = !isset($arg['cardPanel']) ? NULL : $arg['cardPanel'];
		$this->hoverable = !isset($arg['hoverable']) ? NULL : $arg['hoverable'];		
		$this->flowText = !isset($arg['flowText']) ? NULL : $arg['flowText'];		
		$this->js = !isset($arg['js']) ? array() : array($arg['js']);
		$this->html = NULL;
		$this->refreshInfo();		
	}
	public function refreshInfo(){
		$id = $this->id;
		$icon = $this->icon;
		$textColor = $this->textColors($this->textColor);
		$backgroundColor = $this->backgroundColors($this->backgroundColor);
		$borderColor = is_null($this->hexColors($this->borderColor)) ? NULL : "style='border-left: 5px solid ".$this->hexColors($this->borderColor).";'";
		$text = str_replace("\n", "<br>", $this->text);
		$textAling =  $this->textAling($this->textAling);
		$shadow =  $this->shadow($this->shadow);	
		$truncate =  $this->truncate($this->truncate);	
		$cardPanel =  $this->cardPanel($this->cardPanel);		
		$hoverable =  $this->hoverable($this->hoverable);		
		$flowText =  $this->flowText($this->flowText);	

		$search = array("{ID}", "{TEXTCOLOR}", "{BACKGROUNDCOLOR}", "{BORDERCOLOR}", "{TEXT}", "{TEXTALING}", "{SHADOW}", "{TRUNCATE}", "{CARDPANEL}", "{HOVERABLE}", "{FLOWTEXT}");
		$replace = array("{$id}", "{$textColor}", "{$backgroundColor}", "{$borderColor}", "{$text}", "{$textAling}", "{$shadow}", "{$truncate}", "{$cardPanel}", "{$hoverable}", "{$flowText}");
		$tempHtml = '<blockquote id="{ID}" {BORDERCOLOR} class="{TEXTCOLOR} {BACKGROUNDCOLOR} {TEXTALING} {SHADOW} {TRUNCATE} {CARDPANEL} {HOVERABLE} {FLOWTEXT}">{TEXT}</blockquote>';
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

