{{-- <div class="row">
    <div class="col-md-12"> --}}

        <nav class="navbar navbar-expand-lg navbar-dark bg-dark shadow-sm">

            <div class="col-sm-6">
               <a class="navbar-brand fw-bold" href="{{ url('/') }}">
                🎓 Student Management
            </a>
             </div>
            {{-- Logo / Brand --}}


            {{-- Mobile button --}}
            <div>
                  <button
                class="navbar-toggler"
                type="button"
                data-toggle="collapse"
                data-target="#navbarContent"
                aria-controls="navbarContent"
                aria-expanded="false"
                aria-label="Toggle navigation"
            >
                <span class="navbar-toggler-icon"></span>
            </button>
            </div>



            <div class="collapse navbar-collapse" id="navbarContent">

                {{-- Right side --}}
                <ul class="navbar-nav ml-auto align-items-center navbar-sidha" style="">

                    {{-- Search form --}}

                    @auth

                        {{-- User name --}}
                        <li class="nav-item">
                            <span class="navbar-text text-white mr-3">
                                👤 {{ Auth::user()->name }}
                            </span>
                        </li>

                        {{-- Logout --}}
                        <li class="nav-item">
                            <form
                                action="{{ route('logout') }}"
                                method="POST"
                                class="mb-0"
                            >
                                @csrf

                                <button
                                    type="submit"
                                    class="btn btn-outline-light btn-sm"
                                >
                                    Logout
                                </button>
                            </form>
                        </li>

                    @endauth

                    @guest

                        <li class="nav-item">
                            <a
                                href="{{ route('login') }}"
                                class="btn btn-primary btn-sm"
                            >
                                Login
                            </a>
                        </li>

                    @endguest

                </ul>

            </div>

        </nav>

    </div>

