<footer class="footer-custom">
    <div class="container">
        <div class="row">
            <div class="col-md-4 mb-4">
                <h5>About Petra</h5>
                <div class="footer-logo mb-3">

                    <img src="{{ asset('images/logo-white.png') }}" alt="Petra Logo">

                </div>
            </div>
            
            <div class="col-md-4 mb-4">
                <h5>Quick Links</h5>
                <ul>
                    <li><a href="{{ route('home') }}"><i class="bi bi-chevron-right"></i> Home</a></li>
                    <li><a href="{{ route('videos') }}"><i class="bi bi-chevron-right"></i> Videos</a></li>
                    <li><a href="{{ route('recommendation') }}"><i class="bi bi-chevron-right"></i> Start Quiz</a></li>
                </ul>
            </div>
            
            <div class="col-md-4 mb-4">
                <h5>Contact Us</h5>
                <div class="contact-info">
                    <p>
                        <i class="bi bi-geo-alt"></i>
                        <span>Jl. Siwalankerto No.121-131, Siwalankerto,</span> <br>
                        <span>Kec. Wonocolo, Kota SBY, Jawa Timur 60236</span>
                    </p>
                    <p>
                        <i class="bi bi-envelope"></i>
                        <span>info@petra.ac.id</span>
                    </p>
                    <p>
                        <i class="bi bi-telephone"></i>
                        <span>(031) 2983000</span>
                    </p>
                </div>
            </div>
        </div>
        
        <div class="footer-bottom">
            <p>&copy; {{ date('Y') }} Petra Christian University. All rights reserved.</p>
        </div>
    </div>
</footer>