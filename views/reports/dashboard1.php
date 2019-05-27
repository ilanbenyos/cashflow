 <style type="text/css">
  .grp-color {
      color: #8E8B8B !important;
      /*font-family: "Arial Bold";*/
  }

  .border-frame h4 {
    font-family: arial;
    font-weight: bold;
    font-size: 13px;
    margin: 0;
}
/*.white-bg.grey-color-cox .border-frame.bb {
    background: #e6e6e6;
}*/
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
        <h4 class="grp-color">Bank Comissions Top 6</h4>
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
      <div class="border-frame bb">
        <h4 class="grp-color">Bank Balance</h4>
        <div class="detail-info-box" id="bank-balance"></div>
      </div>
    </div>
     <!-- <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12 less-pad spacebottom1x">
      <div class="border-frame">
        <h4 class="grp-color">Bank Comissions Top 4</h4>
        <div class="detail-info-box" id="bank-comm1"></div>
      </div>
    </div> --> 
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
           /*console.log(minValue1);
		    console.log(maxValue1);
		   console.log(minValue2);
		   console.log(maxValue2);
		   console.log(minValue3);
		   console.log(maxValue3);*/
		   
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
              height: "100%",
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
          "baseFontColor":"#ffffff",
          "baseFontSize":"11",
          "baseFont":"Arial Bold",
         // "toolTipColor":"#ffffff",
          //"baseChartMessageColor":"#0f0f0f",

            },
            "colorRange": {
                      "color": [{
                        "minValue": "0",
                        "maxValue": "10000",
                        "label": "Low",
                        "code": "#526069"
                      }, {
                        "minValue": "10000",
                        "maxValue": "20000",
                        "label": "Avg",
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
  <!-- <script type="text/javascript">
  FusionCharts.ready(function() {
        drawChart5()
      });
  function drawChart5() {
        $.ajax({
        type: 'POST',
        url: "<?php echo base_url('Ajax_Reports/bankComm'); ?>" ,
        success: function (data) {
          
          /*val = [];
          val1 = [];
      val2 = [];
       val3 = [];*/
      
          //console.log(data);
          var jsonData = $.parseJSON(data);
          console.log(jsonData);
          /*for (var i = 0; i < jsonData.length; i++) {
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
         console.log(val1);
         console.log(val2);*/
          const dataSource = {
 "chart": {
           //"bgColor":"#e6e6e6",
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
//console.log(dataSource);
          FusionCharts.ready(function() {
            var myChart = new FusionCharts({
            type: 'pie2d',
            renderAt: 'bank-comm1',
            width: '100%',
            height: '100%',
            dataFormat: 'json',
              dataSource
            }).render();

            myChart.configureLink({
        type: "column2d",
        overlayButton: {
            message: 'Back', // Set the button to show diff messafe
            //bgColor: '#999999',
            borderColor: '#cccccc'
        }
    });
          });
      }
     });
    }
</script>   -->
<script type="text/javascript">
  FusionCharts.ready(function() {
        drawChart5()
      });
  function drawChart5() {
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
          console.log(jsonData);
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
         //console.log('total ' +val3); 
         /*console.log(val1);
         console.log(val2);*/
          const dataSource = {
 "chart": {
                /*"caption": "Quarterly revenue",
                    "subCaption": "Last year",
                    "captionFontSize": "13",
                    "subCaptionFontSize": "12",*/
                    "paletteColors":"526069,c2c81e,20a1a7,90989d,0e1727",
                    "xAxisName": "Quarter (Click to drill down)",
                    "yAxisName": "Revenue (In USD)",
                    //"numberPrefix": "$",
                    "theme": "fusion",
                    "showPercentValues":"0",
                    "baseFontSize":"11",
                    "legendItemFontSize":"13"
            },

                "data": [{
                "label": val[0],
                    "value": val3[0],
                    "link": "newchart-json-q1"
            }, {
                "label": val[1],
                    "value": val3[1],
                    "link": "newchart-json-q2"
            }, {
                "label": val[2],
                    "value": val3[2],
                    "link": "newchart-json-q3"
            }, {
                "label": val[3],
                    "value": val3[3],
                    "link": "newchart-json-q4"
            }, {
                "label": val[4],
                    "value": val3[4],
                    "link": "newchart-json-q5"
            }, {
                "label": val[5],
                    "value": val3[5],
                    "link": "newchart-json-q6"
            }/*, {
                "label": val[6],
                    "value": val3[6],
                    "link": "newchart-json-q7"
            }, {
                "label": val[7],
                    "value": val3[7],
                    "link": "newchart-json-q8"
            }, {
                "label": val[8],
                    "value": val3[8],
                    "link": "newchart-json-q9"
            }, {
                "label": val[9],
                    "value": val3[9],
                    "link": "newchart-json-q10"
            }*/],

                "linkeddata": [{
                "id": "q1",
                    "linkedchart": {
                    "chart": {
                       /* "caption": "Monthly Revenue",
                            "subcaption": "First Quarter",
                            "captionFontSize": "13",
                            "subCaptionFontSize": "12",*/
                            "xAxisName": "Commission",
                            "yAxisName": "Total Commission",
                            //"numberPrefix": "k",
                            "theme": "fusion",
                            "yAxisMaxValue": "250000",
                            "yAxisMinValue": "100000"
                    },
                        "data": [{
                        "label": "IN",
                            "value": val1[0]
                    }, {
                        "label": "OUT",
                            "value": val2[0]
                    }]
                }
            }, {
                "id": "q2",
                    "linkedchart": {
                    "chart": {
                       /* "caption": "Monthly Revenue",
                            "subcaption": "Second Quarter",
                            "captionFontSize": "13",
                            "subCaptionFontSize": "12",*/
                            "xAxisName": "Commission",
                            "yAxisName": "Total Commission",
                            //"numberPrefix": "k",
                            "theme": "fusion",
                            "yAxisMaxValue": "250000",
                            "yAxisMinValue": "100000"
                    },
                        "data": [{
                        "label": "IN",
                            "value": val1[1]
                    }, {
                        "label": "OUT",
                            "value": val2[1]
                    }]
                }
            }, {
                "id": "q3",
                    "linkedchart": {
                    "chart": {
                        /*"caption": "Monthly Revenue",
                            "subcaption": "Third Quarter",*/
                            /*"captionFontSize": "13",
                            "subCaptionFontSize": "12",*/
                            "xAxisName": "Commission",
                            "yAxisName": "Total Commission",
                            //"numberPrefix": "$",
                            "theme": "fusion",
                            "yAxisMaxValue": "250000",
                            "yAxisMinValue": "100000"
                    },
                        "data": [{
                        "label": "IN",
                            "value": val1[2]
                    }, {
                        "label": "OUT",
                            "value": val2[2]
                    }]
                }
            }, {
                "id": "q4",
                    "linkedchart": {
                    "chart": {
                       /* "caption": "Monthly Revenue",
                            "subcaption": "Fourth Quarter",
                            "captionFontSize": "13",
                            "subCaptionFontSize": "12",*/
                            "xAxisName": "Commission",
                            "yAxisName": "Total Commission",
                           //"numberPrefix": "$",
                            "theme": "fusion",
                            "yAxisMaxValue": "250000",
                            "yAxisMinValue": "100000"
                    },
                        "data": [{
                        "label": "IN",
                            "value": val1[3]
                    }, {
                        "label": "OUT",
                            "value": val2[3]
                    }]
                }
            }, {
                "id": "q5",
                    "linkedchart": {
                    "chart": {
                       /* "caption": "Monthly Revenue",
                            "subcaption": "Fourth Quarter",
                            "captionFontSize": "13",
                            "subCaptionFontSize": "12",*/
                            "xAxisName": "Commission",
                            "yAxisName": "Total Commission",
                           //"numberPrefix": "$",
                            "theme": "fusion",
                            "yAxisMaxValue": "250000",
                            "yAxisMinValue": "100000"
                    },
                        "data": [{
                        "label": "IN",
                            "value": val1[4]
                    }, {
                        "label": "OUT",
                            "value": val2[4]
                    }]
                }
            }, {
                "id": "q6",
                    "linkedchart": {
                    "chart": {
                       /* "caption": "Monthly Revenue",
                            "subcaption": "Fourth Quarter",
                            "captionFontSize": "13",
                            "subCaptionFontSize": "12",*/
                            "xAxisName": "Commission",
                            "yAxisName": "Total Commission",
                           //"numberPrefix": "$",
                            "theme": "fusion",
                            "yAxisMaxValue": "250000",
                            "yAxisMinValue": "100000"
                    },
                        "data": [{
                        "label": "IN",
                            "value": val1[5]
                    }, {
                        "label": "OUT",
                            "value": val2[5]
                    }]
                }
            }/*, {
                "id": "q7",
                    "linkedchart": {
                    "chart": {
                      
                            "xAxisName": "Commission",
                            "yAxisName": "Total Commission",
                           //"numberPrefix": "$",
                            "theme": "fusion",
                            "yAxisMaxValue": "250000",
                            "yAxisMinValue": "100000"
                    },
                        "data": [{
                        "label": "IN",
                            "value": val1[6]
                    }, {
                        "label": "OUT",
                            "value": val2[6]
                    }]
                }
            }, {
                "id": "q8",
                    "linkedchart": {
                    "chart": {
                       
                            "xAxisName": "Commission",
                            "yAxisName": "Total Commission",
                           //"numberPrefix": "$",
                            "theme": "fusion",
                            "yAxisMaxValue": "250000",
                            "yAxisMinValue": "100000"
                    },
                        "data": [{
                        "label": "IN",
                            "value": val1[7]
                    }, {
                        "label": "OUT",
                            "value": val2[7]
                    }]
                }
            }, {
                "id": "q9",
                    "linkedchart": {
                    "chart": {
                       
                            "xAxisName": "Commission",
                            "yAxisName": "Total Commission",
                           //"numberPrefix": "$",
                            "theme": "fusion",
                            "yAxisMaxValue": "250000",
                            "yAxisMinValue": "100000"
                    },
                        "data": [{
                        "label": "IN",
                            "value": val1[8]
                    }, {
                        "label": "OUT",
                            "value": val2[8]
                    }]
                }
            }, {
                "id": "q10",
                    "linkedchart": {
                    "chart": {
                       
                            "xAxisName": "Commission",
                            "yAxisName": "Total Commission",
                           //"numberPrefix": "$",
                            "theme": "fusion",
                            "yAxisMaxValue": "250000",
                            "yAxisMinValue": "100000"
                    },
                        "data": [{
                        "label": "IN",
                            "value": val1[9]
                    }, {
                        "label": "OUT",
                            "value": val2[9]
                    }]
                }
            }*/]
};
//console.log(dataSource);
          FusionCharts.ready(function() {
            var myChart = new FusionCharts({
            type: 'pie2d',
            renderAt: 'bank-comm',
            width: '100%',
            height: '100%',
            dataFormat: 'json',
              dataSource
            }).render();

            myChart.configureLink({
        type: "column2d",
        overlayButton: {
            message: 'Back', // Set the button to show diff messafe
            //bgColor: '#999999',
            borderColor: '#cccccc'
        }
    });
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
		 
		 //console.log(newjsonData);
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


/*console.log(uniqueNames);
console.log(jsonData.bankseriesData);
console.log(bankseriesData);*/
         
		 

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
        
         //console.log(jsonData.modaldata);
          const dataSource = {
 "chart": {
           //"bgColor":"#e6e6e6",
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
