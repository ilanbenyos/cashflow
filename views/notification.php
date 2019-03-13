  <!-- Page Content  -->
  <div id="content">
    <div class="container-fluid">
      <h1>Notifications</h1>
      <div class="white-bg">
        <div class="row">
          <div class="col-md-12">
            <div class="table-responsive common-table">
              <table class="table table-hover" cellpadding="0" cellspacing="0">
                <thead>
                  <tr>
                    <th>Sr.No</th>
                    <th>Comments</th>
                  </tr>
                </thead>
                <tbody>
                	
                	<?php $i = 1; ?>
                	<?php foreach ($notification as $noti){ ?> 

                  <tr>
                    <td><?php  echo $i; ?></td>
                    <td><?php echo $noti->Comments; ?></td>
                  </tr>
              <?php $i++; 
          		} ?>
              
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>
      <!-- Button trigger modal --> 
      <!-- Modal -->
      
    </div>
  </div>
  <!-- Modal -->
  
