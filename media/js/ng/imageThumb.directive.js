(function () {
	'use strict';

	var ng_module_name = 'moa.imageList';
	angular.module(ng_module_name)
		.directive('imageThumb', imageThumb);

	function imageThumb()
	{
		return {
			replace: false,
			restrict: 'E',
			controller: controller,
			controllerAs: 'thumb',
			templateUrl: '/templates/default/directives/imageThumb.directive.html',
			scope:
			{
				'image': '='
			}
		};

		function controller($scope)
		{
			var ctrl = this;
			ctrl.image = $scope.image;
		}
	}
}());