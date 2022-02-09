<!--

=========================================================
* Argon Dashboard - v1.1.2
=========================================================

* Product Page: https://www.creative-tim.com/product/argon-dashboard
* Copyright 2020 Creative Tim (https://www.creative-tim.com)
* Licensed under MIT (https://github.com/creativetimofficial/argon-dashboard/blob/master/LICENSE.md)

* Coded by Creative Tim

=========================================================

* The above copyright notice and this permission notice shall be included in all copies or substantial portions of the Software. -->
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title>
    Jidan Laundry
  </title>
  {{-- Bootstrap --}}
  <link rel="stylesheet" href="{{ asset('assets') }}/bootstrap/css/bootstrap.min.css">
  <link rel="stylesheet" href="https://cdn.datatables.net/1.11.4/css/jquery.dataTables.min.css">
  <!-- Favicon -->
  <link href="{{ asset('assets') }}/img/brand/logojidan.jpg" rel="icon" type="image/png">
  <!-- Fonts -->
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet">
  <!-- Icons -->
  <link href="{{ asset('assets') }}/js/plugins/nucleo/css/nucleo.css" rel="stylesheet" />
  <link href="{{ asset('assets') }}/js/plugins/@fortawesome/fontawesome-free/css/all.min.css" rel="stylesheet" />
  <!-- CSS Files -->
  <link href="{{ asset('assets') }}/css/argon-dashboard.css?v=1.1.2" rel="stylesheet" />
</head>

<body class="">
    @if(auth()->user()->role == 'admin')
        @include('partials.sidebar-admin')
    @elseif(auth()->user()->role == 'kasir')
        @include('partials.sidebar-kasir')
    @elseif(auth()->user()->role == 'owner')
        @include('partials.sidebar-owner')
    @endif

  <div class="main-content">
    <!-- Navbar -->
    @include('partials.navbar')
    <!-- Header -->
    <div class="header bg-gradient-primary pb-8 pt-5 pt-md-8">
      <div class="container-fluid">
        <div class="header-body">

        </div>
      </div>
    </div>
    <div class="container-fluid mt--7">

        @yield('content')

    <!-- Footer -->
    @include('partials.footer')
    </div>
    </div>
  </div>



  {{-- js bootsrap --}}
  <script src="{{ asset('assets') }}/bootsrap/js/bootstrap.bundle.min.js"></script>

  <!--   Core   -->
  <script src="{{ asset('assets') }}/js/plugins/jquery/dist/jquery.min.js"></script>
  <script src="{{  asset('assets')  }}/js/plugins/jquery/dist/jquery.dataTables.js"></script>
  <script src="{{ asset('assets') }}/js/plugins/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
  <!--   Optional JS   -->
  <script src="{{ asset('assets') }}/js/plugins/chart.js/dist/Chart.min.js"></script>
  <script src="{{ asset('assets') }}/js/plugins/chart.js/dist/Chart.extension.js"></script>
  <!--   Argon JS   -->
  <script src="{{ asset('assets') }}js/argon-dashboard.min.js?v=1.1.2"></script>
  <script src="https://cdn.trackjs.com/agent/v3/latest/t.js"></script>
  <script src="{{ asset('assets') }}js/atributtambahan.js"></script>
  <script>
      window.TrackJS &&
      TrackJS.install({
        token: "ee6fab19c5a04ac1a32a645abde4613a",
        application: "argon-dashboard-free"
      });

  </script>
  <script>
      $(function(){
          $('#succes-alert').fadeTo(2000,500).slideUp(500,function(){
              $('#succes->alert').slideUp(500)
          });
      })
  </script>

 @stack('script')
</body>

</html>
