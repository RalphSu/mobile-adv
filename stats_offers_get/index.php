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
    <h1>Almobi network</h1>
    
    <script type="text/javascript" type="text/javascript" src="My97DatePicker/WdatePicker.js"></script>
    <div style="text-align: left">
      <form action="query_handle.php" method="get">
      <br>	
      <p><span class="starttime">start time:</span> 
       <input  name="starttime" id="starttime" type="text"readonly="readonly" 
        onclick="WdatePicker({dateFmt:'yyyy-MM-dd',lang:'zh-cn',maxDate:'%y-%M-%d',minDate:'%y-%M-<%=a%>{%d-2}'}) " >      
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
      <input name="format" type="radio" value="CSV">CSV<input name="format" type="radio" value="JSON">JSON<input name="format" type="radio" value="XML">XML
      </p>
      <br>
      <input type="submit" class="btn" value="Go" name="submit">
      </form>
    </div>
    
  </body>
</html>
