<nav class="navbar">
    <div class="navbar-left">
        <a href="/" class="logo">Power Smile</a>
    </div>

    <div class="navbar-menu ">
        <div class="drop-down">
            <button class="dropbtn">
                Master Control
                &nbsp; <i class="fa fa-caret-down"></i>
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
        
        <div class="drop-down">
            <button class="dropbtn">
                Product & Inventory
                &nbsp; <i class="fa fa-caret-down"></i>
            </button>
            <div class="dropdown-content">
                <a href="{{ route('product.index') }}">Products</a>
            </div>
        </div>
        
        <div class="drop-down">
            <button class="dropbtn">
                Patient
                &nbsp; <i class="fa fa-caret-down"></i>
            </button>
            <div class="dropdown-content">
                <a href="{{ route('patient.index') }}">Patient</a>
                <!-- <a href="{{ route('next-visit.index') }}">Patient Next Visit</a> -->
                <a href="{{ route('appointment.index') }}">Appoinment</a>
                <a href="{{ route('medical.index') }}">Medical Report</a>
                <a href="{{ route('leave.index') }}">Leave Request Letter</a>
            </div>
        </div>
        
        <div class="drop-down">
            <button class="dropbtn">
                Template
                &nbsp; <i class="fa fa-caret-down"></i>
            </button>
            <div class="dropdown-content">
                <a href="{{ route('template.index') }}">Templates</a>
            </div>
        </div>
    </div>

    <div class="navbar-right">
        <div class="online">
            <img src="{{ asset('images/user-4.png') }}" class="nav-profile-img dropdown" onclick="toggleMenu()">
        </div>

        <div class="sub-menu-wrap" id="subMenu">
            <div class="sub-menu">
                <div class="user-info">
                    <img src="{{ asset('images/user-4.png') }}">
                    {{ Auth::user()->name ?? '' }}
                </div>
                <hr>
                <a href="{{ url('/logout') }}" class="sub-menu-link"
                    onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                    <img src="{{ asset('images/logout.png') }}">
                    <p>Logout</p>
                </a>
                <form id="logout-form" action="{{ url('/logout') }}" method="POST" style="display: none;">
                    {{ csrf_field() }}
                </form>
            </div>
        </div>
    </div>
</nav>
