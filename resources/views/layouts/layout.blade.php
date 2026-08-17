<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    {{-- <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous"> --}}
    {{-- <link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}"> --}}
    {{-- <script src="{{ asset('js/bootstrap.bundle.min.js') }}"></script> --}}
    {{-- <title>Student Management System</title> --}}

    {{-- new code  --}}
    <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Student Management System</title>
    @viteReactRefresh
    @vite(['resources/css/app.css', 'resources/js/app.jsx'])

</head>
    {{-- end new code  --}}


    <style>
body {
    margin: 0;
    padding: 0;
    background: #f5f6f8;
    overflow-x: hidden
}
.dashboard {
    display: flex;
    min-height: calc(100vh - 60px);
}
.main-content {
    flex: 1;
    padding: 25px;
    min-width: 0;
}


.sidebar {
    width: 220px;
    height: 100%;
    background: #212529;
    flex-shrink: 0;
}

.sidebar-title {
    color: white;
    font-size: 18px;
    font-weight: bold;
    padding: 20px 16px;
    border-bottom: 1px solid #343a40;
}
/* navbar */
.navbar-sidha {
   margin-left: auto;
   padding-right: 10px;
}


/* Sidebar links */

.sidebar a {
    display: block;
    color: #dee2e6;
    padding: 14px 16px;
    text-decoration: none;
}

.sidebar a:hover {
    background: #343a40;
    color: white;
}

.sidebar a.active {
    background: #0d6efd;
    color: white;
}

/* Page content. The value of the margin-left property should match the value of the sidebar's width property */
div.content {
  margin-left: 200px;
  padding: 1px 16px;
  height: 1000px;
}
/* footer  */
.footer {
    background: #212529;
    color: #adb5bd;
    padding: 20px 30px;
    border-top: 1px solid #343a40;

    display: flex;
    justify-content: space-between;
    align-items: center;

    width: 100%;
    box-sizing: border-box;
}

.footer-left {
    display: flex;
    align-items: center;
    gap: 12px;
}

.footer-logo {
    width: 42px;
    height: 42px;

    display: flex;
    align-items: center;
    justify-content: center;

    background: #0d6efd;
    border-radius: 10px;

    font-size: 22px;
}

.footer-left h5 {
    margin: 0 0 4px 0;
    color: white;
    font-size: 16px;
}

.footer-left p {
    margin: 0;
    font-size: 13px;
    color: #adb5bd;
}

.footer-right {
    display: flex;
    align-items: center;
    gap: 10px;

    font-size: 13px;
}

.footer-divider {
    color: #495057;
}

/* Mobile */
@media (max-width: 768px) {


}

/* On screens that are less than 700px wide, make the sidebar into a topbar */
@media screen and (max-width: 700px) {
  .sidebar {
    width: 100%;
    height: auto;
    position: relative;
  }
  .sidebar a {float: left;}
  div.content {margin-left: 0;}
   .footer {
        flex-direction: column;
        gap: 15px;
        text-align: center;
    }

    .footer-left {
        justify-content: center;
    }

    .footer-right {
        justify-content: center;
        flex-wrap: wrap;
    }
}

/* On screens that are less than 400px, display the bar vertically, instead of horizontally */
@media screen and (max-width: 400px) {
  .sidebar a {
    text-align: center;
    float: none;
  }
}


    </style>

</head>
<body>
       @include('partials.navbar')

    <div class="dashboard">

        @include('partials.sidebar')

        <main class="main-content">

            @yield('content')

        </main>

    </div>

    @include('partials.footer')

</body>
</html>
