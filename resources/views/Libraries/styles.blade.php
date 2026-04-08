<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css"
    integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css" rel="stylesheet">
<link rel="stylesheet" type="text/css"
    href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.3/css/bootstrap.css">

<link rel="stylesheet" href="{{ asset('css/navbar.css') }}">
<link rel="stylesheet" href="{{ asset('css/custom.css') }}">

<!-- Include DataTables CSS (adjust the path accordingly) -->
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.11.5/css/dataTables.bootstrap4.min.css">


<!-- Include Select2 CSS (update version to the latest stable) -->
<link href="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/css/select2.min.css" rel="stylesheet" />

<!-- Include Toastr CSS -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">

<style>
    .form-control:focus {
        color: #495057;
        background-color: #fff;
        border-color: #5A5A5A;
        outline: 0;
        box-shadow: 0 0 0 0.2rem #ccc;
    }

    .page-link {
        position: relative;
        display: block;
        padding: 0.5rem 0.75rem;
        margin-left: -1px;
        line-height: 1.25;
        color: #343a40;
        background-color: #fff;
        border: 1px solid #dee2e6;
    }

    .page-item.active .page-link {
        z-index: 1;
        color: #646464;
        background-color: #9b9b9b77;
        border-color: #9b9b9b77;
    }

    .page-item.active .page-link:focus {
        border-color: #5A5A5A;
        outline: 0;
        box-shadow: 0 0 0 0.2rem #ccc;
    }

    .page-link:hover {
        z-index: 2;
        color: #B39354;
        text-decoration: none;
        background-color: #e9ecef;
        border-color: #dee2e6;
    }

    .table thead th {
        background-color: #3e515f;
        color: #ffffff;
        vertical-align: bottom;
        border-bottom: 2px solid #dee2e6;
    }

    .navbar{
        display: flex;
        align-items: center;
        flex-wrap: wrap;
        gap: 10px;
        justify-content: space-between;
        background: #fff;
        padding: 6px 6%;
        margin-bottom:15px;
        position: sticky;
        top: 0;
        z-index: 100;
        box-shadow: 0 5px 10px rgba(0, 0, 0, 0.1);
    }

    .logo img{
        width: 204px;
        height: 54px;
        margin-right: 15px;
        display: block;
    }

    .navbar-home{
        display: flex;
        align-items: center;
        font-size: 14px;
        margin: 5px 8px;
        padding-right: 5px;
        position: relative;
    }

    .navbar-home img{
        width: 30px;
    }

    .navbar-menu{
        margin-left: 15px;
        flex-grow: 1;
    }

    .navbar .navbar-menu .drop-down {
        float: left;
        overflow: hidden;
        margin-block: auto;
        background: #fff;
    }

    .navbar .navbar-menu .drop-down a{
        text-decoration: none;
        color: #5A5A5A;
    }

    .navbar .navbar-menu .drop-down .dropbtn {
        font-size: 14px;
        font-weight: 700;
        border: none;
        outline: none;
        color: #5A5A5A;
        padding: 14px 16px;
        background-color: inherit;
        font-family: inherit;
        margin: 0;
    }

    .navbar .navbar-menu .drop-down .dropdown-content {
        display: none;
        position: absolute;
        background-color: #f9f9f9;
        min-width: 160px;
        box-shadow: 0px 8px 16px 0px rgba(0, 0, 0, 0.2);
        z-index: 1;
    }

    .navbar .navbar-menu .drop-down .dropdown-content a {
        float: none;
        font-size: 14px;
        color: #5A5A5A;
        padding: 12px 16px;
        text-decoration: none;
        display: block;
        text-align: left;
    }

    .navbar .navbar-menu .drop-down .dropbtn a:hover,
    .navbar .navbar-menu .drop-down:hover .dropbtn {
        background-color: #ccc;
        color: #c14829;
    }

    .navbar .dropdown-icon-right:hover .dropbtn {
        padding-block: 4px;
    }

    .navbar .navbar-menu .drop-down .dropdown-content a:hover {
        background-color: #ddd;
        color: #c14829;
    }

    .navbar .drop-down:hover .dropdown-content {
        display: block;
    }

    .nav-profile-img{
        width: 40px;
        border-radius: 50%;
        display: block;
        cursor: pointer;
        position: relative;
    }

    .online{
        position: relative;

    }
    .online::after{
        content: '';
        width: 10px;
        height: 10px;
        border: 2px solid #fff;
        border-radius: 50%;
        right: 0px;
        top: 0px;
        background-color: #41db51;
        position: absolute;
    }

    .sub-menu-wrap{
        position: absolute;
        top: 90%;
        right: 5%;
        width: 320px;
        max-height: 0px;
        overflow: hidden;
        transition: max-height 0.5s;
    }

    .sub-menu-wrap.open-menu{
        max-height: 400px;
    }

    .sub-menu{
        background: #f9f9f9;
        padding: 20px;
        margin: 10px;
        box-shadow: 0px 5px 5px 0px rgba(0, 0, 0, 0.2);
    }

    .user-info{
        display: flex;
        align-items: center;
    }

    .user-info h3{
        font-weight: 500;
    }

    .user-info img{
        width: 50px;
        border-radius: 50%;
        margin-right: 15px;
    }

    .user-info span{
        display: flex;
        align-items: center;
        flex-wrap: wrap;
        height: 50px;
        background-color: #ccc;
        padding: 10px;
        margin-right: 5px;
        color: #5A5A5A;
        border-radius: 5px;
        font-weight: 600;
    }

    .sub-menu hr{
        border: 0;
        height: 1px;
        width: 100%;
        background: #ccc;
        margin: 15px 0 10px;
    }

    .sub-menu-link{
        display: flex;
        align-items: center;
        text-decoration: none;
        color: #525252;
        margin: 12px 0;
        background-color:transparent;
    }

    .sub-menu-link p{
        width: 100%;
        font-size: 14px;
    }

    .sub-menu-link img{
        width: 15%;
        background: #e5e5e5;
        border-radius: 50%;
        padding: 8px;
        margin-right: 15px;
    }


    .sub-menu-link:hover p{
        font-weight: 600;
    }

    .sub-menu a:hover{
        text-decoration: none;
        background-color: #f9f9f9;
        color: #c14829;
    }

    .sub-menu-link:hover span{
        transform: translateX(5px);
    }
    
    @media screen and (max-width: 768px) {
        .navbar {
            flex-direction: column;
            align-items: flex-start;
            padding: 10px;
        }

        .navbar-home {
            margin: 10px 0;
        }

        .navbar-menu {
            margin: 10px 0;
        }

        .navbar .navbar-menu .drop-down {
            float: none;
            width: 100%;
        }
    }


