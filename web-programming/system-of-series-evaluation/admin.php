<!DOCTYPE html>

<?php
    session_start();
        
    if ($_SESSION['logged'] === false) {
	header("Location: ./index.php");
    }
      
?>

<html>
    <head>
        <style>
            table, th, td {
                border: 1px solid black;
                border-collapse: collapse;
            }
            th, td {
                padding: 5px;
                text-align: left;    
            }
        </style>
        <meta charset="UTF-8">
        <title></title>
    </head>
    <body>
        
        Wellcome <?php print_r($_SESSION['login']); ?>
        <a href="./logout.php">Logout</a>
        
        <?php showAllSeries() ?>         
     
        
        
        
       
    </body>
</html>


   <?php
   
        function showAllSeries(){
             include './class/DAO/Connection.class.php';
             include './class/DAO/SerieDAO.class.php';
             
             $serieDAO = new SerieDAO();
             
             echo "<h1>Registered Series</h1>";
             
             echo "<table>" .
                  "<tr>" .
                  "<th>Name</th>" .
                  "<th>Describe</th>" .
                  "<th>total Seasons</th>" .
                  "<th>Rate</th>" .
                  "</tr>";
            
             foreach($serieDAO->getSeries() as $s){  
                 echo "<tr>" .
                      "<td>" . $s['name'] . "</td>" .
                      "<td>" . $s['serieDescribe'] . "</td>" .
                      "<td>" . $s['totalSeasons'] . "</td>" .
                      "<td>" . $s['rate'] . "</td>" .
                      "</tr>";
             }
             
             echo "</table>";
        }
        
    ?>
