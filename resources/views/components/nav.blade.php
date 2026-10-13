<nav class="navbar">
    <!-- Logo -->
    <div class="navbar-left">
        <a href="/" class="logo">Power Smile</a>
    </div>

    <!-- Mobile hamburger button -->
    <button class="mobile-menu-toggle"
            id="mobileMenuToggle"
            type="button"
            aria-label="Toggle navigation"
            aria-expanded="false">
        <i class="fa fa-bars"></i>
    </button>

    <!-- Navigation links -->
    <div class="navbar-menu" id="navbarMenu">

        <!-- Master Control -->
        <div class="drop-down">
            <button class="dropbtn" type="button">
                Master Control <i class="fa fa-caret-down"></i>
            </button>

            <div class="dropdown-content">
                <a href="{{ route('alergy.index') }}">Alergy</a>
                <a href="{{ route('brand.index') }}">Brand</a>
                <a href="{{ route('category.index') }}">Category</a>
                <a href="{{ route('center.index') }}">Center</a>
                <a href="{{ route('disease.index') }}">Disease</a>
                <a href="{{ route('doctor.index') }}">Doctor</a>
                <a href="{{ route('drug-frequency.index') }}">Drug Frequency</a>
                <a href="{{ route('laboratory-expense.index') }}">Laboratory Expense</a>
                <a href="{{ route('orthodontic-plan.index') }}">Orthodontic Plan</a>
                <a href="{{ route('patient-type.index') }}">Patient Types</a>
                <a href="{{ route('product-type.index') }}">Product Types</a>
                <a href="{{ route('supplier.index') }}">Supplier</a>
                <a href="{{ route('template-type.index') }}">Template Type</a>
                <a href="{{ route('template-category.index') }}">Template Category</a>
                <a href="{{ route('leave-request.index') }}">Leave Request</a>
            </div>
        </div>

        <!-- Product & Inventory -->
        <div class="drop-down">
            <button class="dropbtn" type="button">
                Product & Inventory <i class="fa fa-caret-down"></i>
            </button>

            <div class="dropdown-content">
                <a href="{{ route('product.index') }}">Products</a>
            </div>
        </div>

        <!-- Patient -->
        <div class="drop-down">
            <button class="dropbtn" type="button">
                Patient <i class="fa fa-caret-down"></i>
            </button>

            <div class="dropdown-content">
                <a href="{{ route('patient.index') }}">Patient</a>
                <a href="{{ route('appointment.index') }}">Appointment</a>
                <a href="{{ route('medical.index') }}">Medical Report</a>
                <a href="{{ route('leave.index') }}">Leave Request Letter</a>
            </div>
        </div>

        <!-- Template -->
        <div class="drop-down">
            <button class="dropbtn" type="button">
                Template <i class="fa fa-caret-down"></i>
            </button>

            <div class="dropdown-content">
                <a href="{{ route('template.index') }}">Templates</a>
            </div>
        </div>
    </div>

    <!-- User profile -->
    <div class="navbar-right">
        <div class="online">
            <button type="button"
                    class="profile-toggle"
                    id="profileToggle"
                    aria-label="Toggle profile menu"
                    aria-expanded="false">
                <img src="{{ asset('images/user-4.png') }}"
                     class="nav-profile-img"
                     alt="User profile">
            </button>
        </div>

        <div class="sub-menu-wrap" id="subMenu">
            <div class="sub-menu">
                <div class="user-info">
                    <img src="{{ asset('images/user-4.png') }}" alt="User">
                    <span>{{ Auth::user()->name ?? '' }}</span>
                </div>

                <hr>

                <a href="{{ url('/logout') }}"
                   class="sub-menu-link"
                   onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                    <img src="{{ asset('images/logout.png') }}" alt="">
                    <p>Logout</p>
                </a>

                <form id="logout-form"
                      action="{{ url('/logout') }}"
                      method="POST"
                      style="display: none;">
                    {{ csrf_field() }}
                </form>
            </div>
        </div>
    </div>
</nav>



@push('js')
<script>
document.addEventListener('DOMContentLoaded', function () {
    const menuToggle = document.getElementById('mobileMenuToggle');
    const navbarMenu = document.getElementById('navbarMenu');
    const profileToggle = document.getElementById('profileToggle');
    const subMenu = document.getElementById('subMenu');
    const dropdowns = document.querySelectorAll('.navbar .drop-down');

    // Hamburger menu
    menuToggle.addEventListener('click', function () {
        const isOpen = navbarMenu.classList.toggle('open');

        menuToggle.setAttribute('aria-expanded', isOpen);
        menuToggle.innerHTML = isOpen
            ? '<i class="fa fa-times"></i>'
            : '<i class="fa fa-bars"></i>';
    });

    // Navigation dropdowns
    dropdowns.forEach(function (dropdown) {
        const button = dropdown.querySelector('.dropbtn');

        button.addEventListener('click', function (event) {
            event.stopPropagation();

            const wasOpen = dropdown.classList.contains('open');

            // Close other dropdowns
            dropdowns.forEach(function (item) {
                item.classList.remove('open');
            });

            // Toggle the selected dropdown
            if (!wasOpen) {
                dropdown.classList.add('open');
            }
        });
    });

    // User profile dropdown
    profileToggle.addEventListener('click', function (event) {
        event.stopPropagation();

        const isOpen = subMenu.classList.toggle('open');
        profileToggle.setAttribute('aria-expanded', isOpen);
    });

    // Close menus when clicking outside
    document.addEventListener('click', function (event) {
        if (!event.target.closest('.navbar')) {
            dropdowns.forEach(function (dropdown) {
                dropdown.classList.remove('open');
            });

            subMenu.classList.remove('open');
            profileToggle.setAttribute('aria-expanded', 'false');
        }
    });

    // Close mobile navigation after selecting a link
    navbarMenu.querySelectorAll('.dropdown-content a').forEach(function (link) {
        link.addEventListener('click', function () {
            navbarMenu.classList.remove('open');
            menuToggle.setAttribute('aria-expanded', 'false');
            menuToggle.innerHTML = '<i class="fa fa-bars"></i>';

            dropdowns.forEach(function (dropdown) {
                dropdown.classList.remove('open');
            });
        });
    });

    // Reset mobile-specific menu state when returning to desktop
    window.addEventListener('resize', function () {
        if (window.innerWidth > 992) {
            navbarMenu.classList.remove('open');
            menuToggle.setAttribute('aria-expanded', 'false');
            menuToggle.innerHTML = '<i class="fa fa-bars"></i>';

            dropdowns.forEach(function (dropdown) {
                dropdown.classList.remove('open');
            });
        }
    });
});
</script>
@endpush