/* perfect */

.modern-toolbar-title {
    font-size: 1.2rem;
    color: #4a4a4a;
}.toolbar-3d-title {
    text-shadow: 1px 1px 2px rgba(0, 0, 0, 0.3), 2px 2px 5px rgba(0, 0, 0, 0.2);
    font-size: 1.4rem;
}


.modern-btn {
    font-weight: bold;
    /* padding: 12px 24px; */
    border: none;
    border-radius: 10px;
    display: flex;
    align-items: center;
    justify-content: center;
    /* height: 30px; */
    
    transition: all 0.3s ease-in-out;
    box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1), 0 1px 3px rgba(0, 0, 0, 0.06);
    color: #fff;
    cursor: pointer;
    text-decoration:none;
    margin: 3px;
}

.btn-emerald {
    background: linear-gradient(135deg, #6dd5ed 0%, #2193b0 100%);
    color: #ffffff;
}

.btn-emerald:hover {
    background: linear-gradient(135deg, #2193b0 0%, #6dd5ed 100%);
    transform: scale(1.05);
}

.btn-sapphire {
    background: linear-gradient(135deg, #6a11cb 0%, #2575fc 100%);
    color: #ffffff;
}

.btn-sapphire:hover {
    background: linear-gradient(135deg, #2575fc 0%, #6a11cb 100%);
    transform: scale(1.05);
}

.btn-amber {
    background: linear-gradient(135deg, #f7971e 0%, #ffd200 100%);
    color: #4a2900;
}

.btn-amber:hover {
    background: linear-gradient(135deg, #ffd200 0%, #f7971e 100%);
    transform: scale(1.05);
}

.btn-amethyst {
    background: linear-gradient(135deg, #9b59b6 0%, #8e44ad 100%);
    color: #ffffff;
}

.btn-amethyst:hover {
    background: linear-gradient(135deg, #8e44ad 0%, #9b59b6 100%);
    transform: scale(1.05);
}

.btn-coral {
    background: linear-gradient(135deg, #ff6f61 0%, #de425b 100%);
    color: #ffffff; 
}

.btn-coral:hover {
    background: linear-gradient(135deg, #de425b 0%, #ff6f61 100%);
    transform: scale(1.05);
}

.btn-azure {
    background: linear-gradient(135deg, #56ccf2 0%, #2f80ed 100%);
    color: #ffffff;
}

.btn-azure:hover {
    background: linear-gradient(135deg, #2f80ed 0%, #56ccf2 100%);
    transform: scale(1.05);
}

.btn-peach {
    background: linear-gradient(135deg, #ff9a8b 0%, #ff6a88 100%);
    color: #ffffff; 
}

.btn-peach:hover {
    background: linear-gradient(135deg, #ff6a88 0%, #ff9a8b 100%);
    transform: scale(1.05);
}

.btn-lime {
    background: linear-gradient(135deg, #a8e063 0%, #56ab2f 100%);
    color: #ffffff; 
}

.btn-lime:hover {
    background: linear-gradient(135deg, #56ab2f 0%, #a8e063 100%);
    transform: scale(1.05);
}

.btn-rose {
    background: linear-gradient(135deg, #ff758c 0%, #ff7eb3 100%);
    color: #ffffff; 
}

.btn-rose:hover {
    background: linear-gradient(135deg, #ff7eb3 0%, #ff758c 100%);
    transform: scale(1.05);
}

.btn-aqua {
    background: linear-gradient(135deg, #3a7bd5 0%, #00d2ff 100%);
    color: #ffffff; 
}

.btn-aqua:hover {
    background: linear-gradient(135deg, #00d2ff 0%, #3a7bd5 100%);
    transform: scale(1.05);
}

.btn-gray {
    background: linear-gradient(to right, #a0a0a0, #c0c0c0);
    color: #f8f8f8;
    cursor: not-allowed;
}

.btn-gray:hover {
    background: linear-gradient(to right, #909090, #b0b0b0);
    transform: none;
    box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
}

.fixed-width-button-130 {
    width: 130px;
}

.fixed-width-button-120 {
    width: 120px;
}

.fixed-width-button-100 {
    width: 100px;
}
   
</style>

@stack('css')
