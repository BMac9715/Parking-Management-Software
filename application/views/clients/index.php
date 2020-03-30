

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Manage
        <small>Clients</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Clients</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
      <!-- Small boxes (Stat box) -->
      <div class="row">
        <div class="col-md-12 col-xs-12">

          <?php if($this->session->flashdata('success')): ?>
            <div class="alert alert-success alert-dismissible" role="alert">
              <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
              <?php echo $this->session->flashdata('success'); ?>
            </div>
          <?php elseif($this->session->flashdata('error')): ?>
            <div class="alert alert-error alert-dismissible" role="alert">
              <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
              <?php echo $this->session->flashdata('error'); ?>
            </div>
          <?php endif; ?>

          <?php if(in_array('createClients', $user_permission)): ?>
            <a href="<?php echo base_url('clients/create') ?>" class="btn btn-primary"> <i class="fa fa-plus"></i> Add Client</a>
            <br /> <br />
          <?php endif; ?>
          <?php if(in_array('viewClients', $user_permission)): ?>
            <a href="<?php echo base_url('clients/sendmailall') ?>" class="btn btn-primary"> <i class="fa fa-envelope"></i>   Send Broadcast Mail</a>
            <br /> <br />
          <?php endif; ?>

          <div class="box">
            <div class="box-header">
              <h3 class="box-title">Manage Clients</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <table id="datatables" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th>Client Name</th>
                  <th>Client License Plate</th>
                  <th>Start/Billing Date</th>
                  <th>Email</th>
                  <th>Active</th>
                  <th>Availability</th>
                  <?php if(in_array('viewClients', $user_permission) || in_array('updateClients', $user_permission) || in_array('deleteClients', $user_permission)): ?>
                    <th>Action</th>
                  <?php endif; ?>
                </tr>
                </thead>
                <tbody>
                  <?php foreach ($client_data as $k => $v) {
                    ?>
                    <tr>
                      <td><?php echo $v['client_name'] ?></td>
                      <td><?php echo $v['client_license_plate'] ?></td>
                      <td><?php echo $v['billing_date'] ?></td>
                      <td><?php echo $v['client_email'] ?></td>
                      <td>
                        <?php if($v['active'] == 1) { ?>
                          <span class="label label-success">Active</span>
                        <?php } 
                        else { ?>
                          <span class="label label-warning">Inactive</span>
                        <?php } ?>
                      </td>
                      <td>
                        <?php if($v['availability_status'] == 1) { ?>
                          <span class="label label-success">Yes</span>
                        <?php } 
                        else { ?>
                          <span class="label label-warning">No</span>
                        <?php } ?>
                      </td>
                      <?php if(in_array('updateClients', $user_permission) || in_array('deleteClients', $user_permission)): ?>
                      <td>
                        <?php if(in_array('viewClients', $user_permission)): ?>
                          <a href="<?php echo base_url('parking/index/'.$v['client_license_plate']) ?>" class="btn btn-default"><i class="fa fa-car"></i></a>
                          <a href="<?php echo base_url('clients/sendmail/'.$v['client_email']) ?>" class="btn btn-default"><i class="fa fa-envelope"></i></a>
                        <?php endif; ?>
                        <?php if(in_array('updateClients', $user_permission)): ?>
                          <a href="<?php echo base_url('clients/edit/'.$v['id']) ?>" class="btn btn-default"><i class="fa fa-pencil"></i></a>
                        <?php endif; ?>
                        <?php if(in_array('deleteClients', $user_permission)): ?>
                          <a href="<?php echo base_url('clients/delete/'.$v['id']) ?>" class="btn btn-default"><i class="fa fa-trash"></i></a>
                        <?php endif; ?>
                      </td>
                      <?php endif; ?>
                    </tr>
                    <?php
                  } ?>
                </tbody>
              </table>
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
        </div>
        <!-- col-md-12 -->
      </div>
      <!-- /.row -->
      

    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

  <script type="text/javascript">
    $(document).ready(function() {
      $('#datatables').DataTable();

      $("#clientsSideTree").addClass('active');
      $("#manageClientsSideTree").addClass('active');
    });
  </script>
