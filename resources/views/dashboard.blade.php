@if (auth()->user()->role == 1)
    <script>
        window.location = "{{ route('superadmin.dashboard') }}";
    </script>
@elseif (auth()->user()->role == 2)
    <script>
        window.location = "{{ route('user.dashboard') }}";
    </script>
@endif
