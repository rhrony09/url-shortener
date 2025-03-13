@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-10">
                <div class="d-flex justify-content-between align-items-center mb-4">
                    <h1 class="h2 mb-0">URL Dashboard</h1>
                    <a href="{{ route('home') }}" class="btn brand-btn">Create New URL</a>
                </div>

                @if (session('success'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        {{ session('success') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif

                @if (session('error'))
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        {{ session('error') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif

                <div class="card shadow-sm border-0 rounded-3">
                    <div class="card-header bg-white py-3">
                        <div class="row align-items-center">
                            <div class="col">
                                <h5 class="mb-0">All Shortened URLs</h5>
                            </div>
                            <div class="col-auto">
                                <form action="{{ route('dashboard') }}" method="GET" class="d-flex">
                                    <input type="text" name="search" class="form-control me-2"
                                        placeholder="Search URLs..." value="{{ request('search') }}">
                                    <button type="submit" class="btn brand-btn">Search</button>
                                </form>
                            </div>
                        </div>
                    </div>
                    <div class="card-body p-0">
                        @if ($urls->count() > 0)
                            <div class="table-responsive">
                                <table class="table table-hover table-striped mb-0">
                                    <thead class="table-light">
                                        <tr>
                                            <th>Original URL</th>
                                            <th>Short URL</th>
                                            <th>Slug</th>
                                            <th>Clicks</th>
                                            <th>Created</th>
                                            <th>Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($urls as $url)
                                            <tr>
                                                <td>
                                                    <div class="d-flex align-items-center">
                                                        <div class="url-favicon me-2">
                                                            <img src="https://www.google.com/s2/favicons?domain={{ parse_url($url->original_url, PHP_URL_HOST) }}"
                                                                alt="favicon" width="16" height="16">
                                                        </div>
                                                        <div class="text-truncate" style="max-width: 250px;"
                                                            title="{{ $url->original_url }}">
                                                            <a href="{{ $url->original_url }}" target="_blank"
                                                                class="text-decoration-none">
                                                                {{ $url->original_url }}
                                                            </a>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="input-group input-group-sm">
                                                        <input type="text" class="form-control"
                                                            value="{{ route('redirect', $url->slug) }}"
                                                            id="url-{{ $url->id }}" readonly>
                                                        <button class="btn brand-btn copy-btn" type="button"
                                                            data-clipboard-target="#url-{{ $url->id }}">
                                                            <svg xmlns="http://www.w3.org/2000/svg" width="16"
                                                                height="16" fill="currentColor" class="bi bi-clipboard"
                                                                viewBox="0 0 16 16">
                                                                <path
                                                                    d="M4 1.5H3a2 2 0 0 0-2 2V14a2 2 0 0 0 2 2h10a2 2 0 0 0 2-2V3.5a2 2 0 0 0-2-2h-1v1h1a1 1 0 0 1 1 1V14a1 1 0 0 1-1 1H3a1 1 0 0 1-1-1V3.5a1 1 0 0 1 1-1h1v-1z" />
                                                                <path
                                                                    d="M9.5 1a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-.5.5h-3a.5.5 0 0 1-.5-.5v-1a.5.5 0 0 1 .5-.5h3zm-3-1A1.5 1.5 0 0 0 5 1.5v1A1.5 1.5 0 0 0 6.5 4h3A1.5 1.5 0 0 0 11 2.5v-1A1.5 1.5 0 0 0 9.5 0h-3z" />
                                                            </svg>
                                                        </button>
                                                    </div>
                                                </td>
                                                <td><code>{{ $url->slug }}</code></td>
                                                <td>
                                                    <span class="badge bg-primary rounded-pill">{{ $url->clicks }}</span>
                                                </td>
                                                <td>{{ $url->created_at->format('M d, Y') }}</td>
                                                <td>
                                                    <div class="btn-group">
                                                        <a href="{{ route('redirect', $url->slug) }}" target="_blank"
                                                            class="btn btn-sm btn-outline-secondary" title="Open URL">
                                                            <svg xmlns="http://www.w3.org/2000/svg" width="16"
                                                                height="16" fill="currentColor"
                                                                class="bi bi-box-arrow-up-right" viewBox="0 0 16 16">
                                                                <path fill-rule="evenodd"
                                                                    d="M8.636 3.5a.5.5 0 0 0-.5-.5H1.5A1.5 1.5 0 0 0 0 4.5v10A1.5 1.5 0 0 0 1.5 16h10a1.5 1.5 0 0 0 1.5-1.5V7.864a.5.5 0 0 0-1 0V14.5a.5.5 0 0 1-.5.5h-10a.5.5 0 0 1-.5-.5v-10a.5.5 0 0 1 .5-.5h6.636a.5.5 0 0 0 .5-.5z" />
                                                                <path fill-rule="evenodd"
                                                                    d="M16 .5a.5.5 0 0 0-.5-.5h-5a.5.5 0 0 0 0 1h3.793L6.146 9.146a.5.5 0 1 0 .708.708L15 1.707V5.5a.5.5 0 0 0 1 0v-5z" />
                                                            </svg>
                                                        </a>
                                                        <button type="button"
                                                            class="btn btn-sm btn-outline-secondary view-details"
                                                            data-url-id="{{ $url->id }}" title="View Details">
                                                            <svg xmlns="http://www.w3.org/2000/svg" width="16"
                                                                height="16" fill="currentColor"
                                                                class="bi bi-bar-chart-line" viewBox="0 0 16 16">
                                                                <path
                                                                    d="M11 2a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1v12h.5a.5.5 0 0 1 0 1H.5a.5.5 0 0 1 0-1H1v-3a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1v3h1V7a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1v7h1V2zm1 12h2V2h-2v12zm-3 0V7H7v7h2zm-5 0v-3H2v3h2z" />
                                                            </svg>
                                                        </button>
                                                        <form action="{{ route('urls.delete', $url->id) }}" method="POST"
                                                            class="d-inline delete-url-form"
                                                            id="delete-form-{{ $url->id }}">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button type="submit" class="btn btn-sm btn-outline-danger"
                                                                title="Delete URL">
                                                                <svg xmlns="http://www.w3.org/2000/svg" width="16"
                                                                    height="16" fill="currentColor" class="bi bi-trash"
                                                                    viewBox="0 0 16 16">
                                                                    <path
                                                                        d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0V6z" />
                                                                    <path fill-rule="evenodd"
                                                                        d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1v1zM4.118 4 4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4H4.118zM2.5 3V2h11v1h-11z" />
                                                                </svg>
                                                            </button>
                                                        </form>
                                                    </div>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                            <div class="p-3">
                                {{ $urls->links() }}
                            </div>
                        @else
                            <div class="text-center p-5">
                                <div class="mb-3">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="48" height="48"
                                        fill="currentColor" class="bi bi-link-45deg text-muted" viewBox="0 0 16 16">
                                        <path
                                            d="M4.715 6.542 3.343 7.914a3 3 0 1 0 4.243 4.243l1.828-1.829A3 3 0 0 0 8.586 5.5L8 6.086a1.002 1.002 0 0 0-.154.199 2 2 0 0 1 .861 3.337L6.88 11.45a2 2 0 1 1-2.83-2.83l.793-.792a4.018 4.018 0 0 1-.128-1.287z" />
                                        <path
                                            d="M6.586 4.672A3 3 0 0 0 7.414 9.5l.775-.776a2 2 0 0 1-.896-3.346L9.12 3.55a2 2 0 1 1 2.83 2.83l-.793.792c.112.42.155.855.128 1.287l1.372-1.372a3 3 0 1 0-4.243-4.243L6.586 4.672z" />
                                    </svg>
                                </div>
                                <h3 class="h5">No URLs Found</h3>
                                <p class="text-muted">
                                    @if (request('search'))
                                        No URLs match your search criteria. Try a different search.
                                    @else
                                        You haven't created any shortened URLs yet.
                                    @endif
                                </p>
                                <a href="{{ route('home') }}" class="btn brand-btn mt-2">Create New URL</a>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- URL Details Modal -->
    <div class="modal fade" id="urlDetailsModal" tabindex="-1" aria-labelledby="urlDetailsModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="urlDetailsModalLabel">URL Details</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div id="url-details-loading" class="text-center py-5">
                        <div class="spinner-border text-primary" role="status">
                            <span class="visually-hidden">Loading...</span>
                        </div>
                        <p class="mt-2 text-muted">Loading URL details...</p>
                    </div>
                    <div id="url-details-content" class="d-none">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-4">
                                    <h6 class="fw-bold">Original URL</h6>
                                    <div class="d-flex align-items-center mt-2">
                                        <div class="url-favicon me-2">
                                            <img src="" alt="favicon" width="16" height="16"
                                                id="detail-favicon">
                                        </div>
                                        <a href="#" target="_blank" id="detail-original-url"
                                            class="text-break"></a>
                                    </div>
                                </div>
                                <div class="mb-4">
                                    <h6 class="fw-bold">Short URL</h6>
                                    <div class="input-group mt-2">
                                        <input type="text" class="form-control" id="detail-short-url" readonly>
                                        <button class="btn brand-btn copy-btn" type="button"
                                            data-clipboard-target="#detail-short-url">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                                fill="currentColor" class="bi bi-clipboard" viewBox="0 0 16 16">
                                                <path
                                                    d="M4 1.5H3a2 2 0 0 0-2 2V14a2 2 0 0 0 2 2h10a2 2 0 0 0 2-2V3.5a2 2 0 0 0-2-2h-1v1h1a1 1 0 0 1 1 1V14a1 1 0 0 1-1 1H3a1 1 0 0 1-1-1V3.5a1 1 0 0 1 1-1h1v-1z" />
                                                <path
                                                    d="M9.5 1a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-.5.5h-3a.5.5 0 0 1-.5-.5v-1a.5.5 0 0 1 .5-.5h3zm-3-1A1.5 1.5 0 0 0 5 1.5v1A1.5 1.5 0 0 0 6.5 4h3A1.5 1.5 0 0 0 11 2.5v-1A1.5 1.5 0 0 0 9.5 0h-3z" />
                                            </svg>
                                        </button>
                                    </div>
                                </div>
                                <div class="row mb-4">
                                    <div class="col-6">
                                        <h6 class="fw-bold">Slug</h6>
                                        <code id="detail-slug" class="fs-6"></code>
                                    </div>
                                    <div class="col-6">
                                        <h6 class="fw-bold">Created</h6>
                                        <span id="detail-created-at"></span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="card h-100">
                                    <div class="card-body">
                                        <h6 class="fw-bold mb-3">Analytics</h6>
                                        <div class="d-flex justify-content-center align-items-center mb-3">
                                            <div class="text-center">
                                                <div class="display-4 fw-bold text-primary" id="detail-clicks">0</div>
                                                <div class="text-muted">Total Clicks</div>
                                            </div>
                                        </div>
                                        <div id="clicks-chart-container">
                                            <canvas id="clicks-chart"></canvas>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <a href="#" class="btn brand-btn" id="visit-url-btn" target="_blank">Visit URL</a>
                </div>
            </div>
        </div>
    </div>

    <!-- Delete Confirmation Modal -->
    <div class="modal fade" id="deleteConfirmModal" tabindex="-1" aria-labelledby="deleteConfirmModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="deleteConfirmModalLabel">Confirm Delete</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p>Are you sure you want to delete this shortened URL? This action cannot be undone.</p>
                    <p class="mb-0"><strong>URL:</strong> <span id="delete-url-display"></span></p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="button" class="btn btn-danger" id="confirm-delete-btn">Delete URL</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Add required scripts -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/clipboard.js/2.0.11/clipboard.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js@3.7.1/dist/chart.min.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Clipboard initialization
            var clipboard = new ClipboardJS('.copy-btn');

            clipboard.on('success', function(e) {
                var button = e.trigger;
                var originalHTML = button.innerHTML;

                button.innerHTML = `
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-check" viewBox="0 0 16 16">
                    <path d="M10.97 4.97a.75.75 0 0 1 1.07 1.05l-3.99 4.99a.75.75 0 0 1-1.08.02L4.324 8.384a.75.75 0 1 1 1.06-1.06l2.094 2.093 3.473-4.425a.267.267 0 0 1 .02-.022z"/>
                </svg>
            `;

                setTimeout(function() {
                    button.innerHTML = originalHTML;
                }, 2000);

                e.clearSelection();
            });

            // URL Details Modal
            const urlDetailsModal = new bootstrap.Modal(document.getElementById('urlDetailsModal'));
            const deleteConfirmModal = new bootstrap.Modal(document.getElementById('deleteConfirmModal'));
            let clicksChart = null;

            // View details button click
            document.querySelectorAll('.view-details').forEach(button => {
                button.addEventListener('click', function() {
                    const urlId = this.getAttribute('data-url-id');
                    showUrlDetails(urlId);
                });
            });

            // Delete URL confirmation
            document.querySelectorAll('.delete-url-form').forEach(form => {
                form.addEventListener('submit', function(e) {
                    e.preventDefault();

                    const urlRow = this.closest('tr');
                    const urlDisplay = urlRow.querySelector('a').textContent.trim();

                    document.getElementById('delete-url-display').textContent = urlDisplay;
                    document.getElementById('confirm-delete-btn').setAttribute('data-form-id', this
                        .id);

                    deleteConfirmModal.show();
                });
            });

            // Confirm delete button
            document.getElementById('confirm-delete-btn').addEventListener('click', function() {
                const formId = this.getAttribute('data-form-id');
                const form = document.getElementById(formId);
                if (form) {
                    form.submit();
                }
                deleteConfirmModal.hide();
            });

            // Show URL details
            function showUrlDetails(urlId) {
                document.getElementById('url-details-loading').classList.remove('d-none');
                document.getElementById('url-details-content').classList.add('d-none');

                urlDetailsModal.show();

                // Fetch URL details from the server
                fetch(`/urls/${urlId}/details`)
                    .then(response => response.json())
                    .then(data => {
                        if (data.success) {
                            updateUrlDetailsModal(data.url, data.clicksData);
                        } else {
                            // Handle error
                            console.error('Error loading URL details:', data.error);
                        }
                    })
                    .catch(error => {
                        console.error('Error fetching URL details:', error);
                    })
                    .finally(() => {
                        document.getElementById('url-details-loading').classList.add('d-none');
                        document.getElementById('url-details-content').classList.remove('d-none');
                    });
            }

            // Update URL details modal content
            function updateUrlDetailsModal(url, clicksData) {
                // Update URL details
                document.getElementById('detail-favicon').src =
                    `https://www.google.com/s2/favicons?domain=${new URL(url.original_url).hostname}`;
                document.getElementById('detail-original-url').href = url.original_url;
                document.getElementById('detail-original-url').textContent = url.original_url;

                const shortUrl = `${window.location.protocol}//${window.location.host}/${url.slug}`;
                document.getElementById('detail-short-url').value = shortUrl;
                document.getElementById('detail-slug').textContent = url.slug;
                document.getElementById('detail-created-at').textContent = new Date(url.created_at)
                    .toLocaleDateString();
                document.getElementById('detail-clicks').textContent = url.clicks;

                document.getElementById('visit-url-btn').href = shortUrl;

                // Update clicks chart
                updateClicksChart(clicksData);
            }

            // Update clicks chart
            function updateClicksChart(clicksData) {
                const ctx = document.getElementById('clicks-chart').getContext('2d');

                // Destroy existing chart if it exists
                if (clicksChart) {
                    clicksChart.destroy();
                }

                // Create new chart
                clicksChart = new Chart(ctx, {
                    type: 'line',
                    data: {
                        labels: clicksData.labels,
                        datasets: [{
                            label: 'Clicks',
                            data: clicksData.data,
                            backgroundColor: 'rgba(234, 29, 34, 0.2)',
                            borderColor: 'rgba(234, 29, 34, 1)',
                            borderWidth: 2,
                            tension: 0.4,
                            pointBackgroundColor: 'rgba(234, 29, 34, 1)'
                        }]
                    },
                    options: {
                        responsive: true,
                        maintainAspectRatio: false,
                        scales: {
                            y: {
                                beginAtZero: true,
                                ticks: {
                                    precision: 0
                                }
                            }
                        },
                        plugins: {
                            legend: {
                                display: false
                            }
                        }
                    }
                });
            }
        });
    </script>

    <style>
        .feature-icon {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            width: 4rem;
            height: 4rem;
            border-radius: 0.75rem;
            color: #fff;
        }

        .text-gradient {
            background: linear-gradient(90deg, #ea1d22, #ff634d);
            -webkit-background-clip: text;
            background-clip: text;
            -webkit-text-fill-color: transparent;
        }

        .brand-btn {
            background-color: #ea1d22 !important;
            border-color: #ea1d22 !important;
            color: white !important;
        }

        .brand-btn:hover,
        .brand-btn:focus {
            background-color: #c0171b !important;
            border-color: #c0171b !important;
        }

        .steps {
            padding: 20px 0;
        }

        .step-item {
            display: flex;
            margin-bottom: 30px;
            align-items: center;
        }

        .step-number {
            background-color: #ea1d22;
            color: white;
            width: 40px;
            height: 40px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: bold;
            margin-right: 15px;
            flex-shrink: 0;
        }

        .step-content {
            flex-grow: 1;
        }

        .step-content h4 {
            margin-bottom: 5px;
            font-size: 18px;
        }

        /* Animation */
        .fade-in {
            animation: fadeIn 0.5s;
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(-10px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        #clicks-chart-container {
            height: 200px;
        }
    </style>
@endsection
