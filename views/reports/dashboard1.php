 <style type="text/css">
  .grp-color {
      color: #8E8B8B !important;
      font-family: "Arial Bold";
  }
</style> 
<h1>Bank Dashboard</h1>
<div class="white-bg grey-color-cox">
  <!-- <div class="frame1" style="border: 1px solid #ccc;    padding: 10px 12px;height: 700px;background-color: #e6e6e6 !important"> -->
    <div class="row-flex clearfix grey-bg">
    <div class="col-lg-3 col-md-6 col-sm-6 col-xs-12 less-pad spacebottom1x">
      <div class="border-frame">
        <h4 class="grp-color">Total Bank Income this month</h4>
        <div class="detail-info-box" id="chart-container">
    
    </div>
      </div>
    </div>
    <div class="col-lg-3 col-md-6 col-sm-6 col-xs-12 less-pad spacebottom1x">
      <div class="border-frame small-frame">
        <h4 class="grp-color">Current Bank Balance</h4>
        <div class="detail-info-box">
    
          <div class="curreny-amount "><span id="sum"></span> <span class="currency-icon"></span></div>
        </div>
      </div>
      <div class="border-frame small-frame">
        <h4>&nbsp;</h4>
        <div class="detail-info-box">
          <div class="curreny-amount green"><span id="sum1"></span> <span class="currency-icon"></span></div>
          <p class="no-margin"><strong>From Last Month</strong></p>
        </div>
      </div>
    </div>
    <div class="col-lg-3 col-md-6 col-sm-6 col-xs-12 less-pad spacebottom1x">
      <div class="border-frame">
        <h4 class="grp-color">Total Bank Expenses this month</h4>
        <div class="detail-info-box" id="bank-expenses">
    
    </div>
      </div>
    </div>
    <div class="col-lg-3 col-md-6 col-sm-6 col-xs-12 less-pad spacebottom1x">
      <div class="border-frame">
        <h4 class="grp-color">Bank Comissions Top 4</h4>
        <div class="detail-info-box" id="bank-comm"></div>
      </div>
    </div>
    <div class="clearfix"></div>
    <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12 less-pad spacebottom1x">
      <div class="border-frame">
        <h4 class="grp-color">Bank Income</h4>
        <div class="detail-info-box" id="bank-income"></div>
      </div>
    </div>
    <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12 less-pad spacebottom1x">
      <div class="border-frame">
        <h4 class="grp-color">Bank Balance</h4>
        <div class="detail-info-box" id="bank-balance"></div>
      </div>
    </div>
  </div>
  <!-- </div> -->
  
</div>
</div>
</div>

<style type="text/css">
    g[class^='raphael-group-'][class$='-creditgroup'] {
         display:none !important;
    }
</style>
<!--Total Bank Income This Month start-->
<script type="text/javascript">
      FusionCharts.ready(function() {
        drawChart()
      });
    function drawChart() {
        $.ajax({
        type: 'POST',
        url: "<?php echo base_url('Ajax_Reports/totalBankIncome'); ?>" ,
        success: function (data1) {
          var total = 0;
          val = [];

          var jsonData = $.parseJSON(data1);
          //console.log(jsonData);
          for (var i = 0; i < jsonData.length; i++) {
            
            if(isNaN(jsonData[i].amount)){
                continue;
                 }
                 var values = Math.round(jsonData[i].amount);
                 val.push(values);
                 total += parseInt(Number(jsonData[i].amount).toFixed());



          }
          maxVal = Math.max(...val);
          minVal = Math.min(...val);
           /*console.log(minVal)*/
		   var minValue1 = 0;
		   var maxValue1 = total/3;
		   var minValue2 = maxValue1;
		   var maxValue2 = maxValue1*2;
		   var minValue3 = maxValue2;
		   var maxValue3 = maxValue1*3;
           console.log(minValue1);
		    console.log(maxValue1);
		   console.log(minValue2);
		   console.log(maxValue2);
		   console.log(minValue3);
		   console.log(maxValue3);
		   
          const dataSource = {
                    chart: {
                    //"caption": "Total Bank Income This Month",
                    "origw": "300",
                    "origh": "300",
                    "gaugeStartAngle": "135",
                    "gaugeEndAngle": "45",
                    "gaugeOriginX": "145",
                    "gaugeOriginY": "220",
                    "gaugeOuterRadius": "150",
                    "theme": "fusion",
                    "showValue": "1",
                    "showHoverEffect": "1",
                    "lowerLimit": minVal,
                    "upperLimit": maxVal,
                    "alignCaptionWithCanvas": "1",
                    "captionHorizontalPadding": "2",
                    "captionOnTop": "1",
                    "captionAlignment": "center",
                    "captionFont": "Arial",
                    "captionFontSize": "12",
                    "captionFontColor": "#9e9b9b",
                    "captionFontBold": "1",
                    "numberSuffix": "K"
                    },
                    "colorRange": {
                      "color": [{
                        "minValue": minValue1,
                        "maxValue": maxValue1,
                        "code": "#526069"
                      }, {
                        "minValue": minValue2,
                        "maxValue": maxValue2,
                        "code": "#c2c81e"
                      }, {
                        "minValue": minValue3,
                        "maxValue": maxValue3,
                        "code": "#20a0a7"
                      }]
                    },

                    dials:{
                      "dial": [{
                      "value":total,
                      "tooltext": "Total Bank Income is: $value"
                    }]
                    }
                  };
          FusionCharts.ready(function() {
            //FusionCharts.options.SVGDefinitionURL = 'absolute';
            var myChart = new FusionCharts({
              type: "angulargauge",
              renderAt: "chart-container",
              width: "100%",
              height: "90%",
              dataFormat: "json",
              dataSource
            }).render();
          });
          
      }
     });
    }
