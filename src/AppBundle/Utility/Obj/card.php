<?php

namespace AppBundle\Utility\Obj;

use AppBundle\Utility\Obj\CreateClass\createClass;

class card extends createClass
{
	protected $type;
	protected $id;
	protected $textColor;
	protected $backgroundColor;
	protected $valign;
	protected $textAling;
	protected $float;
	protected $shadow;
	protected $truncate;
	protected $cardPanel;
	protected $hoverable;
	protected $orientation;
	protected $mode;
	protected $size;
	protected $js;
	protected $objReveal;
	protected $objImg;
	protected $objContent;
	protected $html;


	public function __construct($arg = NULL){
		$this->reset($arg);
	}
	public function reset($arg = NULL)
	{
		$this->type = 'card';
		$this->id = 'card-'.$this->createID(5);
		$this->textColor = !isset($arg['textColor']) ? 'b-w-t,0' : $arg['textColor'];
		$this->backgroundColor = !isset($arg['backgroundColor']) ? 'b-w-t,1' : $arg['backgroundColor'];
		$this->valign = !isset($arg['valign']) ? NULL : $arg['valign'];
		$this->textAling = !isset($arg['textAling']) ? NULL : $arg['textAling'];
		$this->float = !isset($arg['float']) ? NULL : $arg['float'];
		$this->shadow = !isset($arg['shadow']) ? NULL : $arg['shadow'];
		$this->truncate = !isset($arg['truncate']) ? NULL : $arg['truncate'];
		$this->cardPanel = !isset($arg['cardPanel']) ? NULL : $arg['cardPanel'];			
		$this->hoverable = !isset($arg['hoverable']) ? NULL : $arg['hoverable'];			
		$this->orientation = !isset($arg['orientation']) ? NULL : $arg['orientation'];	
		$this->mode = !isset($arg['mode']) ? '0' : $arg['mode'];
		$this->size = !isset($arg['size']) ? '1' : $arg['size'];
		$this->js = !isset($arg['js']) ? array() : array($arg['js']);
		$this->objReveal = NULL;
		$this->objImg = NULL;
		$this->objContent = NULL;
		$this->html = NULL;
		$this->refreshInfo();			
	}
	public function refreshInfo(){

		$id = $this->id;
		$textColor =  $this->textColors($this->textColor);
		$backgroundColor =  $this->backgroundColors($this->backgroundColor);
		$valign =  $this->valign($this->valign);	
		$textAling =  $this->textAling($this->textAling);	
		$float =  $this->float($this->float);	
		$shadow =  $this->shadow($this->shadow);	
		$truncate =  $this->truncate($this->truncate);
		$cardPanel =  $this->cardPanel($this->cardPanel);		
		$hoverable =  $this->hoverable($this->hoverable);		
		$orientation = $this->orientationCard($this->orientation);
		$mode =  $this->modeCard($this->mode);		
		$size =  $this->sizeCard($this->size);
		$objImg = $this->getObj('html:img');
		$objReveal = $this->getObj('html:reveal');
		$objContent = $this->getObj('html:content');
		$objAction = $this->getObj('html:action');

		$this->getObj('js');
		
		$search = array("{ID}", "{TEXTCOLOR}", "{BACKGROUNDCOLOR}", "{VALIGN}", "{TEXTALING}", "{FLOAT}", "{SHADOW}", "{TRUNCATE}", "{CARDPANEL}", "{HOVERABLE}", "{OBJHTML:IMG}", "{OBJHTML:CONTENT}", "{OBJHTML:REAVEL}", "{OBJHTML:ACTION}","{SIZE}", "{ORIENTATION}");
		$replace = array("{$id}", "{$textColor}", "{$backgroundColor}", "{$valign}", "{$textAling}", "{$float}", "{$shadow}", "{$truncate}", "{$cardPanel}", "{$hoverable}", "{$objImg}", "{$objContent}", "{$objReveal}", "{$objAction}", "{$size}", "{$orientation}");

		if($mode == "basic"){

			$tempHtml[] = '<div id="{ID}" style="margin:0% auto;" class="card {VALIGN} {TEXTALING} {FLOAT} {ORIENTATION} {SIZE} {BACKGROUNDCOLOR} {TEXTCOLOR} {SHADOW} {CARDPANEL} {HOVERABLE} {TRUNCATE}">';

			if(!is_null($objImg)) $tempHtml[] = '<div class="card-image">{OBJHTML:IMG}</div>'	;

			if($orientation == "horizontal"){
				$tempHtml[]= '<div class="card-stacked">';
				if(!is_null($objContent)) $tempHtml[] = '<div class="card-content">{OBJHTML:CONTENT}</div>';
				if(!is_null($objAction)) $tempHtml[] = '<div class="card-action">{OBJHTML:ACTION}</div>';		
				$tempHtml[] = '</div>';
			}
			else{
				if(!is_null($objContent)) $tempHtml[] = '<div class="card-content">{OBJHTML:CONTENT}</div>';
				if(!is_null($objAction)) $tempHtml[] = '<div class="card-action">{OBJHTML:ACTION}</div>';
			}
			
			$tempHtml[] = '</div>';

			$tempHtml = implode("\n", $tempHtml);

		}
		if($mode == "reveal"){
			$tempHtml[] = '<div id="{ID}" style="margin:0% auto;" class="card {VALIGN} {TEXTALING} {FLOAT} {SIZE} {BACKGROUNDCOLOR} {ORIENTATION} {TEXTCOLOR} {SHADOW} {CARDPANEL} {HOVERABLE} {TRUNCATE}">';

			if(!is_null($objImg)) $tempHtml[] = '<div class="card-image">{OBJHTML:IMG}</div>';
			if($orientation == "horizontal"){
				$tempHtml[]= '<div class="card-stacked">';
				if(!is_null($objContent)) $tempHtml[] = '<div class="card-content"><i class="material-icons right activator card-title">more_vert</i>{OBJHTML:CONTENT}</div>';
				if(!is_null($objAction)) $tempHtml[] = '<div class="card-action">{OBJHTML:ACTION}</div>';
				$tempHtml[] = '</div>';
				if(!is_null($objReveal)) $tempHtml[] = '<div class="card-reveal {BACKGROUNDCOLOR} {TEXTCOLOR}"><i class="material-icons right card-title">close</i>{OBJHTML:REAVEL}</div>';
			}
			else{
				if(!is_null($objContent)) $tempHtml[] = '<div class="card-content"><i class="material-icons right activator card-title">more_vert</i>{OBJHTML:CONTENT}</div>';
				if(!is_null($objAction)) $tempHtml[] = '<div class="card-action">{OBJHTML:ACTION}</div>';
				if(!is_null($objReveal)) $tempHtml[] = '<div class="card-reveal {BACKGROUNDCOLOR} {TEXTCOLOR}"><i class="material-icons right card-title">close</i>{OBJHTML:REAVEL}</div>';

			}
			
			$tempHtml[] = '</div>';

			$tempHtml = implode("\n", $tempHtml);
			
		}

		$tempHtml = str_replace($search, $replace, $tempHtml);

		$this->html = $tempHtml;
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
	public function addObjReveal($obj){
		$this->objReveal[] = $obj;
		$this->refreshInfo();
	}

	public function delObjReveal($obj){
		$reversed = array_reverse($this->objReveal , 1);
		foreach ($reversed as $key => $objR) {
			if($objR->type == $obj->type && $objR->id == $obj->id){
				unset($this->objReveal[$key]);
				break;
			}
		}
		$this->refreshInfo();
	}	
	public function addObjAction($obj){
		$this->objAction[] = $obj;
		$this->refreshInfo();
	}

	public function delObjAction($obj){
		$reversed = array_reverse($this->objAction , 1);
		foreach ($reversed as $key => $objR) {
			if($objR->type == $obj->type && $objR->id == $obj->id){
				unset($this->objAction[$key]);
				break;
			}
		}
		$this->refreshInfo();
	}	
	public function getObj($arg){
		$arg = strtolower((string)$arg);
		if($arg == 'html:img'){
			if(!empty($this->objImg)){
				foreach ($this->objImg as $idObj) {
					if(
						$idObj->type == 'h' || 
						$idObj->type == 'span' || 
						$idObj->type == 'p' || 
						$idObj->type == 'pre' 
					) {
						$objHtml[] = str_replace('class="', 'class="card-title ', $idObj->html);
					}
					else{
						$objHtml[] = $idObj->html;
					}

				}
				$objHtml = implode("", $objHtml);
			}
			else{
				$objHtml = NULL;
			}
			return $objHtml;
		}
		elseif($arg == 'html:content'){
			if(!empty($this->objContent)){
				foreach ($this->objContent as $idObj) {
					$objHtml[] = $idObj->html;
				}
				$objHtml = implode("", $objHtml);
			}
			else{
				$objHtml = NULL;
			}
			return $objHtml;
		}
		elseif($arg == 'html:reveal'){
			if(!empty($this->objReveal)){
				foreach ($this->objReveal as $idObj) {
					$objHtml[] = $idObj->html;
				}
				$objHtml = implode("", $objHtml);
			}
			else{
				$objHtml = NULL;
			}
			return $objHtml;
		}
		elseif($arg == 'html:action'){
			if(!empty($this->objAction)){
				foreach ($this->objAction as $idObj) {
					$objHtml[] = $idObj->html;
				}
				$objHtml = implode("", $objHtml);
			}
			else{
				$objHtml = NULL;
			}
			return $objHtml;
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
			if(!empty($this->objReveal)){
				foreach ($this->objReveal as $Obj) {
					foreach ($Obj->js as $js) {
						if(!in_array($js, $this->js)){
							$this->js[] = $js;
						}
					}
				}
			}
			if(!empty($this->objAction)){
				foreach ($this->objAction as $Obj) {
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

