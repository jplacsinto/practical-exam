@extends('layouts.app')
@section('scripts')

@if (session()->has('message'))
	<script src="{{ asset('js/jquery-3.4.1.min.js') }}"></script>
	<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
	<script type="text/javascript">
		swal({
		  title: "Good job!",
		  text: "{{session()->has('message')}}",
		  icon: "success",
		  button: "Aww yiss!",
		});
	</script>
@endif
@endsection