</script>
<!--Total Bank Income This Month ends-->

<!--Current Bank Balance starts-->
<script type="text/javascript">
  $(document).ready(function(){
    $.ajax({
    url:"<?php echo base_url('Ajax_Reports/currBankBal'); ?>",
    type:"GET",
    success: function(json) {
      var jsonData = $.parseJSON(json);
      //console.log(jsonData);

      for (var i = 0; i < jsonData.length; i++) {
            
                 /*var monthly = parseInt(Number(jsonData[i].monthly).toFixed(2)) + " €";
                 var lastmonth = parseInt(Number(jsonData[i].lastmonth).toFixed(2)) + " €";*/
                 var monthly = Number(jsonData[i].monthly).toFixed(2) + " €";
                 var lastmonth = Number(jsonData[i].lastmonth).toFixed(2) + " €";
                 var monthlyVal = Number(monthly).toLocaleString('en');
                 var lastmonthVal = Number(lastmonth).toLocaleString('en');
                 $("#sum").html(commaSeparateNumber(monthly));
                 $("#sum1").html(commaSeparateNumber(lastmonth));
          }
    }/*,
    error: function(e) {
       console.log(e);
    }*/
});
  });
</script>
<!--Current Bank Balance ends-->
<!--Total Bank Expenses This Month starts-->
<script type="text/javascript">
  FusionCharts.ready(function() {
        drawChart1()
      });
    function drawChart1() {
        $.ajax({
        type: 'POST',
        url: "<?php echo base_url('Ajax_Reports/totalBankExp'); ?>" ,
        success: function (data) {
          var total = 0;
          val = [];
          //console.log(data);
          var jsonData = $.parseJSON(data);
          
          for (var i = 0; i < jsonData.length; i++) {
             //console.log(jsonData[i].comm);
            
                
                 var values = jsonData[i].comm;
                 val.push(values);
                
                 total += parseInt(Number(jsonData[i].comm).toFixed(2));



          }
          //console.log(total);
          const dataSource = {
            chart: {
              //"caption": "Total Bank Expenses This Month",
             // "subcaption": total + " €",
              "numbersuffix": "€",
              "gaugefillmix": "{dark-20},{light+70},{dark-10}",
              "theme": "fusion",
              "showTickMarks": "1",
              "showTickValues": "1",
              "tickValueStep": "2",
              "tickValueDecimals": "1",
              "forceTickValueDecimals": "1",
              "subcaptionFont": "Arial",
        "subcaptionFontSize": "14",
        "subcaptionFontColor": "#100f0f",
        "subcaptionFontBold": "1",
        "lowerLimit": "0",
          "upperLimit": "50000",
          //"baseFontColor":"#ffffff",
          "baseFontSize":"11",
          "baseFont":"Arial Bold",

            },
            "colorRange": {
                      "color": [{
                        "minValue": "0",
                        "maxValue": "10000",
                        "label": "Below{br}Average",
                        "code": "#526069"
                      }, {
                        "minValue": "10000",
                        "maxValue": "20000",
                        "label": "Average",
                        "code": "#c2c81e"
                      }, {
                        "minValue": "20000",
                        "maxValue": "30000",
                        "label": "High",
                        "code": "#20a0a7"
                      }]
                    },
            pointers: {
              pointer: [
                {
                  value: total
                }
              ]
            }
          };
          FusionCharts.ready(function() {
            var myChart = new FusionCharts({
              type: "hlineargauge",
              renderAt: "bank-expenses",
              width: "100%",
              height: "60%",
              dataFormat: "json",
              dataSource
            }).render();
          });
      }
     });
    }
