@extends('layouts.app')

@section('content')
<div class="">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Dashboard') }} <a class="btn btn-primary float-right" href="{{route('clients.create')}}" role="button">Add Client</a></div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    {{-- {{ __('You are logged in!') }} --}}

                    <div class="">
                        <table id="client-table" class="table table-bordered table-striped w-100">
                            <thead class="thead-dark">
                                <tr>
                                    <th>ID</th>
                                    <th>Name</th>
                                    <th>Contact</th>
                                    <th>Birthday</th>
                                    <th>Role</th>
                                    <th>Email</th>
                                    <th></th>
                                </tr>
                            </thead>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('styles')
<link href="//cdn.datatables.net/1.10.23/css/jquery.dataTables.min.css" rel="stylesheet">
@endsection

@section('scripts')
<script src="{{ asset('js/jquery-3.4.1.min.js') }}"></script>

<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>

<script src="//cdn.datatables.net/1.10.23/js/jquery.dataTables.min.js" defer=""></script>
<script type="text/javascript">
    $(document).ready(function(){
        $("#client-table").DataTable({
            serverSide: true,
            ajax: "{{ route('clients.table') }}",
            order: [[1, "asc"]],
            columns: [
                { name: 'id'},
                { name: 'name'},
                { name: 'contact_no'},
                { name: 'birthday'},
                { name: 'role_id'},
                { name: 'email'},
                { name: 'action', orderable: false, searchable:false}
            ],
        });  

    });

    $(document).on('click', '.delete-confirm', function (event) {
        event.preventDefault();

        var id = $(this).data('id');

        swal({
          title: "Are you sure?",
          text: "Once deleted, you will not be able to recover this item!",
          icon: "warning",
          buttons: true,
          dangerMode: true,
        })
        .then((willDelete) => {
          if (willDelete) {

            $.ajax({
                type: "POST",
                url: "{{url('/clients')}}/"+id,
                data: {_method:'delete','_token':'{{ csrf_token() }}'},
                success: function (data) {

                    $("#client-table").DataTable().ajax.reload();

                    swal("Poof! client has been deleted!", {
                      icon: "success",
                    });
                }         
            });

            
          } else {
            //swal("Your imaginary file is safe!");
          }
        });


    });
</script>
@endsection
