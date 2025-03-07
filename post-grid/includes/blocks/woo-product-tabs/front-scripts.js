export function setupWooProductTabs() {
	document.addEventListener("DOMContentLoaded", function (event) {
		var blockWrapper = document.querySelectorAll(".pg-woo-product-tabs");
		if (blockWrapper != null) {
			blockWrapper.forEach((item) => {
				var blockargs = item.getAttribute("data-blockargs");
				var blockArgsObj = JSON.parse(blockargs);
				var blockId = blockArgsObj.blockId;
				var navs = document.querySelectorAll("." + blockId + " .wc-tabs-wrapper ul li");
				var elements = post_grid_vars[blockId].elements
				var icon = post_grid_vars[blockId].icon
				var items = elements.items;
				var showIcon = elements.options.showIcon
				var showLabel = elements.options.showLabel
				var iconPosition = icon.position
				navs.forEach((li, i) => {
					var link = li.querySelector("a");
					if (link != null) {
						if (items[i] != undefined) {
							var siteIcon = items[i].siteIcon
							var icon = "<span class='icon " + siteIcon.iconSrc + "'></span>";
							if (iconPosition == "beforeLink") {
								link.insertAdjacentHTML(
									"beforebegin",
									icon,
								);
							}
							if (iconPosition == "afterLink") {
								link.insertAdjacentHTML(
									"afterend",
									icon,
								);
							}
							if (iconPosition == "beforeLabel") {
								link.insertAdjacentHTML(
									"beforeend",
									icon,
								);
							}
							if (iconPosition == "afterLabel") {
								link.insertAdjacentHTML(
									"afterend",
									icon,
								);
							}
						}
					}
				});
			});
		}
	});
}