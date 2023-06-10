        <section>
            {!! $frontSettings['ads-3'] !!}
        </section>

        <footer id="footer">
            <div class="footer-top container-fluid">
                <div class="row mx-0 ">
                    <div class="col-12 col-md-6 col-xl-4 col-sm-6">
                        <div class="about-details">
                            <div class="footer-logo">
                                <h4>RVSolutionStuff</h4>
                            </div>
                            <div class="about-text">
                                <p>www.rvsolutionstuff.com is a team of developers and designers working towards learning programming and design easy for the world.</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-md-6 col-xl-3 col-sm-6">
                        <div class="common-links-wrap">
                            <div class="links-heading">
                                <h3 class="title">Quick
                                    <span class="bold">Links</span>
                                </h3>
                            </div>
                            <div class="common-links">
                                <ul>
                                    <li>
                                        <a href="{{ route('blog.aboutus') }}">About Us</a>
                                    </li>
                                    <li>
                                        <a href="{{ route('blog.contactus') }}">Contact Us</a>
                                    </li>
                                    <li>
                                        <a href="{{ route('blog.privacypolicy') }}">Privacy Policy</a>
                                    </li>
                                    <li>
                                        <a href="{{ route('blog.disclaimer') }}">Disclaimer</a>
                                    </li>
                                    <li>
                                        <a  target="_blank" href="{{ route('login') }}">Login</a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-md-6 col-xl-3 col-sm-6">
                        <div class="common-links-wrap">
                            <div class="links-heading">
                                <h3 class="title">We
                                    <span class="bold">are providing</span>
                                </h3>
                            </div>
                            <div class="common-links">
                                <ul>
                                    <li>
                                        <a href="{{ route('front.home') }}">Home</a>
                                    </li>
                                    <li>
                                        <a href="{{ route('latest.post') }}">Latest Posts</a>
                                    </li>
                                    <li>
                                        <a href="{{ route('blog.categories') }}">List Of Categories</a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-md-6 col-xl-2 col-sm-6">
                        <div class="footer-col-four">
                            <div class="top-main-buttons">
                                <button onclick="location.href='{{ route('blog.contactus') }}'" class="white-btn">Works with Us
                                    <i class="fas fa-paper-plane"></i>
                                </button>
                                <button onclick="location.href='{{ route('latest.post') }}'" class="white-btn">Articles
                                    <i class="fas fa-user"></i>
                                </button>
                            </div>
                            <div class="social-icons">
                                <a href="{{ $frontSettings['facebook-link'] }}">
                                    <i class="fab fa-facebook-f"></i>
                                </a>
                                <a href="{{ $frontSettings['twitter-link'] }}">
                                    <i class="fab fa-twitter"></i>
                                </a>
                                <a href="{{ $frontSettings['linked-in-link'] }}">
                                    <i class="fab fa-linkedin-in"></i>
                                </a>
                                <a href="">
                                    <i class="fab fa-skype"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </footer>
        <div class="copyright-wrap">
            <p>Copyright &copy; {{ now()->year }} {{ $frontSettings['footer-text'] }} • All Rights Reserved</p>
        </div>