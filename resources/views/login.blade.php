<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Login</title>
    
    <link rel="icon" href="{{ asset('assets/images/FUJI-HAYA.png') }}">
    <!-- custom css login-->
    <link rel="stylesheet" href="{{ asset('assets/css/login.css') }}">
    <style>
        /* Modal Styles */
        .modal {
            display: none;
            position: fixed;
            z-index: 1000;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.5);
        }
        
        .modal-content {
            background-color: #fff;
            margin: 15% auto;
            padding: 20px;
            border-radius: 8px;
            width: 400px;
            text-align: center;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }
        
        .close-modal {
            background-color: #38547C;
            color: white;
            border: none;
            padding: 10px 20px;
            border-radius: 4px;
            cursor: pointer;
            margin-top: 15px;
            font-weight: bold;
        }
        
        .close-modal:hover {
            background-color: #2c4361;
        }
    </style>
</head>
<body>
    
    <div class="wrapper">
        <form action="{{ route('login') }}" method="POST">
          @csrf
          <div class="logo">
              <img src="{{ asset('assets/images/FUJI-HAYA.png') }}" alt="logo" width="80">
          </div>
          <h2>Login Form</h2>
          <div class="input-field">
            <input type="text" name="u_username" required>
            <label for="u_username">Enter your Username</label>
          </div>
          <div class="input-field">
              <input type="password" name="u_password" required>
              <label for="u_password">Enter your Password</label>
          </div>          
          <div class="forget">
              <label for="remember">
                  <input type="checkbox" name="remember" id="remember">
                  <p>Remember me</p>
              </label>
              <a href="#" id="forgotPasswordLink">Forgot password?</a>
          </div>
          <button type="submit">Log In</button>
          <div class="register">
              <p>Don't have an account? <a style="color: #38547C; font-weight: bold;" href="#"><u>Contact MIS</u></a></p>
          </div>
          
          <!-- Add a hidden CSRF token field for remember me functionality -->
          <input type="hidden" name="remember_token" id="remember_token" value="{{ old('remember_token') }}">
      </form>        
    </div>
    
    <!-- Password Reset Modal -->
    <div id="passwordResetModal" class="modal">
        <div class="modal-content">
            <h3>Password Reset</h3>
            <p>Please message MIS for password reset.</p>
            <button class="close-modal" id="closeModal">Close</button>
        </div>
    </div>
    
    <script>
        // Remember Me Token Functionality
        document.addEventListener('DOMContentLoaded', function() {
            const rememberCheckbox = document.getElementById('remember');
            const rememberTokenField = document.getElementById('remember_token');
            
            // Check if there's a stored token
            const storedToken = localStorage.getItem('remember_token');
            if (storedToken) {
                rememberCheckbox.checked = true;
                rememberTokenField.value = storedToken;
            }
            
            // When form is submitted
            document.querySelector('form').addEventListener('submit', function() {
                if (rememberCheckbox.checked) {
                    // Generate a random token
                    const token = Math.random().toString(36).substring(2, 15) + 
                                 Math.random().toString(36).substring(2, 15);
                    rememberTokenField.value = token;
                    localStorage.setItem('remember_token', token);
                } else {
                    // Clear stored token if remember me is unchecked
                    localStorage.removeItem('remember_token');
                    rememberTokenField.value = '';
                }
            });
            
            // Modal functionality
            const modal = document.getElementById('passwordResetModal');
            const forgotPasswordLink = document.getElementById('forgotPasswordLink');
            const closeModalBtn = document.getElementById('closeModal');
            
            forgotPasswordLink.addEventListener('click', function(e) {
                e.preventDefault();
                modal.style.display = 'block';
            });
            
            closeModalBtn.addEventListener('click', function() {
                modal.style.display = 'none';
            });
            
            // Close modal when clicking outside of it
            window.addEventListener('click', function(event) {
                if (event.target === modal) {
                    modal.style.display = 'none';
                }
            });
        });
    </script>
</body>
</html>