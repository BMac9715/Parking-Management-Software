

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

          <div class="box">
            <div class="box-header">
              <h3 class="box-title">Add Client</h3>
            </div>
            <form role="form" action="<?php base_url('clients/create') ?>" method="post">
              <div class="box-body">

                <?php echo validation_errors(); ?>
                
                <div class="form-group">
                  <label for="group_name">Client Name</label>
                  <input type="text" class="form-control" id="client_name" name="client_name" placeholder="Client Name">
                </div>
                <div class="form-group">
                  <label for="group_name">Client License Plate</label>
                  <input type="text" class="form-control" id="client_license_plate" name="client_license_plate" placeholder="Client License Plate">
                </div>
                <div class="form-group">
                  <label for="group_name">Email</label>
                  <input type="text" class="form-control" id="client_email" name="client_email" placeholder="Client Email">
                </div>
                <div class="form-group"> <!-- Date input -->
                  <label class="control-label" for="date">Start/Billing Date</label>
                  <input class="form-control" id="billing_date" name="billing_date" placeholder="YYYY/MM/DD" type="text" value="<?php echo date("Y/m/d");?>" readonly/>
                </div>
                <div class="form-group">
                  <label for="group_name">Active</label>
                  <select class="form-control" id="status" name="status">
                    <option value="1">Active</option>
                    <option value="2">Inactive</option>
                  </select>
                </div>
                
              </div>
              <!-- /.box-body -->

              <div class="box-footer">
                <button type="submit" class="btn btn-primary">Save Changes</button>
                <a href="<?php echo base_url('clients/') ?>" class="btn btn-warning">Back</a>
              </div>
            </form>
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
    $("#clientsSideTree").addClass('active');
    $("#createClientsSideTree").addClass('active');
  });
</script>

