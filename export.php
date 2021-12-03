<?php require("./global.php");

$table = $_GET['table'];
$format = $_GET['format'];


if($session_role != 'admin'){
?><script>window.location="./"</script><?php     
}


?>
<style>
body {
    font-size: 0.95em;
    font-family: arial;
    color: #212121;
}
th {
    background: #E6E6E6;
    border-bottom: 1px solid #000000;
}
#table-container {
    width: 850px;
    margin: 50px auto;
}
table#tab {
    border-collapse: collapse;
    width: 100%;
}
table#tab th, table#tab td {
    border: 1px solid #E0E0E0;
    padding: 8px 15px;
    text-align: left;
    font-size: 0.95em;
}
.btn {
    padding: 8px 4px 8px 1px;
}
#btnExport {
    padding: 10px 40px;
    background: #499a49;
    border: #499249 1px solid;
    color: #ffffff;
    font-size: 0.9em;
    cursor: pointer;
}
</style>
<h2 style="text-align:center;">Export</h2>

<div id="table-container">
    <div class="btn">
        <!--<a href="./home.php" id="btnExport" class="btn btn-info">Home</a>-->
       
    </div>
    <?php 
    if($table=="orders"){
        $status = $_GET['status'];
        $hatchdate = $_GET['hatchdate'];
        $startdate = $_GET['startdate'];
        $enddate = $_GET['enddate'];
        $sq     = "select * from glassBuy_$table where status like '%$status%' and hatchDate like '%$hatchdate%' and datePlaced between '$startdate' and '$enddate' ";
    }else{
        $sq     = "select * from glassBuy_$table";
    }
    // echo $sq;
    
    $result = mysqli_query($con, $sq);
    $all_property = array();  //declare an array for saving property
    
    //showing property
    echo '<table class="data-table table" id="tab">
            <tr class="data-heading">';  //initialize table tag
    while ($property = mysqli_fetch_field($result)) {
        echo '<th>' . $property->name . '</th>';  //get field name for header
        array_push($all_property, $property->name);  //save those to array
    }
    echo '</tr>'; //end tr tag
    
    //showing all data
    while ($row = mysqli_fetch_array($result)) {
        echo "<tr>";
        foreach ($all_property as $item) {
            echo '<td>' . $row[$item] . '</td>'; //get items using property value
        }
        echo '</tr>';
    }
    echo "</table>";
    
    ?>


    
</div>
<script>
    function exportTableToExcel(tableID, filename = ''){
    var downloadLink;
    var dataType = 'application/vnd.ms-excel';
    var tableSelect = document.getElementById(tableID);
    var tableHTML = tableSelect.outerHTML.replace(/ /g, '%20');
    
    // Specify file name
    filename = filename?filename+'.xls':'excel_data.xls';
    
    // Create download link element
    downloadLink = document.createElement("a");
    
    document.body.appendChild(downloadLink);
    
    if(navigator.msSaveOrOpenBlob){
        var blob = new Blob(['\ufeff', tableHTML], {
            type: dataType
        });
        navigator.msSaveOrOpenBlob( blob, filename);
    }else{
        // Create a link to the file
        downloadLink.href = 'data:' + dataType + ', ' + tableHTML;
    
        // Setting the file name
        downloadLink.download = filename;
        
        //triggering the function
        downloadLink.click();
    }
}

<?php if($format=="excel"){?>
exportTableToExcel('tab', 'export-<?php echo $table?>');
<?php }else if($format=="print"){?>
print();
<?php }else if($format=="pdf"){
    
    
    $urlPing = "https://v2.convertapi.com/convert/web/to/pdf?Secret=$g_convert_api&Url=".urlencode("$g_website"."export.php?table=$table")."&StoreFile=true&ViewportWidth=800&FileName=".urlencode("Export  - $table");
    // echo $urlPing;
    $ch = curl_init();
   
    curl_setopt($ch, CURLOPT_URL, $urlPing);
    curl_setopt($ch, CURLOPT_HEADER, 0);

    curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "GET"); 
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

    curl_setopt($ch, CURLOPT_TIMEOUT, 10);

    $return = curl_exec($ch);
    $return = json_decode($return, true);
    
    
    $url = $return['Files'][0]['Url'];

    ?>
    window.location="<?php echo $url?>"
    <?php 
    
    
}?>
</script>






<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
