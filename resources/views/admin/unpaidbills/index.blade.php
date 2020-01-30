@extends('layouts.admin')
@section('content')

<script>
  function myFunction() {
    window.print();

    
  }
  </script>



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
              <h3 class="card-title">Unpaid Bills - All
              <a href="{{ route('admin.accounts.create') }}" class="btn btn-primary btn-sm">Add Bill</a></h3>   
            </div>
            <!-- /.card-header -->
            <div class="card-body">
              <table id="example1" class="table table-bordered table-striped">
                <thead>
                <tr>
                                   
                <th> Tran No.   </th>                       
            <th> Tran Date </th>
            <th> Supplier Name </th>
            <th> Bill Date </th>
            <th> Bill No. </th>
            <th> Bill Amount </th>
            <th> Purpose </th>
            <th> Emp Name </th>
            
            <th> Action </th>
                </tr>
                </thead>
                <tbody>
                
                @if(count($accounts))
            
            @foreach($accounts as $c)
            
            <tr>
            <td><a href="{{ url('storage/categories/'.$c->th_attach) }}" target="_blank">{{ $c->th_tran_no }}</a></td>            
            <td>{{ date('d-m-Y', strtotime($c->created_at)) }}</td>            
            <td>{{ $c->th_supp_name }}</td>
            <td>{{ date('d-m-Y', strtotime($c->th_bill_dt)) }}</td>
            <td>{{ $c->th_bill_no }}</td>
            <td class="text-right">{{ number_format($c->th_bill_amt,3) }}</td>
            <td>{{ $c->th_purpose }}</td>
            <td>{{ $c->th_emp_name }}</td>
            
            
            
            <td>             
              <a href="{{ route('admin.accounts.print', $c) }}" >
              
              <i class="fa fa-print text-green" aria-hidden="true"></i>
              
              </a>
              /
           

            
            <a href="{{ route('admin.unpaidbills.edit',$c->th_tran_no) }}">
            <i class="fa fa-edit"></i>
           
            </a>

           

            <a href="javascript:void(0)" onclick = "$(this).parent().find('form').submit()" >
            
            
           
            
            </a>
            <form action = "{{ route('admin.accounts.destroy', $c->id)}}" method = "POST">
            @method('DELETE')
            <input type="hidden" name="_token" value = "{{ csrf_token() }}">
            </form>
          </td>                
            
            </tr>
            @endforeach
            
            @else
            <tr><td colspan="11">No Record Found</td></tr>
            @endif

                </tbody>
                <tfoot>
                <tr>
                                 
                <th> Tran No.   </th>                       
            <th> Tran Date </th>
            <th> Supplier Name </th>
            <th> Bill Date </th>
            <th> Bill No. </th>
            <th> Bill Amount </th>
            <th> Purpose </th>
            <th> Emp Name </th>
            
            <th> Action </th>
                </tr>
                </tfoot>
              </table>

              <div class="row">
            <div class="col text-right">   
              
              <a onclick="myFunction()" >

                
              
                <i class="fa fa-print fa-2x text-green" aria-hidden="true"></i>
                
                </a>


            <a href="{{route('admin.accounts.export')}}">             
            <i class="far fa-file-excel fa-2x text-green"></i>   
              
                   
            </a>      
            </div>
            </div>           
              
          
              
            </div>
            <!-- /.card-body -->
          </div>
          <!-- /.card -->
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->
    </section>
   

@endsection

    