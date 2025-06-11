<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Account Deletion - VTUBiz</title>
    
    <!-- Core CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@tabler/icons-webfont@2.22.0/tabler-icons.min.css">
    
    <style>
        body {
            background: linear-gradient(135deg, #f5f7fa 0%, #e4e8eb 100%);
            min-height: 100vh;
            font-family: 'Inter', -apple-system, BlinkMacSystemFont, sans-serif;
        }
        
        .page-wrapper {
            min-height: 100vh;
            display: flex;
            align-items: center;
        }
        
        .logo-section {
            text-align: center;
            margin-bottom: 2rem;
            animation: fadeInDown 0.5s ease-out;
        }
        
        .logo-section img {
            height: 45px;
            margin-bottom: 1rem;
            transition: transform 0.3s ease;
        }
        
        .logo-section img:hover {
            transform: scale(1.05);
        }
        
        .card {
            border: none;
            border-radius: 16px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.08);
            animation: fadeInUp 0.5s ease-out;
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(10px);
        }
        
        .danger-zone {
            background: linear-gradient(to right, #fff5f5, #fff0f0);
            border: 1px solid #ffe0e0;
            border-radius: 12px;
            padding: 2rem;
        }
        
        .danger-zone-header {
            border-bottom: 2px solid rgba(220, 53, 69, 0.1);
            padding-bottom: 1.25rem;
            margin-bottom: 1.5rem;
        }
        
        .warning-icon {
            color: #dc3545;
            font-size: 2.5rem;
            margin-right: 1.25rem;
            animation: pulse 2s infinite;
        }
        
        .account-type-selector .form-check {
            padding: 1.25rem;
            border: 2px solid #dee2e6;
            border-radius: 12px;
            margin-bottom: 0.75rem;
            cursor: pointer;
            transition: all 0.3s ease;
            background: white;
        }
        
        .account-type-selector .form-check:hover {
            border-color: #adb5bd;
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(0,0,0,0.05);
        }
        
        .account-type-selector .form-check-input:checked + .form-check-label {
            font-weight: 600;
            color: #dc3545;
        }
        
        .form-control {
            padding: 0.75rem 1rem;
            border-radius: 10px;
            border: 2px solid #dee2e6;
            transition: all 0.3s ease;
        }
        
        .form-control:focus {
            border-color: #dc3545;
            box-shadow: 0 0 0 0.2rem rgba(220, 53, 69, 0.15);
        }
        
        .delete-btn {
            padding: 0.75rem 2rem;
            border-radius: 10px;
            font-weight: 600;
            transition: all 0.3s ease;
            background: linear-gradient(45deg, #dc3545, #e35d6a);
            border: none;
            box-shadow: 0 4px 15px rgba(220, 53, 69, 0.2);
        }
        
        .delete-btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 20px rgba(220, 53, 69, 0.3);
            background: linear-gradient(45deg, #c82333, #dc3545);
        }
        
        .confirmation-checkbox .form-check-input:checked {
            background-color: #dc3545;
            border-color: #dc3545;
        }
        
        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(20px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }
        
        @keyframes fadeInDown {
            from {
                opacity: 0;
                transform: translateY(-20px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }
        
        @keyframes pulse {
            0% {
                transform: scale(1);
            }
            50% {
                transform: scale(1.05);
            }
            100% {
                transform: scale(1);
            }
        }

        .form-label {
            font-weight: 500;
            color: #495057;
            margin-bottom: 0.5rem;
        }

        .delete-warning ul {
            padding-left: 1.25rem;
        }

        .delete-warning li {
            color: #6c757d;
            margin-bottom: 0.5rem;
            position: relative;
            padding-left: 0.5rem;
        }

        .btn-light {
            background: #f8f9fa;
            border: 2px solid #dee2e6;
            font-weight: 500;
            padding: 0.75rem 2rem;
            border-radius: 10px;
            transition: all 0.3s ease;
        }

        .btn-light:hover {
            background: #e9ecef;
            border-color: #adb5bd;
        }
    </style>
</head>
<body>
    <div class="page-wrapper">
        <div class="container py-5">
            <div class="row justify-content-center">
                <div class="col-md-8">
                    <div class="logo-section">
                        <img src="{{ url('assets/img/logo/vtulogo.png')}}" alt="VTUBiz Logo">
                        <h4 class="text-muted">Account Deletion Request</h4>
                    </div>
                    
                    <div class="card shadow-sm">
                        <div class="card-body p-4">
                            <div class="danger-zone">
                                <div class="danger-zone-header d-flex align-items-center">
                                    <i class="ti ti-alert-triangle warning-icon"></i>
                                    <div>
                                        <h4 class="text-danger mb-1">Delete Your Account</h4>
                                        <p class="text-muted mb-0">This action cannot be undone</p>
                                    </div>
                                </div>

                                <div class="delete-warning">
                                    <p class="mb-3">Before proceeding with account deletion, please note:</p>
                                    <ul class="mb-4">
                                        <li>All your data, including transaction history and wallet balance, will be permanently deleted.</li>
                                        <li>You won't be able to recover your account or any associated data.</li>
                                        <li>Your account cannot be restored after deletion.</li>
                                    </ul>
                                </div>

                                <form method="post" action="/deleteuser_confirm" class="delete-form">
                                    @csrf
                                   

                                    <div class="form-group mb-4">
                                        <label class="form-label">Email Address</label>
                                        <input name="email" type="email" class="form-control" required
                                            placeholder="Enter your email address">
                                    </div>

                                    <div class="form-group mb-4">
                                        <label class="form-label">Password</label>
                                        <input name="password" type="password" class="form-control" required
                                            placeholder="Enter your password">
                                    </div>

                                    <div class="confirmation-checkbox mb-4">
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" id="confirmDelete" required>
                                            <label class="form-check-label" for="confirmDelete">
                                                I understand that this action is permanent and cannot be undone
                                            </label>
                                        </div>
                                    </div>

                                    <div class="d-flex justify-content-between align-items-center">
                                        <a href="/" class="btn btn-light">Cancel</a>
                                        <button type="submit" class="btn btn-danger delete-btn">
                                            <i class="ti ti-trash me-2"></i>Delete Account
                                        </button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Scripts -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        $(document).ready(function() {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
        });

        @if(Session::has('message'))
            Swal.fire({
                icon: 'success',
                title: 'Success',
                text: "{{ Session::get('message') }}",
                confirmButtonColor: '#3085d6'
            });
        @endif

        @if(Session::has('error'))
            Swal.fire({
                icon: 'error',
                title: 'Error',
                text: "{{ Session::get('error') }}",
                confirmButtonColor: '#d33'
            });
        @endif
    </script>
</body>
</html>