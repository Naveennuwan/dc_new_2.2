@extends('layouts.app')

@section('content')
    <div class="invoice-home">
        <div class="logo-box">
            <img src="{{ asset('images/logo2.png') }}" alt="Power Smile Logo">
        </div>

        <div class="menu-buttons">
            <a href="{{ route('invoice.routine') }}" class="menu-btn">
                <i class="fas fa-file-invoice"></i>
                <span>Routine Invoice</span>
            </a>

            <a href="{{ route('invoice.orthodontic') }}" class="menu-btn">
                <i class="fas fa-tooth"></i>
                <span>Orthodontic Invoice</span>
            </a>

            <a href="{{ route('appointment.index') }}" class="menu-btn">
                <i class="fas fa-calendar-check"></i>
                <span>Appointment</span>
            </a>
        </div>
    </div>
@endsection

@push('css')
    <style>
        .invoice-home {
            width: 100%;
            max-width: 1200px;
            margin: 30px auto;
            padding: clamp(20px, 5vw, 80px) clamp(15px, 4vw, 50px);
            background: #fff;
            border-radius: 10px;
            box-sizing: border-box;
            text-align: center;
        }

        .logo-box {
            display: flex;
            justify-content: center;
            align-items: center;
            margin-bottom: 35px;
        }

        .logo-box img {
            display: block;
            width: 100%;
            max-width: 420px;
            max-height: 220px;
            height: auto;
            object-fit: contain;
        }

        .menu-buttons {
            display: grid;
            grid-template-columns: repeat(2, minmax(0, 350px));
            justify-content: center;
            gap: 20px;
        }

        .menu-btn {
            min-height: 90px;
            padding: 15px 20px;
            box-sizing: border-box;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 12px;

            border: 2px solid #ccc;
            border-radius: 8px;
            background: #fff;
            box-shadow: 0 3px 10px rgba(0, 0, 0, 0.10);

            color: #5f5f5f;
            font-size: 20px;
            font-weight: 700;
            text-align: center;
            text-decoration: none;

            transition: background-color 0.2s ease,
                        color 0.2s ease,
                        transform 0.2s ease;
        }

        .menu-btn i {
            font-size: 24px;
            flex-shrink: 0;
        }

        .menu-btn:hover {
            color: #c14829;
            background: #fafafa;
            border-color: #c14829;
            transform: translateY(-2px);
            text-decoration: none;
        }

        .menu-btn:focus-visible {
            outline: 3px solid #c14829;
            outline-offset: 3px;
        }

        /* Tablets */
        @media (max-width: 768px) {
            .invoice-home {
                margin: 15px auto;
                padding: 35px 20px;
            }

            .logo-box {
                margin-bottom: 25px;
            }

            .logo-box img {
                max-width: 320px;
                max-height: 180px;
            }

            .menu-buttons {
                grid-template-columns: repeat(2, minmax(0, 1fr));
                gap: 15px;
            }

            .menu-btn {
                min-height: 80px;
                padding: 12px;
                font-size: 17px;
            }

            .menu-btn i {
                font-size: 21px;
            }
        }

        /* Mobile phones */
        @media (max-width: 576px) {
            .invoice-home {
                margin: 10px auto;
                padding: 25px 15px;
                border-radius: 6px;
            }

            .logo-box {
                margin-bottom: 25px;
            }

            .logo-box img {
                max-width: 260px;
                max-height: 150px;
            }

            .menu-buttons {
                grid-template-columns: minmax(0, 1fr);
                gap: 12px;
            }

            .menu-btn {
                width: 100%;
                min-height: 70px;
                padding: 15px;
                font-size: 18px;
            }

            .menu-btn i {
                font-size: 22px;
            }
        }

        /* Very small phones */
        @media (max-width: 360px) {
            .invoice-home {
                padding: 20px 10px;
            }

            .menu-btn {
                min-height: 65px;
                font-size: 16px;
                gap: 9px;
            }
        }
    </style>
@endpush
