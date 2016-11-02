(function()
{
	angular.module(angular_module_name)
		.controller('breadcrumbController', ['breadcrumbService', breadcrumbController]);

	function breadcrumbController(breadcrumbService)
	{
		var ctrl = this;

		ctrl.data = breadcrumbService.getData();
	}
}());