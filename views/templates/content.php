<!--<div id="content">
    <div class="container-fluid 1a" id="1a">
     </div>
</div> --> 
<?php //print_r( $_SESSION) ?>
<script type="text/javascript">
  var url = "<?php echo base_url ( 'configuration/add_expenses/callCenterExpenses' ); ?>";
  var user = "<?php echo $_SESSION['user_role']; ?>";
  //alert(user);
  $(document).ready(function(){
    //$(".1a").load("<?php //echo base_url ( 'configuration/bank/configuration' ); ?>");
    //$(".1a").load("<?php //echo base_url ( 'configuration/bank/pspIncome' ); ?>");
    $(".users").click(function(){
     // $('.1a').html('<div class="text-center"><i class="fa fa-spinner fa-pulse fa-3x fa-fw"></i></div>');
      $(".1a").load("<?php echo base_url ( 'configuration/users/user' ); ?>");
    })
    $(".banks").click(function(){
      $(".1a").load("<?php echo base_url ( 'configuration/bank/allBanks' ); ?>");
    })
    $(".psp").click(function(){
      $(".1a").load("<?php echo base_url ( 'configuration/payment_processor/psp' ); ?>");
    })
    $(".vendors").click(function(){
      $(".1a").load("<?php echo base_url ( 'configuration/vendors/allVendors' ); ?>");
    })
    $(".expCategories").click(function(){
      $(".1a").load("<?php echo base_url ( 'configuration/expense_category/allExpCategory' ); ?>");
    })
    $(".bankTransType").click(function(){
      $(".1a").load("<?php echo base_url ( 'configuration/bank/allBankTransferType' ); ?>");
    })
    $(".psp-income").click(function(){
      $(".1a").load("<?php echo base_url ( 'psp_income/pspIncome' ); ?>");
    })
    $(".callCenterExp").click(function(){
      $(".1a").load("<?php echo base_url ( 'callcenter/add_expenses/callCenterExpenses' ); ?>");
    })
    $(".expenses").click(function(){
      $(".1a").load("<?php echo base_url ( 'expenses/allExpenses' ); ?>");
    })
    $(".bankTrans").click(function(){
      $(".1a").load("<?php echo base_url ( 'bank_transaction/bankTransaction' ); ?>");
    })
    $(".total-income").click(function(){
      $(".1a").load("<?php echo base_url ( 'reports/psp_income' ); ?>");
    })
    $(".invsout").click(function(){
      $(".1a").load("<?php echo base_url ( 'reports/total_balance' ); ?>");
    })
    $(".venOutcome").click(function(){
      $(".1a").load("<?php echo base_url ( 'reports/vendor_outcome' ); ?>");
    })
    $(".pspInVsOut").click(function(){
      $(".1a").load("<?php echo base_url ( 'reports/psp_commision' ); ?>");
    })
    $(".bankBal").click(function(){
      $(".1a").load("<?php echo base_url ( 'reports/bank_balance' ); ?>");
    })
    $(".totalExp").click(function(){
      $(".1a").load("<?php echo base_url ( 'reports/expense_category' ); ?>");
    })
    $(".callCenterExpRep").click(function(){
      $(".1a").load("<?php echo base_url ( 'reports/callCenterExp' ); ?>");
    })
    
    
    /*$(".callCenter").click(function(){
      
     $(".1a").load("<?php echo base_url ( 'callcenter/add_expenses/callCenterExpenses' ); ?>");
      //$( ".1a" ).load(" .1a" );

    })*/
    
    
    
    
  });
</script>
<div id="content">
    <div class="container-fluid 1a" id="1a">