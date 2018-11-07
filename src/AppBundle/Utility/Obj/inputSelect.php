<?php

namespace AppBundle\Utility\Obj;

use AppBundle\Utility\Obj\CreateClass\createClass;

class inputSelect extends createClass
{
	protected $id;
	protected $type;
	protected $textColor;
	protected $backgroundColor;
	protected $text;
	protected $textAling;
	protected $shadow;
	protected $truncate;
	protected $cardPanel;
	protected $hoverable;
	protected $name;
	protected $mode;
	protected $option;
	protected $group;
	protected $disabled;
	protected $js;
	protected $html;

	public function __construct($arg = NULL){
		$this->reset($arg);
	}
	public function reset($arg = NULL)
	{
		$this->id = 'inputSelect-'.$this->createID(5);
		$this->type = 'inputSelect';
		$this->textColor = !isset($arg['textColor']) ? 'b-w-t,0' : $arg['textColor'];
		$this->backgroundColor = !isset($arg['backgroundColor']) ? 'b-w-t,2' : $arg['backgroundColor'];
		$this->text = !isset($arg['text']) ? '' : $arg['text'];
		$this->textAling = !isset($arg['textAling']) ? NULL : $arg['textAling'];
		$this->shadow = !isset($arg['shadow']) ? NULL : $arg['shadow'];
		$this->truncate = !isset($arg['truncate']) ? NULL : $arg['truncate'];			
		$this->cardPanel = !isset($arg['cardPanel']) ? NULL : $arg['cardPanel'];			
		$this->hoverable = !isset($arg['hoverable']) ? NULL : $arg['hoverable'];			
		$this->name = !isset($arg['name']) ? NULL : $arg['name'];			
		$this->mode = !isset($arg['mode']) ? 'single' : $arg['mode'];			
		$this->option = !isset($arg['option']) ? NULL : $arg['option'];			
		$this->group = !isset($arg['group']) ? FALSE : $arg['group'];
		$this->disabled = !isset($arg['disabled']) ? NULL : $arg['disabled'];			
		$this->js = !isset($arg['js']) ? array() : array($arg['js']);
		$this->html = NULL;
		$this->refreshInfo();			
	}
	public function refreshInfo(){
		$id = $this->id;
		$textColor =  $this->textColors($this->textColor);
		$backgroundColor =  $this->backgroundColors($this->backgroundColor);
		$text = $this->text;
		$textAling =  $this->textAling($this->textAling);
		$shadow =  $this->shadow($this->shadow);	
		$truncate =  $this->truncate($this->truncate);	
		$cardPanel =  $this->cardPanel($this->cardPanel);
		$hoverable =  $this->hoverable($this->hoverable);		
		$name =  $this->nameInputFields($this->name);		
		$mode =  $this->modeInputSelect($this->mode);
		$optionHtml = $this->getOptions($this->option);
		$defautlActive = !strpos($optionHtml, 'disabled') ? 'selected' : NULL ;
		$disabled =  $this->disabledInputFields($this->disabled);

		$this->js[] =  " $('select').material_select(); ";

		$search = array("{ID}", "{TEXTCOLOR}", "{BACKGROUNDCOLOR}", "{TEXT}", "{TEXTALING}", "{SHADOW}", "{TRUNCATE}", "{CARDPANEL}", "{HOVERABLE}", "{MODE}", "{NAME}", "{OPTION:HTML}", "{DEFAULT:ACTIVE}", "{DISABLED}");
		$replace = array($id, $textColor, $backgroundColor, $text, $textAling, $shadow, $truncate, $cardPanel, $hoverable, $mode, $name, $optionHtml, $defautlActive, $disabled);

        if($mode == 'single'){
			$tempHtml = 
			'<div class="input-field">
				<select {DISABLED} {NAME} id="{ID}" class="{TEXTCOLOR} {BACKGROUNDCOLOR} {TEXTALING} {SHADOW} {TRUNCATE} {CARDPANEL} {HOVERABLE}">
					<option value="" {DEFAULT:ACTIVE}>Seleccione una opcion</option>
					{OPTION:HTML}
				</select>
				<label for="{TEXT}">{TEXT}</label>
	        </div>';
        }
        elseif($mode == 'icon'){
			$tempHtml = 
			'<div class="input-field">
				<select {DISABLED} {NAME} id="{ID}" class="icons {TEXTCOLOR} {BACKGROUNDCOLOR} {TEXTALING} {SHADOW} {TRUNCATE} {CARDPANEL} {HOVERABLE}">
					<option value="" {DEFAULT:ACTIVE}>Seleccione una opcion</option>
					{OPTION:HTML}
				</select>
				<label for="{TEXT}">{TEXT}</label>
	        </div>';		
        }
        elseif($mode == 'browser'){
			$tempHtml = 
			'<div>
				<label for="{TEXT}">{TEXT}</label>
				<select {DISABLED} {NAME} id="{ID}" class="browser-default {TEXTCOLOR} {BACKGROUNDCOLOR} {TEXTALING} {SHADOW} {TRUNCATE} {CARDPANEL} {HOVERABLE}">
					<option value="" {DEFAULT:ACTIVE}>Seleccione una opcion</option>
					{OPTION:HTML}
				</select>
	        </div>';
        }

		$tempHtml = str_replace($search, $replace, $tempHtml);
		$this->html = $tempHtml;
	}
	public function getOptions($arg){
		$group = $this->group;
		$mode = $this->modeInputSelect($this->mode);

		if($mode == 'icon'){
			$tempHtml = '<option {ACTIVE} value="{VALUE}" data-icon="{HREF}" class="circle {ALIGN} {BACKGROUNDCOLORS}">{TEXT}</option>';
		}
		else{
			$tempHtml = '<option {ACTIVE} value="{VALUE}" class="{BACKGROUNDCOLORS}">{TEXT}</option>';
		}

		if($group){
			foreach ($arg as $group => $arrayOption) {
				$objHtml[] = str_replace('{GROUP}', $group, '<optgroup label="{GROUP}">');
				foreach ($arrayOption as $option) {
					$active = NULL;
					$text = NULL;
					$value = NULL;
					$href = NULL;
					$aling = NULL;
					$backgroundColors = NULL;
					foreach ($option as $property => $data) {
						if($property == 'active') $active = 'selected';
						if($property == 'text') $text = $data;
						if($property == 'value') $value = $data;					
						if($property == 'href') $href = $data;					
						if($property == 'aling') $aling = $this->float($data);
						if($property == 'backgroundColors') $backgroundColors = $this->backgroundColors($data);
					}
					$search = array("{TEXT}", "{VALUE}", "{HREF}", "{ALIGN}", "{ACTIVE}", "{BACKGROUNDCOLORS}");
					$replace = array($text, $value, $href, $aling, $active, $backgroundColors);
					$objHtml[] = str_replace($search, $replace, $tempHtml);
				}
				$objHtml[] = '</optgroup>';
			}
		}
		else{
			foreach ($arg as $option) {
				$active = NULL;
				$text = NULL;
				$value = NULL;
				$href = NULL;
				$aling = NULL;
				$backgroundColors = NULL;
				foreach ($option as $property => $data) {
					if($property == 'active') $active = 'selected';
					if($property == 'text') $text = $data;
					if($property == 'value') $value = $data;					
					if($property == 'href') $href = $data;					
					if($property == 'aling') $aling = $this->float($data);					
					if($property == 'backgroundColors') $backgroundColors = $this->backgroundColors($data);					
				}
				$search = array("{TEXT}", "{VALUE}", "{HREF}", "{ALIGN}", "{ACTIVE}", "{BACKGROUNDCOLORS}");
				$replace = array($text, $value, $href, $aling, $active, $backgroundColors);
				$objHtml[] = str_replace($search, $replace, $tempHtml);
			}
		}

		$objHtml = implode("", $objHtml);
		return $objHtml;
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