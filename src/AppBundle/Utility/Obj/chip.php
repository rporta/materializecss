<?php

namespace AppBundle\Utility\Obj;

use AppBundle\Utility\Obj\CreateClass\createClass;
/**
 * 
 */
class chip extends createClass
{
	protected $id;
	protected $type;
	protected $src;
	protected $alt;
	protected $textColor;
	protected $backgroundColor;
	protected $text;
	protected $mode;
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
	public function reset($arg = NULL)
	{
		$this->id = 'chip-'.$this->createID(5);
		$this->type = 'chip';
		$this->src = !isset($arg['src']) ? NULL : $arg['src'];
		$this->alt = !isset($arg['alt']) ? NULL : $arg['alt'];		
		$this->textColor = !isset($arg['textColor']) ? 'b-w-t,0' : $arg['textColor'];
		$this->backgroundColor = !isset($arg['backgroundColor']) ? 'b-w-t,2' : $arg['backgroundColor'];
		$this->text = !isset($arg['text']) ? '' : $arg['text'];
		$this->mode = !isset($arg['mode']) ? 1 : $arg['mode'];
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
		$src = $this->srcMedia($this->src);
		$alt = $this->altMedia($this->alt);		
		$textColor =  $this->textColors($this->textColor);
		$backgroundColor =  $this->backgroundColors($this->backgroundColor);
		$text = $this->text;
		$textAling =  $this->textAling($this->textAling);
		$shadow =  $this->shadow($this->shadow);	
		$truncate =  $this->truncate($this->truncate);	
		$cardPanel =  $this->cardPanel($this->cardPanel);		
		$hoverable =  $this->hoverable($this->hoverable);
		$flowText =  $this->flowText($this->flowText);
		$mode = $this->modeChip($this->mode);	

		$search = array("{ID}", "{TEXTCOLOR}", "{BACKGROUNDCOLOR}", "{TEXT}", "{TEXTALING}", "{SHADOW}", "{TRUNCATE}", "{CARDPANEL}", "{HOVERABLE}", "{FLOWTEXT}", "{SRC}", "{ALT}");
		$replace = array("{$id}", "{$textColor}", "{$backgroundColor}", "{$text}", "{$textAling}", "{$shadow}", "{$truncate}", "{$cardPanel}", "{$hoverable}", "{$flowText}", "{$src}", "{$alt}");

		if($mode == "Contactos"){
			$tempHtml = '<div id="{ID}" class="chip {TEXTCOLOR} {BACKGROUNDCOLOR} {TEXTALING} {SHADOW} {TRUNCATE} {CARDPANEL} {HOVERABLE} {FLOWTEXT}"><img {SRC} {ALT}>{TEXT}</div>';
		}
		if($mode == "Etiquetas"){
			$tempHtml = '<div id="{ID}" class="chip {TEXTCOLOR} {BACKGROUNDCOLOR} {TEXTALING} {SHADOW} {TRUNCATE} {CARDPANEL} {HOVERABLE} {FLOWTEXT}">{TEXT}<i class="close material-icons">close</i></div>';
		}
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

