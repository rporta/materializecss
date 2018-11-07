<?php

namespace AppBundle\Utility\Obj;

use AppBundle\Utility\Obj\CreateClass\createClass;

class inputAutocomplete extends createClass
{
	protected $id;
	protected $type;
	protected $textColor;
	protected $backgroundColor;
	protected $activeBackgroundColor;
	protected $text;
	protected $textAling;
	protected $shadow;
	protected $truncate;
	protected $cardPanel;
	protected $hoverable;
	protected $placeholder;
	protected $name;
	protected $mode;
	protected $active;
	protected $disabled;
	protected $textError;
	protected $textSuccess;
	protected $characterCounter;
	protected $value;
	protected $dataAutoComplete;
	protected $js;
	protected $html;
	protected $obj;

	public function __construct($arg = NULL){
		$this->reset($arg);
	}
	public function reset($arg = NULL)
	{
		$this->id = 'inputAutocomplete-'.$this->createID(5);
		$this->type = 'inputAutocomplete';
		$this->textColor = !isset($arg['textColor']) ? 'b-w-t,0' : $arg['textColor'];
		$this->backgroundColor = !isset($arg['backgroundColor']) ? 'b-w-t,2' : $arg['backgroundColor'];
		$this->activeBackgroundColor = !isset($arg['activeBackgroundColor']) ? 'green,3' : $arg['activeBackgroundColor'];
		$this->text = !isset($arg['text']) ? '' : $arg['text'];
		$this->textAling = !isset($arg['textAling']) ? NULL : $arg['textAling'];
		$this->shadow = !isset($arg['shadow']) ? NULL : $arg['shadow'];
		$this->truncate = !isset($arg['truncate']) ? NULL : $arg['truncate'];			
		$this->cardPanel = !isset($arg['cardPanel']) ? NULL : $arg['cardPanel'];			
		$this->hoverable = !isset($arg['hoverable']) ? NULL : $arg['hoverable'];			
		$this->placeholder = !isset($arg['placeholder']) ? NULL : $arg['placeholder'];			
		$this->name = !isset($arg['name']) ? NULL : $arg['name'];			
		$this->mode = !isset($arg['mode']) ? 'text' : $arg['mode'];			
		$this->active = !isset($arg['active']) ? NULL : $arg['active'];		
		$this->disabled = !isset($arg['disabled']) ? NULL : $arg['disabled'];		
		$this->textError = !isset($arg['textError']) ? NULL : $arg['textError'];		
		$this->textSuccess = !isset($arg['textSuccess']) ? NULL : $arg['textSuccess'];		
		$this->characterCounter = !isset($arg['characterCounter']) ? NULL : $arg['characterCounter'];		
		$this->value = !isset($arg['value']) ? NULL : $arg['value'];		
		$this->dataAutoComplete = !isset($arg['dataAutoComplete']) ? NULL : $arg['dataAutoComplete'];		
		$this->js = !isset($arg['js']) ? array() : array($arg['js']);
		$this->html = NULL;
		$this->obj = NULL;		
		$this->refreshInfo();			
	}
	public function refreshInfo(){
		$id = $this->id;
		$textColor =  $this->textColors($this->textColor);
		$hexColor =  $this->hexColors($this->textColor);
		$backgroundColor =  $this->backgroundColors($this->backgroundColor);
		$activeBackgroundColor =  $this->hexColors($this->activeBackgroundColor);
		$text = $this->text;
		$textAling =  $this->textAling($this->textAling);
		$shadow =  $this->shadow($this->shadow);	
		$truncate =  $this->truncate($this->truncate);	
		$cardPanel =  $this->cardPanel($this->cardPanel);
		$hoverable =  $this->hoverable($this->hoverable);		
		$placeholder =  $this->placeholderInputFields($this->placeholder);		
		$name =  $this->nameInputFields($this->name);		
		$mode =  $this->modeInputFields($this->mode);
		$active =  $this->activeInputFields($this->active);
		$disabled =  $this->disabledInputFields($this->disabled);
		$textError =  $this->textErrorInputFields($this->textError);
		$textSuccess =  $this->textSuccessInputFields($this->textSuccess);
		$characterCounter = $this->characterCounterInputFields($this->characterCounter);
		$value = $this->valueInputFields($this->value);
		$objHtml = $this->getObj('html');
		$this->getObj('js');
		if(!is_null($characterCounter)){
			$this->js[] =  " $('#{$id}').characterCounter(); ";
		}

		$search = array("{ID}", "{TEXTCOLOR}", "{HEXCOLOR}", "{BACKGROUNDCOLOR}", "{ACTIVECOLOR}", "{TEXT}", "{TEXTALING}", "{SHADOW}", "{TRUNCATE}", "{CARDPANEL}", "{HOVERABLE}", "{PLACEHOLDER}", "{NAME}", "{obj:html}", "{ACTIVE}", "{DISABLED}", "{TEXTERROR}", "{TEXTSUCCESS}", "{CHARACTERCOUNTER}", "{VALUE}");
		$replace = array($id, $textColor, $hexColor, $backgroundColor, $activeBackgroundColor, $text, $textAling, $shadow, $truncate, $cardPanel, $hoverable, $placeholder, $name, $objHtml, $active, $disabled, $textError, $textSuccess, $characterCounter, $value);

		$tempHtml = 
		'<div class="input-field">
			<style>
				.input-field .prefix.active {
					color: {ACTIVECOLOR};
				}
				input[type="text"]:not(.browser-default):focus:not([readonly]) + label{
					color: {ACTIVECOLOR};
				}
				input[type="text"]:not(.browser-default):focus:not([readonly]){
					border-bottom: 1px solid {HEXCOLOR};
					box-shadow: 0 1px 0 0 {HEXCOLOR};
				}
				input[type="text"]:not(.browser-default){
					border-bottom: 1px solid {HEXCOLOR};
				}
			</style>
			{obj:html}
			<input {PLACEHOLDER} {NAME} {DISABLED} {CHARACTERCOUNTER} {VALUE} id="{ID}" type="text" class="autocomplete {TEXTCOLOR} {TEXTALING} {SHADOW} {TRUNCATE} {CARDPANEL} {HOVERABLE} {ACTIVE} ">
			<label {TEXTERROR} {TEXTSUCCESS} for="{TEXT}">{TEXT} </label>
        </div>';
        $tempJs = $this->createJs($id);

		$tempHtml = str_replace($search, $replace, $tempHtml);

		$this->html = $tempHtml;
		$this->js[] = $tempJs;
	}
	public function addObj($obj){
		$this->obj[] = $obj;
		$this->refreshInfo();
	}

