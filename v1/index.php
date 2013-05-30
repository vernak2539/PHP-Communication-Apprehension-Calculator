<?php
if($_POST['Isubmitted'] == "truE") {
	foreach($_POST as $p) {
		if($p == "") {
			header("location: " . $_SERVER['REQUEST_URI']);
			exit();
		}
	}
	include 'library/Calculator.php';
	try {
		$calc = new Calculator($_POST);
	} catch (Exception $e) {
		
	}
}
ob_start();
function displaySelect($id) {
	echo '
	<select name="' .$id. '" id="'.$id.'">
		<option value="">Select</option>
		<option value="1">Strongly Disagree</option>
		<option value="2">Disagree</option>
		<option value="3">Neutral</option>
		<option value="4">Agree</option>
		<option value="5">Strongly Agree</option>
	</select>
		';
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<title>Communication Apprehension Calculator</title>
    <link href="styles/styles_main.css" rel="stylesheet" />
</head>

<body>
<div id="container">
    <h1>Communication Apphrehension Calculator</h1>
    <p class="pointer center"><a href="#" id="more_info_click">More Info about the Personal Report of Communication Apprehension (PRCA-24)</a></p>
    <p class="hide">The PRCA-24 is the instrument which is most widely used to measure communication apprehension. It is preferable above all earlier versions of the instrument (PRCA, PRCA10, PRCA-24B, etc.). It is highly reliable (alpha regularly >.90) and has very high predictive validity. It permits one to obtain sub-scores on the contexts of public speaking, dyadic interaction, small groups, and large groups. However, these scores are substantially less reliable than the total PRCA-24 scores-because of the reduced number of items. People interested only in public speaking anxiety should consider using the PRPSA rather than the public speaking sub-score drawn from the PRCA-24. It is much more reliable for this purpose. </p>
    <?php 
	if(isset($calc)) {
	    echo '<p class="center">Taken from <a href="http://www.jamescmccroskey.com/measures/prca24.htm" target="_blank">http://www.jamescmccroskey.com/measures/prca24.htm</a></p>';
		echo '<p class="center" style="margin-top:10px;"><strong>Your Group Discussion Score is: '.$calc->getScore('group').'</strong></p>';
		echo '<p class="center" style="margin-top:10px;"><strong>Your Meeting Score is: '.$calc->getScore('meeting').'</strong></p>';
		echo '<p class="center" style="margin-top:10px;"><strong>Your Interpersonal Score is: '.$calc->getScore('interpersonal').'</strong></p>';
		echo '<p class="center" style="margin-top:10px;"><strong>Your Public Speaking Score is: '.$calc->getScore('public').'</strong></p>';
		echo '<p class="center" style="margin-top:10px;"><strong>Your PRCA Score is:<span class="big">'.$calc->calculatePRCA().'</strong></p>';
	} else {
    ?>
    <p class="instructions">This instrument is composed of twenty-four statements concerning feelings about communicating with others. Please indicate the degree to which each statement applies to you by marking whether you:</p>
    <ul class="clearfix black">
        <li>Strongly Disagree</li>
        <li>Disagree</li>
        <li>Neutral</li>
        <li>Agree</li>
        <li>Strongly Agree</li>
    </ul>
    <div class="clear">&nbsp;</div>
    <h2>Questions</h2>
    <form action="<?php echo $_SERVER['REQUEST_URI']; ?>" method="post">
        <input type="hidden" name="Isubmitted" value="truE" />
        <ol>
            <li>
				<?php displaySelect('q1'); ?>
                <label for="q1">I dislike participating in group discussions.</label>
            </li>
            <li>
				<?php displaySelect('q2'); ?>
                <label for="q2">Generally, I am comfortable while participating in group discussions.</label>
            </li>
            <li>
				<?php displaySelect('q3'); ?>
                <label for="q3">I am tense and nervous while participating in group discussions.</label>
            </li>
            <li>
				<?php displaySelect('q4'); ?>
                <label for="q4">I like to get involved in group discussions. </label>
            </li>
            <li>
				<?php displaySelect('q5'); ?>
                <label for="q5">Engaging in a group discussion with new people makes me tense and nervous.</label> 
            </li>
            <li>
				<?php displaySelect('q6'); ?>
                <label for="q6">I am calm and relaxed while participating in group discussions. </label>
            </li>
            <li>
				<?php displaySelect('q7'); ?>
                <label for="q7">Generally, I am nervous when I have to participate in a meeting. </label>
            </li>
            <li>
				<?php displaySelect('q8'); ?>
                <label for="q8">Usually, I am comfortable when I have to participate in a meeting. </label>
            </li>
            <li>
				<?php displaySelect('q9'); ?>
                <label for="q9">I am very calm and relaxed when I am called upon to express an opinion at a meeting. </label>
            </li>
            <li>
				<?php displaySelect('q10'); ?>
                <label for="q10">I am afraid to express myself at meetings. </label>
            </li>
            <li>
				<?php displaySelect('q11'); ?>
                <label for="q11">Communicating at meetings usually makes me uncomfortable. </label>
            </li>
            <li>
				<?php displaySelect('q12'); ?>
                <label for="q12">I am very relaxed when answering questions at a meeting. </label>
            </li>
            <li>
				<?php displaySelect('q13'); ?>
                <label for="q13">While participating in a conversation with a new acquaintance, I feel very nervous. </label>
            </li>
            <li>
				<?php displaySelect('q14'); ?>
                <label for="q14">I have no fear of speaking up in conversations. </label>
            </li>
            <li>
				<?php displaySelect('q15'); ?>
                <label for="q15">Ordinarily I am very tense and nervous in conversations.</label>
            </li>
            <li>
				<?php displaySelect('q16'); ?>
                <label for="q16">Ordinarily I am very calm and relaxed in conversations. </label>
            </li>
            <li>
				<?php displaySelect('q17'); ?>
                <label for="q17">While conversing with a new acquaintance, I feel very relaxed.</label>
            </li>
            <li>
				<?php displaySelect('q18'); ?>
                <label for="q18">I'm afraid to speak up in conversations.</label>
            </li>
            <li>
				<?php displaySelect('q19'); ?>
                <label for="q19">I have no fear of giving a speech.</label>
            </li>
            <li>
				<?php displaySelect('q20'); ?>
                <label for="q20">Certain parts of my body feel very tense and rigid while giving a speech. </label>
            </li>
            <li>
				<?php displaySelect('q21'); ?>
                <label for="q21">I feel relaxed while giving a speech. </label>
            </li>
            <li>
				<?php displaySelect('q22'); ?>
                <label for="q22">My thoughts become confused and jumbled when I am giving a speech. </label>
            </li>
            <li>
				<?php displaySelect('q23'); ?>
                <label for="q23">I face the prospect of giving a speech with confidence. </label>
            </li>
            <li>
				<?php displaySelect('q24'); ?>
                <label for="q24">While giving a speech, I get so nervous I forget facts I really know.</label>
            </li>
        </ol>
        <p class="error">Please make sure you filled out all fields before clicking the "Calculate" button below.</p>
        <p><input type="submit" value="Calculate" /></p>
    </form>
    <?php } ?>
    <br />
    <p style="text-align:center"><small>&copy; 2012 Alex Vernacchia</small></p>
</div>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js" type="text/javascript"></script>
<script type="text/javascript">
	$(document).ready(function() {
		$('.hide').hide();
		$('#more_info_click').click(function(event) {
			event.preventDefault();
			var nextPar = $(this).parent().next();
			if(nextPar.css('display') == "block") {
				nextPar.slideUp('fast');
			} else {
				nextPar.slideDown();
			}
		});
	});
</script>
</body>
</html>
<?php ob_flush(); ?>