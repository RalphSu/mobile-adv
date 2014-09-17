<!--

index.php

ALMOBI NETWORK

-->

<!DOCTYPE html>

<html>
  <head>
    <meta name="viewport" content="width=device-width">
    <title>almobinetwork offers & stats</title>
    <script type="text/javascript" >
         function sel_offers(obj){
         if(obj.checked){                     

          document.getElementById("chk2").checked =false 
          document.getElementById("starttime").disabled = true
          document.getElementById("endtime").disabled = true

          }
         }
         function sel_stats(obj){
          if(obj.checked){                     
           document.getElementById("chk1").checked=false  
           document.getElementById("starttime").disabled = false
           document.getElementById("endtime").disabled = false
           }
          }       
        

    </script>
  </head>
  <body>
    <h1>ALMOBI NETWORK</h1>
    <script type="text/javascript" src="My97DatePicker/WdatePicker.js"></script>
    <div style="text-align: left">
      <form action="query_handle.php" method="get">
      <br>	
       <span class="object">object:</span>
      <p>offers
      <input type="checkbox" name="checkbox" value="OFFERS" id="chk1" onClick="sel_offers(this)">
      </p>
      <p>stats
      <input type="checkbox" name="checkbox" value="STATS" id="chk2" onClick="sel_stats(this)">
      </p>
      </p>
      
      <p><span class="starttime">start time:</span> 
       <input  name="starttime" id="starttime" type="text"readonly="readonly" 
        onclick="WdatePicker({dateFmt:'yyyy-MM-dd',lang:'zh-cn',maxDate:'%y-%M-%d',minDate:'2013-01-01'}) " >      
      </p>   
      <br>
      <p><span class="endtime">end time:</span> 
      <input  name="endtime" id="endtime" type="text" readonly="readonly"  
       onclick="WdatePicker({dateFmt:'yyyy-MM-dd',lang:'zh-cn',maxDate:'%y-%M-%d',minDate:'#F{$dp.$D(\'starttime\')}'}) " >  
      </p>
      <br>     
      <p><span class="platform">platform:</span> 
      <select name="platform">
        <option value="KINGMOBI">KINGMOBI</option>
        <option value="RAINYDAY">RAINYDAY</option>
        </select>
      </p>
      <br>
      
         
      
      <p><span class="format">Format:</span>  
      <input name="format" type="radio" value="CSV" checked>CSV<input name="format" type="radio" value="JSON" disabled>JSON<input name="format" type="radio" value="XML" disabled>XML
      </p>
      <br>
      <input type="submit" class="btn" value="Go" name="submit">
      </form>
    </div>
    
  </body>
</html>
