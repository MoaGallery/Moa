(function () {
	'use strict';

	var ng_module_name = 'moa.imageList';
	angular.module(ng_module_name)
		.directive('imageList', imageList);

	imageList.$inject = ['imageListService'];
	function imageList(imageListService)
	{
		return {
			replace: false,
			restrict: 'E',
			controller: controller,
			controllerAs: 'imageList',
			templateUrl: '/templates/default/directives/imageList.directive.html'
		};

		function controller()
		{
			var ctrl = this;
			ctrl.images = imageListService.getData();
		}
	}
}());