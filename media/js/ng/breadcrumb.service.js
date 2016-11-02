(function()
{
	var breadcrumb_module_name = 'moa.breadcrumb';
	angular.module(breadcrumb_module_name, [])
		.service('breadcrumbService', breadcrumb_service);

	function breadcrumb_service()
	{
		var service = this;

		service.data = [];

		service.getData = function()
		{
			if (typeof service.data === 'undefined')
				return [];

			return service.data;
		};

		service.setData = function(data)
		{
			service.data = data;
		};
	}
}());