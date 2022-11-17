{{-- authentication layout --}}
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    {{-- bootstrap 4 css --}}
    <link rel="stylesheet" href="{{ asset('css/bootstrap.css') }}">
    {{-- custom auth css --}}
    <link rel="stylesheet" href="{{ asset('css/auth.css') }}">
    <!-- fontawsome -->
    <link rel="stylesheet" href={{ asset('fontawsome/css/all.css') }}>
    <!-- Theme style -->
    <link rel="stylesheet" href={{ asset("css/adminlte.min.css") }}>
    {{-- page title --}}
    <title>PAFID</title>
</head>
<body>
    {{-- include pages from auth sections --}}
    @yield('page')
 
    {{-- js and jquery scripts --}}
    <script src="{{ asset('js/jquery.js') }}"></script> 
    <script src="{{ asset('js/auth.js') }}"></script>
    <script>
        let old_countySelect = {
            county: "{{ old('county') ?? ($property->county ?? '') }}",
            sub_county: "{{ old('sub_county') ?? ($property->sub_county ?? '') }}"
        }
    </script>
    <script src="{{ asset('js/countySelect.js') }}"></script>
</body>
</html>