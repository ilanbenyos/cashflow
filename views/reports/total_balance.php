<!--<div id="content">
  <div class="container-fluid">-->

<h1>Income Vs Outcome Report</h1>
<div class="white-bg">
  <div class="row"> 
    <!-- <div class="col-md-4 inline-divs text-left">
	      <div class="month-expense-box">
            <div class="form-inline">
              <strong>Select a Currency :</strong>
              <div class="input-group">
                <select class="form-control" id="mySelect_currency" onChange="myFunction_month()">
                  <option  selected value="USD">USD</option>
                  <option  value="EUR">EUR</option>
                </select>
              </div>
            </div>
          </div>
	   </div> -->
    <div class="col-md-12 inline-divs row-flex align">
      <div class="col-lg-6 col-md-8 col-sm-12 col-xs-12 inline-divs text-left no-padding"><strong>This report will show the total income versus the total outcome into a profit or loss result.</strong></div>
      <div class="col-lg-6 col-md-4 col-sm-12 col-xs-12 inline-divs no-padding text-right">
        <div class="month-expense-box">
          <div class="form-inline"> <strong>Select a year :</strong>
            <div class="input-group">
              <select class="form-control" id="mySelect_year" onChange="myFunction_month()">
                <option  value="2018">2018</option>
                <option selected  value="2019">2019</option>
                <option  value="2020">2020</option>
                <option  value="2021">2021</option>
              </select>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="clearfix"></div>
    <div class="padding4x clearfix">
      <div class="col-md-6 col-sm-12 col-xs-12">
        <div id="bar_chart" ></div>
      </div>
      <div class="col-md-6 col-sm-12 col-xs-12">
        <div id="curve_chart"></div>
      </div>
    </div>
  </div>
</div>
</div>
</div>
<script type="text/javascript">
		var d = new Date();
		
		var year = d.getFullYear();
		//var currency='USD';
      google.charts.load('current', {'packages':['bar','corechart']});
	  
      //google.charts.setOnLoadCallback(function(){drawChart(year,currency)});
      google.charts.setOnLoadCallback(function(){drawChart(year)});


    function drawChart(y) {
	
        $.ajax({
        type: 'POST',
		  logScale:true,
		
		  data: {
            'year': y
			//'currency':c
        },
        url: "<?php echo base_url('Ajax_Reports/get_balance'); ?>" ,
        success: function (data1) {
			//alert(data1);
        // Create our data table out of JSON data loaded from server.
        var data = new google.visualization.DataTable();
  
      data.addColumn('string', '');
      data.addColumn('number', 'income');
	    data.addColumn('number', 'outcome');
      var jsonData = $.parseJSON(data1);
      console.log('jsonData ' + data1);
      for (var i = 0; i < jsonData.length; i++) {
        console.log(jsonData.length);
          data.addRow([jsonData[i].month, parseInt(jsonData[i].income),parseInt(jsonData[i].outcome)]);
      }

      if(jsonData == ""){
        var options = {
        height: 500,
         //logScale:true,

     legend: { position: 'top' },
     colors: ['#1F9FA6','#1E7FC9'], 
      hAxis: {
        title: 'months',
        //slantedText:true,  
       // slantedTextAngle:90
      },
       vAxis: {
        title: 'Amount',
        format: 'short'
      }
         
      };
    }else{
      var options = {
        height: 500,
        //logScale:true,

     legend: { position: 'top' },
     colors: ['#1F9FA6','#1E7FC9'], 
      hAxis: {
        title: 'months',
        //slantedText:true,  
       // slantedTextAngle:90
      },
       vAxis: {
        title: 'Amount',
        format: 'short'

      }
      };
    }
      var chart = new google.visualization.ColumnChart(document.getElementById('bar_chart'));
      chart.draw(data, options);
	  
	   var data2 = new google.visualization.DataTable();
      data2.addColumn('string', '');
      data2.addColumn('number', 'profit');
      var jsonData2 = $.parseJSON(data1);
      for (var i = 0; i < jsonData2.length; i++) {
            data2.addRow([jsonData2[i].month, parseInt(jsonData2[i].profit)]);
      }
	  var options = {
		  height: 500,
		  		 //logScale:true,

          curveType: 'function',
          legend: { position: 'bottom' },
		  pointSize: 7,
		  hAxis: {
			  title: 'months',
				},
		  vAxis: {
			    title: 'Balance',
		  }
        };
	  var chart = new google.visualization.LineChart(document.getElementById('curve_chart'));
      chart.draw(data2, options);
       }
     });
    }
  </script> 
<script>
function myFunction_month() {
  //var c = document.getElementById("mySelect_currency").value;
  var y = document.getElementById("mySelect_year").value;
  //drawChart(y,c) ;
  drawChart(y) ;
}
</script>