<?php

include('../assets/public/connect.php');

            $s = $db->prepare("SELECT * FROM wp_dbp_tb_ct WHERE code LIKE '%REG%'");
            $s->execute();
            $s = $s->fetchALL(PDO::FETCH_ASSOC);
            for($i = 0; $i < count($s); $i++){
                echo "<tr id='tr".($i+1)."'>";
                echo "<td>".$s[$i]['nom']."</td>";
                echo "<td>".$s[$i]['hospitalises']."</td>";
                echo "<td>".$s[$i]['gueris']."</td>";
                echo "<td>".$s[$i]['deces']."</td>";
                echo "<td>".$s[$i]['nouvellesHospitalisations']."</td>";
                echo "<td>".$s[$i]['nouvellesReanimations']."</td>";
                echo "<td>".$s[$i]['reanimation']."</td>";
                echo "</tr>";
            }
      
           
           
        
            


          