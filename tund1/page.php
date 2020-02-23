<?php
	$myName = "Karmo Lugima";
	$fullTimeNow = date("d.m.Y H:i:s");
	//<p>Lehe avamise hetkel oli: <strong>31.01.2020 11:32:07</strong></p>
	$timeHTML = "\n <p>Lehe avamise hetkel oli: <strong>" .$fullTimeNow . "</strong></p> \n";
	$hourNow = date("H");
	$partOfDay = "hägune aeg";
	
	if ($hourNow < 10) {
			$partOfDay = "hommik";
	}
	if($hourNow >= 10 and $hourNow < 18) {
		$partOfDay = "aeg aktiivselt tegutseda";
	}
	$partOfDayHTML = "\n <p>Käes on " .$partOfDay . "</p> \n";
	//info semestri kulgemise kohta
	
	
	$semesterStart = new DateTime("2020-1-27");
	$semesterEnd = new DateTime("2020-6-22");
	$semesterDuration = $semesterStart->diff($semesterEnd);
	//echo $semesterDuration;
	//var_dump($semesterDuration);
	$today = new DateTime("now");
	//var_dump ($today);
	$fromSemesterStart = $semesterStart->diff($today);

	//<p>Semester on hoos: <meter min="0" max="" value=""></meter>.</p>
	$semesterProgressHTML = '<p>Semester on hoos: <meter min="0" max="';
	$semesterProgressHTML .= $semesterDuration->format ("%r%a");
	$semesterProgressHTML .= '" value="';
	$semesterProgressHTML .= $fromSemesterStart->format("%r%a");
	$semesterProgressHTML .= '"></meter>.</p>' ."\n";

	//loen ette antud kataloogist pildifailid
	$picsDir = "../../pics/";
	//array_slice eemaldab masiivi algusest etteantud hulga elemente
	$photoTypesAllowed = ["image/jpeg", "image/png"];
	$photoList = [];
	$allFiles = array_slice(scandir($picsDir), 2);
	//var_dump ($allFiles);
	//foreach on masiivi jaoks mõeldud tsükkel
    foreach($allFiles as $file){
        $fileInfo = getimagesize($picsDir .$file);
        if(in_array($fileInfo["mime"], $photoTypesAllowed) == true){
            array_push($photoList, $file);
//	var_dump ($fileInfo);
		}
	}
	$photoCount = count($photoList);
	if ($photoCount > 0) {
    $photoNum = mt_rand(0, $photoCount - 1);
    $randomImageHTML = '<img src="' .$picsDir .$photoList[$photoNum] .'" alt="juhuslik pilt Haapsalust">' ."\n";	
	}
?>

<!DOCTYPE html>
<html lang="et">
<head>
	<meta charset="utf-8">
	<title>Veebirakendused ja nende loomine 2020</title>
</head>
<body>
	<h1><?php echo $myName; ?></h1>
	<p>See leht on valminud õppetöö raames!</p>
	<?php
		echo $timeHTML;
		echo $partOfDayHTML;
		if ($fromSemesterStart->format ("%r%a") < $semesterDuration->format ("%r%a"))
			echo $semesterProgressHTML;
		if ($photoCount > 0) {
			echo $randomImageHTML;
		} else {
			echo "Pilte mida kuvada ei ole";
		}
	?>
</body>
</html>