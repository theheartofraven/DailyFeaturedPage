<?php

$wgHooks['ParserFirstCallInit'][] = 'wfFeaturedPage';

function wfFeaturedPage( Parser $parser ) {
	$parser->setHook( 'dailyfeaturedpage', 'wfGetFeaturedPage' );
	return true;
}

function wfGetFeaturedPage($input, array $args, Parser $parser) {
	//Set your timezone 
	date_default_timezone_set('America/Los_Angeles');
	
	//To program your article content each day. Choose a start date, or you can also use other PHP date functions to program new content on an hourly or minutely basis.
	$startDate = date('Y-m-d');

	$featuredArticle = array();

	//Gets different article title for each day 
	switch ($startDate) {
		//Change to your current dates below. For example, today's date is August 1, 2013. You use 2013-08-01 for the first day, 2013-08-02 for the next day, etc. 
		//Replace apples, oranges, pears, strawberries, etc. with your own article titles.
		case date("2013-08-01"):
			$featuredArticle[0] = "Apples";
			break;
		case date("2013-08-02"):
			$featuredArticle[0] = "Oranges";
			break;
		//Continue adding cases so that a new article is chosen on other days after August 2nd, 2013
	}

	$title = Title::newFromText($featuredArticle[0]);
	if (!$title) return '<h1>Could not retrieve this Article Page.</h1>';
	$page = $title->getFullText();
	//returns page and parses the transclusion tags, onlyinclude etc., so that only transcluded section is shown. 
	return $parser->recursiveTagParse( '{{:' . $page. '}}');
}

?>
