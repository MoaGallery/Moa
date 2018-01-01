(function()
{
	var module_name = 'moa.imageList';
	angular.module(module_name, [])
		.service('imageListService', imageListService);

	imageListService.$inject = ['$http', '$timeout'];
	function imageListService($http, $timeout)
	{
		var service = this;

		service.data = [];
		service.generatingThumbs = [];

		service.getData = function()
		{
			if (typeof service.data === 'undefined')
				return [];

			return service.data;
		};

		service.setData = function(data)
		{
			service.data = data;

			for (var i = 0; i < service.data.length; i++)
			{
				if (service.data[i].isGenerating)
					service.generatingThumbs.push(service.data[i].id);
			}

			$timeout(updateThumbnails, 1000);
		};

		function thumbnailResponse(response)
		{
			var queued = response.data;
			var old = service.generatingThumbs;
			service.generatingThumbs = [];

			for (var i = 0; i < old.length; i++)
			{
				var found = false;
				for (var j = 0; j < queued.length; j++)
				{
					if (old[i] === queued[j])
					{
						found = true;
					} else
					{
					}
				}
				if (found)
				{
					service.generatingThumbs.push(old[i]);
				} else
				{
					// Update the image
					for (j = 0; j < service.data.length; j++)
					{
						if (service.data[j].id === old[i])
							service.data[j].isGenerating = false;
					}
				}
			}

			if (service.generatingThumbs.length > 0)
				$timeout(updateThumbnails, 1000);
		}

		function updateThumbnails()
		{
			$http(
				{
					method: 'GET',
					url: '/api/thumbnail_status?images=' + service.generatingThumbs.join(','),
				}).then(thumbnailResponse);
		}
	}
}());