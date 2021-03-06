@extends('layouts.adminwp')
@section('content')



<!-- This script is used to allow only number in the bill amount field -->
<script>
  function isNumberKey(evt)
    {
        var charCode = (evt.which) ? evt.which : evt.keyCode;
        if (charCode != 46 && charCode > 31 
        && (charCode < 48 || charCode > 57))
        return false;
        return true;
    }  
</script>

<script>
  $(function()
{
    $("#myform").validate(
      {
        rules: 
        {
          item: 
          {
            required: true
          }
        }
      });	
});
</script>



<script>
  // Example starter JavaScript for disabling form submissions if there are invalid fields
(function() {
  'use strict';
  window.addEventListener('load', function() {
    // Fetch all the forms we want to apply custom Bootstrap validation styles to
    var forms = document.getElementsByClassName('needs-validation');
    // Loop over them and prevent submission
    var validation = Array.prototype.filter.call(forms, function(form) {
      form.addEventListener('submit', function(event) {
        if (form.checkValidity() === false) {
          event.preventDefault();
          event.stopPropagation();
        }
        form.classList.add('was-validated');
      }, false);
    });
  }, false);
})();
</script>




<!-- Content Header (Page header) -->
<div class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1 class="m-0 text-dark">Work Permit Form - Edit</h1>
      </div><!-- /.col -->
      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
          <li class="breadcrumb-item"><a href="{{route('mallwp')}}">Dashboard</a></li>

          <li class="breadcrumb-item"><a href="{{route('mall.workpermit.index')}}">Pending</a></li>


        </ol>
      </div><!-- /.col -->
    </div><!-- /.row -->
  </div><!-- /.container-fluid -->
</div>
<!-- /.content-header -->

<section class="content">
  <div class="container-fluid">


    <form class="needs-validation" novalidate method="POST"
      action="{{ route('mall.workpermit.update', $workpermit->id) }}">
      @method('PUT')
      <input type="hidden" name="_token" value="{{ csrf_token() }}">



      <div class="form-group">
        <div class="row">
          <label class="col-lg-1" for="">Applicant</label>
          <div class="col-lg-5">
            <input type="text" class="form-control" id="validationCustom02" name="wp_applicant"
              value="{{ $workpermit->wp_applicant}}" placeholder="Enter name of applicant" tabindex="1" required>
          </div>
          <label class="col-lg-1" for="">Designation</label>
          <div class="col-lg-5">
            <input type="text" class="form-control" id="validationCustom02" name="wp_designation"
              value="{{ $workpermit->wp_designation}}" placeholder="Enter designation name" tabindex="2" required>
          </div>
        </div>
      </div>

      <div class="form-group">
        <div class="row">
          <label class="col-lg-1" for="">Mobile</label>
          <div class="col-lg-5">
            <input type="text" class="form-control" id="validationCustom02" name="wp_mobile"
              value="{{ $workpermit->wp_mobile}}" placeholder="Enter mobile number" tabindex="3" required>

          </div>
          <label class="col-lg-1" for="">Email</label>
          <div class="col-lg-5">
            <input type="email" class="form-control" id="validationCustom02" name="wp_email"
              value="{{ $workpermit->wp_email}}" placeholder="Enter email address" tabindex="4" required>


          </div>
        </div>
      </div>

      <div class="form-group">
        <div class="row">
          <label class="col-lg-1" for="">Company</label>
          <div class="col-lg-5">



            <input type="text" class="form-control" id="validationCustom02" name="wp_comp_name"
              value="{{ $workpermit->wp_comp_name}}" placeholder="Enter company name" readonly>
          </div>
          <label class="col-lg-1" for="">Brand</label>
          <div class="col-lg-5">

            <input type="text" class="form-control" id="validationCustom02" name="wp_brand_name"
              value="{{ $workpermit->wp_brand_name}}" placeholder="Enter brand name" readonly>


          </div>
        </div>
      </div>


      <div class="form-group">
        <div class="row">
          <label class="col-lg-1" for="">Manager</label>
          <div class="col-lg-5">
            <input type="text" class="form-control" id="validationCustom02" name="wp_manager"
              value="{{ $workpermit->wp_manager}}" placeholder="Enter manager name" readonly>
          </div>
          <label class="col-lg-1" for="">Contact</label>
          <div class="col-lg-5">



            <input type="text" class="form-control" id="validationCustom02" name="wp_manager"
              value="{{ $workpermit->wp_manager_contact}}" placeholder="Enter manager contact" readonly>


          </div>
        </div>
      </div>

      <p class="bg-warning text-white"><strong>Work Duration</strong>
      </p>

      <div class="form-group">
        <div class="row">
          <label class="col-lg-1" for="">Date From</label>
          <div class="col-lg-2">


            <input class="form-control datepicker" id="datepicker" name="wp_from_date" placeholder="dd-mm-yyyy"
              value="{{ date('d-m-Y', strtotime($workpermit->wp_from_date)) }}" readonly required>

            <script>
              var date = new Date();
              

              
              
              var hour = date.getHours();
              
              if(parseInt(hour) > 15) {
                minDate = 1;

                
            var today = new Date(date.getFullYear(), date.getMonth(), date.getDate());
              $('#datepicker').datepicker({
                 format: 'dd-mm-yyyy',
                   uiLibrary: 'bootstrap4',
                   
                   minDate:new Date(),
      disabledDates: [new Date()]


               });       

                }
                else
                {
                  
            var today = new Date(date.getFullYear(), date.getMonth(), date.getDate());
              $('#datepicker').datepicker({
                 format: 'dd-mm-yyyy',
                   uiLibrary: 'bootstrap4',
                   minDate: today,

                  });  
                }

            </script>


          </div>
          <label class="col-lg-1" for="">Date To</label>
          <div class="col-lg-2">


            <input class="form-control datepicker" id="datepicker1" name="wp_to_date"
              value="{{ date('d-m-Y', strtotime($workpermit->wp_to_date)) }}" placeholder="dd-mm-yyyy" readonly
              required>



            <script>
              var date1 = new Date();

              

