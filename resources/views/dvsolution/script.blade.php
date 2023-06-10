    <script src="{{ asset('dvNew/js/jquery-3.6.0.min.js') }}"></script>
    <script src="{{ asset('dvNew/js/bootstrap.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('dvNew/js/bootstrap.bundle.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('dvNew/js/all.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('dvNew/js/fontawesome.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('dvNew/js/custom.js') }}" type="text/javascript"></script>
    <script src="{{ asset('dvNew/js/highlight.min.js') }}"></script>
    <script src="{{ asset('dvNew/js/iziToast.min.js') }}"></script>
    <script src="{{ asset('dvNew/js/jquery.cookie.min.js') }}"></script>
    <script src="{{ asset('dvNew/js/lazysizes.min.js') }}"></script>
    <script src="{{ asset('dvNew/js/html.js') }}"></script>
<!--     <script type="text/javascript">
    $(document).ready(function(e) {
            $('body').on('click','#subscribeformbtn',function (e) {
                e.preventDefault();
                var formData = $('#subscribeform').serialize();
    
                $.ajax({
                    url: "/user-subscription",
                    type: 'POST',
                    data : formData,
                    beforeSend: function(){
                        $('#subscribeformbtn').attr('disabled', true);
                        $('#subscribeformbtn').html('<i class="fa fa-spinner fa-spin"></i>  Please Wait...');
                    },
                    success : function (response) {                    
                        $('#subscribeformbtn').attr('disabled', false);
                        $('#subscribeformbtn').html('Subscribe Now');
                        if(response.status == 'success') {
                            iziToast.success({
                                maxWidth: 400,
                                timeout: 10000,
                                position: 'bottomRight',
                                title: 'Success Alert',
                                message: response.message,
                            });
                        }
    
                        if(response.status == 'fail') {
                            iziToast.error({
                                maxWidth: 400,
                                timeout: 10000,
                                position: 'bottomRight',
                                title: 'Error Alert',
                                message: response.message,
                            });
                        }
    
                        if(response.errors) {
                            iziToast.error({
                                maxWidth: 400,
                                timeout: 10000,
                                position: 'bottomRight',
                                title: 'Error Alert',
                                message: response.errors.email['0'],
                            });
                        }
                        $('input[name="email"]').val('');
                    },
                    error :function (response) {
                        $('#subscribeformbtn').attr('disabled', false);
                        $('#subscribeformbtn').html('Subscribe Now');
                        iziToast.error({
                            maxWidth: 400,
                            timeout: 10000,
                            position: 'bottomRight',
                            title: 'Error Alert',
                            message: "Please check the form below for errors",
                        });
                        $('input[name="email"]').val('');
                    }
                });
            }) 
        });
    </script> -->