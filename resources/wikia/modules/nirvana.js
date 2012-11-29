/**
 * Helper module for making AJAX requests to Nirvana controllers
 */
/*global define*/

(function (context) {
	'use strict';

	function nirvana($) {
		function sendRequest(attr) {
			var type = (typeof attr.type === 'undefined') ? 'POST' : attr.type.toUpperCase(),
				format = (typeof attr.format === 'undefined') ?  'json' : attr.format.toLowerCase(),
				data = (typeof attr.data === 'undefined') ? {} : attr.data,
				callback = (typeof attr.callback === 'undefined') ? function(){} : attr.callback,
				onErrorCallback = (typeof attr.onErrorCallback === 'undefined') ? function(){} : attr.onErrorCallback,
				url,
				getUrl;

			if((typeof attr.controller === 'undefined') || (typeof attr.method === 'undefined')) {
				throw "controller and method are required";
			}

			if( !(format === 'json' || format === 'html'  || format === 'jsonp' ) ) {
				throw "Only Json,Jsonp and Html format are allowed";
			}

			url = (typeof attr.scriptPath === 'undefined') ? context.wgScriptPath : attr.scriptPath;

			getUrl = {
				//Iowa strips out POST parameters, Nirvana requires these to be set
				//so we're passing them in the GET part of the request
				controller: attr.controller.replace(/Controller$/, ''),
				method: attr.method
			};

			(type == 'POST' ? getUrl : data).format = format;

			var sortedKeys = [];
			for(var key in data) {
				sortedKeys[sortedKeys.length] = key;
			}
			sortedKeys.sort();
			var sortedDict = {};
			for(var i = 0; i < sortedKeys.length; i++) {
				sortedDict[sortedKeys[i]] = data[sortedKeys[i]];
			}

			return $.ajax({
				url: url + '/wikia.php?' + $.param(getUrl), /* JSlint ignore */
				dataType: format,
				type: type,
				data: sortedDict,
				success: callback,
				error: onErrorCallback
			});
		}

		// "private" (used by getJson and postJson)
		function ajaxJson(controller, method, data, callback, onErrorCallback, requestType) {
			// data parameter can be omitted
			if ( typeof data === 'function' ) {
				callback = data;
				data = {};
			}

			return sendRequest({
				controller: controller,
				method: method,
				data: data,
				type: requestType,
				format: 'json',
				callback: callback,
				onErrorCallback: onErrorCallback
			});
		}

		function getJson(controller, method, data, callback, onErrorCallback) {
			return ajaxJson(
				controller,
				method,
				data,
				callback,
				onErrorCallback,
				'GET'
			);
		}
		function postJson(controller, method, data, callback, onErrorCallback) {
			return ajaxJson(
				controller,
				method,
				data,
				callback,
				onErrorCallback,
				'POST'
			);
		}

		return {
			sendRequest: sendRequest,
			getJson: getJson,
			postJson: postJson
		};
	}

	if (context.define && context.define.amd) {
		context.require(['jquery'], function (jQuery) {
			context.define('nirvana', nirvana(jQuery));
		});
	}

	if (context.jQuery) {
		context.jQuery.nirvana = nirvana(context.jQuery);
	}
}(this));
