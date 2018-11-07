<?php

namespace AppBundle\Utility\Obj;

use AppBundle\Utility\Obj\CreateClass\createClass;
/**
 * 
 */
class preloaderFull extends createClass
{
	protected $id;
	protected $type;
	protected $backgroundColor;
	protected $layerBackgroundColor;
	protected $shadow;
	protected $size;
	protected $mode;
	protected $determinate;
	protected $js;
	protected $html;

	public function __construct($arg = NULL){
		$this->reset($arg);
	}
	public function reset($arg = NULL)
	{
		$this->id = 'preloaderFull-'.$this->createID(5);
		$this->type = 'preloaderFull';
		$this->backgroundColor = !isset($arg['backgroundColor']) ? 'b-w-t,2' : $arg['backgroundColor'];
		$this->layerBackgroundColor = !isset($arg['layerBackgroundColor']) ? 'b-w-t,1' : $arg['layerBackgroundColor'];
		$this->shadow = !isset($arg['shadow']) ? NULL : $arg['shadow'];		
		$this->size = !isset($arg['size']) ? NULL : $arg['size'];		
		$this->mode = !isset($arg['mode']) ? 0 : $arg['mode'];			
		$this->determinate = !isset($arg['determinate']) ? FALSE : $arg['determinate'];			
		$this->js = !isset($arg['js']) ? array() : array($arg['js']);
		$this->html = NULL;
		$this->refreshInfo();			
	}
	public function refreshInfo(){
		$id = $this->id;
		$mode = $this->modePreloader($this->mode);
		$layerBackgroundColor = $this->backgroundColors($this->layerBackgroundColor);
		if ($mode == 'linear'){
			$shadow =  $this->shadow($this->shadow);
			$determinate =  $this->determinate;
			if (is_array($this->backgroundColor)){
				$backgroundColor[] = $this->backgroundColors($this->backgroundColor[0]);
				$backgroundColor[] = $this->backgroundColors($this->backgroundColor[1]);
			}
			else{
				$backgroundColor[] = $this->backgroundColors($this->backgroundColor);
				$backgroundColor[] = (explode(",", $this->backgroundColor)[1] > 7) ? $this->backgroundColors(explode(",", $this->backgroundColor)[0].",3") : $this->backgroundColors(explode(",", $this->backgroundColor)[0].",9") ;
			}
			if ($determinate !== FALSE){
				$search = array("{ID}", "{SHADOW}", "{LAYERBACKGROUNDCOLOR}", "{BACKGROUNDCOLOR:0}", "{BACKGROUNDCOLOR:1}", "{DETERMINATE}");
				$replace = array($id, $shadow, $layerBackgroundColor, $backgroundColor[0], $backgroundColor[1], $determinate);
				$tempHtml = 
				"<div id={ID} class='section {LAYERBACKGROUNDCOLOR}' style='position: fixed; top: 0px; z-index: 9999; width: 100%; height: 100%;'><div style='position: absolute;top: 50%;left: 50%;transform: translate(-50%, -50%);' class='container  center-align'><div class='progress {SHADOW} {BACKGROUNDCOLOR:0}'>
					<div class='determinate  {BACKGROUNDCOLOR:1}' style='width: {DETERMINATE}%'></div>
				</div></div></div>";
				$tempHtml = str_replace($search, $replace, $tempHtml);
			}
			else{
				$search = array("{ID}", "{SHADOW}", "{LAYERBACKGROUNDCOLOR}", "{BACKGROUNDCOLOR:0}", "{BACKGROUNDCOLOR:1}");
				$replace = array($id, $shadow, $layerBackgroundColor, $backgroundColor[0], $backgroundColor[1]);
				$tempHtml = 
				"<div id={ID} class='section {LAYERBACKGROUNDCOLOR}' style='position: fixed; top: 0px; z-index: 9999; width: 100%; height: 100%;'><div style='position: absolute;top: 50%;left: 50%;transform: translate(-50%, -50%);' class='container  center-align'><div class='progress {SHADOW} {BACKGROUNDCOLOR:0}'>
					<div class='indeterminate  {BACKGROUNDCOLOR:1}'></div>
				</div></div></div>";
				$tempHtml = str_replace($search, $replace, $tempHtml);
			}
		}
		elseif ($mode == 'circular'){
			$size = $this->sizePreloader($this->size);
			if (is_array($this->backgroundColor)){
				$backgroundColor = $this->backgroundColors($this->backgroundColor[0]);
			}
			else{
				$backgroundColor = $this->backgroundColors($this->backgroundColor);
			}

			$search = array("{ID}", "{SIZE}", "{LAYERBACKGROUNDCOLOR}","{BACKGROUNDCOLOR}");
			$replace = array($id, $size, $layerBackgroundColor, $backgroundColor);			
			$tempHtml = 
			"<div id={ID} class='section {LAYERBACKGROUNDCOLOR}' style='position: fixed; top: 0px; z-index: 9999; width: 100%; height: 100%;'><div style='position: absolute;top: 50%;left: 50%;transform: translate(-50%, -50%);' class='container  center-align'><div class='preloader-wrapper {SIZE} active'>
				<div class='spinner-layer' style='border-color: {BACKGROUNDCOLOR};'>
					<div class='circle-clipper left'>
						<div class='circle'></div>
					</div>
					<div class='gap-patch'>
						<div class='circle'></div>
					</div>
					<div class='circle-clipper right'>
						<div class='circle'></div>
					</div>
				</div>
			</div></div></div>";
			$tempHtml = str_replace($search, $replace, $tempHtml);
		}
		elseif ($mode == 'circularFlashing'){
			$size = $this->sizePreloader($this->size);
			$tempHtml = "<div id={ID} class='section {LAYERBACKGROUNDCOLOR}' style='position: fixed; top: 0px; z-index: 9999; width: 100%; height: 100%;'><div style='position: absolute;top: 50%;left: 50%;transform: translate(-50%, -50%);' class='container  center-align'><div class='preloader-wrapper {SIZE} active'>";
			$arrayTempHtml[] = str_replace(array("{ID}" ,"{SIZE}", "{LAYERBACKGROUNDCOLOR}"), array($id, $size, $layerBackgroundColor), $tempHtml);
			$spinnerColor = array("spinner-blue", "spinner-red", "spinner-yellow", "spinner-green");
			$i = 0;
			foreach ($this->backgroundColor as $key => $color) {
				$i = ($i > 3) ? 0 : $i;
				$subKey = $i;
				$i++;
				$backgroundColor = $this->hexColors($color);		
				$tempHtml = 
				"<div class='spinner-layer {SPINNERCOLOR}' style='border-color: {BACKGROUNDCOLOR};'>
					<div class='circle-clipper left'>
						<div class='circle'></div>
					</div>
					<div class='gap-patch'>
						<div class='circle'></div>
					</div>
					<div class='circle-clipper right'>
						<div class='circle'></div>
					</div>
				</div>";
				$arrayTempHtml[] = str_replace(array("{BACKGROUNDCOLOR}", "{SPINNERCOLOR}"), array($backgroundColor, $spinnerColor[$subKey]), $tempHtml);			
			}
			$arrayTempHtml[] = "</div></div></div>";
			$tempHtml = implode("", $arrayTempHtml);
		}
		
		$this->js[] = $this->createJs($id);
		
		$this->html = $tempHtml;
	}
	public function createJs($id){
	$js = 
	"pF = $('#{$id}');
	preloaderFull = function (arg, pF){
		if(arg == 'on'){
			pF.fadeIn(500);
		}else if(arg == 'off'){
			pF.fadeOut(500);
		}
	}
	setTimeout(function(){preloaderFull('off', pF); },1); ";
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