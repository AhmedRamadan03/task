
   
@if (session('success'))

    <script>
        new Noty({
            type: 'success',
            layout: 'topCenter',
            text: "{{ session('success') }}",
            timeout: 3000,
            killer: true
        }).show();
    </script>

@endif
   
@if (session('error'))

    <script>
        new Noty({
            type: 'error',
            layout: 'topCenter',
            text: "{{ session('error') }}",
            timeout: 3000,
            killer: true
        }).show();
    </script>

@endif