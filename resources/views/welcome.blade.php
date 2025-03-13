@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-8 col-md-10">
                <div class="card shadow border-0 rounded-4 mb-5">
                    <div class="card-body p-lg-5 p-4">
                        <div class="text-center mb-5">
                            <h1 class="display-4 fw-bold">Share Links, <span class="text-gradient">Simplified</span></h1>
                            <p class="lead text-muted">Create short, memorable links in seconds — no account required.</p>
                        </div>

                        <!-- Success Message -->
                        @if (session('success'))
                            <div class="alert alert-success shadow-sm rounded-4 fade-in">
                                <div class="d-flex">
                                    <div class="me-3">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                            fill="currentColor" class="bi bi-check-circle-fill" viewBox="0 0 16 16">
                                            <path
                                                d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zm-3.97-3.03a.75.75 0 0 0-1.08.022L7.477 9.417 5.384 7.323a.75.75 0 0 0-1.06 1.06L6.97 11.03a.75.75 0 0 0 1.079-.02l3.992-4.99a.75.75 0 0 0-.01-1.05z" />
                                        </svg>
                                    </div>
                                    <div class="w-100">
                                        <h5 class="alert-heading">URL Shortened Successfully!</h5>
                                        @if (session('url'))
                                            <div class="mt-3">
                                                <p class="mb-1"><strong>Original URL:</strong></p>
                                                <div class="text-truncate mb-3 text-muted">
                                                    {{ session('url')->original_url }}</div>

                                                <p class="mb-1"><strong>Your Short URL:</strong></p>
                                                <div class="input-group mb-2">
                                                    <input type="text" class="form-control" id="shortUrlResult"
                                                        value="{{ route('redirect', session('url')->slug) }}" readonly>
                                                    <button class="btn brand-btn copy-btn" type="button"
                                                        data-clipboard-target="#shortUrlResult">
                                                        <svg xmlns="http://www.w3.org/2000/svg" width="16"
                                                            height="16" fill="currentColor" class="bi bi-clipboard"
                                                            viewBox="0 0 16 16">
                                                            <path
                                                                d="M4 1.5H3a2 2 0 0 0-2 2V14a2 2 0 0 0 2 2h10a2 2 0 0 0 2-2V3.5a2 2 0 0 0-2-2h-1v1h1a1 1 0 0 1 1 1V14a1 1 0 0 1-1 1H3a1 1 0 0 1-1-1V3.5a1 1 0 0 1 1-1h1v-1z" />
                                                            <path
                                                                d="M9.5 1a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-.5.5h-3a.5.5 0 0 1-.5-.5v-1a.5.5 0 0 1 .5-.5h3zm-3-1A1.5 1.5 0 0 0 5 1.5v1A1.5 1.5 0 0 0 6.5 4h3A1.5 1.5 0 0 0 11 2.5v-1A1.5 1.5 0 0 0 9.5 0h-3z" />
                                                        </svg>
                                                        Copy
                                                    </button>
                                                </div>
                                            </div>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        @endif

                        <!-- Error Message -->
                        @if (session('error'))
                            <div class="alert alert-danger shadow-sm rounded-4">
                                <div class="d-flex">
                                    <div class="me-3">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                            fill="currentColor" class="bi bi-exclamation-circle-fill" viewBox="0 0 16 16">
                                            <path
                                                d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zM8 4a.905.905 0 0 0-.9.995l.35 3.507a.552.552 0 0 0 1.1 0l.35-3.507A.905.905 0 0 0 8 4zm.002 6a1 1 0 1 0 0 2 1 1 0 0 0 0-2z" />
                                        </svg>
                                    </div>
                                    <div>
                                        <h5 class="alert-heading">Error</h5>
                                        <p class="mb-0">{{ session('error') }}</p>
                                    </div>
                                </div>
                            </div>
                        @endif

                        <!-- URL Shortener Form -->
                        <div class="card shadow-lg rounded-4 mb-5">
                            <div class="card-body p-lg-5 p-4">
                                <form method="POST" action="{{ route('urls.store') }}" class="url-shortener-form">
                                    @csrf
                                    <div class="mb-4">
                                        <label for="original_url" class="form-label fw-bold">URL to shorten</label>
                                        <input type="url"
                                            class="form-control form-control-lg @error('original_url') is-invalid @enderror"
                                            id="original_url" name="original_url"
                                            placeholder="https://paste-your-long-url-here.com"
                                            value="{{ old('original_url') }}" required autofocus>
                                        @error('original_url')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="mb-4">
                                        <label for="custom_slug" class="form-label fw-bold d-flex justify-content-between">
                                            <span>Custom slug (optional)</span>
                                            <span class="text-muted fw-normal fs-6">yoursite.com/</span>
                                        </label>
                                        <input type="text"
                                            class="form-control @error('custom_slug') is-invalid @enderror" id="custom_slug"
                                            name="custom_slug" placeholder="my-custom-link"
                                            value="{{ old('custom_slug') }}">
                                        <div class="form-text">Leave empty for an automatically generated short link</div>
                                        @error('custom_slug')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="d-grid">
                                        <button type="submit" class="btn brand-btn btn-lg">Shorten URL</button>
                                    </div>
                                </form>
                            </div>
                        </div>

                        <!-- Features -->
                        <div class="row mb-5 g-4">
                            <div class="col-md-4">
                                <div class="text-center p-3">
                                    <div class="feature-icon bg-gradient mb-3">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                            fill="currentColor" class="bi bi-lightning-charge" viewBox="0 0 16 16">
                                            <path
                                                d="M11.251.068a.5.5 0 0 1 .227.58L9.677 6.5H13a.5.5 0 0 1 .364.843l-8 8.5a.5.5 0 0 1-.842-.49L6.323 9.5H3a.5.5 0 0 1-.364-.843l8-8.5a.5.5 0 0 1 .615-.09zM4.157 8.5H7a.5.5 0 0 1 .478.647L6.11 13.59l5.732-6.09H9a.5.5 0 0 1-.478-.647L9.89 2.41 4.157 8.5z" />
                                        </svg>
                                    </div>
                                    <h3 class="h5">Fast & Simple</h3>
                                    <p class="text-muted">Create short links instantly with no registration required</p>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="text-center p-3">
                                    <div class="feature-icon bg-gradient mb-3">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                            fill="currentColor" class="bi bi-graph-up" viewBox="0 0 16 16">
                                            <path fill-rule="evenodd"
                                                d="M0 0h1v15h15v1H0V0Zm14.817 3.113a.5.5 0 0 1 .07.704l-4.5 5.5a.5.5 0 0 1-.74.037L7.06 6.767l-3.656 5.027a.5.5 0 0 1-.808-.588l4-5.5a.5.5 0 0 1 .758-.06l2.609 2.61 4.15-5.073a.5.5 0 0 1 .704-.07Z" />
                                        </svg>
                                    </div>
                                    <h3 class="h5">Track Clicks</h3>
                                    <p class="text-muted">Monitor how many times your shortened links are clicked</p>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="text-center p-3">
                                    <div class="feature-icon bg-gradient mb-3">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                            fill="currentColor" class="bi bi-pencil-square" viewBox="0 0 16 16">
                                            <path
                                                d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z" />
                                            <path fill-rule="evenodd"
                                                d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5v11z" />
                                        </svg>
                                    </div>
                                    <h3 class="h5">Custom Links</h3>
                                    <p class="text-muted">Create memorable custom links for your brand or campaign</p>
                                </div>
                            </div>
                        </div>

                        <!-- How It Works -->
                        <div class="text-center mb-4">
                            <h2>How It Works</h2>
                            <p class="text-muted">Three simple steps to create your shortened URL</p>
                        </div>

                        <div class="steps">
                            <div class="step-item">
                                <div class="step-number">1</div>
                                <div class="step-content">
                                    <h4>Paste your URL</h4>
                                    <p class="text-muted">Enter the long URL you want to shorten</p>
                                </div>
                            </div>
                            <div class="step-item">
                                <div class="step-number">2</div>
                                <div class="step-content">
                                    <h4>Add custom slug (optional)</h4>
                                    <p class="text-muted">Create a memorable link or let us generate one for you</p>
                                </div>
                            </div>
                            <div class="step-item">
                                <div class="step-number">3</div>
                                <div class="step-content">
                                    <h4>Copy & share your link</h4>
                                    <p class="text-muted">Use your shortened URL anywhere you want</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Add clipboard.js for copy functionality -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/clipboard.js/2.0.11/clipboard.min.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var clipboard = new ClipboardJS('.copy-btn');

            clipboard.on('success', function(e) {
                var button = e.trigger;
                var originalText = button.textContent;

                button.innerHTML = `
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-check2" viewBox="0 0 16 16">
                    <path d="M13.854 3.646a.5.5 0 0 1 0 .708l-7 7a.5.5 0 0 1-.708 0l-3.5-3.5a.5.5 0 1 1 .708-.708L6.5 10.293l6.646-6.647a.5.5 0 0 1 .708 0z"/>
                </svg>
                Copied!
            `;

                setTimeout(function() {
                    button.innerHTML = `
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-clipboard" viewBox="0 0 16 16">
                        <path d="M4 1.5H3a2 2 0 0 0-2 2V14a2 2 0 0 0 2 2h10a2 2 0 0 0 2-2V3.5a2 2 0 0 0-2-2h-1v1h1a1 1 0 0 1 1 1V14a1 1 0 0 1-1 1H3a1 1 0 0 1-1-1V3.5a1 1 0 0 1 1-1h1v-1z"/>
                        <path d="M9.5 1a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-.5.5h-3a.5.5 0 0 1-.5-.5v-1a.5.5 0 0 1 .5-.5h3zm-3-1A1.5 1.5 0 0 0 5 1.5v1A1.5 1.5 0 0 0 6.5 4h3A1.5 1.5 0 0 0 11 2.5v-1A1.5 1.5 0 0 0 9.5 0h-3z"/>
                    </svg>
                    Copy
                `;
                }, 2000);

                e.clearSelection();
            });
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
            background: #ea1d22;
        }

        .text-gradient {
            background: linear-gradient(90deg, #ea1d22, #ff634d);
            -webkit-background-clip: text;
            background-clip: text;
            -webkit-text-fill-color: transparent;
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
    </style>
@endsection
