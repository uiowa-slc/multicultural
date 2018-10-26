<?php
use SilverStripe\Forms\TextField;
use SilverStripe\Forms\DateField;
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
		$startDateField = DateField::create('StartDate');
		$endDateField = DateField::create('EndDate');
		$f->addFieldToTab("Root.Main", new TextField("RelativeStartDate", "Relative Start Date", "Content"));
		$f->addFieldToTab("Root.Main", new TextField("RelativeEndDate", "Relative End Date", "Content"));


		return $f;
	}

}