<?php

namespace AppBundle\Utility\Obj;

use AppBundle\Utility\Obj\CreateClass\createClass;

class inputSwitch extends createClass
{
	protected $id;
	protected $type;
	protected $textColor;
	protected $activeBackgroundColor;
	protected $disabledBackgroundColor;
	protected $text;
	protected $textAling;
	protected $shadow;
	protected $truncate;
	protected $cardPanel;
	protected $hoverable;
	protected $name;
	protected $option;
	protected $disabled;
	protected $active;
	protected $js;
	protected $html;

	public function __construct($arg = NULL){
		$this->reset($arg);
	}
	public function reset($arg = NULL)
	{
		$this->id = 'inputSwitch-'.$this->createID(5);
		$this->type = 'inputSwitch';
		$this->textColor = !isset($arg['textColor']) ? 'b-w-t,0' : $arg['textColor'];
		$this->activeBackgroundColor = !isset($arg['activeBackgroundColor']) ? 'green,7' : $arg['activeBackgroundColor'];
		$this->disabledBackgroundColor = !isset($arg['disabledBackgroundColor']) ? 'red,3' : $arg['disabledBackgroundColor'];
		$this->text = !isset($arg['text']) ? '' : $arg['text'];
		$this->textAling = !isset($arg['textAling']) ? NULL : $arg['textAling'];
		$this->shadow = !isset($arg['shadow']) ? NULL : $arg['shadow'];
		$this->truncate = !isset($arg['truncate']) ? NULL : $arg['truncate'];			
		$this->cardPanel = !isset($arg['cardPanel']) ? NULL : $arg['cardPanel'];			
		$this->hoverable = !isset($arg['hoverable']) ? NULL : $arg['hoverable'];			
		$this->name = !isset($arg['name']) ? NULL : $arg['name'];			
		$this->option = !isset($arg['option']) ? NULL : $arg['option'];		
		$this->disabled = !isset($arg['disabled']) ? NULL : $arg['disabled'];		
		$this->active = !isset($arg['active']) ? NULL : $arg['active'];		
		$this->js = !isset($arg['js']) ? array() : array($arg['js']);
		$this->html = NULL;
		$this->refreshInfo();			
	}
	public function refreshInfo(){
		$id = $this->id;
		$textColor =  $this->textColors($this->textColor);
		$activeBackgroundColor[0] =  $this->hexColors($this->activeBackgroundColor);
		$activeBackgroundColor[1] = (explode(",", $this->activeBackgroundColor)[1] > 7) ? $this->hexColors(explode(",", $this->activeBackgroundColor)[0].",3") : $this->hexColors(explode(",", $this->activeBackgroundColor)[0].",9") ;
		$disabledBackgroundColor[0] =  $this->hexColors($this->disabledBackgroundColor);
		$disabledBackgroundColor[1] = (explode(",", $this->disabledBackgroundColor)[1] > 7) ? $this->hexColors(explode(",", $this->disabledBackgroundColor)[0].",3") : $this->hexColors(explode(",", $this->disabledBackgroundColor)[0].",9") ;
		$clickBackgroundColor = "#0000";
		$text = $this->text;
		$textAling =  $this->textAling($this->textAling);
		$shadow =  $this->shadow($this->shadow);	
		$truncate =  $this->truncate($this->truncate);	
		$cardPanel =  $this->cardPanel($this->cardPanel);
		$hoverable =  $this->hoverable($this->hoverable);		
		$name =  $this->nameInputFields($this->name);		
		$disabled =  $this->disabledInputSwitch($this->disabled);		
		$active =  $this->activeInputSwitch($this->active);		
		$inputSwitchHtml = $this->getOptions($this->option);

		$tempHtml = 
		'<style>
			/*style click*/
			.switch label .lever::before {
				background-color: {CLICKBACKGROUNDCOLOR};
			}
			/*style horizontal active*/
			.switch label input[type="checkbox"]:checked + .lever {
				background-color: {ACTIVEBACKGROUNDCOLOR:0};
			}
			/*style button active*/
			.switch label input[type="checkbox"]:checked + .lever::after {
			 	background-color: {ACTIVEBACKGROUNDCOLOR:1};
			}
			/*style horizontal disabled*/
			.switch label input[type="checkbox"]:not(:checked) + .lever {
				background-color: {DISABLEDBACKGROUNDCOLOR:0};
			}
			/*style button disabled*/
			.switch label input[type="checkbox"]:not(:checked) + .lever::after {
			 	background-color: {DISABLEDBACKGROUNDCOLOR:1};
			}			
		</style>
		<div id="{ID}" class="switch">
			<label class="{TEXTCOLOR}">
				{INPUTSWITCH:HTML}
			</label>
        </div>';

        $tempHtml = str_replace("{INPUTSWITCH:HTML}", $inputSwitchHtml, $tempHtml);

        dump($activeBackgroundColor);
        dump($disabledBackgroundColor);

		$search = array("{ID}", "{TEXTCOLOR}", "{CLICKBACKGROUNDCOLOR}", "{ACTIVEBACKGROUNDCOLOR:0}", "{ACTIVEBACKGROUNDCOLOR:1}", "{DISABLEDBACKGROUNDCOLOR:0}", "{DISABLEDBACKGROUNDCOLOR:1}","{TEXT}", "{TEXTALING}", "{SHADOW}", "{TRUNCATE}", "{CARDPANEL}", "{HOVERABLE}", "{NAME}", "{DISABLED}", "{ACTIVE}");
		$replace = array($id, $textColor, $clickBackgroundColor, $activeBackgroundColor[0], $activeBackgroundColor[1], $disabledBackgroundColor[0], $disabledBackgroundColor[1], $text, $textAling, $shadow, $truncate, $cardPanel, $hoverable, $name, $disabled, $active);


		$tempHtml = str_replace($search, $replace, $tempHtml);
		$this->html = $tempHtml;
	}
	public function getOptions($arg){

		$tempHtml = 
		'{TEXT:0}
			<input {NAME} type="checkbox" {DISABLED} {ACTIVE} />
			<span class="lever"></span>
		{TEXT:1}';

		foreach ($arg as $i => $option) {
			$text[$i] = NULL;
			foreach ($option as $property => $data) {
				if($property == 'text') $text[$i] = $data;						
			}
		}
		$search = array("{TEXT:0}", "{TEXT:1}", "{DISABLED}", "{ACTIVE}");
		$replace = array($text[0], $text[1]);
		$objHtml[] = str_replace($search, $replace, $tempHtml);

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