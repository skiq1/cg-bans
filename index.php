<?php

if($_SERVER['HTTP_HOST'] != "skiq.pl"){
    
    $logfile = 'logs/inni.log';

	// header("Location: https://skiq.pl".$_SERVER['REQUEST_URI']);
    echo '<div style="margin-left: auto; margin-right: auto; width: 300px;">';
    echo "\n";
    echo '<img src="img/smutnazaba.jpg"> <br>';
    echo "\n";
    echo '<p style="text-align: center;">smutnazaba.jpg <br>Używasz niepoprawnego adresu strony.</p> ';
    echo "\n";
    echo '<p style="text-align: center;">Kliknij w link poniżej, aby przejść dalej. <br> <a href="https://skiq.pl'.$_SERVER["REQUEST_URI"].'">[skiq.pl'.$_SERVER["REQUEST_URI"].']</a></p>';
    echo "\n";
    echo '</div>';
    echo "\n";
}

    if($_SERVER['HTTP_HOST'] != "skiq.pl")
        exit;


?>
<head>
    <link href="https://fonts.googleapis.com/css?family=Lato:300,400,700,900&amp;subset=latin-ext" rel="stylesheet">
    <link rel="icon" href="img/glowa.png">
    <title>bany kjubgejm </title>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!-- <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous"> -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BmbxuPwQa2lc/FVzBcNJ7UAyJxM6wuqIj61tLrc4wSX0szH/Ev+nYRRuWlolflfl" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

