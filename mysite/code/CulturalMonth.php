<?php
//In the CMS, someone puts "LGBTQ Month" as a tag, and then this page is populated with events from the tag.
class CulturalMonth extends Page {

	private static $db = array(
		'EventTag' => 'Text',
		'EventTagTitle' => 'Text',
		'StartDate' => 'Date',

		'EndDate'=> 'Date',
		'RelativeStartDate'=>'Text',
		'RelativeEndDate'=>'Text',




	);

	private static $has_one = array(

	);

	private static $has_many = array(
	);

	public function getCMSFields() {

		$f = parent::getCMSFields();
		$f->addFieldToTab("Root.Main", new TextField("EventTag", "Event Type ID Number", "Content"));
		$f->addFieldToTab("Root.Main", new TextField("EventTagTitle", "Event Type Title", "Content"));
		$startDateField = DateField::create('StartDate')->setConfig('showcalendar', true);
		$endDateField = DateField::create('EndDate')->setConfig('showcalendar', true);
		$f->addFieldToTab("Root.Main", new TextField("RelativeStartDate", "Relative Start Date", "Content"));
		$f->addFieldToTab("Root.Main", new TextField("RelativeEndDate", "Relative End Date", "Content"));


		// $f->addFieldToTab('Root.Main', $startDateField);
		// $startDateField->setConfig('showcalendar', true);
		// $startDateField->setConfig('dateformat', 'MM/dd/YYYY');

		// $f->addFieldToTab('Root.Main', $endDateField);
		// $endDateField->setConfig('showcalendar', true);
		// $endDateField->setConfig('dateformat', 'MM/dd/YYYY');


		return $f;
	}

}

class CulturalMonth_Controller extends Page_Controller {

	//In template <% loop EventListByTag %> $Title
	public function EventList() {

		if (isset($this->EventTag)) {
			$calendar = LocalistCalendar::get()->First();
			$term = $this->EventTag;

			$termFiltered = urlencode($term);

			$events = $calendar->EventList(
				$days = '200',
				$startDate = null,
				$endDate = null,
				$venue = null,
				$keyword = null,
				$type = $term,
				$distinct = 'true',
				$enableFilter = false,
				$searchTerm = null
			);
			return $events;

		} else {
			return null;
		}

	}

}