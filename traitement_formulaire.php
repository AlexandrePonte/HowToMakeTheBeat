<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<title>Contact - Howtomakethebeat</title>
<style type="text/css">
<!--
.Nborddroitegauche {	border-right-width: 1px;
	border-left-width: 1px;
	border-right-style: solid;
	border-left-style: solid;
	border-right-color: #37454E;
	border-left-color: #37454E;
}
.Style2 {color: #CC3300}
.Style3 {color: #339900}
.Style4 {color: #0099CC}
-->
</style>
<link href="feuille.css" rel="stylesheet" type="text/css">
<style type="text/css">
<!--
body {
	background-image: url(images/fond.gif);
}
-->
</style></head>

<body>
<table width="796" height="166" border="0" align="center" cellpadding="0" cellspacing="0">
  <tr>
    <td width="796" class="Nbordtousaufbas"><img src="images/header.jpg" width="796" height="166" border="0" usemap="#Map"></td>
  </tr>
</table>
<map name="Map">
  <area shape="rect" coords="214,123,319,165" href="contact.htm">
  <area shape="rect" coords="110,123,215,165" href="portfolio.htm">
  <area shape="rect" coords="6,123,111,165" href="http://www.unkstud.com">
</map>
<table width="795" height="118" border="0" align="center" cellpadding="0" cellspacing="0">
  <tr>
    <td height="25" colspan="3" class="Nborddroitegauche"><img src="images/contact.jpg" width="796" height="30"></td>
  </tr>
  <tr>
    <td width="5" height="93" bgcolor="#FFFFFF" class="Nbordgauche">&nbsp;</td>
    <td width="786" valign="top" bgcolor="#EBEBEB" class="bordtousaufhaut"><br>
      <?php
	/*
		********************************************************************************************
		CONFIGURATION
		********************************************************************************************
	*/
	// destinataire est votre adresse mail. Pour envoyer à plusieurs à la fois, séparez-les par une virgule
	$destinataire = "darkalex2501@hotmail.com";

	// copie ? (envoie une copie au visiteur)
	$copie = "oui";

	// Messages de confirmation du mail
	$message_envoye = "Votre message a bien été envoyé !";
	$message_non_envoye = "L'envoi du mail a échoué, veuillez réessayer SVP.";

	// Messages d'erreur du formulaire
	$message_erreur_formulaire = "Vous devez d'abord <a href=\"contact.htm\">envoyer le formulaire</a>.";
	$message_formulaire_invalide = "Vérifiez que tous les champs soient bien remplis et que l'email soit sans erreur.";

	/*
		********************************************************************************************
		FIN DE LA CONFIGURATION
		********************************************************************************************
	*/

	// on teste si le formulaire a été soumis
	if (!isset($_POST['envoi']))
	{
		// formulaire non envoyé
		echo '<p>'.$message_erreur_formulaire.'</p>'."\n";
	}
	else
	{
		/*
		 * cette fonction sert à nettoyer et enregistrer un texte
		 */
		function Rec($text)
		{
			$text = trim($text); // delete white spaces after & before text
			if (1 === get_magic_quotes_gpc())
			{
				$stripslashes = create_function('$txt', 'return stripslashes($txt);');
			}
			else
			{
				$stripslashes = create_function('$txt', 'return $txt;');
			}

			// magic quotes ?
			$text = $stripslashes($text);
			$text = htmlspecialchars($text, ENT_QUOTES); // converts to string with " and ' as well
			$text = nl2br($text);
			return $text;
		};

		/*
		 * Cette fonction sert à vérifier la syntaxe d'un email
		 */
		function IsEmail($email)
		{
			$pattern = "^([a-z0-9_]|\\-|\\.)+@(([a-z0-9_]|\\-)+\\.)+[a-z]{2,7}$";
			return (eregi($pattern,$email)) ? true : false;
		};

		// formulaire envoyé, on récupère tous les champs.
		$nom     = (isset($_POST['nom']))     ? Rec($_POST['nom'])     : '';
		$email   = (isset($_POST['email']))   ? Rec($_POST['email'])   : '';
		$objet   = (isset($_POST['objet']))   ? Rec($_POST['objet'])   : '';
		$message = (isset($_POST['message'])) ? Rec($_POST['message']) : '';

		// On va vérifier les variables et l'email ...
		$email = (IsEmail($email)) ? $email : ''; // soit l'email est vide si erroné, soit il vaut l'email entré

		if (($nom != '') && ($email != '') && ($objet != '') && ($message != ''))
		{
			// les 4 variables sont remplies, on génère puis envoie le mail
			$headers = 'From: '.$nom.' <'.$email.'>' . "\r\n";

			// envoyer une copie au visiteur ?
			if ($copie == 'oui')
			{
				$cible = $destinataire.','.$email;
			}
			else
			{
				$cible = $destinataire;
			};

			// Remplacement de certains caractères spéciaux
			$message = str_replace("&#039;","'",$message);
			$message = str_replace("&#8217;","'",$message);
			$message = str_replace("&quot;",'"',$message);
			$message = str_replace('<br>','',$message);
			$message = str_replace('<br />','',$message);
			$message = str_replace("&lt;","<",$message);
			$message = str_replace("&gt;",">",$message);
			$message = str_replace("&amp;","&",$message);

			// Envoi du mail
			if (mail($cible, $objet, $message, $headers))
			{
				echo '<p>'.$message_envoye.'</p>'."\n";
			}
			else
			{
				echo '<p>'.$message_non_envoye.'</p>'."\n";
			};
		}
		else
		{
			// une des 3 variables (ou plus) est vide ...
			echo '<p>'.$message_formulaire_invalide.' <a href="contact.htm">Retour au formulaire</a></p>'."\n";
		};
	}; // fin du if (!isset($_POST['envoi']))
?>
    <br>
    <br>
    <a href="contact.htm">Retour</a></td>
    <td width="5" bgcolor="#FFFFFF" class="Nborddroit">&nbsp;</td>
  </tr>
</table>
<table width="200" border="0" align="center" cellpadding="0" cellspacing="0">
  <tr>
    <td class="Nbordtousaufhaut"><img src="images/copyright.jpg" width="796" height="39"></td>
  </tr>
</table>
</body>
</html>