	public function delObj($obj){
		$reversed = array_reverse($this->obj , 1);
		foreach ($reversed as $key => $objR) {
			if($objR->type == $obj->type && $objR->id == $obj->id){
				unset($this->obj[$key]);
				break;
			}
		}
		$this->refreshInfo();
	}
	public function getObj($arg){
		$arg = strtolower((string)$arg);
		if($arg == 'html'){
			if(!empty($this->obj)){
				foreach ($this->obj as $idObj) {
					$idObj->class = "prefix";
					$idObj->textColor = NULL;
					$idObj->float = NULL;
					$idObj->refreshInfo();
					$objHtml[] = $idObj->html;
				}
				$objHtml = implode(" ", $objHtml);
			}
			else{
				$objHtml = "";
			}
			return $objHtml;
		}
		elseif($arg == 'js'){
			if(!empty($this->obj)){
				foreach ($this->obj as $Obj) {
					foreach ($Obj->js as $js) {
						if(!in_array($js, $this->js)){
							$this->js[] = $js;
						}
					}
				}
			}
		}
	}
	public function createJs($id){
		$data = NULL;

		if(is_array($this->dataAutoComplete)){
			foreach ($this->dataAutoComplete as $key => $value) {
				$data[] = "'{$key}': '$value'";
			}
			$data = implode(",", $data);
		}


		$code = "
			$('#{$id}').autocomplete({
			data: {
				{DATA}
			},
			limit: 20, // The max amount of results that can be shown at once. Default: Infinity.
			onAutocomplete: function(val) {
			// Callback function when value is autcompleted.
			},
			minLength: 1, // The minimum length of the input for the autocomplete to start. Default: 1.
		});";

		$js = str_replace("{DATA}", $data, $code);

		return $js;
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