
<nav class="navbar navbar-expand-lg navbar-light bg-white shadow-sm rounded">
    <div class="container-fluid">
        <span class="navbar-brand">Hi, {{ Auth::user()->name }}</span>

        <div class="d-flex align-items-center">

            <input class="form-control me-2" type="search" placeholder="Search">

            <!-- Notification Icon -->
          <a href="#" class="btn btn-outline-primary me-2 position-relative">
              <i class="bi bi-bell"></i>

              <!-- Optional: notification count badge -->
              <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">
                  3
                  <span class="visually-hidden">unread messages</span>
              </span>
          </a>


            <!-- Profile Dropdown -->
            <div class="dropdown">
                <a href="#" class="d-flex align-items-center text-decoration-none dropdown-toggle"
                   id="profileDropdown"
                   data-bs-toggle="dropdown"
                   aria-expanded="false">
                    <img src="{{ Auth::user()->profile_image ? asset('storage/' . Auth::user()->profile_image) : 'https://via.placeholder.com/40' }}"
                         alt="Profile"
                         width="40"
                         height="40"
                         class="rounded-circle">
                </a>

                <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="profileDropdown">
                    <li>
                        <a class="dropdown-item" href="{{ route('profile.edit') }}">
                            <i class="bi bi-person-circle me-2"></i> Edit Profile
                        </a>
                    </li>
                    <li>
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button class="dropdown-item" type="submit">
                                <i class="bi bi-box-arrow-right me-2"></i> Sign Out
                            </button>
                        </form>
                    </li>
                </ul>
            </div>

        </div>
    </div>
</nav>
