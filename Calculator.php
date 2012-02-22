<?php
/*
*
* Communication Apprehension Calculator
* 
* This class calculates a persons Communication Apprehension (CA) 
* score based on James Mccroskey Personal Report of Communication 
* Apprehension (PRCA-24).
* 
* Information about how to calculate this score can be found at 
* http://www.jamescmccroskey.com/measures/prca24.htm
*
* @license 		MIT License (http://www.opensource.org/licenses/MIT)
* @copyright 	2012 Alex Vernacchia
* @demo			http://ca.alexvernacchia.com
* @author 		Alex Vernacchia <avernacc[at]gmail[dot]com>
* @website		http://www.alexvernacchia.com
*
*/

class Calculator {
	///////////////////////////////////////////////////////////////////////////////
	//	VARIABLES
	//
	//	$_gs, $_ms, $_is, $_ps - represent the final scores for each of 
	//							 the 4 question groups 
	//  $_data - holds the data recieved from a form
	//	$_keys - holds data which is then used to make variable variables	
	//	$_group_score_q 		  - contains the questions whose score is used  
	//					  			to calculate the group discussion score
	//	$_meeting_score_q 		  - contains the questions whose score is used  
	//					    		to calculate the meeting score
	//	$_interpersonal_score_q   - contains the questions whose score is used  
	//					  		    to calculate the interpersonal  score
	//	$_public_speaking_score_q - contains the questions whose score is used  
	//								to calculate the group discussion score
	//	$_lookup - determines which group score to return  
	//			   
	///////////////////////////////////////////////////////////////////////////////
	private $_gs, $_ms, $_is, $_ps, $_combined_array;
	private $_data, $_keys		 		= array();
	private $_group_score_q 			= array(array('2','4','6'), array('1','3','5'));
	private $_meeting_score_q 			= array(array('8','9','12'), array('7','10','11'));
	private $_interpersonal_score_q 	= array(array('14','16','17'), array('13','15','18'));
	private $_public_speaking_score_q 	= array(array('19','21','23'), array('20','22','24'));
	private $_lookup					= array("group" => "_gs",
												"meeting" => "_ms",
												"interpersonal" => "_is",
												"public" => "_ps"
										  );
	
	///////////////////////////////////////////////////////////////////////////////
	// Function: __construct($data)
	// Paramerters: 
	//		1. $data: scores from 24 questions answered prior. See link above
	// Description: Takes scores and calculates all group scores
	//		1. processes data
	//		2. builds array with question groups and to be variable variables
	//		3. gets keys for finding information in InitialArray()
	//		4. calculates the 4 group scores
	public function __construct($data) {
		$this->castData($data);
		$this->getInitialArray();
		$this->getArrayKeys();
		$this->calculateScores();
	}
	
	///////////////////////////////////////////////////////////////////////////////
	// Function: getScore($group)
	// Paramerters: 
	//		1. $group: group score you want to get. Stored in $_lookup
	// Description: returns score for group of questions
	//		1. gets lookup variable
	//		2. makes variable variable and returns it
	public function getScore($group) {
		$var = $this->_lookup[$group];
		return $this->$var;
	}
	
	///////////////////////////////////////////////////////////////////////////////
	// Function: calculatePRCA()
	// Description: calculates the Personal Report of Communication
	//		1. adds question groups together
	public function calculatePRCA() {
		return $this->_gs + $this->_ms + $this->_is + $this->_ps;
	}
	
	///////////////////////////////////////////////////////////////////////////////
	// Function: calculatePRCA()
	// Description: calculates the Personal Report of Communication
	//		1. adds question groups together
	private function castData($data) {
		foreach($data as $key => $value) {
			if($d != 'truE') { // this is the hidden post variable allowing me to submit my form. if statement can be removed if not needed
				$this->_data[$key] = (int)$value;
			}
		}
	}
	
	///////////////////////////////////////////////////////////////////////////////
	// Function: getInitialArray()
	// Description: builds array with all information
	private function getInitialArray() {
		$this->_combined_array = array(
			array('_gs' => $this->_group_score_q),
			array('_ms' => $this->_meeting_score_q),
			array('_is' => $this->_interpersonal_score_q),
			array('_ps' => $this->_public_speaking_score_q)
		);
	}
		
	///////////////////////////////////////////////////////////////////////////////
	// Function: calculateScores()
	// Description: calculates the 4 group scores
	//		1. cycles through $_combined_array
	//		2. gets scores from data based on group
	//		3. gets the key for the variable varialbe
	//		4. calculates the individual group score
	private function calculateScores() {
		for($i = 0; $i < count($this->_combined_array); $i++) {
			$scores = $this->addArrays($this->_combined_array[$i][$this->_keys[$i]]);
			$score = $this->_keys[$i];
			$this->$score = 18 - $scores[0] + $scores[1];
		}
	}
		
	///////////////////////////////////////////////////////////////////////////////
	// Function: addArrays($arrays)
	// Parameters:
	//		1. $arrays - one of the group score arrays ($_interpersonal_score)
	// Description: adds scores from one question group
	//		1. cycles through arrays passed to it
	//		2. adds scores from $_data for current array
	//		3. stores data
	//		4. returns data array witn added scores 
	private function addArrays($arrays) {
		$ctr = 0;
		foreach($arrays as $array) {
			$result = 0;
			foreach($array as $a) {
				// 'q' was added because of how the $_POST data was sent
				// ex) <select name="q#">...
				$result += $this->_data['q' . $a];
			}
			if($ctr == 0) {
				$questionGrp1 = $result;
			} else if($ctr == 1) {
				$questionGrp2 = $result;
			}
			$ctr++;
		}
		return array($questionGrp1, $questionGrp2);
	}
	
	///////////////////////////////////////////////////////////////////////////////
	// Function: getArrayKeys()
	// Description: generates keys to be used when making variable varialbes
	//		1. cycles through $_combined_array
	//		2. stores $key
	private function getArrayKeys() {
		foreach($this->_combined_array as $array) {
			foreach($array as $key => $value) {
				$this->_keys[] = $key;
			}
		}
	}
}