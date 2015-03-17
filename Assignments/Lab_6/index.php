<?php

require_once "src/PageLayout.php";

use VTC\Lab_5\PageLayout as PageLayout;

if (isset($_POST['submit'])) {
	PageLayout\PageLayout::displayResults();
} else {
	echo PageLayout\PageLayout::$header;
	echo PageLayout\PageLayout::$form_layout;
	echo PageLayout\PageLayout::$footer;
}
