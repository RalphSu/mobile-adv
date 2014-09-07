
<!DOCTYPE html>

<html>
  <body>

   <?php
    /**
     * almobi network
     */
    
     define("PLATFORM_KINGMOBI", "KINGMOBI");
     define("PLATFORM_ALMOBI", "ALMOBI");
     define("OBJECT_OFFERS", "OFFERS");
     define("OBJECT_STATS", "STATS");
     define("CSV_FORMAT", "CSV");
     define("XML_FORMAT", "XML");
     define("JSON_FORMAT", "JSON");
   
       
    // if username and password were submitted, check them
     if (isset($_GET['starttime']) && isset($_GET['endtime'])&& isset($_GET['platform'])&& isset($_GET['object'])&& isset($_GET['format']))
     {
     	  $starttime = $_GET['starttime'];
     	  $endtime = $_GET['endtime'];
     	  
        if ($_GET['platform'] == PLATFORM_KINGMOBI)
        {
            if ($_GET['object'] == OBJECT_OFFERS)
            {
            	$object = offers;
            }     
            if ($_GET['object'] == OBJECT_STATS)
            {
            	$object = stats;
            }
            if ($_GET['format'] == CSV_FORMAT)
            {
            	$format = csv;
            }     
            if ($_GET['format'] == XML_FORMAT)
            {
            	$format = xml;
            }
            
            if ($_GET['format'] == JSON_FORMAT)
            {
            	$format = json;
            }
                      
            header("Location: http://partner.kingmb.com/$object/$object.$format?api_key=AFF2GuFVQ9micjsTlEWQMr57jKG7yX&start_date=$starttime&end_date=$endtime");           
           
            exit;
        }
        
        if ($_GET['platform'] == PLATFORM_ALMOBI)
        {             
            header("Location: index.php");           
           
            exit;
        }
     }
     
     header("Location: index.php");           
           
     exit;
     
    ?>


  </body>
</html>





