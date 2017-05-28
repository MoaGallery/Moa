(function()
{
	angular.module(angular_module_name)
		.controller('preloadController', ['breadcrumbService', 'imageListService', preloadController]);

	function preloadController(breadcrumbService, imageListService)
	{
		var ctrl = this;

		ctrl.data = [];

		ctrl.init = function(data)
		{
			ctrl.data = data;

			if (typeof ctrl.data['breadcrumb'] !== 'undefined')
				breadcrumbService.setData(ctrl.data['breadcrumb']);
			if (typeof ctrl.data['imageList'] !== 'undefined')
				imageListService.setData(ctrl.data['imageList']);
		};
	}
}());