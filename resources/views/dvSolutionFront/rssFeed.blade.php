<?php echo "<?xml version=\"1.0\" encoding=\"UTF-8\"?>\n"; ?>

<rss version='2.0' xmlns:media="http://search.yahoo.com/mrss/">
<channel>
<?php
	function clean($string) {
	   $string = str_replace(' ', '--', $string); // Replaces all spaces with hyphens.

	   $string = preg_replace('/[^A-Za-z0-9\-]/', '', $string); // Removes special chars.
	   return  str_replace('--', ' ', $string);
	}
?>
	<title>www.rvsolutionstuff.com - Tutorial It Language Site | See Demo Example</title>
  	<link>{{ URL::to('/') }}</link>
  	<description>Dvsolution website focuses on all web language and framework tutorial PHP, Laravel, Codeigniter, Nodejs, API, MySQL, AJAX, jQuery, JavaScript, Demo</description>

	@if(!empty($posts))
		@foreach($posts as $key=>$value)
			@if($value->img != '/upload/Google map.png')
			<item>
				<?php
					$p = str_replace('—','',$value->title);
					$p = str_replace('&','',$p);
					$p = str_replace('“','',$p);
					$p = str_replace('”','',$p);
					$p = str_replace('-','',$p);
					$p = str_replace('–','',$p);
					$p= clean($p);																		
				?>
				<title>{{ htmlspecialchars($p, ENT_XML1, 'UTF-8') }}</title>
				<link>{{ URL::route('blog.detail',$value->slug) }}</link>
				
				<?php
					$p2 = str_replace('—','',\Str::limit($value->description,300));
					$p2 = str_replace('&','',$p2);
					$p2 = str_replace('“','',$p2);
					$p2 = str_replace('”','',$p2);
					$p2 = str_replace('-','',$p2);
					$p2 = str_replace('–','',$p2);
					$p2= clean($p2);
				?>
				<description>{{ htmlspecialchars($p2, ENT_XML1, 'UTF-8') }}</description>
				<author>Divyang Vadodariya</author>
				<pubDate>{{ \Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $value->created_at)->toRfc822String() }}</pubDate>
				<media:thumbnail url="{{ asset($frontsetting['site-logo']) }}" />
				<image>
				    <url>{{ asset($frontsetting['site-logo']) }}</url>
				    <title>{{ htmlspecialchars($p, ENT_XML1, 'UTF-8') }}</title>
				    <link>{{ asset($frontsetting['site-logo']) }}</link>
				</image>
				<img src="{{ asset($frontsetting['site-logo']) }}" class="type:primaryImage" />

			</item>
			@endif
		@endforeach
	@endif

</channel>
</rss>