</head>
  <style>
    body{
        background-color: #181818;
        color: #919191;
		font-family: Lato,sans-serif;
	
    }
	
	.content{
		width: 1000px;
		margin-left: auto;
		margin-right: auto;
		
	}

    table{
        margin-left: auto; 
        margin-right:auto; 
        border-collapse: collapse;
    }
    td{
        border-bottom: 1px solid #4b4b4b;
		padding: 3px;
		height: 25px;
		font-size: 15px;

    }
    .administrator{
        min-width: 200px;
		height: 25px;
        float: left;
        margin-bottom: 5px;
    }
    .administracja{
        margin-top: 5px;
	}

	a{
		text-decoration: none;
		color: #919191;
	}
	a:hover{
		color: #848484;
	}

    .administracja a{
        color: #919191;
    }
	
	#ost{
		float: left;
		margin-top:15px; 
		margin-bottom: 5px;
	}

    ::-webkit-scrollbar {
    width: 10px;
    height: 10px;
    }

    /* bg */
    ::-webkit-scrollbar-track {
    background: #181818;; 
    }
    
    ::-webkit-scrollbar-thumb {
    background: #888; 
    }

    ::-webkit-scrollbar-thumb:hover {
    background: #555; 
    }

    </style>
	<div class="container-md mx-0 px-0 px-md-auto mx-md-auto">
    <div class="col-12 col-md-10 mx-0 mx-md-auto pt-1">
        <?php

                $date1 = date_create("2022-12-16");
                $date2 = date_create(date('Y-m-d'));
				
				$date = "2022-12-16";
                echo 'liczy bany na cubegame od  '.timeago($date).' (od 16.12.2022)';				
				
				
			function timeago($date) {
				$timestamp = strtotime($date);	
			   
				$strTime = array("sekund", "minut", "godzin", "dni", "miesiecy", "roku");
				$length = array("60","60","24","30","12","10");

				$currentTime = time();
				if($currentTime >= $timestamp) {
					$diff     = time()- $timestamp;
					for($i = 0; $diff >= $length[$i] && $i < count($length)-1; $i++) {
					$diff = $diff / $length[$i];
					}

					$diff = round($diff);
					return $diff . " " . $strTime[$i];
				}
			}

                
        ?>

        <?php
            require_once "connect.php";
        // error_reporting(0);

            $i=1;
            $r = "";
            try{
                $conn = new mysqli($host, $db_user, $db_password,$db_name);
                
                if ($conn->connect_errno!=0){
                    throw new Exception(mysqli_connect_errno());
                }
                else{

                    //$lista_adm = array("Derpeusz", "xThauron", "Sylvvia", "iSOPL",
					//"SKIDROWNEK", "bobi96", 
					//"Sarciqq");
					

                    if(isset($_GET['all'])){
                        echo '<a href="?" style="float: right;">Kliknij, aby zobaczyc bany z ostatniego tygodnia.</a>';
                    }else{
                        echo '<a href="?all" style="float: right;" title="Moze troche przylagować.">Kliknij, aby zobaczyc wszystkie bany.</a>';
                    }
					
					
                    $lista_adm = mysqli_query($conn, "SELECT admin, count(*) as bany from bans2023 group by admin order by count(*) desc");
                    echo '<div class="administracja mx-auto px-auto pt-4 pt-md-0">';
					echo "\n";
						while($adm = mysqli_fetch_assoc($lista_adm)){

							//$r = $conn->query("SELECT * FROM `bans2023` WHERE admin = '$adm'");
							//if(!$r) throw new Exception($conn->error);
							//$ile_banow = $r->num_rows;
							
							if($adm['bany'] > 0){
																	
								if($adm['admin'] == "Urzad Ochrony CubeGame"){
									$urzad = array("Derpeusz","GeorgerPL", "xBYCZEKx", "_Fabiano", "Cance", "GramPL123", "Zyfrilka", "Wisniowy_", "Pevpe", "KapitanAstek", "_Dam1x_" , "MrKiki", "PanBuleczka[*]");
									
									echo '<div class="administrator col-6 col-md-2" style="min-width: 20%"><a href="http://cubegame.pl/profil/GeorgerPL" target=_blank>'.'<svg size=25 width=25 class="d-inline" style="vertical-align:middle" id="Layer_1" data-name="Layer 1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 122.87 122.88"><defs><style>.cls-1{fill:#ffffff;}.cls-2{fill:#d8453e;}</style></defs><title>no-kids</title><path class="cls-1" d="M59.22,45.36a26.9,26.9,0,0,0,4.18-2.94,13.27,13.27,0,0,0,3-3.57,10,10,0,0,0,.46-.93,9.23,9.23,0,0,0,.53-6,7.15,7.15,0,0,0-3.54-4.49c-.26-.14-.52-.27-.78-.38a5.45,5.45,0,0,0-2-.48,4.62,4.62,0,0,0-1.86.32A6.45,6.45,0,0,0,56,29.44a5,5,0,0,0-.74,1.92,3.52,3.52,0,0,0,.14,1.72,3.22,3.22,0,0,0,1.31,1.56,2.85,2.85,0,0,0,1.58.36,9.14,9.14,0,0,0,3-.67,1.73,1.73,0,0,1,1.18,3.25,12.8,12.8,0,0,1-4.11.87,6.83,6.83,0,0,1-2.46-.39l-3.8-8.3a8.7,8.7,0,0,1,1-2.19A9.84,9.84,0,0,1,58,23.67a8.06,8.06,0,0,1,3.18-.53,8.87,8.87,0,0,1,3.24.75c.39.17.75.35,1.09.53a10.59,10.59,0,0,1,5.22,6.63,12.69,12.69,0,0,1-.69,8.23c-.19.43-.39.84-.61,1.25A16.77,16.77,0,0,1,65.69,45a30.93,30.93,0,0,1-5,3.47l-1.44-3.15ZM47.83,78.63A1.52,1.52,0,0,1,50,76.53c4.15,4.37,8.25,6.27,12.29,6.12a13.12,13.12,0,0,0,3.4-.59L67,84.86a17,17,0,0,1-4.57.83c-4.93.17-9.81-2-14.61-7.06Zm26-1.32,1-.85a1.53,1.53,0,1,1,2.06,2.25q-.86.78-1.71,1.47l-1.32-2.87Zm-23.77-20a4.53,4.53,0,1,1-4.53,4.53,4.53,4.53,0,0,1,4.53-4.53Zm24.5,0A4.53,4.53,0,1,1,70,61.89a4.52,4.52,0,0,1,4.53-4.53Zm.64-13.3a1.75,1.75,0,0,1-.88-2.26,1.66,1.66,0,0,1,2.2-.9,34,34,0,0,1,10.92,7.7,30.46,30.46,0,0,1,6.1,9.46l.11,0a8.83,8.83,0,0,1,8.26,2.54,9.55,9.55,0,0,1,0,13.18,8.91,8.91,0,0,1-6.4,2.74,8,8,0,0,1-1-.06A30.86,30.86,0,0,1,83,92.77c-.52.39-1.06.76-1.6,1.11L80,90.78,81.1,90A27.33,27.33,0,0,0,91.72,74.09a.8.8,0,0,1,0-.15,1.67,1.67,0,0,1,2.09-1.14,5.17,5.17,0,0,0,.84.19,4.76,4.76,0,0,0,.86.07,5.59,5.59,0,0,0,4-1.71,6.06,6.06,0,0,0,0-8.33,5.55,5.55,0,0,0-6.32-1.22h0l-.13.05A1.67,1.67,0,0,1,91,60.79,26.77,26.77,0,0,0,85.07,51a30.93,30.93,0,0,0-9.86-6.95ZM73,97.92a37.17,37.17,0,0,1-11.56,1.82,36.31,36.31,0,0,1-21.59-7A30.86,30.86,0,0,1,28.31,76.43a7.89,7.89,0,0,1-1,.06,8.93,8.93,0,0,1-6.4-2.74,9.55,9.55,0,0,1,0-13.17,8.87,8.87,0,0,1,6.4-2.74,9,9,0,0,1,1.86.2l.11,0a30.34,30.34,0,0,1,6.1-9.46A34.08,34.08,0,0,1,46.34,40.9a1.78,1.78,0,0,1,.49-.13l1.35,2.94a1.7,1.7,0,0,1-.52.35A30.82,30.82,0,0,0,37.82,51a26.7,26.7,0,0,0-5.89,9.69,1.8,1.8,0,0,1-.08.21,1.66,1.66,0,0,1-2.2.89,5.88,5.88,0,0,0-1.12-.37,5.48,5.48,0,0,0-1.18-.12,5.56,5.56,0,0,0-4,1.71,5.94,5.94,0,0,0-1.66,4.16,6,6,0,0,0,1.66,4.17,5.58,5.58,0,0,0,4,1.71,4.94,4.94,0,0,0,.87-.07,4.82,4.82,0,0,0,.83-.19h0l.13,0a1.68,1.68,0,0,1,2,1.31A27.19,27.19,0,0,0,41.81,90a33,33,0,0,0,19.64,6.31A34.15,34.15,0,0,0,71.56,94.8L73,97.92Z"/><path class="cls-2" d="M73.42,1.17A61.25,61.25,0,0,0,18,18h0A61.77,61.77,0,0,0,4.65,37.93,62.09,62.09,0,0,0,1.17,49.44a62,62,0,0,0,0,24,60.88,60.88,0,0,0,9.16,22.12,61.3,61.3,0,0,0,7.5,9.19l.16.15a61.06,61.06,0,0,0,20,13.35h0a61.78,61.78,0,0,0,35.48,3.48,62.09,62.09,0,0,0,11.51-3.48,61.59,61.59,0,0,0,33.29-33.29,62.09,62.09,0,0,0,3.48-11.51,62,62,0,0,0,0-24,61,61,0,0,0-9.16-22.13A61.45,61.45,0,0,0,84.91,4.65h0a61.24,61.24,0,0,0-11.5-3.48ZM85.75,103.34l-40-87.48a3.12,3.12,0,0,1-.3-.73,3.18,3.18,0,0,1,2.23-3.9c.88-.24,1.8-.46,2.75-.67s1.76-.35,2.75-.52h0c1.4-.22,2.77-.39,4.09-.49s2.78-.17,4.17-.17a52.4,52.4,0,0,1,10.16,1A51.35,51.35,0,0,1,90.3,18.13a52.13,52.13,0,0,1,19.21,23.38h0a51.46,51.46,0,0,1,2.95,9.74,52.63,52.63,0,0,1,0,20.32A52.12,52.12,0,0,1,98.22,98.22c-.68.68-1.46,1.41-2.36,2.21s-1.6,1.38-2.42,2c-.49.39-1,.77-1.51,1.14s-.9.64-1.41,1a3.3,3.3,0,0,1-.57.34,3.17,3.17,0,0,1-4.2-1.56ZM37.11,19.51l40,87.49a3.12,3.12,0,0,1,.3.73,3.18,3.18,0,0,1-2.23,3.9c-.86.23-1.79.46-2.78.67-.79.17-1.67.33-2.63.49h-.1c-1.4.23-2.77.39-4.09.5s-2.79.16-4.17.16a52.4,52.4,0,0,1-10.16-1,52,52,0,0,1-18.73-7.75A52.06,52.06,0,0,1,18.16,90.33a51.75,51.75,0,0,1-4.81-9h0a51.46,51.46,0,0,1-2.95-9.74,52.63,52.63,0,0,1,0-20.32,52,52,0,0,1,7.75-18.73,52.38,52.38,0,0,1,6.49-7.91c.68-.68,1.46-1.42,2.35-2.21s1.61-1.38,2.43-2c.49-.38,1-.76,1.51-1.13s.9-.64,1.41-1a3.25,3.25,0,0,1,.57-.33,3.17,3.17,0,0,1,4.2,1.56Z"/></svg>'.$urzad[rand(0, count($urzad) - 1)].': '.$adm['bany']."</a></div>\n";
                                    echo '';
								}else{
									echo '<div class="administrator col-6 col-md-2" style="min-width: 20%"><a href="http://cubegame.pl/profil/'.$adm['admin'].'" target=_blank>'.'<img src="https://kyku.eu/glowa.php?nick='.$adm['admin'].'/25" class="d-md-inline" style="vertical-align:middle">'.$adm['admin'].': '.$adm['bany']."</a></div>\n";
                                    echo '';
								}
								
								
							}
						}
                    echo '</div>';
                    echo '<br>';
                    echo '<br>';
                    echo '<br>';
					

                       
                        //ile czasu
                        $starttime = microtime(true);


                        if(!isset($_GET['all'])){
                            //$rezultat = $conn->query("SELECT * FROM `bans2023`
                            //where `timeStart` between date_sub(CURRENT_DATE(),INTERVAL 1 WEEK) and now()
                            //ORDER BY `timeStart` DESC");
							
							$rezultat = $conn->query("SELECT * FROM `bans2023` 
							WHERE `timeStart` between date_sub(CURRENT_DATE(),INTERVAL 1 WEEK) and now()
							ORDER BY `bans2023`.`id` DESC");
							
							$rezultat_uoc = $conn->query("SELECT * FROM `bans2023` 
							WHERE `timeStart` between date_sub(CURRENT_DATE(),INTERVAL 1 WEEK) and now() and `bans2023`.`admin`='Urzad Ochrony CubeGame'
							ORDER BY `bans2023`.`id` DESC");
                            echo '<div class="col-12" id="ost">Zbanowanych graczy przez ostatnie 7 dni: ',$rezultat->num_rows,' (',$rezultat_uoc->num_rows,' przez AC) <span style="float: right;"><a href="https://skiq.pl/bans/pobieranie.php" style="text-align: right;">Kliknij, aby zaktualizowac bany</a></span></div>';
                        }else{
                            //Do your query and stuff here
                            $rezultat = $conn->query("SELECT * FROM `bans2023` ORDER BY `bans2023`.`id` DESC");


                        }
                        if(!$rezultat) throw new Exception($conn->error);


                        $tabelka = <<<TABLE
                        <div class="col-12" style="overflow-x: scroll;">
                        <table class="mx-0 w-100" style="overflow-x: scroll;" >
                            <tr>
                                <th>l.p</th>
                                <th>Nick</th>
                                <th>Data bana</th>
                                <th>Wygasa</th>
                                <th>Powod</th>
                                <th>Banujacy</th>
                            </tr>
TABLE;
                            echo $tabelka;

                            while($r = mysqli_fetch_array($rezultat)){
                                
                                $date = $r['timeStart'];
                    
                                $one = substr($date, 2, 2);
                                $two = substr($date, 5, 2);
                                $three = substr($date, 8, 2);
                                $four = substr($date, 11, 5);
                        
                                $r['timeStart'] = $three.'.'.$two.'.'.$one.' '.$four;

                            // 2020-09-02 17:50:00

                                echo '<tr>';
                                echo ('<td><a id="'. $r['id'] .'"></a>'. $r['id'] .'</td>');
                                echo '<td><a href="http://cubegame.pl/profil/'.$r['nick'].'" target=_blank>'. $r['nick'] .'</a></td>';
                                echo '<td>'. $r['timeStart'] .'</td>';
                                echo '<td>'. $r['timeEnd'] .'</td>';
                                echo '<td>'. $r["reason"] .'</td>';
                                echo '<td>'. $r["admin"] .'</td>';
                                
                                echo "</tr>\n";
							
                            }
                            $endtime = microtime(true);
                            $duration = round($endtime - $starttime,2);
                            echo '<div class="w-100" style="float: left;">'.$duration.'</div>';
                    }
                    // $conn->close();
                }
            catch(Exception $e){
                echo 'Error'.$e;
            }

            
            mysqli_close($conn);

        ?>
        </table>
        </div>
		<br>
		<?php
			if(!isset($_GET['all'])){
                        echo '<a href="?all" style="margin-left: auto; margin-right: auto;">Kliknij, aby zobaczyc wszystkie bany.</a>';
            }
		?>
		<br><br>
		 
		
        </div>
        </div>

        <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.6.0/dist/umd/popper.min.js" integrity="sha384-KsvD1yqQ1/1+IA7gi3P0tyJcT3vR+NdBTt13hSJ2lnve8agRGXTTyNaBYmCR/Nwi" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/js/bootstrap.min.js" integrity="sha384-nsg8ua9HAw1y0W1btsyWgBklPnCUAFLuTMS2G72MMONqmOymq585AcH49TLBQObG" crossorigin="anonymous"></script>
