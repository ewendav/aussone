<?php


session_set_cookie_params([
	'lifetime' => 0, // le cookie expire dés qur le navigateur est fermé 
    'path' => '/',  // le cookie sera envoyé a la racine .?????????
    'domain' => '', // assure que le cookie n'est dipso que sur le domaine courant
    'secure' => true, // Le cookie envoyé que sur co HTTPS
    'httponly' => true, // empeche acces javascript
    'samesite' => 'Strict', //le cookie ne serait envoyé qu'au requète du même site 
]);


session_start();
	function my_autoloader($class) 
	{	$result=substr($class,0,5);
		if (strcmp($result, 'contr') == 0)
		     include_once  'Controleur/'.$class . '.php';
		 else
			if (strcmp($result,"acces") ==0)
				include_once  'Outil/'.$class . '.php';
			else
				if (strcmp($result, 'conte') == 0)
					include_once  'Traitement/classeConteneur/'.$class . '.php';
				else
					if (strcmp($result, "metie") == 0)
						include_once  'Traitement/classeMetier/'.$class . '.php';
						else
						if (strcmp($result, "vueCe") == 0)
						include_once  'Vues/ihm/'.$class . '.php';
						
	}
	spl_autoload_register('my_autoloader');
?>