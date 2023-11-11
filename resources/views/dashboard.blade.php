<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Staff Dashboard</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        body {
            background-color: #f5f5f5;
            font-family: 'Arial', sans-serif;
            color: #333;
        }

        .container {
            background-color: #fff;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        h2 {
            color: #007bff;
            text-align: center;
        }

        h3 {
            color: #28a745;
        }

        .card {
            margin-bottom: 20px;
        }

        .notification-card {
            background-color: #d4edda;
            border: 1px solid #c3e6cb;
            border-radius: 5px;
        }

        .no-notification-card {
            background-color: #f8d7da;
            border: 1px solid #f5c6cb;
            border-radius: 5px;
        }

        .page-card a {
            text-decoration: none;
            color: #007bff;
        }

        select,
        .btn-primary {
            border: 1px solid #007bff;
            border-radius: 5px;
            padding: 8px;
        }

        .btn-primary {
            background-color: #007bff;
            color: #fff;
            border: none;
            padding: 10px 20px;
            border-radius: 5px;
            cursor: pointer;
        }
    </style>
</head>

<body>
    <div class="container mt-5">
        <div class="card">
            <div class="card-body">
                <form action="{{ route('logout') }}" method="post">
                    @csrf
                    <button type="submit" class="btn btn-danger">Logout</button>
                </form>
            </div>
        </div>
        <div class="card mx-auto" style="max-width: 600px;">
            <h2 class="card-header">Dashboard</h2>

            <div class="card-body">
                @if(session('success'))
                <div>{{ session('success') }}</div>
                @endif

                <div class="card notification-card">
                    <h3 class="card-header">Notifications</h3>
                    <div class="card-body">
                        <ul class="list-group">
                            @forelse($notifications as $notification)
                            <li class="list-group-item notification">
                                <a href="{{ route($notification->page . '.page') }}">
                                    {{ $notification->created_at->format('M d, Y') }}:
                                    You have a new reference on the {{ $notification->page }} page
                                    from {{ $notification->sender->name }}.
                                </a>
                            </li>
                            @empty
                            <li class="list-group-item no-notification">No new notifications.</li>
                            @endforelse


                        </ul>
                    </div>
                </div>

                <div class="card page-card">
                    <h3 class="card-header">Pages</h3>
                    <div class="card-body">
                        <ul class="list-group">
                            <li class="list-group-item"><a href="{{ route('task.page') }}">Task Page</a></li>
                            <li class="list-group-item"><a href="{{ route('request.page') }}">Request Page</a></li>
                            <li class="list-group-item"><a href="{{ route('analysis.page') }}">Analysis Page</a></li>

                        </ul>
                    </div>
                </div>

                <div class="card">
                    <h3 class="card-header">Referencing</h3>
                    <div class="card-body">
                        <form action="{{ route('notify') }}" method="post" id="referenceForm">
                            @csrf
                            <label for="page">Select Page:</label>
                            <select name="page" id="page" class="form-control mb-3">
                                <option value="task">Task Page</option>
                                <option value="request">Request Page</option>
                                <option value="analysis">Analysis Page</option>
                            </select>

                            <label for="reference_staff">Select Staff:</label>
                            <select name="reference_staff" id="reference_staff" class="form-control mb-3">
                                @foreach($staffMembers as $staff)
                                <option value="{{ $staff->id }}">{{ $staff->name }}</option>
                                @endforeach
                            </select>

                            <button type="submit" class="btn btn-primary">Reference</button>
                        </form>
                    </div>
                </div>

            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>

</html>