<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Hotel Aggregator</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>
<body class="bg-light">
    <div class="container mt-5">
        <h2 class="text-center mb-4">Available Hotel Rooms</h2>
        <div id="loader" class="text-center">
            <div class="spinner-border text-primary" role="status"></div>
            <p>Fetching best prices...</p>
        </div>
        <div class="row" id="hotel-list">
            </div>
    </div>

    <script>
        $(document).ready(function() {
            $.ajax({
                url: '/api/hotels',
                method: 'GET',
                success: function(response) {
                    $('#loader').hide();
                    let html = '';
                    response.data.forEach(room => {
                        html += `
                            <div class="col-md-4 mb-3">
                                <div class="card h-100 shadow-sm">
                                    <div class="card-body">
                                        <h5 class="card-title">${room.name}</h5>
                                        <p class="card-text text-muted">Room Code: ${room.room_code}</p>
                                        <h4 class="text-primary">${room.total_price} EUR</h4>
                                        <span class="badge bg-info text-dark">Source: ${room.source}</span>
                                    </div>
                                </div>
                            </div>`;
                    });
                    $('#hotel-list').html(html);
                },
                error: function() {
                    $('#loader').html('<p class="text-danger">Failed to load data. Please try again.</p>');
                }
            });
        });
    </script>
</body>
</html>