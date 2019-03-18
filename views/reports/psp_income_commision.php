<!-- Page Content  -->

<div id="content">
  <div class="container-fluid">
    <h1>PSP Income vs Commission</h1>
    <div class="white-bg">
      <div class="row">
	     <!-- <div class="col-md-4 inline-divs text-left">
	      <div class="month-expense-box">
            <div class="form-inline">
              <label>Select a Currency :</label>
              <div class="input-group">
                <select class="form-control" id="mySelect_currency" onChange="myFunction_month()">
                  <option  selected value="USD">USD</option>
                  <option  value="EUR">EUR</option>
                </select>
              </div>
            </div>
          </div>
	   </div> -->
        <div class="col-md-12 inline-divs text-right">
          <div class="month-expense-box">
            <label>Select months :</label>
            <div class="form-inline">
              <label>From :</label>
              <div class="input-group">
                <select class="form-control" id="mySelect_month_from" onChange="myFunction_month()">
                  <option value="<?php echo  date('m') ?>"><?php echo  date('M') ?></option>
                  <option value="01">Jan</option>
                  <option value="02">Feb</option>
                  <option value="03">Mar</option>
                  <option value="04">Apr</option>
                  <option value="05">May</option>
                  <option value="06">Jun</option>
                  <option value="07">Jul</option>
                  <option value="08">Aug</option>
                  <option value="09">Sep</option>
                  <option value="10">Oct</option>
                  <option value="11">Nov</option>
                  <option value="12">Dec</option>
                </select>
              </div>
              <label>To :</label>
              <div class="input-group">
                <select class="form-control" id="mySelect_month_to" onChange="myFunction_month()">
                  <option value="<?php echo  date('m') ?>"><?php echo  date('M') ?></option>
                  <option value="01">Jan</option>
                  <option value="02">Feb</option>
                  <option value="03">Mar</option>
                  <option value="04">Apr</option>
                  <option value="05">May</option>
                  <option value="06">Jun</option>
                  <option value="07">Jul</option>
                  <option value="08">Aug</option>
                  <option value="09">Sep</option>
                  <option value="10">Oct</option>
                  <option value="11">Nov</option>
                  <option value="12">Dec</option>
                </select>
              </div>
            </div>
          </div>
          <div class="month-expense-box">
            <div class="form-inline">
              <label>Select a year :</label>
              <div class="input-group">
                <select class="form-control" id="mySelect_year" onChange="myFunction_month()">
				  <option  value="<?php echo  date('Y') ?>"><?php echo  date('Y') ?></option> 
                  <option  value="2018">2018</option>
                  <option  value="2019">2019</option>
                  <option  value="2020">2020</option>
                  <option  value="2021">2021</option>
                </select>
              </div>
            </div>
          </div>
        </div>
        <div class="clearfix"></div>
        <div class="padding4x clearfix">
          <div class="col-md-7 col-sm-6 col-xs-12">
            <div id="bar_chart"></div>
          </div>
          <div class="col-md-5 col-sm-6 col-xs-12">
            <div id="piechart"></div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<script type="text/javascript">
		var d = new Date();
		var month1 = day_of_the_month(d);
		var month2 = month1;
		var year = d.getFullYear();
		//var currency ='USD';
		function day_of_the_month(d)
		{ 
		  return (d.getMonth() < 10 ? '0' : '') + (d.getMonth()+1);
		}
      google.charts.load('current', {'packages':['bar','corechart']});
	  
      //google.charts.setOnLoadCallback(function(){drawChart(month1,month2,year,currency)});
      google.charts.setOnLoadCallback(function(){drawChart(month1,month2,year)});

    function drawChart(m1,m2,y) {
  
        $.ajax({
        type: 'POST',
		data: {
            'month1': m1,
			'month2': m2,
            'year': y
			//'currency':c

        },
        url: "<?php echo base_url('Ajax_Reports/get_psp_income_vs_commision'); ?>" ,
        success: function (data1) {
         //alert(data1);
        // Create our data table out of JSON data loaded from server.
        var data = new google.visualization.DataTable();
  
  
      data.addColumn('string', 'PSP Name');
      data.addColumn('number', 'commision %');
      var jsonData = $.parseJSON(data1);

      for (var i = 0; i < jsonData.length; i++) {
            data.addRow([jsonData[i].psp, parseInt(jsonData[i].per)]);
      }

	   var options_bar = {
		// width:1000,
         height: 500,
		 colors: ['#1F9FA6'],
		 //logScale:true,
		 bar: {groupWidth: "20%"},
		 legend: { position: 'none' },
			hAxis: {
			  title: 'PSP name',
			  /*slantedText:true,  
			  slantedTextAngle:90*/
			},
			vAxis: {
			  title: 'Commision in (%)',
			  format: 'short'
			}
      };
	  
      var bar_chart = new google.visualization.ColumnChart(document.getElementById('bar_chart'));
      bar_chart.draw(data, options_bar);
	  var options = {
           height: 500,
		   		 colors: ['#1F9FA6', '#1E7FC9', '#C1CA23','#A692BC','#F8B756'],

        };
	  var chart = new google.visualization.PieChart(document.getElementById('piechart'));
      chart.draw(data, options);
       }
     });
    }
  </script> 
<script>
function myFunction_month() {
  var x1 = document.getElementById("mySelect_month_from").value;
  var x2 = document.getElementById("mySelect_month_to").value;
  var y = document.getElementById("mySelect_year").value;
  //var c1 = document.getElementById("mySelect_currency").value;

  //drawChart(x1,x2,y,c1) ;
  drawChart(x1,x2,y) ;
}
</script>