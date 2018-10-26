<?php

use SilverStripe\ORM\ArrayList;
use SilverStripe\ORM\FieldType\DBDate;

class CulturalMonthHolder extends Page {

	private static $db = array(
	);

	private static $has_one = array(

	);

	private static $has_many = array(
	);

	private static $allowed_children = array(
		"CulturalMonth", "Page",
	);

	public function getCMSFields() {

		$f = parent::getCMSFields();

		return $f;
	}

	public function Featured() {

		$sortedMonths = $this->sortedMonths();
		$featured = $sortedMonths->First();
		if($featured){
			return $featured;
		}else{
			return false;
		}
		
	}
	public function Children() {

		$children = CulturalMonth::get();
		$clonedChildren = new ArrayList();
		$clonedChildrenPassed = new ArrayList();
		$newClonedChildren = new ArrayList();
		$now = date('Y-m-d');

		foreach ($children as $child) {
			$cloneChild = new CulturalMonth();
			$cloneChild = $child;
			$cloneChild->StartDate = DBDate::create();
			$cloneChild->StartDate = $child->RelativeStartDate;
			$cloneChild->EndDate = DBDate::create();
			$cloneChild->EndDate = $child->RelativeEndDate;
			//print_r($cloneChild->StartDate);

			if ($cloneChild->EndDate < $now) {
				$clonedChildrenPassed->add($cloneChild);
			} else {
				$clonedChildren->add($cloneChild);
			}
		}

		$newClonedChildren = $clonedChildren->sort('StartDate');
		$clonedChildrenPassed = $clonedChildrenPassed->sort('StartDate');

		foreach ($clonedChildrenPassed as $clone) {
			$newClonedChildren->push($clone);
		}

		return $newClonedChildren;
	}


}