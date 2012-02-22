<h1>PHP Communication Apprehension Calculator</h1>
<p>by Alex Vernacchia</p>

<p>This instrument was created based on McCroskey's <a href="http://www.jamescmccroskey.com/measures/prca24.htm" target="_blank">Personal Report of Communication Apprehension (PRCA-24)</a>, and was made for my MS at Purdue University.</p>

<p><a href="http://ca.alexvernacchia.com" target="_blank">See it in action</a> and find out your score.</p>

<h2>Usage</h2>
<p>This class accepts $_POST data from an online form. This form should include the 24 questions stated by McCroskey in the link above.</p>
<p>
<code>
include '/path/to/class/Calculator.php';\r\n
$calculator = new Calculator($_POST);\r\n\r\n

// can get individual group scores with ->getScore($group)\r\n
// group   => Group Discussion Score\r\n
// meeting => Meeting Score\r\n
// interpersonal => Interpersonal Score\r\n
// public => Public Speaking Score\r\n
$group_discussion_score = $calculator->getScore('group');\r\n\r\n

// getting total communication apprehension score\r\n
$PRCA = $calculator->calculatePRCA();
</code>
</p>
