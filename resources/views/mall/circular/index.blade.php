@extends('layouts.adminwp')
@section('content')


<!-- Main content -->
<section class="content">
  <div class="row">
    <div class="col-12">
      <div class="card">

        <!-- /.card-header -->

        <!-- /.card-body -->
      </div>
      <!-- /.card -->

      <div class="card">
        <div class="card-header">
          <h3 class="card-title">Circular Details
            <a href="{{ route('mall.circular.create') }}" class="btn btn-primary btn-sm">Add New</a></h3>
        </div>
        <!-- /.card-header -->
        <div class="card-body">
          <table id="example2" class="table table-bordered table-striped">
            <thead>
              <tr>

                <th> ID </th>
                <th> Circular No </th>
                <th> Date </th>
                <th>Subject</th>
                <th> Document </th>
                <th> Created By </th>
                <th> Action </th>
              </tr>
            </thead>
            <tbody>





              @if(count($circular))

              @foreach($circular as $c)


              <?php $dt = date("d-m-Y");
           
      
              $fdate = $c->created_at;
             $tdate = $dt;
             $datetime1 = new DateTime($fdate);
             $datetime2 = new DateTime($tdate);
             $interval = $datetime1->diff($datetime2);
             $days = $interval->format('%a');//now do whatever you like with $days
              // echo $days;
 
               ?>




              <tr>
                <td>{{ $c->id }}</td>
                <td> {{ $c->ci_circular_no }} </td>
                <td>{{ date('d-m-Y', strtotime($c->created_at)) }}</td>


                @if($days > 2 )

                <td>{{ $c->ci_subject}}


                </td>
                @else
                <td>{{ $c->ci_subject}}
                  <span class="right badge badge-success">New</span>
                </td>
                @endif


                <td><a href="{{ url('storage/categories/'.$c->ci_document) }}" target="_blank">PDF</a></td>


                <td> {{ $c->ci_user_name }} </td>
                <td>

                  <a href="{{ route('mall.circular.edit',$c->id) }}">
                    <i class="fa fa-edit"></i>

                  </a>

                  /

                  <a data-catid={{$c->id}} data-toggle="modal" data-target="#delete">
                    <i class="fa fa-trash text-red"></i>

                  </a>





                </td>

              </tr>
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
                <th> Circular No </th>
                <th> Date </th>
                <th>Subject</th>
                <th> Document </th>
                <th> Created By </th>
                <th> Action </th>

              </tr>
            </tfoot>
          </table>

        </div>
        <!-- /.card-body -->
      </div>
      <!-- /.card -->
    </div>
    <!-- /.col -->
  </div>
  <!-- /.row -->
</section>

<!-- Modal -->
<div class="modal modal-danger fade" id="delete" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">

        <h4 class="modal-title text-left" id="myModalLabel">Delete Confirmation</h4>
      </div>
      <form action="{{route('mall.circular.destroy','test')}}" method="post">
        {{method_field('delete')}}
        {{csrf_field()}}
        <div class="modal-body">
          <p class="text-left">
            Are you sure you want to delete this transaction?
          </p>
          <input type="hidden" name="category_id" id="cat_id" value="">

        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-success" data-dismiss="modal">Cancel</button>
          <button type="submit" class="btn btn-warning">Delete</button>
        </div>
      </form>
    </div>
  </div>
</div>

@endsection