var today1 = new Date(date.getFullYear(), date.getMonth(), date.getDate());
  $('#datepicker1').datepicker({
     format: 'dd-mm-yyyy',
       uiLibrary: 'bootstrap4',
       minDate: today1  
   });
            </script>


          </div>

          <label class="col-lg-1" for="">Time From</label>
          <div class="col-lg-2">

            <select class="custom-select" name="wp_from_time" id="wp_from_time" tabindex="9"
              value="{{ $workpermit->wp_from_time}}" required>

              <option value="{{ $workpermit->wp_from_time}}">{{ $workpermit->wp_from_time}}</option>
              <option value="11:00 PM">11:00 PM</option>
              <option value="12:00 PM">12:00 PM</option>
              <option value="01:00 AM">01:00 AM</option>
              <option value="02:00 AM">02:00 AM</option>
              <option value="03:00 AM">03:00 AM</option>
              <option value="04:00 AM">04:00 AM</option>
              <option value="05:00 AM">05:00 AM</option>
              <option value="06:00 AM">06:00 AM</option>


            </select>




          </div>



          <label class="col-lg-1" for="">Time To</label>
          <div class="col-lg-2">


            <select class="custom-select" name="wp_to_time" id="wp_to_time" tabindex="9"
              value="{{ $workpermit->wp_to_time}}" required>

              <option value="{{ $workpermit->wp_to_time}}">{{ $workpermit->wp_to_time}}</option>

              <option value="12:00 PM">12:00 PM</option>
              <option value="01:00 AM">01:00 AM</option>
              <option value="02:00 AM">02:00 AM</option>
              <option value="03:00 AM">03:00 AM</option>
              <option value="04:00 AM">04:00 AM</option>
              <option value="05:00 AM">05:00 AM</option>
              <option value="06:00 AM">06:00 AM</option>
              <option value="07:00 AM">07:00 AM</option>

            </select>



          </div>
        </div>
      </div>

      <div class="form-group">
        <p class="bg-warning text-white"><strong>Work Category</strong>
        </p>
        <div class="col-sm-12">
          <div class="d-flex mb-3">


            <div class="p-2 flex-fill"><input type="checkbox" value="Carpentry" name="wp_category[]">Carpentry</div>
            <div class="p-2 flex-fill "><input type="checkbox" value="Fit-Out" name="wp_category[]">Fit-Out</div>
            <div class="p-2 flex-fill "><input type="checkbox" value="Painting" name="wp_category[]">Painting</div>
            <div class="p-2 flex-fill "><input type="checkbox" value="Promotion" name="wp_category[]">Promotion</div>
            <div class="p-2 flex-fill "><input type="checkbox" value="Plumbing" name="wp_category[]">Plumbing</div>
            <div class="p-2 flex-fill "><input type="checkbox" value="Hot Work" name="wp_category[]">Hot Work</div>
            <div class="p-2 flex-fill "><input type="checkbox" value="Electrical / HVAC" name="wp_category[]">Electrical
              /
              HVAC</div>
            <div class="p-2 flex-fill "><input type="checkbox" value="Stock Taking" name="wp_category[]">Stock Taking
            </div>
            <div class="p-2 flex-fill "><input type="checkbox" value="Others" name="wp_category[]">Others</div>
          </div>
        </div>
      </div>

      <div class="form-group">
        <p class="bg-warning text-white"><strong>Description of Work</strong>

          <input type="text" class="form-control" id="wp_description" name="wp_description"
            value="{{ $workpermit->wp_description}}" placeholder="Enter work description in detail">



        </p>
      </div>

      <div class="form-group">
        <p class="bg-warning text-white"><strong>Contractor Details </strong>
        </p>

        <div class="row">

          <label class="col-lg-1" for="">Company</label>
          <div class="col-lg-2">
            <input type="text" class="form-control" id="validationCustom02" name="wp_cont_comp"
              value="{{ $workpermit->wp_cont_comp}}" placeholder="Enter company name">
          </div>
          <label class="col-lg-1" for="">Person Name</label>
          <div class="col-lg-2">
            <input type="text" class="form-control" id="validationCustom02" name="wp_cont_person"
              value="{{ $workpermit->wp_cont_person}}" placeholder="Enter person name">
          </div>

          <label class="col-lg-1" for="">Mobile Number</label>
          <div class="col-lg-2">
            <input type="text" class="form-control" id="validationCustom02" name="wp_cont_mobile"
              value="{{ $workpermit->wp_cont_mobile}}" placeholder="Enter mobile number">
          </div>

          <label class="col-lg-1" for="">No. Workers</label>
          <div class="col-lg-2">
            <input type="text" class="form-control" id="validationCustom02" name="wp_no_workers"
              value="{{ $workpermit->wp_no_workers}}" placeholder="Enter number of workers">
          </div>
        </div>
      </div>




      <div class="form-group">
        <strong>  Terms & Conditions:</strong> 

        <ol>
          <li>Work permit requests should be submitted to the Mall Management at least 24 hours prior to
            the
            commencement of the work.</li>
          <li>Work ID copy should be submitted to the security department to get access into the mall</li>
          <li>Delivery of materials and all noisy works should be carried out after the mall trading hours
            only.</li>
          <li>No material and shop fixtures to be left in the mall common areas.</li>
          <li>All workers must follow the safety and security rules and regulations.</li>
          <li>Please report to the security if any incident/damage to the property.</li>
          <li>Responsible if in case of any damage in surrounding area.</li>
          <li>For HOT work permits, valid fire extingusher and first aid kit has to be stored at work place</li>
        </ol>
         <p align="center"> I understand & accept all the responsibilities as explained in work permit terms and
          Conditions. </p>

























        <div class="form-group">
          <input type="submit" class="btn btn-primary" Value="Save">
          <a href="{{route('mall.workpermit.index')}}" class="btn btn-warning" role="button">Cancel</a>
        </div>
    </form>
  </div>





</section>
@endsection