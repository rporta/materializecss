<?php
namespace AppBundle\Utility\Obj;

use AppBundle\Utility\Obj\CreateClass\createClass;

class slider extends createClass
{
	protected $type;
	protected $id;
	protected $textColor;
	protected $backgroundColor;
	protected $container;
	protected $valign;
	protected $textAling;
	protected $float;
	protected $shadow;
	protected $truncate;
	protected $cardPanel;
	protected $hoverable;
	protected $js;
	protected $objContent;
	protected $objImg;
	protected $html;

	public function __construct($arg = NULL){
		$this->reset($arg);
	}
	public function reset($arg = NULL)
	{
		$this->type = 'slider';
		$this->id = 'slider-'.$this->createID(5);
		$this->textColor = !isset($arg['textColor']) ? NULL : $arg['textColor'];
		$this->backgroundColor = !isset($arg['backgroundColor']) ? NULL : $arg['backgroundColor'];
		$this->container = !isset($arg['container']) ? NULL : $arg['container'];
		$this->valign = !isset($arg['valign']) ? NULL : $arg['valign'];
		$this->textAling = !isset($arg['textAling']) ? NULL : $arg['textAling'];
		$this->float = !isset($arg['float']) ? NULL : $arg['float'];
		$this->shadow = !isset($arg['shadow']) ? NULL : $arg['shadow'];
		$this->truncate = !isset($arg['truncate']) ? NULL : $arg['truncate'];			
		$this->cardPanel = !isset($arg['cardPanel']) ? NULL : $arg['cardPanel'];			
		$this->hoverable = !isset($arg['hoverable']) ? NULL : $arg['hoverable'];	
		$this->js = !isset($arg['js']) ? array() : array($arg['js']);
		$this->objContent = NULL;
		$this->objImg = NULL;
		$this->html = NULL;
		$this->refreshInfo();			
	}
	public function refreshInfo(){
		$id = $this->id;
		$textColor =  $this->textColors($this->textColor);
		$backgroundColor =  $this->backgroundColors($this->backgroundColor);
		$container =  $this->container($this->container);
		$valign =  $this->valign($this->valign);	
		$textAling =  $this->textAling($this->textAling);	
		$float =  $this->float($this->float);	
		$shadow =  $this->shadow($this->shadow);	
		$truncate =  $this->truncate($this->truncate);		
		$cardPanel =  $this->cardPanel($this->cardPanel);		
		$hoverable =  $this->hoverable($this->hoverable);		

		$objLi = $this->getObj('html:li');
		
		$this->getObj('js');

		$search = array("{ID}", "{HTML:LI}", "{TEXTCOLOR}", "{BACKGROUNDCOLOR}", "{CONTAINER}", "{VALIGN}", "{TEXTALING}", "{FLOAT}", "{SHADOW}", "{TRUNCATE}", "{CARDPANEL}", "{HOVERABLE}");
		$replace = array("{$id}", "{$objLi}", "{$textColor}", "{$backgroundColor}", "{$container}", "{$valign}", "{$textAling}", "{$float}", "{$shadow}", "{$truncate}", "{$cardPanel}", "{$hoverable}");
		$tempHtml = 
		'<div id="{ID}" class="slider {TEXTCOLOR} {BACKGROUNDCOLOR} {CONTAINER} {VALIGN} {TEXTALING} {FLOAT} {SHADOW} {TRUNCATE} {CARDPANEL} {HOVERABLE}">
			<ul class="slides">
				{HTML:LI}
			</ul>
		</div>';
		$tempHtml = str_replace($search, $replace, $tempHtml);


		$this->html = $tempHtml;
		$this->js[] = "  $('.slider').slider(); ";
	}
	public function addObjImg($obj){
		$this->objImg[] = $obj;
		$this->refreshInfo();
	}

	public function delObjImg($obj){
		$reversed = array_reverse($this->objImg , 1);
		foreach ($reversed as $key => $objR) {
			if($objR->type == $obj->type && $objR->id == $obj->id){
				unset($this->objImg[$key]);
				break;
			}
		}
		$this->refreshInfo();
	}
	public function addObjContent($obj){
		$this->objContent[] = $obj;
		$this->refreshInfo();
	}

	public function delObjContent($obj){
		$reversed = array_reverse($this->objContent , 1);
		foreach ($reversed as $key => $objR) {
			if($objR->type == $obj->type && $objR->id == $obj->id){
				unset($this->objContent[$key]);
				break;
			}
		}
		$this->refreshInfo();
	}	
	public function addObj($obj, $obj2){
		$this->addObjImg($obj);
		$this->addObjContent($obj2);
	}
	public function delObj($obj, $obj2){
		$this->delObjImg($obj);
		$this->delObjContent($obj2);		
	}
	public function getObj($arg){
		$arg = strtolower((string)$arg);
		if($arg == 'html:li'){
			if(!empty($this->objImg) && !empty($this->objContent)){
				foreach ($this->objImg as $idObj) {
					$objImg[] = $idObj->html;
				}
				foreach ($this->objContent as $idObj) {
					$objContent[] = $idObj->html;
				}
				for ($i=0; $i < count($objContent); $i++) {
					$tempHtml[] = "<li>";
					$tempHtml[] = $objImg[$i];
					$tempHtml[] = "<div class='caption center-align'>";
					$tempHtml[] = $objContent[$i];
					$tempHtml[] = "</div>";
					$tempHtml[] = "</li>";
				}
				$tempHtml = implode("", $tempHtml);
				return $tempHtml;
			}
			else{
				return NULL;
			}
		}
		elseif($arg == 'js'){
			if(!empty($this->objImg)){
				foreach ($this->objImg as $Obj) {
					foreach ($Obj->js as $js) {
						if(!in_array($js, $this->js)){
							$this->js[] = $js;
						}
					}
				}
			}
			if(!empty($this->objContent)){
				foreach ($this->objContent as $Obj) {
					foreach ($Obj->js as $js) {
						if(!in_array($js, $this->js)){
							$this->js[] = $js;
						}
					}
				}
			}
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

