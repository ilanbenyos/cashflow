<!-- <div id="content">
  <div class="container-fluid"> -->

<h1>Total Expenses Per Category Report</h1>
<div class="white-bg">
  <div class="row">
    <div class="col-md-12 inline-divs row-flex align">
      <div class="col-lg-5 col-md-4 col-sm-12 col-xs-12 inline-divs text-left no-padding"><strong>This report will reflect the total amount spent on each category</strong></div>
      <div class="col-lg-7 col-md-8 col-sm-12 col-xs-12 inline-divs no-padding text-right">
        <div class="month-expense-box">
          <strong>Select months :</strong>
          <div class="form-inline">
            <strong>From :</strong>
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
            <strong>To :</strong>
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
            <strong>Select a year :</strong>
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
      <div class="col-md-7 col-sm-12 col-xs-12">
        <div id="bar_chart" ></div>
      </div>
      <div class="col-md-5 col-sm-12 col-xs-12">
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
		function day_of_the_month(d)
		{ 
		  return (d.getMonth() < 10 ? '0' : '') + (d.getMonth()+1);
		}
      google.charts.load('current', {'packages':['bar','corechart']});
	  
      google.charts.setOnLoadCallback(function(){drawChart(month1,month2,year)});


    function drawChart(m1,m2,y) {
  
        $.ajax({
        type: 'POST',
		    data: {
            'month1': m1,
			      'month2': m2,
            'year': y,
        },
        url: "<?php echo base_url('Ajax_Reports/get_expense_by_category'); ?>" ,
        success: function (data1) {
			   //if (data1== '[]' ) {
				   var data = new google.visualization.DataTable();
				  data.addColumn('string', 'Category');
				  data.addColumn('number', 'amount');
				  var jsonData = $.parseJSON(data1);
				  for (var i = 0; i < jsonData.length; i++) {
						data.addRow([jsonData[i].Category, parseInt(jsonData[i].amount)]);
				  }
				  var options = {
					chart: {
					},
					height: 500,
					 legend: { position: 'none' },
					  colors: ['#1F9FA6'], 
					hAxis: {
						  title: 'Categories',
						//  slantedText:true,  
						//  slantedTextAngle:90
						},
						vAxis: {
						  title: 'Amount',
						  format: 'short'
						}
					};
				  var chart = new google.visualization.ColumnChart(document.getElementById('bar_chart'));
				  chart.draw(data, options);
				  var options = {
					height: 500,
					};
				  var chart = new google.visualization.PieChart(document.getElementById('piechart'));
				  chart.draw(data, options);
            /*}else{
		    	var data = new google.visualization.DataTable();
				var jsonData = $.parseJSON(data1);
				 
				 data.addColumn('string', '');
				 var arr = $.map(jsonData[0], function(el) { return el; })
				 var length =arr.length;
				 var keys = [];
				 for(var k in jsonData[0]) keys.push(k);
				 for (var i = 1; i <= length-1;i++) {
						data.addColumn('number', keys[i]);
				  }

		 for (var i = 0; i < jsonData.length; i++) {
				 var myArray= $.map(jsonData[i], function(el) { return el; })
				  for (var j= 1; j <= length-1;j++) {
					 myArray[j]= parseInt(myArray[j]);
				  }
				data.addRow(myArray);
		 }
		  var options = {
			chart: {
		   //   title: 'PSP Performance'
			},
			height: 500,
			 legend: { position: 'top' },
			 colors: ['#1F9FA6', '#1E7FC9', '#2A3241','#C1CA23','#A692BC','#F8B756'],
			hAxis: {
				  title: 'Category Name',
				//  slantedText:true,  
				//  slantedTextAngle:90
				},
				vAxis: {
				  title: 'Amount',
				  format: 'short'

				}
			 
		  };
		  var chart = new google.visualization.ColumnChart(document.getElementById('bar_chart'));
		  chart.draw(data, options);
		  var options = {
			height: 500,
			 colors: ['#1F9FA6', '#1E7FC9', '#08873a','#C1CA23','#A692BC','#F8B756'],
			};
		  var chart = new google.visualization.PieChart(document.getElementById('piechart'));
		  chart.draw(data, options);
		   }*/
		}
     });
    }
  </script> 
<script>
function myFunction_month() {
  var x1 = document.getElementById("mySelect_month_from").value;
  var x2 = document.getElementById("mySelect_month_to").value;
  var y = document.getElementById("mySelect_year").value;
  drawChart(x1,x2,y) ;
}
</script>