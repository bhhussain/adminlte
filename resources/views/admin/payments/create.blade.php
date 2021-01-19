@extends('layouts.admin')
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
        <h1 class="m-0 text-dark">New Payment</h1>
      </div><!-- /.col -->
      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
          <li class="breadcrumb-item"><a href="{{route('home')}}">Dashboard</a></li>

          <li class="breadcrumb-item"><a href="{{route('admin.payments.index')}}">Payments</a></li>


        </ol>
      </div><!-- /.col -->
    </div><!-- /.row -->
  </div><!-- /.container-fluid -->
</div>
<!-- /.content-header -->

<section class="content">
  <div class="container-fluid">
    <form class="needs-validation" name="myform" id="myform" novalidate method="post"
      action="{{ route('admin.payments.store') }}" enctype="multipart/form-data" autocomplete="off" autofill="off">
      <input type="hidden" name="_token" value="{{ csrf_token() }}">

      <div class="form-group">
        <div class="row">
          <label class="col-lg-2" for="">Payment From</label>
          <div class="col-lg-8">

            <select class="custom-select" name="bank_acc_no" id="bank_acc_no" required>
              <option value="" selected disabled hidden>Please select</option>

              @foreach($bank as $t)
              <option value="{{ $t->bank_acc_no}}">{{ $t->bank_name}}</option>
              @endforeach

            </select>

            <input type="hidden" id="bank_name" name="bank_name">

            <script>
              $('#bank_acc_no').on('change', function() 
                                           {
                                             var selectedName = $('#bank_acc_no option:selected').text();
                                            $('#bank_name').val(selectedName);
                                                      }
                                            )
            </script>


            <div class="clear-fix"></div>
          </div>
        </div>
      </div>

      <div class="form-group">
        <div class="row">
          <label class="col-lg-2" for="">Account Name</label>
          <div class="col-lg-8">
            <input type="text" class="form-control" name="pay_supp_acc_name" placeholder="Enter account name" required>
            <div class="clear-fix"></div>
          </div>
        </div>
      </div>



      <div class="form-group">
        <div class="row">
          <label class="col-lg-2" for="">Account Number</label>
          <div class="col-lg-8">
            <input type="text" class="form-control" id="validationCustom02" name="pay_supp_acc_no"
              placeholder="Enter account number" required>
            <div class="clear-fix"></div>
          </div>
        </div>
      </div>

      <div class="form-group">
        <div class="row">
          <label class="col-lg-2" for="">Bank Name</label>
          <div class="col-lg-8">
            <input type="text" class="form-control" id="validationCustom02" name="pay_supp_bank_name"
              placeholder="Enter bank name" required>
            <div class="clear-fix"></div>
          </div>
        </div>
      </div>




      <div class="form-group">
        <div class="row">
          <label class="col-lg-2" for="">SWIFT</label>
          <div class="col-lg-3">
            <input type="text" class="form-control" id="validationCustom02" name="pay_supp_swift_code"
              placeholder="Enter SWIFT" required>
          </div>
          <label class="col-lg-2" for="">IBAN</label>
          <div class="col-lg-3">
            <input type="text" class="form-control" id="validationCustom02" name="pay_supp_iban"
              placeholder="Enter IBAN" required>
          </div>
        </div>
      </div>

      <div class="form-group">
        <div class="row">
          <label class="col-lg-2" for="">Currency</label>
          <div class="col-lg-3">

            <select class="custom-select" name="pay_supp_currency" id="pay_supp_currency" required>
              <option value="" selected disabled hidden>Please select</option>


              <option value="OMR">OMR</option>
              <option value="AED">AED</option>
              <option value="USD">USD</option>


            </select>


          </div>
          <label class="col-lg-2" for="">Amount</label>
          <div class="col-lg-3">
            <input type="text" class="form-control" id="validationCustom02" name="pay_supp_amount"
              placeholder="Enter amount" required>
          </div>
        </div>
      </div>





      <div class="form-group">
        <div class="row">
          <label class="col-lg-2" for="">Reference No</label>
          <div class="col-lg-8">
            <input type="text" class="form-control" id="validationCustom02" name="pay_supp_ref_no"
              placeholder="Enter reference number">
            <div class="clear-fix"></div>
          </div>
        </div>
      </div>








      <div class="form-group">
        <div class="row">
          <label class="col-lg-2" for="">Comments</label>
          <div class="col-lg-8">
            <input type="text" class="form-control" id="validationCustom02" name="remarks" placeholder="Enter remarks">
            <div class="clear-fix"></div>
          </div>
        </div>
      </div>









      <div class="form-group">
        <input type="submit" class="btn btn-primary" Value="Save">
        <a href="{{route('admin.payments.index')}}" class="btn btn-warning" role="button">Cancel</a>
      </div>
    </form>
  </div>
</section>
@endsection