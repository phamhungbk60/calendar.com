<?php

class Router {

	private $presenter;

	function __construct(Presenter $presenter) {
		$this->presenter = $presenter;
	}

	function doUserAction() {
		$this->presenter->putMenu();
		switch ($_GET['action']) {
			case 'putHome':
				$this->presenter->putHome();
				break;

			case 'printCalendars':
				$this->presenter->printCalendars();
				break;

			case 'printCalendarContents':
				$this->presenter->printCalendarContents();
				break;

			case 'printEventDetails':
				$this->presenter->printEventDetails();
				break;
			
			default:
				$this->presenter->printCalendarContents();
				break;
		}
	}
}