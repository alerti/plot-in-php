
<?php
   
    include "/opt/lampp/htdocs/traffic/libchart/libchart/libchart/classes/libchart.php";
 
    $chart = new PieChart( 500, 300 );
 

    $dataSet = new XYDataSet();
    
    $query = "select count from db";
 
    //execute the query
    $result = $conn->query( $query );
    //get number of rows returned
    $num_results = $result->num_rows;
 
    if( $num_results > 0){
    
        while( $row = $result->fetch_assoc() ){
            extract($row);
            $dataSet->addPoint(new Point("{$policeno} { $phone})", $street));
        }
    
        //finalize dataset
        $chart->setDataSet($dataSet);
 
        //set chart title
        $chart->setTitle("our chart");
        
        //render as an image and store under "generated" folder
        $chart->render("generated/1.png");
    
        //pull the generated chart where it was stored
        echo "<img alt='Pie chart'  src='generated/1.png' style='border: 1px solid gray;'/>";
    
    }else{
        echo "No data found";
    }