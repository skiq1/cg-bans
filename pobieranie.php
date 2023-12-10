<?php

require('simple_html_dom.php');
require_once "connect.php";


$table = array();

    $i = 0;
    $html = file_get_html('http://cubegame.pl/bans');
    foreach($html->find('tr') as $row){
        $nick[$i] = $row->find('td',0)->plaintext;
        $timeStart[$i] = $row->find('td',1)->plaintext;
        $timeEnd[$i] = $row->find('td',2)->plaintext;
        $reason[$i] = $row->find('td',3)->plaintext;
        $admin[$i] = $row->find('td',4)->plaintext;
        
        $nick[$i] = trim(preg_replace('/\s+/', ' ', $nick[$i]));
        $timeStart[$i] = trim(preg_replace('/\s+/', ' ', $timeStart[$i]));
        $timeEnd[$i] = trim(preg_replace('/\s+/', ' ', $timeEnd[$i]));
        $reason[$i] = trim(preg_replace('/\s+/', ' ', $reason[$i]));
        $admin[$i] = trim(preg_replace('/\s+/', ' ', $admin[$i]));

        $admin[$i] = str_replace("JuniorMod2","",$admin[$i]);
        $admin[$i] = str_replace("JuniorMod","",$admin[$i]);
        $admin[$i] = str_replace("Juniormod","",$admin[$i]);
        $admin[$i] = str_replace("Globalmod","",$admin[$i]);
        $admin[$i] = str_replace("Developer","",$admin[$i]);
        $admin[$i] = str_replace("Helper","",$admin[$i]);
        $admin[$i] = str_replace("Headadmin","",$admin[$i]);


        $admin[$i] = str_replace("Rekrutacja","",$admin[$i]);
        $admin[$i] = str_replace("Gracz","",$admin[$i]);
        $admin[$i] = str_replace("Kidmod2","",$admin[$i]);
        $admin[$i] = str_replace("KidMod","",$admin[$i]);
        $admin[$i] = str_replace("Moderator","",$admin[$i]);
        $admin[$i] = str_replace("GlobalMod","",$admin[$i]);
		$admin[$i] = str_replace("HeadAdmin","",$admin[$i]);
        $admin[$i] = str_replace("Admin","",$admin[$i]);
        $admin[$i] = str_replace("VIP","",$admin[$i]);
		if($admin[$i] != "Urzad Ochrony CubeGame"){
			$admin[$i] = substr($admin[$i], 0, -1);
		}
        
        $date = $timeStart[$i];
            
        $one = substr($date, 0, 2);
        $two = substr($date, 3, 2);
        $three = substr($date, 6, 2);
        $four = substr($date, 8, 6);
        
        $timeStart[$i] = '20'.$three.'-'.$two.'-'.$one.' '.$four.':00';
        // echo $timeStart[$i].'<br>';

        $i = $i+1;
    }
    $i=1;

    try{
        $conn = new mysqli($host, $username, $password,$db_name);
		
        
        if ($conn->connect_errno!=0){
            throw new Exception(mysqli_connect_errno());

        }else{
            // $id = $conn -> query("SELECT max(id) FROM bans2023");
            // $id = $id->fetch_assoc();
            // var_dump($id['id']);
            // echo "<br> $id[id]";

            $tab_ban = array(array());
            while($i<=25){
                $rezultat = $conn->query("SELECT nick FROM bans2023 WHERE timeStart='$timeStart[$i]' AND nick='$nick[$i]' AND timeEnd='$timeEnd[$i]' AND reason='$reason[$i]'");

                $ile_uzytkownikow = $rezultat->num_rows;
				
                if($ile_uzytkownikow>0){
                    $i = $i + 1;
                    continue;
                }
				
				
				
                // $ban[$i][0] = 1;
                $tab_ban[$i][1] = $nick[$i];
                $tab_ban[$i][2] = $timeStart[$i];
                $tab_ban[$i][3] = $timeEnd[$i];
                $tab_ban[$i][4] = $reason[$i];
                $tab_ban[$i][5] = $admin[$i];
            

                
                $i = $i + 1;
            }
			

            if(empty($tab_ban) || $tab_ban == null){
				echo "Brak danych do aktualizacji.";
                return 2137;
            }
			
            $i = sizeof($tab_ban)-1;
            echo $i."<br>";
            while($i>0){
				
				if(!isset($tab_ban[$i][1]) || $tab_ban[$i][1] == ""){
					$i = $i - 1;
					continue;
				}
                
                if ($conn->query('INSERT INTO bans2023 (nick, timeStart, timeEnd, reason, admin) Values ("'.$tab_ban[$i][1].'", "'.$tab_ban[$i][2].'", "'.$tab_ban[$i][3].'", "'.$tab_ban[$i][4].'", "'.$tab_ban[$i][5].'")')){
                    print($tab_ban[$i][1]);
                    print(" ");
                    print($tab_ban[$i][2]);
                    print(" ");

                }else{
                    throw new Exception($conn->error);
                }

                echo "Dodano wpis $i <br>";

                $i= $i-1;
            }
        }







    }catch(Exception $e){
        echo 'Error'.$e;
    }

    mysqli_close($conn);
	
	header('Location: https://skiq.pl/bans/');

?>