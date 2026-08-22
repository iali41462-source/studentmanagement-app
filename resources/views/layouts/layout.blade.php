<!DOCTYPE html>
<html lang="en">
<head>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Student Management System</title>
    @viteReactRefresh
    @vite(['resources/css/app.css', 'resources/js/app.jsx'])
    <style>
body {
    margin: 0;
    padding: 0;
    background: #f5f6f8;
    overflow-x: hidden
}
/* navbar */
.navbar-sidha {
   margin-left: auto;
   padding-right: 10px;
}
.dashboard {
    display: flex;
    min-height: calc(100vh - 60px);
}
.main-content {
    flex: 1;
    padding: 25px;
    min-width: 0;
    text-align: center;
}

.sidebar {
    width: 220px;
    height: 100%;
    background: #212529;
}
.sidebar-title {
    color: white;
    font-size: 18px;
    font-weight: bold;
    padding: 20px 16px;
    border-bottom: 1px solid #343a40;
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

/* On screens that are less than 700px wide, make the sidebar into a topbar */
@media screen and (max-width: 700px) {
    .dashboard {
        flex-direction: column;
        border: 10px solid pink !important;
    }

    .sidebar {
        width: 100%;
        height: auto;
        position: relative;
    }

    .sidebar a {
        float: left;
    }

    .footer {
        flex-direction: column;
        gap: 15px;
        text-align: center;
    }
}
/* on screen ipad */
@media screen and (min-width: 701px) and (max-width: 1024px) {

    .dashboard {
        flex-direction: column;
    }

    .sidebar {
        width: 100%;
        height: auto;
    }

    .main-content {
        width: 100%;
        box-sizing: border-box;
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
    <div>
               @include('partials.navbar')
               </div>


    <div class="dashboard">

        @include('partials.sidebar')

        <main class="main-content">

            @yield('content')

        </main>

    </div>

    @include('partials.footer')

</body>
</html>
