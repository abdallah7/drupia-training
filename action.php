<?php
session_start();
include 'data.php';


if(isset($_POST['action'] )) {
	
	if (($_POST['action']) == 'submit') {
		if (isset($_POST['usertext'])) {
				$text = $_POST['usertext'];
					$book = new Book();
				$book->add( 	$text );
				}else{
					echo "sorry you have to enter name and comment";
			         }
	}elseif (($_POST['action']) == 'like') {
		if ($_POST['l_id']) {
				$id=$_POST['l_id'];
				$book = new Book();
				$book->like($id);
			}
	}elseif ( ($_POST['action']) == 'delete') {
		if ($_POST['d_id']){
				$id=$_POST['d_id'];
				$book = new Book();
				$book->delete($id);
			}
			
		}elseif ( ($_POST['action']) == 'update') {
			if ($_POST['up_id']){
				if ($_POST['new_comment']) {
				$new_comment=$_POST['new_comment'];
				$id=$_POST['up_id'];
				$book = new Book();
				$book->update($id ,$new_comment );
				}
			}
		}
}




?>