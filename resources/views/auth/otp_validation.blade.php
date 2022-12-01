@extends('layouts.app')

@section('page')
    {{-- include top navigation --}}
    @include('kin.inc.kin_top_nav')

    {{-- heading --}}
    <div class="container-fluid text-center m-auto font-weight-bold text-xl mt-2 mb-4">
        OTP CONFIRMATION
    </div>

    {{-- include alert messages --}}
    @include('alerts.messages')
    
    {{-- include registration form --}}
    <div class="container bg-red  mt-4">
        <form action="{{ route('otp_validator', ['id' => $id]) }}" method="post">
            @csrf
            {{-- basic information --}}
            <div class="app-auth-form text-center">
                {{-- first_name form item --}}
                <div class="m-auto mt-4 p-2">
                    <label for="" class="app-text-medium">O.T.P:</label><br>
                    <div class="auth-form-msg"></div>
                    <input type="text" name="otp" placeholder="OTP" value="{{ old('otp') }}"
                        required>
                    @error('otp')
                        <span class="text-sm text-red" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>

            </div>

            {{-- submit button --}}
            <div class="pt-3 pb-3 text-center">
                <button class="btn btn-success btn-sm auth-btn" type="submit">SUBMIT</button>
            </div>

        </form>
    </div>
@endsection
