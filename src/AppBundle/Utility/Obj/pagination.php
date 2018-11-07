<?php

namespace AppBundle\Utility\Obj;

use AppBundle\Utility\Obj\CreateClass\createClass;

/*
	href es un array y los valores son string "href,id"
 */
class pagination extends createClass
{
	protected $id;
	protected $type;
	protected $textColor;
	protected $backgroundColor;
	protected $waves;
	protected $limit;
	protected $active;
	protected $href;
	protected $html;
	public function __construct($arg = NULL)
	{
		$this->reset($arg);
	}
	public function reset($arg = NULL)
	{
		$this->id = 'pagination-'.$this->createID(5);
		$this->type = 'pagination';
		$this->textColor = !isset($arg['textColor']) ? NULL : $arg['textColor'];
		$this->backgroundColor = !isset($arg['backgroundColor']) ? NULL : $arg['backgroundColor'];	
		$this->waves = !isset($arg['waves']) ? NULL : $arg['waves'];	
		$this->limit = !isset($arg['limit']) ? 50 : $arg['limit'];	
		$this->active = !isset($arg['active']) ? 1 : $arg['active'];	
		$this->href = !isset($arg['href']) ? array() : $arg['href'];
		$this->html = NULL;	
		$this->refreshInfo();
	}
	public function refreshInfo(){
		$id = $this->id;
		$textColor =  $this->textColors($this->textColor);
		$backgroundColor =  $this->backgroundColors($this->backgroundColor);
		$waves = $this->waves($this->waves);
		$limit = $this->limit;
		$active = $this->active; //pagina actual id pag
		$show = count($this->href); //cantidad de paginas que se muestran 

		$activeItem = '';


		// <
		$start = explode(",",reset($this->href));
		$start[1] = $start[1]-1;
		if(($active - $show) <= 0) {
			$item[] = "<li class='disabled {$waves}'><a href='#!'><i class='material-icons'>chevron_left</i></a></li>";
		}
		else{
			$item[] = "<li class=' {$waves} '><a class='{$textColor}' href='{$start[0]}{$start[1]}'><i class='material-icons'>chevron_left</i></a></li>";
		}
		// items
		if ($active > $show){
			$num = $active - $show + 1;
		}
		else{
			$num = 1;
		}
		for ($i=0; $i < $show; $i++) { 
			if ($num == $active) { 
				$activeItem = " active {$backgroundColor}"; 
				$textColor = "";
			}
			else{ 
				$activeItem = ""; 
				$textColor =  $this->textColors($this->textColor);
			}
			$link = explode(",", $this->href[$i]);

			$item[] = "<li class='{$activeItem} {$waves}'><a class='{$textColor}' href='{$link[0]}{$link[1]}'>{$num}</a></li>";
			$num++;
		}
		// >
		$end = explode(",",end($this->_href));
		$end[1] = $end[1]+1;
		if($this->textColor !== false){ 
			$textColor = $this->textColors($this->textColor); 
		}
		if($active == $limit) {
			$item[] = "<li class='disabled {$waves}'><a href='#!'><i class='material-icons'>chevron_right</i></a></li>";
		}
		else{
			$item[] = "<li class='{$waves}'><a class='{$textColor}' href='{$end[0]}{$end[1]}'><i class='material-icons'>chevron_right</i></a></li>";
		}
		$tmpHtml = 
		"<ul class='pagination'>
			{ITEM}
		</ul>";
		$this->html = str_replace("{ITEM}", implode("", $item), $tmpHtml);
	
	}
}