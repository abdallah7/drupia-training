<?php
class Book {
	public function connect()
	{
		$mysqli = new mysqli('localhost', 'root', '3210', 'task');
		if ($mysqli->connect_errno) {
    	echo "Failed to connect to MySQL: " . $mysqli->connect_error;
			}
			else
			{
				return $mysqli ;
			}
	}
 
	public function add( $text ) {
		$content	= $text;
		$action     = $this->connect();
		if ($action) {
			$user_id 	= $_SESSION['user_id'] ;
			$username	= $_SESSION['username'] ;
			// echo $user_id.$username;
			$query   	= "INSERT INTO `comments` VALUES ( NULL , '$user_id' , '$username' , '$content' ,'0' )";
			$add 	 	= $action->query($query);
				if ($add){
					echo"<div id='Temporary'>thank you $username for your comment</div>";
					$re = $this->select();
			return ($re);

				}else{
						echo "<div id='Temporary'>sorry your comment did not add</div>";
						$re    =$this->select();
						return ($re);
					}
		}
	}


	public function select() {
		$action = $this->connect();
		$result = $action->query("SELECT * FROM `comments` ");
		echo "<table id='myTable'>";
		
		foreach ($result as $key => $value) {
			$i= $value['like'] ;
			$d= $value['comment_id'];
			echo "<tr><td>\r\n";
			echo "<font color='blue' >".$value['name']."</font>\r\n";
			echo "</td><td>".$value['content']."\r\n";
			echo "</td><td>\r\n";
			echo "<input type='button' id='$d' name='delete' value='delete' onclick='getAJAX(this)	' />\r\n";
			echo "</td><td>\r\n";
			echo "<input type='button' id='$d' name='update' value='update' onclick='getAJAX(this)' />\r\n";
			echo "</td><td>\r\n";
			echo "like it: <input type='button' id='$d' name='like' value='$i' onclick='getAJAX(this)' />";
		}
		echo "</td></tr></table></form>\r\n";

    }
		// return $result ;
	public function delete($id){
		$action     = $this->connect();
		$valid= $this->check($id);
		if ($valid == 1 AND $result = $action->query("DELETE FROM comments WHERE comment_id=$id")) {
			echo "<div id='Temporary'>you have delete the comment</div>";
			$re     =$this->select();
			return ($re);
		}else{echo "<div id='Temporary'>you not allow to delete the comment</div>";
			 $re    =$this->select();
				return ($re);}

	}
	public function like($id){
		// echo $id;

		$action = $this->connect();
		$likes  = $action->query("SELECT `like` FROM `comments` WHERE `comment_id` = $id ");
		foreach ($likes as $value) {
			$like_num = $value['like']+1;
				if($result = $action->query("UPDATE `comments` SET `like` = $like_num WHERE comment_id = $id ")){
		    		echo "<div id='Temporary'>thank you for your like</div>";
					$re=$this->select();
					return ($re);

				}else{ echo "<div id='Temporary'>your like did not add</div>";
						$re    =$this->select();
						return ($re);	
				}
			}
	
	}
	public function update($id , $new_comment)
	{
		$action    = $this->connect();
		$valid= $this->check($id);
		if($valid == 1 AND $result = $action->query("UPDATE `comments` SET `content` = '$new_comment' WHERE comment_id = $id ")){
			echo "<div id='Temporary'>you have update the comment</div>";
			$re    =$this->select();
			return ($re);

			}else{
			echo "<div id='Temporary'>you not allow to update the comment</div>";
			$re    =$this->select();
			return ($re);
		}	
		
	}
	public function check($comment_id)
		{
			$action    = $this->connect();
			$user_id  = $action->query("SELECT `user_id` FROM `comments` WHERE `comment_id` = $comment_id ");
			foreach ($user_id as $value) {
			if ($value['user_id'] == $_SESSION['user_id'] || $_SESSION['user_id'] == 1) {
				$accept = 1; 
			}else{$accept = 0 ;}
			
			}

			return $accept;
		}
}
?>