<!DOCTYPE html>
<html lang="en" class="h-full bg-gray-100">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <script>
    const csrfToken = '{{ csrf_token() }}';
</script>
  @vite(['resources/css/app.css'])
  <title>{{ $title }}</title>
  <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
  <script defer src="{{ asset('js/script.js') }}"></script>

  <link rel="stylesheet" href="https://rsms.me/inter/inter.css">

</head>
<body class="h-full">
<!--
  This example requires updating your template:

  ```
  <html class="h-full bg-gray-100">
  <body class="h-full">
  ```
-->
{{ $slot }}
<x-footer></x-footer>
</body>
</html>