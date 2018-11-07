<?php

namespace AppBundle\Utility\Obj;

use AppBundle\Utility\Obj\CreateClass\createClass;
/**
 * 
 */
class tab extends createClass
{
	protected $id;
	protected $type;
	protected $textColor;
	protected $backgroundColor;
	protected $float;
	protected $center;
	protected $valign;
	protected $js;
	protected $class;
	protected $mode;
	protected $shadow;
	protected $col;
	protected $head;
	protected $html;

	public function __construct($arg = NULL){
		$this->reset($arg);
	}
	public function reset($arg = NULL)
	{
		$this->id = 'tab-'.$this->createID(5);
		$this->type = 'tab';
		$this->textColor = !isset($arg['textColor']) ? NULL : $arg['textColor'];
		$this->backgroundColor = !isset($arg['backgroundColor']) ? NULL : $arg['backgroundColor'];
		$this->float = !isset($arg['float']) ? NULL : $arg['float'];
		$this->center = !isset($arg['center']) ? NULL : $arg['center'];
		$this->valign = !isset($arg['valign']) ? NULL : $arg['valign'];
		$this->js = !isset($arg['js']) ? array() : array($arg['js']);
		$this->class = !isset($arg['class']) ? NULL : $arg['class'];
		$this->mode = !isset($arg['mode']) ? NULL : $arg['mode'];
		$this->shadow = !isset($arg['shadow']) ? NULL : $arg['shadow'];
		$this->col = NULL;
		$this->head = NULL;
		$this->html = NULL;
		$this->refreshInfo();			
	}
	public function refreshInfo(){

		$id = $this->id;
		$textColor =  $this->textColors($this->textColor);
		$backgroundColor =  $this->backgroundColors($this->backgroundColor);
		$float =  $this->float($this->float);
		$center =  $this->tableCenter($this->center);	
		$valign =  $this->valign($this->valign);
		$class = $this->class;
		$waves = $this->waves($this->waves);
		$head = $this->getObj('html:head');
		$col = $this->getObj('html:col');
		$mode = $this->modeTable($this->mode);
		$shadow =  $this->shadow($this->shadow);	

		$search = array("{ID}", "{TEXTCOLOR}", "{BACKGROUNDCOLOR}", "{MODE}", "{CLASS}", "{HEAD}", "{COL}", "{WAVES}", "{FLOAT}", "{VALIGN}", "{CENTER}", "{SHADOW}");
		$replace = array("{$id}", "{$textColor}", "{$backgroundColor}", "{$mode}", "{$class}", "{$head}", "{$col}", "{$waves}", "{$float}", "{$valign}", "{$center}", "{$shadow}");

		$tempHtml = 
		'<div id="{ID}" class="{MODE} {TEXTCOLOR} {BACKGROUNDCOLOR} {WAVES} {CLASS} {FLOAT} {VALIGN} {CENTER} {SHADOW}">
			<ul class="tabs">
				{HEAD}
			</ul>
			{COL}
		</div>';
		$tempHtml = str_replace($search, $replace, $tempHtml);

		$this->html = $tempHtml;
		$this->js[] = " $('ul.tabs').tabs(); ";
	}
	/*se agrega por campos*/
	public function addHead($arg){
		$this->head[] = $arg;
		$this->refreshInfo();
	}
	/*Se agregan registros como array cada item del array es un campo*/
	public function addCol($arg){
		$this->col[] = $arg;
		$this->refreshInfo();
	}
	public function getObj($arg){
		$arg = strtolower((string)$arg);
		if($arg == 'html:head'){
			if(!empty($this->head)){
				foreach ($this->head as $key => $head) {
					$head->href = '#'.$this->id.'-'.$key;
					$head->refreshInfo();
					$head = $head->html;
					$objHtml[] = "<li class='tab'>{$head}</li>";
				}
				if(isset($objHtml)) return implode("", $objHtml);
			}
		}
		elseif($arg == 'html:col'){
			if(!empty($this->col)){
				foreach ($this->col as $key => $col) {
					$idCol = $this->id.'-'.$key;
					$col = $col->html;
					$tempcol = "<div id='{$idCol}'>{$col}</div>";
					$objHtml[] = $tempcol;
				}
			}
			if(isset($objHtml)) return implode("", $objHtml);
		}
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
