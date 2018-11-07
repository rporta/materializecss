<?php

namespace AppBundle\Utility\Obj;

use AppBundle\Utility\Obj\CreateClass\createClass;

class inputDatePicker extends createClass
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
	protected $textToday;
	protected $textClear;
	protected $textClose;
	protected $textError;
	protected $textSuccess;
	protected $value;
	protected $js;
	protected $html;
	protected $obj;

	public function __construct($arg = NULL){
		$this->reset($arg);
	}
	public function reset($arg = NULL)
	{
		$this->id = 'inputDatePicker-'.$this->createID(5);
		$this->type = 'inputDatePicker';
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
		$this->textToday = !isset($arg['textToday']) ? 'hoy' : $arg['textToday'];
		$this->textClear = !isset($arg['textClear']) ? 'limpiar' : $arg['textClear'];
		$this->textClose = !isset($arg['textClose']) ? 'cerrar' : $arg['textClose'];
		$this->textError = !isset($arg['textError']) ? NULL : $arg['textError'];		
		$this->textSuccess = !isset($arg['textSuccess']) ? NULL : $arg['textSuccess'];		
		$this->value = !isset($arg['value']) ? NULL : $arg['value'];		
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
		$value = $this->valueInputFields($this->value);
		$objHtml = $this->getObj('html');
		$this->getObj('js');

		$search = array("{ID}", "{TEXTCOLOR}", "{HEXCOLOR}", "{BACKGROUNDCOLOR}", "{ACTIVECOLOR}", "{TEXT}", "{TEXTALING}", "{SHADOW}", "{TRUNCATE}", "{CARDPANEL}", "{HOVERABLE}", "{PLACEHOLDER}", "{NAME}", "{obj:html}", "{ACTIVE}", "{DISABLED}", "{TEXTERROR}", "{TEXTSUCCESS}", "{VALUE}");
		$replace = array($id, $textColor, $hexColor, $backgroundColor, $activeBackgroundColor, $text, $textAling, $shadow, $truncate, $cardPanel, $hoverable, $placeholder, $name, $objHtml, $active, $disabled, $textError, $textSuccess, $value);

		$tempHtml = 
		'<div class="input-field">
			<style>
			</style>
			{obj:html}
			<input {PLACEHOLDER} {NAME} {DISABLED} {CHARACTERCOUNTER} {VALUE} id="{ID}" type="text" class="datepicker {TEXTCOLOR} {TEXTALING} {SHADOW} {TRUNCATE} {CARDPANEL} {HOVERABLE} {ACTIVE} ">
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
		$textToday = $this->textToday;
		$textClear = $this->textClear;
		$textClose = $this->textClose;

		$code = "
			$('#{$id}').pickadate({
				selectMonths: true, // Creates a dropdown to control month
				selectYears: 15, // Creates a dropdown of 15 years to control year,
				today: '{TEXTTODAY}',
				clear: '{TEXTCLEAR}',
				close: '{TEXTCLOSE}',
				closeOnSelect: false, // Close upon selecting a date,
				container: undefined // ex. 'body' will append picker to body
			});";

		$js = str_replace(array("{TEXTTODAY}", "{TEXTCLEAR}" ,"{TEXTCLOSE}"), array($textToday, $textClear, $textClose), $code);

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