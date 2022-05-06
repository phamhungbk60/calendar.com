<?php

class Presenter {

	private $businessLogic;

	public function __construct(Logic $logic) {
		$this->businessLogic = $logic;
	}

	function printCalendars() {
		$this->putCalendarListTitle();
		foreach ($this->businessLogic->getCalendars() as $calendar) {
			$this->putCalendarListElement($calendar);
		}
	}

	function printCalendarContents() {
		$this->putCalendarTitle();

		$eventsForCalendar = $this->businessLogic->getEventsForCalendar(htmlspecialchars($_GET['showThisCalendar']));
		foreach ($eventsForCalendar as $event) {
			$this->putEventListElement($event);
		}
	}

	function printEventDetails() {
		$this->putEvent($this->businessLogic->getEventById($_GET['showThisEvent'], $_GET['calendarId']));
	}

	function putHome() {
		print('<h2>Welcome to Google Calendar API Client</h2>');
	}

	function putMenu() {
		$this->putLink('?action=putHome', 'Home');
		$this->putLink('?action=printCalendars', 'Calendar List');
		$this->putLink('?logout', 'Log Out');
		print('<br><br>');
	}

	private function putEvent($event) {
		$this->putTitle('Event details: ' . $event['summary']);
		$this->putBlock('Status of the event: ' . $event['status']);
		$this->putBlock('Create time: ' .
				date('Y-m-d H:m', strtotime($event['created'])) .
				', most recent fix ' .
				date('Y-m-d H:m', strtotime($event['updated'])) . '.');
		$this->putBlock('Note: <strong>' . $event['summary'] . '</strong>.');
	}

	private function putCalendarTitle() {
		global $client;
		$this->putTitle('The following is the event list for the calendar ' . getCalendar($client, $_GET['showThisCalendar'])['summary'] . ' :');
	}

	private function putCalendarListElement($calendar) {
		$this->putLink('?action=printCalendarContents&showThisCalendar=' . htmlentities($calendar['id']), $calendar['summary']);
		print('<br>');
	}

	private function putCalendarListTitle() {
		$this->putTitle('Here is your calendar list:');
	}

	private function putEventListElement($event) {
		print('<div style="font-size:10px;color:grey;">' . date('Y-m-d H:m', strtotime($event['created'])));
		$this->putLink('?action=printEventDetails&showThisEvent=' . htmlentities($event['id']) .
				'&calendarId=' . htmlentities($_GET['showThisCalendar']), $event['summary']);
		print('</div>');
		print('<br>');
	}

	private function putLink($href, $text) {
		print(sprintf('<a href="%s" style="font-size:20px;color:red;margin-left:10px;">%s</a> | ', $href, $text));
	}

	private function putTitle($text) {
		print(sprintf('<h3 style="font-size:20px;color:blue;">%s</h3>', $text));
	}

	private function putBlock($text) {
		print('<div display="block">' . $text . '</div>');
	}
}

?>
