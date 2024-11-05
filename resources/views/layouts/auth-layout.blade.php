<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Roles and Permissions Project</title>
    <link href='https://fonts.googleapis.com/css?family=Nunito:400,300' rel='stylesheet' type='text/css'>
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" href="plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
    <link rel="stylesheet" href="plugins/datatables-buttons/css/buttons.bootstrap4.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <base href="{{asset('admincss') }}/" />
</head>



<body>
    <div class="container mt-5">

        @yield('content')
    </div>


</body>
<script>
    private function getGeolocation()
    {
    $ip = request()->ip(); // Get the user's IP address
    // Use a geolocation API service to get details (this is an example URL)
    $response = file_get_contents("http://ip-api.com/json/{$ip}");
    $data = json_decode($response, true);
    return isset($data['city']) ? "{$data['city']}, {$data['regionName']}, {$data['country']}" : 'Unknown';
    }
</script>


</html>