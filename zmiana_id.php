<?php
    require_once "connect.php";
    $polaczenie =@new mysqli($host, $username, $password,$db_name);
    
    if ($polaczenie->connect_errno == 0)
    {
        //print 'siema';
        $sql = 'SELECT * FROM bans2023 ORDER BY timeStart DESC';


        $i = 1535;
        
        if ($result = $polaczenie->query($sql))
        {
            $liczba_wierszy = $result->num_rows-1;
            while ($wiersz = mysqli_fetch_array($result)){
                // $date = $wiersz['timeStart'];
                // print $date;
                
                $sql1 = 'UPDATE bans2023 SET id = "'.$i.'" WHERE id = "'.$wiersz["id"].'" AND nick = "'.$wiersz["nick"].'"AND timeStart = "'.$wiersz["timeStart"].'" AND reason = "'.$wiersz["reason"].'" AND timeEnd = "'.$wiersz["timeEnd"].'" 
                AND admin = "'.$wiersz["admin"].'"';
                
                if($polaczenie->query($sql1) == TRUE){
                    print "$i <br>";
                }
                
                $i--;
                
            }
        }
    }else{
		print "dupa";
	}

//     SELECT count(`id`), id, nick FROM `bans` 
// GROUP BY `id`
// HAVING count(`id`) > 1 
    
    
    $result->free_result();
    $polaczenie->close();
?>