<?php

namespace AppBundle\Utility\Obj;

use AppBundle\Utility\Obj\CreateClass\createClass;

class inputTimePicker extends createClass
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
	protected $textDone;
	protected $textClear;
	protected $textCancel;
	protected $textError;
	protected $textSuccess;
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
		$this->id = 'inputTimePicker-'.$this->createID(5);
		$this->type = 'inputTimePicker';
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
		$this->textDone = !isset($arg['textDone']) ? 'ok' : $arg['textDone'];
		$this->textClear = !isset($arg['textClear']) ? 'limpiar' : $arg['textClear'];
		$this->textCancel = !isset($arg['textCancel']) ? 'cancelar' : $arg['textCancel'];
		$this->textError = !isset($arg['textError']) ? NULL : $arg['textError'];		
		$this->textSuccess = !isset($arg['textSuccess']) ? NULL : $arg['textSuccess'];		
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
			<input {PLACEHOLDER} {NAME} {DISABLED} {CHARACTERCOUNTER} {VALUE} id="{ID}" type="text" class="timepicker {TEXTCOLOR} {TEXTALING} {SHADOW} {TRUNCATE} {CARDPANEL} {HOVERABLE} {ACTIVE} ">
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

		$textDone = $this->textDone;
		$textClear = $this->textClear;
		$textCancel = $this->textCancel;

		$code = "
			$('#{$id}').pickatime({
				default: 'now', // Set default time: 'now', '1:30AM', '16:30'
				fromnow: 0,       // set default time to * milliseconds from now (using with default = 'now')
				twelvehour: false, // Use AM/PM or 24-hour format
				donetext: '{TEXTDONE}', // text for done-button
				cleartext: '{TEXTCLEAR}', // text for clear-button
				canceltext: '{TEXTCANCEL}', // Text for cancel-button,
				container: undefined, // ex. 'body' will append picker to body
				autoclose: false, // automatic close timepicker
				ampmclickable: true, // make AM PM clickable
				aftershow: function(){} //Function for after opening timepicker
			});";

		$js = str_replace(array("{TEXTDONE}", "{TEXTCLEAR}" ,"{TEXTCANCEL}"), array($textDone, $textClear, $textCancel), $code);

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