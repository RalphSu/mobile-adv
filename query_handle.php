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
            $csv->parse($origin_csv);

            convert_csv($csv);

            $content = $csv->output("kingmb-convert.csv");

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
     
function convert_csv(&$csv)
{
    $titles = $csv->titles;
    $data = $csv->data;
    $name_map = array();
    $name_map["tracking_url"] = "offer_url";
    $name_map["payout"] = "max_payout";
    $name_map["countries_short"] = "country_codes";
    $name_map[$titles[0]] = "id";

    for ($i = 0; $i < count($titles); ++$i)
    {
        if (array_key_exists($titles[$i], $name_map)) {
            $titles[$i] = $name_map[$titles[$i]];
        }
    }
    // print_r($titles);
    array_push($titles, "advertiser_id", "status", "revenue_type", "default_payout", "conversion_cap", "session_hours", "require_approval");
    //print_r($titles);
    $csv->titles= $titles;

    $newData = array();
    for ($i = 0; $i < count($data); ++$i) 
    {
        $row = $data[$i];

        foreach ($name_map as $oldKey=> $newKey) {
            $row[$newKey] = $row[$oldKey];
        }

        // add additional row
        $row["advertiser_id"] = "advertiser_id-default";
        $row["status"] = "pending";
        $row["revenue_type"] = "cpa_flat";
        $row["default_payout"] = "0.86";// TODO
        $row["conversion_cap"] = "5";
        $row["session_hours"] = "720";
        $row["require_approval"] = "1";

        // foreach ($row as $key => $value) {
        //     print_r("<br/>key:"); print_r($key); print_r("<br/>value:"); print_r($value);
        // }
        array_push($newData, $row);
        // print_r("<br/><br/>");
        // print_r("<!--");
        // print_r($row["description"]);
        // print_r("-->");
        // print_r(array_keys($row));
    }
    // print_r("<!--");
    // print_r($newData); 
    $csv->data = $newData;
    // print_r($csv->data);
}
?>


