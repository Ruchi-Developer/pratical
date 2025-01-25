@extends('layouts.app')

@section('content')

<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card">
                <div class="card-header text-center">{{ __('Register Form') }}</div>

                <div class="card-body">

<form action="{{ route('register') }}" method="POST" id="register-form">
        @csrf
        <div class="form-group">
            <label>Full Name:</label>
            <input type="text" name="full_name" class="form-control" id="full_name">
            @error('full_name')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group">
            <label>Email:</label>
            <input type="email" name="email" class="form-control" id="email">
            @error('email')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group">
            <label>Password:</label>
            <input type="password" name="password" class="form-control" id="password">
            @error('password')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group">
            <label>Confirm Password:</label>
            <input type="password" name="password_confirmation" class="form-control" id="password_confirmation">
             @error('password_confirmation')
               <div class="text-danger">{{ $message }}</div>
             @enderror
        </div>

        <div class="form-group">
            <label>Date of Birth:</label>
            <input type="date" name="dob" class="form-control" id="dob">
            @error('dob')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group">
            <label>Gender:</label>
            <select name="gender" id="gender" class="form-control">
                <option value="Male">Male</option>
                <option value="Female">Female</option>
                <option value="Other">Other</option>
            </select>
            @error('gender')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group">
            <label>Country:</label>
            <select name="country_id" class="form-control" id="country">
                <option value="">Select Country</option>
            </select>
            @error('country_id')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group">
            <label>State:</label>
            <select name="state_id" class="form-control" id="state">
                <!-- Populate states dynamically based on selected country -->
            </select>
            @error('state_id')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group">
            <label>City:</label>
            <select name="city_id" class="form-control" id="city">
                <!-- Populate cities dynamically based on selected state -->
            </select>
            @error('city_id')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>

    <button type="submit">Register</button>
</form>
</div>

</div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).ready(function() {
        // Fetch all countries and populate the dropdown
        $.ajax({
            url: "{{ route('get.countries') }}",
            type: "GET",
            success: function(countries) {
                let countryOptions = '<option value="">Select Country</option>';
                countries.forEach(function(country) {
                    countryOptions += `<option value="${country.id}">${country.name}</option>`;
                });
                $('#country').html(countryOptions);
            }
        });

        // Fetch states based on selected country
        $('#country').on('change', function() {
            let countryId = $(this).val();
            $('#state').html('<option value="">Loading...</option>');
            $('#city').html('<option value="">Select City</option>');

            if (countryId) {
                $.ajax({
                    url: "{{ route('get.states') }}",
                    type: "GET",
                    data: { country_id: countryId },
                    success: function(states) {
                        let stateOptions = '<option value="">Select State</option>';
                        states.forEach(function(state) {
                            stateOptions += `<option value="${state.id}">${state.name}</option>`;
                        });
                        $('#state').html(stateOptions);
                    }
                });
            } else {
                $('#state').html('<option value="">Select State</option>');
                $('#city').html('<option value="">Select City</option>');
            }
        });

        // Fetch cities based on selected state
        $('#state').on('change', function() {
            let stateId = $(this).val();
            $('#city').html('<option value="">Loading...</option>');

            if (stateId) {
                $.ajax({
                    url: "{{ route('get.cities') }}",
                    type: "GET",
                    data: { state_id: stateId },
                    success: function(cities) {
                        let cityOptions = '<option value="">Select City</option>';
                        cities.forEach(function(city) {
                            cityOptions += `<option value="${city.id}">${city.name}</option>`;
                        });
                        $('#city').html(cityOptions);
                    }
                });
            } else {
                $('#city').html('<option value="">Select City</option>');
            }
        });
    });
    
</script>
@endpush