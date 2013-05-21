<?php 
	require_once('../classes/Login.class.php');
	try {
		$l = new Login;
		if(!$l->isUserLoggedIn()==true){//nagaan of sessie bestaat
				throw new Exception("session is lost!");
	}
		
	} catch (Exception $e) {
		echo "Problem: ";
	}

	if(isset($_GET['id'])){
		$id= $_GET['id'];
	}
	$url="http://build.uitdatabank.be/api/event/".$id."?key=AEBA59E1-F80E-4EE2-AE7E-CEDD6A589CA9&format=json";
	$event= json_decode(file_get_contents($url));

	include_once('../classes/Twit.class.php');
		$tweet = new Twit();
		if(isset($_POST['btnCreatePost']))
		{
			try
			{
				$tweet->Text = $_POST['post'];
				$tweet->UserId = $_SESSION['user_name'];
				$tweet->Save();
				$feedback['text'] = "Your tweet has been posted!";
				$feedback['status'] = "success";
			}
			catch(Exception $e)
			{
				$feedback['text'] = $e->getMessage();
				$feedback['status'] = "error";
			}
		}

		$allTweets = $tweet->getAll();

		$base="http://127.0.0.1/school/project2/";//lui zijn heeft zijn voordelen!! Dit dient voor link snel aan te passen 
 ?>

<!doctype html>
<html lang="en">
<head>
	 <meta charset="UTF-8">
    <title>Eventfeeder</title>
    <link rel="stylesheet" href="../css/reset.css">
    <link rel="stylesheet" href="../css/style.css">
    <link href='http://fonts.googleapis.com/css?family=Jura:300,400,500,600' rel='stylesheet' type='text/css'>
</head>
<body>
    <div id="container">        
       <a href="<?php echo $base.'index.php' ?>">
       		<img id="logo" src="<?php echo $base.'img/logo.png' ?>" alt="Eventfeeder">
       	</a>
       <div id="logout">
       		<?php echo $_SESSION['user_name']; ?>
    	   	<a href="<?php echo $base.'index.php?logout';?>">Afmelden</a>
       </div>
		<div data-role="content">	
				<div data-role="header" id="titelEvenement">
					<h1><?php echo $event->event->eventdetails->eventdetail->title; ?></h1>
				</div>
			<div id="beschrijfDetails">
					<div id="descript"><?php echo $event->event->eventdetails->eventdetail->shortdescription; ?></div>
					<div id="descriptAdres">
						<?php 
							echo $event->event->location->address->physical->zipcode ." ";
							echo $event->event->location->address->physical->city." ";
							echo $event->event->location->address->physical->street." ";
							echo $event->event->location->address->physical->housenr." ";
						?>
					</div>
					<div id="descriptOpen"><?php echo $event->event->eventdetails->eventdetail->calendarsummary; ?></div>
					<div id="descriptURL">
						<?php 
							if(isset($event->event->contactinfo->url)){
								echo "<a href='".$event->event->contactinfo->url."'>".$event->event->contactinfo->url."</a>";
							}else
							{echo "";} 
						?>
					</div>
			</div>	
	
			<div id="imgDetails">
				<?php

				$images = "";
              		if(isset($event->event->eventdetails->eventdetail->media->file)){
                		$images = $event->event->eventdetails->eventdetail->media->file;
              		}
             		 if(!is_object($images) && !empty($images))
             		{
                		foreach ($images as $image) {
                  			if($image->mediatype == "photo")
                 	 {
                   			 echo "<img class='img' src='".$image->hlink."'>";
                  }
                }
              }
			 	?>
			</div>
		</div>
		<div id="interactief"><h3>Wees UiTeractief met ons!</h3></div>
		<div id="feedTwit">
			<a class="twitter-timeline" href="https://twitter.com/UiTinVlaanderen" data-widget-id="336389708814888960">
			Tweets by @UiTinVlaanderen</a>
			<script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0],p=/^http:/.test(d.location)?'http':'https';if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src=p+"://platform.twitter.com/widgets.js";fjs.parentNode.insertBefore(js,fjs);}}(document,"script","twitter-wjs");</script>
		</div>
		<div id="kader">
				<div id="feedUit">	
						<section id="tweets">		
							<ul>
								<?php if(count($allTweets) > 0): ?>
								<?php foreach($allTweets as $tweet){ ?>
									<li class="clearfix">
										<p><?php echo $tweet['text'] . " <span>" . $tweet['date_posted'] . "</span>"; ?></p>
										            <?php echo "  <li>
			                                            <div id='barTwit'>   </div>
			                                        </li>"; ?>
									</li>
								<?php } ?>
								<?php else: ?>
								<li id="noposts">Oops, there are no posts yet.</li>
								<?php endif; ?>
							</ul>	
						</section>
						<section id="newpost">
							<div id="kader2">
								<form action="" method="post">
									<label for="post" id="feedback"></label>	
									<textarea name="post" id="post" cols="40" rows="1">Een leuk evenement? vertel hier meer!</textarea>		
									<input type="submit" name="btnCreatePost" id="btnCreatePost" value="Send" />	
								</form>	
							</div>			
						</section>					
				</div>
		</div>

	</div>
	<script src="//ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
	<script src="js/app.js"></script>
</body>
</html>