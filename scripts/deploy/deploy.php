<?php
    $applicationTypes = ['app', 'api'];

    $applicationType = $_GET['applicationType'];
    
    if(!in_array($applicationType, $applicationTypes))
        die('Invalid application type.');
    
    $commands = array(
        'echo $PWD',
        'whoami',
        'git pull',
        'git status',
    );
    
    if($applicationType == 'api'){
	    $commands[] = 'composer install';
    }
    
$output = '';
foreach ($commands AS $command) {

    $cd = "cd /var/www/$applicationType && ";
	$tmp = shell_exec($cd . $command);

	$output .= <<<HTML
<span style="color: #6BE234;">$</span> <span style="color: #729FCF;">{$command}</span>
<br />
HTML;
	$output .= htmlentities(trim($tmp)) . "<br /><br />";
}
?>

<!DOCTYPE HTML>
<html lang="en-US">
<head>
    <meta charset="UTF-8">
    <title>GIT DEPLOYMENT SCRIPT</title>
</head>
<body style="background-color: #000000; color: #FFFFFF; font-weight: bold; padding: 0 10px;">
<pre>
<?php echo $output; ?>
</pre>
</body>
</html>