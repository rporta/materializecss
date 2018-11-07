<?php

namespace AppBundle\Utility\Obj;

use AppBundle\Utility\Obj\CreateClass\createClass;

class inputRange extends createClass
{
	protected $id;
	protected $type;
	protected $textColor;
	protected $backgroundColor;
	protected $activeBackgroundColor;
	protected $text;
	protected $textAling;
	protected $shadow;
	protected $cardPanel;
	protected $hoverable;
	protected $name;
	protected $mode;
	protected $active;
	protected $disabled;
	protected $value;
	protected $range;
	protected $orientation;
	protected $js;
	protected $html;

	public function __construct($arg = NULL){
		$this->reset($arg);
	}
	public function reset($arg = NULL)
	{
		$this->id = 'inputRange-'.$this->createID(5);
		$this->type = 'inputRange';
		$this->textColor = !isset($arg['textColor']) ? 'b-w-t,0' : $arg['textColor'];
		$this->backgroundColor = !isset($arg['backgroundColor']) ? NULL : $arg['backgroundColor'];
		$this->activeBackgroundColor = !isset($arg['activeBackgroundColor']) ? 'green,3' : $arg['activeBackgroundColor'];
		$this->text = !isset($arg['text']) ? '' : $arg['text'];
		$this->textAling = !isset($arg['textAling']) ? NULL : $arg['textAling'];
		$this->shadow = !isset($arg['shadow']) ? NULL : $arg['shadow'];	
		$this->cardPanel = !isset($arg['cardPanel']) ? NULL : $arg['cardPanel'];			
		$this->hoverable = !isset($arg['hoverable']) ? NULL : $arg['hoverable'];				
		$this->name = !isset($arg['name']) ? NULL : $arg['name'];			
		$this->mode = !isset($arg['mode']) ? 'text' : $arg['mode'];			
		$this->active = !isset($arg['active']) ? NULL : $arg['active'];		
		$this->disabled = !isset($arg['disabled']) ? NULL : $arg['disabled'];			
		$this->value = !isset($arg['value']) ? NULL : $arg['value'];		
		$this->range = !isset($arg['range']) ? array(0,100) : $arg['range'];		
		$this->orientation = !isset($arg['orientation']) ? 'horizontal' : $arg['orientation'];		
		$this->js = !isset($arg['js']) ? array() : array($arg['js']);
		$this->html = NULL;
		$this->refreshInfo();			
	}
	public function refreshInfo(){
		$id = $this->id;
		$textColor =  $this->textColors($this->textColor);
		$hexColor =  $this->hexColors($this->textColor);
		$backgroundColor =  $this->hexColors($this->backgroundColor);
		$hexBackgroundColor =  $this->hexColors($this->backgroundColor);
		$activeBackgroundColor =  $this->hexColors($this->activeBackgroundColor);
		$text = $this->text;
		$textAling =  $this->textAling($this->textAling);
		$shadow =  $this->shadow($this->shadow);	
		$cardPanel =  $this->cardPanel($this->cardPanel);
		$hoverable =  $this->hoverable($this->hoverable);		
		$name =  $this->nameInputFields($this->name);		
		$mode =  $this->modeInputRange($this->mode);
		$active =  $this->activeInputFields($this->active);
		$disabled =  $this->disabledInputFields($this->disabled);
		$range = $this->range;
		$orientation = $this->orientation;
		$value = NULL;
		if($mode == "noUiSlider"){
			$style = NULL;
			if($orientation == 'vertical') $style = "style='height: 200px;'";
			$tempHtml = 
			"<style>
				.noUi-tooltip span{
					color: {HEXCOLOR} !important;
				}
				.noUi-connect, .noUi-target.noUi-{ORIENTATION} .noUi-tooltip, .noUi-{ORIENTATION} .noUi-handle{
				    background: {HEXBACKGROUNDCOLOR};
				}
			</style>
			<div $style class='{TEXTCOLOR} {BACKGROUNDCOLOR}' id='{ID}' {NAME}></div>";

			$tempJs = 
			"var slider = document.getElementById('{ID}');
			noUiSlider.create(slider, {";

			if($this->value !== NULL){ 
				$tempJs .= "start: [{$this->value[0]}, {$this->value[1]}],";
			}

			$tempJs .=
				"connect: true,
				step: 1,
				orientation: '{ORIENTATION}',
				range: {
					'min': {RANGE:0},
					'max': {RANGE:1}
				},
				format: wNumb({
					decimals: 0
				})
			});";
		}
		elseif($mode == "HTML5 Range"){
			$tempJs = NULL;
			
			$tempHtml =
			"<style>
				input[type='range'] + .thumb, input[type='range']::-moz-range-thumb{
				    background: {HEXBACKGROUNDCOLOR};
				}
				input[type='range'] + .thumb .value{
					color: {HEXCOLOR} !important;				
				}
			</style>
			<p class='range-field'>
				<input {VALUE} style='border: none;' class='{TEXTCOLOR} {BACKGROUNDCOLOR}' type='range' id='{ID}' min='{RANGE:0}' max='{RANGE:1}' {NAME} />
			</p>";
			$value = $this->valueInputFields($this->value);
		}

		$search = array("{ID}", "{TEXTCOLOR}", "{HEXCOLOR}", "{HEXBACKGROUNDCOLOR}","{BACKGROUNDCOLOR}", "{ACTIVECOLOR}", "{TEXT}", "{TEXTALING}", "{SHADOW}", "{CARDPANEL}", "{HOVERABLE}", "{MODE}", "{NAME}", "{ACTIVE}", "{DISABLED}", "{VALUE}", "{RANGE:0}", "{RANGE:1}","{ORIENTATION}");
		$replace = array($id, $textColor, $hexColor, $hexBackgroundColor, $backgroundColor, $activeBackgroundColor, $text, $textAling, $shadow, $cardPanel, $hoverable, $mode, $name, $active, $disabled, $value, $range[0], $range[1], $orientation);

		$tempHtml = str_replace($search, $replace, $tempHtml);
		$tempJs = str_replace($search, $replace, $tempJs);

		$this->js[] = $tempJs;
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