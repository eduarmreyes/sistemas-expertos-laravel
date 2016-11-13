(function() {
	$(document).on("ready", function() {
		if (typeof PNotify !== "undefined") {
	    PNotify.prototype.options.styling = "bootstrap3";
		}
	});
})();