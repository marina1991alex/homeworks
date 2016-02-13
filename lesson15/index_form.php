<?php
	ini_set('error_reporting', E_ALL);
	ini_set('display_errors', 1);
	ini_set('display_startup_errors', 1);

	$mail_check = '/^([a-z0-9_-]+\.)*[a-z0-9_-]+[@a-z0-9_-]+(\.[a-z0-9_-]+)*\.[a-z]{2,}$/';

	$errors = array();
	if(!empty($_POST)) {
		if(empty($_POST['name'])) {
			$errors['name'] = 'Поле "Имя" пустое!';
		}

		if(empty($_POST['surname'])) {
			$errors['surname'] = 'Поле "Фамилия" пустое!';
		}

		if(empty($_POST['sex'])) {
			$errors['sex'] = 'Поле "Пол" пустое!';
		}

		if(!isset($_POST['age'])) {
			$errors['age'] = 'Поле "Возраст" пустое!';
		} elseif ($_POST['age'] < 1 || $_POST['age'] > 150) {
			$errors['age_old'] = 'Возраст только от 1 до 150!';
		}

		if(empty($_POST['email'])) {
			$errors['email'] = 'Поле "Email" пустое!';
		} elseif (!preg_match($mail_check, $_POST['email'])){
			$errors['email_not_valid'] = 'Поле "Email" не соответствует стандарту!';
		}
	}

	function transliterate($st) {
	  	$converter = array(
        'а' => 'a',   'б' => 'b',   'в' => 'v',
        'г' => 'g',   'д' => 'd',   'е' => 'e',
        'ё' => 'e',   'ж' => 'zh',  'з' => 'z',
        'и' => 'i',   'й' => 'y',   'к' => 'k',
        'л' => 'l',   'м' => 'm',   'н' => 'n',
        'о' => 'o',   'п' => 'p',   'р' => 'r',
        'с' => 's',   'т' => 't',   'у' => 'u',
        'ф' => 'f',   'х' => 'h',   'ц' => 'c',
        'ч' => 'ch',  'ш' => 'sh',  'щ' => 'sch',
        'ь' => '\'',  'ы' => 'y',   'ъ' => '\'',
        'э' => 'e',   'ю' => 'yu',  'я' => 'ya',
        
        'А' => 'A',   'Б' => 'B',   'В' => 'V',
        'Г' => 'G',   'Д' => 'D',   'Е' => 'E',
        'Ё' => 'E',   'Ж' => 'Zh',  'З' => 'Z',
        'И' => 'I',   'Й' => 'Y',   'К' => 'K',
        'Л' => 'L',   'М' => 'M',   'Н' => 'N',
        'О' => 'O',   'П' => 'P',   'Р' => 'R',
        'С' => 'S',   'Т' => 'T',   'У' => 'U',
        'Ф' => 'F',   'Х' => 'H',   'Ц' => 'C',
        'Ч' => 'Ch',  'Ш' => 'Sh',  'Щ' => 'Sch',
        'Ь' => '\'',  'Ы' => 'Y',   'Ъ' => '\'',
        'Э' => 'E',   'Ю' => 'Yu',  'Я' => 'Ya',
    	);
    	return strtr($st, $converter);
	}
?>


<!DOCTYPE>
<html>
	<head>
	<meta charset="utf-8">
		<title>Form</title>
		<link href="style_form.css" rel="stylesheet">
	</head>
	<body>
		<div id="header">
			<h1>Расскажите немного о себе...</h1>
		</div>
		<div id="content">
			<form action="index_form.php" method="POST">
			<div>
			<input type="hidden" id="token" value="data">
			</div>
				<fieldset>
				<legend>О себе</legend>
					<ul>
						<li>
							<label for="f_id">Имя:</label>
							<input type="text" id="f_id" name="name" value="<?php if (isset($_POST['name'])) echo $_POST['name'] ?>">
							<label class="error">
								<?php if (!empty($_POST) && !empty($errors['name'])) echo $errors['name'] ?>
							</label>
						</li>
						<li>
							<label for="l_id">Фамилия:</label>
							<input type="text" id="l_id" name="surname" value="<?php if (isset($_POST['surname'])) echo $_POST['surname'] ?>">
							<label class="error">
								<?php if (!empty($_POST) && !empty($errors['surname'])) echo $errors['surname'] ?>
							</label>
						</li>
						<li>
							Пол:
							<input type="radio" id="sex_m" name="sex" <?php if (isset($_POST['sex']) && $_POST['sex']=="male") echo "checked";?> value="male">
							<label for="sex_m">мужской</label>
							<input type="radio" id="sex_f" name="sex" <?php if (isset($_POST['sex']) && $_POST['sex']=="female") echo "checked";?> value="female">
							<label for="sex_f">женский</label>
							<label class="error">
								<?php if (!empty($_POST) && !empty($errors['sex'])) echo $errors['sex'] ?>
							</label>
						</li>
						<li>
							<label for="age">Возраст</label>
							<input type="number" id="age" name="age" value="<?php if (isset($_POST['age']) && empty($errors['age_old'])) echo $_POST['age'] ?>">
							лет
							<label class="error">
								<?php 
									if (!empty($_POST) && !empty($errors['age'])) echo $errors['age'];
									if (!empty($_POST) && !empty($errors['age_old'])) echo $errors['age_old'];
								?>
							</label>
						</li>
						<li>
							<label for="email">Email:</label>
							<input type="email" id="email" name="email" value="<?php if (isset($_POST['email'])) echo $_POST['email'] ?>">
							<label class="error">
								<?php 
									if (!empty($_POST) && !empty($errors['email'])) echo $errors['email'];
									if (!empty($_POST) && !empty($errors['email_not_valid'])) echo $errors['email_not_valid'];
								?>
							</label>
						</li>
					</ul>
				</fieldset>
				<div id="footer">
					<input type="submit" value="Отправить" class="send">
				</div>
			</form>
			<?php 
				if (!empty($_POST) && empty($errors)) {
					foreach ($_POST as $key => $value) {
						echo '<label>'. $key.' : '.$value.'</label><br>';
					}
					$filename = transliterate($_POST['name']).'_'.transliterate($_POST['surname']).'.txt';
					$fileContent = '';
					foreach ($_POST as $key => $value) {
						$fileContent = $fileContent.$key.' : '.$value.'; ';
					}
					file_put_contents($filename, $fileContent);
				}
			?>
		</div>
	</body>
</html>