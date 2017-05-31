<?php

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
	public function sortedMonths() {

		$children = CulturalMonth::get();
		$clonedChildren = new ArrayList();
		$clonedChildrenPassed = new ArrayList();
		$newClonedChildren = new ArrayList();
		$now = date('Y-m-d');
		//$now = '2017-11-03';

		foreach ($children as $child) {
			$cloneChild = $child->duplicate(false);

			//setting the start date / end date proprety here.
			$cloneChild->StartDate = new Date();
			$cloneChild->StartDate->setValue(date('Y-m-d', strtotime($child->obj('RelativeStartDate', strtotime($now)))));
			$cloneChild->EndDate = new Date();
			$cloneChild->EndDate->setValue(date('Y-m-d', strtotime($child->obj('RelativeEndDate'), strtotime($now))));
			$cloneChild->Original = $child;


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

		//print_r($newClonedChildren);

		return $newClonedChildren;
	}


}

class CulturalMonthHolder_Controller extends Page_Controller {

}
