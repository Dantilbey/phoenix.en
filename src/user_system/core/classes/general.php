<?php
class General {
	#check if the user is logged in
	public function logged_in() {
		return(isset($_SESSION['id'])) ? true : false;
	}

	#if logged in then redirect to home.php
	public function logged_in_protect() {
		if ($this->logged_in() === true) {
			header('Location: home.php');
			exit();
		}
	}

	#if not logged in then redirect to index.php
	public function logged_out_protect() {
		if($this->logged_in() === false) {
			header('Location: index.php');
			exit();
		}
	}

	public function file_newpath($path, $filename) {
		if ($pos = strrpos($filename, '.')) {
			$name = substr($filename, 0, $pos);
			$ext = substr($filename, $pos);
		} else {
			$name = $filename;
		}

		$newpath = $path.'/'.$filename;
		$newname = $filename;
		$counter = 0;

		while (file_exists($newpath)) {
			$newname = $name .'_'. $counter . $ext;
			$newpath = $path.'/'.$newname;
			$counter++;
		}
		return $newpath;
	}
}
?>