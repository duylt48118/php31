<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title')</title>
    <!-- dien cac link css dung chumg -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" 
     integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
     @yield('CSS')

</head>
<body>
 <header>
  @include('admins.blocks.header')
 </header>
 <main class="row justify-content-center">
  {{-- <aside class="col-3">
    @include('admins.blocks.siderbar')
  </aside> --}}
  <div class="col-9">
    @yield('content')
  </div>
 </main>
 <footer>
    <h1> @include('admins.blocks.footer')</h1>
 </footer>
<!-- cac doan script dung chung -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" 
integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous">
</script>
@yield('JS')
</body>
</html>