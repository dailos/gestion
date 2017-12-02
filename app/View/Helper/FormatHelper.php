<?php
class FormatHelper extends AppHelper {
	public function money($number){
		return number_format($number,2,',','.')  ." &euro;";		
	} 
	public function number($number){
		return number_format($number,2,',','.') ;		
	} 
	public function date($date){
		return date("d-m-Y",strtotime($date));		
	} 
}
?>