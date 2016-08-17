<?php
function statusDecode($s)
{
	switch($s)
	{
		case 'M':
		 echo 'Major Requirement';
		break;
		
		case 'C':
		 echo 'Approved with Comments';
		break;
		
		case 'A':
		 echo 'Approved';
		break;
		
		Default:
		 echo 'Submitted';
		break;
	}
}

function stsDisplay($sts_sent)
{
	switch($sts_sent)
	{
		case 'M':
			echo 'Dissertation is refered back for Major Changes.';
		break;
		
		case 'A':
			echo 'Dissertation is send to next level after your Approval.';
		break;
		
		case 'C':
			echo 'Dissertation is send to next level after your Approval Comments.';
		break;			
		
		case 'S':
			echo 'Dissertation is send to next level for Approval.';
		break;
	}
}