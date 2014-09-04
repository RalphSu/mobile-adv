<!--

index.php

almobi network 


-->

<!DOCTYPE html>

<html>
  <head>
    <meta name="viewport" content="width=device-width">
    <title>almobinetwork offers & stats</title>
  </head>
  <body>
    <IMG src="almobi_logo.jpg" border=0 width="478" height="150">
    <script type="text/javascript" type="text/javascript" src="My97DatePicker/WdatePicker.js"></script>
    <div style="text-align: left">
      <form action="query_handle.php" method="get">
      <br>	
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
        <option value="ALMOBI">ALMOBI</option>
        </select>
      </p>
      <br>
      <p><span class="object">object:</span> 
      <select name="object">
        <option value="OFFERS">OFFERS</option>
        <option value="STATS">STATS</option>
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
