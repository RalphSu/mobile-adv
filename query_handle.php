
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
   
    require_once "parsecsv.lib.php";
       
    // if username and password were submitted, check them
     if (isset($_GET['starttime']) && isset($_GET['endtime'])&& isset($_GET['platform'])&& isset($_GET['object'])&& isset($_GET['format']))
     {
     	  $starttime = $_GET['starttime'];
     	  $endtime = $_GET['endtime'];
     	  
        if ($_GET['platform'] == PLATFORM_KINGMOBI)
        {
            if ($_GET['object'] == OBJECT_OFFERS)
            {
            	$object = "offers";
            }     
            if ($_GET['object'] == OBJECT_STATS)
            {
            	$object = stats;
            }
            if ($_GET['format'] == CSV_FORMAT)
            {
            	$format = "csv";
            }     
            if ($_GET['format'] == XML_FORMAT)
            {
            	$format = xml;
            }
            
            if ($_GET['format'] == JSON_FORMAT)
            {
            	$format = json;
            }
             

            $url="http://partner.kingmb.com/$object/$object.$format?api_key=AFF2GuFVQ9micjsTlEWQMr57jKG7yX&start_date=$starttime&end_date=$endtime";
            $origin_csv = file_get_contents($url);
            // print_r($origin_csv);
     
            $origin_csv = iconv("utf-8", "gb2312//IGNORE",$origin_csv); 
            $csv = new parseCSV();
            $csv->delimiter=",";
            $csv->auto($origin_csv);

            convert_csv($csv->titles, $csv->data);

            // print_r($csv->titles);
            // print_r($csv->data[0]);

            $csv->output("kingmobi-converted.csv");
            
            header("Location: index.php"); 
            exit;
        }
        
        if ($_GET['platform'] == PLATFORM_ALMOBI)
        {             
            header("Location: index.php");
            exit;
        }
     } 
     else 
     {
         header("Location: index.php");           
         exit;
     }

/*
        No change fields:
        id name description payout_type protocol expiration_date preview_url currency
    changed fields
        tracking_url -> offer_url ?? (Need confirm by Amos)
        payout -> default_payout
        countries_short -> country_codes (Not in almobi template, but in Hasoffers API)
    Can be deleted fields:
        countries
    Need to Added (Need to confirm from Amos):
        advertiser_id -> ## (Need to check the id of kingmobi)
        status -> pending (Set to the default value.)
        revenue_type -> ?? 
        max_payout -> ?? 
        session_hours -> 720 (set to the default value)
        require_approval -> 0 (set to the default value) 
*/
     
function convert_csv(&$titles, &$data) 
{
    for ($i = 0; $i < count($titles); ++$i) 
    {
        if ($titles[$i] == "tracking_url")
        {
            $titles[$i] = "offer_url";
        }
        if ($titles[$i] == "payout_type")
        {
            $titles[$i] = "default_payout";
        }
        if ($titles[$i] == "countries_short")
        {
            $titles[$i] = "country_codes";
        }
        // no deleted
    }
    $titles[0]="id";

    // print_r($titles);

    array_push($titles, "advertiser_id", "status", "revenue_type", "max_payout", "session_hours", "require_approval");
    for ($i = 0; $i < count($data); ++$i) 
    {
        $row = $data[$i];
        array_push($row, "advertiser_id-default", "pending", "revenue_type-default", "max_payout-default", "720", "0");
    }
}

    ?>






