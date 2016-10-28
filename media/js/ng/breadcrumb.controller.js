(function()
{
	console.log(angular.module(angular_module_name));
	angular.module(angular_module_name)
		.controller('breadcrumbController', ['breadcrumbService', breadcrumbController]);

	function breadcrumbController(breadcrumbService)
	{
		var ctrl = this;

		ctrl.data = [];

		ctrl.init = function(data)
		{
			ctrl.data = breadcrumbService.setData(data);
			ctrl.data = data;
		};
	}
}());