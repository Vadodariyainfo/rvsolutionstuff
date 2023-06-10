@extends($dvsolution)

@section('content')
<section id="page_body" class="container-fluid mt-5 pt-4">
    <div class="row mx-0">
        <div class="col-12 col-md-12 col-xl-8 col-sm-12">
            <section class="article-details-main mb-5 mt-5">
                <div class="row mx-0">
                    <h1 class="mb-3 p-0">
                        <a href="{{ route('blog.detail',$post->slug ) }}" title="Laravel send mail with file attachment example">{{ $post->title }}</a>
                    </h1>
                    
                    <section>
                        {!! $frontSettings['ads-1'] !!}
                    </section>

                    <div class="post-info mb-3">
                        <span class="time">
                            <i class="fas fa-calendar-alt"></i>{{ $post->created_at->format('M d, Y') }}</span>
                        <span class="eye">
                            <i class="fas fa-user"></i>By Admin</span>
                    </div>
                    <div class="col-12"></div>
                    <section class="post-description mb-3">
                        <p class="post-desc">{!! nl2br($post->body) !!}</p><br/>
                        @if(isset($post->image))
                            <div style="padding: 10px;">
                                <center><img class="img-responsive" src="{!! !empty($post->image) ? route('image.asset.storage.file',['folder' => 'images', 'file' => $post->image]) : asset('/blog/default/default.png') !!}" style="width:600px;"></center>
                            </div>
                        @endif

                        <section>
                            {!! $frontSettings['ads-2'] !!}
                        </section>

                        <div class="row">
                            <div class="col-md-4">
                                <h4><strong>HTML</strong></h4>
                                @if(!empty($post->body_html))
                                    <div class="code-editor" id="html-editor">{{ $post->body_html }}</div>
                                    <textarea hidden="" id="html" placeholder="HTML" autocapitalize="off" autofocus="">
                                        {{ $post->body_html }}
                                    </textarea>
                                @endif
                            </div>
                            <div class="col-md-4">
                                <h4><strong>CSS</strong></h4>
                                @if(!empty($post->body_css))
                                    <div class="code-editor" id="css-editor">{{ $post->body_css }}</div>
                                    <textarea hidden="" id="css" placeholder="CSS" autocapitalize="off" autofocus="">
                                        {{ $post->body_css }}
                                    </textarea>
                                @endif
                            </div>
                            <div class="col-md-4">
                                <h4><strong>JavaScript</strong></h4>
                                @if(!empty($post->body_js))
                                    <div class="code-editor" id="javascript-editor">{{ $post->body_js }}</div>
                                    <textarea hidden="" id="js" placeholder="JavaScript" autocapitalize="off" autofocus="">
                                        {{ $post->body_js }}
                                    </textarea>
                                @endif
                            </div>

                            <section>
                                {!! $frontSettings['ads-3'] !!}
                            </section>

                            <div class="col-md-12">
                                <iframe class="code-editor preview" id="preview"></iframe>
                            </div>
                        </div>
                    </section>
                </div>


                <div class="row">
                    <div class="col-md-12 col-xs-12 tags-postdetail-page">
                    <strong><i class="fa fa-tags" aria-hidden="true"></i> Tags:-</strong>
                    @if(!empty($postTags))
                        @foreach($postTags->getTags as $key=>$value)
                            @if(!empty($value->tags->tag))
                                <a href="" class="tag">
                                    <span class="txt">{{ $value->tags->tag }}</span><span class="num">{{ $value->tags->post->count() }}</span>
                                </a>
                            @endif
                        @endforeach
                    @endif
                    </div>
                </div>
                <div class="social-buttons p-0 mb-5">
                    <a href="https://www.facebook.com/sharer/sharer.php?u=https://dvsolution.tech/snippet/{{ $post->slug }}" class="btn bordered-btn">
                        <i class="fab fa-facebook-f"></i>Facebook</a>
                    <a href="https://twitter.com/home?status=https://dvsolution.tech/snippet/{{ $post->slug }}" class="btn bordered-btn">
                        <i class="fab fa-twitter"></i>Twitter</a>
                    <a href="https://api.whatsapp.com/send?text=https://dvsolution.tech/snippet/{{ $post->slug }}" class="btn bordered-btn">
                        <i class="fab fa-whatsapp"></i>Whatsapp</a>
                </div>

                <section>
                    {!! $frontSettings['ads-4'] !!}
                </section>
                    
                @if(!empty($relatedBlog))
                    <div class="seperator"></div>
                    <section class="recommending-you">
                        <div class="list-boxes mb-50 box-shadow">
                            <h4 class="title">We are Recommending you</h4>
                            <ul>
                              @foreach($relatedBlog as $key => $value)
                                <li><a href="{{ route('blog.detail',$value->slug) }}">{{ $value->title }}</a></li>
                              @endforeach
                            </ul>
                        </div>
                    </section>
                @endif
            </section>
        </div>
        <div class="col-12 col-md-12 col-xl-4 col-sm-12 sidebar-main">
            <section class="related-articles mb-5 mt-5">
                @include('dvsolution.sidebar')
            </section>
        </div>
    </div>
</section>
@endsection

@section('script')
<script src="{{ asset('dvNew/js/ace.js') }}"></script>
<script type="text/javascript">
function setEditorOptions(editor, type){
    editor.setTheme("ace/theme/clouds");
    editor.setHighlightActiveLine(false);
    editor.getSession().setMode("ace/mode/"+type);
};

var htmlEditor = ace.edit("html-editor");
setEditorOptions(htmlEditor,'html');

var cssEditor = ace.edit("css-editor");
setEditorOptions(cssEditor,'css');

var jsEditor = ace.edit("javascript-editor");
setEditorOptions(jsEditor,'javascript');

// sessionStorage["html"] = $("#html").html();
// sessionStorage["css"] = $("#css").html();
// sessionStorage["js"] = $("#js").html();

$(document).ready(function() {
    onload = (document).onkeyup = function() {
        (document.getElementById("preview").contentWindow.document).write(html.value + "<style>" + css.value + "<\/style><script>" + js.value + "<\/script>");
        (document.getElementById("preview").contentWindow.document).close()
    };
    $("textarea").keydown(function(event) {
        if (event.keyCode === 9) {
            var start = this.selectionStart;
            var end = this.selectionEnd;
            var $this = $(this);
            var value = $this.val();
            $this.val(value.substring(0, start) + "  " + value.substring(end));
            this.selectionStart = this.selectionEnd = start + 1;
            event.preventDefault();
        }
    });
    $("textarea").keydown(function() {
        sessionStorage[$(this).attr("id")] = $(this).val();
    });
    $("#html").html(sessionStorage["html"]);
    $("#css").html(sessionStorage["css"]);
    $("#js").html(sessionStorage["js"]);

    function init() {
        if (sessionStorage["html"]) {
            $("#html").val(sessionStorage["html"]);
        }
        if (sessionStorage["css"]) {
            $("#css").val(sessionStorage["css"]);
        }
        if (sessionStorage["js"]) {
            $("#js").val(sessionStorage["js"]);
        }
    };
    $(".clearLink").click(clearAll);

    function clearAll() {
        document.getElementById("html").value = "";
        document.getElementById("css").value = "";
        document.getElementById("js").value = "";
        sessionStorage.clear();
    }
});
</script>
@endsection