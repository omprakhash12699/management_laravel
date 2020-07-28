@extends('layouts.master')

@section('title')
Projects | management

@endsection

@section('content')

<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Add  Projects</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
        
      </div>
      <form action="/save-aboutus" method="POST">
        {{ csrf_field()}}

      <div class="modal-body">
       
          <div class="form-group">
            <label for="recipient-name" class="col-form-label">Project Name</label>
            <input type="text" name="title" class="form-control" id="recipient-name">
          </div>
          <div class="form-group">
            <label for="recipient-name" class="col-form-label">Client Name</label>
            <input type="text" name="subtitle" class="form-control" id="recipient-name">
          </div>
          <div class="form-group">
            <label for="message-text" class="col-form-label">Description</label>
            <textarea name="description" class="form-control" id="message-text"></textarea>
          </div>
        
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary">SAVE</button>
      </div>
      </form>
    </div>
  </div>
</div>


<!--Delete - Modal -->
<div class="modal fade" id="deletemodalpop" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Delete Project</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form id="delete_modal_Form" method="POST">
       {{ csrf_field() }}
       {{ method_field('DELETE') }}
                           
                       
      <div class="modal-body">
        <input type="hidden" id="delete_aboutus_id">
        <h5>Are You Sure You Want To Delete The Project?</h5>

      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary">Yes</button>
      </div>
      </form>
    </div>
  </div>
</div>
<!--End -Delete - Modal -->


<div class="row">
          <div class="col-md-12">
            <div class="card">
              <div class="card-header">
                <h4 class="card-title"> Projects
                <button type="button" class="btn btn-primary float-right" data-toggle="modal" data-target="#exampleModal" >ADD</button>
                </h4>
               
              </div>
              <style>
                     .w-10p{
                         width: 10% !important;
                     }
              </style>
              <div class="card-body">
                <div class="table-responsive">
                  <table id="datatable" class="table">
                    <thead class=" text-primary">
                     
                      <th>Id</th>
                      <th> Project Name</th>
                      <th> Client Name</th>
                      <th>Description</th>
                      <th>EDIT</th>
                      <th>DELETE</th>

                    </thead>
                    <tbody>
                    @foreach ($aboutus as $data)
            
                

                    
                      <tr>
                        <td>{{ $data ->id }} </td>
                        <td> {{ $data ->title }}</td>
                         <td>{{ $data ->subtitle }} </td>
                         <td>
                         <div style ="height:80px; overflow: hidden;">
                         {{ $data ->description }}
                         </div> </td>
                         <td>
                         <a href="{{ url('about-us/' .$data->id)}}" class="btn btn-success">EDIT</a>
                         </td>
                         <td>
                         <a href="javascript:void(0)" class="btn btn-danger deletebtn" >Delete</a>
                          
                         </td>
                    
                        
                        
                        
                        
                      </tr>
                      @endforeach
                    </tbody>
                  </table>
                </div>
              </div>
            </div>
          </div>
        </div>

@endsection

@section('scripts')

<script> 
     $(document).ready( function (){
       $('#datatable').DataTable();

       

       $('#datatable').on('click','.deletebtn', function(){

          $tr = $(this).closest('tr');

           var data = $tr.children("td").map(function () {
               return $(this).text();
           }).get();

           $('#delete_aboutus_id').val(data[0]);

           $('#delete_modal_Form').attr('action', '/about-us-delete/'+data[0]);

           $('#deletemodalpop').modal('show');
       });


    });

    


</script>
@endsection