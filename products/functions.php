<?php
//Очистка странички
function clear_str($str) {
	return trim(strip_tags($str));
}
// обработка шаблонов
function render($path,$param = array()) {
	extract($param);
	ob_start();

	if(!include($path.".php")){
		exit("нет такого шаблона");
	}

	return ob_get_clean();
}
?>