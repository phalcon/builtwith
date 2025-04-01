"use strict"

/**
 * инициализация всех инициализаций
 */
$(document).ready(function()
{
	o2.init();
});

/**
 * основной объект
 * @type {object}
 */
var o2 =
{
	/**
	 * вызов функций, которые должны запускаться при загрузке страницы
	 */
	init: function()
	{
		this.header.mobileNavDropdown();
		this.header.closeMobileNav('.header-nav__burger');
	},
	header:
	{
		openMobileNav: function(instance)
		{
			if ($(instance).hasClass('active') == false)
			{
				$(instance).addClass('active');
				$(instance).parents().find('._navToggle').addClass('active');
				$('body').addClass('hidden');
				event.stopPropagation();
			}
		},

		closeMobileNav: function(instance)
		{
			$(document).click(function() {
				if ($(instance).hasClass('active'))
				{
					$(instance).removeClass('active');
					$(instance).parents().find('._navToggle').removeClass('active');
					$('body').removeClass('hidden');
				}
			});
		},

		mobileNavDropdown: function()
		{
			var extAcc = $('.extendable');

			for (i = 0; i < extAcc.length; i++) {
				extAcc[i].addEventListener("click", function() {
					this.classList.toggle("extended");
				});
			}
		}
	}
}