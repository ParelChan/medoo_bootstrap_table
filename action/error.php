<?php
if(!defined('IN_SYS')) {
	exit('deny');
}
trigger_error("error!!!",E_USER_ERROR);
echo "<br/>after error!";