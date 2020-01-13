@extends('layouts.admin')
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
              <h3 class="card-title">User List</h3>   
              
            </div>
            <!-- /.card-header -->
            <div class="card-body">
              <table id="example1" class="table table-bordered table-striped">
                <thead>
                <tr>
                                   
                <th> User ID   </th>                       
            <th> User Name </th>
            <th> Email </th>
            <th> Company Name </th>
            <th> Type </th>
            
            <th> Created Date </th>
            <th> Verified Date</th>
            
         
                </tr>
                </thead>
                <tbody>
                
                @if(count($users))
            
            @foreach($users as $c)
            
            <tr>
            
                <td>{{ $c->id }}</td>
                <td>{{ $c->name }}</td>
                <td>{{ $c->email }}</td>
                <td>
                  
                  @if($c->company =='1')
                    {{ "Al Jarwani"}}
                  @elseif($c->company =='2')
                  {{"Mall Of Muscat"}}
                  @elseif($c->company =='3')
                  {{"Oman Aquarium"}}
                  @elseif($c->company =='4')
                  {{"Snow Village"}}
                  @endif
              
              </td>


              <td>{{ $c->user_type}}</td>     
              <td>{{ date('d-m-Y', strtotime($c->created_at)) }}</td>   
                
                <td>{{ date('d-m-Y', strtotime($c->email_verified_at)) }}</td>   
            
            
            
            </tr>
            @endforeach
            
            @else
            <tr><td colspan="11">No Record Found</td></tr>
            @endif

                </tbody>
                <tfoot>
                <tr>
                                 
                    <th> User ID   </th>                       
                    <th> User Name </th>
                    <th> Email </th>
                    <th> Company Name </th>
                    <th> Type </th>
                    
                    <th> Created Date </th>
                    <th> Verified Date</th>
                    
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
   

@endsection

    