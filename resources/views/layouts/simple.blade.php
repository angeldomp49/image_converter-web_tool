<!DOCTYPE html>
<html lang="en">

	<x-page-head />

	<body>

		<x-preloader />

		<div class="wrapper theme-1-active pimary-color-pink">
			<x-main-content>
				<div class="container-fluid">
					@yield('content')
				</div>

				<x-page-footer>
					@yield('footer')
				</x-page-footer>
            </x-main-content>
		</div>
		<!-- /#wrapper -->

		<x-page-scripts />	
		
	</body>
</html>