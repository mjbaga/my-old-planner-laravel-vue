<header class="header">
	<div class="container">
		<div class="logo">
			<a href="/">
				<div class="image-container">
					<img src="{{ asset('images/ey.png') }}" alt="Fibonacci">
				</div>
				<div class="title">
					<h2>Resourcing</h2>
				</div>
			</a>
		</div>
		<div class="menu-container">
			<ul class="menu">
				<li>
					<a href="/">Resource Board</a>
				</li>
				<li>
					<a href="{{ route('admin.resources') }}">Resources</a>
				</li>
				<li>
					<a href="{{ route('admin.projects', 'engagement') }}">Settings</a>
				</li>
			</ul>
		</div>
	</div>
</header>