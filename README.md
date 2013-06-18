<h1>PHP Communication Apprehension Calculator</h1>
<p>by Alex Vernacchia</p>

<p>This instrument was created based on McCroskey's <a href="http://www.jamescmccroskey.com/measures/prca24.htm" target="_blank">Personal Report of Communication Apprehension (PRCA-24)</a>, and was made for my MS at Purdue University.</p>

<h2>Usage</h2>
<p>This class accepts $_POST data from an online form. This form should include the 24 questions stated by McCroskey in the link above.</p>
	include '/path/to/class/Calculator.php';
	$calculator = new Calculator($_POST);

	// can get individual group scores with ->getScore($group)
	// group   => Group Discussion Score
	// meeting => Meeting Score
	// interpersonal => Interpersonal Score
	// public => Public Speaking Score
	$group_discussion_score = $calculator->getScore('group');

	// getting total communication apprehension score
	$PRCA = $calculator->calculatePRCA();
