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


<script>
    function calc() 
        {
    
        var eb_rate = document.getElementById('bm_eb_rate[]').value;
        var eb_cb = document.getElementById('bm_eb_cb[]').value;
        var eb_ob = document.getElementById('bm_eb_ob[]').value;

        var consumed = eb_cb - eb_ob;
        document.getElementById('ui_consumed[]').value = consumed;  

        var amount = consumed * eb_rate; 
        document.getElementById('ui_amount[]').value = amount.toFixed(3);  

        var vat = amount * .05;
        document.getElementById('ui_vat[]').value = vat.toFixed(3);  

        var netamount = amount + vat;
        document.getElementById('ui_netamount[]').value = netamount.toFixed(3);            
            
        }  

        function calc1(rowNo)
{
	var eb_rate = document.getElementById('bm_eb_rate_' + rowNo).value;

	document.getElementById('ui_consumed_' + rowNo).value = consumed;
}



</script>




<!-- Content Header (Page header) -->
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0 text-dark">Electricity Master</h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">

                    <li class="breadcrumb-item"><a href="{{route('mall.utility.index')}}">Electricity</a></li>
                    <li class="breadcrumb-item"><a href="{{route('cwater')}}">Chilled Water</a></li>



                </ol>
            </div><!-- /.col -->
        </div><!-- /.row -->
    </div><!-- /.container-fluid -->
</div>
<!-- /.content-header -->

<section class="content">
    <div class="container-fluid">
        <form class="needs-validation" name="myform" id="myform" novalidate method="post"
            action="{{ route('mall.utility.store') }}" enctype="multipart/form-data" autocomplete="off" autofill="off">
            <input type="hidden" name="_token" value="{{ csrf_token() }}">
            <div class="form-group">
                <div class="row">
                    <label class="col-lg-1" for="">From</label>
                    <div class="col-lg-2">

                        <input class="form-control datepicker" tabindex="3" id="datepicker" name="th_bill_dt"
                            placeholder="dd-mm-yyyy" required readonly>

                        <script>
                            $('#datepicker').datepicker({
        format: 'dd-mm-yyyy',
          uiLibrary: 'bootstrap4'
      });
                        </script>


                        <div class="clear-fix"></div>
                    </div>

                    <label class="col-lg-1" for="">To</label>
                    <div class="col-lg-2">

                        <input class="form-control datepicker" tabindex="3" id="datepicker2" name="th_bill_dt"
                            placeholder="dd-mm-yyyy" required readonly>

                        <script>
                            $('#datepicker2').datepicker({
        format: 'dd-mm-yyyy',
          uiLibrary: 'bootstrap4'
      });
                        </script>


                        <div class="clear-fix"></div>
                    </div>

                    <label class="col-lg-1" for="">Month</label>
                    <div class="col-lg-2">
                        <select class="custom-select" name="ui_month" id="ui_month" required>
                            <option value="" selected disabled hidden>Please select</option>
                            <option value="Jan-2021">Jan - 2021</option>
                            <option value="Feb-2021">Feb - 2021</option>
                            <option value="Mar-2021">Mar - 2021</option>

                        </select>
                        <div class="clear-fix"></div>
                    </div>

                    <label class="col-lg-1" for="">Type</label>
                    <div class="col-lg-2">
                        <select class="custom-select" name="ui_type" id="ui_type" required>
                            <option value="" selected disabled hidden>Please select</option>
                            <option value="Electricity">Electricity</option>
                        </select>
                        <div class="clear-fix"></div>
                    </div>




                </div>
            </div>



            <div class="card-body">
                <table id="example1" class="table table-bordered table-striped">
                    <thead>
                        <tr>

                            <th> ID </th>
                            <th> Brand </th>

                            <th>Unit Rate</th>
                            <th> OMR </th>
                            <th> CMR </th>
                            <th> Consumed </th>
                            <th>Amount</th>
                            <th>VAT 5%</th>
                            <th>Net Amount</th>


                        </tr>
                    </thead>
                    <tbody>

                        @if(count($brand))

                        @foreach($brand as $id => $row)

                        @foreach($brand as $c)

                        <tr>


                            <td>{{ $c->id }}</td>


                            <td><input class="form-control" type="text" name="ui_brand_name[]" value="{{ $c->bm_name}}"
                                    readonly>
                                <input class="form-control" type="hidden" name="ui_brand_id[]" value="{{ $c->id}}">
                                <input class="form-control" type="hidden" name="ui_comp_id[]" value="{{ $c->bm_tm_id}}">
                                <input class="form-control" type="hidden" name="ui_comp_name[]"
                                    value="{{ $c->bm_tm_name}}">
                            </td>







                            <td><input class="form-control" onkeyup="calc()" id="bm_eb_rate[]" type="text"
                                    name="ui_rate[]" value="{{ $c->bm_eb_rate}}"></td>
                            <td><input class="form-control" id="bm_eb_ob[]" type="text" name="ui_omr[]"
                                    value="{{ $c->bm_eb_ob}}">
                            </td>
                            <td><input class="form-control" onkeyup="calc()" id="bm_eb_cb[]" type="text" name="ui_cmr[]"
                                    value="{{ $c->bm_eb_cb}}">
                            </td>

                            <td><input class="form-control text-right" type="text" name="ui_consumed[]"
                                    id="ui_consumed[]" readonly>
                            </td>

                            <td><input class="form-control text-right" type="text" name="ui_amount[]" id="ui_amount[]"
                                    readonly>
                            </td>

                            <td><input class="form-control text-right" type="text" name="ui_vat[]" id="ui_vat[]"
                                    readonly>
                            </td>

                            <td><input class="form-control text-right" type="text" name="ui_netamount[]"
                                    id="ui_netamount[]" readonly>
                            </td>






                        </tr>
                        @endforeach
                        @endforeach

                        @else
                        <tr>
                            <td colspan="11">No Record Found</td>
                        </tr>
                        @endif

                    </tbody>
                    <tfoot>
                        <tr>


                            <th> ID </th>
                            <th> Brand </th>

                            <th>Unit Rate</th>
                            <th> OMR </th>
                            <th> CMR </th>
                            <th> Consumed </th>
                            <th>Amount</th>
                            <th>VAT 5%</th>
                            <th>Net Amount</th>


                        </tr>
                    </tfoot>
                </table>

            </div>















            <div class="form-group">
                <input type="submit" class="btn btn-primary" Value="Save">
                <a href="{{route('mall.tenant.index')}}" class="btn btn-warning" role="button">Cancel</a>
            </div>
        </form>
    </div>
</section>
@endsection