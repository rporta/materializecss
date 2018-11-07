<?php

namespace AppBundle\Utility\Obj;

use AppBundle\Utility\Obj\CreateClass\createClass;

class inputCheckboxes extends createClass
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
	protected $js;
	protected $html;

	public function __construct($arg = NULL){
		$this->reset($arg);
	}
	public function reset($arg = NULL)
	{
		$this->id = 'inputCheckboxes-'.$this->createID(5);
		$this->type = 'inputCheckboxes';
		$this->textColor = !isset($arg['textColor']) ? 'b-w-t,0' : $arg['textColor'];
		$this->backgroundColor = !isset($arg['backgroundColor']) ? 'grey,7' : $arg['backgroundColor'];
		$this->text = !isset($arg['text']) ? '' : $arg['text'];
		$this->textAling = !isset($arg['textAling']) ? NULL : $arg['textAling'];
		$this->shadow = !isset($arg['shadow']) ? NULL : $arg['shadow'];
		$this->truncate = !isset($arg['truncate']) ? NULL : $arg['truncate'];			
		$this->cardPanel = !isset($arg['cardPanel']) ? NULL : $arg['cardPanel'];			
		$this->hoverable = !isset($arg['hoverable']) ? NULL : $arg['hoverable'];			
		$this->name = !isset($arg['name']) ? NULL : $arg['name'];			
		$this->mode = !isset($arg['mode']) ? 'default' : $arg['mode'];			
		$this->option = !isset($arg['option']) ? NULL : $arg['option'];			
		$this->js = !isset($arg['js']) ? array() : array($arg['js']);
		$this->html = NULL;
		$this->refreshInfo();			
	}
	public function refreshInfo(){
		$id = $this->id;
		$textColor =  $this->textColors($this->textColor);
		$backgroundColor =  $this->hexColors($this->backgroundColor);	
		$text = $this->text;
		$textAling =  $this->textAling($this->textAling);
		$shadow =  $this->shadow($this->shadow);	
		$truncate =  $this->truncate($this->truncate);	
		$cardPanel =  $this->cardPanel($this->cardPanel);
		$hoverable =  $this->hoverable($this->hoverable);		
		$name =  $this->nameInputFields($this->name);		
		$mode =  $this->modeInputCheckboxes($this->mode);
		$inputCheckboxesButtonsHtml = $this->getOptions($this->option);

		$tempHtml = 
		'<style>
			[type="checkbox"].filled-in:not(:checked) + label::after {
				background-color: transparent;
				border: 2px solid {BACKGROUNDCOLOR};
			}

			[type="checkbox"].filled-in:checked + label::after {
				border: 2px solid {BACKGROUNDCOLOR};
				background-color: {BACKGROUNDCOLOR};
			}

			[type="checkbox"] + label::before {
			    border: 2px solid {BACKGROUNDCOLOR};
			}
			[type="checkbox"]:checked + label::before {
			    border-right: 2px solid {BACKGROUNDCOLOR};
			    border-bottom: 2px solid {BACKGROUNDCOLOR};
			}			

		</style>
		<div id="{ID}">
			{INPUTCHECKBOXESBUTTONS:HTML}
        </div>';

        $tempHtml = str_replace("{INPUTCHECKBOXESBUTTONS:HTML}", $inputCheckboxesButtonsHtml, $tempHtml);


		$search = array("{ID}", "{TEXTCOLOR}", "{BACKGROUNDCOLOR}", "{TEXT}", "{TEXTALING}", "{SHADOW}", "{TRUNCATE}", "{CARDPANEL}", "{HOVERABLE}", "{MODE}", "{NAME}");
		$replace = array($id, $textColor, $backgroundColor, $text, $textAling, $shadow, $truncate, $cardPanel, $hoverable, $mode, $name);


		$tempHtml = str_replace($search, $replace, $tempHtml);
		$this->html = $tempHtml;
	}
	public function getOptions($arg){

		$tempHtml = 
		'<p>
			<input {NAME} type="checkbox" {DISABLED} {ACTIVE} value="{VALUE}" class="{MODE}" id="{TEXT}" />
			<label for="{TEXT}" class="{TEXTCOLOR}">{TEXT}</label>
		</p>';

		foreach ($arg as $option) {
			$text = NULL;
			$value = NULL;
			$disabled = NULL;
			$active = NULL;
			foreach ($option as $property => $data) {
				if($property == 'text') $text = $data;
				if($property == 'value') $value = $data;								
				if($property == 'disabled') $disabled = 'disabled="disabled"';
				if($property == 'active') $active = 'checked';
			}
			$search = array("{TEXT}", "{VALUE}", "{DISABLED}", "{ACTIVE}");
			$replace = array($text, $value, $disabled, $active);
			$objHtml[] = str_replace($search, $replace, $tempHtml);
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