</script>
<!--Total Bank Expenses This Month ends-->

<!-- Banks Commission top 4 starts -->
<script type="text/javascript">
  FusionCharts.ready(function() {
        drawChart2()
      });
  function drawChart2() {
        $.ajax({
        type: 'POST',
        url: "<?php echo base_url('Ajax_Reports/bankComm'); ?>" ,
        success: function (data) {
          
          val = [];
          val1 = [];
		  val2 = [];
		   val3 = [];
		  
          //console.log(data);
          var jsonData = $.parseJSON(data);
          
          for (var i = 0; i < jsonData.length; i++) {
             //console.log(jsonData[i]);
            
                var obj =  jsonData[i].BankName
                
                val.push(obj);
                var incomm = jsonData[i].incomm
                val1.push(incomm);
				
				var outcomm = jsonData[i].outcomm
                val2.push(outcomm);
				
				var TotalComm = jsonData[i].TotalComm
                val3.push(TotalComm);
                
          }
         console.log(val); 
          const dataSource = {
  chart: {
    //"caption": "Banks Commission Top 4",
    //subcaption: "Last Quarter",
    "showplotborder": "1",
    "plotfillalpha": "60",
    "hoverfillcolor": "#CCCCCC",
    "numberprefix": "$",
    "plottooltext":
      "Bank <b>$label</b> charge $percentValue of the total bank commision",
    "theme": "fusion",
    "showPercentValues": "1",
    "showPercentInTooltip": "0",
    "enableSmartLabels": "1",
    "baseFontSize":"9",
    "highlightParentPieSlices":"1",
    "highlightChildPieSlices":"1",
    //"valueFontSize":"9",
   // "valueFontItalic":"1",
    /*"showlegend": "1",
    "plothighlighteffect": "fadeout|color=#7f7f7f, alpha=60",
    "legendcaption": "Hover over these:",
    "legendcaptionbold": "1",
    "legendcaptionfontsize": "16",*/
  },
  "category": [
    {
      //label: "Products",
      "tooltext": "Please hover over on IN & OUT to see details",
      "color": "#ffffff",
      "value": "300",
      "category": [
        {
          "label": val[0],
          "color": "#016d72",
          "value": val3[0],
          "category": [
            {
              "label": "In",
              "color": "#016d72",
              "value": val1[0]
            },
            {
              "label": "Out",
              "color": "#016d72",
              "value": val2[0]
            }
          ]
        },
        {
          "label": val[1],
          "color": "#69cbcf",
          "value": val3[1],
          "category": [
            {
              "label": "In",
              "color": "#69cbcf",
              "value": val1[1]
            },
            {
              "label": "Out",
              "color": "#69cbcf",
              "value": val2[1]
            }
          ]
        },
        {
          "label": val[2],
          "color": "#90989d",
          "value": val3[2],
          "category": [
            {
              "label": "In",
              "color": "#90989d",
              "value": val1[2]
            },
            {
              "label": "Out",
              "color": "#90989d",
              "value": val2[2]
            }
          ]
        },
        {
          "label": val[3],
          "color": "#526069",
          "value": val3[3],
          "category": [
            {
              "label": "In",
              "color": "#526069",
              "value": val1[3]
            },
            {
              "label": "Out",
              "color": "#526069",
              "value": val2[3]
            }
          ]
        }
      ]
    }
  ]
};
          FusionCharts.ready(function() {
            var myChart = new FusionCharts({
              type: "multilevelpie",
              renderAt: "bank-comm",
              width: "100%",
              height: "100%",
              dataFormat: "json",
              dataSource
            }).render();
          });
      }
     });
    }
