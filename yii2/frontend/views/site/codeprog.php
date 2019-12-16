<?php

/* @var $this yii\web\View */

use yii\helpers\Html;
$this->title = 'Codeprog';
?>

<div class="valtext">
<div class="container">
	<div class="row">
	<div class="col-md-offset-4 col-md-8 mx-auto">
			<div class="form-group"	style="font-size: 20px;">
				<?php
				/** @var \phpMorphy $morphy */
				$morphy = Yii::$app->yiimorphy->morphy;

				echo $_GET['subject'];

				$word = $_GET['subject'];

				$words=preg_split('/[^a-zA-Z?]+/', $word, -1, PREG_SPLIT_NO_EMPTY);

				foreach($words as $i=>$word)
					$words[$i]=iconv('windows-1251', $morphy->getEncoding(), strtoupper($word));

					$awords=$morphy->getPartOfSpeech($words);
						echo "<br>".arr2str($awords);
						
				function arr2str($arr){
					foreach ($arr as $key => $val) {
						if (is_array($val)) {
						   $str .="'" . $key . "' => " . json_encode($val) . "<br>\n";
						
						$val == ["PRO"]  ?  $pro = $key : ''; //местоимения
						$val == ["KON"] ? $kon = $key : ''; //союзы
						$val == ["ADV"] ? $adv = $key : ''; //наречия
						$val == ["SUB","ZUS","ZAL"] || ["SUB","ZAL"] ? $zal = $key : ''; //числительные
						$val == ["VER"] || ["SUB","VER"] ? $ver = $key : ''; //глаголы
						$val == ["ZUS","ART"] ? $art = $key : ''; //артикли
						$val == ["PROBEG"] || ["PROBEG", "PRO"] ? $pronomen = $key : ''; //местоимения
						$val == ["SUB"] ? $sub = $key: ''; //существительные
						$val == ["ADJ"] || ["ADJ","ZUS"] ? $adj = $key: ''; //прилагательное
						$val == ["PRP"] ? $prp = $key: ''; //предлоги
						}
					}
					$ban = $pro. " " . $ver . " " . $adj . " " . $art . " ". $sub;
					
					return $str;
				}				
				?>
			</div>
	</div>
	</div>
</div>
