<?php
$fichserv = "chemin du fichier serverlog.txt.0";
$tabserv=file($fichserv);
for( $i = count($tabserv) ; $i >=0  ; $i-- )
	{
		$valeur=1;
		$test=$tabserv[$i];
		

		if (preg_match("/Build/", $test)) 
			{
			$valeur=0;
			$compteur=$i;			
			}

	}
$version=substr($tabserv[$compteur],55);

$fichier = "/chemin du fichier log.txt.0";
$tabfich=file($fichier);

$client[1]="Pas de joueur ou fichier log absent!";
echo "<center>";
echo'<TABLE BORDER="1">';
echo "<tr><th> Starmade Mconline Version ".$version."</th></tr>";
echo "<tr><th> Joueur(s) en ligne (actualisation 2min)</th></tr>";

for( $i = count($tabfich) ; $i >0  ; $i-- )
	{
		$valeur=1;
		
		$test=$tabfich[$i];
		
		if (preg_match("/AUTO-SAVING/", $test)) 
			{
			$valeur=0;
			$boucle=$i;
			$i=0;
			}
		
	}

if ($valeur==1)
{
	echo "<tr><td>Patientez 2min et actualisé!</td></tr>";
}
else
{
	$end=$boucle-64;
	if ($end<0) {$end=0;}
	$nbclient=1;
	for( $i = $boucle+1 ; $i >$end  ; $i-- )
		{
			$valeur=1;
		
			$test=$tabfich[$i];
		
			if (preg_match("/brace/", $test)) 
				{
				$valeur=0;
				}
			if ($valeur==0)
				{
					$valeur=substr($test,53,-21);
					$client[$nbclient]=$valeur;
					for ($y = 2 ; $y <= count($client) ; $y++ )
					{
						if ($client[$nbclient]==$client[$y-1])
						{
							$i=0;
						}
					}
					echo"<tr><td>";
					echo "<center>";
					echo $client[$nbclient];
					echo "</center>";
					echo "</td></tr>";
					$nbclient=$nbclient+1;
				}
		
		}

	echo "<tr><td><center>".($nbclient-1)."/32 joueurs.</center></td></tr>";
}
echo '<tr><td><center><a href="https://github.com/mcboydesign/Starmade-Script-PHP" target="_blank">Script mcboydesign@2k13</a></center></td></tr>';
echo "</table>";
echo "</center>";

?>
