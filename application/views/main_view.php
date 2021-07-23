<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">

    <title>Hello, world!</title>
  </head>
  <body>
    <div class="container">
      <div class="row">
        <div class="col-md-12">
            <h2 align="center">Insert data using codeigniter.</h2>
            <!-- <?php echo validation_errors(); ?> -->

            <?php
                if($this->uri->segment(2) == "inserted"){
                  //base_url => http://localhost/ci3_tutorial
                  //redirect url => http://localhost/ci3_tutorial/main/inserted
                     //main - segment(1)
                     //inserted - segment(2)
                    echo '<p class="text-success">Data Inserted</p>';
                }
            ?>


            <form method="post" action="<?= base_url().'main/form_validation' ?>">
              <?php 
                if(isset($fetch_single_data)){
                    foreach($fetch_single_data->result() as $row) {
              ?>
              <div class="form-group">
                <label for="exampleInputEmail1">First</label>
                <input type="text" class="form-control" name="firstname" value="<?php echo $row->firstname; ?>" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter email">
                <span class="text-danger"><?php echo form_error('firstname'); ?></span>
              </div>
              <div class="form-group">
                <label for="exampleInputPassword1">Last Name</label>
                <input type="text" class="form-control" name="lastname" value="<?php echo $row->lastname; ?>" id="exampleInputPassword1" placeholder="Password">
                <span class="text-danger"><?php echo form_error('lastname'); ?></span>
              </div>
              <input type="hidden" class="btn btn-primary" value="<?php echo $row->id ?>"  name="hidden_id" value="submit">
              <input type="submit" class="btn btn-info" name="update" value="Update">
              <?php
                      }
                  }else{

              ?>
               <div class="form-group">
                <label for="exampleInputEmail1">First</label>
                <input type="text" class="form-control" name="firstname" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter email">
                <span class="text-danger"><?php echo form_error('firstname'); ?></span>
              </div>
              <div class="form-group">
                <label for="exampleInputPassword1">Last Name</label>
                <input type="text" class="form-control" name="lastname" id="exampleInputPassword1" placeholder="Password">
                <span class="text-danger"><?php echo form_error('lastname'); ?></span>
              </div>
              <!-- <input type="hidden" class="btn btn-primary" value="<?php echo $row->id ?>"  name="hidden_id" value="submit"> -->
              <input type="submit" class="btn btn-primary" name="insert" value="Submit">
              <?php

                  }

              ?>
             
            </form>
            <br><br>
            
            <h2 align="center">Fetch data using codeigniter</h2><br>
            <div class="table-responsive">
              <table class="table table-bordered">
                <thead>
                  <tr>
                    <th scope="col">No</th>
                    <th scope="col">First</th>
                    <th scope="col">Last</th>
                    <th scope="col">Edit</th>
                    <th scope="col">Delete</th>
                  </tr>
                </thead>
                <tbody>
                  <?php
                      if($fetch_data->num_rows() > 0){
                          $counter = 1;
                          foreach ($fetch_data->result() as $value) {
                            // $c = $counter++;
                    ?>
                          <tr>
                            <th><?php echo $counter++ ?></th>
                            <td><?php echo $value->firstname ?></td>
                            <td><?php echo $value->lastname ?></td>
                            <td><a href="<?php echo base_url().'main/update_data/'.$value->id ?>" class="btn btn-info">Edit</a></td>
                            <td><a href="#" class="deleted_data btn btn-danger" id="<?php echo $value->id ?>">Delete</a></td>
                          </tr>

                      <?php
                          }
                      }else{
                      ?>

                          <tr><td colspan="5" align='center'>No Data Found</td></tr>
                      <?php
                      }
                      ?>

                  <!-- <tr>
                    <th scope="row">1</th>
                    <td>Mark</td>
                    <td>Otto</td>
                    <td>@mdo</td>
                  </tr> -->
                </tbody>
              </table>
            </div>
        </div>
      </div>
    </div>
    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.5.1.min.js" integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>

    <script>
        $(document).ready(function(){
            $('.deleted_data').click(function(){
                var id = $(this).attr("id");
                if(confirm("Are u sure you want to delete")){
                    window.location="<?php echo base_url().'main/deleted_data/' ?>"+id;
                }else{
                    return false;
                }
            });
        });
    </script>
  </body>
</html>