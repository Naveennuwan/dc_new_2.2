@extends('layouts.guest')

@section('content')
<div class="container">

    <!-- LEFT SIDE -->
    <div class="left">
        <!-- Replace with your logo -->
        <img src="{{ asset('images/logo2.png') }}" alt="Clinic Logo">
    </div>

    <!-- RIGHT SIDE -->
    <div class="right">

        <!-- ONGOING PATIENT -->
        <div class="card ongoing">
            <div class="title">Now Serving</div>
            <h1>{{ optional($routineOngoing)->appointment_no ?? '--' }}</h1>
            <div class="status">{{ optional($routineOngoing)->name ?? 'No patient ongoing' }}</div>
        </div>

        <!-- NEXT PATIENT -->
        <div class="card next">
            <div class="title">Next Patient</div>
            <h2>{{ optional($routineNext)->appointment_no ?? '--' }}</h2>
            <div class="status">{{ optional($routineNext)->name ? optional($routineNext)->name . ' - Ongoing' : 'No patient ongoing' }}</div>
        </div>

        <!-- UPCOMING LIST -->
        <div class="card">
            <div class="title">Upcoming Queue</div>

            <table>
                <thead>
                    <tr>
                        <th>Queue No</th>
                        <th>Name</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($routineQueue as $row)
                    <tr>
                        <td class="queue-number">{{ $row->appointment_no ?? '--' }}</td>
                        <td>{{ $row->name ?? optional($row->patient)->name ?? '-' }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>

        </div>

    </div>

<!-- RIGHT SIDE -->
<div class="right">

    <!-- ONGOING PATIENT -->
    <div class="card ongoing">
        <div class="title">Now Serving</div>
        <h1>{{ optional($orthoOngoing)->appointment_no ?? '--' }}</h1>
        <div class="status">{{ optional($orthoOngoing)->name ?? 'No patient ongoing' }}</div>
    </div>

    <!-- NEXT PATIENT -->
    <div class="card next">
        <div class="title">Next Patient</div>
        <h2>{{ optional($orthoNext)->appointment_no ?? '--' }}</h2>
        <div class="status">{{ optional($orthoNext)->name ? optional($orthoNext)->name . ' - Ongoing' : 'No patient ongoing' }}</div>
    </div>

    <!-- UPCOMING LIST -->
    <div class="card">
        <div class="title">Upcoming Queue</div>

        <table>
            <thead>
                <tr>
                    <th>Queue No</th>
                    <th>Name</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($orthoQueue as $row)
                <tr>
                    <td class="queue-number">{{ $row->appointment_no ?? '--' }}</td>
                    <td>{{ $row->name ?? optional($row->patient)->name ?? '-' }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>

    </div>

</div>

</div>
@endsection

@push('css')
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Segoe UI', sans-serif;
        }

        body {
            background: #0f172a;
            color: #fff;
            height: 100vh;
            overflow: hidden;
        }

        .container {
            display: flex;
            height: 100vh;
        }

        /* LEFT SIDE */
        .left {
            width: 40%;
            display: flex;
            justify-content: center;
            align-items: center;
            border-right: 2px solid #1e293b;
        }

        .left img {
            width: 100%;
            max-height: 80%;
            object-fit: contain;
        }

        /* RIGHT SIDE */
        .right {
            width: 60%;
            padding: 10px;
            display: flex;
            flex-direction: column;
            gap: 20px;
        }

        .card {
            background: #1e293b;
            border-radius: 16px;
            padding: 20px;
            box-shadow: 0 10px 25px rgba(0,0,0,0.3);
        }

        .title {
            font-size: 20px;
            margin-bottom: 10px;
            opacity: 0.8;
        }

        /* ONGOING */
        .ongoing {
            background: linear-gradient(135deg, #dc2626, #b91c1c);
        }

        .ongoing h1 {
            font-size: 50px;
        }

        /* NEXT */
        .next {
            background: linear-gradient(135deg, #f59e0b, #d97706);
        }

        .next h2 {
            font-size: 35px;
        }

        /* TABLE */
        table {
            width: 100%;
            border-collapse: collapse;
        }

        table th, table td {
            padding: 12px;
            text-align: left;
        }

        table thead {
            background: #334155;
        }

        table tbody tr:nth-child(even) {
            background: #1e293b;
        }

        table tbody tr:nth-child(odd) {
            background: #0f172a;
        }

        .queue-number {
            font-size: 28px;
            font-weight: bold;
        }

        .status {
            font-size: 16px;
            opacity: 0.9;
        }
    </style>
@endpush

@push('js')
<script>
    console.log("Auto refresh script loaded");

    setTimeout(function () {
        location.reload(true);
    }, 10000);
</script>
@endpush
