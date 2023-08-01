<?php
/*

Dans la vue, les données sont accessibles par la variable $data


*/

global $data;

class Controller {

	public function render($view, $d=null) {

		$data = $d;

		include "./views/parts/header.php";
		include "./views/".$view.".php";
		include "./views/parts/footer.php";

	}

	public function redirect($url) {
		header("Location: $url");
	}


}