</script>
<!-- Banks Commission top 4 ends -->


<!-- Banks Income start -->
<script type="text/javascript">

function unique(arr, prop) {
    return arr.map(function(e) { return e[prop]; }).filter(function(e,i,a){
        return i === a.indexOf(e);
    });
}
  FusionCharts.ready(function() {
        drawChart3()
      });
  function drawChart3() {
        $.ajax({
        type: 'POST',
        url: "<?php echo base_url('Ajax_Reports/bankIncome'); ?>" ,
        success: function (data) {
          //console.log(data);
          var jsonData = $.parseJSON(data);
		 var val1 = [];
		 var newjsonData = jsonData.cat;
		 var BankData = jsonData.bankname;
		 var AllbnkData = jsonData.series;
		 
		 console.log(newjsonData);
		var uniqueNames = [];
		var seriesData = '';
		var bankseriesData = '';
		 uniqueNames+='[';
		$.each( newjsonData, function( key, value ) {
          uniqueNames+= '{ "label": "'+ value + '" },';
          

        });
		uniqueNames+=']';
			//bankseriesData+='[';
		$.each( BankData, function( key, value ) {
			
          bankseriesData+= '{ "seriesname": "'+ value + '","data": [';
		  $.each( AllbnkData, function( skey, svalue ) {
			  
			  if(svalue.BankName == value)
			  {
				  bankseriesData+= '{ "value": "'+ svalue.NetAmount + '"},';
				  
			  }
			  
		  });
		  bankseriesData+= ' ] },';
		 
          

        });
		//bankseriesData+=']';
		
		/*$.each( BankData, function( key, value ) {
          bankseriesData+= '{ "seriesname": "'+ value + '","data:["'+
		  $.each( AllbnkData, function( skey, svalue ) {
			  if(svalue.BankName == value)
			  {
				  
				  
			  }
			  
		  }
		  
		  +'" },';
          

        });
		
		*/


console.log(uniqueNames);
console.log(jsonData.bankseriesData);
console.log(bankseriesData);
         
		 

          const dataSource = {
  chart: {
    //showLabels:"0",
	palettecolors:"526069,c2c81e,20a1a7,90989d,0e1727",
    plottooltext:
      "Total Income of $seriesName bank in $label was <b>$dataValue</b>",
    theme: "fusion",
    drawcrossline: "1"
  },
  categories: [
    {
      category: jsonData.mfinalData
    }
  ],
  dataset: jsonData.bankseriesData
};

FusionCharts.ready(function() {
  var myChart = new FusionCharts({
    type: "stackedcolumn2d",
    renderAt: "bank-income",
    width: "100%",
    height: "100%",
    dataFormat: "json",
    dataSource
  }).render();
});

      }
     });
    }
</script>
<!-- Banks Income end -->




<!-- Bank Balance start -->
<script type="text/javascript">
  FusionCharts.ready(function() {
        drawChartbb()
      });
  function drawChartbb() {
        $.ajax({
        type: 'POST',
        url: "<?php echo base_url('Ajax_Reports/bankBalance'); ?>" ,
        success: function (data) {
          //console.log(data);
          
		  
		  
		  var jsonData = $.parseJSON(data);
        
         console.log(jsonData.modaldata);
          const dataSource = {
 "chart": {
            
            //"xAxisName": "",
           // "yAxisName": "",
            //"numberPrefix": "$",
			
			"showLabels":"0",
            "theme": "fusion"
        },
  "data": jsonData.bankbalance,
  "linkeddata": jsonData.modaldata,
   "trendlines": [{
            "line": [{
                "startvalue": "1000",
            }]
        }]
};

FusionCharts.ready(function() {
  const myChart = new FusionCharts({
    type: "column2d",
    renderAt: "bank-balance",
    width: "100%",
    height: "100%",
    dataFormat: "json",
    dataSource
  }).render();
});

      }
     });
    }
    function commaSeparateNumber(val){
    while (/(\d+)(\d{3})/.test(val.toString())){
      val = val.toString().replace(/(\d+)(\d{3})/, '$1'+','+'$2');
    }
    return val;
  }
</script>
<!-- Banks Income end -->
