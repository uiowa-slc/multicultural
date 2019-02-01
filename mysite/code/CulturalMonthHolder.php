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

    public function SortedChildren() {

        $children = CulturalMonth::get();
        $clonedChildren = new ArrayList();
        $clonedChildrenPassed = new ArrayList();
        $newClonedChildren = new ArrayList();
        $now = date('Y-m-d');

        foreach ($children as $child) {
            $cloneChild = new CulturalMonth();
            $cloneChild->Title = $child->Title;
            $cloneChild->Content = $child->Content;
            $cloneChild->BackgroundImage = $child->BackgroundImage;
            $cloneChild->URLSegment = $child->URLSegment;

            $cloneChild->StartDate = DBDate::create();
            $cloneChild->StartDate = date('Y-m-d', strtotime($child->obj('RelativeStartDate', strtotime($now))));
            $cloneChild->EndDate = DBDate::create();
            $cloneChild->EndDate = date('Y-m-d', strtotime($child->obj('RelativeEndDate'), strtotime($now)));            //print_r($cloneChild->StartDate);

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
        //return $clonedChildrenPassed;
    }

}
