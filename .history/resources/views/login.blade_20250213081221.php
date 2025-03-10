



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
                <a href="#">Forgot password?</a>
            </div>
            <button type="submit">Log In</button>
            <div class="register">
                <p>Don't have an account? <a style="color: #38547C; font-weight: bold;" href="#"><u>Contact MIS</u></a></p>
            </div>
        </form>        
    </div>




