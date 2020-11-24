<?php
use SilverStripe\Forms\DateField;
use SilverStripe\Forms\TextField;

//In the CMS, someone puts "LGBTQ Month" as a tag, and then this page is populated with events from the tag.
class CulturalMonth extends Page {

	private static $db = array(
		'EventTag' => 'Text',
		'EventTagTitle' => 'Text',
		'StartDate' => 'Date',

		'EndDate' => 'Date',
		'RelativeStartDate' => 'Text',
		'RelativeEndDate' => 'Text',
	);

	private static $has_one = array(

	);

	private static $has_many = array(
	);

	public function getCMSFields() {

		$f = parent::getCMSFields();
		$startDateField = DateField::create('StartDate');
		$endDateField = DateField::create('EndDate');
		//print_r($f);
		$backgroundImageField = $f->dataFieldByName('BackgroundImage');
		// print_r($BackgroundImageField);
		$backgroundImageField->setDescription('Preferred image dimensions: 1920 x 1080');
		$f->addFieldToTab("Root.Main", new TextField("RelativeStartDate", "Relative Start Date", "Content"));
		$f->addFieldToTab("Root.Main", new TextField("RelativeEndDate", "Relative End Date", "Content"));

		return $f;
	}

}
