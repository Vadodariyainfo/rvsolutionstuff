<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" type="image/png" href="{!! !empty($frontSettings['site-favicon']) ? route('image.asset.storage.file',['folder' => 'site-logos', 'file' => $frontSettings['site-favicon']]) : '' !!}" sizes="16x16"/>
    @yield('title')
    <meta http-equiv="X-UA-Compatible" content="IE=edge"/>
    <meta http-equiv="content-type" content="text/html; charset=UTF-8"/>
    {!! SEOMeta::generate() !!}
    {!! OpenGraph::generate() !!}
    <meta content="{{ $frontSettings['facebook-link'] }}" property='article:publisher'/>
    <meta content="{{ $frontSettings['facebook-link'] }}" property='article:author'/>
    <meta content='Divyang Vadodariya' name='author'/>
    {!! Twitter::generate() !!}
    <script type="text/javascript">
    var current_page_url = "<?php echo URL::full(); ?>";
    var rn = "<?php echo Route::currentRouteName(); ?>";
    </script>

        {!! $frontSettings['header-verify-tag'] !!}

        @include('dvsolution.style')
        @yield('style')
        
        <a href="#" id="scroll">
            <span>
            </span>
        </a>

        @include('dvsolution.header')

        @yield('content')

        @include('dvsolution.footer')
        </div>
    </body>

    @include('dvsolution.script')
    @yield('script')
</html>