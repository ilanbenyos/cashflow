<div id="content">
  <div class="container-fluid">
    <h1>Total Expenses Per Category Report</h1>
    <div class="white-bg">
      <div class="row">
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
                  <option  value="2018">2018</option>
                  <option selected  value="2019">2019</option>
                  <option  value="2020">2020</option>
                  <option  value="2021">2021</option>
                </select>
              </div>
            </div>
          </div>
        </div>
        <div class="clearfix"></div>
        <div class="padding4x clearfix">
          <div class="col-md-7 col-sm-12 col-xs-12">
            
<div id="chart-container"></div>

          </div>
          <div class="col-md-5 col-sm-12 col-xs-12">
            <div id="piechart-container"></div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
 <script src=" https://cdn.fusioncharts.com/fusioncharts/latest/fusioncharts.js"></script>
 <script src=" https://cdn.fusioncharts.com/fusioncharts/latest/themes/fusioncharts.theme.fusion.js"></script>
<script type="text/javascript">
    /*var d = new Date();
    var month1 = day_of_the_month(d);
    var month2 = month1;
    var year = d.getFullYear();
    function day_of_the_month(d)
    { 
      return (d.getMonth() < 10 ? '0' : '') + (d.getMonth()+1);
    }
      //google.charts.load('current', {'packages':['bar','corechart']});
    
      //google.charts.setOnLoadCallback(function(){drawChart(month1,month2,year)});


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
          var jsonData = $.parseJSON(data1);
          for (var i = 0; i < jsonData.length; i++) {
            //data.addRow([jsonData[i].Category, parseInt(jsonData[i].amount)]);
            return [jsonData[i].Category, parseInt(jsonData[i].amount)];
            //console.log([jsonData[i].Category, parseInt(jsonData[i].amount)]);
          }
          /*const dataSource = {
                    chart: {
                    //caption: "Countries With Most Oil Reserves [2017-18]",
                    //subcaption: "In MMbbl = One Million barrels",
                    xaxisname: "Categories",
                    yaxisname: "Amount",
                    //numbersuffix: "K",
                    usePlotGradientColor: "1",
                    plotGradientColor:"#ffffff"
                    //theme: "fusion"
                  },
                  data:[jsonData[i].Category, parseInt(jsonData[i].amount)]
          };*/
   /* }
     });
    }*/
  </script>
<script type="text/javascript">
  /*var test =  drawChart();
  console.log(test);*/
  /*const dataSource = {
  chart: {
    //caption: "Countries With Most Oil Reserves [2017-18]",
    //subcaption: "In MMbbl = One Million barrels",
    xaxisname: "Categories",
    yaxisname: "Amount",
    //numbersuffix: "K",
    usePlotGradientColor: "1",
    plotGradientColor:"#ffffff"
    //theme: "fusion"
  },
  colorrange: {
        "minvalue": "0",
        "startlabel": "Low",
        "endlabel": "High",
        "code": "#FF4411",
        "gradient": "1",
        "color": [{
            "maxvalue": "25",
            "code": "#FFDD44",
            "displayValue": "Median"
        }, {
            "maxvalue": "100",
            "code": "#6baa01"
        }]
    },
  data: [
    {
      label: "Venezuela",
      value: "290"
    },
    {
      label: "Saudi",
      value: "260"
    },
    {
      label: "Canada",
      value: "180"
    },
    {
      label: "Iran",
      value: "140"
    },
    {
      label: "Russia",
      value: "115"
    },
    {
      label: "UAE",
      value: "100"
    },
    {
      label: "US",
      value: "30"
    },
    {
      label: "China",
      value: "30"
    }
  ]
};*/
var d = new Date();
    var month1 = day_of_the_month(d);
    var month2 = month1;
    var year = d.getFullYear();
    function day_of_the_month(d)
    { 
      return (d.getMonth() < 10 ? '0' : '') + (d.getMonth()+1);
    }
      //google.charts.load('current', {'packages':['bar','corechart']});
    
      //google.charts.setOnLoadCallback(function(){drawChart(month1,month2,year)});
      FusionCharts.ready(function() {
        drawChart(month1,month2,year)
      });
      
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
           test1 = [];
          var jsonData = $.parseJSON(data1);
          for (var i = 0; i < jsonData.length; i++) {
            
            var obj = {
              "label":jsonData[i].Category,
              "value":parseInt(jsonData[i].amount),
              "color":jsonData[i].color
            }
            test1.push(obj);
          }
          /*var test2 = [];
          for (var j = 0; j < test1.length; j++) {
            var obj1 = [{
              "label":jsonData[j].Category,
              "value":parseInt(jsonData[j].amount)
            }]
            test2.push(obj1);
          }*/
         // console.log(test2);

          const dataSource = {
                    chart: {
                      xaxisname: "Categories",
                      yaxisname: "Amount",
                      paletteColors: "#3366cc,#dc3912,#ff9900,#109618,#990099",
                      //plotGradientColor:"#ffffff",
                     theme: "fusion"
                    },
                    /*colorrange: {
                      minvalue: "0",
                      startlabel: "Low",
                      endlabel: "High",
                      code: "#FF4411",
                      gradient: "1",
                      color: [{
                          maxvalue: "25",
                          code: "#FFDD44",
                          displayValue: "Median"
                      }, {
                          maxvalue: "100",
                          code: "#6baa01"
                      }]
                  },*/
                    data:test1
                  };
          //console.log(dataSource);
          FusionCharts.ready(function() {
            var myChart = new FusionCharts({
              type: "column3d",
              renderAt: "chart-container",
              /*width: "40%",
              height: "50%",*/
              dataFormat: "json",
              dataSource
            }).render();
            var myChart1 = new FusionCharts({
              type: "pie3d",
              renderAt: "piechart-container",
              /*width: "40%",
              height: "50%",*/
              dataFormat: "json",
              dataSource
            }).render();
          });
          
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

/*function getRandomColor() {
  var letters = '0123456789ABCDEF';
  var color = '#';
  for (var i = 0; i < 6; i++) {
    color += letters[Math.floor(Math.random() * 16)];
  }
  return color;
  
}*/

</script>