<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
			<style type="text/css">
			@font-face
			{
				font-family: "Roadgeek2005SeriesD";
				src: url("http://panic.com/fonts/Roadgeek 2005 Series D/Roadgeek 2005 Series D.otf");
			}
			
			body, *
			{
			}

			.review
			{
				width:378px;
				height: 122px;
				background-color: yellow;
				padding: 2px 2px 2px 2px;
			}

			body,div,dl,dt,dd,ul,ol,li,h1,h2,h3,h4,h5,h6,pre,form,fieldset,input,textarea,p,blockquote,th,td
			{ 
				margin: 0;
				padding: 0;
			}
				
			fieldset,img
			{ 
				border: 0;
			}
			
				
			/* Settin' up the page */
			
			html, body, #main
			{
				overflow: hidden; /* */
			}
			
			body
			{
				color: gray;
				font-family: 'Roadgeek2005SeriesD', sans-serif;
				font-size: 20px;
				line-height: 24px;
			}
			body, html, #main
			{
				/*background: transparent !important;*/
			}
			
			#spacepeopleContainer *
			{
				font-weight: normal;
			}
			
			h1
			{
				font-size: 120px;
				line-height: 120px;
				margin-top: 15px;
				margin-bottom: 28px;
				color: white;
				text-shadow:0px -2px 0px black;
				text-transform: uppercase;
			}
			
			h2
			{
				width: 180px;
				margin: 0px auto;
				padding-top: 20px;
				font-size: 16px;
				line-height: 18px;
				color: #7e7e7e;
				text-transform: uppercase;
			}
		</style>
</head>
<body>

<?php


// Set the POST options.
error_reporting(E_ALL);

function getReviews($pageNumber = 1)
{
	$process = curl_init("https://api.appfigures.com/v2/reviews?client_key=63708bb6778b42adaa477f613070f1ec&product=5999626&page=" . $pageNumber);
	curl_setopt($process, CURLOPT_HEADER, 1);
	curl_setopt($process, CURLOPT_USERPWD, "sean.walmartlabs@gmail.com:nyQ-33Z-PUP-Zqg");
	curl_setopt($process, CURLOPT_TIMEOUT, 30);
	curl_setopt($process, CURLOPT_RETURNTRANSFER, TRUE);
	$return = curl_exec($process);

	$jsonStartMarker = "path=/";
	$data = substr($return, strpos($return, $jsonStartMarker) + strlen($jsonStartMarker));

	$parsedData = json_decode($data, true);

	curl_close($process);

	return $parsedData;
}

$reviewData = getReviews(1);

echo '<div id="main">';
$counter = 0;
foreach ($reviewData["reviews"] as $reviews)
{
	echo '<div class="review" id="'. $counter . '"';
	if ($counter > 0)
	{
		echo ' style="display:none;" ';
	}
	echo ">\n";

	echo $reviews["author"] . " - ";

	if ($reviews["stars"] == 1.0)
	{
		echo "&#9733;&#9734&#9734&#9734&#9734<br/>\n";
	}
	else if ($reviews["stars"] == 2.0)
	{
		echo "&#9733;&#9733;&#9734&#9734&#9734<br/>\n";
	}
	else if ($reviews["stars"] == 3.0)
	{
		echo "&#9733;&#9733;&#9733;&#9734&#9734<br/>\n";
	}
	else if ($reviews["stars"] == 4.0)
	{
		echo "&#9733;&#9733;&#9733;&#9733;&#9734<br/>\n";
	}
	else if ($reviews["stars"] == 5.0)
	{
		echo "&#9733;&#9733;&#9733;&#9733;&#9733;<br/>\n";
	}

	if (strlen($reviews["title"] > 0))
	{
		echo "title: " . $reviews["title"] . "<br/>\n";
	}

	echo $reviews["review"] . "<br/>\n";

	echo "</div>\n\n\n";

	$counter++;
}
echo "</div>";


//5999626

?>
</body>
</html>


