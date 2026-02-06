<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hotel Aggregator | Best Deals</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <style>
        .hotel-card {
            transition: transform 0.3s ease, shadow 0.3s ease;
            border: none;
            border-radius: 15px;
        }
        .hotel-card:hover {
            transform: translateY(-10px);
            box-shadow: 0 10px 20px rgba(0,0,0,0.1) !important;
        }
        .price-tag {
            font-size: 1.5rem;
            font-weight: bold;
            color: #0d6efd;
        }
        .source-badge {
            font-size: 0.8rem;
            padding: 5px 12px;
            border-radius: 20px;
        }
        body {
            background-color: #f4f7f6;
        }
    </style>
</head>
<body>
    <div class="container py-5">
        <div class="text-center mb-5">
            <h1 class="display-4 fw-bold text-dark">Find Your Perfect Room</h1>
            <p class="lead text-muted">We compare prices from top advertisers to get you the best deal.</p>
        </div>

        <div id="loader" class="text-center py-5">
            <div class="spinner-grow text-primary" role="status" style="width: 3rem; height: 3rem;"></div>
            <p class="mt-3 fs-5 text-secondary">Searching across multiple providers...</p>
        </div>

        <div class="row g-4" id="hotel-list">
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
                        // تحديد لون مميز لكل مصدر
                        let badgeClass = room.source.includes('1') ? 'bg-primary' : 
                                       (room.source.includes('2') ? 'bg-success' : 'bg-dark');
                        
                        html += `
                            <div class="col-md-6 col-lg-4">
                                <div class="card h-100 shadow-sm hotel-card">
                                    <div class="card-body p-4">
                                        <div class="d-flex justify-content-between align-items-start mb-3">
                                            <h5 class="card-title fw-bold mb-0">${room.name}</h5>
                                            <span class="badge ${badgeClass} source-badge">
                                                <i class="fas fa-tag me-1"></i> ${room.source}
                                            </span>
                                        </div>
                                        <p class="text-muted mb-4">
                                            <i class="fas fa-key me-2"></i>Code: <strong>${room.room_code}</strong>
                                        </p>
                                        <div class="d-flex justify-content-between align-items-center mt-auto">
                                            <div class="price-tag">
                                                ${room.total_price} <small class="fs-6 fw-normal">EUR</small>
                                            </div>
                                            <button class="btn btn-outline-primary btn-sm rounded-pill px-3">View Deal</button>
                                        </div>
                                    </div>
                                </div>
                            </div>`;
                    });
                    $('#hotel-list').html(html);
                },
                error: function() {
                    $('#loader').html(`
                        <div class="alert alert-danger shadow-sm" role="alert">
                            <i class="fas fa-exclamation-triangle me-2"></i>
                            Failed to load hotel data. Please check your API connection.
                        </div>`);
                }
            });
        });
    </script>
</body>
</html>