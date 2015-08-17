<?php
session_start();
echo "wellcome ".$_SESSION['username'];
?><!DOCTYPE html>
<html>
<head>
	<title></title>
</head>


<script type="text/javascript">
function getAJAX(input)
{
    var xmlhttp;
    if (window.XMLHttpRequest) {
        xmlhttp = new XMLHttpRequest();
    } else {
        xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
    }

    xmlhttp.onreadystatechange = function() {
        if (xmlhttp.readyState == 4 && xmlhttp.status == 200)
        {
    		document.getElementById("alert").innerHTML=xmlhttp.responseText;
        	
        }
    }
    var type = input.name;
	    xmlhttp.open("POST", "action.php", true);
	    xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    if (type == "submit") 
    	{
    	 if (document.getElementById("text").value== "") {
    	 	alert("you have to enter your comment");
    	 	return;
    	 };
	    var text =document.getElementById("text").value;   
	    xmlhttp.send("usertext=" + text + "&action=" + type);
         }else if (type == "delete")
         		{
	    		var commint_id = input.id;
			    xmlhttp.send("d_id=" + commint_id + "&action=" + type);
    		}else if(type == "like")
    			{
    			var like_id = input.id;
    			
			    xmlhttp.send("l_id=" + like_id + "&action=" + type);
    		}else if(type == "update"){
    			 var comment = prompt("Please enter your comment", "");
  				 if (comment != null) {
  				 	var update_id = input.id ;
     				xmlhttp.send("up_id=" + update_id + "&new_comment=" + comment +"&action=" + type);

    			}
    		}	    
}

</script>
<style type="text/css">
	
</style>
<body>
<?php
if(!$_SESSION['username']){
	header("location:index.php");
}else{
	echo "<a href='logout.php'>logout</a>";
	include 'data.php';
}
?>
	<div align="center">	
		<form method="post" >
		<input type="hidden" id="action" name="action"  />
			<textarea rows="4" cols="50" id="text" name="text" placeholder="enter your commint here....." ></textarea><br>
			<input type="button" value="submit" name="submit" onclick="getAJAX(this)" /><br>
		
	</div>
	<div id="alert" align="center" >
	<?php
		$book = new Book();
		$book->select();
	?>	
	</div>
	
	
</body>
</html>

