(function()
{
	var module_name = 'moa.imageList';
	angular.module(module_name, [])
		.service('imageListService', imageListService);

	function imageListService()
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