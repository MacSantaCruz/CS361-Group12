

    <?php

include "header.php";
include 'connectvars.php';
$conn = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
if (!$conn) {
    die('Could not connect: ' . mysql_error());
}	

// query to select data and mood from mood table
$query = "SELECT date, mood FROM moodData ";

// Get results from query
$result = mysqli_query($conn, $query);
if (!$result) {
    die("Query to retrieve graph data from table failed");
}
// get number of columns in table	
$fields_num = mysqli_num_fields($result);

// create array data
$data = array();

while($row = mysqli_fetch_row($result)) {	
    foreach($row as $cell)		
        array_push($data, $cell);
}

$dataPoints = array_reverse($data);

mysqli_free_result($result);
mysqli_close($conn);
     
     $dataPoints = array(
         array("y" => 25, "label" => "Sunday"),
         array("y" => 15, "label" => "Monday"),
         array("y" => 25, "label" => "Tuesday"),
         array("y" => 5, "label" => "Wednesday"),
         array("y" => 10, "label" => "Thursday"),
         array("y" => 0, "label" => "Friday"),
         array("y" => 20, "label" => "Saturday")
     );
      
     ?>
     <!DOCTYPE HTML>
     <html>
     <head>
     <script>
     window.onload = function () {
      
     var chart = new CanvasJS.Chart("chartContainer", {
         title: {
             text: "Push-ups Over a Week"
         },
         axisY: {
             title: "Number of Push-ups"
         },
         data: [{
             type: "line",
             dataPoints: <?php echo json_encode($dataPoints, JSON_NUMERIC_CHECK); ?>
         }]
     });
     chart.render();
      
     }
     </script>
     </head>
     <body>
     <div id="chartContainer" style="height: 370px; width: 100%;"></div>
     <script src="https://canvasjs.com/assets/script/canvasjs.min.js"></script>
     </body>
     </html>                              
 
 