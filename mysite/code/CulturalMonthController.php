<?php
class CulturalMonthController extends PageController {

	//In template <% loop EventListByTag %> $Title
	public function EventList() {

		if (isset($this->EventTag)) {
			$calendar = LocalistCalendar::get()->First();

			if(!$calendar){
				$calendar = LocalistCalendar::create();
			}
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