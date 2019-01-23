</div>
<!-- /#wrapper ends -->

<footer class="main-footer">
  <div class="container-fluid">© 2018 All Rights Reserved.</div>
</footer>
<!----- Footer -----> 

<!------------- Common JS -------------> 
<script src="js/jquery.min.js"></script> 
<script src="js/bootstrap.min.js"></script> 
<script src="js/bootstrap-datepicker.js"></script> 
<script src="js/SidebarNav.min.js"></script> 
<script src="js/common.js"></script> 
<script>
    $.sidebarMenu($('.sidebar-menu'))
</script> 
<script type="text/javascript">
      		function DrawChart(e, chartType, dataSource)
{
  var ctx = e.getContext('2d');
  var chartData = GetChartData(dataSource)

  var myChart = new Chart(ctx, {
    type: chartType,
    data: chartData
  });
}

function GetChartData(type)
{
  // This will come from the database
  var data = {
    labels: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'June', 'July'],
    datasets: [{
      label: 'Expense',
      data: [12, 19, 3, 17, 6, 3, 7],
      backgroundColor: "rgba(0, 102, 204,0.6)"
    }, {
      label: 'Deposit',
      data: [2, 29, 5, 5, 2, 3, 10],
      backgroundColor: "rgba(0, 153, 153,0.6)"
    }]
  }
  
  return(data);
}

var elem = document.getElementById('myChart');
DrawChart(elem, 'line', 'Performance');

      	</script>
</body></html>