(function()
{
	angular.module(angular_module_name)
		.controller('preloadController', ['breadcrumbService', preloadController]);

	function preloadController(breadcrumbService)
	{
		var ctrl = this;

		ctrl.data = [];

		ctrl.init = function(data)
		{
			ctrl.data = data;

			if (typeof ctrl.data['breadcrumb'] !== 'undefined')
				breadcrumbService.setData(ctrl.data['breadcrumb']);
		};
	}
}());