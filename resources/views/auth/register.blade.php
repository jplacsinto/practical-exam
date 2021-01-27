<?php
$isAdmin = Auth::user() && Auth::user()->isAdmin();
$isTogglePass = Route::currentRouteName() == 'clients.edit' && $isAdmin;
?>

@extends('layouts.app')

@section('content')

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __(Route::currentRouteName() == 'clients.create' ? 'Create New Client' : 'Register') }}</div>

                <div class="card-body">
                    <form method="POST" action="{{ isset($formAction) ? $formAction : route('register') }}">
                        @csrf

                        @if(isset($formMethod)) @method($formMethod) @endif

                        <div class="form-group row">
                            <label for="first_name" class="col-md-4 col-form-label text-md-right">{{ __('First Name') }}</label>

                            <div class="col-md-6">
                                <input id="first_name" type="text" class="form-control @error('first_name') is-invalid @enderror" name="first_name" value="{{ old('first_name', $first_name) }}" required autocomplete="first_name" autofocus>

                                @error('first_name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="last_name" class="col-md-4 col-form-label text-md-right">{{ __('Last Name') }}</label>

                            <div class="col-md-6">
                                <input id="last_name" type="text" class="form-control @error('last_name') is-invalid @enderror" name="last_name" value="{{ old('last_name', $last_name) }}" required autocomplete="last_name" autofocus>

                                @error('last_name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="contact_no" class="col-md-4 col-form-label text-md-right">{{ __('Contact Number') }}</label>

                            <div class="col-md-6">
                                <input id="contact_no" type="text" class="form-control @error('contact_no') is-invalid @enderror" name="contact_no" value="{{ old('contact_no', $contact_no) }}" required autocomplete="contact_no" autofocus>

                                @error('contact_no')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="birthday" class="col-md-4 col-form-label text-md-right">{{ __('Birthday') }}</label>

                            <div class="col-md-6">
                                <input id="birthday" type="text" class="form-control @error('birthday') is-invalid @enderror" name="birthday" value="{{ old('birthday', $birthday) }}" required autocomplete="birthday" autofocus>

                                @error('birthday')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="interests" class="col-md-4 col-form-label text-md-right">{{ __('Interest') }}</label>

                            <div class="col-md-6">

                                @foreach($allInterests as $key => $interest)

                                    <div class="form-check">
                                      <input {{ !empty(old('interests', $interests)) && in_array($key, old('interests', $interests)) ? 'checked' : '' }} name="interests[]" class="form-check-input" type="checkbox" value="{{$key}}" id="interest-{{$key}}">
                                      <label class="form-check-label" for="interest-{{$key}}">
                                        {{$interest}}
                                      </label>
                                    </div>

                                @endforeach

                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('E-Mail Address') }}</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email', $email) }}" required autocomplete="email">

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>


                        @if($isTogglePass)
                            <hr>
                            <div class="form-group row">
                                <label for="change-pass" class="col-md-4 col-form-label text-md-right"></label>

                                <div class="col-md-6">
                                    <div class="form-check">
                                      <input onclick="toggleChangePass()" name="change_pass" class="form-check-input" type="checkbox" value="1" id="change-pass" id="change-pass">
                                      <label class="form-check-label" for="change-pass">
                                        Change Password
                                      </label>
                                    </div>
                                </div>
                            </div>
                        @endif

                        <div class="form-group row togglePass @if($isTogglePass) d-none @endif">
                            <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('Password') }}</label>

                            <div class="col-md-6">
                                <input required id="password" @if($isTogglePass) readonly @endif type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>


                        <div class="form-group row togglePass @if($isTogglePass) d-none @endif">
                            <label for="password-confirm" class="col-md-4 col-form-label text-md-right">{{ __('Confirm Password') }}</label>

                            <div class="col-md-6">
                                <input required id="password-confirm" @if($isTogglePass) readonly @endif type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
                            </div>
                        </div>

                        @if($isAdmin)
                            <div class="form-group row">
                                <label for="password-confirm" class="col-md-4 col-form-label text-md-right"></label>

                                <div class="col-md-6">
                                    <div class="form-check">
                                      <input {{ old('role_id', $role_id) == 1 ? 'checked' : '' }} name="role_id" class="form-check-input" type="checkbox" value="1" id="role_id">
                                      <label class="form-check-label" for="role_id">
                                        Make user as admin
                                      </label>
                                    </div>
                                </div>
                            </div>
                        @endif

                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __(Route::currentRouteName() == 'clients.create' ? 'Create' : 'Register') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection



@section('scripts')

@if($isAdmin)
<script type="text/javascript">
    function toggleChangePass() {
    var checkBox = document.getElementById("change-pass");
    if (checkBox.checked == false){
        document.getElementById("password").setAttribute("readonly", true);
        document.getElementById("password-confirm").setAttribute("readonly", true);
        for (let el of document.querySelectorAll('.togglePass')) el.classList.add("d-none");
      } else {
        document.getElementById("password").removeAttribute("readonly");
        document.getElementById("password-confirm").removeAttribute("readonly");
        for (let el of document.querySelectorAll('.togglePass')) el.classList.remove("d-none");
      }
    }
</script>
@endif

@endsection




