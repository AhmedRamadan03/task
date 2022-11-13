<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>@yield('title')</title>
   @include('layouts.css')
  @yield('css')
</head>
<body>
    @include('layouts.header')

    @yield('contant')

    @include('layouts.footer')

    @include('layouts.js')

    @yield('js')
    <script>
        $('.delete').click(function(e) {
                var that = $(this)
                e.preventDefault();
                var n = new Noty({
                    text: "Are You Sure ?",
                    type: "warning",
                    layout: 'center',
                    killer: true,
                    buttons: [
                        Noty.button("Yes", 'btn btn-success mr-2', function() {
                            that.closest('form').submit();
                        }),
                        Noty.button("No", 'btn btn-primary mr-2', function() {
                            n.close();
                        })
                    ]
                });
                n.show();
            });
    </script>
</body>
</html>