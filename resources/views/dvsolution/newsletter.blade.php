                <section>
                    <center>
                        {!! $frontSettings['ads-5'] !!}
                    </center>
                </section>
                <section class="newsletter">
                    <div class="row h-100">
                        <div class="col-12 col-md-6 col-xl-6 col-sm-6 left">
                            <h5>Developers join
                                <br />
                                <span class="bold">with us</span>
                            </h5>
                        </div>
                        <div class="col-12 col-md-6 col-xl-6 col-sm-6 right">
                            <form method="post" action="{{ route('subscriber.store') }}">
                                @csrf
                                <div class="input-group">
                                    <input class="form-control" type="email" value="" name="email" class="email" placeholder="Enter your email for our monthly newsletter" required>
                                    <span class="input-group-btn">
                                        <i class="fas fa-paper-plane"></i>
                                        <input type="submit" value="Subscribe" class="btn btn-success" name="subscribe" id="mc-embedded-subscribe" class="button">
                                    </span>
                                </div>
                            </form>
                        </div>
                    </div>
                </section>